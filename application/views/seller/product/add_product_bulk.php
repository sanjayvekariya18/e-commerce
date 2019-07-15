<style type="text/css">
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
        <h2>Add Product</h2>

        <div class="right-wrapper pull-right" style="padding-right: 10px;">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= site_url() ?>seller">
                        <i class="fa fa-home"></i>
                    </a>
                </li>                
                <li><span>Add Product</span></li>
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

                    <h2 class="panel-title">Product Image</h2>                    
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form id="csv_form" class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= site_url() ?>seller/product/bulkupload">
                                <div class="form-group">
                                    <label class="col-md-4 control-label text-danger">Main Category *</label>
                                    <div class="col-md-8">
                                        <select id="main_category_id" name="main_category_id" class="form-control">
                                            <option value="-1">--Select--</option>
                                            <option value="1">Women's Ethnic Wear</option>
                                            <option value="2">Jewellery</option>
                                            <option value="3">Western Wear</option>
                                        </select>                                
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label text-danger">Sub Category *</label>
                                    <div class="col-md-8">
                                        <select id="sub_category_id" name="sub_category_id" class="form-control">
                                            <option value="-1">--Select--</option>
                                        </select>                                
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label text-danger">Select File *</label>
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
                                                    <input id="csvfile" type="file" name="csvfile" required disabled/>
                                                </span>
                                                <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                        </div>                                
                                    </div>                                    
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label"></label>
                                    <div class="col-md-8">
                                        <div style="display: none;margin-top: 10px;" class="calert">
                                            <span style="color: red" class="errorMsg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label"></label>
                                    <div class="col-md-4">
                                        <button id="bulkupload" type="button" class="mb-xs mt-xs mr-xs btn btn-warning">Upload</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-6 control-label">Ethinic Variation List File</label>
                                <label class="col-md-4 control-label"><a href="<?= site_url() ?>seller/product/fileDownload?id=1">Download File </a></label>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label">Leggings Variation List File</label>
                                <label class="col-md-4 control-label"><a href="<?= site_url() ?>seller/product/fileDownload?id=2">Download File </a></label>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label">Jewellery Variation List File</label>
                                <label class="col-md-4 control-label"><a href="<?= site_url() ?>seller/product/fileDownload?id=3">Download File </a></label>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label">Leggings Product File</label>
                                <label class="col-md-4 control-label"><a href="<?= site_url() ?>seller/product/fileDownload?id=4">Download File </a></label>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label">Jewellery Product File</label>
                                <label class="col-md-4 control-label"><a href="<?= site_url() ?>seller/product/fileDownload?id=5">Download File </a></label>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label">Saree Product File</label>
                                <label class="col-md-4 control-label"><a href="<?= site_url() ?>seller/product/fileDownload?id=6">Download File </a></label>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label">Salwar Kurta Product File</label>
                                <label class="col-md-4 control-label"><a href="<?= site_url() ?>seller/product/fileDownload?id=7">Download File </a></label>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label">Dress Material Product File</label>
                                <label class="col-md-4 control-label"><a href="<?= site_url() ?>seller/product/fileDownload?id=8">Download File </a></label>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label">Kurti Product File</label>
                                <label class="col-md-4 control-label"><a href="<?= site_url() ?>seller/product/fileDownload?id=9">Download File </a></label>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label">Lahenga Product Variation File</label>
                                <label class="col-md-4 control-label"><a href="<?= site_url() ?>seller/product/fileDownload?id=10">Download File </a></label>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label">Blouse Product File</label>
                                <label class="col-md-4 control-label"><a href="<?= site_url() ?>seller/product/fileDownload?id=11">Download File </a></label>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label">Duppata Product File</label>
                                <label class="col-md-4 control-label"><a href="<?= site_url() ?>seller/product/fileDownload?id=12">Download File </a></label>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label">Ethinic Bottom Product File</label>
                                <label class="col-md-4 control-label"><a href="<?= site_url() ?>seller/product/fileDownload?id=13">Download File </a></label>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label">Ethinic Set Product File</label>
                                <label class="col-md-4 control-label"><a href="<?= site_url() ?>seller/product/fileDownload?id=14">Download File </a></label>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label">Gown Product File</label>
                                <label class="col-md-4 control-label"><a href="<?= site_url() ?>seller/product/fileDownload?id=15">Download File </a></label>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label">Petticoats Product File</label>
                                <label class="col-md-4 control-label"><a href="<?= site_url() ?>seller/product/fileDownload?id=16">Download File </a></label>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label">Abayas Product File</label>
                                <label class="col-md-4 control-label"><a href="<?= site_url() ?>seller/product/fileDownload?id=17">Download File </a></label>
                            </div>    
                            <div class="form-group">
                                <label class="col-md-6 control-label">Bollywood Product File</label>
                                <label class="col-md-4 control-label"><a href="<?= site_url() ?>seller/product/fileDownload?id=18">Download File </a></label>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>     
    <div id="productloader" class="screenhide" style="display:none">
        <center>
            <img src="<?= base_url() ?>assets/images/loading_blue.gif" style="margin-top: 200px;width: 150px;height: 150px"/>
            <h3 class="page-heading-title2" style="color:#0088CC;font-size: 28px;margin-top: 50px;">Please Wait ..!!! We Are Uploading Your Product...</h3>
        </center>
    </div>
    <!-- end: page -->
</section>
<?php $msg = $this->input->get('msg'); ?>
<?php
switch ($msg) {
    case "S":
        $m = "Product Successfully Uploaded..!";
        $t = "success";
        break;
    case "E":
        $m = "Product Upload Failed..!";
        $t = "error";
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
        var isValid = true;
        $("#csv_form input:file").change(function() {
            $("#csv_form span.errorMsg").empty(); // To remove the previous error message
            var file = this.files[0];
            if (file.type != "application/vnd.ms-excel")
            {
                $('#csv_form .calert').show();
                $('#csv_form span.errorMsg').html("Please Select a valid Image File! Only csv type allowed.");
                isValid = false;
                return false;
            }
            else
            {
                $("#csv_form span.errorMsg").empty();
                $('#csv_form .calert').hide();
                var reader = new FileReader();
                reader.readAsDataURL(this.files[0]);
                isValid = true;
            }
        });
        
        $('#main_category_id').change(function() {
            $main_category_id = $(this).val();
            if ($main_category_id != -1) {
                $.ajax({
                    url: "<?= site_url() ?>seller/product/getSubCategoryByMain",
                    type: "POST",
                    data: {'main_category_id': $main_category_id},
                    success: function(data, textStatus, jqXHR) {
                        $('#sub_category_id').html(data);
                    }
                });
            } else {
                $('#sub_category_id').html('<option value="-1">--Select--</option>');
            }
        });

        $('#sub_category_id').change(function() {
            if ($(this).val() == "-1") {
                $('#csvfile').prop('disabled', true);
                alertify.error("Please Select Product Category");
            } else {
                $('#csvfile').removeAttr('disabled');
            }
        });

        $('#bulkupload').click(function() {
            if ($('#sub_category_id').val() == "-1") {
                alertify.error("Please Select Product Category");
                isValid = false;
            } else if ($('#csvfile').val() == "") {
                alertify.error("Please Select Product File");
                isValid = false;
            } else {
                if (!isValid) {
                    alertify.error("Please Select Product Category Or Valid File ");
                } else {
                    $('#productloader').css('display','block');
                    $('#csv_form #bulkupload').prop('disabled', true);
                    $("#csv_form span.errorMsg").empty();
                    $('#csv_form .calert').hide();
                    $('#csv_form').submit();
                }
            }
        });
    });
</script>