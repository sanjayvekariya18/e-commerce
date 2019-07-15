<section role="main" class="content-body">
    <header class="page-header">
        <h2>Add New Advertisement Request</h2>
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
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>                        
                    </div>
                    <h2 class="panel-title">New Request</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <?php $mname = (isset($request)) ? "updateRequest" : "insertRequest"; ?>
                            <form id="requestForm" class="form-horizontal" method="post" action="<?= site_url() . "seller/advertisement/$mname" ?>">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Position</label>
                                    <div class="col-md-6">
                                        <select id="plans" name="plan_id" class="form-control">
                                            <option  value="-1">---Select---</option>
                                            <?php foreach ($plan as $value) { ?>
                                                <option  value="<?= $value->plan_id ?>">
                                                    <?= $value->category . '-' . $value->box . '-' . $value->size ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Date</label>
                                    <div class="col-md-8">
                                        <div class="input-daterange input-group" data-plugin-datepicker>
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>    
                                            </span>
                                            <input type="text" class="form-control" name="from" value="<?= isset($request) ? date('d-m-Y', strtotime($request->from)) : '' ?>" required="">
                                            <span class="input-group-addon">to</span>
                                            <input type="text" class="form-control" name="to" value="<?= isset($request) ? date('d-m-Y', strtotime($request->to)) : '' ?>" required="">
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if (isset($request)) {
                                    $d1 = date_create($request->from);
                                    $d2 = date_create($request->to);
                                    $day = date_diff($d1, $d2)->format('%a');
                                    ?>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Total Payment</label>
                                        <div class="col-md-6 price" style="margin-top: 10px">
                                            <strong><?= number_format($day * $request->price, 2) ?> Rs.</strong>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label>
                                    <div class="col-md-4">
                                        <button type="submit" class="mb-xs mt-xs mr-xs btn btn-warning">
                                            <?= isset($request) ? "Update" : "Add" ?>
                                        </button>
                                    </div>
                                </div>
                                <?php if (isset($request)): ?>
                                    <input type="hidden" value="<?= $request->request_id ?>" name="requestid" />
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>
                </div>
            </section>            
        </div>
    </div>
    <!-- end: page -->
</section>


<script type="text/javascript">
    $(document).ready(function () {
        $('#requestForm').submit(function () {
            if ($("#plans").val() == "-1") {
                alertify.error("Please Select Advertisement Plan");
                return false;
            }
        });

<?php if (isset($request)): ?>
            $('#plans').val("<?= $request->plan_id ?>");
<?php endif; ?>
    });
</script>