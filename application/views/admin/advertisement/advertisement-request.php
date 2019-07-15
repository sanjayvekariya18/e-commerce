<section role="main" class="content-body">
    <header class="page-header">
        <h2>Advertisement Request</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= site_url() ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
            </ol>
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
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
                    <form name="search" method="POST" action="<?= site_url() ?>admin/advertisement/search">
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
                            <div class="col-md-4">
                                <label class="control-label">Business Name</label>                          
                                <input name="business_name" type="text" class="form-control" >
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">Plan Price</label>
                                <input name="price" type="number" class="form-control">
                            </div> 

                        </div>
                        <div class="row" style="margin-top: 15px">
                            <div class="col-md-4">
                                <label class="control-label">Size</label>                          
                                <select id="size" name="size" class="form-control">
                                    <option value="-1">--Select--</option>
                                    <option value="570x120">570 X 120</option>
                                    <option value="585x65">585 X 65</option>
                                    <option value="234x350">234 X 350</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">Status</label>                          
                                <select id="status" name="status" class="form-control">
                                    <option value="-1">--Select--</option>
                                    <option value="0">In Review</option>
                                    <option value="1">Approved</option>
                                    <option value="2">Live</option>
                                    <option value="3">Expired</option>
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
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">                  
                    <h2 class="panel-title">Seller Advertisement Requests</h2>                    
                </header>
                <div class="panel-body">       
                    <button id="btnExport1" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px">Export</button>
                    <button class="btn btn-primary btn-sm mycheck" type="button" style="width:80px;margin-bottom: 15px" id="0">Inreview</button>
                    <button class="btn btn-info btn-sm mycheck" type="button" style="width:80px;margin-bottom: 15px" id="1">Approved</button>
                    <button class="btn btn-warning btn-sm mycheck" type="button" style="width:80px;margin-bottom: 15px" id="2">Live</button>
                    <button class="btn btn-warning btn-sm mycheck" type="button" style="width:80px;margin-bottom: 15px" id="3">Expired</button>

                    <form id="actionform" name="actionform" method="POST" action="<?= site_url() ?>admin/advertisement/requestStatusUpdate">
                        <input type="hidden" name="status" id="request_status" value=""/>
                        <table class="table table-bordered table-striped mb-none" id="datatable-default" style="text-align: center">
                            <thead>
                                <tr>
                                    <th style="font-size: 17px;padding-right: 18px;text-align: center;">
                                        <i class="fa fa-level-down"></i>     
                                    </th>
                                    <th>Request Date</th>
                                    <th>Seller Name</th>
                                    <th>From</th>                                
                                    <th>To</th>
                                    <th>Position</th>
                                    <th>Size</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <?php
                                if (isset($request) && is_array($request)) {
                                    foreach ($request as $val) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php if ($val->status != 1) { ?>
                                                    <input name="allRequest[]" value="<?= $val->request_id ?>" type="checkbox" >
                                                <?php } ?>
                                            </td>
                                            <td><?= date('d-m-Y', strtotime($val->request_date)) ?></td>
                                            <td><?= $val->business_name ?></td>
                                            <td style="width: 75px;"><?= date('d-m-Y', strtotime($val->from)) ?></td>
                                            <td style="width: 75px;"><?= date('d-m-Y', strtotime($val->to)) ?></td>
                                            <td><?= $val->category . '-' . $val->box ?></td>
                                            <td><?= $val->size ?></td>
                                            <?php
                                            $d1 = date_create($val->from);
                                            $d2 = date_create($val->to);
                                            $day = date_diff($d1, $d2)->format('%a');
                                            ?>
                                            <td><?= $day * $val->price ?> Rs.</td>
                                            <td>
                                                <?php if ($val->status == 0) { ?>
                                                    <span class="label label-primary">In-Review</span>
                                                <?php } else if ($val->status == 1) { ?>
                                                    <span class="label label-success">Approved</span>
                                                <?php } else if ($val->status == 2) { ?>
                                                    <span class="label label-success">Live</span>
                                                <?php } else if ($val->status == 3) { ?>
                                                    <span class="label label-danger">Expired</span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if ($val->status == 0 || $val->status == 3) { ?>
                                                    <a href="<?= site_url() ?>admin/advertisement/deleteRequest?id=<?= base64_encode($val->request_id) ?>"  class="btn btn-danger btn-xs" >
                                                        <i class="fa fa-trash"></i>Delete
                                                    </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?> 
                            </tbody>
                        </table>
                    </form>
                </div>
            </section>            
        </div>
    </div>
    <!-- end: page -->
</section>
<script type="text/javascript">
    $(function () {
        $('#datatable-default').dataTable({
            order: [],
            aLengthMenu: [[10, 15, 20, 25, -1], [10, 15, 20, 25, 'All']],
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0, 1, 2]
                }],
            iDisplayLength: 10
        });

        $('.mycheck').click(function () {
            $status = $(this).attr('id');
            $('#request_status').val($status);
            $('#actionform').submit();
        });
        
        $("#btnExport1").click(function () {
            $("#datatable-default").btechco_excelexport({
                containerid: "datatable-default",              
                datatype: $datatype.Table
            });
        });
    });
</script>