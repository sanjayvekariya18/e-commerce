<section role="main" class="content-body">
    <header class="page-header">
        <h2>Order Shipping Charge Master</h2>
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
                    <form name="search" method="POST" action="<?= site_url() ?>admin/order_shipping_charge/search">
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
                    <h2 class="panel-title">Order Shipping Charge Detail</h2>                    
                </header>
                <div class="panel-body">
                    <button id="btnExport1" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px">Export</button>
                    <table class="table table-bordered table-striped mb-none" id="datatable-default" style="text-align: center">
                        <thead>
                            <tr>                                                              
                                <th>Order Id</th>
                                <th>Order Date</th>
                                <th>Tracking Id</th>
                                <th>Return Tracking Id</th>
                                <th>Item Price</th>
                                <th>Shipping Charge</th>
                                <th>COD Charge</th>
                                <th>Buyer Name</th>
                                <th>Seller Name</th>
                                <th>Order Status</th>
                                <th>Action</th>
                                <th>Payment</th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php
                            if (isset($transaction)) {
                                $total_shipping = 0;
                                $total_cod = 0;
                                foreach ($transaction as $val) {
                                    $total_shipping += $val->shipping_charge;
                                    $total_cod += $val->cod_charge;
                                    ?>
                                    <tr>
                                        <td><?= $val->order_id ?></td>
                                        <td><?= date('d-m-Y H:i:s', strtotime($val->order_date)) ?></td>
                                        <td><?= $val->awb_no ?></td>
                                        <td><?= $val->return_awb_no ?></td>
                                        <td><?= $val->selling_price ?></td>
                                        <td><?= $val->shipping_charge ?></td>
                                        <td><?= $val->cod_charge ?></td>
                                        <td><?= $val->first_name . " " . $val->last_name ?></td>
                                        <td><?= $val->business_name ?></td>
                                        <td>
                                            <?php if ($val->order_status == 1) { ?>
                                                <span class="label label-primary">Approve</span>
                                            <?php } else if ($val->order_status == 2) { ?>
                                                <span class="label label-dark">Ready To Ship</span>
                                            <?php } else if ($val->order_status == 3) { ?>
                                                <span class="label label-info">Ready To Ship</span>
                                            <?php } else if ($val->order_status == 4) { ?>
                                                <span class="label label-success">Delivery</span>
                                            <?php } else if ($val->order_status == 5) { ?>
                                                <span class="label label-warning">Return</span>
                                            <?php } else if ($val->order_status == 6) { ?>
                                                <span class="label label-danger">Cancel</span>
                                            <?php } else if ($val->order_status == 7) { ?>
                                                <span class="label label-default">Replacement</span>
                                            <?php } else if ($val->order_status == 8) { ?>
                                                <span class="label label-danger">Shipped Cancel</span>
                                            <?php } else if ($val->order_status == 9) { ?>
                                                <span class="label label-success">Refund Paid</span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($val->payable) {
                                                if ($val->order_status == 4) {
                                                    $delivery_date = $this->common->getMainDeliveryDate($val->order_id);
                                                    $return_day = $this->common->returnDay()->return_day;
                                                    $today_date = date('Y-m-d');
                                                    $limitdate = date('Y-m-d', strtotime(date("Y-m-d", strtotime($delivery_date)) . " + " . $return_day . " days"));

                                                    if ($today_date > $limitdate) {
                                                        ?>                                         
                                                        <a id="<?= $val->order_id . "|" . $val->shipping_charge ?>" class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn-success btn-xs edit" href="#modalshippingcharge">
                                                            Edit
                                                        </a> 
                                                        <?php
                                                    }
                                                } else if ($val->order_status != 4) {
                                                    ?>
                                                    <a id="<?= $val->order_id . "|" . $val->shipping_charge ?>" class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn-success btn-xs edit" href="#modalshippingcharge">
                                                        Edit
                                                    </a>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($val->payable) {
                                                if ($val->shipping_update == 1) {
                                                    ?>
                                                    <a id="<?= $val->order_id ?>" class="mb-xs mt-xs mr-xs modal-with-move-anim btn <?= ($val->order_status <= 4) ? 'btn-primary' : 'btn-danger' ?> btn-xs payment" href="#modalpayment">
                                                        <?php
                                                        if ($val->order_status <= 4) {
                                                            echo "Credit";
                                                        } else if ($val->order_status == 5 || $val->order_status == 7 || $val->order_status == 8 || $val->order_status == 9) {
                                                            echo "Debit";
                                                        }
                                                        ?>
                                                    </a>
                                                    <?php
                                                }
                                            } else {
                                                if ($val->order_status <= 4) {
                                                    ?>
                                                    <label class="label label-success">Credited</label>
                                                    <?php
                                                } else if ($val->order_status == 5 || $val->order_status == 7 || $val->order_status == 8 || $val->order_status == 9) {
                                                    ?> 
                                                    <label class="label label-danger">Debited</label>
                                                    <?php
                                                }
                                            }
                                            ?>                                            
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5"></td>
                                <td><?= isset($total_shipping) ? $total_shipping : '-' ?></td>
                                <td><?= isset($total_cod) ? $total_cod : '-' ?></td>
                                <td colspan="5"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </section>            
        </div>
    </div>
    <!--product Shipping Charge Model Start-->
    <div id="modalshippingcharge" class="zoom-anim-dialog modal-block modal-block-sm mfp-hide">
        <form id="modalshippingchargeform" method="POST" class="form-horizontal" >
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Shipping Charge</h2>
                </header>
                <div class="panel-body">
                    <input type="hidden" id="order_id" name="order_id" value=""/>  
                    <div class="form-group">
                        <label class="col-md-4 control-label">Shipping Charge</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="shipping_charge" name="shipping_charge" /> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Reason</label>
                        <div class="col-md-8">
                            <select id="shipping_charge_reason" name="shipping_charge_reason" class="form-control">
                                <option value="Package Dimension Too Long">Package Dimension Too Long</option>
                                <option value="Weight Is More">Weight Is More</option>
                            </select>
                        </div>
                    </div>                    
                </div>                           
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button id="previewconfirm" type="button" class="btn btn-primary ">Confirm</button>
                            <button id="previewcancel" class="btn btn-default modal-dismiss">Cancel</button>
                        </div>
                    </div>
                </footer>
            </section>
        </form>
    </div>
    <!--product Shipping Charge Model End--> 

    <!--order payment Model Start-->
    <div id="modalpayment" class="zoom-anim-dialog modal-block modal-block-sm mfp-hide">
        <form id="modalpaymentform" method="POST" class="form-horizontal" >
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Conformation</h2>
                </header>
                <div class="panel-body">
                    <input type="hidden" id="payment_order_id" name="order_id" value=""/>  
                    <h5>Are You Sure To Complete This Action ? </h5>                                      
                </div>                           
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button id="paymentconfirm" type="button" class="btn btn-primary modal-dismiss">Confirm</button>
                            <button id="paymentcancel" class="btn btn-default modal-dismiss">Cancel</button>
                        </div>
                    </div>
                </footer>
            </section>
        </form>
    </div>
    <!--order payment Model End--> 
    <!-- end: page -->
</section>
<script type="text/javascript">
    $(document).ready(function () {
        edit();
        payment();
        previewConfirm();
        previewConfirm();
        
        $('#datatable-default').dataTable({
            order: [],
            aLengthMenu: [[10, 15, 20, 25, -1], [10, 15, 20, 25, 'All']],
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0, 1, 2, 3]
                }],
            iDisplayLength: 10
        });

        $("#btnExport1").click(function () {
            $("#datatable-default").btechco_excelexport({
                containerid: "datatable-default",
                datatype: $datatype.Table
            });
        });

        $('.dataTables_paginate').click(function () {
            edit();
            payment();
            previewConfirm();
            previewConfirm();
        });

        $('.dataTables_filter input').change(function () {
            edit();
            payment();
            previewConfirm();
            previewConfirm();
        });


        function edit() {
            $('.edit').click(function () {
                $id = $(this).prop('id');
                $splitdata = $id.split("|");
                $('#order_id').val($splitdata[0]);
                $('#shipping_charge').val($splitdata[1]);

            });
        }

        function payment() {
            $('.payment').click(function () {
                $id = $(this).prop('id');
                $('#payment_order_id').val($id);
            });
        }

        function previewConfirm() {
            $('#previewconfirm').click(function () {
                $.ajax({
                    url: "<?= site_url() ?>admin/order_shipping_charge/updateShippingCharge",
                    type: 'POST',
                    data: $('#modalshippingchargeform').serialize(),
                    success: function (data, textStatus, jqXHR) {
                        if (data == 1) {
                            alertify.success("Shippping Charge Updated");
                            $('#previewcancel').trigger('click');
                            setTimeout(function () {
                                location.reload(true);
                            }, 1000);
                        }
                    }
                });
            });
        }

        function paymentConfirm() {
            $('#paymentconfirm').click(function () {
                $.ajax({
                    url: "<?= site_url() ?>admin/order_shipping_charge/orderPayment",
                    type: 'POST',
                    data: $('#modalpaymentform').serialize(),
                    success: function (data, textStatus, jqXHR) {
                        if (data == 1) {
                            alertify.success("Payment Transaction Complete");
                            setTimeout(function () {
                                location.reload(true);
                            }, 1000);
                        } else {
                            alertify.success("Payment Transaction Failed");
                            setTimeout(function () {
                                location.reload(true);
                            }, 1000);
                        }
                    }
                });
            });
        }
    });
</script>