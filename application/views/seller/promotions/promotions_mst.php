<section role="main" class="content-body">
    <header class="page-header">
        <h2>Promotions Master</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= site_url() ?>seller">
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
                        <a href="#" class="fa fa-caret-up"></a>                        
                    </div>

                    <h2 class="panel-title">Advance Search</h2>                    
                </header>
                <div class="panel-body" style="display:none"> 
                    <form name="search" method="POST" action="#">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">Date</label>
                                <div class="input-daterange input-group" data-plugin-datepicker>
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>    
                                    </span>
                                    <input type="text" class="form-control" name="start">
                                    <span class="input-group-addon">to</span>
                                    <input type="text" class="form-control" name="end" style="width: 115px;">
                                </div>   
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
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">                  
                    <h2 class="panel-title">Promotions Detail</h2>                    
                </header>
                <div class="panel-body">
                    <table class="table table-bordered table-striped mb-none" id="datatable-default" style="text-align: center">
                        <thead>
                            <tr>                                
                                <th>Type</th>
                                <th>Detail</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>                         
                            <tr>
                                <td>Basket Discount</td>
                                <td>Extra 15% off HDFB Credit Card</td>
                                <td>03-08-2015</td>
                                <td>09-08-2015</td>
                                <td><span class="label label-danger">Disabled</span></td>
                                <td><a class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn-success btn-xs" href="#modalView">View</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>            
        </div>
    </div>
    <!--Advertisement View Model Start-->
    <div id="modalView" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title">Advertisement</h2>
            </header>
            <div class="panel-body">
                
            </div>                           
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
<!--                        <button class="btn btn-primary modal-confirm">Confirm</button>-->
                        <button class="btn btn-default modal-dismiss">Cancel</button>
                    </div>
                </div>
            </footer>
        </section>
    </div>
    <!--Advertisement View Model End--> 
    <!-- end: page -->
</section>
<script type="text/javascript">
    $(function() {
        $('#datatable-default').dataTable({
            order: [],
            aLengthMenu: [[10, 15, 20, 25, -1], [10, 15, 20, 25, 'All']],
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0, 1, 2, 3, 4, 5]
                }],
            iDisplayLength: 10
        });
    });
</script>