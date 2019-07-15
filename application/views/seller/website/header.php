<!DOCTYPE html>
<?php
$controller = $this->uri->segment(1);
$m1 = $this->uri->segment(2);
$meta = $this->common->getMetadata($controller, $m1);
?>
<html lang="en">   
    <head>
        <title><?= (isset($meta)) ? $meta->title : "" ?></title>
        <meta charset="UTF-8">
        <meta name="keywords" content="<?= isset($meta) ? $meta->keyword : "" ?>">
        <meta name="description" content="<?= isset($meta) ? $meta->description : "" ?>">        

        <meta property="og:title" content="<?= (isset($meta)) ? $meta->title : "" ?>"/>
        <meta property="og:description" content="<?= isset($meta) ? $meta->description : "" ?>" />
        <meta property="og:image" content="<?= base_url() ?>assets/images/logo.png" />
        <meta name="copyright" content="2015, www.Laxmisoft.net"> 
        <meta http-equiv="Content-language" content="en-US"> 
        <meta name="rating" content="General"> 
        <meta name="author" content="Laxmisoft Technologies Pvt Ltd - www.www.Laxmisoft.net."> 
        <meta name="resource-type" content="document"> 
        <meta name="revisit-after" content="7 days">
        <meta name="Distribution" content="global">
        <meta name="robots" content="index, follow">
        <meta name="googlebot" content="index, follow">
        <meta name="msnbot" content="index, follow" />
        <meta name="yahoobot" content="index, follow" />
        <meta name="organization" content=""Laxmisoft - "Laxmisoft.">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?= base_url() ?>sellerassets/stylesheets/menu.css">

        <!-- CSS ================================================== -->
        <link rel="stylesheet" href="<?= base_url() ?>sellerassets/stylesheets/menu.css">
        <link rel="stylesheet" href="<?= base_url() ?>sellerassets/stylesheets/flat-ui-slider.css">
        <link rel="stylesheet" href="<?= base_url() ?>sellerassets/stylesheets/base.css">
        <link rel="stylesheet" href="<?= base_url() ?>sellerassets/stylesheets/skeleton.css">
        <link rel="stylesheet" href="<?= base_url() ?>sellerassets/stylesheets/landings.css">
        <link rel="stylesheet" href="<?= base_url() ?>sellerassets/stylesheets/main.css">
        <link rel="stylesheet" href="<?= base_url() ?>sellerassets/stylesheets/landings_layouts.css">
        <link rel="stylesheet" href="<?= base_url() ?>sellerassets/stylesheets/box.css">
        <link rel="stylesheet" href="<?= base_url() ?>sellerassets/stylesheets/pixicon.css">

        <!-- Alert CSS -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/alertify.core.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/alertify.default.css">
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
            <![endif]-->
        <!-- Favicons
        ================================================== -->
        <link rel="shortcut icon" type="image/ico" href="<?= base_url() ?>assets/images/favicon.ico"/>
        <link rel="apple-touch-icon" href="images/apple-touch-icon.html">
        <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.html">
        <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.html">
        <style type="text/css">
            .screenhide{
                position: absolute;
                width: 100%;        
                z-index: 99999;
                opacity: 1;
                background-color: transparent;
                top: 100px;
            }
        </style>
    </head>
    <body>
        <div class="pixfort_normal_1" id="section_header_3_dark">
            <div class="header_style header_nav_1 dark pix_builder_bg">
                <div class="container">
                    <div class="sixteen columns firas2">
                        <nav role="navigation" class="navbar navbar-white navbar-embossed navbar-lg pix_nav_1">
                            <div class="containerss">
                                <div class="navbar-header">
                                    <button data-target="#navbar-collapse-02" data-toggle="collapse" class="navbar-toggle" type="button">
                                        <span class="sr-only">Toggle navigation</span>
                                    </button>
                                    <img src="<?= base_url() ?>assets/images/sellerlogo.png" class="pix_nav_logo" alt="" style="height: 45px;width:180px">                
                                </div>
                                <div id="navbar-collapse-02" class="collapse navbar-collapse">
                                    <ul class="nav navbar-nav navbar-right">
                                        <li class="propClone"><a href="<?= site_url() ?>seller">Home</a></li>
                                        <li class="propClone"><a href="<?= site_url() ?>seller/seller-benefits">Benefits</a></li>
                                        <li class="propClone"><a href="<?= site_url() ?>seller/seller-contact">Contact Us</a></li>
                                        <li class="propClone"><a href="<?= site_url() ?>seller/seller-faq">FAQs</a></li>
                                        <li class="propClone"><a class="" href="#popup_6"><span class="pix_header_button pix_builder_bg">Login</span></a></li>
                                    </ul>
                                </div><!-- /.navbar-collapse -->
                            </div><!-- /.container -->
                        </nav>
                    </div>
                </div><!-- container -->
            </div>
        </div>