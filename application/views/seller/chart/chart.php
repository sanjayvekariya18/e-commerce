<section role="main" class="content-body">
    <header class="page-header">
        <h2>Chart</h2>
    </header>
    <!-- start: page -->
    <div class="row">
        <div class="col-md-12">
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>                        
                    </div>

                    <h2 class="panel-title">Advance Search</h2>                    
                </header>
                <div class="panel-body"> 
                    <form id="search" name="search" method="POST" action="<?= site_url() ?>seller/chart">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">Month</label>
                                <select id="month" name="month" class="form-control">
                                    <option value="-1">--Select Month--</option>
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div> 
                            <div class="col-md-4">
                                <label class="control-label">Year</label>                          
                                <select id="year" name="year" class="form-control">
                                    <option value="-1">--Select Year--</option>
                                    <?php for ($i = 2015; $i <= 2030; $i++) { ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php } ?>
                                </select>
                            </div> 
                        </div>
                        <div class="row" style="margin-top: 15px">
                            <div class="col-md-4">
                                <button class="btn btn-success btn-sm" type="submit" style="width:80px">Search</button>
                                <button class="btn btn-warning btn-sm" type="reset" style="width:80px">Clear</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>            
        </div>
    </div>
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
                                <h4 class="title">Your Cancellation</h4>
                                <div class="info">
                                    <strong class="amount"><?= isset($chart->tcancel) ? $chart->tcancel . '  (' . round(($chart->tcancel / $chart->total * 100), 2) . '%)' : "0" ?></strong>                                    
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
                                <h4 class="title">Customer Returns</h4>
                                <div class="info">
                                    <strong class="amount"><?= isset($chart->treturn) ? $chart->treturn . '  (' . round(($chart->treturn / $chart->total * 100), 2) . '%)' : "0" ?></strong>
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
                                <i class="fa fa-cubes"></i>            
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">Unit Sold</h4>
                                <div class="info">
                                    <strong class="amount"><?= isset($chart->tqty) ? $chart->tqty : "0" ?></strong>
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
                                <i class="fa fa-rupee"></i>            
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">Gross Revenue</h4>
                                <div class="info">
                                    <strong class="amount"><?= isset($revenue) ? $revenue : "0" ?></strong>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">                    
                    <h2 class="panel-title">Cancel Order Chart</h2>
                </header>
                <div class="panel-body">
                    <!-- Flot: Bars -->
                    <div class="chart chart-md" id="cancelBars"></div>
                </div>
            </section>
        </div>
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">                    
                    <h2 class="panel-title">Return Order Chart</h2>
                </header>
                <div class="panel-body">
                    <!-- Flot: Bars -->
                    <div class="chart chart-md" id="returnBars"></div>
                </div>
            </section>
        </div>
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">                    
                    <h2 class="panel-title">Total Quantity Sales Chart</h2>
                </header>
                <div class="panel-body">
                    <!-- Flot: Bars -->
                    <div class="chart chart-md" id="salesBars"></div>
                </div>
            </section>
        </div>
    </div>
    <!-- end: page -->
</section>
<script src="<?= base_url() ?>assets/vendor/jquery-easypiechart/jquery.easypiechart.js"></script>
<script src="<?= base_url() ?>assets/vendor/flot/jquery.flot.js"></script>
<script src="<?= base_url() ?>assets/vendor/flot/jquery.flot.categories.js"></script>
<script src="<?= base_url() ?>assets/vendor/flot/jquery.flot.tooltip.js"></script>
<script type="text/javascript">

    $(document).ready(function () {
        $('#search').on('submit', function () {
            $('#month').val("<?=  isset($_POST['month']) ? $_POST['month'] : "-1"?>");
            $('#year').val("<?=  isset($_POST['year']) ? $_POST['year'] : "-1"?>");
            if ($('#month').val() != "-1" && $('#year').val() != "-1") {
                return true;
            } else {
                alertify.error("Month and Year Must Be Selected");
                return false;
            }
        });
    });
    
    var cancelData = <?= $cancelorder ?>;
    var returnData = <?= $returnorder ?>;
    var salesData = <?= $salesorder ?>;

    var plot = $.plot('#cancelBars', [cancelData], {
        colors: ['#8CC9E8'],
        series: {
            bars: {
                show: true,
                barWidth: 0.8,
                align: 'center'
            }
        },
        xaxis: {
            mode: 'categories',
            tickLength: 0
        },
        grid: {
            hoverable: true,
            clickable: true,
            borderColor: 'rgba(0,0,0,0.1)',
            borderWidth: 1,
            labelMargin: 15,
            backgroundColor: 'transparent'
        },
        tooltip: true,
        tooltipOpts: {
            content: '%y',
            shifts: {
                x: -10,
                y: 20
            },
            defaultTheme: false
        }
    });

    var plot = $.plot('#returnBars', [returnData], {
        colors: ['#E36159'],
        series: {
            bars: {
                show: true,
                barWidth: 0.8,
                align: 'center'
            }
        },
        xaxis: {
            mode: 'categories',
            tickLength: 0
        },
        grid: {
            hoverable: true,
            clickable: true,
            borderColor: 'rgba(0,0,0,0.1)',
            borderWidth: 1,
            labelMargin: 15,
            backgroundColor: 'transparent'
        },
        tooltip: true,
        tooltipOpts: {
            content: '%y',
            shifts: {
                x: -10,
                y: 20
            },
            defaultTheme: false
        }
    });

    var plot = $.plot('#salesBars', [salesData], {
        colors: ['#2BAAB1'],
        series: {
            bars: {
                show: true,
                barWidth: 0.8,
                align: 'center'
            }
        },
        xaxis: {
            mode: 'categories',
            tickLength: 0
        },
        grid: {
            hoverable: true,
            clickable: true,
            borderColor: 'rgba(0,0,0,0.1)',
            borderWidth: 1,
            labelMargin: 15,
            backgroundColor: 'transparent'
        },
        tooltip: true,
        tooltipOpts: {
            content: '%y',
            shifts: {
                x: -10,
                y: 20
            },
            defaultTheme: false
        }
    });

</script>