<?php header('Content-Type: text/html; charset=utf-8'); ?>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="./js/base/jquery.js"></script>
<script type="text/javascript" src="./js/base/lodash.js"></script>
<script type="text/javascript" src="./js/base/requirejs/require.js"></script>
<script type="text/javascript" src="./js/init.js"></script>
</head>

<body>

<div id="agc">cccc</div>

</body>

</html>

<script>
  var basePath = "/" + objCommonFn.getRootUrl() + "/js/module/";
  requirejs([basePath + 'sample.js'], function(sample) {
  });
</script>
