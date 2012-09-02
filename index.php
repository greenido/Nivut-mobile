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

    <title>Nivut</title>
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

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Mobile Nivut</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <h1>Next Races</h1>
        <p>
          <?php

          // TODO: ugly - need to move it to its own file...
          function changeHrefToCollapse($html) {
            $newHtml = preg_replace("/<a/i", "<a class='btn btn-primary btn-large race-but' ", // href='humans.txt'danger data-target='#raceDetails'
                    $html);
//              $newHtml = preg_replace("/href=/i",
//                      "href='"
//                      $html);
            return $newHtml;
          }

          $path = "http://nivut.org.il/calendar.aspx";
          //error_log("---- path: $path ");

          $rawHtml = file_get_contents($path);
          //                        1234567890123456789012345678901234567890
          $inx1 = strpos($rawHtml, "rgMasterTable") + 15;
          $inx2 = strpos($rawHtml, "</table>", $inx1) + 33;
          $ourHtml = substr($rawHtml, $inx1, $inx2 - $inx1);
          $newHtml = changeHrefToCollapse($ourHtml);
          echo "<div id='airhtml' dir='rtl'><table $newHtml </div>";
          ?>
        </p>
        <p><a class="btn btn-primary btn-large">Learn more &raquo;</a></p>
      </div>


      <!-- Our dialog to show the race details -->
      <div class="modal fade" id="raceDetails" tabindex="-1" 
           role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 id="myModalLabel">Modal header</h3>
        </div>
        <div class="modal-body">
          <p>One fine details per race</p>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
        </div>
      </div>

      <!-- Example row of columns -->
      <div class="row">
        <div class="span4">

          bla-bla
        </div>


        <div class="span4">
          <h2>Heading</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn" href="#">View details &raquo;</a></p>
        </div>
        <div class="span4">
          <h2>Heading</h2>
          <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
          <p><a class="btn" href="#">View details &raquo;</a></p>
        </div>
      </div>

      <hr>

      <footer>
        <p>&copy; Company 2012</p>
      </footer>

    </div> <!-- /container -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.2.min.js"><\/script>')</script>

    <script src="js/libs/bootstrap/bootstrap.min.js"></script>

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
