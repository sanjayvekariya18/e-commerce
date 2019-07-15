<section role="main" class="content-body">
    <header class="page-header">
        <h2>Account Master</h2>

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
                    <form name="search" method="POST" action="<?= site_url() ?>admin/account/search">
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
                <form id="assignform" method="post" action ="<?= site_url() ?>admin/account/assign">
                    <div class="panel-body">
                        <button id="btnExport1" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px">Export</button>
                        <button id="assign" class="btn btn-success btn-sm mycheck" type="button" style="width:80px;margin-bottom: 15px">Assign</button>
                        <a id="assignpopup" class="mb-xs mt-xs mr-xs modal-with-zoom-anim btn btn-default" href="#modalAssign" style="display: none"></a>
                        <input type="hidden" id="emp_id" name="employee_id" value=""/>
                        <table class="table table-bordered table-striped mb-none" id="datatable-default" style="text-align: center">
                            <thead>
                                <tr>
                                    <th style="font-size: 17px;padding-right: 18px;text-align: center;">
                                        <i class="fa fa-level-down"></i>     
                                    </th>
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
                                    foreach ($sellers as $seller) {
                                        ?>
                                        <tr>
                                            <td><input name="allSeller[]" value="<?= $seller->seller_id ?>" type="checkbox" ></td>
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
                                            <?php
                                            if ($this->common->isSellerAssignToEmployee($seller->seller_id) > 0) {
                                                ?>
                                                <td><a id="<?= $seller->seller_id ?>" href="#modalUnAssign" class="mb-xs mt-xs mr-xs modal-with-zoom-anim btn btn-success btn-xs unassign" >Unassign</a></td>
                                            <?php } else { ?> 
                                                <td></td>     
                                            <?php } ?>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </section>            
        </div>
    </div>
    <div id="modalAssign" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title" style="font-size: 16px;">Are you sure to assign seller to employee .. ??</h2>
            </header>
            <div class="panel-body">
                <div class="modal-wrapper">
                    <div class="modal-icon">
                        <i class="fa fa-question-circle"></i>
                    </div>
                    <div class="modal-text">
                        <div class="row">
                            <div class="col-md-8">                                
                                <label class="control-label">Select Employee</label> 
                                <select id="employee_id" name="employee_id" class="form-control">
                                    <?php
                                    if (isset($employees) && is_array($employees)) {
                                        foreach ($employees as $val) {
                                            ?>
                                            <option value="<?= $val->employee_id ?>"><?= $val->first_name . " " . $val->last_name ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button id="assignconfirm" class="btn btn-primary modal-dismiss">Confirm</button>
                        <button class="btn btn-default modal-dismiss">Cancel</button>
                    </div>
                </div>
            </footer>
        </section>
    </div>
    <div id="modalUnAssign" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
        <form id="unassignform" method="post" action ="<?= site_url() ?>admin/account/unassign">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title" style="font-size: 16px;">Are you sure to un-assign seller to employee .. ??</h2>
                </header>
                <div class="panel-body">
                    <div class="modal-wrapper">
                        <div class="modal-icon">
                            <i class="fa fa-question-circle"></i>
                        </div>
                        <div class="modal-text">
                            <div class="row">
                                <div class="col-md-8">        
                                    <input type="hidden" id="myseller_id" name="seller_id" />
                                    <label class="control-label">Select Employee</label> 
                                    <select id="employee_id" name="employee_id" class="form-control employees">

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button id="unassignconfirm" type="submit" class="btn btn-primary modal-dismiss">Confirm</button>
                            <button class="btn btn-default modal-dismiss">Cancel</button>
                        </div>
                    </div>
                </footer>
            </section>
        </form>
    </div>
    <!-- end: page -->
</section>
<?php $msg = $this->input->get('msg'); ?>
<?php
switch ($msg) {
    case "A":
        $m = "Employee Assign To Seller..!";
        $t = "success";
        break;
    case "UA":
        $m = "Employee Un-Assign To Seller..!";
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
                    aTargets: [0, 1, 2]
                }],
            iDisplayLength: 10
        });
        
        $("#btnExport1").click(function () {
            $("#datatable-default").btechco_excelexport({
                containerid: "datatable-default",              
                datatype: $datatype.Table
            });
        });
        
        assign();
    	assignconfirm();
	unassignconfirm();
	unassign();
        
        $('.dataTables_paginate').click(function() {
            assign();
            assignconfirm();
            unassignconfirm();
            unassign();
        });

        $('.dataTables_filter input').change(function() {
            assign();
            assignconfirm();
            unassignconfirm();
            unassign();
        });

	function assign(){
        $('#assign').click(function() {
            $('#assignpopup').trigger('click');
        });}

	function assignconfirm(){ 
        $('#assignconfirm').click(function() {
            $('#emp_id').val($('#employee_id').val());
            $('#assignform').submit();
        });}
        
        
	function unassignconfirm(){
        $('#unassignconfirm').click(function() {
            $('#unassignform').submit();
        });}

	function unassign(){
        $('.unassign').click(function() {
            $seller_id = $(this).attr('id')
            $('#myseller_id').val($seller_id);

            $.ajax({
                url: "<?= site_url() ?>admin/account/getAssignEmployee",
                type: "post",
                data: {'seller_id': $seller_id},
                success: function(data, textStatus, jqXHR) {
                    $('.employees').html(data);
                }
            });
        });}
    });
</script>