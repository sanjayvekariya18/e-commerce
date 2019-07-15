<section role="main" class="content-body">
    <header class="page-header">
        <h2>Special Discount Setting</h2>

        <div class="right-wrapper pull-right" style="padding-right: 10px;">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= site_url() ?>admin">
                        <i class="fa fa-home"></i>
                    </a>
                </li>                
                <li><span>Special Discount Setting</span></li>
            </ol>           
        </div>
    </header>

    <!-- start: page -->
    <div class="row">        
        <div class="col-md-12">
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Special Discount Setting</h2>
                </header>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="<?= site_url() ?>admin/special_discount/updateDiscount">
                        <?php
                        if (isset($discount)) {
                            foreach ($discount as $val) {
                                ?>                        
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?= $val->min_val ?> - <?= $val->max_val ?> :- </label>
                                    <div class="col-md-4" style="margin-top: 3px;">
                                        <input name="discount[]" type="text" class="form-control" value="<?= isset($val->discount) ? $val->discount : '0' ?>">
                                    </div>
                                </div>    
                                <?php
                            }
                        }
                        ?>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-8" style="margin-top: 3px;">
                                <button type="submit" class="mb-xs mt-xs mr-xs btn btn-success" style="width:100px">Save</button>
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
        $m = "Special Discount Updated..!";
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
