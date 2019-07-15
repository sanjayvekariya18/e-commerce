<section role="main" class="content-body">
    <header class="page-header">
        <h2>Advertisement Request</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= site_url() ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
            </ol>
        </div>
    </header>
    <!-- start: page -->
    <div class="row">
        <div class="col-md-12">
            <a href="<?= site_url() ?>seller/advertisement/addRequest" class="btn btn-success btn-md" >Add Request</a>
        </div>
    </div>    
    <div class="row">
        <div class="col-md-12">
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">                  
                    <h2 class="panel-title">Seller Advertisement Requests</h2>                    
                </header>
                <div class="panel-body">             
                    <button id="btnExport1" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px">Export</button>
                    <table class="table table-bordered table-striped mb-none" id="datatable-default" style="text-align: center">
                        <thead>
                            <tr>
                                <th>Request Date</th>
                                <th>From</th>                                
                                <th>To</th>
                                <th>Position</th>
                                <th>Size</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php
                            if (isset($request) && is_array($request)) {
                                foreach ($request as $val) {
                                    ?>
                                    <tr>
                                        <td><?= date('d-m-Y', strtotime($val->request_date)) ?></td>
                                        <td><?= date('d-m-Y', strtotime($val->from)) ?></td>
                                        <td><?= date('d-m-Y', strtotime($val->to))?></td>
                                        <td><?= $val->category . '-' . $val->box ?></td>
                                        <td><?= $val->size ?></td>
                                        <?php
                                        $d1 = date_create($val->from);
                                        $d2 = date_create($val->to);
                                        $day = date_diff($d1, $d2)->format('%a');
                                        ?>
                                        <td><?= $day * $val->price ?> Rs.</td>
                                        <td>
                                            <?php if ($val->status == 0) { ?>
                                                <span class="label label-primary">In-Review</span>
                                            <?php } else if ($val->status == 1) { ?>
                                                <span class="label label-success">Approved</span>
                                            <?php } else if ($val->status == 2) { ?>
                                                <span class="label label-success">Live</span>
                                            <?php } else if ($val->status == 3) { ?>
                                                <span class="label label-danger">Expired</span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if ($val->status == 0) { ?>
                                                <a href="<?= site_url() ?>seller/advertisement/editRequest?id=<?= base64_encode($val->request_id) ?>" class="btn btn-primary btn-xs" >
                                                    <i class="fa fa-pencil-square-o"></i> Edit
                                                </a>
                                            <?php } ?>
                                            <?php if ($val->status == 0 || $val->status == 3) { ?>
                                                <a href="<?= site_url() ?>seller/advertisement/deleteRequest?id=<?= base64_encode($val->request_id) ?>"  class="btn btn-danger btn-xs" >
                                                    <i class="fa fa-trash-o"></i> Delete
                                                </a>
                                            <?php } ?>
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
        $m = "Request Inserted..!";
        $t = "success";
        break;
    case "U":
        $m = "Request Updated..!";
        $t = "success";
        break;
    case "D":
        $m = "Request Deleted..!";
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
        
        
        $("#btnExport1").click(function () {
            $("#datatable-default").btechco_excelexport({
                containerid: "datatable-default",              
                datatype: $datatype.Table
            });
        });
    });
</script>