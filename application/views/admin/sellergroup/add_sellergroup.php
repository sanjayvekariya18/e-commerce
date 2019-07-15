<section role="main" class="content-body">
    <header class="page-header">
        <h2>Add Seller Group</h2>

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
                    <h2 class="panel-title">Seller Group Detail</h2>                    
                </header>
                <div class="panel-body">
                    <form class="form-horizontal" method="post" action="<?=  site_url()?>admin/sellergroup/addSellerGroupData">                          
                        <input type="hidden" name="group_id" value="<?=isset($sellergroup)?$sellergroup->group_id:''?>"/>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Group Name</label>
                            <div class="col-md-4">
                                <input name="group_name" type="text" class="form-control" value="<?=isset($sellergroup)?$sellergroup->group_name:''?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Commission (%)</label>
                            <div class="col-md-4">
                                <input name="commission_fee" type="text" class="form-control" value="<?=isset($sellergroup)?$sellergroup->commission_fee:''?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Fixed</label>
                            <div class="col-md-4">
                                <input name="fixed_fee" type="text" class="form-control" value="<?=isset($sellergroup)?$sellergroup->fixed_fee:''?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Service Tax (%)</label>
                            <div class="col-md-4">
                                <input name="service_fee" type="text" class="form-control" value="<?=isset($sellergroup)?$sellergroup->service_fee:''?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Listing Fee</label>
                            <div class="col-md-4">
                                <input name="listing_fee" type="text" class="form-control" value="<?=isset($sellergroup)?$sellergroup->listing_fee:''?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Marketing Fee (%)</label>
                            <div class="col-md-4">
                                <input name="marketing_fee" type="text" class="form-control" value="<?=isset($sellergroup)?$sellergroup->marketing_fee:''?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Payment Collection Fee (%)</label>
                            <div class="col-md-4">
                                <input name="pay_fee" type="text" class="form-control" value="<?=isset($sellergroup)?$sellergroup->pay_fee:''?>"/>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-3 control-label">Other Fee</label>
                            <div class="col-md-4">
                                <input name="other_fee" type="text" class="form-control" value="<?=isset($sellergroup)?$sellergroup->other_fee:''?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-4">
                                <button type="submit" name="saveBtn" class="mb-xs mt-xs mr-xs btn btn-success" value="<?=isset($sellergroup->group_id)?'update':'save'?>"><?=isset($sellergroup->group_id)?'Update':'Save'?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>            
        </div>
    </div>
    <!-- end: page -->
</section>
