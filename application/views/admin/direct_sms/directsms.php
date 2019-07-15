<section role="main" class="content-body">
    <header class="page-header">
        <h2>Send SMS</h2>

        <div class="right-wrapper pull-right" style="padding-right: 10px;">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= site_url() ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>                
                <li><span>SMS</span></li>
            </ol>           
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-md-12">
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Send SMS Detail</h2>
                </header>
                <div class="panel-body">
                    <form id="sendform" class="form-horizontal" method="POST" action="<?=site_url()?>admin/directsms/sendSms"> 
                        
                        <div class="form-group">
                            <label class="col-md-2 control-label">Mobile No :- </label>
                            <div class="col-md-4">
                                <input id="mobile" name="mobile"type="text"  class="form-control"/> 
                            </div>
                        </div>                         
                        <div class="form-group">
                            <label class="col-md-2 control-label">Message :- </label>
                            <div class="col-md-4">
                                <textarea id="message" name="message"type="text" class="form-control"></textarea> 
                            </div>
                            <span id="smscount" class="label label-success" style="font-size: inherit;">SMS Count :- 0</span><br/>
                        </div> 
                        <div class="form-group">
                            <label class="col-md-2 control-label"></label>
                            <div class="col-md-4">
                                <button id="saveBtn" name="saveBtn" type="button" class="mb-xs mt-xs mr-xs btn btn-success" style="width:100px" value="">Send</button>
                                <button type="reset" class="mb-xs mt-xs mr-xs btn btn-danger" style="width:100px">Clear</button>
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
    $(document).ready(function() {        
                
        $("#mobile").keydown(function(e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    // Allow: Ctrl+A, Command+A
                            (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                            // Allow: home, end, left, right, down, up
                                    (e.keyCode >= 35 && e.keyCode <= 40)) {
                        // let it happen, don't do anything
                        return;
                    }
                    // Ensure that it is a number and stop the keypress
                    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                        e.preventDefault();
                    }
                });

        
        $('#message').keyup(function() {
            var len = $(this).val().length;
            $('#smscount').text('SMS Count :- ' + Math.ceil(len / 160));
            $('#totsms').val(Math.ceil(len / 160));
        });

        $('#saveBtn').on("click", function() {
            if ($('#mobile').val() == "") {
                alertify.error("Please Enter Mobile No");
                $flag = 0;
            }else if ($('#message').val() == "") {
                alertify.error("Please Enter Message");
                $flag = 0;
            } else {
                $flag = 1;
            }
            if ($flag == 1) {
                $('#sendform').submit(); 
            }
        });
      
    });
</script>