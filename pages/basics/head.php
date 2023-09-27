<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="assets/images/favicon.png">
	<base href="/" />
    <!---->
	<title><?=$ServerName; ?> &#8211; <?= $TopTitle; ?></title>
    <!-- START: Styles -->

	

    <!-- JQuery UI -->
    <link rel="stylesheet" href="assets/css/jquery-ui.css" type="text/css"/>

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
    <link rel="stylesheet" href="assets/css/godlike.min.css">
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
				 <p>Loading, Please wait.
					<span class="db hidden-sm-up"></span>
			     </p>
                <div class="nk-preloader-animation"></div>
            </div>
        </div>

        <div class="nk-preloader-skip">Skip</div>
    </div>
    <!-- END: Page Preloader -->


    <!-- START: Page Background -->
    <div class="nk-page-background op-5" data-bg-mp4="assets/video/bg-1.mp4" data-bg-webm="assets/video/bg-1.webm" data-bg-ogv="assets/video/bg-1.ogv" data-bg-poster="assets/video/bg-1.jpg"></div>
    <!-- END: Page Background -->



    <!-- START: Page Border -->
    <div class="nk-page-border">
        <div class="nk-page-border-t"></div>
        <div class="nk-page-border-r"></div>
        <div class="nk-page-border-b"></div>
        <div class="nk-page-border-l"></div>
    </div>
    <!-- END: Page Border -->
	<header class="nk-header nk-header-opaque">

	<!--Notifications-->
	<div id="Notifications"></div>