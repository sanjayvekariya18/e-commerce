<section role="main" class="content-body">
    <header class="page-header">
        <h2>Rejected Product Management</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= site_url() ?>seller">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
            </ol>           
        </div>
    </header>
    <!-- start: page -->
<!--    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-up"></a>                        
                    </div>

                    <h2 class="panel-title">Advance Search</h2>                    
                </header>
                <div class="panel-body" style="display:none"> 
                    <form name="search" method="POST" action="<?= site_url() ?>seller/rejected/search">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Sub Category Name</label>
                            <div class="col-md-4">
                                <select id="sub_category_id" name="sub_category_id" class="form-control">
                                    <option value="-1">--Select--</option>
                                    <?php
                                    if (isset($subcategory)) {
                                        foreach ($subcategory as $val) {
                                            ?>
                                            <option value="<?= $val->subcategory_id ?>"><?= $val->subcategory_name ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select> 
                            </div>
                            <div class="col-md-2">
                                 <button class="btn btn-success btn-sm" type="submit" style="width:80px">Search</button>
                            </div>
                        </div> 
                    </form>
                </div>
            </section>            
        </div>
    </div>-->
    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>                                    
                    </div>
                    <h2 class="panel-title">Rejected Details</h2>
                </header>
                <div class="panel-body">
                    <button id="btnExport1" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px">Export</button>
                    <table class="table table-striped mb-none" id="datatable-default1">
                        <thead>
                            <tr>
                                <th style="width:55%">Product details</th>
                                <th style="text-align:center">Rejected By</th>
                                <th style="text-align:center">Reason</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($products)) {
                                foreach ($products as $val) {
                                    ?>

                                    <tr>                                        
                                        <td>
                                            <img src="<?= $val->image_medium ?>" width="100" height="100" style="border:1px;float: left;margin-right: 25px;"/>
                                            <table>
                                                <tr>
                                                    <td colspan="2"><label class="text-dark" style="font-weight: bold">SKU:  <?= $val->sku ?></label></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"><label class="text-primary" style="font-weight: bold"><?= $val->product_name ?></label></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 150px;"><label class="text-dark" style="font-weight: bold">SUPC</label></td>
                                                    <td><label class="text-dark"><?= $val->product_supc ?></label></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 150px;"><label class="text-dark" style="font-weight: bold">Brand</label></td>
                                                    <td><label class="text-dark"><?= $val->brand ?></label></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 150px;"><label class="text-dark" style="font-weight: bold">Style Code</label></td>
                                                    <td><label class="text-dark"><?= $val->style_code ?></label></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="text-align: center"><label class="text-dark" style="font-weight: bold"><?= $val->updator_name ?></label></td>
                                        <td style="text-align: center"><label class="text-dark" style="font-weight: bold"><?= $val->reject_reason ?></label></td>
                                        <td style="text-align: right">
                                            <a class="btn btn-default" href="<?=  site_url()?>seller/product/editProduct?id=<?= base64_encode($val->product_id) ?>">Edit</a>
                                            <a class="btn btn-default" href="<?= site_url() ?>seller/product/view?pid=<?= base64_encode($val->product_id) ?>"target="_blank">Preview</a>
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
<script type="text/javascript">
    $(function() {
        $('#datatable-default').dataTable({
            order: [],
            aLengthMenu: [[10, 15, 20, 25, -1], [10, 15, 20, 25, 'All']],
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0, 1, 2, 3]
                }],
            iDisplayLength: -1
        });
        
        $("#btnExport1").click(function () {
            $("#datatable-default").btechco_excelexport({
                containerid: "datatable-default",              
                datatype: $datatype.Table
            });
        });
    });
</script>
