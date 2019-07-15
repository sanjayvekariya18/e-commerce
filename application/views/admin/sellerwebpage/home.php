<style type="text/css">
    .cke_contents{
        height: 350px !important;
    } 
</style>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Home Pages</h2>

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
                    <h2 class="panel-title">Home Page</h2>                    
                </header>
                <div class="panel-body">

                    <form id="PageForm" action="<?= site_url() ?>admin/pages/updateSellerHomeBlock1" method="post" enctype="multipart/form-data">
                        <div class="row">                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-1 control-label">Title </label>
                                    <div class='col-md-11'>
                                        <textarea id="editor1" name="content" rows="6" cols="80"><?= $block1->content ?></textarea>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label" style="text-align:center">Background Image</label>
                                    <div class="col-md-6">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="input-append">
                                                <div class="uneditable-input">
                                                    <i class="fa fa-file fileupload-exists"></i>
                                                    <span class="fileupload-preview"></span>
                                                </div>
                                                <span class="btn btn-default btn-file">
                                                    <span class="fileupload-exists">Change</span>
                                                    <span class="fileupload-new">Select file</span>
                                                    <input id="background" type="file" name="background"/>
                                                </span>
                                                <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label" style="text-align:center">Front Image</label>
                                    <div class="col-md-5">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="input-append">
                                                <div class="uneditable-input">
                                                    <i class="fa fa-file fileupload-exists"></i>
                                                    <span class="fileupload-preview"></span>
                                                </div>
                                                <span class="btn btn-default btn-file">
                                                    <span class="fileupload-exists">Change</span>
                                                    <span class="fileupload-new">Select file</span>
                                                    <input id="front" type="file" name="front"/>
                                                </span>
                                                <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                    <label class="col-md-2 control-label" style="text-align:center">Size - (450 X 400)</label>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-1 control-label"></label>
                                    <div class="col-md-4">
                                        <button type="submit"  class="btn btn-warning">Update</button>
                                    </div>
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
<script src="<?= base_url() ?>assets/vendor/ckeditor/ckeditor.js" type="text/javascript"></script>
<?php $msg = $this->input->get('msg'); ?>
<?php
switch ($msg) {
    case "U":
        $m = "Page Successfully Updated..!";
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
    $(function() {
        CKEDITOR.replace('editor1');
    });
</script>
