<section role="main" class="content-body">
    <header class="page-header">
        <h2>Tracking Number Setting</h2>       
    </header>
    <!-- start: page -->
    <div class="row">
        <div class="col-md-12">
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Tracking Number Setting</h2>
                </header>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="<?= site_url() ?>admin/order_track/updateAWB">                       
                        <div class="form-group">
                            <label class="col-md-3 control-label">Order Number :- </label>
                            <div class="col-md-4">
                                <input id="order_id" name="order_id" type="text" class="form-control" required>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="col-md-3 control-label">AWB Tracking Number :- </label>
                            <div class="col-md-4">
                                <input id="awb_no" name="awb_no" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>                                                      
                            <div class="col-md-4" style="padding: 0px;margin-top: -5px;">
                                <button id="saveBtn" name="saveBtn" type="submit" class="mb-xs mt-xs mr-xs btn btn-success" style="width:100px" value="save">Save</button>
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
        $m = "Tracking Number Update..!";
        $t = "success";
        break;
    case "F":
        $m = "Tracking Number Update Failed..!";
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