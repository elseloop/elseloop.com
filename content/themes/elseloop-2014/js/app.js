App = Ember.Application.create();

App.Router.map(function() {
  // put your routes here
});

App.IndexRoute = Ember.Route.extend({
  model: function() {
    return Ember.$.getJSON('http://el.dev/wp-json.php/posts');
  }
});
