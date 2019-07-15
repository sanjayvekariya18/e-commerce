<section role="main" class="content-body">
    <header class="page-header">
        <h2>Add New Advertisement Plan</h2>
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
                    <h2 class="panel-title">New Plan</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <?php $mname = (isset($plan)) ? "updatePlan" : "insertPlan"; ?>
                            <form id="planForm" class="form-horizontal" method="post" action="<?= site_url() . "admin/advertisement/$mname" ?>">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Category</label>
                                    <div class="col-md-6">
                                        <select id="category" name="category" class="form-control">
                                            <option  value="-1">---Select---</option>
                                            <option  value="fashion">Fashion</option>
                                            <option  value="footer">Footer</option>
                                            <option  value="sarees">Sarees</option>
                                            <option  value="kurtis">Kurtis</option>
                                            <option  value="dress-materials">Dress Materials</option>
                                            <option  value="salwar-kurta">Salwar Kurtas</option>
                                            <option  value="lehenga-cholis">Lehenga Cholis</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Image Box</label>
                                    <div class="col-md-6">
                                        <select id="box" name="box" class="form-control">
                                            <option  value="-1">---Select---</option>
                                            <option class="fashion" value="fashion-rectangular-block-1">Rectangular Big Block 1</option>
                                            <option class="fashion" value="fashion-rectangular-block-2">Rectangular Block 2</option>
                                            <option class="fashion" value="fashion-rectangular-block-3">Rectangular Block 3</option>                                            
                                            <option class="common" value="rectangular-block-1">Rectangular Block 1</option>
                                            <option class="common" value="rectangular-block-2">Rectangular Block 2</option>   
                                            <option class="footer" value="footer-rectangular-block-1">Rectangular Block 1</option>
                                            <option class="footer" value="footer-rectangular-block-2">Rectangular Block 2</option>                                            
                                        </select>
                                    </div>
                                    <label id="size" class="col-md-2 control-label" style="text-align: center;padding: 0px;">(Size)</label>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Price</label>
                                    <div class="col-md-4">
                                        <input type="number" value="<?= isset($plan) ? $plan->price : '' ?>" class="form-control" name="price" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label>
                                    <div class="col-md-4">
                                        <button type="submit" class="mb-xs mt-xs mr-xs btn btn-warning">
                                            <?= isset($plan) ? "Update" : "Add" ?>
                                        </button>
                                    </div>
                                </div>
                                <input type="hidden" id="dimension" value="" name="size" />
                                <?php if (isset($plan)): ?>
                                    <input type="hidden" value="<?= $plan->plan_id ?>" name="planid" />
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
<?php $msg = $this->input->get('msg'); ?>
<?php
switch ($msg) {
    case "U":
        $m = "Banner Updated..!";
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

        $('#planForm').submit(function() {
            if ($("#category").val() == "-1") {
                alertify.error("Please Select Category");
                return false;
            }
            if ($("#box").val() == "-1") {
                alertify.error("Please Select Block");
                return false;
            }
            $price = $('input[name="price"]').val();
            if (!isNumeric() || $('input[name="price"]').val() == "-1") {
                alertify.error("Please Select Block");
                return false;
            }
        });

        $('#category').change(function() {
            $('#box').val("-1");
            $('#size').text('(Size)');
            if ($(this).val() == "fashion") {
                $('.fashion').css('display', 'block');
                $('.common,.footer').css('display', 'none');
            }else if ($(this).val() == "footer") {
                $('.footer').css('display', 'block');
                $('.common,.fashion').css('display', 'none');
            } else {
                $('.common').css('display', 'block');
                $('.fashion,.footer').css('display', 'none');
            }
        });

        $('#box').change(function() {
            $category = $('#category').val();
            $box = $(this).val();
            if ($box != "-1") {
                switch ($box) {
                    case "fashion-rectangular-block-1":
                        $('#size').text('585 X 200');
                        $('#dimension').val('585x200');
                        break;
                    case "fashion-rectangular-block-2":
                        $('#size').text('585 X 100');
                        $('#dimension').val('585x100');
                        break;
                    case "fashion-rectangular-block-3":
                        $('#size').text('585 X 100');
                        $('#dimension').val('585x100');
                        break;
                    case "footer-rectangular-block-1":
                        $('#size').text('585 X 120');
                        $('#dimension').val('585x120');
                        break;
                    case "footer-rectangular-block-2":
                        $('#size').text('585 X 120');
                        $('#dimension').val('585x120');
                        break;
                    case "rectangular-block-1":
                        $('#size').text('585 X 100');
                        $('#dimension').val('585x100');
                        break;
                    case "rectangular-block-2":
                        $('#size').text('585 X 100');
                        $('#dimension').val('585x100');
                        break;
                }
            }
        });

<?php if (isset($plan)): ?>
            $('#category').val("<?= $plan->category ?>");
            $('#category').trigger('change');
            $('#box').val("<?= $plan->box ?>");
            $('#box').trigger('change');
<?php endif; ?>
    });
</script>