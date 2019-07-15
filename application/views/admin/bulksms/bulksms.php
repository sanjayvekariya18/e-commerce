<section role="main" class="content-body">
    <header class="page-header">
        <h2>Bulk SMS</h2>

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
                    <form class="form-horizontal" method="get">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Message To</label>
                            <div class="col-md-4">
                                <select id="message_to" name="messageto" class="form-control">
                                    <option  value="1">All Seller</option>
                                    <option  value="2">All Customer</option>
                                    <option  value="3">All Employee</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Message</label>
                            <div class="col-md-4">
                                <textarea id="message" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
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
<script type="text/javascript">
    $(document).ready(function() {
        $('#send_now').click(function() {
            $message_to = $('#message_to').val();
            $message = $('#message').val();

            $.ajax({
                url: '<?= site_url() ?>admin/bulksms/sendMessage',
                type: 'post',
                data: {'message_to': $message_to,'message': $message},
                success: function(data, textStatus, jqXHR) {                    
                    if (data == 1) {
                        alertify.success("Bulk SMS Successfully Send");
                        clear()
                    } else {
                        alertify.error("Bulk SMS Sending Fail");
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