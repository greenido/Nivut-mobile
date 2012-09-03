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

    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="css/style.css">

    <script src="js/libs/modernizr-2.5.3-respond-1.1.0.min.js"></script>
  </head>
  <body>
  <!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->

    <div class="navbar navbar-fixed-top" >
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">ניווט נייד</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li class="active"><a href="#">אירועים</a></li>
              <li><a href="weather.php">מזג האוויר</a></li>
              <li><a href="http://nivut.org.il" target="_blank">האתר הרגיל</a></li>
              <li><a href="http://plus.ly/greenido" target="_blank">אודות</a></li>
              <li><div id="plusone"><g:plusone></g:plusone></div></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit" dir="rtl">
        <p>
          <?php

          // TODO: ugly - need to move it to its own file...
          function changeHrefToCollapse($html) {
            $newHtml = preg_replace("/<a/i", "<a class='btn btn-primary btn-large race-but' ", // href='humans.txt'danger data-target='#raceDetails'
                    $html);
            // clean the massy html we got
            $newHtml = preg_replace("/<td style=\"display:none;\">(False|True)/", "", $newHtml);
            $newHtml = preg_replace("/style=/i", "blabla=", $newHtml);

            return $newHtml;
          }

          function stripBalagan($html) {
            $newHtml = '<ul class="nav nav-pills nav-stacked">';
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
              //{$date} 
              $link = preg_replace("/<\/a>/i", " <br/><span class='sml-font'> ".$date."</span></a>", $link);
              
              $inx1 = strpos($html, "<tr", $inx1) + 3;
              
              $newHtml .= "<li> {$link} </li>";
            }
            $newHtml .= "</ul>";
            return $newHtml;
          }

          $path = "http://nivut.org.il/calendar.aspx";
          //error_log("---- path: $path ");

          $rawHtml = file_get_contents($path);
          //                        1234567890123456789012345678901234567890
          $inx1 = strpos($rawHtml, "rgMasterTable") + 15;
          $inx2 = strpos($rawHtml, "</table>", $inx1);
          $ourHtml = substr($rawHtml, $inx1, $inx2 - $inx1);
          $newHtml = stripBalagan($ourHtml);
          //$newHtml = changeHrefToCollapse($ourHtml);
          echo "<div dir='rtl'> $newHtml </div>";
          ?>
        </p>
        <p>  </p>
      </div>


      <!-- Our dialog to show the race details -->
      <div class="modal fade" id="raceDetails" tabindex="-1" 
           role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
          <button type="button" class="close x-but" data-dismiss="modal" aria-hidden="true">×</button>

          <h3 id="myModalLabel">פרטי האירוע</h3>
        </div>
        <div class="modal-body">
          <p></p>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary btn-danger" data-dismiss="modal" aria-hidden="true">סגור</button>
        </div>
      </div>



    </div> <!-- /container -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.2.min.js"><\/script>')</script>

    <script src="js/libs/bootstrap/bootstrap.min.js"></script>
    <script src="http://apis.google.com/js/plusone.js"></script>

    <script src="js/libs/bootstrap/modal.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/script.js"></script>

    <script>
      var _gaq=[['_setAccount','UA-27750723-1'],['_trackPageview']];
      (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
        g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
        s.parentNode.insertBefore(g,s)}(document,'script'));
    </script>

  </body>
</html>
