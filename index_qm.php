<?php
/**
 * An example to a mobile web app for nivut.org.il
 * 
 * Authro: Ido Green
 * Date: Aug 2012
 */
?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>ניווט נייד</title>
    <meta name="description" content="Orienteering in Israel with this mobile web app">
    <meta name="author" content="Ido Green | greenido.wordpress.com | @greenido">

    <meta name="viewport" content="width=device-width, initial-scale=1"> 

    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    
    <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.js"></script>

  </head>
  <body>
    <div data-role="page" data-theme="c">

      <div data-role="header" data-position="fixed">
        <span class="logo-img"><img src="img/logo_isoa.gif" alt="logo of Orienteering org" /></span>
        <h1>ניווט נייד</h1>
        
      </div><!-- /header -->

      <div data-role="navbar" data-iconpos="bottom">
        <ul>
          <li>
            <a href="#" data-icon="home" class="ui-btn-active ui-state-persist"> ניווטים  </a></li>
          <li><a data-icon="star" href="weather_qm.php">מזג האוויר</a></li>
          <li><a data-icon="info" href="http://plus.ly/greenido" target="_blank">אודות</a></li>
        </ul>
      </div><!-- /navbar -->

      <div data-role="content" dir="rtl" id="main-events">	
        <?php

        // TODO: ugly - need to move it to its own file...
        function changeHrefToCollapse($html) {
          $newHtml = preg_replace("/<a/i", "<a class='btn btn-primary btn-large race-but' ", $html);
          // clean the massy html we got
          $newHtml = preg_replace("/<td style=\"display:none;\">(False|True)/", "", $newHtml);
          $newHtml = preg_replace("/style=/i", "blabla=", $newHtml);

          return $newHtml;
        }

        function stripBalagan($html) {
          $newHtml = '<ul data-role="listview" data-inset="true" data-filter="true">';
          $inx1 = strpos($html, "tbody") + 7;
          $inx1 = strpos($html, "<tr", $inx1) + 3;
          for ($j = 0; $j < 15; $j++) {
            $inx1 = strpos($html, "<td>", $inx1) + 4;
            $inx2 = strpos($html, "</td>", $inx1);
            $date = substr($html, $inx1, $inx2 - $inx1);

            $inx1 = strpos($html, "<td>", $inx2);
            $inx2 = strpos($html, "</td>", $inx1);
            $link = substr($html, $inx1, $inx2 - $inx1);
            $link = preg_replace("/<a/i", "<a class='btn btn-primary btn-large race-but' ", $link);

            // bring it to the next item in the table
            $inx1 = strpos($html, "<tr", $inx1) + 3;
            $restData = substr($html, $inx2, $inx1 - $inx2);
            // search for foot or bike event. 
            $inx3 = strpos($restData, "רכוב");
            $icon = "<img src='img/foot-o.png' alt='foot orienteering event'/>";
            if ($inx3 > 0) {
              $icon = "<img src='img/bike-o.png' alt='foot orienteering event'/>";
            }

            // put the date & icon in the button
            $link = preg_replace("/<\/a>/i", " <span class='sml-font'> " .
                    $icon . $date . "</span></a>", $link);

            $newHtml .= "<li>{$link}</li>";
          }
          $newHtml .= "</ul>";
          return $newHtml;
        }

        $path = "http://nivut.org.il/calendar.aspx";
        $rawHtml = file_get_contents($path);
        $inx1 = strpos($rawHtml, "rgMasterTable") + 15;
        $inx2 = strpos($rawHtml, "</table>", $inx1);
        $ourHtml = substr($rawHtml, $inx1, $inx2 - $inx1);
        $newHtml = stripBalagan($ourHtml);
        echo "<div dir='rtl'> $newHtml </div>";
        ?>

      </div><!-- /content -->

      <div data-role="footer">
        <div data-role="navbar" data-iconpos="top">
          <ul>
            <li><a data-icon="grid" href="http://nivut.org.il" target="_blank">האתר הרגיל</a></li>
            <li><a data-icon="forward" href="http://blog.nivut.org.il/" target="_blank">ניווטון </a> </li>
          </ul>
        </div>
      </div>

    </div><!-- /page -->

    <!-- Start of Event detailed page -->
    <div data-role="page" id="eventPage" data-theme="e">

      <div data-role="header">
        <a href="#" data-rel="back" data-icon="back">Back</a>
        <h1>האירוע</h1>
      </div><!-- /header -->

      <div id="event-details" data-role="content" data-theme="e">	

      </div><!-- /content -->

      <div data-role="footer">
        <p>
          <a href="#main-events" data-role="button" data-theme="a" data-rel="back" data-icon="back">Back</a>
        </p>
      </div><!-- /footer -->
    </div><!-- /event page  -->

    <script src="js/qm.js"></script>

    <script>
      var _gaq=[['_setAccount','UA-27750723-1'],['_trackPageview']];
      (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
        g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
        s.parentNode.insertBefore(g,s)}(document,'script'));
    </script>

  </body>
</html>
