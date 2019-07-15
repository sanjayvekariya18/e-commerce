<section role="main" class="content-body">
    <header class="page-header">
        <h2>Bulk Email</h2>

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

                    <h2 class="panel-title">Email Detail</h2>                    
                </header>
                <div class="panel-body">
                    <form class="form-horizontal" method="get">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Email To</label>
                            <div class="col-md-4">
                                <select id="email_to" name="emailto" class="form-control">
                                    <option  value="1">All Seller</option>
                                    <option  value="2">All Customer</option>
                                    <option  value="3">All Employee</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Subject</label>
                            <div class="col-md-4">
                                <input id="subject" type="text" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Body</label>
                            <div class="col-md-10">
                                <textarea id="emailbody" row="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"></label>
                            <div class="col-md-4">
                                <button id="send_now" type="button" class="mb-xs mt-xs mr-xs btn btn-warning">Send Now</button>
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
<script type="text/javascript">
    $(document).ready(function() {
        CKEDITOR.replace('emailbody');
        $('#send_now').click(function() {
            $email_to = $('#email_to').val();
            $email_subject = $('#subject').val();
            $email_body = CKEDITOR.instances['emailbody'].getData();

            $.ajax({
                url: '<?= site_url() ?>admin/bulkemail/sendEmail',
                type: 'post',
                data: {'email_to': $email_to, 'subject': $email_subject, 'message': $email_body},
                success: function(data, textStatus, jqXHR) {
                   
                    if (data == 1) {
                        alertify.success("Bulk Email Successfully Send");
                        clear()
                    } else {
                        alertify.error("Bulk Email Sending Fail");
                    }
                }
            });
        });

        function clear() {
            $('#subject').val("");
            CKEDITOR.instances['emailbody'].setData("");
        }
    });



</script>
