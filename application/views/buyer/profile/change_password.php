<section role="main" class="content-body">
    <header class="page-header">
        <h2>Password Setting</h2>

        <div class="right-wrapper pull-right" style="padding-right: 10px;">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= site_url() ?>buyer">
                        <i class="fa fa-home"></i>
                    </a>
                </li>                
                <li><span>Change Password</span></li>
            </ol>           
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-md-12">
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Change Password</h2>
                </header>
                <div class="panel-body">
                    <form id="changepass" class="form-horizontal" method="POST" action="<?= site_url() ?>buyer/profile/updatePassword">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Old Password :- </label>
                            <div class="col-md-4">
                                <input id="oldpass" name="oldpass" type="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">New Password :- </label>
                            <div class="col-md-4">
                                <input id="newpass" name="newpass" type="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Confirm Password :- </label>
                            <div class="col-md-4">
                                <input id="repass" name="repass" type="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"></label>
                            <div class="col-md-4">
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
<?php
$msg = $this->input->get('msg');
if ($msg == "") {
    $msg = "0";
}
?>
<script type="text/javascript">
    $(document).ready(function() {
        if (<?= $msg ?> == '1') {
            alertify.success("Password Updated ..!!");
        } else if (<?= $msg ?> == '2')
        {
            alertify.error("Password Information Not Saved ..!!");
        }
    });
</script>    
