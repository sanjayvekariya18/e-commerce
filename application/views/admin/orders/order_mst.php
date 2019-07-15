<style type="text/css">
    th{
        text-align: center;
    }
</style>    
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Order History</h2>

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
                    <form name="search" method="POST" action="<?= site_url() ?>admin/order_history/search">
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
                            <div class="col-md-4">
                                <label class="control-label">Order Id</label>                          
                                <input name="order_id" type="text" class="form-control" >
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">Item Price</label>                          
                                <input name="selling_price" type="text" class="form-control" >
                            </div>
                        </div> 
                        <div class="row" style="margin-top:10px">                           
                            <div class="col-md-4">
                                <label class="control-label">Customer Email</label>                          
                                <input name="primary_email" type="text" class="form-control" >
                            </div>
                            <div class="col-md-4">
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
                    <h2 class="panel-title">Order History</h2>                    
                </header>
                <div class="panel-body">
                    <button id="btnExport1" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px">Export</button>
                    <table class="table table-bordered table-striped mb-none" id="datatable-default" style="text-align: center">
                        <thead>
                            <tr>                                
                                <th style="width:110px !important">Order Date</th>
                                <th>Order Id</th>                                
                                <th>Business Name</th>                                
                                <th>Buyer Name</th>
                                <th>Buyer Mobile</th>
                                <th>Product Name</th>
                                <th>Qty</th>
                                <th>Ship By</th>
                                <th>selling Price</th>                                
                                <th>Payment Price</th>
                                <th>Pay Type</th>
                                <th>Preview</th>
                            </tr>
                        </thead>
                        <tbody>  
                            <?php
                            if (isset($orders)) {
                                foreach ($orders as $val) {
                                    ?>
                                    <tr>
                                        <td><?= date('d-m-Y H:i:s', strtotime($val->order_date)) ?></td>
                                        <td><?= $val->order_id ?></td>                                        
                                        <td><?= $val->business_name ?></td>
                                        <td><?= $val->first_name ?></td>
                                        <td><?= $val->buyer_mobile ?></td>
                                        <td><?= $val->product_name ?></td>
                                        <td><?= $val->qty ?></td>
                                        <td><?php
                                            if ($val->packing_by == 1) {
                                                echo "Fedex";
                                            } else if ($val->packing_by == 2) {
                                                echo "India Post";
                                            } else {
                                                echo "-";
                                            }
                                            ?>
                                        </td>
                                        <td><?= $val->selling_price ?></td>                                        
                                        <td><?= $val->payment_price ?></td>
                                        <td><?= $val->pay_method ?></td>
                                        <td><a class="mb-xs mt-xs mr-xs btn btn-default" href="<?= site_url() ?>admin/product_request/view?pid=<?= base64_encode($val->product_id) ?>"target="_blank">Preview</a></td>
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

<script type="text/javascript">
    $(function() {
        $('#datatable-default').dataTable({
            order: [],
            aLengthMenu: [[10, 15, 20, 25, -1], [10, 15, 20, 25, 'All']],
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0, 1, 2, 3, 4, 5, 6, 7]
                }],
            iDisplayLength: -1
        });

        $("#btnExport1").click(function() {
            $("#datatable-default").btechco_excelexport({
                containerid: "datatable-default",
                datatype: $datatype.Table
            });
        });
    });
</script>