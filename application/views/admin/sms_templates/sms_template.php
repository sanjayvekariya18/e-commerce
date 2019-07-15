<section role="main" class="content-body">
    <header class="page-header">
        <h2>SMS Templates</h2>

        <div class="right-wrapper pull-right" style="padding-right: 10px;">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= site_url() ?>admin">
                        <i class="fa fa-home"></i>
                    </a>
                </li>                
                <li><span>SMS Templates</span></li>
            </ol>           
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-md-12">             
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">SMS Templates Detail</h2>
                </header>
                <div class="panel-body">
                    <!--Dynamic Table-->
                    <table class="table table-bordered table-striped mb-none" id="datatable-default">
                        <thead>
                            <tr>                                    
                                <th style="width: 250px;">Template Name</th>
                                <th>Type</th>
                                <th>Message</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($autosms as $value) { ?>                             
                                <tr>
                                    <td><?= $value->sms_type ?></td>
                                    <td><?= $value->type ?></td>
                                    <td><?= $value->message ?></td>
                                    <td>
                                        <a href="<?= site_url() ?>admin/sms_notification/edit/<?= $value->sms_id ?>" class="btn bg-navy btn-xs">
                                            <i class="fa fa-edit"></i>
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
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
    case "U":
        $m = "Email Template Successfully Updated..!";
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
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0, 1, 2, 3]
                }]
        });
    });
</script>