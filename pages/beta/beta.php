<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="_nK">
    <title><?= $ServerName;?> | Coming Soon</title>
    <link rel="icon" type="image/png" href="assets/images/favicon.png">

	<base href="/" />
	
    <!-- START: Styles -->

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300i,400,700%7cMarcellus+SC" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="assets/bower_components/fontawesome/css/font-awesome.min.css">

    <!-- IonIcons -->
    <link rel="stylesheet" href="assets/bower_components/ionicons/css/ionicons.min.css">

    <!-- Revolution Slider -->
    <link rel="stylesheet" type="text/css" href="assets/plugins/revolution/css/settings.css">
    <link rel="stylesheet" type="text/css" href="assets/plugins/revolution/css/layers.css">
    <link rel="stylesheet" type="text/css" href="assets/plugins/revolution/css/navigation.css">

    <!-- Flickity -->
    <link rel="stylesheet" href="assets/bower_components/flickity/dist/flickity.min.css">

    <!-- Photoswipe -->
    <link rel="stylesheet" type="text/css" href="assets/bower_components/photoswipe/dist/photoswipe.css">
    <link rel="stylesheet" type="text/css" href="assets/bower_components/photoswipe/dist/default-skin/default-skin.css">

    <!-- DateTimePicker -->
    <link rel="stylesheet" type="text/css" href="assets/bower_components/datetimepicker/build/jquery.datetimepicker.min.css">

    <!-- Revolution Slider -->
    <link rel="stylesheet" type="text/css" href="assets/plugins/revolution/css/settings.css">
    <link rel="stylesheet" type="text/css" href="assets/plugins/revolution/css/layers.css">
    <link rel="stylesheet" type="text/css" href="assets/plugins/revolution/css/navigation.css">

    <!-- Prism -->
    <link rel="stylesheet" type="text/css" href="assets/bower_components/prism/themes/prism-tomorrow.css">

    <!-- Summernote -->
    <link rel="stylesheet" type="text/css" href="assets/bower_components/summernote/dist/summernote.css">

    <!-- GODLIKE -->
    <link rel="stylesheet" href="assets/css/godlike.css">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- END: Styles -->

    <!-- jQuery -->
    <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>



</head>


<!--
    Additional Classes:
        .nk-page-boxed
-->

<body>
    <!-- START: Page Preloader -->
    <div class="nk-preloader">
        <!--
         Preloader animation
         data-close-... data used for closing preloader
         data-open-...  data used for opening preloader
    -->
        <div class="nk-preloader-bg" style="background-color: #000;" data-close-frames="23" data-close-speed="1.2" data-close-sprites="./assets/images/preloader-bg.png" data-open-frames="23" data-open-speed="1.2" data-open-sprites="./assets/images/preloader-bg-bw.png">
        </div>

         <div class="nk-preloader-content">
            <div>
                <span class="nk-title display-3"><?= $ServerName; ?></span>
                <div class="nk-preloader-animation"></div>
            </div>
        </div>

        <div class="nk-preloader-skip">Skip</div>
    </div>
    <!-- END: Page Preloader -->


    <!-- START: Page Background -->
    <div class="nk-page-background op-5" data-bg-mp4="assets/video/bg-2.mp4" data-bg-webm="assets/video/bg-2.webm" data-bg-ogv="assets/video/bg-2.ogv" data-bg-poster="assets/video/bg-2.jpg"></div>
    <!-- END: Page Background -->



    <!-- START: Page Border -->
    <div class="nk-page-border">
        <div class="nk-page-border-t"></div>
        <div class="nk-page-border-r"></div>
        <div class="nk-page-border-b"></div>
        <div class="nk-page-border-l"></div>
    </div>
    <!-- END: Page Border -->







    <!--
    Additional Classes:
        .nk-header-opaque
