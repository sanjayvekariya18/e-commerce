<section role="main" class="content-body">
    <header class="page-header">
        <h2>Bulk SMS Send</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= site_url() ?>admin">
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

                    <h2 class="panel-title">SMS Detail</h2>                    
                </header>
                <div class="panel-body">
                    <form class="form-horizontal" method="post" action="<?= site_url() ?>admin/others/sendSms">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Position</label>
                            <div class="col-md-4">
                                <select id="position" name="position" class="form-control">
                                    <?php
                                    if (isset($position)) {
                                        foreach ($position as $val) {
                                            ?>
                                            <option value="<?= $val->position ?>"><?= $val->position ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Group</label>
                            <div class="col-md-4">
                                <select id="group" name="group" class="form-control">
                                    <?php
                                    if (isset($group)) {
                                        foreach ($group as $val) {
                                            ?>
                                            <option value="<?= $val->group ?>"><?= $val->group ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Message</label>
                            <div class="col-md-4">
                                <textarea id="message" name="message" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-4">
                                <button id="send_now" type="submit" class="mb-xs mt-xs mr-xs btn btn-warning">Send Now</button>
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
    case "S":
        $m = "SMS Send Successfully..!";
        $t = "success";
        break;
    case "F":
        $m = "SMS Send Failed..!";
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