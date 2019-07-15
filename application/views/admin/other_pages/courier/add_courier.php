<section role="main" class="content-body">
    <header class="page-header">
        <h2>Add Courier Profit/Loss</h2>

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
                    <form class="form-horizontal" method="post" action="<?= site_url() ?>admin/others/addCourierData">                          
                        <input type="hidden" name="id" value="<?= isset($courier) ? $courier->id : '' ?>"/>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Date</label>
                            <div class="col-md-4" style="padding-right: 0px;">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input id="reg_date" name="reg_date" type="text" data-plugin-datepicker class="form-control" style="width: 95%;" value="<?= isset($courier->reg_date) ? ($courier->reg_date != null) ? date('d-m-Y', strtotime($courier->reg_date)) : '' : '' ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Orders</label>
                            <div class="col-md-4">
                                <input name="orders" type="text" class="form-control" value="<?= isset($courier->orders) ? $courier->orders : '' ?>" required/>
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Amount</label>
                            <div class="col-md-4">
                                <input name="amount" type="text" class="form-control" value="<?= isset($courier->amount) ? $courier->amount : '' ?>" required/>
                            </div>
                        </div>    
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Type</label>
                            <div class="col-sm-1" style="margin-top: 5px;margin-right: -10px;">
                                <div class="radio-custom radio-primary">
                                    <input type="radio" id="credit" name="type" value="0" checked>
                                    <label for="credit">Credit</label>
                                </div>
                            </div>
                            <div class="col-sm-1" style="margin-top: 5px;">
                                <div class="radio-custom radio-primary">
                                    <input type="radio" id="debit" name="type" value="1" <?= isset($courier->type) ? ($courier->type == 1) ? 'checked' : '' : '' ?>>
                                    <label for="debit">Debit</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-4">
                                <button type="submit" name="saveBtn" class="mb-xs mt-xs mr-xs btn btn-success" value="<?= isset($courier->id) ? 'update' : 'save' ?>"><?= isset($courier->id) ? 'Update' : 'Save' ?></button>
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
    $(document).ready(function () {

    });
</script>
