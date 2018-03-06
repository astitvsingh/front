<?php
    $language = '';
    $language = Minds\Core\Di\Di::_()->get('I18n')->getLanguage() ?: 'en';
?>

<?php
    if (!defined('__MINDS_CONTEXT__')) {
        define('__MINDS_CONTEXT__', 'app');
    }
?>
<html>
  <head>
    <base href="/" />

    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="<?php echo Minds\Core\Config::_()->get('cdn_url') ?>assets/logos/bulb.svg" />
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <?php
      $meta = Minds\Core\SEO\Manager::get();
      foreach($meta as $name => $content){
        $name = strip_tags($name);
        $content = str_replace(['"'], '\'', $content);
        switch($name){
          case "title":
            echo "<title>$content</title>\n";
            break;
          case strpos($name, "smartbanner") !== FALSE:
            echo "<meta name=\"$name\" content=\"$content\">\n";
            break;
          case strpos($name, ":") !== FALSE:
            echo "<meta property=\"$name\" content=\"$content\">\n";
            break;
          default:
            echo "<meta name=\"$name\" content=\"$content\">\n";
        }
      }
    ?>


    <link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.1.2/material.blue_grey-amber.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700,800'>
    <script src="//storage.googleapis.com/code.getmdl.io/1.1.2/material.min.js"></script>
    <!-- inject:css -->
    <!-- endinject -->

    <script>
      var ua = window.navigator.userAgent;
      if(ua.indexOf("MSIE") > -1 ||
        (ua.indexOf("Android 4.3") > -1 && !(ua.indexOf('Chrome') > -1)) //android 4.3, but not chrome browser
        ){
          window.location.href = window.location.href.replace('<?= Minds\Core\Config::_()->get('site_url') ?>', 'https://www.minds.com/not-supported');
      }
    </script>

  </head>
  <body>


    <?php if (__MINDS_CONTEXT__ === 'embed'): ?>
        <!-- The embed component created in embed.ts -->
        <minds-embed></minds-embed>
    <?php else: ?>
        <!-- The app component created in app.ts -->
        <m-app class="">
          <div class="mdl-progress mdl-progress__indeterminate initial-loading is-upgraded">
            <div class="progressbar bar bar1" style="width: 0%;"></div>
            <div class="bufferbar bar bar2" style="width: 100%;"></div>
            <div class="auxbar bar bar3" style="width: 0%;"></div>
          </div>

          <div class="m-initial-loading-centred" style="width:100%; text-align:center; margin: 100px auto;">
            <div class="mdl-spinner mdl-spinner--single-color mdl-js-spinner is-active is-upgraded" style="width: 64px;height: 64px;" data-upgraded=",MaterialSpinner">
              <div class="mdl-spinner__layer mdl-spinner__layer-1">
                <div class="mdl-spinner__circle-clipper mdl-spinner__left">
                  <div class="mdl-spinner__circle"></div>
                </div><div class="mdl-spinner__gap-patch"><div class="mdl-spinner__circle"></div></div><div class="mdl-spinner__circle-clipper mdl-spinner__right"><div class="mdl-spinner__circle"></div></div>
              </div>
              <div class="mdl-spinner__layer mdl-spinner__layer-2">
                <div class="mdl-spinner__circle-clipper mdl-spinner__left">
                  <div class="mdl-spinner__circle"></div>
                </div><div class="mdl-spinner__gap-patch"><div class="mdl-spinner__circle"></div></div><div class="mdl-spinner__circle-clipper mdl-spinner__right"><div class="mdl-spinner__circle"></div></div>
              </div>
              <div class="mdl-spinner__layer mdl-spinner__layer-3">
                <div class="mdl-spinner__circle-clipper mdl-spinner__left">
                  <div class="mdl-spinner__circle"></div>
                </div><div class="mdl-spinner__gap-patch"><div class="mdl-spinner__circle"></div></div><div class="mdl-spinner__circle-clipper mdl-spinner__right"><div class="mdl-spinner__circle"></div></div>
              </div>
              <div class="mdl-spinner__layer mdl-spinner__layer-4">
                <div class="mdl-spinner__circle-clipper mdl-spinner__left">
                  <div class="mdl-spinner__circle"></div>
                </div><div class="mdl-spinner__gap-patch"><div class="mdl-spinner__circle"></div></div><div class="mdl-spinner__circle-clipper mdl-spinner__right"><div class="mdl-spinner__circle"></div></div>
              </div>
            </div>
          </div>
        </m-app>
    <?php endif; ?>


      <script>
      // Fixes undefined module function in SystemJS bundle
      function module() {}
          </script>

    <!-- shims:js -->
    <!-- endinject -->

    <!-- libs:js -->
    <!-- endinject -->

    <!-- Google Analytics -->
      <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
              m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      </script>
    <!-- End Google Analytics -->
    <script src="https://cdn.tinymce.com/4/tinymce.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script>
      <?php
          $minds = [
              "MindsContext" => __MINDS_CONTEXT__,
              "LoggedIn" => Minds\Core\Session::isLoggedIn() ? true : false,
              "Admin" => Minds\Core\Session::isAdmin() ? true : false,
              "cdn_url" => Minds\Core\Config::_()->get('cdn_url') ?: Minds\Core\Config::_()->cdn_url,
              "cdn_assets_url" => Minds\Core\Config::_()->get('app_cdn_url'),
              "site_url" => Minds\Core\Config::_()->get('site_url') ?: Minds\Core\Config::_()->site_url,
              "socket_server" => Minds\Core\Config::_()->get('sockets-server-uri') ?: 'ha-socket-io-us-east-1.minds.com:3030',
              "navigation" => Minds\Core\Navigation\Manager::export(),
              "thirdpartynetworks" => Minds\Core\Di\Di::_()->get('ThirdPartyNetworks\Manager')->availableNetworks(),
              'language' => $language,
              "categories" => Minds\Core\Config::_()->get('categories') ?: [],
              "stripe_key" => Minds\Core\Config::_()->get('payments')['stripe']['public_key'],
              "recaptchaKey" => Minds\Core\Config::_()->get('google')['recaptcha']['site_key'],
              "max_video_length" => Minds\Core\Config::_()->get('max_video_length'),
              "features" => (object) (Minds\Core\Config::_()->get('features') ?: []),
              "blockchain" => (object) Minds\Core\Di\Di::_()->get('Blockchain\Manager')->getPublicSettings()
          ];

          if(Minds\Core\Session::isLoggedIn()){
              $minds['user'] = Minds\Core\Session::getLoggedinUser()->export();
              $minds['user']['rewards'] = !!Minds\Core\Session::getLoggedinUser()->getPhoneNumberHash();
              $minds['wallet'] = array('balance' => Minds\Helpers\Counters::get(Minds\Core\Session::getLoggedinUser()->guid, 'points', false));
          }

          if (__MINDS_CONTEXT__ === 'embed') {
              $minds['MindsEmbed'] = $embedded_entity;
          }
      ?>
      window.Minds = <?= json_encode($minds) ?>;
    </script>

    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  </body>
</html>