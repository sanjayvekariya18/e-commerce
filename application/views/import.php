<section role="main" class="content-body">
    <header class="page-header">
        <h2>Import Master</h2>

        <div class="right-wrapper pull-right" style="padding-right: 10px;">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= site_url() ?>admin">
                        <i class="fa fa-home"></i>
                    </a>
                </li>                
                <li><span>Import Master</span></li>
            </ol>           
        </div>
    </header>

    <!-- start: page -->   
    
    <div class="row">
        <div class="col-md-12">
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Upload File</h2>
                </header>
                <div class="panel-body">
                    <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="<?= site_url() ?>import/importData">
                        <div class="form-group" style="margin-bottom: 0px;">
                            <label class="col-md-3 control-label">Import File</label>
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
                                            <input id="csvfile" name="csvfile" type="file" required/>
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
        $m = "Data Successfully Import..!";
        $t = "success";
        break;
     case "F":
        $m = "Data Import Failed..!";
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