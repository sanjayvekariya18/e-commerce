<section role="main" class="content-body">
    <header class="page-header">
        <h2>Message Conversation</h2>

        <div class="right-wrapper pull-right" style="padding-right: 10px;">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= site_url() ?>buyer">
                        <i class="fa fa-home"></i>
                    </a>
                </li>                
                <li><span>Message Conversation</span></li>
            </ol>           
        </div>
    </header>
    <!-- start: page -->
    <div class="row">
        <div class="col-md-12">             
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Message Conversation</h2>
                </header>
                <div class="panel-body"> 
                    <div class="row">
                        <div class="col-md-6">
                            <section class="panel panel-featured-left panel-featured-primary">
                                <div class="panel-body">
                                    <div class="widget-summary widget-summary-xs">                               
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Support Questions By Seller</h4>                                        
                                            </div>                                    
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="float:right">
                            <section class="panel panel-featured-right panel-featured-success" style="text-align: right">
                                <div class="panel-body">
                                    <div class="widget-summary widget-summary-xs">                                
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Support Questions By Buyer</h4>                                        
                                            </div>                                    
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <textarea class="form-control" name="message"></textarea>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-success" style=" width: 100%;height: 50px;">Send</button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- end: page -->
</section>
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable-default').dataTable({
            order: [],
            aLengthMenu: [[10, 15, 20, 25, -1], [10, 15, 20, 25, 'All']],
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0, 1, 2, 3, 4]
                }],
            iDisplayLength: 10
        });
    });
</script>