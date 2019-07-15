<section role="main" class="content-body">
    <header class="page-header">
        <h2>Customer Master</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= site_url() ?>admin">
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
                    <form name="search" method="POST" action="<?= site_url() ?>admin/customer/search">
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
                                <label class="control-label">Mobile No</label>                          
                                <input name="primary_mobile" type="text" class="form-control">
                            </div> 
                            <div class="col-md-4">
                                <label class="control-label">Email</label>                          
                                <input name="primary_email" type="email" class="form-control">
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
                    <h2 class="panel-title">Customer Detail</h2>                    
                </header>
                <div class="panel-body">
                    <button id="btnExport1" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px">Export</button>
                    <table class="table table-bordered table-striped mb-none" id="datatable-default" style="text-align: center">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>State</th>
                                <th>City</th>
                                <th>Join</th>
                                <th>Status</th>
                                <th>Login</th>
                            </tr>
                        </thead>
                        <tbody>  
                            <?php
                            if (isset($customers)) {
                                foreach ($customers as $customer) {
                                    ?>
                                    <tr>
                                        <td style="width:80px;"><?= date("d-m-Y", strtotime($customer->reg_date)) ?></td>
                                        <td><?= $customer->first_name . " " . $customer->last_name ?></td>
                                        <td><?= $customer->primary_mobile ?></td>
                                        <td><?= $customer->primary_email ?></td>
                                        <td><?= $customer->state_name ?></td>
                                        <td><?= $customer->city ?></td>
                                        <td><?php 
                                        if($customer->join_via == 1){
                                            echo "WEB";
                                        }else{
                                            echo "APP";
                                        }
                                        ?></td>
                                        <td><?php if ($customer->status == '1') { ?>
                                                <span class="label label-success">Active</span>
                                            <?php } else { ?>
                                                <span class="label label-danger">Deactive</span>
                                            <?php } ?>
                                        </td>
                                        <td><a href="<?= site_url() ?>admin/customer/customer_login?id=<?= base64_encode($customer->primary_email) ?>" class="btn btn-success btn-xs" target="_blank">Login</a></td>
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
                    aTargets: [0, 1, 2, 3, 4, 5, 6, 7]
                }],
            iDisplayLength: 10
        });

        $("#btnExport1").click(function() {
            $("#datatable-default").btechco_excelexport({
                containerid: "datatable-default",
                datatype: $datatype.Table
            });
        });
    });
</script>