<!-- Footer -->
<footer id="footer" class="footer">
    <div class="container">
        <!-- introduce-box -->
        <div id="introduce-box" class="row">
            <div class="col-md-3">
                <div id="address-box">
                    <div id="address-list">
                        <div class="tit-name">Address:</div>
                        <div class="tit-contain">104-Shyamdham  Society, Near Shyamdham Mandir, Sarthana Jakatnaka, Surat-395006</div>
                        <div class="tit-name">Phone:</div>
                        <div class="tit-contain">0261-6452111</div>
                        <div class="tit-name">Email:</div>
                        <div class="tit-contain">info@shopking24.com</div>
                    </div>
                </div><br/>
                <div id="contact-box">                    
                    <div class="social-link">
                        <a href="https://www.facebook.com/Shopking24com-511366578998110/timeline/" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a href="https://in.pinterest.com/shopking24com/" target="_blank"><i class="fa fa-pinterest-p"></i></a>
                        <!--<a href="#"><i class="fa fa-vk"></i></a>-->
                        <a href="https://twitter.com/shopking24" target="_blank"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-google-plus"></i></a>
                    </div>                   
                </div>
            </div>
            <div class="col-md-3 company-box">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="introduce-title">Company</div>
                        <ul id="introduce-company"  class="introduce-list">
                            <li><a href="<?= site_url() ?>about-us">About Us</a></li>                            
                            <li><a href="<?= site_url() ?>privacy-policy">Privacy Policy</a></li>
                            <li><a href="<?= site_url() ?>terms-of-use">Terms & Conditions</a></li>
                            <li><a href="<?= site_url() ?>contact-us">Contact Us</a></li>
                            <li><a href="<?= site_url() ?>services">Services</a></li>
                        </ul>
                    </div>                    
                </div>
            </div>
            <div class="col-md-3 information-box">
                <div class="row">                    
                    <div class="col-sm-12">
                        <div class="introduce-title">Information</div>
                        <ul id="introduce-company"  class="introduce-list">
                            <li><a href="<?= site_url() ?>shipping" >Shipping</a></li>
                            <li><a href="<?= site_url() ?>payment-method" >Payments</a></li>
                            <li><a href="<?= site_url() ?>cancellation-and-return" >Cancel & Returns</a></li>
                            <li><a href="<?= site_url() ?>warrantee" >Warrantee</a></li>
                            <li><a href="<?= site_url() ?>buyer-faq" >FAQ</a></li>
                        </ul>
                    </div>                       
                </div>
            </div>
            <div class="col-md-3 social-box">
                <div class="row">
                    <div class="col-md-8" style="padding-right: 0px;">
                        <input id="subemail" type="email" name="subemail" class="input form-control">
                    </div>
                    <div class="col-md-4">
                        <button id="subscribe" type="button" class="form-control btn btn-default" style="color: #fff;height: 34px;background: #ff3366;border: none;border-radius: 0;width: 130px;padding: 0;">Subscribe Now</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <a href="https://play.google.com/store/apps/details?id=com.laxmisoft.shopking"><img src="<?= base_url() ?>webassets/data/play.jpg" alt="" style="border: 1px solid #fff; margin: 15px 35px;width: 90%;"/></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- #trademark-box -->
        <div id="trademark-box" class="row trademark-box">
            <div class="col-sm-12">
                <ul id="trademark-list" style="text-align: center">                                       
                    <li>
                        <a href="#"><img src="<?= base_url() ?>webassets/data/footer1.jpg"  alt=""/></a>
                    </li>                   
                </ul> 
            </div>
        </div> <!-- /#trademark-box -->
        <div id="footer-menu-box">
            <p class="text-center">Copyrights &#169; 2015 Shopking24 Ecommerce Network Pvt. Ltd. All Rights Reserved. Designed by <a href="http://www.laxmisoft.net" target="_blank">Laxmisoft Technology</a></p>
        </div><!-- /#footer-menu-box -->
    </div> 
</footer>

<a href="#" class="scroll_top" title="Scroll to Top" style="display: inline;">Scroll</a>
<!-- Script-->

<script type="text/javascript" src="<?= base_url() ?>webassets/lib/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>webassets/lib/select2/js/select2.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>webassets/lib/jquery.bxslider/jquery.bxslider.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>webassets/lib/owl.carousel/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>webassets/lib/jquery.countdown/jquery.countdown.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>webassets/lib/jquery.elevatezoom.js"></script>
<script type="text/javascript" src="<?= base_url() ?>webassets/lib/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>webassets/lib/fancyBox/jquery.fancybox.js"></script>
<script type="text/javascript" src="<?= base_url() ?>webassets/js/jquery.actual.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>webassets/js/theme-script.js"></script>
<!-- Alert JS -->
<script src="<?= base_url() ?>webassets/js/alertify.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setTimeout(function () {
            $('.catlink').removeAttr('data-toggle');
        }, 2000);

        $('#subscribe').click(function () {
            $subemail = $('#subemail').val();
            if (!isEmail($subemail)) {
                alertify.error('Enter Valid Email');
            } else {
                $.ajax({
                    url:"<?=  site_url()?>home/subscribe",
                    type:"post",
                    data:{email:$subemail},
                    success: function (data, textStatus, jqXHR) {
                        $('#subemail').val("");
                        if(data == "s"){                            
                            alertify.success('Thank You For Subscription');
                        }else{
                            alertify.error('Email Id Already Exist');
                        }
                    }
                });
            }
        });

        function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }
    });
</script>
<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-68277450-1', 'auto');
    ga('send', 'pageview');

</script>
</body>
</html>