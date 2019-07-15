</div>            
</section>
<!-- Vendor -->

<script src="<?= base_url() ?>assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
<script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.js"></script>
<script src="<?= base_url() ?>assets/vendor/nanoscroller/nanoscroller.js"></script>
<script src="<?= base_url() ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?= base_url() ?>assets/vendor/magnific-popup/magnific-popup.js"></script>
<script src="<?= base_url() ?>assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

<!-- Specific Page Vendor -->
<script src="<?= base_url() ?>assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
<script src="<?= base_url() ?>assets/vendor/jquery-appear/jquery.appear.js"></script>
<script src="<?= base_url() ?>assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/select2/select2.js"></script>

<script src="<?= base_url() ?>assets/javascripts/iCheck/icheck.min.js" type="text/javascript"></script>
<!-- Specific Page Vendor -->
<script type="text/javascript">
   
        $("input[type='checkbox']:not(.simple)").iCheck({
            checkboxClass: 'icheckbox_minimal'
        });
    
</script>

<script src="<?= base_url() ?>assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>

<script src="<?= base_url() ?>assets/javascripts/ui-elements/examples.modals.js"></script>

<!-- Alert JS -->
<script src="<?= base_url() ?>assets/javascripts/alertify.min.js"></script>

<!-- Theme Base, Components and Settings -->
<script src="<?= base_url() ?>assets/javascripts/theme.js"></script>

<!-- Theme Custom -->
<script src="<?= base_url() ?>assets/javascripts/theme.custom.js"></script>

<!-- Theme Initialization Files -->
<script src="<?= base_url() ?>assets/javascripts/theme.init.js"></script>

<script type="text/javascript">
   
        $('.mycheck').prop('disabled', true);
        //-----------------------------iCheck All-----------------------------//
        $('table thead :checkbox').on('ifChecked ifUnchecked', function(event) {
            if (event.type == 'ifChecked') {
                $('.icheckbox_minimal').iCheck('check');
                $('.mycheck').removeAttr('disabled');
            } else {
                $('.icheckbox_minimal').iCheck('uncheck');
                $('.mycheck').prop('disabled', true);
            }
        });
        $('table tbody :checkbox').on('ifChanged', function(event) {
            var len = parseInt($('table tbody :checkbox').filter(':checked').length);
            if (len == $('table tbody :checkbox').length) {
                $('table thead :checkbox').prop('checked', true);
            } else {
                $('table thead :checkbox').prop('checked', false);
                $('.mycheck').removeAttr('disabled');
            }
            if (len > 0) {
                $('.mycheck').removeAttr('disabled');
            } else {
                $('.mycheck').prop('disabled', true);
            }
            $('table thead :checkbox').iCheck('update');
        });
        $('.paging_bs_normal').on('click', function() {
            $('.icheckbox_minimal').iCheck('uncheck');
            $('.mycheck').prop('disabled', true);
        });
    
</script>
<script type="text/javascript">
    $(document).ready(function() {      
           
        $('#bellnewrefund').click(function() {
            $.ajax({
                url: "<?= site_url()?>buyer/refund/resetNewRefundNotify",
                type: "post",
                success: function(data, textStatus, jqXHR) {

                }
            });
        });  
    });
</script> 
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-68277450-1', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>