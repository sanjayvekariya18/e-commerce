<style type="text/css">
    th{
        text-align: center;
    }
    .screenhide{
        position: fixed;
        width: 100%;        
        height: 100%;        
        z-index: 99999;
        opacity: 0.5;
        background-color: white;
        top: 0px;
        left: 0px;
    }
</style>  

<section role="main" class="content-body">
    <header class="page-header">
        <h2>Cancel/Replace/Return Order Request</h2>
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
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>                        
                    </div>

                    <h2 class="panel-title">Advance Search</h2>                    
                </header>
                <div class="panel-body"> 
                    <form name="search" method="POST" action="<?= site_url() ?>admin/order_history/requestSearch">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">Order Date</label>
                                <div class="input-daterange input-group" data-plugin-datepicker>
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>    
                                    </span>
                                    <input type="text" class="form-control" name="start" required>
                                    <span class="input-group-addon">to</span>
                                    <input type="text" class="form-control" name="end" required>
                                </div>   
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">Order Id</label>                          
                                <input name="order_id" type="text" class="form-control" >
                            </div> 
                            <div class="col-md-3">
                                <label class="control-label">Customer Email</label>                          
                                <input name="primary_email" type="text" class="form-control" >
                            </div>
                            <div class="col-md-3">
                                <label class="control-label">Mobile No</label>                          
                                <input name="primary_mobile" type="text" class="form-control" >
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
                    <h2 class="panel-title">Cancel/Replace/Return Order Request</h2>                    
                </header>
                <div class="panel-body">
                    <button id="btnExport1" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px">Export</button>
                    <table class="table table-bordered table-striped mb-none" id="datatable-default" style="text-align: center">
                        <thead>
                            <tr>                                
                                <th style="width:110px !important">Order Date</th>
                                <th>Order Id</th>                                
                                <th>Buyer Name</th>
                                <th>Buyer Mobile</th>
                                <th>Product Name</th>
                                <th>Qty</th>
                                <th>Payment Price</th>
                                <th>Pay Type</th>
                                <th>Request Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>  
                            <?php
                            if (isset($orders)) {
                                foreach ($orders as $val) {
                                    ?>
                                    <tr>
                                        <td><?= date('d-m-Y', strtotime($val->order_date)) ?></td>
                                        <td><?= $val->order_id ?></td>                                        
                                        <td><?= $val->first_name ?></td>
                                        <td><?= $val->buyer_mobile ?></td>
                                        <td><?= $val->product_name ?></td>
                                        <td><?= $val->qty ?></td>
                                        <td><?= $val->payment_price ?></td>
                                        <td><?= $val->pay_method ?></td>
                                        <td>
                                            <?php if ($val->request == 1) { ?>
                                                <span class="label label-info">Request For Cancel</span>
                                            <?php } else if ($val->request == 2) { ?>
                                                <span class="label label-info">Request For Replace</span>  
                                            <?php } else if ($val->request == 3) { ?>
                                                <span class="label label-info">Request For Return</span>
                                            <?php } else if ($val->request == 4) { ?>
                                                <span class="label label-info">Request Reject</span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if ($val->request != 5) { ?>
                                                <button class="btn btn-sm bg-success approve" value="<?= $val->order_id ?>" style="padding: 2px 2px;"><i class="fa fa-check-square"></i></button>
                                                <button class="btn btn-sm bg-danger reject" value="<?= $val->order_id ?>" style="padding: 2px 2px;"><i class="fa fa-times"></i></button>
                                                <button class="btn btn-sm bg-primary reset" value="<?= $val->order_id ?>" style="padding: 2px 2px;"><i class="fa fa-refresh"></i></button>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>            
        </div>
    </div>
    <!-- end: page -->
</section>
<div id="loader" class="screenhide" style="display:none">
    <center>
        <img src="<?= base_url() ?>assets/images/loading_blue.gif" style="margin-top: 320px;width: 100px;height: 100px"/>
        <h3 class="page-heading-title2" style="color:#0088CC;font-size: 28px;margin-top: 10px;">Please Wait ..!!! We Are Approve Your Order Request...</h3>
    </center>
</div>

<script type="text/javascript">
    $(function () {
        $('#datatable-default').dataTable({
            order: [],
            aLengthMenu: [[10, 15, 20, 25, -1], [10, 15, 20, 25, 'All']],
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                }],
            iDisplayLength: -1
        });

        $("#btnExport1").click(function () {
            $("#datatable-default").btechco_excelexport({
                containerid: "datatable-default",
                datatype: $datatype.Table
            });
        });

        $(".approve").click(function () {
            $('#loader').show();
            $.ajax({
                url: "<?= site_url() ?>admin/order_history/approveRequest",
                type: "POST",
                data: {order_id: $(this).val()},
                success: function (data) {
                    $('#loader').hide();
                    alertify.success(data);
                    setTimeout(function () {
                        location.reload();
                    }, 2000);

                }
            });
        });

        $(".reset").click(function () {
            $.ajax({
                url: "<?= site_url() ?>admin/order_history/resetRequest",
                type: "POST",
                data: {order_id: $(this).val()},
                success: function (data) {
                    alertify.success('Your Request Is Reset');
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                }
            });
        });

        $(".reject").click(function () {
            $.ajax({
                url: "<?= site_url() ?>admin/order_history/rejectRequest",
                type: "POST",
                data: {order_id: $(this).val()},
                success: function (data) {
                    alertify.success('Your Request Is Rejected');
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                }
            });
        });

    });
</script>