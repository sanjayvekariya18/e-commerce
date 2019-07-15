// jQuery Initialization
jQuery(document).ready(function($){
"use strict"; 

        //======================================================================================================
        //      Fancy Box
        //======================================================================================================
        if ($('.lightbox, .button-fullsize, .fullsize').length > 0) {
            $('.lightbox, .button-fullsize, .fullsize').fancybox({
                padding    : 0,
                margin    : 0,
                maxHeight  : '90%',
                maxWidth   : '90%',
                loop       : true,
                fitToView  : false,
                mouseWheel : false,
                autoSize   : false,
                closeClick : false,
                overlay    : { showEarly  : true },
                helpers    : { media : {} }
            });
        }
        //======================================================================================================

        $('a[href*=#section]').click(function() {
         if (location.pathname.replace(/^\//,'') === this.pathname.replace(/^\//,'') && location.hostname === this.hostname) {
                 var $target = $(this.hash);
                 $target = $target.length && $target || $('[name=' + this.hash.slice(1) +']');
                 if ($target.length) {
                     var targetOffset = $target.offset().top;
                     $('html,body').animate({scrollTop: targetOffset}, 1000);
                     return false;
                }
           }
       });


        // ----------------- EASING ANCHORS ------------------ //
        $('a[href*=#href]').live("click", function(){ 
         if (location.pathname.replace(/^\//,'') === this.pathname.replace(/^\//,'') && location.hostname === this.hostname) {
                 var $target = $(this.hash);
                 $target = $target.length && $target || $('[name=' + this.hash.slice(1) +']');
                 if ($target.length) {
                     var targetOffset = $target.offset().top;
                     $('html,body').animate({scrollTop: targetOffset-100}, 1000);
                     return false;
                }
           }
        });

        $('a[href*=#popup_]').live("click", function(){ 
            var pix_over = 'rgba(0,0,0,0.5)';
            if($(this.hash).attr('pix-overlay')){
                pix_over = $(this.hash).attr('pix-overlay');
            }
            var pix_class = '';
            if($(this.hash).attr('pix-class')){
                pix_class = $(this.hash).attr('pix-class');
            }
            this.overlay = pix_over;
            $.fancybox({
                href:this.hash,
                wrapCSS:'firas',
                closeSpeed:150,
                helpers: {
                    overlay : {
                        closeClick : false,  // if true, fancyBox will be closed when user clicks on the overlay
                        speedOut   : 200,   // duration of fadeOut animation
                        showEarly  : true,  // indicates if should be opened immediately or wait until the content is ready
                        css        : {'background':pix_over},    // custom CSS properties
                        locked     : true   // if true, the content will be locked into overlay
                    },
                    title : {
                        type : 'float' // 'float', 'inside', 'outside' or 'over'
                    }
                },
                tpl:{
                    wrap     : '<div class="fancybox-wrap " tabIndex="-1"><div class="fancybox-skin container  '+ pix_class +'"><div class="fancybox-outer"><div class="fancybox-inner"></div></div></div></div>',
                    closeBtn : '<a href="javascript:;" class="active_bg_close close_btn"><i class="pi pixicon-cross2"></i></a>',
                }
            });
            return false;
        });


        //======================================================================================================
        //      Go To Top
        //======================================================================================================
        $('#gototop').click(function(e){
            jQuery('html, body').animate({scrollTop:0}, 750, 'linear');
            e.preventDefault();
            return false;
        });
        //======================================================================================================
            
        $("input, textarea,  select").keyup(function() { 
            $(this).css('border-color',''); 
            $('#result').slideUp();
        });
        //======================================================================================================
        //  END OF DOCUMENT
        //=================
});