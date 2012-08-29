<?php

/*
 * Testing Zone (just like area 51) to get data from nivut.org.il and with the help of god we 
 * will be able to do something with the layout that MS is putting on us:
 * http://nivut.org.il/calendar.aspx
 */

// real simple/primitive function to get the html
function getUrlContent($url) {
  $cacheFolder = 'cache/';
  $filename = date('YmdH') . '.html';
  if (!file_exists($cacheFolder . $filename)) {
    $ch = curl_init($url);
    $fp = fopen($cacheFolder . $filename, 'w');
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, Array('User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/535.21 (KHTML, like Gecko) Chrome/19.0.1042.0 Safari/535.21'));
    curl_exec($ch);
    curl_close($ch);
    fclose($fp);
  }
  return file_get_contents($cacheFolder . $filename);
}


//
// Starting the party
//
$path = "http://nivut.org.il/calendar.aspx";
error_log("---- path: $path ");

$rawHtml = file_get_contents($path);
//                        1234567890123456789012345678901234567890
$inx1 = strpos($rawHtml, "rgMasterTable") + 15;
$inx2 = strpos($rawHtml, "</table>", $inx1) + 33;
$ourHtml = substr($rawHtml, $inx1, $inx2-$inx1);
//$title = strip_tags($title);
//error_log("title: $title");
//
//
//$inx1 = $inx2;
//$inx2 = strpos($rawHtml, "<!--End Green Box -->", $inx1);
//
//$airHtml = substr($rawHtml, $inx1, $inx2-$inx1);
//$airHtml = strip_tags($airHtml, "<p><a>");

error_log($ourHtml);


//SvivaContentItem SvivaFontSmall PLAirQFDivGreenBoxCenter
//*[@id="bigDivboxGreen1"]/div/div/div/div/div/div/div/div/div/table/tbody/tr/td/div/div/div[2]
/* Parse the HTML information and return the results.
  $dom = new DOMDocument();
  @$dom->loadHtml($rawHtml);

  $xpath = new DOMXPath($dom);

  // Get a list of articles from the section page
  $realData = $xpath->query("//*[@id='bigDivboxGreen1']/div/div/div/div/div/div/div/div/div/table/tbody/tr/td/div/div/div[2]");

  // Add each article to the Articles array
  foreach ($realData as $item) {
  error_log("item: $item");
  }
 */
?>
