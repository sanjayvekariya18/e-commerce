<?php
$controller = $this->uri->segment(1);
$m1 = $this->uri->segment(2);
if ($controller != "product") {
    $meta = $this->common->getMetadata($controller, $m1);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php
            if (isset($meta)) {
                echo $meta->title;
            } else if (isset($product)) {
                echo $product->product_name;
            }
            ?></title>        

        <meta name="keywords" content="<?php
        if (isset($meta)) {
            echo $meta->keyword;
        } else if (isset($product)) {
            echo $product->meta_keyword;
        }
        ?>">
        <meta name="description" content="<?php
        if (isset($meta)) {
            echo $meta->description;
        } else if (isset($product)) {
            echo $product->product_desc;
        }
        ?>">  

        <meta property="og:title" content="<?php
        if (isset($meta)) {
            echo $meta->title;
        } else if (isset($product)) {
            echo $product->product_name;
        }
        ?>"/>
        <meta property="og:description" content="<?php
        if (isset($meta)) {
            echo $meta->description;
        } else if (isset($product)) {
            echo $product->product_desc;
        }
        ?>"/>
        <meta property="og:image" content="<?php
        if (isset($meta)) {
            echo base_url() . "assets/images/logo.png";
        } else if (isset($product)) {
            echo $product->image_medium;
        }
        ?>" />        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
              <meta name="viewport" content="width=device-width, initial-scale=1">


        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>webassets/lib/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>webassets/lib/font-awesome/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>webassets/lib/select2/css/select2.min.css" />
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>webassets/lib/jquery.bxslider/jquery.bxslider.css" />
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>webassets/lib/owl.carousel/owl.carousel.css" />
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>webassets/lib/jquery-ui/jquery-ui.css" />
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>webassets/lib/fancyBox/jquery.fancybox.css" />
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>webassets/css/animate.css" />


        <!-- Popup CSS -->
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>webassets/css/popup/css/sm-minified.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>webassets/css/popup/css/demo.css" media="screen" />

        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>webassets/css/reset.css" />
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>webassets/css/style.css" />
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>webassets/css/responsive.css" />
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>webassets/css/own.css" />
        <!-- Alert CSS -->
        <link rel="stylesheet" href="<?= base_url() ?>webassets/css/alertify.core.css">
        <link rel="stylesheet" href="<?= base_url() ?>webassets/css/alertify.default.css">

        <script type="text/javascript" src="<?= base_url() ?>webassets/lib/jquery/jquery-1.11.2.min.js"></script>
        <link rel="shortcut icon" type="image/ico" href="<?= base_url() ?>assets/images/favicon.ico"/>
        <style type="text/css">
            .screenhide{
                position: absolute;
                width: 100%;     
                z-index: 99999;
                opacity: 1;
                background-color: transparent;
                top: 100px;
                height: 1200px
            }
        </style>
    </head>
    <body class="category-page">
        <!-- HEADER -->
        <div id="header" class="header">
            <div class="top-header">
                <div class="container">
                    <div class="nav-top-links">
                        <a class="first-item" href="#"><img alt="phone" src="<?= base_url() ?>webassets/images/phone.png" />0261-6452111</a>
                        <a href="#"><img alt="email" src="<?= base_url() ?>webassets/images/email.png" />info@shopking24.com</a>
                    </div>                    
                    <div class="support-link" id="second">
                        <label style="line-height: 15px;margin-top: 9px;border-right: 1px solid #FFFFFF;">Free Shipping All Over India</label>
                        <a href="<?= site_url() ?>seller">Sell On Shopking24</a>
                        <a href="<?= site_url() ?>services">Services</a>
                        <a href="<?= site_url() ?>support">Support</a>
                        <?php
                        if ($this->session->userdata('customer_primary_email') != "") {
                            ?>
                            <div id="user-info-top" class="user-info pull-right">
                                <div class="dropdown">
                                    <a class="current-open" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"><span><?= $this->session->userdata('customer_username') ?></span></a>
                                    <ul class="dropdown-menu mega_dropdown" role="menu">
                                        <li><a href="<?= site_url() ?>buyer/profile">Profile</a></li>
                                        <li><a href="<?= site_url() ?>buyer/order">Order</a></li>
                                        <li><a href="<?= site_url() ?>buyer/login/logout">Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        <?php } else { ?>
                            <a href="<?= site_url() ?>signup">Sign Up</a> 
                            <label for="section1-p-1">Login</label>
                        <?php } ?>  

                    </div>                    
                </div>
            </div>
            <!--/.top-header -->

            <!-- Section 1 -->
            <input id="section1-p-1" name="section1-p-1" type="checkbox" class="hiddenInput" />
            <div class="slickModals section1-m-1">
                <label for="section1-p-1" class="overlay linear fastest black"></label>
                <div class="window demo-1 center zoomIn ease fast white shadow">
                    <label id="loginclose" for="section1-p-1" class="icon close black"></label>
                    <div class="wrap demo-1">
                        <div class="title">LOGIN</div>
                        <form id="loginform" method="post" action="<?= site_url() ?>buyer/login/checkLogin">
                            <input type="text" name="email" class="field" placeholder="Enter Email Here" /><br/>
                            <input type="password" name="password" class="field" placeholder="Enter Password" />
                            <label id="login" for="section1-p-1">Login</label>   
                            <label for="section2-p-2">Forgot Password</label>
                        </form>
                    </div>
                    <div class="cta demo-1">
                        <a href="<?= site_url() ?>signup">
                            <label style="margin-top: 90px;">Register</label>
                        </a>                        
                    </div>
                </div>
            </div>  

            <input id="section2-p-2" name="section2-p-2" type="checkbox" class="hiddenInput" />
            <div class="slickModals section2-m-2">
                <label for="section2-p-2" class="overlay linear fastest black"></label>
                <div class="window center zoomIn ease fast white shadow">
                    <label for="section2-p-2" class="icon close"></label>
                    <div class="wrap">                        
                        <div class="title">Enter Your Register Email Id!</div>
                        <input id="myemail" type="email" name="myemail" class="field" placeholder="Enter Email Here" style="margin-top: 10px;background-color: white;padding: 10px;width: 300px;text-align: center;"/><br/>
                    </div>
                    <div class="cta">
                        <label id="confirm" for="section2-p-2">Submit</label>
                    </div>
                </div>
            </div>

            <!-- MAIN HEADER -->
            <div class="container main-header">
                <div class="row">
                    <div class="col-xs-12 col-sm-3 logo">
                        <a href="<?= site_url() ?>"><img alt="SHOPKING24" src="<?= base_url() ?>assets/images/logo.png" /></a>
                    </div>
                    <div class="col-xs-7 col-sm-7 header-search-box">
                        <form class="form-inline" method="post" action="<?= site_url() ?>search">
                            <div class="form-group form-category">
                                <select id="search_sub_category_id" class="select-category" name="sub_category_id">
                                    <option value="0">All Categories</option>
                                    <?php
                                    $subcategory = $this->wcommon->getSubcategory();
                                    if (isset($subcategory)) {
                                        foreach ($subcategory as $val) {
                                            ?>
                                            <option value="<?= $val->subcategory_id ?>"
                                            <?php
                                            if (isset($_POST['sub_category_id'])) {
                                                if ($val->subcategory_id == $_POST['sub_category_id']) {
                                                    echo "selected";
                                                }
                                            }
                                            ?>><?= $val->subcategory_name ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                </select>
                            </div>
                            <div class="form-group input-serach">
                                <input id="search_keyword" type="text" name="keyword" placeholder="Keyword here..." value="<?= isset($_POST['keyword']) ? $_POST['keyword'] : '' ?>">
                            </div>
                            <button type="submit" class="pull-right btn-search"></button>
                        </form>
                    </div>
                    <?php
                    $product = $this->wcommon->getCartProduct();
                    if (isset($product) && is_array($product)) {
                        $total = 0;
                        $count = 0;
                        foreach ($product as $val) {
                            $total += $val->selling_price;
                            $count += 1;
                        }
                    }
                    ?>
                    <div id="cart-block" class="col-xs-5 col-sm-2 shopping-cart-box">
                        <a class="cart-link" href="<?= site_url() ?>cart">
                            <span class="title">Shopping cart</span>
                            <span class="total"><?= isset($count) ? $count : 0 ?> items - <i class="fa fa-rupee"></i><?= isset($total) ? $total : 0 ?> </span>
                            <span class="notify notify-left"><?= isset($count) ? $count : 0 ?></span>
                        </a>
                        <div class="cart-block">
                            <div class="cart-block-content">
                                <h5 class="cart-title"><?= isset($count) ? $count : 0 ?> Items in my cart</h5>
                                <div class="cart-block-list">
                                    <ul>
                                        <?php
                                        if (isset($product) && is_array($product)) {
                                            foreach ($product as $val) {
                                                ?>
                                                <li class="product-info">
                                                    <div class="p-left">                                                        
                                                        <a href="#">
                                                            <img class="img-responsive" src="<?= $val->image_thumb ?>" alt="p10">
                                                        </a>
                                                    </div>
                                                    <div class="p-right">
                                                        <p class="p-name"><?= $val->product_name ?></p>
                                                        <p class="p-rice"><i class="fa fa-rupee"></i><?= $val->selling_price ?></p>
                                                        <a id="<?= $val->product_id ?>" href="javascript:void(0)" class="remove_link">Remove</a>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <div class="toal-cart">
                                    <span>Total</span>
                                    <span class="toal-price pull-right"><i class="fa fa-rupee"></i><?= isset($total) ? $total : 0 ?> </span>
                                </div>
                                <div class="cart-buttons">
                                    <a href="<?= site_url() ?>cart" class="btn-check-out">Checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MANIN HEADER -->
            <div id="nav-top-menu" class="nav-top-menu">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3" id="box-vertical-megamenus">
                            <div class="box-vertical-megamenus">
                                <h4 class="title">
                                    <span class="title-menu">Categories</span>
                                    <span class="btn-open-mobile pull-right"><i class="fa fa-bars"></i></span>
                                </h4>
                                <div class="vertical-menu-content is-home" style="height: 500px;overflow-y: auto;">
                                    <ul class="vertical-menu-list">
                                        <?php
                                        $subcategory = $this->wcommon->getSubcategory();
                                        if (isset($subcategory)) {
                                            foreach ($subcategory as $val) {
                                                ?>
                                                <li><a id="<?= $val->subcategory_id ?>" class="categorybox" href="#"><img class="icon-menu" alt="<?= $val->subcategory_name ?>" src="<?= base_url() ?>webassets/data/1.png"><?= $val->subcategory_name ?></a></li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>                                    
                                </div>
                            </div>
                        </div>
                        <div id="main-menu" class="col-sm-9 main-menu">
                            <nav class="navbar navbar-default">
                                <div class="container-fluid">
                                    <div class="navbar-header">
                                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                            <i class="fa fa-bars"></i>
                                        </button>
                                        <a class="navbar-brand" href="#">MENU</a>
                                    </div>
                                    <div id="navbar" class="navbar-collapse collapse">
                                        <ul class="nav navbar-nav">
                                            <li class="active"><a href="<?= site_url() ?>">Home</a></li>                                            
                                            <li class="dropdown">
                                                <a href="<?= site_url() ?>womens/sarees" class="dropdown-toggle" data-toggle="dropdown">Sarees</a>
                                                <ul class="dropdown-menu mega_dropdown" role="menu" style="width: 850px;">
                                                    <li class="block-container col-sm-2">
                                                        <ul class="block">                                                            
                                                            <li class="link_container group_header">
                                                                <a href="#">Type</a>
                                                            </li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=206">Bollywood</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=209">Bollywood Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=212">Daily-use</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=213">Decorative Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=221">Party Saree</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="block-container col-sm-2">
                                                        <ul class="block">
                                                            <li class="link_container group_header">
                                                                <a href="#">Occasion</a>
                                                            </li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=251">Bridal</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=252">Casual</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=253">Ceremonial</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=254">Festival</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=255">Party</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=256">Reception</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=257">Wedding</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="block-container col-sm-2">
                                                        <ul class="block">                                                            
                                                            <li class="link_container group_header">
                                                                <a href="#">Fabric</a>
                                                            </li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=124">American Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=125">Art Silk Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=126">Banarasi Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=127">Bemberg Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=129">Bhagalpuri Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=131">Brasso Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=134">Chanderi Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=135">Chiffon Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=136">Cotton Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=138">Dhupian Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=141">Georgette Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=144">Kalkatti Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=146">Linen Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=149">Net Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=158">Silk Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=162">Velvet Saree</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="block-container col-sm-3">
                                                        <ul class="block">                                                            
                                                            <li class="link_container group_header">
                                                                <a href="#">Pattern</a>
                                                            </li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=228">Aari Work Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=229">Bandhej Print Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=231">Diamond Work Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=232">Embroidered Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=233">Hand Work Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=235">Karachi Work Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=237">Kasab Work Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=238">Khatli Work Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=239">Lace Work Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=241">Moti Work Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=243">Patch Work Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=244">Print Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=246">Sequence Work Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=247">Stone Work Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=249">Zardosi Work Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=250">Zari Work Saree</a></li>
                                                        </ul>
                                                    </li>                                                    
                                                    <li class="block-container col-sm-2">
                                                        <ul class="block">                                                            
                                                            <li class="link_container group_header">
                                                                <a href="#">Blouse Fabric</a>
                                                            </li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=98">Banarasi</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=99">Bhagalpuri</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=100">Brasso</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=101">Brocade</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=102">Chiffon</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=103">Cotton</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=104">Crape</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=105">Dhupian</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=107">Georgette</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=108">Jacquard</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=109">Linen</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=111">Net</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=115">Silk</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=117">Velvet</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a href="<?= site_url() ?>womens/kurtis">Kurtis</a></li>
                                            <li class="dropdown">
                                                <a href="<?= site_url() ?>womens/dressMaterial" class="dropdown-toggle" data-toggle="dropdown">Dress Material</a>
                                                <ul class="dropdown-menu mega_dropdown" role="menu" style="width: 830px;">
                                                    <li class="block-container col-sm-3">
                                                        <ul class="block">                                                            
                                                            <li class="link_container group_header">
                                                                <a href="#">Type</a>
                                                            </li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=204">Anarkali Suit</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=205">Birthday</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=206">Bollywood</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=207">Bollywood Anarkali Suits</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=212">Daily-use</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=213">Decorative</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=215">Festival</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=216">Floating</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=219">Lehenga Suits</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=221">Party</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=222">Salwar Suit</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=224">Semi Stitched Anarkali suit</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=227">Western Dress</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="block-container col-sm-3">
                                                        <ul class="block">                                                            
                                                            <li class="link_container group_header">
                                                                <a href="#">Fabric</a>
                                                            </li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=124">American</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=125">Art Silk</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=126">Banarasi </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=127">Bemberg </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=129">Bhagalpuri </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=131">Brasso </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=134">Chanderi </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=135">Chiffon </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=136">Cotton </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=138">Dhupian </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=141">Georgette </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=144">Kalkatti </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=146">Linen </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=149">Net </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=158">Silk </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=162">Velvet </a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="block-container col-sm-3">
                                                        <ul class="block">                                                            
                                                            <li class="link_container group_header">
                                                                <a href="#">Pattern</a>
                                                            </li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=228">Aari Work </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=229">Bandhej Print </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=231">Diamond Work </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=232">Embroidered </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=233">Hand Work </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=235">Karachi Work </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=237">Kasab Work </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=238">Khatli Work </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=239">Lace Work </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=241">Moti Work </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=243">Patch Work </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=244">Print </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=246">Sequence Work </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=247">Stone Work </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=249">Zardosi Work </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=250">Zari Work </a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="block-container col-sm-3">
                                                        <ul class="block">
                                                            <li class="link_container group_header">
                                                                <a href="#">Occasion</a>
                                                            </li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=251">Bridal</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=252">Casual</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=253">Ceremonial</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=254">Festival</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=255">Party</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=256">Reception</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=257">Wedding</a></li>
                                                        </ul>
                                                    </li>                                                    
                                                </ul>
                                            </li>                                            
                                            <li class="dropdown">
                                                <a href="<?= site_url() ?>womens/salwarKurta" class="dropdown-toggle" data-toggle="dropdown">Salwar Kurta</a>
                                                <ul class="dropdown-menu mega_dropdown" role="menu" style="width: 830px;left: 180px;">
                                                    <li class="block-container col-sm-3">
                                                        <ul class="block">                                                            
                                                            <li class="link_container group_header">
                                                                <a href="#">Type</a>
                                                            </li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=204">Anarkali Suit</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=205">Birthday</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=206">Bollywood</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=207">Bollywood Anarkali Suits</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=210">Candle Holder</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=211">Container</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=213">Decorative</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=215">Festival</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=216">Floating</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=221">Party</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=222">Salwar Suit</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=224">Semi Stitched Anarkali suit</a></li>

                                                        </ul>
                                                    </li>
                                                    <li class="block-container col-sm-3">
                                                        <ul class="block">                                                            
                                                            <li class="link_container group_header">
                                                                <a href="#">Fabric</a>
                                                            </li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=124">American </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=125">Art Silk </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=126">Banarasi </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=127">Bemberg </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=129">Bhagalpuri </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=131">Brasso </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=134">Chanderi </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=135">Chiffon </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=136">Cotton </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=138">Dhupian </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=141">Georgette </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=144">Kalkatti </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=146">Linen </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=149">Net </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=158">Silk </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=162">Velvet </a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="block-container col-sm-3">
                                                        <ul class="block">                                                            
                                                            <li class="link_container group_header">
                                                                <a href="#">Pattern</a>
                                                            </li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=228">Aari Work </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=229">Bandhej Print </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=231">Diamond Work </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=232">Embroidered </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=233">Hand Work </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=235">Karachi Work </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=237">Kasab Work </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=238">Khatli Work </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=239">Lace Work </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=241">Moti Work </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=243">Patch Work </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=244">Print </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=246">Sequence Work </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=247">Stone Work </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=249">Zardosi Work </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=250">Zari Work </a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="block-container col-sm-3">
                                                        <ul class="block">
                                                            <li class="link_container group_header">
                                                                <a href="#">Occasion</a>
                                                            </li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=251">Bridal</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=252">Casual</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=253">Ceremonial</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=254">Festival</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=255">Party</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=256">Reception</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/salwarKurta?id=257">Wedding</a></li>
                                                        </ul>
                                                    </li> 
                                                </ul>
                                            </li> 
                                            <li class="dropdown">
                                                <a href="<?= site_url() ?>womens/lehengaCholis" class="dropdown-toggle" data-toggle="dropdown">Lehenga Cholis</a>
                                                <ul class="dropdown-menu mega_dropdown" role="menu" style="width: 830px;left: 400px;">
                                                    <li class="block-container col-sm-3">
                                                        <ul class="block">                                                            
                                                            <li class="link_container group_header">
                                                                <a href="#">Type</a>
                                                            </li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=206">Bollywood</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=208">Bollywood Lahenga Choli</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=212">Daily-use</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=213">Decorative</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=215">Festival</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=219">Lahenga Suits</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=221">Party</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="block-container col-sm-3">
                                                        <ul class="block">                                                            
                                                            <li class="link_container group_header">
                                                                <a href="#">Fabric</a>
                                                            </li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=124">American </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=125">Art Silk </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=126">Banarasi </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=127">Bemberg </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=129">Bhagalpuri </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=131">Brasso </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=134">Chanderi </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=135">Chiffon </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=136">Cotton </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=138">Dhupian </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=141">Georgette </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=144">Kalkatti </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=146">Linen </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=149">Net </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=158">Silk </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=162">Velvet </a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="block-container col-sm-3">
                                                        <ul class="block">                                                            
                                                            <li class="link_container group_header">
                                                                <a href="#">Pattern</a>
                                                            </li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=228">Aari Work </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=229">Bandhej Print </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=231">Diamond Work </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=232">Embroidered </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=233">Hand Work </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=235">Karachi Work </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=237">Kasab Work </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=238">Khatli Work </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=239">Lace Work </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=241">Moti Work </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=243">Patch Work </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=244">Print </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=246">Sequence Work </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=247">Stone Work </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=249">Zardosi Work </a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=250">Zari Work </a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="block-container col-sm-3">
                                                        <ul class="block">
                                                            <li class="link_container group_header">
                                                                <a href="#">Occasion</a>
                                                            </li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=251">Bridal</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=252">Casual</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=253">Ceremonial</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=254">Festival</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=255">Party</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=256">Reception</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=257">Wedding</a></li>
                                                        </ul>
                                                    </li> 
                                                </ul>
                                            </li>
                                            <!--<li><a href="<?= site_url() ?>womens/abayas">Abayas</a></li>-->
                                            <li><a href="<?= site_url() ?>womens/gowns">Gowns</a></li>
                                            <li><a href="<?= site_url() ?>womens/jewellery">Jewellery</a></li>
                                            <li><a href="<?= site_url() ?>womens/leggings">Leggings</a></li>
                                        </ul>
                                    </div><!--/.nav-collapse -->
                                </div>
                            </nav>
                        </div>
                    </div>
                    <!-- userinfo on top-->
                    <div id="form-search-opntop">
                    </div>
                    <!-- userinfo on top-->
                    <div id="user-info-opntop">
                    </div>
                    <!-- CART ICON ON MMENU -->
                    <div id="shopping-cart-box-ontop">
                        <i class="fa fa-shopping-cart"></i>
                        <div class="shopping-cart-box-ontop-content"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="screenhide" style="display:none">
            <center>
                <img src="<?= base_url() ?>assets/images/loading_pink.gif" style="margin-top: 50px;width: 250px;height: 250px"/>
                <h3 class="page-heading-title2" style="color:#FF3366;font-size: 28px;margin-top: 110px">Please Wait ..!!! We Are Sending New Password By Email and Sms.</h3>
            </center>
        </div>
        <!-- end header -->

        <script type="text/javascript">
            $(document).ready(function() {
                $('#login').click(function() {
                    $('#loginform').submit();
                });
                $('.remove_link').click(function() {
                    $product_id = $(this).attr('id');
                    $.ajax({
                        url: "<?= site_url() ?>session/removeProduct",
                        type: 'POST',
                        data: {'product_id': $product_id},
                        success: function(data, textStatus, jqXHR) {
                            location.reload(true);
                        }
                    });
                });

                $('#confirm').click(function() {
                    $('#loginclose').trigger('click');
                    $email_id = $('#myemail').val();
                    if ($email_id != "") {
                        $('.screenhide').css('display', 'block');
                        $.ajax({
                            url: '<?= site_url() ?>reset/customer',
                            type: 'post',
                            data: {'email_id': $email_id},
                            success: function(data, textStatus, jqXHR) {
                                if (data == 1) {
                                    alertify.error("New Password Send To Register Email.");
                                    $('.screenhide').css('display', 'none');
                                } else {
                                    alertify.error("Email Id Not Register");
                                    $('.screenhide').css('display', 'none');
                                }
                            }
                        });
                    }
                });

                $('.categorybox').click(function() {
                    $category_id = $(this).attr('id');
                    if ($category_id == '1') {
                        window.location.href = "<?= site_url() ?>womens/bollywood";
                    } else if ($category_id == '2') {
                        window.location.href = "<?= site_url() ?>womens/dressMaterial";
                    } else if ($category_id == '3') {
                        window.location.href = "<?= site_url() ?>womens/gowns";
                    } else if ($category_id == '4') {
                        window.location.href = "<?= site_url() ?>womens/sarees";
                    } else if ($category_id == '5') {
                        window.location.href = "<?= site_url() ?>womens/salwarKurta";
                    } else if ($category_id == '6') {
                        window.location.href = "<?= site_url() ?>womens/lehengaCholis";
                    } else if ($category_id == '7') {
                        window.location.href = "<?= site_url() ?>womens/kurtis";
                    } else if ($category_id == '8') {
                        window.location.href = "<?= site_url() ?>womens/ethnicBottoms";
                    } else if ($category_id == '9') {
                        window.location.href = "<?= site_url() ?>womens/ethnicSets";
                    } else if ($category_id == '10') {
                        window.location.href = "<?= site_url() ?>womens/dupattas";
                    } else if ($category_id == '11') {
                        window.location.href = "<?= site_url() ?>womens/blouses";
                    } else if ($category_id == '12') {
                        window.location.href = "<?= site_url() ?>womens/abayas";
                    } else if ($category_id == '13') {
                        window.location.href = "<?= site_url() ?>womens/petticoats";
                    } else if ($category_id >= '16' && $category_id <= '58') {
                        window.location.href = "<?= site_url() ?>womens/jewellery?cid=" + $category_id;
                    } else if ($category_id == '59') {
                        window.location.href = "<?= site_url() ?>womens/leggings";
                    }
                });
            });
        </script>


