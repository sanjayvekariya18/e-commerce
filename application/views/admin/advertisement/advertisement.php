<section role="main" class="content-body">
    <header class="page-header">
        <h2>Advertisement Management</h2>

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

                    <h2 class="panel-title">Advertisement Details</h2>                    
                </header>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-6">
                            <form id="uploadimageform" class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= site_url() ?>admin/advertisement/uploadImage">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Image Box</label>
                                    <div class="col-md-6">
                                        <select id="box" name="box" class="form-control">
                                            <option value="-1">---Select---</option>
                                            <option value="1">Slide 1</option>
                                            <option value="2">Slide 2</option>
                                            <option value="3">Slide 3</option>
                                            <option value="4">Box 1</option>
                                            <option value="5">Box 2</option>
                                            <option value="6">Box 3</option>
                                            <option value="7">Box 4</option>
                                            <option value="8">Box 5</option>
                                            <option value="9">Box 6</option>
                                            <option value="10">Logo 1</option>
                                            <option value="11">Logo 2</option>
                                            <option value="12">Logo 3</option>
                                            <option value="13">Logo 4</option>
                                            <option value="14">Logo 5</option>
                                            <option value="15">Logo 6</option>
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
                                    <label class="col-md-3 control-label">Link</label>
                                    <div class="col-md-8">
                                        <input id="link" type="text" class="form-control" name="link" />
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
                            <img id="preview" src="<?= base_url() ?>upload/banner/default.jpg" style="border: 4px double;width: 300px;height: auto;max-height: 200px"/><br/>

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
                $src = "<?= base_url() ?>upload/banner/" + $image_name;
                $('#preview').attr('src', $src);

                switch ($box) {
                    case "1":
                    case "2":
                    case "3":
                        $('#size').text('1185 X 450');
                        break;
                    case "4":
                    case "5":
                    case "6":
                    case "7":
                    case "8":
                    case "9":
                        $('#size').text('610 X 400');
                        break;
                    case "10":
                    case "11":
                    case "12":
                    case "13":
                    case "14":
                    case "15":
                        $('#size').text('160 X 100');
                        break;
                    default:
                        break;

                }

                $.ajax({
                    url: "<?= site_url() ?>admin/advertisement/getUrl",
                    type: "post",
                    data: {'block': $box},
                    success: function(data, textStatus, jqXHR) {
                        $('#link').val(data);
                    }
                });
            }
        });
    });
</script>