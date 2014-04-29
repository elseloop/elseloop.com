<!DOCTYPE html>
<!--[if lte IE 8]>         <html class="no-js lt-ie9" lang="en" > <!--<![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js root" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <title>elseloop</title>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/build/min/style.min.css">
  
  <script type="text/javascript">
    (function(d) {
      var config = {
        kitId: 'erb2lwi',
        scriptTimeout: 3000
      },
      h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='//use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
    })(document);
  </script>

</head>

<body class="app-body">

  <script type="text/x-handlebars" data-template-name="application">
    
    <header class="site-header clearfix">
      <div class="wrap">
        <h1 class="logo-wrap">
          {{#link-to 'index' class="logo-link"}}Elseloop{{/link-to}}
          <object type="image/svg+xml" data="<?php echo get_template_directory_uri(); ?>/assets/images/svg/logo.svg" class="logo">
            Elseloop
          </object>
        </h1>

        <nav class="site-nav">
          {{#link-to 'index'}}Home{{/link-to}}
          <a href="#" {{action "showPosts"}}>Articles</a>
        </nav>

        {{title}}

      </div>
    </header>
  
    {{outlet}}
    {{outlet recent}}

    <footer class="site-footer clearfix">
      <div class="wrap">
        <p>&copy; 2014</p>
        <p class="pdx">Handcrafted in Southeast Portland, Ore., using only the finest in locally-sourced organic, free-range pixels.</p>
      </div>
    </footer>

  </script>
  
  <script type="text/x-handlebars" data-template-name="posts/index">
    {{#if stuffs.firstObject}}
      
      <article class="post hentry single-post">
        <div class="post-head">
          <h2 class="post-title">{{{stuffs.firstObject.title}}}</h2> 
          <p class="post-date">{{format-date stuffs.firstObject.date}}</p>
        </div>
        <div class="content-wrap">
          {{{stuffs.firstObject.content}}}
        </div>
      </article>

    {{/if}}
  </script>

  <script type="text/x-handlebars" data-template-name="posts">
    
    <ul class="post-list">
      <li class="menu-close" {{action "showPosts"}}>&times;</li>
      {{#each stuff in stuffs}}
        <li class="postlist-item">
          {{#link-to 'post' stuff.slug}}
            {{{stuff.title}}}
            <span>{{format-date stuff.date}}</span>
          {{/link-to}}
        </li>
      {{/each}}
    </ul>

    {{outlet}}
    
  </script>

  <script type="text/x-handlebars" data-template-name="post">
    
    <article class="post hentry single-post">
      <div class="post-head">
        <h2 class="post-title">{{{title}}}</h2> 
        <p class="post-date">{{format-date date}}</p>
      </div>
      <div class="content-wrap">
        {{{model.content}}}
      </div>
    </article>

    <div class="post-basement">
      <div class="post-basement--inner">
        <p class="comeatmebro">Thoughts? Shout <a href="http://twitter.com/elseloop">@elseloop.</a></p>
        <ul class="post-nav">
          
          <li class="prev">
            {{#if prev}}
              {{#link-to 'post' prev.slug class="prev-link"}}Prev{{/link-to}}
            {{else}}
              <a class="prev-link disabled">Prev</a>
            {{/if}}
          </li>

          <li class="allposts">
            <a href="#" {{action "showPosts"}}>All Posts</a>
          </li>

          <li class="next">
            {{#if next}}
              {{#link-to 'post' next.slug class="next-link"}}Next{{/link-to}}
            {{else}}
              <a href="#" class="next-link disabled">Next</a>
            {{/if}}
          </li>

        </ul>
      </div>
    </div>

  </script>
  
  <script type="text/x-handlebars" data-template-name="about">
    <article class="post hentry page">
      <div class="post-head">
        <h2 class="post-title">{{title}}</h2>
      </div>  
      <div class="content-wrap">
        {{{model.content}}}
      </div>
    </article>
  </script>

  <script src="<?php echo get_template_directory_uri(); ?>/assets/js/build/scripts.min.js"></script>
</body>
</html>
