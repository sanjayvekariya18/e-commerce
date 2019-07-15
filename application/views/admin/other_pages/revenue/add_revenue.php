<section role="main" class="content-body">
    <header class="page-header">
        <h2>Add Revenue</h2>

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
                    <h2 class="panel-title">Profit/Loss Detail</h2>                    
                </header>
                <div class="panel-body">
                    <form class="form-horizontal" method="post" action="<?= site_url() ?>admin/others/addRevenueData" enctype="multipart/form-data">                          
                        <input type="hidden" name="revenue_id" value="<?= isset($revenue) ? $revenue->revenue_id : '' ?>"/>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Date</label>
                            <div class="col-md-4" style="padding-right: 0px;">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input id="reg_date" name="reg_date" type="text" data-plugin-datepicker class="form-control" style="width: 95%;" value="<?= isset($revenue->reg_date) ? date('d-m-Y', strtotime($revenue->reg_date)) : '' ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Order Id</label>
                            <div class="col-md-4">
                                <input name="order_id" type="text" class="form-control" value="<?= isset($revenue->order_id) ? $revenue->order_id : '' ?>" required=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Profit</label>
                            <div class="col-md-4">
                                <input name="profit" type="text" class="form-control" value="<?= isset($revenue->profit) ? $revenue->profit : '0' ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Loss</label>
                            <div class="col-md-4">
                                <input name="loss" type="text" class="form-control" value="<?= isset($revenue->loss) ? $revenue->loss : '0' ?>"/>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-4">
                                <button type="submit" name="saveBtn" class="mb-xs mt-xs mr-xs btn btn-success" value="<?= isset($revenue->revenue_id) ? 'update' : 'save' ?>"><?= isset($revenue->revenue_id) ? 'Update' : 'Save' ?></button>
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
        
    });
</script>
