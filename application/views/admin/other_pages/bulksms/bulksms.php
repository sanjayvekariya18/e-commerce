<section role="main" class="content-body">
    <header class="page-header">
        <h2>Bulk Sms Master</h2>

        <div class="right-wrapper pull-right" style="padding-right: 10px;">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= site_url() ?>admin">
                        <i class="fa fa-home"></i>
                    </a>
                </li>                
                <li><span>Bulk Sms Master</span></li>
            </ol>           
        </div>
    </header>

    <!-- start: page -->   
    <div class="row">
        <div class="col-md-12">
            <a href="<?= site_url() ?>admin/others/sendBulkSms" class="btn btn-success btn-md" >Send Sms</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Upload File</h2>
                </header>
                <div class="panel-body">
                    <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="<?= site_url() ?>admin/others/smsContactImport">
                        <div class="form-group" style="margin-bottom: 0px;">
                            <label class="col-md-3 control-label">Import File</label>
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
                                            <input id="csvfile" name="csvfile" type="file" required/>
                                        </span>
                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>
                            </div>
                            <label class="col-md-3 control-label"><a href="<?= site_url() ?>admin/others/contactfileDownload">Contact File Download </a></label>

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
    <div class="row">
        <div class="col-md-12">
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">                  
                    <h2 class="panel-title">Contact Detail</h2>                    
                </header>
                <div class="panel-body">
                    <form id="tableform" method="post" name="tableform" action="#">
                        <button id="btnExport1" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px">Export</button>
                        <table class="table table-bordered table-striped mb-none" id="datatable-default" style="text-align: center">
                            <thead>
                                <tr>

                                    <th>Name</th>
                                    <th>Mobile No</th>
                                    <th>City</th>
                                    <th>Group</th>
                                    <th>Position</th>
                                </tr>
                            </thead>
                            <tbody>  
                                <?php
                                if (isset($contact)) {
                                    foreach ($contact as $val) {
                                        ?>
                                        <tr>
                                            <td><?= $val->name ?></td>
                                            <td><?= $val->mobile_no ?></td>
                                            <td><?= $val->city ?></td>                                            
                                            <td><?= $val->group ?></td>                                            
                                            <td><?= $val->position ?></td> 
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
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

        $('#datatable-default').dataTable({
            order: [],
            aLengthMenu: [[10, 15, 20, 25, -1], [10, 15, 20, 25, 'All']],
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0, 1, 2, 3, 4]
                }],
            iDisplayLength: 10
        });

        $("#btnExport1").click(function() {
            $("#datatable-default").btechco_excelexport({
                containerid: "datatable-default",
                datatype: $datatype.Table
            });
        });


    });
</script>