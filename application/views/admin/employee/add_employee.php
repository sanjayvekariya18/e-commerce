<section role="main" class="content-body">
    <header class="page-header">
        <h2>Add Employee</h2>

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
                    <h2 class="panel-title">Employee Detail</h2>                    
                </header>
                <div class="panel-body">
                    <form class="form-horizontal" method="post" action="<?= site_url() ?>admin/employee/addEmployeeData" enctype="multipart/form-data">                          
                        <input type="hidden" name="employee_id" value="<?= isset($employee) ? $employee->employee_id : '' ?>"/>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Department</label>
                            <div class="col-md-4">
                                <select id="department_id" name="department_id" class="form-control" required>
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
                        <div class="form-group">
                            <label class="col-md-3 control-label">First Name</label>
                            <div class="col-md-4">
                                <input name="first_name" type="text" class="form-control" value="<?= isset($employee->first_name) ? $employee->first_name : '' ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Middle Name</label>
                            <div class="col-md-4">
                                <input name="middle_name" type="text" class="form-control" value="<?= isset($employee->middle_name) ? $employee->middle_name : '' ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Last Name</label>
                            <div class="col-md-4">
                                <input name="last_name" type="text" class="form-control" value="<?= isset($employee->last_name) ? $employee->last_name : '' ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Gender</label>
                            <div class="col-sm-1" style="margin-top: 5px;margin-right: -10px;">
                                <div class="radio-custom radio-primary">
                                    <input type="radio" id="male" name="gender" value="Male" checked>
                                    <label for="male">Male</label>
                                </div>
                            </div>
                            <div class="col-sm-1" style="margin-top: 5px;">
                                <div class="radio-custom radio-primary">
                                    <input type="radio" id="female" name="gender" value="Female" <?= isset($employee->gender) ? ($employee->gender == "Female") ? 'checked' : '' : '' ?>>
                                    <label for="female">Female</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Date Of Birth</label>
                            <div class="col-md-4" style="padding-right: 0px;">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input id="dob" name="dob" type="text" data-plugin-datepicker class="form-control" style="width: 95%;" value="<?= isset($employee->dob) ? ($employee->dob != null) ? date('d-m-Y', strtotime($employee->dob)) : '' : '' ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Address</label>
                            <div class="col-md-4">
                                <textarea name="address" type="text" class="form-control" ><?= isset($employee->address) ? $employee->address : '' ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">City</label>
                            <div class="col-md-4">
                                <input name="city" type="text" class="form-control" value="<?= isset($employee->city) ? $employee->city : '' ?>"/>
                            </div>
                        </div>
                        <?php $states = $this->common->getStates(); ?>
                        <div class="form-group">
                            <label class="col-md-3 control-label">State</label>
                            <div class="col-md-4">
                                <select id="state" name="state" class="form-control" required>
                                    <option value="-1">-- Select State --</option>
                                    <?php foreach ($states as $val) { ?>
                                        <option value="<?= $val->id ?>"><?= $val->state_name ?></option>
                                    <?php } ?> 
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Pincode</label>
                            <div class="col-md-4">
                                <input name="pincode" type="text" class="form-control" value="<?= isset($employee->pincode) ? $employee->pincode : '' ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Personal Phone</label>
                            <div class="col-md-4">
                                <input name="personal_phone" type="text" class="form-control" value="<?= isset($employee->personal_phone) ? $employee->personal_phone : '' ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Home Phone</label>
                            <div class="col-md-4">
                                <input name="home_phone" type="text" class="form-control" value="<?= isset($employee->home_phone) ? $employee->home_phone : '' ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Email</label>
                            <div class="col-md-4">
                                <input id="email" name="email" type="text" class="form-control" value="<?= isset($employee->email) ? $employee->email : '' ?>" <?= isset($employee->email) ? 'disabled' : '' ?>/>
                            </div>
                        </div>
                        <div class="form-group" style="display:<?= isset($employee->employee_id) ? 'none' : 'block' ?>">
                            <label class="col-md-3 control-label">Password :- </label>
                            <div class="col-md-4">
                                <input id="password" name="password" type="password" class="form-control" value="">
                            </div>
                        </div> 
                        <div class="form-group" style="display:<?= isset($employee->address_proof) ? ($employee->address_proof != "") ? 'block' : 'none' : 'none' ?>">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-4">                                
                                <img src="<?= isset($employee->address_proof) ? $employee->address_proof : '' ?>" style="width: 370px;border: 4px double;height: 180px;"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Upload address proof</label>
                            <div class="col-md-6">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="input-append">
                                        <div class="uneditable-input">
                                            <i class="fa fa-file fileupload-exists"></i>
                                            <span class="fileupload-preview"></span>
                                        </div>
                                        <span class="btn btn-default btn-file">
                                            <span class="fileupload-exists">Change</span>
                                            <span class="fileupload-new">Select file</span>
                                            <input type="file" name="address_proof" <?= isset($employee->address_proof) ? ($employee->address_proof == "") ? 'required' : '' : 'required' ?>/>
                                        </span>
                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="display:<?= isset($employee->id_proof) ? ($employee->id_proof != "") ? 'block' : 'none' : 'none' ?>">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-4">                                
                                <img src="<?= isset($employee->id_proof) ? $employee->id_proof : '' ?>" style="width: 370px;border: 4px double;height: 180px;"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Upload ID proof</label>
                            <div class="col-md-6">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="input-append">
                                        <div class="uneditable-input">
                                            <i class="fa fa-file fileupload-exists"></i>
                                            <span class="fileupload-preview"></span>
                                        </div>
                                        <span class="btn btn-default btn-file">
                                            <span class="fileupload-exists">Change</span>
                                            <span class="fileupload-new">Select file</span>
                                            <input type="file" name="id_proof" <?= isset($employee->id_proof) ? ($employee->id_proof == "") ? 'required' : '' : 'required' ?>/>
                                        </span>
                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-4">
                                <button type="submit" name="saveBtn" class="mb-xs mt-xs mr-xs btn btn-success" value="<?= isset($employee->employee_id) ? 'update' : 'save' ?>"><?= isset($employee->employee_id) ? 'Update' : 'Save' ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>            
        </div>
    </div>
    <!-- end: page -->
</section>
<script type="text/javascript">
    $(document).ready(function () {
        $department_id = "<?= isset($employee->department_id) ? $employee->department_id : '' ?>";
        $state = "<?= isset($employee->state) ? $employee->state : '-1' ?>";
        $employee_id = "<?= isset($employee) ? $employee->employee_id : '0' ?>";
        if ($employee_id != 0) {
            $('#department_id').val($department_id);
            $('#state').val($state);
        }

        $('#email').focusout(function () {
            if ($employee_id == 0) {
                $.ajax({
                    url: '<?= site_url() ?>admin/employee/email_valid',
                    type: 'POST',
                    data: {'email': $(this).val()},
                    success: function (data, textStatus, jqXHR) {
                        if (data != '0') {
                            $('#email').val("");
                            alertify.error("This email Id Is Already Register");
                        }
                    }
                });
            }
        });
    });

</script>
