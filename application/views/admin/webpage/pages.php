<style type="text/css">
    .cke_contents{
        height: 350px !important;
    } 
</style>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Web Pages</h2>

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
                    <h2 class="panel-title">Page</h2>                    
                </header>
                <div class="panel-body">

                    <form id="pageForm" action="<?= site_url() ?>admin/pages/update" method="post">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Choose Webpage</label>
                                    <select id="pages" name="pageid" class="form-control">
                                        <option  value="-1">----Select-----</option>
                                        <?php foreach ($pages as $value) { ?>
                                            <option  value="<?= $value->page_id ?>"><?= $value->title ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2" style="margin-top: 3%;">
                                <a href="#" target="_blank" class="link" style="display: none">View</a>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class='row'>
                                        <div class='col-md-12'>
                                            <textarea id="editor1" name="content" rows="10" cols="80"></textarea>
                                        </div>
                                    </div><!-- /.box-body -->
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
                    </form>
                </div>
            </section>            
        </div>
    </div>
    <!-- end: page -->
</section>
<script src="<?= base_url() ?>assets/vendor/ckeditor/ckeditor.js" type="text/javascript"></script>
<?php $msg = $this->input->get('msg'); ?>
<?php
switch ($msg) {
    case "U":
        $m = "Page Successfully Updated..!";
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
    $(function() {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.

        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor

    });

<?php $pageid = $this->input->get('id'); ?>

    $(document).ready(function() {
        $('#pages').on('change', function() {
            var page = $('#pages').val();
            if (page == "-1") {
                CKEDITOR.instances['editor1'].setData("");
                $('.panel-title').text("Page");
                $('.link').attr("href", "#");
                $('.link').hide();
                return false;
            }

            $.ajax({
                type: 'POST',
                data: {pageid: page},
                url: "<?= site_url() ?>admin/pages/getContent",
                success: function(data, textStatus, jqXHR) {
                    if (data == "0") {
                        alertify.error("Page does not exists..!");
                        CKEDITOR.instances['editor1'].setData("");
                        $('.panel-title').text("Page");
                        $('.link').attr("href", "#");
                        $('.link').hide();
                    } else {
                        var json = JSON.parse(data);
                        $('.link').attr("href", json.url);
                        $('.link').show();
                        $('.panel-title').text(json.title);
                        CKEDITOR.instances['editor1'].setData(json.content);
                    }
                }
            });
        });

        $('#pageForm').submit(function() {
            var page = $('#pages').val();
            if (page == "-1") {
                alertify.error("Select Page...!");
                return false;
            }
        });
    });
</script>
