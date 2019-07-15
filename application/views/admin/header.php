<!doctype html>
<?php
$permission = $this->common->getPermission($this->session->userdata('primary_email'));
?>

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
        <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/select2/select2.css" />
        <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
        <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/morris/morris.css" />
        <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />


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
                    <label style="background-color: green;color: #ffffff;padding: 6px;border-radius: 5px;font-size: 16px;margin-top: 8px;height: 38px;padding-top: 7px;"><?= $this->common->getSMSBalance() ?></label>
                    <span class="separator"></span>
                    <?php if ($this->session->userdata('role') == "0") { ?>   <!-- Site Button + Notification Show Only Admin Login  -->       
                        <?php
                        $status = $this->common->siteStatus();
                        if ($status == '1') {
                            ?>
                            <a style="margin-right: 10px;margin-top: 8px;" href="<?= site_url() ?>admin/siteSetting/siteStop"><button class="btn btn-danger lg" type="button" style="height: 35px;">SITE STOP</button></a>
                            <?php
                        } else if ($status == '0') {
                            ?>
                            <a style="margin-right: 10px;margin-top: 8px;" href="<?= site_url() ?>admin/siteSetting/siteStart"><button class="btn btn-success lg" type="button" style="height: 35px;">SITE START</button></a>
                            <?php
                        }
                        ?>
                        <span class="separator"></span>                              
                        <ul class="notifications">
                            <?php
                            $sellers = $this->common->getSellerSignupNotification();
                            $payout = $this->common->getAdminPayoutNotification();
                            $refund = $this->common->getAdminRefundNotification();
                            if (isset($sellers) && is_array($sellers)) {
                                $total_new_seller = 0;
                                foreach ($sellers as $val) {
                                    if ($val->status == 0) {
                                        $total_new_seller += 1;
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
                                <a id="bellnewseller" href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                                    <i class="fa fa-cubes"></i>
                                    <?php
                                    if (isset($total_new_seller)) {
                                        if ($total_new_seller > 0) {
                                            ?>
                                            <span class="badge" style="background: green"><?= isset($total_new_seller) ? $total_new_seller : 0 ?></span>
                                            <?php
                                        }
                                    }
                                    ?>
                                </a>
                                <div class="dropdown-menu notification-menu">
                                    <div class="notification-title">                                    
                                        New Seller Sign Up
                                    </div>

                                    <div class="content">
                                        <ul>
                                            <?php
                                            if (isset($sellers) && is_array($sellers)) {
                                                $count = 0;
                                                foreach ($sellers as $val) {
                                                    $count += 1;
                                                    if ($count <= 5) {
                                                        ?>
                                                        <li>
                                                            <a href="<?= site_url() ?>admin/seller/profile?id=<?= base64_encode($val->primary_email) ?>" class="clearfix">
                                                                <div class="image">
                                                                    <i class="fa fa-thumbs-up bg-success"></i>
                                                                </div>
                                                                <span class="title"><?= $val->first_name . " " . $val->last_name ?></span>
                                                                <span class="message"><?= $val->primary_email ?></span>
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
                                            <a href="<?= site_url() ?>admin/seller" class="view-more">View All</a>
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
                                        New Payment Request
                                    </div>

                                    <div class="content">
                                        <ul>
                                            <?php
                                            if (isset($payout) && is_array($payout)) {
                                                $count = 0;
                                                foreach ($payout as $val) {
                                                    $count += 1;
                                                    if ($count <= 5) {
                                                        ?>
                                                        <li>
                                                            <a href="<?= site_url() ?>admin/payment_request" class="clearfix">
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
                                            <a href="<?= site_url() ?>admin/payments_request" class="view-more">View All</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
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
                                        New Refund Request
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
                                                            <a href="<?= site_url() ?>admin/refund_request" class="clearfix">
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
                                            <a href="<?= site_url() ?>admin/refund_request" class="view-more">View All</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <span class="separator"></span>
                    <?php } ?>
                    <div id="userbox" class="userbox">
                        <a href="#" data-toggle="dropdown">
                            <figure class="profile-picture">
                                <img src="<?= base_url() ?>assets/images/!logged-user.jpg" alt="Joseph Doe" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg" />
                            </figure>
                            <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
                                <span class="name"><?= ($this->session->userdata('primary_email') != "") ? $this->common->getEmployeeName($this->session->userdata('primary_email')) : '' ?></span>
                                <span class="role"><?= ($this->session->userdata('role') != "") ? ($this->session->userdata('role') == '0') ? 'Administrator' : 'Employee' : '' ?></span>
                            </div>

                            <i class="fa custom-caret"></i>
                        </a>

                        <div class="dropdown-menu">
                            <ul class="list-unstyled">
                                <li class="divider"></li>
                                <li>
                                    <a role="menuitem" tabindex="-1" href="#"><i class="fa fa-user"></i> My Profile</a>
                                </li>
                                <?php if ($permission->sms_setting) { ?> 
                                    <li>
                                        <a role="menuitem" tabindex="-1" href="<?= site_url() ?>admin/sms_setting"><i class="fa fa-user"></i> Sms Api Setting</a>
                                    </li>
                                <?php } ?>
                                <?php if ($permission->payumoney_setting) { ?> 
                                    <li>
                                        <a role="menuitem" tabindex="-1" href="<?= site_url() ?>admin/payumoney_setting"><i class="fa fa-user"></i> Payumoney Setting</a>
                                    </li>
                                <?php } ?>    
                                <li>
                                    <a href="<?= site_url() ?>admin/change_password"><i class="fa fa-lock" aria-hidden="true"></i>Change Password</a>
                                </li>
                                <li>
                                    <a role="menuitem" tabindex="-1" href="<?= site_url() ?>admin/login/logout"><i class="fa fa-power-off"></i> Logout</a>
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
                                    <li class=""><a href="<?= site_url() ?>admin/dashboard"><i class="fa fa-home" aria-hidden="true"></i><span>Dashboard</span></a>
                                        <?php if ($permission->request_product) { ?>
                                        <li class=""><a href="<?= site_url() ?>admin/product_request"><i class="fa fa-check-square-o" aria-hidden="true"></i><span>Approval Request</span></a>
                                        <?php } if ($permission->deleted_product) { ?>
                                        <li class=""><a href="<?= site_url() ?>admin/product_deleted"><i class="fa fa-check-square-o" aria-hidden="true"></i><span>Deleted Request</span></a>
                                        <?php } if ($permission->rejected_product) { ?>
                                        <li><a href="<?= site_url() ?>admin/product_rejected"><i class="fa fa-ban" aria-hidden="true"></i>Rejected Products</a></li>    
                                    <?php } if ($permission->approved_product || $permission->live_product) { ?>                                    
                                        <li class="nav-parent">
                                            <a><i class="fa fa-cubes" aria-hidden="true"></i><span>Products</span></a>
                                            <ul class="nav nav-children">  
                                                <?php if ($permission->approved_product) { ?>  
                                                    <li><a href="<?= site_url() ?>admin/product_approved"><i class="fa fa-check-square" aria-hidden="true"></i>Approved Products</a></li>
                                                <?php } if ($permission->live_product) { ?>
                                                    <li><a href="<?= site_url() ?>admin/product_live"><i class="fa fa-check-square" aria-hidden="true"></i>Live Products</a></li>                                                
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    <?php } if ($permission->payout) { ?>                                    
                                        <li class="nav-parent">
                                            <a><i class="fa fa-money" aria-hidden="true"></i><span>Seller Payments</span></a>
                                            <ul class="nav nav-children">  
                                                <?php if ($permission->payout) { ?> 
                                                    <li><a href="<?= site_url() ?>admin/payments_request"><i class="fa fa-repeat" aria-hidden="true"></i>Payout Request</a></li>
                                                <?php } if ($permission->payout) { ?> 
                                                    <li><a href="<?= site_url() ?>admin/payments_request/rejectRequest"><i class="fa fa-file" aria-hidden="true"></i>Payout Reject Details</a></li>        
                                                <?php } if ($permission->payout) { ?> 
                                                    <li><a href="<?= site_url() ?>admin/payments_request/payout"><i class="fa fa-file" aria-hidden="true"></i>Payout Details</a></li>    
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    <?php } if ($permission->refund_request || $permission->refund_paid) { ?> 
                                        <li class="nav-parent">
                                            <a><i class="fa fa-money" aria-hidden="true"></i><span>Customer Refund</span></a>
                                            <ul class="nav nav-children">  
                                                <?php if ($permission->refund_request) { ?> 
                                                    <li><a href="<?= site_url() ?>admin/refund_request"><i class="fa fa-repeat" aria-hidden="true"></i>Refund Request</a></li>
                                                    <li><a href="<?= site_url() ?>admin/refund_request/reject"><i class="fa fa-file" aria-hidden="true"></i>Refund Rejected</a></li>    

                                                <?php } if ($permission->refund_paid) { ?> 
                                                    <li><a href="<?= site_url() ?>admin/refund_paid"><i class="fa fa-file" aria-hidden="true"></i>Refund Paid</a></li>    
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    <?php } if ($permission->acmanager) { ?>
                                        <li class=""><a href="<?= site_url() ?>admin/account"><i class="fa fa-user" aria-hidden="true"></i><span>Account Manager</span></a>
                                        <?php } if ($permission->employee) { ?>
                                        <li class=""><a href="<?= site_url() ?>admin/employee"><i class="fa fa-user" aria-hidden="true"></i><span>Employee Management</span></a>
                                        <?php } if ($permission->seller) { ?>
                                        <li class=""><a href="<?= site_url() ?>admin/seller"><i class="fa fa-users" aria-hidden="true"></i><span>Seller Master</span></a>
                                        <?php } if ($permission->eseller) { ?>
                                        <li class=""><a href="<?= site_url() ?>admin/employee_seller"><i class="fa fa-users" aria-hidden="true"></i><span>Seller Master</span></a>
                                        <?php } if ($permission->customer) { ?>
                                        <li class=""><a href="<?= site_url() ?>admin/customer"><i class="fa fa-user" aria-hidden="true"></i><span>Customer Master</span></a>
                                        <?php } if ($permission->advertisement) { ?>
                                        <li class="nav-parent">
                                            <a><i class="fa fa-envelope" aria-hidden="true"></i><span>Advertisement</span></a>
                                            <ul class="nav nav-children">  
                                                <li><a href="<?= site_url() ?>admin/advertisement">Advertisement</a></li>
                                                <li><a href="<?= site_url() ?>admin/advertisement/advertisementRequest">New Request</a></li>
                                                <li><a href="<?= site_url() ?>admin/advertisement/advertisementPricing">Advertising Pricing</a></li>
                                                <li><a href="<?= site_url() ?>admin/advertisement/mobile">Mobile Banner</a></li>
                                            </ul>
                                        </li>
                                    <?php } if ($permission->coupon) { ?>
                                        <li class=""><a href="<?= site_url() ?>admin/coupon"><i class="fa fa-tags" aria-hidden="true"></i><span>Coupon Master</span></a>
                                        <?php } if ($permission->seller_group) { ?>
                                        <li class=""><a href="<?= site_url() ?>admin/sellergroup"><i class="fa fa-users" aria-hidden="true"></i><span>Seller Group Master</span></a>
                                        <?php } if ($permission->order_shipping_charge || $permission->order_fail || $permission->order || $permission->order_track) { ?> 
                                        <li class="nav-parent">
                                            <a><i class="fa fa-envelope" aria-hidden="true"></i><span>Order Master</span></a>
                                            <ul class="nav nav-children"> 
                                                <?php if ($permission->order) { ?>
                                                    <li class=""><a href="<?= site_url() ?>admin/order_history"><i class="fa fa-file" aria-hidden="true"></i><span>Order History</span></a></li>    
                                                    <li class=""><a href="<?= site_url() ?>admin/order_history/request"><i class="fa fa-file" aria-hidden="true"></i><span>Cancel/Replace/Return Order</span></a></li>    
                                                <?php } if ($permission->order_shipping_charge) { ?>
                                                    <li class=""><a href="<?= site_url() ?>admin/order_shipping_charge"><i class="fa fa-file" aria-hidden="true"></i><span>Order Shipping Charge</span></a></li>    
                                                <?php } if ($permission->order_fail) { ?>
                                                    <li class=""><a href="<?= site_url() ?>admin/order_failed"><i class="fa fa-file" aria-hidden="true"></i><span>Order Fail History</span></a></li> 
                                                <?php } if ($permission->order_track) { ?>
                                                    <li class=""><a href="<?= site_url() ?>admin/order_track"><i class="fa fa-file" aria-hidden="true"></i><span>Order Track</span></a></li>            
                                                    <li class=""><a href="<?= site_url() ?>admin/order_track/awb"><i class="fa fa-file" aria-hidden="true"></i><span>Order Tracking Number</span></a></li>            
                                                <?php } if ($permission->order_status) { ?>
                                                    <li class=""><a href="<?= site_url() ?>admin/order_status"><i class="fa fa-file" aria-hidden="true"></i><span>Order Status Management</span></a></li>  
                                                <?php } if ($permission->order_cancel) { ?>
                                                    <li class=""><a href="<?= site_url() ?>admin/order_cancel"><i class="fa fa-file" aria-hidden="true"></i><span>Cancel Order Management</span></a></li>    
                                                <?php } if ($permission->order_return) { ?>
                                                    <li class=""><a href="<?= site_url() ?>admin/order_return"><i class="fa fa-file" aria-hidden="true"></i><span>Return Order Management</span></a></li>    
                                                <?php } ?>
                                                    <li class=""><a href="<?= site_url() ?>admin/chart"><i class="fa fa-pied-piper" aria-hidden="true"></i><span>Order Chart</span></a></li>    
                                            </ul>
                                        </li>
                                    <?php } if ($permission->bulksms) { ?>
                                        <li class=""><a href="<?= site_url() ?>admin/bulksms"><i class="fa fa-mobile" aria-hidden="true"></i><span>Bulk SMS</span></a>
                                        <?php } if ($permission->bulkemail) { ?>
                                        <li class=""><a href="<?= site_url() ?>admin/bulkemail"><i class="fa fa-envelope" aria-hidden="true"></i><span>Bulk Email</span></a>
                                        <?php } if ($permission->product_rate) { ?> 
                                        <li class=""><a href="<?= site_url() ?>admin/product_rating"><i class="fa fa-star-half-o" aria-hidden="true"></i><span>Product Rating</span></a>
                                        <?php } if ($permission->messages) { ?> 
    <!--                                <li class=""><a href="<?= site_url() ?>admin/message"><i class="fa fa-comments" aria-hidden="true"></i><span>Messages</span></a></li>-->
                                        <?php } if ($permission->shipping_charge || $permission->cod_charge || $permission->otp || $permission->return_policy || $permission->amount_policy || $permission->bank_details || $permission->bonus_policy || $permission->indiapost_details || $permission->others) { ?> 
                                        <li class="nav-parent">
                                            <a><i class="fa fa-envelope" aria-hidden="true"></i><span>Setting</span></a>
                                            <ul class="nav nav-children">  
                                                <?php if ($permission->shipping_charge) { ?> 
                                                    <li><a href="<?= site_url() ?>admin/shipping_charge">Shipping Charge Setting</a></li>
                                                <?php } if ($permission->cod_charge) { ?> 
                                                    <li><a href="<?= site_url() ?>admin/cod_charge">COD Charge Setting</a></li>
                                                <?php } if ($permission->return_policy) { ?> 
                                                    <li><a href="<?= site_url() ?>admin/return_policy">Return & Transfer Day Setting</a></li>
                                                <?php } if ($permission->amount_policy) { ?> 
                                                    <li><a href="<?= site_url() ?>admin/amount_policy">Amount Policy Setting</a></li>
                                                <?php } if ($permission->bonus_policy) { ?> 
                                                    <li><a href="<?= site_url() ?>admin/bonus_policy">Bonus Policy Setting</a></li>
                                                <?php } if ($permission->otp) { ?> 
                                                    <li><a href="<?= site_url() ?>admin/otp_setting">OTP Setting</a></li>
                                                <?php } if ($permission->bank_details) { ?> 
                                                    <li><a href="<?= site_url() ?>admin/bank_details">Bank Details</a></li>
                                                <?php } if ($permission->bank_details) { ?> 
                                                    <li><a href="<?= site_url() ?>admin/logo">Change Application Logo</a></li>   
                                                <?php } if ($permission->seo) { ?> 
                                                    <li><a href="<?= site_url() ?>admin/seo">SEO Setting</a></li>
                                                <?php } if ($permission->indiapost_details) { ?> 
                                                    <li><a href="<?= site_url() ?>admin/indiapost_details">IndiaPost Details</a></li> 
                                                <?php } if ($permission->dtdc_details) { ?> 
                                                    <li><a href="<?= site_url() ?>admin/dtdc_details">DTDC Details</a></li>     
                                                <?php } if ($permission->others) { ?> 
                                                    <li><a href="<?= site_url() ?>admin/slider_product">Slider Product Setting</a></li>    
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    <?php } if ($permission->department || $permission->permission) { ?> 
                                        <li class="nav-parent">
                                            <a><i class="fa fa-envelope" aria-hidden="true"></i><span>Employee Department Setting</span></a>
                                            <ul class="nav nav-children"> 
                                                <?php if ($permission->department) { ?> 
                                                    <li><a href="<?= site_url() ?>admin/department">Department Manage</a></li>
                                                <?php } if ($permission->permission) { ?> 
                                                    <li><a href="<?= site_url() ?>admin/department_permission">Department Permission</a></li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    <?php } if ($permission->pages) { ?>
                                        <li class=""><a href="<?= site_url() ?>admin/pages"><i class="fa fa-file" aria-hidden="true"></i><span>Web Pages</span></a></li>
                                        <li class=""><a href="<?= site_url() ?>admin/pages/sellerHome"><i class="fa fa-file" aria-hidden="true"></i><span>Seller Home Page</span></a></li>
                                    <?php } if ($permission->etemplate) { ?>
                                        <li class=""><a href="<?= site_url() ?>admin/email_notification"><i class="fa fa-file" aria-hidden="true"></i><span>E-mail Templates</span></a></li>
                                    <?php } if ($permission->stemplate) { ?>
                                        <li class=""><a href="<?= site_url() ?>admin/sms_notification"><i class="fa fa-file" aria-hidden="true"></i><span>SMS Templates</span></a></li>
                                    <?php } if ($permission->sub_category) { ?> 
                                        <li class=""><a href="<?= site_url() ?>admin/subcategory"><i class="fa fa-anchor" aria-hidden="true"></i><span>Sub Category</span></a></li>
                                    <?php } if ($permission->variation) { ?> 
                                        <li class=""><a href="<?= site_url() ?>admin/variation"><i class="fa fa-gears" aria-hidden="true"></i><span>Variation Master</span></a></li>
                                    <?php } if ($permission->directsms) { ?> 
                                        <li class=""><a href="<?= site_url() ?>admin/directsms"><i class="fa fa-gears" aria-hidden="true"></i><span>Direct SMS</span></a></li>
                                    <?php } if ($permission->change_email) { ?> 
                                        <li class=""><a href="<?= site_url() ?>admin/change_email"><i class="fa fa-gears" aria-hidden="true"></i><span>Change Email</span></a></li>
                                    <?php } if ($permission->change_mobile) { ?> 
                                        <li class=""><a href="<?= site_url() ?>admin/change_mobile"><i class="fa fa-gears" aria-hidden="true"></i><span>Change Mobile</span></a></li>    
                                    <?php } if ($permission->others) { ?> 
                                        <li class="nav-parent">
                                            <a><i class="fa fa-envelope" aria-hidden="true"></i><span>Software</span></a>
                                            <ul class="nav nav-children">                                                    
                                                <li class="nav-parent">
                                                    <a><i class="fa fa-envelope" aria-hidden="true"></i><span>All Orders</span></a>
                                                    <ul class="nav nav-children"> 
                                                        <li><a href="<?= site_url() ?>admin/others/allShipped">Shipped Order</a></li>
                                                        <li><a href="<?= site_url() ?>admin/others/allCancel">Cancel Order</a></li>
                                                        <li><a href="<?= site_url() ?>admin/others/allShippedCancel">Ship Cancel Order</a></li>
                                                        <li><a href="<?= site_url() ?>admin/others/allDelivered">Delivered Order</a></li>
                                                        <li><a href="<?= site_url() ?>admin/others/allReturn">Return Order</a></li>
                                                        <li><a href="<?= site_url() ?>admin/others/allRefund">Refund Order</a></li>
                                                    </ul>
                                                </li>
                                                <li class="nav-parent">
                                                    <a><i class="fa fa-envelope" aria-hidden="true"></i><span>Fedex Orders</span></a>
                                                    <ul class="nav nav-children"> 
                                                        <li><a href="<?= site_url() ?>admin/others/allFedex">All Order</a></li>
                                                        <li><a href="<?= site_url() ?>admin/others/fedexShipped">Shipped Order</a></li>
                                                        <li><a href="<?= site_url() ?>admin/others/fedexCancel">Cancel Order</a></li>
                                                        <li><a href="<?= site_url() ?>admin/others/fedexShippedCancel">Ship Cancel Order</a></li>
                                                        <li><a href="<?= site_url() ?>admin/others/fedexDelivered">Delivered Order</a></li>
                                                        <li><a href="<?= site_url() ?>admin/others/fedexReturn">Return Order</a></li>
                                                        <li><a href="<?= site_url() ?>admin/others/fedexRefund">Refund Order</a></li>
                                                        <li><a href="<?= site_url() ?>admin/others/fedexCod">Cod Order</a></li>
                                                        <li><a href="<?= site_url() ?>admin/others/fedexCard">Prepaid Order</a></li>
                                                    </ul>
                                                </li>
                                                <li class="nav-parent">
                                                    <a><i class="fa fa-envelope" aria-hidden="true"></i><span>IndiaPost Orders</span></a>
                                                    <ul class="nav nav-children"> 
                                                        <li><a href="<?= site_url() ?>admin/others/allIndiaPost">All Order</a></li>
                                                        <li><a href="<?= site_url() ?>admin/others/indiaPostShipped">Shipped Order</a></li>
                                                        <li><a href="<?= site_url() ?>admin/others/indiaPostCancel">Cancel Order</a></li>
                                                        <li><a href="<?= site_url() ?>admin/others/indiaPostShippedCancel">Ship Cancel Order</a></li>
                                                        <li><a href="<?= site_url() ?>admin/others/indiaPostDelivered">Delivered Order</a></li>
                                                        <li><a href="<?= site_url() ?>admin/others/indiaPostReturn">Return Order</a></li>
                                                        <li><a href="<?= site_url() ?>admin/others/indiaPostRefund">Refund Order</a></li>
                                                        <li><a href="<?= site_url() ?>admin/others/indiaPostCod">Cod Order</a></li>
                                                        <li><a href="<?= site_url() ?>admin/others/indiaPostCard">Prepaid Order</a></li>
                                                    </ul>
                                                </li>
                                                <li class="nav-parent">
                                                    <a><i class="fa fa-envelope" aria-hidden="true"></i><span>Dtdc Orders</span></a>
                                                    <ul class="nav nav-children"> 
                                                        <li><a href="<?= site_url() ?>admin/others/allDtdc">All Order</a></li>
                                                        <li><a href="<?= site_url() ?>admin/others/dtdcShipped">Shipped Order</a></li>
                                                        <li><a href="<?= site_url() ?>admin/others/dtdcCancel">Cancel Order</a></li>
                                                        <li><a href="<?= site_url() ?>admin/others/dtdcShippedCancel">Ship Cancel Order</a></li>
                                                        <li><a href="<?= site_url() ?>admin/others/dtdcDelivered">Delivered Order</a></li>
                                                        <li><a href="<?= site_url() ?>admin/others/dtdcReturn">Return Order</a></li>
                                                        <li><a href="<?= site_url() ?>admin/others/dtdcRefund">Refund Order</a></li>
                                                        <li><a href="<?= site_url() ?>admin/others/dtdcCod">Cod Order</a></li>
                                                        <li><a href="<?= site_url() ?>admin/others/dtdcCard">Prepaid Order</a></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <a href="<?= site_url() ?>admin/others/payumoneyOrders"><i class="fa fa-envelope" aria-hidden="true"></i><span>Payumoney Orders</span></a>
                                                </li>
                                                <li class="nav-parent">
                                                    <a><i class="fa fa-envelope" aria-hidden="true"></i><span>Received Payments</span></a>
                                                    <ul class="nav nav-children"> 
                                                        <li><a href="<?= site_url() ?>admin/others/fedexPayments">Fedex Payment</a></li>
                                                        <li><a href="<?= site_url() ?>admin/others/indiapostPayments">Indiapost Payment</a></li>
                                                        <li><a href="<?= site_url() ?>admin/others/dtdcPayments">Dtdc Payment</a></li>
                                                        <li><a href="<?= site_url() ?>admin/others/payumoneyPayments">Payumoney Payment</a></li>
                                                    </ul>
                                                </li>
                                                <li class="nav-parent">
                                                    <a><i class="fa fa-envelope" aria-hidden="true"></i><span>Expense Payment</span></a>
                                                    <ul class="nav nav-children"> 
                                                        <li><a href="<?= site_url() ?>admin/others/fedexExpenses">Fedex Expense Payment</a></li>
                                                        <li><a href="<?= site_url() ?>admin/others/indiapostExpenses">Indiapost Expense Payment</a></li>
                                                        <li><a href="<?= site_url() ?>admin/others/dtdcExpenses">Dtdc Expense Payment</a></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <a href="<?= site_url() ?>admin/others/CAReport"><i class="fa fa-user" aria-hidden="true"></i><span>CA Report</span></a>
                                                </li> 
                                                <li>
                                                    <a href="<?= site_url() ?>admin/others/sellerBalance"><i class="fa fa-envelope" aria-hidden="true"></i><span>Seller Balance</span></a>
                                                </li>
                                                <li>
                                                    <a href="<?= site_url() ?>admin/others/expense"><i class="fa fa-user" aria-hidden="true"></i><span>Expense Management</span></a>
                                                </li> 
                                                <li>
                                                    <a href="<?= site_url() ?>admin/others/revenue"><i class="fa fa-user" aria-hidden="true"></i><span>Profit/Loss Management</span></a>
                                                </li> 
                                                <li>
                                                    <a href="<?= site_url() ?>admin/others/courier"><i class="fa fa-user" aria-hidden="true"></i><span>Courier Profit/Loss</span></a>
                                                </li>  
                                                <li>
                                                    <a href="<?= site_url() ?>admin/others/bulkSms"><i class="fa fa-user" aria-hidden="true"></i><span>Bulk Sms Management</span></a>
                                                </li>  
                                            </ul>
                                        </li>                                        
                                    <?php } ?>
                                </ul>
                            </nav>                           
                        </div>
                    </div>
                </aside>
                <!-- end: sidebar -->                