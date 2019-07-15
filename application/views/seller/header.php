<!doctype html>
<html class="fixed">
    <head>
        <!-- Basic -->
        <meta charset="UTF-8">
        <title>SHOPKING24</title>
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

              <!-- Mobile Metas -->
              <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <!-- Web Fonts  -->
        <!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">-->

        <!-- Vendor CSS -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/font-awesome/css/font-awesome.css" />
        <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/magnific-popup/magnific-popup.css" />
        <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

        <!-- Specific Page Vendor CSS -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
        <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
        <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/morris/morris.css" />
        <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />
        <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/select2/select2.css" />
        <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
        <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/pnotify/pnotify.custom.css" />
        <!-- Theme CSS -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/stylesheets/theme.css" />

        <!-- Skin CSS -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/stylesheets/skins/default.css" />

        <!-- Theme Custom CSS -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/stylesheets/theme-custom.css">

        <!-- Head Libs -->
        <script src="<?= base_url() ?>assets/vendor/jquery/jquery.js"></script>
        <script src="<?= base_url() ?>assets/vendor/modernizr/modernizr.js"></script>

        <!-- Alert CSS -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/alertify.core.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/alertify.default.css">

        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/iCheck/all.css"/>

        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/iCheck/minimal/blue.css"  />
        <link rel="shortcut icon" type="image/ico" href="<?= base_url() ?>assets/images/favicon.ico"/>

    </head>
    <body>
        <section class="body">

            <!-- start: header -->
            <header class="header">
                <div class="logo-container">
                    <a href="../" class="logo">
                        <img src="<?= base_url() ?>assets/images/logo.png" height="35" alt="Porto Admin" />
                    </a>
                    <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
                        <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                    </div>
                </div>

                <!-- start: search & user box -->
                <div class="header-right">

                    <ul class="notifications">
                        <?php
                        $new_order = $this->common->getNewOrderNotification($this->session->userdata('seller_id'));
                        $cancel_order = $this->common->getCancelOrderNotification($this->session->userdata('seller_id'));
                        $return_order = $this->common->getReturnOrderNotification($this->session->userdata('seller_id'));
                        $replace_order = $this->common->getReplaceOrderNotification($this->session->userdata('seller_id'));
                        $payout = $this->common->getSellerPayoutNotification($this->session->userdata('seller_id'));
                        if (isset($new_order) && is_array($new_order)) {
                            $total_new_order = 0;
                            foreach ($new_order as $val) {
                                if ($val->status == 0) {
                                    $total_new_order += 1;
                                }
                            }
                        }
                        if (isset($cancel_order) && is_array($cancel_order)) {
                            $total_cancel_order = 0;
                            foreach ($cancel_order as $val) {
                                if ($val->status == 0) {
                                    $total_cancel_order += 1;
                                }
                            }
                        }
                        if (isset($return_order) && is_array($return_order)) {
                            $total_return_order = 0;
                            foreach ($return_order as $val) {
                                if ($val->status == 0) {
                                    $total_return_order += 1;
                                }
                            }
                        }
                        if (isset($replace_order) && is_array($replace_order)) {
                            $total_replace_order = 0;
                            foreach ($replace_order as $val) {
                                if ($val->status == 0) {
                                    $total_replace_order += 1;
                                }
                            }
                        }
                        if (isset($payout) && is_array($payout)) {
                            $total_new_payout = 0;
                            foreach ($payout as $val) {
                                if ($val->status == 0) {
                                    $total_new_payout += 1;
                                }
                            }
                        }
                        ?>
                        <li>
                            <a id="bellneworder" href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                                <i class="fa fa-cubes"></i>
                                <?php
                                if (isset($total_new_order)) {
                                    if ($total_new_order > 0) {
                                        ?>
                                        <span class="badge" style="background: green"><?= isset($total_new_order) ? $total_new_order : 0 ?></span>
                                        <?php
                                    }
                                }
                                ?>
                            </a>
                            <div class="dropdown-menu notification-menu">
                                <div class="notification-title">                                    
                                    New Order
                                </div>

                                <div class="content">
                                    <ul>
                                        <?php
                                        if (isset($new_order) && is_array($new_order)) {
                                            foreach ($new_order as $val) {
                                                ?>
                                                <li>
                                                    <a href="<?= site_url() ?>seller/order/active" class="clearfix">
                                                        <div class="image">
                                                            <i class="fa fa-thumbs-up bg-success"></i>
                                                        </div>
                                                        <span class="title">New Order [Order Id : <?= $val->order_id ?>]</span>
                                                        <span class="message"><i class="fa fa-rupee"></i> <?= $val->total_price ?></span>
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                    <hr />
                                    <div class="text-right">
                                        <a href="<?= site_url() ?>seller/order/active" class="view-more">View All</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a id="bellcancelorder" href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                                <i class="fa fa-times"></i>
                                <?php
                                if (isset($total_cancel_order)) {
                                    if ($total_cancel_order > 0) {
                                        ?>
                                        <span class="badge" style="background: black"><?= isset($total_cancel_order) ? $total_cancel_order : 0 ?></span>
                                    <?php
                                    }
                                }
                                ?>
                            </a>
                            <div class="dropdown-menu notification-menu">
                                <div class="notification-title">                                    
                                    Cancel Order
                                </div>

                                <div class="content">
                                    <ul>
                                        <?php
                                        if (isset($cancel_order) && is_array($cancel_order)) {
                                            foreach ($cancel_order as $val) {
                                                ?>
                                                <li>
                                                    <a href="<?= site_url() ?>seller/order/cancel" class="clearfix">
                                                        <div class="image">
                                                            <i class="fa fa-thumbs-up bg-success"></i>
                                                        </div>
                                                        <span class="title">Cancel Order [Order Id : <?= $val->order_id ?>]</span>
                                                        <span class="message"><i class="fa fa-rupee"></i> <?= $val->total_price ?></span>
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                    <hr />
                                    <div class="text-right">
                                        <a href="<?= site_url() ?>seller/order/cancel" class="view-more">View All</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a id="bellreturnorder" href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                                <i class="fa fa-undo"></i>
                                <?php
                                if (isset($total_return_order)) {
                                    if ($total_return_order > 0) {
                                        ?>
                                        <span class="badge"><?= isset($total_return_order) ? $total_return_order : 0 ?></span>
                                    <?php
                                    }
                                }
                                ?>
                            </a>
                            <div class="dropdown-menu notification-menu">
                                <div class="notification-title">                                    
                                    Return Order
                                </div>

                                <div class="content">
                                    <ul>
                                        <?php
                                        if (isset($return_order) && is_array($return_order)) {
                                            foreach ($return_order as $val) {
                                                ?>
                                                <li>
                                                    <a href="<?= site_url() ?>seller/order/returns" class="clearfix">
                                                        <div class="image">
                                                            <i class="fa fa-thumbs-up bg-success"></i>
                                                        </div>
                                                        <span class="title">Return Order [Order Id : <?= $val->order_id ?>]</span>
                                                        <span class="message"><i class="fa fa-rupee"></i> <?= $val->total_price ?></span>
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                    <hr />
                                    <div class="text-right">
                                        <a href="<?= site_url() ?>seller/order/returns" class="view-more">View All</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a id="bellreplaceorder" href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                                <i class="fa fa-recycle"></i>
                                <?php
                                if (isset($total_replace_order)) {
                                    if ($total_replace_order > 0) {
                                        ?>
                                        <span class="badge" style="background: orange"><?= isset($total_replace_order) ? $total_replace_order : 0 ?></span>
                                    <?php
                                    }
                                }
                                ?>
                            </a>
                            <div class="dropdown-menu notification-menu">
                                <div class="notification-title">                                    
                                    Replace Order
                                </div>

                                <div class="content">
                                    <ul>
                                        <?php
                                        if (isset($replace_order) && is_array($replace_order)) {
                                            foreach ($replace_order as $val) {
                                                ?>
                                                <li>
                                                    <a href="<?= site_url() ?>seller/order/replace" class="clearfix">
                                                        <div class="image">
                                                            <i class="fa fa-thumbs-up bg-success"></i>
                                                        </div>
                                                        <span class="title">Replace Order [Order Id : <?= $val->order_id ?>]</span>
                                                        <span class="message"><i class="fa fa-rupee"></i> <?= $val->total_price ?></span>
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                    <hr />
                                    <div class="text-right">
                                        <a href="<?= site_url() ?>seller/order/replace" class="view-more">View All</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a id="bellnewpayout" href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                                <i class="fa fa-cubes"></i>
                                <?php
                                if (isset($total_new_payout)) {
                                    if ($total_new_payout > 0) {
                                        ?>
                                        <span class="badge" style="background: green"><?= isset($total_new_payout) ? $total_new_payout : 0 ?></span>
                                        <?php
                                    }
                                }
                                ?>
                            </a>
                            <div class="dropdown-menu notification-menu">
                                <div class="notification-title">                                    
                                    New Payment Received
                                </div>

                                <div class="content">
                                    <ul>
                                        <?php
                                        if (isset($payout) && is_array($payout)) {
                                            foreach ($payout as $val) {
                                                ?>
                                                <li>
                                                    <a href="<?= site_url() ?>seller/payments/Payout" class="clearfix">
                                                        <div class="image">
                                                            <i class="fa fa-thumbs-up bg-success"></i>
                                                        </div>
                                                        <span class="title"><?= $val->from_name ?></span>
                                                        <span class="message"><?= $val->message ?></span>
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                    <hr />
                                    <div class="text-right">
                                        <a href="<?= site_url() ?>seller/payments/Payout" class="view-more">View All</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <span class="separator"></span>

                    <div id="userbox" class="userbox">
                        <a href="#" data-toggle="dropdown">
                            <figure class="profile-picture">
                                <img src="<?= base_url() ?>assets/images/!logged-user.jpg" alt="Joseph Doe" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg" />
                            </figure>
                            <div class="profile-info" data-lock-name="John Doe" data-lock-email="<?= ($this->session->userdata('seller_primary_email') != "") ? $this->session->userdata('seller_primary_email') : "" ?>">
                                <span class="name"><?= ($this->session->userdata('seller_primary_email') != "") ? $this->common->getSellerName($this->session->userdata('seller_primary_email')) : '' ?></span>
                                <span class="role">Seller</span>
                            </div>

                            <i class="fa custom-caret"></i>
                        </a>

                        <div class="dropdown-menu">
                            <ul class="list-unstyled">
                                <li class="divider"></li>
                                <li>
                                    <a role="menuitem" tabindex="-1" href="<?= site_url() ?>seller/profile"><i class="fa fa-user"></i> My Profile</a>
                                </li>
                                <li>
                                    <a href="<?= site_url() ?>seller/change_password"><i class="fa fa-lock" aria-hidden="true"></i>Change Password</a>
                                </li>
                                <li>
                                    <a role="menuitem" tabindex="-1" href="<?= site_url() ?>seller/login/logout"><i class="fa fa-power-off"></i> Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- end: search & user box -->
            </header>
            <!-- end: header -->

            <div class="inner-wrapper">
                <!-- start: sidebar -->
                <aside id="sidebar-left" class="sidebar-left">

                    <div class="sidebar-header">
                        <div class="sidebar-title">
                            Navigation
                        </div>
                        <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
                            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                        </div>
                    </div>

                    <div class="nano">
                        <div class="nano-content">
                            <nav id="menu" class="nav-main" role="navigation">
                                <ul class="nav nav-main">
                                    <li class=""><a href="<?= site_url() ?>seller/dashboard"><i class="fa fa-home" aria-hidden="true"></i><span>Dashboard</span></a>
                                    <li class="nav-parent">
                                        <a><i class="fa fa-cubes" aria-hidden="true"></i><span>Products</span></a>
                                        <ul class="nav nav-children">                                           
                                            <li><a href="<?= site_url() ?>seller/product">Add Single Product</a></li>
                                            <li><a href="<?= site_url() ?>seller/product/bulk">Bulk Upload Product</a></li>
                                            <li><a href="<?= site_url() ?>seller/mylisting">My Products</a></li>
                                            <li><a href="<?= site_url() ?>seller/request">Approval Request</a></li>
                                            <li><a href="<?= site_url() ?>seller/product/supc">Add Using SUPC</a></li>
                                            <li><a href="<?= site_url() ?>seller/rejected">Rejected Products</a></li>
                                            <li><a href="<?= site_url() ?>seller/gallery">Image Gallery</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-parent">
                                        <a><i class="fa fa-shopping-cart" aria-hidden="true"></i><span>Orders</span></a>
                                        <ul class="nav nav-children">
                                            <li><a href="<?= site_url() ?>seller/order/active">Active Order</a></li>
                                            <li><a href="<?= site_url() ?>seller/order/cancel">Cancel Order</a></li>
                                            <li><a href="<?= site_url() ?>seller/order/track">Track Order</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-parent">
                                        <a><i class="fa  fa-rotate-left" aria-hidden="true"></i><span>Returns</span></a>
                                        <ul class="nav nav-children">
                                            <li><a href="<?= site_url() ?>seller/order/returns">Return Order</a></li>
                                            <li><a href="<?= site_url() ?>seller/order/replace">Replace Order</a></li>
                                            <li><a href="<?= site_url() ?>seller/order/refund">Refund Order</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-parent">
                                        <a><i class="fa fa-money" aria-hidden="true"></i><span>Payments</span></a>
                                        <ul class="nav nav-children">
                                            <li><a href="<?= site_url() ?>seller/payments/payout">Pay-out</a></li>
                                            <li><a href="<?= site_url() ?>seller/payments/transaction">Transaction</a></li>
                                            <!--<li><a href="#">Invoices</a></li>-->
                                        </ul>
                                    </li>
                                    <li class=""><a href="<?= site_url() ?>seller/chart"><i class="fa fa-pied-piper" aria-hidden="true"></i><span>Order Chart</span></a>
                                    <!--<li class=""><a href="#"><i class="fa fa-bar-chart-o" aria-hidden="true"></i><span>Charts</span></a></li>
                                    <li class=""><a href="<?= site_url() ?>seller/promotions"><i class="fa fa-paper-plane" aria-hidden="true"></i><span>Promotions</span></a></li>
                                    <li class="nav-parent">
                                        <a><i class="fa fa-envelope" aria-hidden="true"></i><span>Advertisement</span></a>
                                        <ul class="nav nav-children">  
                                            <li><a href="<?= site_url() ?>seller/advertisement">Advertising Pricing</a></li>
                                            <li><a href="<?= site_url() ?>seller/advertisement/addRequest">New Request</a></li>
                                        </ul>
                                    </li>
                                    <li class=""><a href="<?= site_url() ?>seller/message"><i class="fa fa-comments" aria-hidden="true"></i><span>Messages</span></a></li>-->
                                </ul>
                            </nav>                           
                        </div>
                    </div>
                </aside>
                <!-- end: sidebar -->                 


