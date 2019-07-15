<section role="main" class="content-body">
    <header class="page-header">
        <h2>Add Expense</h2>

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
                    <h2 class="panel-title">Expense Detail</h2>                    
                </header>
                <div class="panel-body">
                    <form class="form-horizontal" method="post" action="<?= site_url() ?>admin/others/addExpenseData" enctype="multipart/form-data">                          
                        <input type="hidden" name="expense_id" value="<?= isset($expense) ? $expense->expense_id : '' ?>"/>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Name</label>
                            <div class="col-md-4">
                                <input name="name" type="text" class="form-control" value="<?= isset($expense->name) ? $expense->name : '' ?>" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Shop Name</label>
                            <div class="col-md-4">
                                <input name="shopname" type="text" class="form-control" value="<?= isset($expense->shopname) ? $expense->shopname : '' ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Amount</label>
                            <div class="col-md-4">
                                <input name="amount" type="text" class="form-control" value="<?= isset($expense->amount) ? $expense->amount : '' ?>" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Expense Date</label>
                            <div class="col-md-4" style="padding-right: 0px;">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input id="expense_date" name="expense_date" type="text" data-plugin-datepicker class="form-control" style="width: 95%;" value="<?= isset($expense->expense_date) ? ($expense->expense_date!= null) ? date('d-m-Y', strtotime($expense->expense_date)) : '' : '' ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="display:<?= isset($expense->expense_proof) ? ($expense->expense_proof != "") ? 'block' : 'none' : 'none' ?>">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-4">                                
                                <img src="<?= isset($expense->expense_proof) ? $expense->expense_proof : '' ?>" style="width: 370px;border: 4px double;height: 180px;"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Upload Expense Proof</label>
                            <div class="col-md-6">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="input-append">
                                        <div class="uneditable-input">
                                            <i class="fa fa-file fileupload-exists"></i>
                                            <span class="fileupload-preview"></span>
                                        </div>
                                        <span class="btn btn-default btn-file">
                                            <span class="fileupload-exists">Change</span>
                                            <span class="fileupload-new">Select file</span>
                                            <input type="file" name="expense_proof" <?= isset($expense->expense_proof) ? ($expense->expense_proof == "") ? 'required' : '' : 'required' ?>/>
                                        </span>
                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-4">
                                <button type="submit" name="saveBtn" class="mb-xs mt-xs mr-xs btn btn-success" value="<?= isset($expense->expense_id) ? 'update' : 'save' ?>"><?= isset($expense->expense_id) ? 'Update' : 'Save' ?></button>
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
