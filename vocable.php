<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php

//general
$folderPath = "./files/vocables";

//ajax request
$action = isset($_GET['action']) ? $_GET['action'] : null;
$year = isset($_GET['year']) ? $_GET['year'] : null;
$month = isset($_GET['month']) ? $_GET['month'] : null;

if ($action !== null && $year !== null && $month !== null) {
    $targetFile = $folderPath . "/" . $year . "/" . $month;
    $fileContent = file_get_contents($targetFile);
    $aryVocable = array_filter(explode(chr(10), $fileContent));

    echo json_encode($aryVocable);
    exit;
}

//load vocable folders
$aryExcludedFolder = array('.', '..');
$aryYearFolder = array();
$aryMonthOfYearFile = array();

if ($resYearFolder = opendir($folderPath)) {
    while ($yearFolder = readdir($resYearFolder)) {
       if (!in_array($yearFolder, $aryExcludedFolder)) {
           array_push($aryYearFolder, $yearFolder);

           $aryMonthOfYearFile[$yearFolder] = array();
           $aryMonthFile = scandir($folderPath . "/" . $yearFolder);

           foreach ($aryMonthFile as $monthFile) {
               !in_array($monthFile, $aryExcludedFolder) && array_push($aryMonthOfYearFile[$yearFolder], $monthFile);
           }
       }
    }
}

closedir($resYearFolder);
?>
<?php header('Content-Type: text/html; charset=utf-8'); ?>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="./js/base/jquery.js"></script>
<script type="text/javascript" src="./js/base/lodash.js"></script>
<script type="text/javascript" src="./js/base/requirejs/require.js"></script>
<script type="text/javascript" src="./js/init.js"></script>
<link rel=stylesheet type="text/css" href="./css/vocable/main.css"/>
</head>

<body>

<div class="container">

    <table>
      <tr>
        <td width="150" valign="top">
          <div class="clear_both h20"></div>
          <div><h1>Year</h1></div>
          <div class="clear_both h20"></div>

          <?php foreach($aryYearFolder as $year) { ?>
          <ul id="year">
          <li><h2 class="target_year"><?php echo $year; ?></h2></li>
          </ul>
          <?php } ?>

          <div class="clear_both h20"></div>

          <div><h1>Month</h1></div>
          <div class="clear_both h20"></div>

          <div>
             <ul id="month"></ul>
          </div>
        </td>
        <td valign="top">
           <div class="clear_both h20"></div>
           <h1>Total:<span id="total"></span></h1>
           <div class="clear_both h20"></div>

           <ul>
             <li><input id="btn_random_all" type="button" value="Randam All" style="display: none"/></li>
             <li><input id="btn_random_100" type="button" value="Randam 100" style="display: none"/></li>
           </ul>

           <div class="clear_both h20"></div>

           <div>
             <ul id="vocable"></ul>
           </div>
        </td>
      </tr>
    </table>

    <div class="clear_both h20"></div>
    <div id="data" style="display: none"><?php echo json_encode($aryMonthOfYearFile); ?></div>

</div>

</body>

</html>

<script>
  window.basePath = "/" + objCommonFn.getRootUrl() + "/js/module/";
  requirejs([basePath + 'vocable.js'], function(vocable) {
  });
</script>