-->
    <header class="nk-header nk-header-opaque">

    </header>
	
    <div class="nk-main">

        <div class="nk-header-title nk-header-title-full nk-header-title-parallax-opacity">
            <div class="bg-image">
			    <? $ImageURL = array_rand(($SliderImages), 2);?>
                <div style="background-image: url('<?= $SliderImages[$ImageURL[0]];?>');" class="op-4"></div>
            </div>
            <div class="nk-header-table">
                <div class="nk-header-table-cell">
                    <div class="container">




                        <div class="nk-header-text">

                            <div class="nk-gap-4"></div>
                            <div class="container">
                                <div class="text-xs-center">
                                    <h1 class="nk-title display-4"><?= $ServerName;?></h1>
                                    <div class="nk-title-sep-icon">
                                        <span class="icon">
                                            <span class="ion-clock"></span>
                                        </span>
                                    </div>
                                    <div class="nk-gap-2"></div>

                                    <div class="row">
                                        <div class="col-md-8 offset-md-2">
                                            <h4>
											<span class="db hidden-sm-up"></span>
											<span class="nk-typed" data-loop="true" data-shuffle="false" data-cursor="false" data-type-speed="90" data-start-delay="0" data-back-speed="60" data-back-delay="1000">
												<span class="lead">You don't get to be great without a victory...</span>
												<span class="lead">Wait us, We are comming very soon...</span>
											</span>
											</h4>
                                            <div class="nk-gap-2"></div>
                                            <div class="nk-countdown" data-end="<?= $BetaEndDate;?>" data-timezone="EST"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="nk-gap-4"></div>

                        </div>


                    </div>
                </div>
            </div>

        </div>
        <!-- END: Header Title -->
    </div>


    <!-- START: Scripts -->

    <!-- GSAP -->
    <script src="assets/bower_components/gsap/src/minified/TweenMax.min.js"></script>
    <script src="assets/bower_components/gsap/src/minified/plugins/ScrollToPlugin.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/bower_components/tether/dist/js/tether.min.js"></script>
    <script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Sticky Kit -->
    <script src="assets/bower_components/sticky-kit/dist/sticky-kit.min.js"></script>

    <!-- Jarallax -->
    <script src="assets/bower_components/jarallax/dist/jarallax.min.js"></script>
    <script src="assets/bower_components/jarallax/dist/jarallax-video.min.js"></script>

    <!-- Flickity -->
    <script src="assets/bower_components/flickity/dist/flickity.pkgd.min.js"></script>

    <!-- Isotope -->
    <script src="assets/bower_components/isotope/dist/isotope.pkgd.min.js"></script>

    <!-- Photoswipe -->
    <script src="assets/bower_components/photoswipe/dist/photoswipe.min.js"></script>
    <script src="assets/bower_components/photoswipe/dist/photoswipe-ui-default.min.js"></script>

    <!-- Typed.js -->
    <script src="assets/bower_components/typed.js/dist/typed.min.js"></script>

    <!-- Jquery Form -->
    <script src="assets/bower_components/jquery-form/jquery.form.js"></script>

    <!-- Jquery Validation -->
    <script src="assets/bower_components/jquery-validation/dist/jquery.validate.min.js"></script>

    <!-- Jquery Countdown + Moment -->
    <script src="assets/bower_components/jquery.countdown/dist/jquery.countdown.min.js"></script>
    <script src="assets/bower_components/moment/min/moment.min.js"></script>
    <script src="assets/bower_components/moment-timezone/builds/moment-timezone-with-data.js"></script>

    <!-- Hammer.js -->
    <script src="assets/bower_components/hammer.js/hammer.min.js"></script>

    <!-- nK Share -->
    <script src="assets/plugins/nk-share/nk-share.js"></script>

    <!-- NanoSroller -->
    <script src="assets/bower_components/nanoscroller/bin/javascripts/jquery.nanoscroller.min.js"></script>

    <!-- SoundManager2 -->
    <script src="assets/bower_components/SoundManager2/script/soundmanager2-nodebug-jsmin.js"></script>

    <!-- DateTimePicker -->
    <script src="assets/bower_components/datetimepicker/build/jquery.datetimepicker.full.min.js"></script>

    <!-- Revolution Slider -->
    <script type="text/javascript" src="assets/plugins/revolution/js/jquery.themepunch.tools.min.js"></script>
    <script type="text/javascript" src="assets/plugins/revolution/js/jquery.themepunch.revolution.min.js"></script>
    <script type="text/javascript" src="assets/plugins/revolution/js/extensions/revolution.extension.video.min.js"></script>
    <script type="text/javascript" src="assets/plugins/revolution/js/extensions/revolution.extension.carousel.min.js"></script>
    <script type="text/javascript" src="assets/plugins/revolution/js/extensions/revolution.extension.navigation.min.js"></script>

    <!-- Keymaster -->
    <script src="assets/bower_components/keymaster/keymaster.js"></script>

    <!-- Summernote -->
    <script src="assets/bower_components/summernote/dist/summernote.min.js"></script>

    <!-- Prism -->
    <script src="assets/bower_components/prism/prism.js"></script>

    <!-- GODLIKE -->
    <script src="assets/js/godlike.min.js"></script>
    <script src="assets/js/godlike-init.js"></script>
    <!-- END: Scripts -->



</body>

</html>