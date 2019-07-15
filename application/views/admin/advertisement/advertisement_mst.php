<section role="main" class="content-body">
    <header class="page-header">
        <h2>Advertisement Master</h2>

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
                    <h2 class="panel-title">Advertisement Detail</h2>                    
                </header>
                <div class="panel-body">
                    <button id="btnExport1" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px">Export</button>
                    <button class="btn btn-danger btn-sm mycheck" type="button" style="width:80px;margin-bottom: 15px">Delete</button>

                    <table class="table table-bordered table-striped mb-none" id="datatable-default" style="text-align: center">
                        <thead>
                            <tr>
                                <th style="font-size: 17px;padding-right: 18px;text-align: center;">
                                    <i class="fa fa-level-down"></i>     
                                </th>
                                <th>Business Name</th>
                                <th>Paid</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Plan</th>
                                <th>Status</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>                         
                            <tr>
                                <td><input name="allAdvertisement[]" value="" type="checkbox" ></td>
                                <td>Business Name</td>
                                <td>500</td>
                                <td>03-08-2015</td>
                                <td>09-08-2015</td>
                                <td>Basic</td>
                                <td><span class="label label-warning">Warning</span></td>
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
                <div class="row">
                    <div class="col-md-12">
                        <img src="" style="border: 1px solid;padding: 10px;width: 100%" />
                    </div>
                </div>
                <div class="row" style="margin-top: 10px">
                    <div class="col-md-5"></div>
                    <div class="col-md-2">
                        <select name="status" class="form-control">
                            <option  value="1">Approved</option>
                            <option  value="2">Reject</option>
                        </select>
                    </div>                                                                   
                </div>
            </div>                           
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button class="btn btn-primary modal-confirm">Confirm</button>
                        <button class="btn btn-default modal-dismiss">Cancel</button>
                    </div>
                </div>
            </footer>
        </section>
    </div>
    <!--Advertisement View Model End--> 
    <!-- end: page -->
</section>
<?php $msg = $this->input->get('msg'); ?>
<?php
switch ($msg) {
    case "U":
        $m = "Information Successfully Updated..!";
        $t = "success";
        break;
    default:
        $m = 0;
        break;
}
?>
<script type="text/javascript">
    $(document).ready(function() {
<?php if ($msg): ?>
            alertify.<?= $t ?>("<?= $m ?>");
<?php endif; ?>
    });
</script>
<script type="text/javascript">
    $(function() {
        $('#datatable-default').dataTable({
            order: [],
            aLengthMenu: [[10, 15, 20, 25, -1], [10, 15, 20, 25, 'All']],
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0, 1, 2, 3, 4, 5, 6, 7]
                }],
            iDisplayLength: 10
        });
        
        $("#btnExport1").click(function () {
            $("#datatable-default").btechco_excelexport({
                containerid: "datatable-default",              
                datatype: $datatype.Table
            });
        });
    });
</script>