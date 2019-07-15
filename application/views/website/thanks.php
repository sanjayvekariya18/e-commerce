<div class="columns-container">
    <div class="container" id="columns">        
        <!-- row -->
        <div class="row">          
            <div class="col-md-12" style="height:350px;padding-top: 150px;">
                <center>
                    <h2>Thank You For Your Order</h2>
                    <a class="btn btn-default" href="<?= site_url() ?>" style="font-weight: bold;color: #fff;height: 30px;border-radius: 2;background: #ff3366;border: none;margin-top: 10px;">Continue Shopping</a>
                </center>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <iframe src="http://track.techtrack.in/aff_l?offer_id=235&adv_sub=<?= $orderdata->cart_id ?>&amount=<?= $orderdata->total ?>" scrolling="no" frameborder="0" width="1" height="1"></iframe>
            </div>
        </div>
    </div>
</div>