App = Ember.Application.create();

Ember.RSVP.configure('onerror', function(error) {
  if (error instanceof Error) {
    Ember.Logger.assert(false, error);
    Ember.Logger.error(error.stack);
  }
});

// Default post types
  var defaultPostTypes = [
    'posts',
    'pages',
  ];

// set up routes
App.Router.map(function() {
  
  this.resource('posts', { path: '/:posttype_id' }, function() {
      this.resource("post", { path: "/:post_slug" });
  });
  
});

App.Posts = Ember.Object.extend({
  
  loadedposts: false,

  title: function() {
    return this.get('id');
  }.property('id'),

  /*
    Load all the posts

    It returns a promise that will resolve to be the list of posts.
  */
  loadPosts: function() {
    
    var posttype = this;

    return Em.Deferred.promise(function (p) {

      if (posttype.get('loadedposts')) {
        
        // We've already loaded the posts, let's return them!
        p.resolve(posttype.get('stuffs'));

      } else {
        
        p.resolve($.getJSON("/wp-json/" + posttype.get('id') + "?filter[posts_per_page]=-1" )
          .then(function(response) {
            
            var postlist = Em.A();
            
            response.forEach(function(post) {
              var type = post.type + 's';
              type = posttype;
              postlist.pushObject(App.Post.createRecord(post));
            });

            response.forEach( function(post,i) {
                
              if( (i+1) < postlist.length ) {
                postlist[i].set( "next", postlist[i+1] );
              }
              if( i-1 >= 0 ) {
                postlist[i].set( "prev", postlist[i-1] );
              }

            });

            posttype.setProperties({stuffs: postlist, loadedposts: true});

            return postlist;

          }) // then

        ); // getjson 

      } // if loadedposts

    }); // return

  },

  findPostBySlug: function(slug) {
    return this.loadPosts().then(function (postlist) {
      return postlist.findProperty('slug', slug);
    });
  },

  findMostRecent: function() {
    return this.loadPosts().then(function (postlist) {
      return postlist.get('firstObject');
    });
  }

});

App.Posts.reopenClass({

  /*
    This class method returns a list of all our posts. 
    We store them in a class variable so they will only
    be created and referenced once.
  */
  list: function(id) {
    
    var list = Em.A();

    defaultPostTypes.forEach(function (id) {
      list.pushObject(App.Posts.create({id: id}));
    });

    return list;
  },

  /*
    Returns the default subreddit to show if the user hasn't selected one.
  */
  defaultPostType: function() {
    return this.list()[0];
  }

});

App.Post = Ember.Object.extend({
  id: null,
  title: null,
  slug: null,
  status: null,
  content: null,
  excerpt: null,
  date: null,
  author: null,
  type: null
});

App.Post.reopenClass({
  
  createRecord: function(data) {
    var post = App.Post.create({
      id: data.ID,
      title: data.title,
      slug: data.slug,
      status: data.status,
      content: data.content,
      excerpt: data.excerpt,
      date: data.date,
      author: data.author, // Object
      type: data.type
    });

    return post;
  }

});

App.PostRoute = Ember.Route.extend({
  model: function(params) {
    return this.modelFor('posts').findPostBySlug(params.post_slug);
  }
});

// set up posts model API call
App.PostsRoute = Ember.Route.extend({

  model: function(params) {
    return App.Posts.list().findProperty('id', params.posttype_id);
  },

  afterModel: function(model) {
    return model.loadPosts();
  }

});

App.ApplicationRoute = Ember.Route.extend({
  
  actions: {
    willTransition: function(transition) {
      Ember.$('body').removeClass('show-posts');
      Ember.$('.post-list').removeClass("on-canvas");
      Ember.$('html,body').animate({ scrollTop: 0}, 750 );
    },
    showPosts: function() {
      Ember.$('body').toggleClass("show-posts");
      Ember.$('.post-list').toggleClass("on-canvas");
    }

  }

});

App.IndexRoute = Ember.Route.extend({
  
  beforeModel: function() {
    return this.transitionTo('posts', App.Posts.defaultPostType());
  }

});

// hard coding about page API call by ID
// 
// @TODO figure out more robust way to do this
// without resorting to a /pages/:page_slug URL structure
App.AboutRoute = Ember.Route.extend({
  model: function() {
    return Ember.$.getJSON('/wp-json/pages/7');
  }
});

// Format human readable dates
// @uses moment.js
// currently used on post date in posts & post views
Ember.Handlebars.helper('format-date', function(date) {
  return moment(date).format('YYYY MMMM Do');
});