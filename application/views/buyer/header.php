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

        <!-- Theme CSS -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/stylesheets/theme.css" />

        <!-- Skin CSS -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/stylesheets/skins/default.css" />

        <!-- Theme Custom CSS -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/stylesheets/theme-custom.css">

        <!-- Alert CSS -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/alertify.core.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/alertify.default.css">

        <!-- Head Libs -->
        <script src="<?= base_url() ?>assets/vendor/jquery/jquery.js"></script>
        <script src="<?= base_url() ?>assets/vendor/modernizr/modernizr.js"></script>

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

                    <!--<form action="pages-search-results.html" class="search nav-form">
                        <div class="input-group input-search">
                            <input type="text" class="form-control" name="q" id="q" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>

                    <span class="separator"></span>-->

                    <ul class="notifications">
                        <?php
                        $refund = $this->common->getCustomerRefundNotification($this->session->userdata('customer_id'));
                        if (isset($refund) && is_array($refund)) {
                            $total_new_refund = 0;
                            foreach ($refund as $val) {
                                if ($val->status == 0) {
                                    $total_new_refund += 1;
                                }
                            }
                        }
                        ?>
                        <li>
                            <a id="bellnewrefund" href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                                <i class="fa fa-cubes"></i>
                                <?php
                                if (isset($total_new_refund)) {
                                    if ($total_new_refund > 0) {
                                        ?>
                                        <span class="badge" style="background: green"><?= isset($total_new_refund) ? $total_new_refund : 0 ?></span>
                                        <?php
                                    }
                                }
                                ?>
                            </a>
                            <div class="dropdown-menu notification-menu">
                                <div class="notification-title">                                    
                                    New Refund Payment
                                </div>

                                <div class="content">
                                    <ul>
                                        <?php
                                        if (isset($refund) && is_array($refund)) {
                                            $count = 0;
                                            foreach ($refund as $val) {
                                                $count += 1;
                                                if ($count <= 5) {
                                                    ?>
                                                    <li>
                                                        <a href="<?= site_url() ?>buyer/refund" class="clearfix">
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
                                        }
                                        ?>
                                    </ul>
                                    <hr />
                                    <div class="text-right">
                                        <a href="<?= site_url() ?>buyer/refund" class="view-more">View All</a>
                                    </div>
                                </div>
                            </div>
                        </li>                        
                    </ul>
                    <span class="separator"></span>

                    <div id="userbox" class="userbox">
                        <a href="#" data-toggle="dropdown">
                            <!--<figure class="profile-picture">
                                <img src="<?= base_url() ?>assets/images/!logged-user.jpg" alt="Joseph Doe" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg" />
                            </figure>-->
                            <div class="profile-info" data-lock-name="John Doe" data-lock-email="<?= ($this->session->userdata('customer_primary_email') != "") ? $this->session->userdata('customer_primary_email') : "" ?>">
                                <span class="name"><?= ($this->session->userdata('customer_primary_email') != "") ? $this->common->getCustomerName($this->session->userdata('customer_primary_email')) : '' ?></span>
                                <span class="role">Customer</span>
                            </div>

                            <i class="fa custom-caret"></i>
                        </a>

                        <div class="dropdown-menu">
                            <ul class="list-unstyled">
                                <li class="divider"></li>
                                <li>
                                    <a role="menuitem" tabindex="-1" href="<?= site_url() ?>buyer/profile"><i class="fa fa-user"></i> My Profile</a>
                                </li>                                
                                <li>
                                    <a role="menuitem" tabindex="-1" href="<?= site_url() ?>buyer/login/logout"><i class="fa fa-power-off"></i> Logout</a>
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
                                    <li class=""><a href="<?= site_url() ?>buyer/order"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span>Order History</span></a></li>
                                    <li class=""><a href="<?= site_url() ?>buyer/order/returnOrderList"><i class="fa fa-repeat" aria-hidden="true"></i><span>Return Order Management</span></a></li>
                                    <li class=""><a href="<?= site_url() ?>buyer/refund"><i class="fa fa-comments" aria-hidden="true"></i><span>Refund Request Detail</span></a></li>
                                    <li class=""><a href="<?= site_url() ?>buyer/order/invoices"><i class="fa fa-file" aria-hidden="true"></i><span>Invoice Detail</span></a></li>
                                    <li class="nav-parent">
                                        <a><i class="fa fa-gears" aria-hidden="true"></i><span>Setting</span></a>
                                        <ul class="nav nav-children">                                           
                                            <li><a href="<?= site_url() ?>buyer/profile"><i class="fa fa-user" aria-hidden="true"></i>Profile</a></li>
                                            <li><a href="<?= site_url() ?>buyer/profile/changePassword"><i class="fa fa-lock" aria-hidden="true"></i>Change Password</a></li>
                                        </ul>
                                    </li>
                                    <!--<li class=""><a href="<?= site_url() ?>buyer/message"><i class="fa fa-comments" aria-hidden="true"></i><span>Messages</span></a></li>-->

                                </ul>
                            </nav>                           
                        </div>
                    </div>
                </aside>
                <!-- end: sidebar -->                 


