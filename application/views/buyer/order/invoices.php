<section role="main" class="content-body">
    <header class="page-header">
        <h2>Invoices</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= site_url() ?>buyer">
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
                    <h2 class="panel-title">Invoices Details</h2>                    
                </header>
                <div class="panel-body">                    
                    <table class="table table-bordered table-striped mb-none" id="datatable-default" style="text-align: center">
                        <thead>
                            <tr>                                    
                                <th>Date</th>
                                <th>Order Id</th>
                                <th>Product Name</th>
                                <th>Amount</th> 
                                <th>Print</th>                                
                            </tr>
                        </thead>
                        <tbody> 
                            <?php
                            if (isset($invoices) && is_array($invoices)) {
                                foreach ($invoices as $val) {
                                    ?>
                                    <tr>                                            
                                        <td><?= date('d-m-Y', strtotime($val->order_date)) ?></td>
                                        <td><?= $val->order_id ?></td>
                                        <td><?= $val->product_name ?></td>
                                        <td><?= $val->payment_price ?></td>
                                        <td><a href="<?= site_url() ?>buyer/track/printInvoice?id=<?= base64_encode($val->order_id) ?>" target="_blank"><i class="fa fa-print"></i></a></td>                                      
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
    </div>
    <!-- end: page -->
</section>
<script type="text/javascript">
    $(function() {
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