<style type="text/css">
    th{
        text-align: center;
    }
</style>    
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Employee Master</h2>
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
            <a href="<?= site_url() ?>admin/employee/addEmployee" class="btn btn-success btn-md" >Add Employee</a>
        </div>
    </div>
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
                    <form name="search" method="POST" action="<?= site_url() ?>admin/employee/searchEmployee">
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
                                <input name="personal_phone" type="text" class="form-control">
                            </div> 
                            <div class="col-md-4">
                                <label class="control-label">Email</label>                          
                                <input name="email" type="email" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">Department</label>         
                                <select id="department_id" name="department_id" class="form-control" required>
                                    <option value="-1">---Select---</option>
                                    <?php
                                    if (isset($department)) {
                                        foreach ($department as $val) {
                                            ?>
                                            <option value="<?= $val->department_id ?>"><?= $val->department_name ?></option>
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
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">                  
                    <h2 class="panel-title">Employee Detail</h2>                    
                </header>
                <div class="panel-body">
                    <form id="tableform" method="post" name="employeetableform" action="#">
                        <button id="btnExport1" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px">Export</button>
                        <button id="delete" class="btn btn-danger btn-sm mycheck" type="button" style="width:80px;margin-bottom: 15px">Delete</button>
                        <button id="active" class="btn btn-success btn-sm mycheck" type="button" style="width:80px;margin-bottom: 15px">Active</button>
                        <button id="suspend" class="btn btn-warning btn-sm mycheck" type="button" style="width:80px;margin-bottom: 15px">Suspend</button>
                        <table class="table table-bordered table-striped mb-none" id="datatable-default" style="text-align: center">
                            <thead>
                                <tr>
                                    <th style="font-size: 17px;padding-right: 18px;text-align: center;">
                                        <i class="fa fa-level-down"></i>     
                                    </th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Personal Phone</th>
                                    <th>Email</th>
                                    <th>City</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <th>Login</th>
                                </tr>
                            </thead>
                            <tbody>  
                                <?php
                                if (isset($employees)) {
                                    foreach ($employees as $val) {
                                        ?>
                                        <tr>
                                            <td><input name="allEmployee[]" value="<?= $val->employee_id ?>" type="checkbox" ></td>
                                            <td><?= $val->first_name ?></td>
                                            <td><?= $val->middle_name ?></td>
                                            <td><?= $val->last_name ?></td>
                                            <td><?= $val->personal_phone ?></td>
                                            <td><?= $val->email ?></td>
                                            <td><?= $val->city ?></td>
                                            <td><?php if ($val->status == '1') { ?>
                                                    <span class="label label-success">Active</span>
                                                <?php } else { ?>
                                                    <span class="label label-danger">Deactive</span>
                                                <?php } ?>
                                            </td>
                                            <td><a href="<?= site_url() ?>admin/employee/getEmployeeData?id=<?= base64_encode($val->employee_id) ?>" class="btn btn-success btn-xs" >Edit</a></td>
                                            <td><a href="<?= site_url() ?>admin/employee/employee_login?id=<?= base64_encode($val->email) ?>" class="btn btn-success btn-xs" target="_blank">Login</a></td>
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
    $(function() {
        $('#datatable-default').dataTable({
            order: [],
            aLengthMenu: [[10, 15, 20, 25, -1], [10, 15, 20, 25, 'All']],
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0, 1, 2, 3, 4, 5, 6]
                }],
            iDisplayLength: 10
        });
        
        $("#btnExport1").click(function () {
            $("#datatable-default").btechco_excelexport({
                containerid: "datatable-default",              
                datatype: $datatype.Table
            });
        });
        
        $('#delete').click(function() {
            $('#tableform').attr('action', '<?= site_url() ?>admin/employee/deleteEmployeeData');
            $('#tableform').submit();
        });
        
        $('#active').click(function() {
            $('#tableform').attr('action', '<?= site_url() ?>admin/employee/activeEmployee');
            $('#tableform').submit();
        });

        $('#suspend').click(function() {
            $('#tableform').attr('action', '<?= site_url() ?>admin/employee/suspendEmployee');
            $('#tableform').submit();
        });
    });
</script>