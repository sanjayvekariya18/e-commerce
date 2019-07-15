<style type="text/css">
    th{
        text-align: center;
    }
</style>    
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Coupons Master</h2>

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

                    <h2 class="panel-title">Advance Search</h2>                    
                </header>
                <div class="panel-body"> 
                    <form name="search" method="POST" action="<?= site_url() ?>admin/chart">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">Order Date</label>
                                <div class="input-daterange input-group" data-plugin-datepicker>
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>    
                                    </span>
                                    <input type="text" class="form-control" name="start" value="<?= isset($_POST['start']) ? $_POST['start'] : '' ?>">
                                    <span class="input-group-addon">to</span>
                                    <input type="text" class="form-control" name="end" style="width: 115px;" value="<?= isset($_POST['end']) ? $_POST['end'] : '' ?>">
                                </div>   
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">Seller</label> 
                                <select id="seller_id" name="seller_id" class="form-control">
                                    <option value="-1">--Select--</option>
                                    <?php
                                    if (isset($seller)) {
                                        foreach ($seller as $val) {
                                            ?>
                                            <option value="<?= $val->seller_id ?>"><?= $val->business_name ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
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
        <div class="col-md-12">
            <div class="chart chart-md" id="flotPie"></div>  
        </div>
    </div>
</section>
<script src="<?= base_url() ?>assets/vendor/jquery-easypiechart/jquery.easypiechart.js"></script>
<script src="<?= base_url() ?>assets/vendor/flot/jquery.flot.js"></script>
<script src="<?= base_url() ?>assets/vendor/flot/jquery.flot.pie.js"></script>
<script src="<?= base_url() ?>assets/vendor/flot/jquery.flot.tooltip.js"></script>
<!--<script src="<?= base_url() ?>assets/javascripts/ui-elements/examples.charts.js"></script>-->
<script type="text/javascript">

    $('#seller_id').val("<?= isset($_POST['seller_id'])?$_POST['seller_id']:'-1'?>");

    var flotPieData = <?= $chartdata ?>;
    var plot = $.plot('#flotPie', flotPieData, {
        series: {
            pie: {
                show: true                
            }
        },
        legend: {
            show: false
        },
        grid: {
            hoverable: true,
            clickable: true
        }
    });
</script>
