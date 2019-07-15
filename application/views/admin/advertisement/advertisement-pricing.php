<section role="main" class="content-body">
    <header class="page-header">
        <h2>Advertising Pricing</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= site_url() ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
            </ol>
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>
    <!-- start: page -->    
    <div class="row">
        <div class="col-md-12">
            <a href="<?= site_url() ?>admin/advertisement/addPlan" class="btn btn-success btn-md" >Add Plan</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">                  
                    <h2 class="panel-title">Advertising Pricing Detail</h2>                    
                </header>
                <div class="panel-body">
                    <table class="table table-bordered table-striped mb-none" id="datatable-default" style="text-align: center">
                        <thead>
                            <tr>
                               
                                <th>Plan Name</th>
                                <th>Rate</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php
                            if (isset($pricing)) {
                                foreach ($pricing as $plan) {
                                    ?>
                                    <tr>
                                        <td><?= $plan->category . '-' . $plan->box . '-' . $plan->size ?></td>
                                        <td>Rs. <?= $plan->price ?></td>
                                        <td>
                                            <a href="<?= site_url() ?>admin/advertisement/editPlan?id=<?= base64_encode($plan->plan_id) ?>" class="btn btn-primary btn-xs" >Edit</a>
                                            <a href="<?= site_url() ?>admin/advertisement/deletePlan?id=<?= base64_encode($plan->plan_id) ?>" class="btn btn-danger btn-xs" >Delete</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>            
        </div>
    </div>
    <!-- end: page -->
</section>
<?php $msg = $this->input->get('msg'); ?>
<?php
switch ($msg) {
    case "I":
        $m = "Advertisement Plan Successfully Created..!";
        $t = "success";
        break;
    case "U":
        $m = "Advertisement Plan Successfully Updated..!";
        $t = "success";
        break;
    case "D":
        $m = "Advertisement Plan Successfully Deleted..!";
        $t = "error";
        break;
    default:
        $m = 0;
        break;
}
?>
<script type="text/javascript">
    $(document).ready(function () {
<?php if ($msg): ?>
            alertify.<?= $t ?>("<?= $m ?>");
<?php endif; ?>
    });
</script>
<script type="text/javascript">
    $(function () {
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
