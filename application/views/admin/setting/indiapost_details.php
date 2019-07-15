<section role="main" class="content-body">
    <header class="page-header">
        <h2>India Post Details Master</h2>

        <div class="right-wrapper pull-right" style="padding-right: 10px;">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= site_url() ?>admin">
                        <i class="fa fa-home"></i>
                    </a>
                </li>                
                <li><span>India Post Details Master</span></li>
            </ol>           
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-md-12">
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">India Post Tracking Id Detail</h2>
                </header>
                <div class="panel-body">
                    <form id="indiapostdetailform" class="form-horizontal" method="POST" action="#">
                        <input id="id" type="hidden" name="id">

                        <div class="form-group">
                            <label class="col-md-2 control-label">Tracking Id :- </label>
                            <div class="col-md-4">
                                <input id="tracking_id" name="tracking_id" type="text" class="form-control">
                            </div>
                        </div>                                                                       
                        <div class="form-group">
                            <label class="col-md-2 control-label"></label>
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
                    <h2 class="panel-title">India Post Tracking Id Detail</h2>
                </header>
                <div class="panel-body">                    
                    <button id="btnExport1" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px;margin-top: 15px">Export</button>
                    <!--Dynamic Table-->
                    <table class="table table-bordered table-striped mb-none" id="datatable-default">
                        <thead>
                            <tr>                                    
                                <th>Sr No</th>
                                <th>Tracking Id</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($trackingIdList)) {
                                $srno = 0;
                                foreach ($trackingIdList as $val) {
                                    $srno+=1;
                                    ?>                                
                                    <tr>
                                        <td><?= $srno ?></td>
                                        <td><?= $val->tracking_id ?></td>
                                        <td><?= ($val->status == 0)? 'Un-Used' : 'Used' ?></td>
                                        <td>
                                            <button  type="button" class="btn btn-primary btn-xs update" style="width:60px;" value="<?= $val->id ?>">Edit</button>
                                            <button  type="button" value="<?= base64_encode($val->id) ?>" class="btn btn-danger btn-xs delete" style="width:60px;">Delete</button>
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
    <!-- end: page -->
</section>
<?php $msg = $this->input->get('msg'); ?>
<?php
switch ($msg) {
    case "S":
        $m = "Tracking Id Successfully Saved..!";
        $t = "success";
        break;
    case "U":
        $m = "Tracking Id Successfully Updated..!";
        $t = "success";
        break;
    case "D":
        $m = "Tracking Id Successfully Deleted..!";
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
        $('#saveBtn').on("click", function() {
            if ($('#tracking_id').val() == "") {
                alertify.error("Enter Tracking Id");
                $flag = 0;
            } else {
                $flag = 1;
            }
            if ($flag == 1) {
                $btntype = $(this).val();
                if ($btntype == "save")
                {
                    $url = "<?= site_url() ?>admin/indiapost_details/addTrackingData";
                    $('#indiapostdetailform').attr('action', $url);
                    $('#indiapostdetailform').submit();
                }
                else if ($btntype == "update")
                {
                    $url = "<?= site_url() ?>admin/indiapost_details/updateTrackingData";
                    $('#indiapostdetailform').attr('action', $url);
                    $('#indiapostdetailform').submit();
                }
            }

        });

        $('.update').on("click", function() {
            $id = $(this).val();
            $tracking_id = $(this).parent().prev().prev().text();

            $('#id').val($id);
            $('#tracking_id').val($tracking_id);
            $('#saveBtn').val('update');
            $('#saveBtn').text('update');

        });

        $('.delete').on("click", function() {
            $id = $(this).val();
            alertify.confirm("Are You Sure To Delete This Tracking Id Details ...!!", function(e) {
                if (e) {
                    window.location.href = "<?= site_url() ?>admin/indiapost_details/deleteTrackingData?id=" + $id;
                    return true;
                }
                else {
                    return false;
                }
            });

        });

    });
</script>