<section role="main" class="content-body">
    <header class="page-header">
        <h2>Product Rating Master</h2>
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
                    <form name="search" method="POST" action="<?= site_url() ?>admin/product_rating/search">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">Date</label>
                                <div class="input-daterange input-group" data-plugin-datepicker>
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>    
                                    </span>
                                    <input type="text" class="form-control" name="start" required>
                                    <span class="input-group-addon">to</span>
                                    <input type="text" class="form-control" name="end" required>
                                </div>   
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
                    <h2 class="panel-title">Product Rating Detail</h2>                    
                </header>
                <div class="panel-body">
                    <button id="btnExport1" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px">Export</button>
                    <!--<button class="btn btn-danger btn-sm mycheck" type="button" style="width:80px;margin-bottom: 15px">Delete</button>-->

                    <table class="table table-bordered table-striped mb-none" id="datatable-default" style="text-align: center">
                        <thead>
                            <tr>                                                              
                                <th>Date</th>
                                <th>Customer Name</th>
                                <th>Business Name</th>
                                <th>Product Name</th>
                                <th>Rating</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php
                            if (isset($productrate)) {
                                foreach ($productrate as $val) {
                                    ?>
                                    <tr>
                                        <td><?= date('d-m-Y', strtotime($val->pratedate)) ?></td>
                                        <td><?= $val->first_name . " " . $val->last_name ?></td>
                                        <td><?= $val->business_name ?></td>
                                        <td><?= $val->product_name ?></td>
                                        <td><?= $val->prate ?></td>                                        
                                        <td><a id="<?= $val->order_id . "|" . $val->product_id ?>" class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn-success btn-xs productrate" href="#modalproductreview">Edit</a></td>

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
    <!--product Review Model Start-->
    <div id="modalproductreview" class="zoom-anim-dialog modal-block modal-block-sm mfp-hide">
        <form id="modalproductreviewform" method="POST" class="form-horizontal" >
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Product Review</h2>
                </header>
                <div class="panel-body">
                    <input type="hidden" id="prate_order_id" name="order_id" value=""/>  
                    <input type="hidden" id="prate_product_id" name="product_id" value=""/>  
                    <div class="form-group">
                        <label class="col-md-3 control-label">Rate</label>
                        <div class="col-md-3">
                            <select id="prate" name="prate" class="form-control">
                                <option value="5">5</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Review</label>
                        <div class="col-md-8">
                            <textarea id="preview" name="preview" class="form-control" rows="3" required></textarea>
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
    <!--product Review Model End--> 
    <!-- end: page -->
</section>
<script type="text/javascript">
    $(document).ready(function() {
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

        $('.productrate').click(function() {
            $id = $(this).prop('id');
            $splitdata = $id.split("|");
            $order_id = $splitdata[0];
            $product_id = $splitdata[1];
            $('#prate_order_id').val($order_id);
            $('#prate_product_id').val($product_id);
            $.ajax({
                url: "<?= site_url() ?>admin/product_rating/getProductRate",
                type: 'POST',
                data: {'order_id': $order_id},
                success: function(data, textStatus, jqXHR) {
                    $productreview = data.split("|");
                    if ($productreview[1] != "") {
                        $('#prate').val($productreview[0]);
                        $('#preview').val($productreview[1]);
                    }
                }
            });
        });

        $('#previewconfirm').click(function() {
            $.ajax({
                url: "<?= site_url() ?>admin/product_rating/setProductRate",
                type: 'POST',
                data: $('#modalproductreviewform').serialize(),
                success: function(data, textStatus, jqXHR) {
                    if (data == 1) {
                        alertify.success("Product Review Updated ..!");
                        $('#previewcancel').trigger('click');
                        setTimeout(function() {
                            location.reload(true);
                        }, 1000);                        
                    }
                }
            });

        });
    });
</script>