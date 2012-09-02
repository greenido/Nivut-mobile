<?php

if (isset($_REQUEST['event'])) {
  // this is the usage of Gems/list of stocks
  $event = $_REQUEST['event'];

  $path = "http://nivut.org.il/" . $event; // e.g. 1042/Info
  error_log("---- path: $path ");

  $rawHtml = file_get_contents($path);

  $inx1 = strpos($rawHtml, "<div class=\"maincontent");
  $inx2 = strpos($rawHtml, "הזן כתובת מוצא", $inx1) - 9;  // "id=\"sidebar\""
  $ourHtml = substr($rawHtml, $inx1, $inx2 - $inx1);
  $newHtml = preg_replace("/<img[^>]+\>/i", "", $ourHtml); 
  $newHtml = str_replace("maincontent", "maincontent\" dir='rtl' ", $newHtml);
  
  echo($newHtml);
} else {
  echo "<h1>yo... send an event id!</h1>";
}
?>
