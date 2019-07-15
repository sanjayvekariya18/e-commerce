<section role="main" class="content-body">
    <header class="page-header">
        <h2>Edit SMS Template</h2>

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
                    <h2 class="panel-title"><?= $template->sms_type ?></h2>                    
                </header>
                <div class="panel-body">
                    <form role="form" action="<?= site_url() ?>admin/sms_notification/update" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class='row'>
                                        <div class='col-md-9'>
                                            <textarea id="message" class="form-control" name="message" rows="5"><?= $template->message ?></textarea>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?= (isset($template->short_code)) ? $template->short_code : '' ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-4">
                                <button type="submit"  class="btn btn-warning">
                                    Update
                                </button>
                            </div>
                        </div>
                        <input type="hidden" name="smsid" value="<?= $template->sms_id ?>" />
                    </form>
                </div>
            </section>            
        </div>
    </div>
    <!-- end: page -->
</section>
<script type="text/javascript">
    $(document).ready(function() {
        
    });
</script>
