<section role="main" class="content-body">
    <header class="page-header">
        <h2>Logo Setting</h2>

        <div class="right-wrapper pull-right" style="padding-right: 10px;">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= site_url() ?>admin">
                        <i class="fa fa-home"></i>
                    </a>
                </li>                
                <li><span>Application Logo</span></li>
            </ol>           
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-md-12">
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Application Logo</h2>
                </header>
                <div class="panel-body">
                    <form id="applogo" class="form-horizontal" enctype="multipart/form-data" method="POST" action="<?= site_url() ?>admin/logo/uploadLogo">
                        <div class="form-group">
                            <img src="<?= base_url() ?>assets/images/logo.png" class="col-md-3" style="height: 80px;border:1px solid black;margin-left: 15px;padding: 15px; }"/>
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
                                            <input id="logo" name="picture" type="file" />
                                        </span>
                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>
                                <button type="submit" class="mb-xs mt-xs mr-xs btn btn-success" style="width:100px">Save</button>
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
                    <h2 class="panel-title">Home Page Popup</h2>
                </header>
                <div class="panel-body">
                    <form id="homepopup" class="form-horizontal" enctype="multipart/form-data" method="POST" action="<?= site_url() ?>admin/logo/uploadPopup">
                        <div class="form-group">
                            <img src="<?= base_url() ?>assets/images/popup.png" class="col-md-3" style="height: 80px;border:1px solid black;margin-left: 15px;padding: 15px;"/>
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
                                            <input id="popupimage" name="popupimage" type="file" />
                                        </span>
                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <input type="radio" name="popupstatus" value="1" style='padding: 5px' checked> 
                                    <label class="text-dark" style='padding: 5px'>ON</label> 
                                    <input type="radio" name="popupstatus" value="0" style='padding: 5px' <?=($popupstatus == 0)?'checked':''?>> 
                                    <label class="text-dark" style='padding: 5px'>OFF</label> 
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="mb-xs mt-xs mr-xs btn btn-success" style="width:115px">Save</button>
                                </div>
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
    case "U":
        $m = "Logo Successfully Updated..!";
        $t = "success";
        break;
    case "S":
        $m = "Popup Successfully Updated..!";
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

        $('#applogo').submit(function() {
            if ($('#logo').val() == "") {
                alertify.error("Select Logo File");
                return false;
            } else {
                return true;
            }
        });

        $('#homepopup').submit(function() {
            if ($('#popupimage').val() == "") {
                alertify.error("Select Popup Image File");
                return false;
            } else {
                return true;
            }
        });

    });

</script> 