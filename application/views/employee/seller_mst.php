<section role="main" class="content-body">
    <header class="page-header">
        <h2>Seller Master</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="index.html">
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
                    <form name="search" method="POST" action="<?= site_url() ?>admin/employee_seller/search">
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
                                <label class="control-label">First Name</label>                          
                                <input name="first_name" type="text" class="form-control" >
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">Last Name</label>                          
                                <input name="last_name" type="text" class="form-control" >
                            </div> 
                        </div>
                        <div class="row" style="margin-top: 15px">
                            <div class="col-md-4">
                                <label class="control-label">Mobile No</label>                          
                                <input name="primary_mobile" type="text" class="form-control">
                            </div> 
                            <div class="col-md-4">
                                <label class="control-label">Email</label>                          
                                <input name="primary_email" type="email" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">City</label>                          
                                <input name="pickup_city" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row" style="margin-top: 15px">
                            <div class="col-md-4">
                                <label class="control-label">Status</label> 
                                <select id="status" name="status" class="form-control">
                                    <option value="-1">--Select--</option>
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">Gender</label> 
                                <select id="gender" name="gender" class="form-control">
                                    <option value="-1">--Select--</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
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
                    <h2 class="panel-title">Seller Detail</h2>                    
                </header>
                <div class="panel-body">
                    <!--                    <button class="btn btn-danger btn-sm mycheck" type="button" style="width:80px;margin-bottom: 15px">Delete</button>-->

                    <table class="table table-bordered table-striped mb-none" id="datatable-default" style="text-align: center">
                        <thead>
                            <tr>

                                <th>Sr.No</th>
                                <th>Full Name</th>
                                <th>Business Name</th>
                                <th>Group</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>City</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php
                            if (isset($sellers)) {
                                $srno = 0;
                                foreach ($sellers as $seller) {
                                    $srno+=1;
                                    ?>
                                    <tr>
                                        <td><?= $srno ?></td>
                                        <td><?= $seller->first_name . " " . $seller->last_name ?></td>
                                        <td><?= $seller->business_name ?></td>
                                        <td><?= $seller->group_name ?></td>
                                        <td><?= $seller->primary_mobile ?></td>
                                        <td><?= $seller->primary_email ?></td>
                                        <td><?= $seller->pickup_city ?></td>
                                        <td><?php if ($seller->status == '1') { ?>
                                                <span class="label label-success">Active</span>
                                            <?php } else { ?>
                                                <span class="label label-danger">Deactive</span>
                                            <?php } ?>
                                        </td>
                                        <td><a href="<?= site_url() ?>admin/employee_seller/seller_login?id=<?= base64_encode($seller->primary_email) ?>" class="btn btn-success btn-xs" target="_blank">Login</a></td>
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
                    aTargets: [0, 1, 2]
                }],
            iDisplayLength: 10
        });
    });
</script>