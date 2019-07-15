<section role="main" class="content-body">
    <header class="page-header">
        <h2>Variation Master</h2>

        <div class="right-wrapper pull-right" style="padding-right: 10px;">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= site_url() ?>admin">
                        <i class="fa fa-home"></i>
                    </a>
                </li>                
                <li><span>Variation Master</span></li>
            </ol>           
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-md-12">
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Variation Detail</h2>
                </header>
                <div class="panel-body">
                    <form id="variationform" class="form-horizontal" method="POST" action="#">
                        <input id="variation_id" type="hidden" name="variation_id">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Variation Type</label>
                            <div class="col-md-4">
                                <select id="variation_type" name="variation_type" class="form-control">
                                    
                                    <option value="-1">--Select--</option>
                                    <option value="blouse_fabric">Blouse Fabric</option>
                                    <option value="bottom_fabric">Bottom Fabric</option>
                                    <option value="bottom_colour">Bottom Colour</option>
                                    <option value="bottom_size">Bottom Size</option>
                                    <option value="colour">Colour</option>
                                    <option value="celebrity">Celebrity</option>
                                    <option value="collection">Collection</option>
                                    <option value="catalog">Catalog No</option>
                                    <option value="celebrity">Celebrity</option>
                                    <option value="dupatta_size">Dupatta Size</option>
                                    <option value="dupatta_fabric">Dupatta Fabric</option>
                                    <option value="dupatta_colour">Dupatta Colour</option>
                                    <option value="fabric">Fabric</option>
                                    <option value="fabric_care">Fabric Care</option>
                                    <option value="fine_or_fashion">Fine or Fashion</option>
                                    <option value="fit">Fit</option>
                                    <option value="gender">Gender</option>
                                    <option value="gem_stone">Gem Stone</option>
                                    <option value="inner_fabric">Inner Fabric</option>
                                    <option value="material">Material</option>
                                    <option value="metals_type">Metals Type</option>
                                    <option value="occasion">Occasion</option>
                                    <option value="rise">Rise</option>
                                    <option value="shipping">Shipping Time</option>
                                    <option value="saree_style">Saree Style</option>
                                    <option value="salwar_kameez_style">Salwar Kameez Style</option>
                                    <option value="saree_length">Saree Length</option>
                                    <option value="saree_border">Saree Border</option>
                                    <option value="sleeve">Sleeve</option>
                                    <option value="style">Style</option>
                                    <option value="size">Size</option>
                                    <option value="stitching">Stitching</option>
                                    <option value="shape">Shape</option>
                                    <option value="setting_type">Setting_type</option>
                                    <option value="type">Type</option>
                                    <option value="top_size">Top Size</option>
                                    <option value="work">Work</option>
                                </select>                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Variation Name :- </label>
                            <div class="col-md-4">
                                <input id="variation_name" name="variation_name" type="text" class="form-control">
                            </div>
                        </div>  
                        <div class="form-group" id="variation_code_block" style="display: none">
                            <label class="col-md-3 control-label">Variation Code :- </label>
                            <div class="col-md-4">
                                <input id="variation_code" name="variation_code" type="text" class="form-control">
                            </div>
                        </div>  
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-4">
                                <button id="saveBtn" name="saveBtn" type="button" class="mb-xs mt-xs mr-xs btn btn-success" style="width:100px" value="save">Save</button>
                                <button type="reset" class="mb-xs mt-xs mr-xs btn btn-danger" style="width:100px">Clear</button>
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
                    <h2 class="panel-title">Variation Detail</h2>
                </header>
                <div class="panel-body">                    
                    <button id="btnExport1" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px;margin-top: 15px;float: left">Export</button>
                    <form id="variationsearchform" class="form-horizontal" method="POST" action="<?= site_url() ?>admin/variation/search">
                        <div class="form-group" style="margin-top: 15px;">
                            <div class="col-md-4">
                                <select id="variation_type_search" name="variation_types" class="form-control">
                                    <option value="-1">-- Select Variation Type --</option>
                                    <option value="blouse_fabric">Blouse Fabric</option>
                                    <option value="bottom_fabric">Bottom Fabric</option>
                                    <option value="bottom_colour">Bottom Colour</option>
                                    <option value="bottom_size">Bottom Size</option>
                                    <option value="colour">Colour</option>
                                    <option value="celebrity">Celebrity</option>
                                    <option value="collection">Collection</option>
                                    <option value="catalog">Catalog No</option>
                                    <option value="celebrity">Celebrity</option>
                                    <option value="dupatta_size">Dupatta Size</option>
                                    <option value="dupatta_fabric">Dupatta Fabric</option>
                                    <option value="dupatta_colour">Dupatta Colour</option>
                                    <option value="fabric">Fabric</option>
                                    <option value="fabric_care">Fabric Care</option>
                                    <option value="fine_or_fashion">Fine or Fashion</option>
                                    <option value="fit">Fit</option>
                                    <option value="gender">Gender</option>
                                    <option value="gem_stone">Gem Stone</option>
                                    <option value="inner_fabric">Inner Fabric</option>
                                    <option value="material">Material</option>
                                    <option value="metals_type">Metals Type</option>
                                    <option value="occasion">Occasion</option>
                                    <option value="rise">Rise</option>
                                    <option value="shipping">Shipping Time</option>
                                    <option value="saree_style">Saree Style</option>
                                    <option value="salwar_kameez_style">Salwar Kameez Style</option>
                                    <option value="saree_length">Saree Length</option>
                                    <option value="saree_border">Saree Border</option>
                                    <option value="sleeve">Sleeve</option>
                                    <option value="style">Style</option>
                                    <option value="size">Size</option>
                                    <option value="stitching">Stitching</option>
                                    <option value="shape">Shape</option>
                                    <option value="setting_type">Setting_type</option>
                                    <option value="type">Type</option>
                                    <option value="top_size">Top Size</option>
                                    <option value="work">Work</option>
                                </select>                                
                            </div>
                        </div>
                    </form>
                    <!--Dynamic Table-->
                    <table class="table table-bordered table-striped mb-none" id="datatable-default">
                        <thead>
                            <tr>                                    
                                <th>Sr No</th>
                                <th style="display: none">Variation Type</th>
                                <th>Variation Name</th>
                                <th>Variation Code</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($variation)) {
                                $srno = 0;
                                foreach ($variation as $val) {
                                    $srno+=1;
                                    ?>                                
                                    <tr>
                                        <td><?= $srno ?></td>
                                        <td style="display: none"><?= $val->variation_type ?></td>
                                        <td><?= $val->variation_name ?></td>
                                        <td><?= $val->variation_code ?></td>
                                        <td>
                                            <button  type="button" class="btn btn-primary btn-xs update" style="width:60px;" value="<?= $val->variation_id ?>">Edit</button>
                                            <button  type="button" value="<?= base64_encode($val->variation_id) ?>" class="btn btn-danger btn-xs delete" style="width:60px;">Delete</button>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <!--Dynamic End-->   
                </div>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Upload Variation File</h2>
                </header>
                <div class="panel-body">
                    <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="<?= site_url() ?>admin/variation/uploadEthinicFile">
                        <div class="form-group" style="margin-bottom: 0px;">
                            <label class="col-md-3 control-label">Ethinic Variation File</label>
                            <div class="col-md-8">   
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="input-append">
                                        <div class="uneditable-input">
                                            <i class="fa fa-file fileupload-exists"></i>
                                            <span class="fileupload-preview"></span>
                                        </div>
                                        <span class="btn btn-default btn-file">
                                            <span class="fileupload-exists">Change</span>
                                            <span class="fileupload-new">Select file</span>
                                            <input id="ethinic" name="ethinic" type="file" />
                                        </span>
                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>                         
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-4">
                                <button id="saveBtn" name="saveBtn" type="submit" class="mb-xs mt-xs mr-xs btn btn-success" style="width:100px" value="save">Upload</button>
                            </div>
                        </div>
                    </form>
                    <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="<?= site_url() ?>admin/variation/uploadLeggingsFile">
                        <div class="form-group" style="margin-bottom: 0px;">
                            <label class="col-md-3 control-label">Leggings Variation File</label>
                            <div class="col-md-8">      
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="input-append">
                                        <div class="uneditable-input">
                                            <i class="fa fa-file fileupload-exists"></i>
                                            <span class="fileupload-preview"></span>
                                        </div>
                                        <span class="btn btn-default btn-file">
                                            <span class="fileupload-exists">Change</span>
                                            <span class="fileupload-new">Select file</span>
                                            <input id="leggings" name="leggings" type="file" />
                                        </span>
                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>                         
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-4">
                                <button id="saveBtn" name="saveBtn" type="submit" class="mb-xs mt-xs mr-xs btn btn-success" style="width:100px" value="save">Upload</button>
                            </div>
                        </div>
                    </form>
                    <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="<?= site_url() ?>admin/variation/uploadJewelleryFile">
                        <div class="form-group" style="margin-bottom: 0px;">
                            <label class="col-md-3 control-label">Jewellery Variation File</label>
                            <div class="col-md-8">     
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="input-append">
                                        <div class="uneditable-input">
                                            <i class="fa fa-file fileupload-exists"></i>
                                            <span class="fileupload-preview"></span>
                                        </div>
                                        <span class="btn btn-default btn-file">
                                            <span class="fileupload-exists">Change</span>
                                            <span class="fileupload-new">Select file</span>
                                            <input id="jewellery" name="jewellery" type="file" />
                                        </span>
                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>                         
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-4">
                                <button id="saveBtn" name="saveBtn" type="submit" class="mb-xs mt-xs mr-xs btn btn-success" style="width:100px" value="save">Upload</button>
                            </div>
                        </div>
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
        $m = "Variation Successfully Saved..!";
        $t = "success";
        break;
    case "U":
        $m = "Variation Successfully Updated..!";
        $t = "success";
        break;
    case "D":
        $m = "Variation Successfully Deleted..!";
        $t = "success";
        break;
    case "US":
        $m = "Variation File Successfully Upload..!";
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
    $(document).ready(function() {
        $flag = 0;
        $variation = "<?= isset($_POST['variation_type']) ? $_POST['variation_type'] : '-1' ?>";
        // $('#variation_type').val($variation);

        $('#variation_type').change(function() {
            if ($(this).val() == 'colour' || $(this).val() == 'bottom_colour' || $(this).val() == 'dupatta_colour') {
                $('#variation_code_block').css('display', 'block');
            } else {
                $('#variation_code_block').css('display', 'none');
            }
        });

        $('#variation_type_search').change(function() {
            if ($(this) != '-1') {
                $('#variationsearchform').submit();
            }
        });

        $('#saveBtn').on("click", function() {
            if ($('#variation_name').val() == "") {
                alertify.error("Enter Variation Name");
                $flag = 0;
            } else {
                $flag = 1;
            }
            if ($flag == 1) {
                $btntype = $(this).val();
                if ($btntype == "save")
                {
                    $url = "<?= site_url() ?>admin/variation/addVariationData";
                    $('#variationform').attr('action', $url);
                    $('#variationform').submit();
                }
                else if ($btntype == "update")
                {
                    $url = "<?= site_url() ?>admin/variation/updateVariationData";
                    $('#variationform').attr('action', $url);
                    $('#variationform').submit();
                }
            }

        });

        $('.update').on("click", function() {
            $id = $(this).val();
            $variation_type = $(this).parent().prev().prev().prev().text();
            $variation_name = $(this).parent().prev().prev().text();
            $variation_code = $(this).parent().prev().text();

            if ($variation_type == 'colour') {
                $('#variation_code_block').css('display', 'block');
            } else {
                $('#variation_code_block').css('display', 'none');
            }

            $('#variation_id').val($id);
            $('#variation_type').val($variation_type);
            $('#variation_name').val($variation_name);
            $('#variation_code').val($variation_code);
            $('#saveBtn').val('update');
            $('#saveBtn').text('update');

        });

        $('.delete').on("click", function() {
            $id = $(this).val();
            alertify.confirm("Are You Sure To Delete This Variation ...!!", function(e) {
                if (e) {
                    window.location.href = "<?= site_url() ?>admin/variation/deleteVariationData?id=" + $id;
                    return true;
                }
                else {
                    return false;
                }
            });
        });

        $('#datatable-default').dataTable({
            order: [],
            aLengthMenu: [[10, 15, 20, 25, -1], [10, 15, 20, 25, 'All']],
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0, 1, 2]
                }],
            iDisplayLength: 10
        });
    });
</script>