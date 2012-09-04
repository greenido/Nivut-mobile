<!--
weather page on JQM
@greenido

-->
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>מזג האוויר</title>
    <meta name="description" content="Check the (on the face) air quality in Israel">
    <meta name="author" content="Ido Green | greenido.wordpress.com | @greenido">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <meta name="viewport" content="width=device-width, initial-scale=1"> 

    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    
    <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.js"></script>

  </head>
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
          <a href="index_qm.php" data-icon="home" class=""> ניווטים  </a></li>
        <li><a data-icon="star" class="ui-btn-active ui-state-persist" href="#">מזג האוויר</a></li>
        <li><a data-icon="info" href="http://plus.ly/greenido" target="_blank">אודות</a></li>
      </ul>
    </div><!-- /navbar -->

    <!-- Example row of columns -->
    <div data-role="content" dir="rtl">

      <div class="span5">
        <?php
        $path = "http://www.sviva.gov.il/subjectsEnv/SvivaAir/AirQualityData/Pages/EnvAirForecasting.aspx";
        $rawHtml = file_get_contents($path);
        $inx1 = strpos($rawHtml, "bigDivboxGreen1") + 16;
        $inx1 = strpos($rawHtml, "SvivaBlackTitle SvivaFontMedium", $inx1) + 33;
        $inx2 = strpos($rawHtml, "</h2>", $inx1);
        $title = substr($rawHtml, $inx1, $inx2 - $inx1);
        $title = strip_tags($title);
        echo "<h3 dir='rtl'>$title</h3>";

        $inx1 = $inx2;
        $inx2 = strpos($rawHtml, "<!--End Green Box -->", $inx1);

        $airHtml = substr($rawHtml, $inx1, $inx2 - $inx1);
        // ugly ugly code... but I don't have time :)
        $airHtml = strip_tags($airHtml, "<p><a><strong>");
        $airHtml = str_replace("לקראת צהרים", "", $airHtml);
        $airHtml = str_replace("ועד", "", $airHtml);
        $airHtml = str_replace("GovXShortDescription", "", $airHtml);
        $airHtml = str_replace("יום", "<br/><br/>" . "יום", $airHtml);
        $airHtml = str_replace("שעות", "<br/>" . "שעות", $airHtml);
        $airHtml = str_replace("<a href", "<li><a href", $airHtml);
        echo "<div id='airhtml' dir='rtl'>$airHtml </div>";
        ?>
      </div>

      <div class="span5" dir="rtl">
        <p>
          <a href="http://www.svivaaqm.net/Default.rtl.aspx">
            <img src="http://www.svivaaqm.net/Index_Image_Generator.aspx?REGION=-3" 
                 width="360px" height="598px"/>
          </a>
        </p>
      </div>

      <div class="row">
        <div class="span5" dir="rtl">
          <h4 dir="rtl">טמפרטורות</h4>
          <img src="http://www.ims.gov.il/Ims/Map/MapRender.aspx?type=weather&LangId=1&Optional=c&Tab=Temperature">
        </div>
        <div class="span5" dir="rtl">
          <h4 dir="rtl">רוח</h4>
          <img src="http://www.ims.gov.il/Ims/Map/MapRender.aspx?type=weather&LangId=1&Optional=&Tab=Wind">
        </div>
      </div>
      
    </div> <!-- main content -->



    <div data-role="footer">
      <div data-role="navbar" data-iconpos="top">
        <ul>
          <li><a data-icon="grid" href="http://nivut.org.il" target="_blank">האתר הרגיל</a></li>
          <li><a data-icon="forward" href="http://blog.nivut.org.il/" target="_blank">ניווטון </a> </li>
        </ul>
      </div>
    </div>

  </div> <!-- page -->



  <script>
    var _gaq=[['_setAccount','UA-27750723-1'],['_trackPageview']];
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
      g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
      s.parentNode.insertBefore(g,s)}(document,'script'));
  </script>

</body>
</html>
