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
                                <i class="fa fa-user"></i>            
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">Total Seller</h4>
                                <div class="info">
                                    <strong class="amount"><?= isset($Sellers) ? $Sellers : "0" ?></strong>                                    
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
                                <i class="fa fa-user"></i>            
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">Total Customer</h4>
                                <div class="info">
                                    <strong class="amount"><?= isset($Customers) ? $Customers : "0" ?></strong>
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
                                <i class="fa fa-user"></i>            
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">Total Employee</h4>
                                <div class="info">
                                    <strong class="amount"><?= isset($Employees) ? $Employees : "0" ?></strong>
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
                            <div class="summary-icon bg-quartenary" style="font-size: 3.2rem;width: 60px;height: 60px;line-height: 60px;">
                                <i class="fa fa-cubes"></i>            
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">Live Product</h4>
                                <div class="info">
                                    <strong class="amount"><?= isset($Products) ? $Products : "0" ?></strong>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>
                    </div>

                    <h2 class="panel-title">Top 10 Seller</h2>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-none">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Business Name</th>
                                    <th>Mobile</th>
                                    <th>City</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($TopSeller)) {
                                    $srno = 0;
                                    foreach ($TopSeller as $val) {
                                        $srno+=1;
                                        ?>
                                        <tr>
                                            <td><?= $srno ?></td>
                                            <td><?= $val->business_name ?></td>
                                            <td><?= $val->primary_mobile ?></td>
                                            <td><?= $val->pickup_city ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-6">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>
                    </div>

                    <h2 class="panel-title">Top 10 Products</h2>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-none">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($TopProduct)) {
                                    $srno = 0;
                                    foreach ($TopProduct as $val) {
                                        $srno+=1;
                                        ?>
                                        <tr>
                                            <td><?= $srno ?></td>
                                            <td><a target="_blank" href="<?= site_url() ?>product?pname=<?= str_replace(" ", "-", $val->product_name) ?>&pid=<?= base64_encode($val->product_id) ?>"><?= $val->product_name ?></a></td>                                            
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
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