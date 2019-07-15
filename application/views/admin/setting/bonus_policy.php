<section role="main" class="content-body">
    <header class="page-header">
        <h2>Welcome Bonus Setting</h2>
        
        <div class="right-wrapper pull-right" style="padding-right: 10px;">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= site_url() ?>admin">
                        <i class="fa fa-home"></i>
                    </a>
                </li>                
                <li><span>Welcome Bonus Setting</span></li>
            </ol>           
        </div>
    </header>

    <!-- start: page -->
    <div class="row">        
        <div class="col-md-12">
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Welcome Bonus Setting</h2>
                </header>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="<?= site_url() ?>admin/bonus_policy/updateBonus">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Bonus Amount :- </label>
                            <div class="col-md-4" style="margin-top: 3px;">
                                <input name="bonus_amount" type="text" class="form-control" value="<?= isset($bonus->bonus_amount) ? $bonus->bonus_amount : '' ?>">
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="col-md-3 control-label">Bonus Day Limit :- </label>
                            <div class="col-md-4" style="margin-top: 3px;">
                                <input name="bonus_day" type="text" class="form-control" value="<?= isset($bonus->bonus_day) ? $bonus->bonus_day : '' ?>">
                            </div>
                        </div>
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
        $m = "Bonus Setting Updated..!";
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
