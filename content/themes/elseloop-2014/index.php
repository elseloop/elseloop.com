<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Ember Starter Kit</title>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/normalize.css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css">
</head>
<body>
  <script type="text/x-handlebars">
    <h2>Welcome to Ember.js</h2>

    {{outlet}}
  </script>

  <script type="text/x-handlebars" id="index">
    <ul>
    {{#each item in model}}
      <li>
        <div>
          <h2><a {{bind-attr href="item.link"}}>{{item.title}}</a></h2>
          {{{item.content}}}
          <p><img {{bind-attr src="item.author.avatar"}} alt=""></p>
        </div>
      </li>
    {{/each}}
    </ul>
  </script>

  <script src="<?php echo get_template_directory_uri(); ?>/js/libs/jquery-1.10.2.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/libs/handlebars-1.1.2.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/libs/ember-1.4.0.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/app.js"></script>
  <!-- to activate the test runner, add the "?test" query string parameter -->
  <script src="tests/runner.js"></script>
</body>
</html>
