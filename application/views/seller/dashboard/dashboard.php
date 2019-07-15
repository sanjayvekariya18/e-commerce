<section role="main" class="content-body">
    <header class="page-header">
        <h2>Dashboard</h2>
    </header>
    <!-- start: page -->
    <div class="row">
        <div class="col-md-3 col-lg-3 col-xl-3" style="padding: 0px;padding-right: 5px;padding-left: 5px;">
            <section class="panel panel-featured-left panel-featured-primary">
                <div class="panel-body" style="padding-left: 5px;padding-right: 5px;">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-primary" style="font-size: 3.2rem;width: 60px;height: 60px;line-height: 60px;">
                                <i class="fa fa-cubes"></i>            
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">Live Products</h4>
                                <div class="info">
                                    <strong class="amount"><?= isset($LiveProducts) ? $LiveProducts : "0" ?></strong>                                    
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-3 col-lg-3 col-xl-3" style="padding: 0px;padding-right: 5px;padding-left: 5px;">
            <section class="panel panel-featured-left panel-featured-secondary">
                <div class="panel-body" style="padding-left: 5px;padding-right: 5px;">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-secondary" style="font-size: 3.2rem;width: 60px;height: 60px;line-height: 60px;">
                                <i class="fa fa-cubes"></i>            
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">Inreview Products</h4>
                                <div class="info">
                                    <strong class="amount"><?= isset($ReviewProducts) ? $ReviewProducts : "0" ?></strong>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-3 col-lg-3 col-xl-3" style="padding: 0px;padding-right: 5px;padding-left: 5px;">
            <section class="panel panel-featured-left panel-featured-tertiary" >
                <div class="panel-body" style="padding-left: 5px;padding-right: 5px;">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-tertiary" style="font-size: 3.2rem;width: 60px;height: 60px;line-height: 60px;">
                                <i class="fa fa-rupee"></i>            
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">Total Sales</h4>
                                <div class="info">
                                    <strong class="amount"><?= isset($Sales) ? $Sales : "0" ?></strong>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </section>
        </div>        
        <div class="col-md-3 col-lg-3 col-xl-3" style="padding: 0px;padding-right: 5px;padding-left: 5px;">
            <section class="panel panel-featured-left panel-featured-quartenary">
                <div class="panel-body" style="padding-left: 5px;padding-right: 5px;">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-danger" style="font-size: 3.2rem;width: 60px;height: 60px;line-height: 60px;">
                                <i class="fa fa-cubes"></i>            
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">Rejected Products</h4>
                                <div class="info">
                                    <strong class="amount"><?= isset($RejectProducts) ? $RejectProducts : "0" ?></strong>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
<!--    <div class="row">
        <div class="col-md-12">
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">                  
                    <h2 class="panel-title">Rejected Product Detail</h2>                    
                </header>
                <div class="panel-body">
                    <table class="table table-bordered table-striped mb-none" id="datatable-default">
                        <thead>
                            <tr>                                
                                <th>Product Name</th>
                                <th>Reason</th>
                            </tr>
                        </thead>
                        <tbody>  
                            <?php
                            if (isset($rproducts) && is_array($rproducts)) {
                                foreach ($rproducts as $val) {
                                    ?>
                                    <tr>                               
                                        <td><?= $val->product_name ?></td>
                                        <td><?= $val->reject_reason ?></td>                                        
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>            
        </div>
    </div>-->
    <!-- end: page -->
</section>
<script type="text/javascript">
    $(function() {
//        $('#datatable-default').dataTable({
//            order: [],
//            aLengthMenu: [[10, 15, 20, 25, -1], [10, 15, 20, 25, 'All']],
//            aoColumnDefs: [{
//                    bSortable: false,
//                    aTargets: [0, 1]
//                }],
//            iDisplayLength: 10
//        });

    });
</script>