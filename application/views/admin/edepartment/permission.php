<section role="main" class="content-body">
    <header class="page-header">
        <h2>Department Permission Master</h2>

        <div class="right-wrapper pull-right" style="padding-right: 10px;">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= site_url() ?>admin">
                        <i class="fa fa-home"></i>
                    </a>
                </li>                
                <li><span>Department Permission Master</span></li>
            </ol>           
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-md-12">
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Department Detail</h2>
                </header>
                <div class="panel-body">
                    <form id="departmentsearchform" class="form-horizontal" method="POST" action="<?= site_url() ?>admin/department_permission/getPermission">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Department</label>
                            <div class="col-md-4">
                                <select id="department_id" name="department_id" class="form-control" required>
                                    <option value="-1" >--Select--</option>
                                    <?php
                                    if (isset($department)) {
                                        foreach ($department as $val) {
                                            ?>
                                            <option value="<?= $val->department_id ?>"
                                            <?php
                                            if (isset($_POST['department_id'])) {
                                                if ($val->department_id == $_POST['department_id']) {
                                                    echo "selected";
                                                }
                                            }
                                            ?>
                                                    ><?= $val->department_name ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                </select>
                            </div>
                        </div>                                                                      
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-4">
                                <button id="search" type="button" class="mb-xs mt-xs mr-xs btn btn-success" style="width:100px" >Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">             
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Department Permission  Detail</h2>
                </header>
                <form name="permissionform" method="post" action="<?= site_url() ?>admin/department_permission/setPermission">
                    <div class="panel-body">  
                        <input type="hidden" name="department_id" value="<?= isset($permission->department_id) ? $permission->department_id : '' ?>"/>
                        <div class="row">
                            <div class="col-md-3">
                                <ul>
                                    <li>
                                        <input name="approved_product" type="checkbox" <?= isset($permission) ? ($permission->approved_product == '1') ? 'checked' : '' : '' ?>>
                                        Approved Products
                                    </li>
                                    <li>
                                        <input name="live_product" type="checkbox" <?= isset($permission) ? ($permission->live_product == '1') ? 'checked' : '' : '' ?>>
                                        Live Products
                                    </li>
                                    <li>
                                        <input name="rejected_product" type="checkbox" <?= isset($permission) ? ($permission->rejected_product == '1') ? 'checked' : '' : '' ?> >
                                        Rejected Products
                                    </li>
                                    <li>
                                        <input name="request_product" type="checkbox" <?= isset($permission) ? ($permission->request_product == '1') ? 'checked' : '' : '' ?>>
                                        Approval Request
                                    </li> 
                                </ul>                            
                            </div>
                            <div class="col-md-3">
                                <ul>
                                    <li>
                                        <input name="seller" type="checkbox" <?= isset($permission) ? ($permission->seller == '1') ? 'checked' : '' : '' ?>>
                                        Seller Master
                                    </li> 
                                    <li>
                                        <input name="customer" type="checkbox" <?= isset($permission) ? ($permission->customer == '1') ? 'checked' : '' : '' ?>>
                                        Customer Master
                                    </li> 
                                    <li>
                                        <input name="seller_group" type="checkbox" <?= isset($permission) ? ($permission->seller_group == '1') ? 'checked' : '' : '' ?>>
                                        Seller Group
                                    </li> 
                                    <li>
                                        <input name="advertisement" type="checkbox" <?= isset($permission) ? ($permission->advertisement == '1') ? 'checked' : '' : '' ?>>
                                        Advertisement
                                    </li> 
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <ul>
                                    <li>
                                        <input name="bulksms" type="checkbox" <?= isset($permission) ? ($permission->bulksms == '1') ? 'checked' : '' : '' ?>>
                                        Bulk Sms
                                    </li> 
                                    <li>
                                        <input name="bulkemail" type="checkbox" <?= isset($permission) ? ($permission->bulkemail == '1') ? 'checked' : '' : '' ?>>
                                        Bulk Email
                                    </li> 
                                    <li>
                                        <input name="acmanager" type="checkbox" <?= isset($permission) ? ($permission->acmanager == '1') ? 'checked' : '' : '' ?>>
                                        Account Manager
                                    </li> 
                                    <li>
                                        <input name="payout" type="checkbox" <?= isset($permission) ? ($permission->payout == '1') ? 'checked' : '' : '' ?>>
                                        Payout Request & Details
                                    </li> 
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <ul>
                                    <li>
                                        <input name="product_rate" type="checkbox" <?= isset($permission) ? ($permission->product_rate == '1') ? 'checked' : '' : '' ?>>
                                        Product Rating
                                    </li> 
                                    <li>
                                        <input name="seller_rate" type="checkbox" <?= isset($permission) ? ($permission->seller_rate == '1') ? 'checked' : '' : '' ?>>
                                        Seller Rating 
                                    </li> 
                                    <!--                                    
                                           <li>
                                          <input name="messages" type="checkbox" <?= isset($permission) ? ($permission->messages == '1') ? 'checked' : '' : '' ?>>
                                          Messages
                                          </li> 
                                    -->
                                    <li>
                                        <input name="refund_request" type="checkbox" <?= isset($permission) ? ($permission->refund_request == '1') ? 'checked' : '' : '' ?>>
                                        Customer Refund Request
                                    </li>
                                    <li>
                                        <input name="refund_paid" type="checkbox" <?= isset($permission) ? ($permission->refund_paid == '1') ? 'checked' : '' : '' ?>>
                                        Customer Refund Paid
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <ul>
                                    <li>
                                        <input name="sub_category" type="checkbox" <?= isset($permission) ? ($permission->sub_category == '1') ? 'checked' : '' : '' ?>>
                                        Sub Category
                                    </li> 
                                    <li>
                                        <input name="variation" type="checkbox" <?= isset($permission) ? ($permission->variation == '1') ? 'checked' : '' : '' ?>>
                                        Variation 
                                    </li> 
                                    <li>
                                        <input name="order_shipping_charge" type="checkbox" <?= isset($permission) ? ($permission->order_shipping_charge == '1') ? 'checked' : '' : '' ?>>
                                        Order Shipping Charge
                                    </li>                                     
                                    <li>
                                        <input name="bank_details" type="checkbox" <?= isset($permission) ? ($permission->bank_details == '1') ? 'checked' : '' : '' ?>>
                                        Bank Details
                                    </li> 
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <ul>
                                    <li>
                                        <input name="sms_setting" type="checkbox" <?= isset($permission) ? ($permission->sms_setting == '1') ? 'checked' : '' : '' ?>>
                                        Sms Setting
                                    </li> 
                                    <li>
                                        <input name="shipping_charge" type="checkbox" <?= isset($permission) ? ($permission->shipping_charge == '1') ? 'checked' : '' : '' ?>>
                                        Shipping Charge Setting
                                    </li> 
                                    <li>
                                        <input name="department" type="checkbox" <?= isset($permission) ? ($permission->department == '1') ? 'checked' : '' : '' ?>>
                                        Department Manage
                                    </li> 
                                    <li>
                                        <input name="permission" type="checkbox" <?= isset($permission) ? ($permission->permission == '1') ? 'checked' : '' : '' ?>>
                                        Permission
                                    </li> 
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <ul>
                                    <li>
                                        <input name="employee" type="checkbox" <?= isset($permission) ? ($permission->employee == '1') ? 'checked' : '' : '' ?>>
                                        Employee Manage
                                    </li> 
                                    <li>
                                        <input name="coupon" type="checkbox" <?= isset($permission) ? ($permission->coupon == '1') ? 'checked' : '' : '' ?>>
                                        Coupon Manage
                                    </li> 
                                    <li>
                                        <input name="otp" type="checkbox" <?= isset($permission) ? ($permission->otp == '1') ? 'checked' : '' : '' ?>>
                                        OTP Manage
                                    </li> 
                                    <li>
                                        <input name="pages" type="checkbox" <?= isset($permission) ? ($permission->pages == '1') ? 'checked' : '' : '' ?>>
                                        Web Pages
                                    </li> 
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <ul>
                                    <li>
                                        <input name="etemplate" type="checkbox" <?= isset($permission) ? ($permission->etemplate == '1') ? 'checked' : '' : '' ?>>
                                        Email Template
                                    </li> 
                                    <li>
                                        <input name="stemplate" type="checkbox" <?= isset($permission) ? ($permission->etemplate == '1') ? 'checked' : '' : '' ?>>
                                        SMS Template
                                    </li>
                                    <li>
                                        <input name="cod_charge" type="checkbox" <?= isset($permission) ? ($permission->cod_charge == '1') ? 'checked' : '' : '' ?>>
                                        COD Charge Setting
                                    </li>
                                    <li>
                                        <input name="return_policy" type="checkbox" <?= isset($permission) ? ($permission->return_policy == '1') ? 'checked' : '' : '' ?>>
                                        Return Day Setting
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <ul>                               
                                    <li>
                                        <input name="otp" type="checkbox" <?= isset($permission) ? ($permission->seo == '1') ? 'checked' : '' : '' ?>>
                                        SEO Manage
                                    </li> 
                                    <li>
                                        <input name="order" type="checkbox" <?= isset($permission) ? ($permission->order == '1') ? 'checked' : '' : '' ?>>
                                        Order History
                                    </li> 
                                    <li>
                                        <input name="deleted_product" type="checkbox" <?= isset($permission) ? ($permission->deleted_product == '1') ? 'checked' : '' : '' ?>>
                                        Deleted Products
                                    </li>
                                    <li>
                                        <input name="directsms" type="checkbox" <?= isset($permission) ? ($permission->directsms == '1') ? 'checked' : '' : '' ?>>
                                        Direct SMS
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <ul>
                                    <li>
                                        <input name="order_track" type="checkbox" <?= isset($permission) ? ($permission->order_track == '1') ? 'checked' : '' : '' ?>>
                                        Order Tracking
                                    </li>
                                    <li>
                                        <input name="order_fail" type="checkbox" <?= isset($permission) ? ($permission->order_fail == '1') ? 'checked' : '' : '' ?>>
                                        Order Fail History
                                    </li>
                                    <li>
                                        <input name="change_email" type="checkbox" <?= isset($permission) ? ($permission->change_email == '1') ? 'checked' : '' : '' ?>>
                                        Change Email
                                    </li>
                                    <li>
                                        <input name="change_mobile" type="checkbox" <?= isset($permission) ? ($permission->change_mobile == '1') ? 'checked' : '' : '' ?>>
                                        Change Mobile
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <hr>                        
                        <div class="row">
                            <center>
                                <div class="col-md-12">
                                    <button  type="submit" class="btn btn-success" >Save Changes</button>
                                </div>
                            </center>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
    <!-- end: page -->
</section>
<?php $msg = $this->input->get('msg'); ?>
<?php
switch ($msg) {
    case "U":
        $m = "Permission Successfully Updated..!";
        $t = "success";
        break;
    default:
        $m = 0;
        break;
}
?>
<script type="text/javascript">
    $(document).ready(function() {
<?php if ($msg): ?>
            alertify.<?= $t ?>("<?= $m ?>");
<?php endif; ?>

        $('#search').click(function() {
            if ($('#department_id').val() != '-1') {
                $('#departmentsearchform').submit();
            } else {
                alertify.error("Select Department");
            }
        });

    });
</script>