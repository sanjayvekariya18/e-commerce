<section role="main" class="content-body">
    <header class="page-header">
        <h2>Bank Details Master</h2>

        <div class="right-wrapper pull-right" style="padding-right: 10px;">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= site_url() ?>admin">
                        <i class="fa fa-home"></i>
                    </a>
                </li>                
                <li><span>Bank Details Master</span></li>
            </ol>           
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-md-12">
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Bank Details Detail</h2>
                </header>
                <div class="panel-body">
                    <form id="bankdetailform" class="form-horizontal" method="POST" action="#">
                        <input id="bank_id" type="hidden" name="bank_id">

                        <div class="form-group">
                            <label class="col-md-2 control-label">Bank Name :- </label>
                            <div class="col-md-4">
                                <input id="bank_name" name="bank_name" type="text" class="form-control">
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
                    <h2 class="panel-title">Bank Details Detail</h2>
                </header>
                <div class="panel-body">                    
                    <button id="btnExport1" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px;margin-top: 15px">Export</button>
                    <!--Dynamic Table-->
                    <table class="table table-bordered table-striped mb-none" id="datatable-default">
                        <thead>
                            <tr>                                    
                                <th>Sr No</th>
                                <th>Bank Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($bank)) {
                                $srno = 0;
                                foreach ($bank as $val) {
                                    $srno+=1;
                                    ?>                                
                                    <tr>
                                        <td><?= $srno ?></td>
                                        <td><?= $val->bank_name ?></td>
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
        $m = "Bank Details Successfully Saved..!";
        $t = "success";
        break;
    case "U":
        $m = "Bank Details Successfully Updated..!";
        $t = "success";
        break;
    case "D":
        $m = "Bank Details Successfully Deleted..!";
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
            if ($('#bank_name').val() == "") {
                alertify.error("Enter Bank Name");
                $flag = 0;
            } else {
                $flag = 1;
            }
            if ($flag == 1) {
                $btntype = $(this).val();
                if ($btntype == "save")
                {
                    $url = "<?= site_url() ?>admin/bank_details/addBankData";
                    $('#bankdetailform').attr('action', $url);
                    $('#bankdetailform').submit();
                }
                else if ($btntype == "update")
                {
                    $url = "<?= site_url() ?>admin/bank_details/updateBankData";
                    $('#bankdetailform').attr('action', $url);
                    $('#bankdetailform').submit();
                }
            }

        });

        $('.update').on("click", function() {
            $id = $(this).val();
            $bank_name = $(this).parent().prev().text();

            $('#bank_id').val($id);
            $('#bank_name').val($bank_name);
            $('#saveBtn').val('update');
            $('#saveBtn').text('update');

        });

        $('.delete').on("click", function() {
            $id = $(this).val();
            alertify.confirm("Are You Sure To Delete This Bank Details ...!!", function(e) {
                if (e) {
                    window.location.href = "<?= site_url() ?>admin/bank_details/deleteBankData?id=" + $id;
                    return true;
                }
                else {
                    return false;
                }
            });

        });

    });
</script>