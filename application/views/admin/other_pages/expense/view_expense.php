<section role="main" class="content-body">
    <header class="page-header">
        <h2>View Expense</h2>

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
                        <div class="form-group">
                            <label class="col-md-3 control-label">Name</label>
                            <div class="col-md-8">
                                <label class="control-label"> <?= isset($expense->name) ? $expense->name : '' ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Shop Name</label>
                            <div class="col-md-8">
                                <label class="control-label"><?= isset($expense->shopname) ? $expense->shopname : '' ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Amount</label>
                            <div class="col-md-8">
                                <label class="control-label"><?= isset($expense->amount) ? $expense->amount : '' ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Amount</label>
                            <div class="col-md-8">
                                <label class="control-label"><?= isset($expense->expense_date) ? date('d-m-Y',  strtotime($expense->expense_date)) : '' ?></label>
                            </div>
                        </div>
                        <div class="form-group" style="display:<?= isset($expense->expense_proof) ? ($expense->expense_proof != "") ? 'block' : 'none' : 'none' ?>">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-4">                                
                                <img src="<?= isset($expense->expense_proof) ? $expense->expense_proof : '' ?>" style="width: 370px;border: 4px double;max-height: 500px"/>
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
