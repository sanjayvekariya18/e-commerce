<style type="text/css">
    th{
        text-align: center;
    }
</style>    
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Coupons Master</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= site_url() ?>admin">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
            </ol>
        </div>
    </header>
    <!-- start: page --> 
    <div class="row">
        <div class="col-md-12">
            <a href="<?= site_url() ?>admin/coupon/addCoupon" class="btn btn-success btn-md" >Add Coupon</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>                        
                    </div>

                    <h2 class="panel-title">Advance Search</h2>                    
                </header>
                <div class="panel-body"> 
                    <form name="search" method="POST" action="<?= site_url() ?>admin/coupon/searchCoupon">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">Coupon Code</label>                          
                                <input name="coupon_code" type="text" class="form-control" >
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">Value</label>                          
                                <input name="value" type="text" class="form-control" >
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">Type</label> 
                                <select name="type" class="form-control">
                                    <option value="-1">--Select--</option>
                                    <option value="0">Flat</option>
                                    <option value="1">Percentage</option>
                                </select>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 15px">
                            <div class="col-md-4">
                                <button class="btn btn-success btn-sm" type="submit" style="width:80px">Search</button>
                                <button class="btn btn-warning btn-sm" type="reset" style="width:80px">Clear</button>
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
                    <h2 class="panel-title">Coupons Detail</h2>                    
                </header>
                <div class="panel-body">                    
                    <form id="tableform" method="POST" action="#">
                        <button id="btnExport1" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px">Export</button>
                        <button id="delete" class="btn btn-danger btn-sm mycheck" type="button" style="width:80px;margin-bottom: 15px">Delete</button>
                        <button id="active" class="btn btn-success btn-sm mycheck" type="button" style="width:80px;margin-bottom: 15px">Active</button>
                        <button id="deactive" class="btn btn-warning btn-sm mycheck" type="button" style="width:80px;margin-bottom: 15px">Deactive</button>
                        <table class="table table-bordered table-striped mb-none" id="datatable-default" style="text-align: center">
                            <thead>
                                <tr>
                                    <th style="font-size: 17px;padding-right: 18px;text-align: center;">
                                        <i class="fa fa-level-down"></i>     
                                    </th>
                                    <th>Coupon Code</th>
                                    <th>Type</th>
                                    <th>Value</th>
                                    <th>Category / SUPC</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>  
                                <?php
                                if (isset($coupons) && is_array($coupons)) {
                                    foreach ($coupons as $val) {
                                        ?>
                                        <tr>
                                            <td><input name="allCoupon[]" value="<?= $val->id ?>" type="checkbox" ></td>
                                            <td><?= $val->coupon_code ?></td>
                                            <td><?= ($val->type == 0) ? "Flat" : "%" ?></td>
                                            <td><?= $val->value ?></td>
                                            <td><?= ($val->apply_type == 0) ? $val->apply_value : $this->common->getSubcategoryName($val->apply_value) ?></td>
                                            <td>
                                                <?php if ($val->status == 1) { ?>
                                                    <span class="label label-primary">Active</span>
                                                <?php } else if ($val->status == 0) { ?>
                                                    <span class="label label-danger">Deactive</span>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            </section>            
        </div>
    </div>
    <!-- end: page -->
</section>
<?php $msg = $this->input->get('msg'); ?>
<?php
switch ($msg) {
    case "S":
        $m = "Coupon Saved..!";
        $t = "success";
        break;
    case "A":
        $m = "Coupon Active..!";
        $t = "success";
        break;
    case "DE":
        $m = "Coupon Deactive..!";
        $t = "success";
        break;
    case "DA":
        $m = "Coupon Deleted..!";
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
    });
</script>
<script type="text/javascript">
    $(function() {
        $('#datatable-default').dataTable({
            order: [],
            aLengthMenu: [[10, 15, 20, 25, -1], [10, 15, 20, 25, 'All']],
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0, 1, 2, 3, 4]
                }],
            iDisplayLength: 10
        });
        
        $("#btnExport1").click(function () {
            $("#datatable-default").btechco_excelexport({
                containerid: "datatable-default",              
                datatype: $datatype.Table
            });
        });

        $('#delete').click(function() {
            $('#tableform').attr('action', '<?= site_url() ?>admin/coupon/deleteCouponData');
            $('#tableform').submit();
        });

        $('#active').click(function() {
            $('#tableform').attr('action', '<?= site_url() ?>admin/coupon/activeCouponData');
            $('#tableform').submit();
        });

        $('#deactive').click(function() {
            $('#tableform').attr('action', '<?= site_url() ?>admin/coupon/deactiveCouponData');
            $('#tableform').submit();
        });
    });
</script>