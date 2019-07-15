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
            }
        </style>
    </head>
    <body class="category-page">
        <!-- HEADER -->
        <div id="header" class="header">
            <div class="top-header full-top-header">
                <div class="container">
                    <div class="nav-top-links">
                        <!--<a class="first-item" href="#"><img alt="phone" src="<?= base_url() ?>webassets/images/phone.png" />0261-6452111 | Whatsapp 9723363347 </a>-->
                        <a class="first-item" href="#"><img alt="phone" src="<?= base_url() ?>webassets/images/phone.png" />Whatsapp 9723363347</a>
                        <a href="#"><img alt="email" src="<?= base_url() ?>webassets/images/email.png" />info@shopking24.com</a>
                    </div>                    
                    <div class="support-link" id="second">
                        <a href="<?= site_url() ?>track/order">Track Order</a>
                        <label style="line-height: 19px;margin-top: 9px;border-right: 1px solid #FFFFFF;">Free Shipping All Over India</label>
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
            <div class="top-header mobile-top-header">
                <div class="container">                                        
                    <div class="support-link" id="second" style="text-align: right;">
                        <a href="<?= site_url() ?>track/order">Track Order</a>
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
                        <div id="main-menu" class="col-sm-12 main-menu">
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
                                                <a href="<?= site_url() ?>womens/sarees" class="dropdown-toggle full-layout-link " data-toggle="dropdown">Sarees</a>
                                                <a href="<?= site_url() ?>womens/sarees" class="dropdown-toggle  mobile-layout-link" data-toggle="dropdown" style="float: right"></a>
                                                <a href="<?= site_url() ?>womens/sarees" class="catlink mobile-layout-link">Sarees</a>                                                
                                                <ul class="dropdown-menu mega_dropdown" role="menu" style="width: 250px;">
                                                    <li class="block-container col-sm-12">
                                                        <ul class="block">
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=209">Bollywood Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=252">Casual</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=254">Festival</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=335">Gift</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=255">Party</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=231">Diamond Work Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=232">Embroidered Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=239">Lace Work Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=244">Printed Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=247">Stone Work Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=248">Thread Work Saree</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/sarees?id=250">Zari Work Saree</a></li>
                                                        </ul>
                                                    </li>                                    
                                                </ul>
                                            </li>                                            
                                            <li class="dropdown">
                                                <a href="<?= site_url() ?>womens/dressMaterial" class="dropdown-toggle full-layout-link" data-toggle="dropdown" >Dress Material</a>
                                                <a href="<?= site_url() ?>womens/dressMaterial" class="dropdown-toggle mobile-layout-link" data-toggle="dropdown" style="float: right"></a>
                                                <a href="<?= site_url() ?>womens/dressMaterial" class="catlink mobile-layout-link">Dress Material</a>
                                                <ul class="dropdown-menu mega_dropdown" role="menu" style="width: 250px;">
                                                    <li class="block-container col-sm-12">
                                                        <ul class="block">
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=252">Casual</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=254">Festival</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=335">Gift</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=255">Party</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=204">Anarkali Suit</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=207">Bollywood Anarkali Suit</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=231">Diamond Work</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=232">Embroidered</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=244">Printed</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=247">Stone Work</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/dressMaterial?id=222">Salwar Suit</a></li>
                                                        </ul>
                                                    </li>                                    
                                                </ul>
                                            </li>
                                            <li class="dropdown">
                                                <a href="<?= site_url() ?>womens/lehengaCholis" class="dropdown-toggle full-layout-link" data-toggle="dropdown">Lehenga Cholis</a>
                                                <a href="<?= site_url() ?>womens/lehengaCholis" class="dropdown-toggle mobile-layout-link" data-toggle="dropdown" style="float: right"></a>
                                                <a href="<?= site_url() ?>womens/lehengaCholis" class="catlink mobile-layout-link">Lehenga Cholis</a>
                                                <ul class="dropdown-menu mega_dropdown" role="menu" style="width: 250px;">
                                                    <li class="block-container col-sm-12">
                                                        <ul class="block">
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=252">Casual</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=254">Festival</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=335">Gift</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=255">Party</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=208">Bollywood Lehenga Choli</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=623">Designer Lehenga Choli</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=219">Lehenga Suit</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=231">Diamond Work</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=308">Digital Printed</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=232">Embroidered</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=244">Printed</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/lehengaCholis?id=247">Stone Work</a></li>
                                                        </ul>
                                                    </li>                                    
                                                </ul>
                                            </li> 
                                            <li class="dropdown">
                                                <a href="<?= site_url() ?>womens/gowns" class="dropdown-toggle full-layout-link" data-toggle="dropdown">Gowns</a>
                                                <a href="<?= site_url() ?>womens/gowns" class="dropdown-toggle mobile-layout-link" data-toggle="dropdown" style="float: right"></a>
                                                <a href="<?= site_url() ?>womens/gowns" class="catlink mobile-layout-link">Gowns</a>
                                                <ul class="dropdown-menu mega_dropdown" role="menu" style="width: 250px;">
                                                    <li class="block-container col-sm-12">
                                                        <ul class="block">
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/gowns?id=252">Casual</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/gowns?id=254">Festival</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/gowns?id=335">Gift</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/gowns?id=255">Party</a></li>                                                            
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/gowns?id=623">Designer Gowns</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/gowns?id=231">Diamond Work</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/gowns?id=308">Digital Printed</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/gowns?id=232">Embroidered</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/gowns?id=244">Printed</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/gowns?id=247">Stone Work</a></li>
                                                        </ul>
                                                    </li>                                    
                                                </ul>
                                            </li> 
                                            <li class="dropdown">
                                                <a href="<?= site_url() ?>womens/jewellery" class="dropdown-toggle full-layout-link" data-toggle="dropdown" >Jewellery</a>
                                                <a href="<?= site_url() ?>womens/jewellery" class="dropdown-toggle mobile-layout-link" data-toggle="dropdown" style="float: right"></a>
                                                <a href="<?= site_url() ?>womens/jewellery" class="catlink mobile-layout-link" >Jewellery</a>
                                                <ul class="dropdown-menu mega_dropdown" role="menu" style="width: 250px;">
                                                    <li class="block-container col-sm-12">
                                                        <ul class="block">
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/jewellery?id=252">Casual</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/jewellery?id=329">Children</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/jewellery?id=363">Classic</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/jewellery?id=364">Europe</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/jewellery?id=254">Festival</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/jewellery?id=335">Gift</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/jewellery?id=330">Men</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/jewellery?id=225">Party</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/jewellery?id=365">Romantic</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/jewellery?id=367">Trendy</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/jewellery?id=368">Vintage</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/jewellery?id=332">Womens</a></li>
                                                        </ul>
                                                    </li>                                    
                                                </ul>
                                            </li>                                             
                                            <li><a href="<?= site_url() ?>womens/bollywood">Bollywood</a></li>
                                            <li class="dropdown">
                                                <a href="" class="dropdown-toggle" data-toggle="dropdown" >More</a>
                                                <ul class="dropdown-menu mega_dropdown" role="menu" style="width: 250px;right:0px">
                                                    <li class="block-container col-sm-12">
                                                        <ul class="block">
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/kurtis">Kurtis</a></li>
                                                            <li class="link_container"><a href="<?= site_url() ?>womens/leggings">Leggings</a></li>
                                                        </ul>
                                                    </li>                                    
                                                </ul>
                                            </li>  
                                        </ul>
                                    </div><!--/.nav-collapse -->
                                </div>
                            </nav>
                        </div>
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


