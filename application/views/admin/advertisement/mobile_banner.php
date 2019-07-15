<section role="main" class="content-body">
    <header class="page-header">
        <h2>Mobile Banner</h2>

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

                    <h2 class="panel-title">Mobile Banner Details</h2>                    
                </header>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-6">
                            <form id="uploadimageform" class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= site_url() ?>admin/advertisement/uploadImageForMobile">

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Image Box</label>
                                    <div class="col-md-6">
                                        <select id="box" name="box" class="form-control">
                                            <option  value="-1">---Select---</option>
                                            <option value="1">Slide 1</option>
                                            <option value="2">Slide 2</option>
                                            <option value="3">Slide 3</option>
                                            <option value="4">Lehenga Choli</option>
                                            <option value="5">Gown</option>
                                            <option value="6">Saree</option>
                                            <option value="7">Kurti</option>
                                            <option value="8">Saree Banner</option>
                                            <option value="9">Jewellery Banner</option>
                                            <option value="10">Dress Material Banner</option>
                                            <option value="11">Leggings Banner</option>
                                        </select>
                                    </div>
                                    <label id="size" class="col-md-2 control-label" style="text-align: center;padding: 0px;">(Size)</label>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Image</label>
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
                                                    <input id="banner" type="file" name="banner" required/>
                                                </span>
                                                <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label>
                                    <div class="col-md-4">
                                        <button id="upload" type="button" class="mb-xs mt-xs mr-xs btn btn-warning">Upload Image</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <img id="preview" src="<?= base_url() ?>upload/mobilebanner/default.jpg" style="border: 4px double;width: 300px;height: auto;max-height: 200px"/><br/>

                        </div>
                    </div>
                </div>
            </section>            
        </div>
    </div>
    <!-- end: page -->
</section>
<?php $msg = $this->input->get('msg'); ?>
<?php
switch ($msg) {
    case "U":
        $m = "Banner Updated..!";
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
        $('#upload').click(function() {
            if ($("#box").val() == "-1") {
                alertify.error("Please Select Block");
            } else {
                $('#uploadimageform').submit();
            }
        });

        $('#box').change(function() {
            $box = $(this).val();
            if ($box != "-1") {
                $image_name = $box + ".jpg";
                $src = "<?= base_url() ?>upload/mobilebanner/" + $image_name;
                $('#preview').attr('src', $src);

                switch ($box) {
                    case "1":
                    case "2":
                    case "3":
                        $('#size').text('300 X 150');
                        break;
                    case "4":
                    case "5":
                    case "6":
                    case "7":
                        $('#size').text('150 X 100');
                        break;
                    case "8":
                    case "9":
                    case "10":
                    case "11":
                        $('#size').text('300 X 100');
                        break;
                    default:
                        break;
                }
            }
        });
    });
</script>