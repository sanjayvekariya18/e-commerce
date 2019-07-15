<section role="main" class="content-body">
    <header class="page-header">
        <h2>Change Email</h2>

        <div class="right-wrapper pull-right" style="padding-right: 10px;">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= site_url() ?>admin">
                        <i class="fa fa-home"></i>
                    </a>
                </li>                
                <li><span>Change Email</span></li>
            </ol>           
        </div>
    </header>

    <!-- start: page -->
    <div class="row">        
        <div class="col-md-12">
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Change Email</h2>
                </header>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="<?= site_url() ?>admin/change_email/updateEmail">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Person Type :- </label>
                            <div class="col-md-4" style="margin-top: 3px;">
                                <select id="role" name="role" class="form-control" required>
                                    <option value="1" >Seller</option>
                                    <option value="2" >Employee</option>
                                    <option value="3" >Buyer</option>                                    
                                </select>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="col-md-3 control-label">Old Email :- </label>
                            <div class="col-md-4" style="margin-top: 3px;">
                                <input name="old_email" type="email" class="form-control" value="" required>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="col-md-3 control-label">New Email :- </label>
                            <div class="col-md-4" style="margin-top: 3px;">
                                <input name="new_email" type="email" class="form-control" value="" required>
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
        $m = "Email Updated..!";
        $t = "success";
        break;
    case "F":
        $m = "Email Update Failed ..!";
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
