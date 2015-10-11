<?php header('Content-Type: text/html; charset=utf-8'); ?>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../js/base/requirejs/require.js"></script>
<script type="text/javascript" src="../js/init.js"></script>
</head>
<body>
<div id="main"></div>
</body>
</html>

<script>
requirejs([
  'jquery',
  'Handlebars'
],
function($, Handlebars) {
  var template = Handlebars.compile($('#menu_list').html()),
      data = {
          title: "menu"
        , aryMenuList: [ 'apple', 'banana' ]
      };

  $('#main').html(template(data));
});
</script>

<script id="menu_list" type="text/x-handlebars-template">
  <div class="box">
  <h1>{{title}}</h1>
  <div class="content">
  <ul>
  {{#each aryMenuList}}
  <li>{{this}}</li>
  {{/each}}
  </ul>
  </div>
</script>
