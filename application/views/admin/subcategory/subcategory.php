<section role="main" class="content-body">
    <header class="page-header">
        <h2>Subcategory Master</h2>

        <div class="right-wrapper pull-right" style="padding-right: 10px;">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= site_url() ?>admin">
                        <i class="fa fa-home"></i>
                    </a>
                </li>                
                <li><span>Subcategory Master</span></li>
            </ol>           
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-md-12">
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Subcategory Detail</h2>
                </header>
                <div class="panel-body">
                    <form id="subcategoryform" class="form-horizontal" method="POST" action="#">
                        <input id="subcategory_id" type="hidden" name="subcategory_id">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Main Category Name :- </label>
                            <div class="col-md-4">
                                <select id="main_category_id" name="main_category_id" class="form-control">
                                    <option value="1">Women's Ethnic Wear</option>
                                    <option value="2">Jewellery</option>
                                    <option value="3">Western Wear</option>                                    
                                </select> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Subcategory  Name :- </label>
                            <div class="col-md-4">
                                <input id="subcategory_name" name="subcategory_name" type="text" class="form-control">
                            </div>
                        </div>                                                                       
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-4">
                                <button id="saveBtn" name="saveBtn" type="button" class="mb-xs mt-xs mr-xs btn btn-success" style="width:100px" value="save">Save</button>
                                <button type="reset" class="mb-xs mt-xs mr-xs btn btn-danger" style="width:100px">Clear</button>
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
                    <h2 class="panel-title">Subcategory  Detail</h2>
                </header>
                <div class="panel-body">                    
                    <button id="btnExport1" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px;margin-top: 15px">Export</button>
                    <!--Dynamic Table-->
                    <table class="table table-bordered table-striped mb-none" id="datatable-default">
                        <thead>
                            <tr>                                    
                                <th>Sr No</th>
                                <th>Main category Name</th>
                                <th>Sub category Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($subcategory)) {
                                $srno = 0;
                                foreach ($subcategory as $val) {
                                    $srno+=1;
                                    ?>                                
                                    <tr>
                                        <td><?= $srno ?></td>
                                        <td><?php
                                            switch ($val->main_category_id) {
                                                case 1:
                                                    echo "Women's Ethnic Wear";
                                                    break;
                                                case 2:
                                                    echo "Jewellery";
                                                    break;
                                                case 3:
                                                    echo "Western Wear";
                                                    break;
                                            }
                                            ?></td>
                                        <td><?= $val->subcategory_name ?></td>
                                        <td>
                                            <button  type="button" class="btn btn-primary btn-xs update" style="width:60px;" value="<?= $val->main_category_id.'|'.$val->subcategory_id ?>">Edit</button>
                                            <button  type="button" value="<?= base64_encode($val->subcategory_id) ?>" class="btn btn-danger btn-xs delete" style="width:60px;">Delete</button>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <!--Dynamic End-->   
                </div>
            </section>
        </div>
    </div>
    <!-- end: page -->
</section>
<?php $msg = $this->input->get('msg'); ?>
<?php
switch ($msg) {
    case "S":
        $m = "Sub Category Successfully Saved..!";
        $t = "success";
        break;
    case "U":
        $m = "Sub Category Successfully Updated..!";
        $t = "success";
        break;
    case "D":
        $m = "Sub Category Successfully Deleted..!";
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
    $(document).ready(function() {
        $flag = 0;
        $('#saveBtn').on("click", function() {
            if ($('#subcategory_name').val() == "") {
                alertify.error("Enter Subcategory  Name");
                $flag = 0;
            } else {
                $flag = 1;
            }
            if ($flag == 1) {
                $btntype = $(this).val();
                if ($btntype == "save")
                {
                    $url = "<?= site_url() ?>admin/subcategory/addSubcategoryData";
                    $('#subcategoryform').attr('action', $url);
                    $('#subcategoryform').submit();
                }
                else if ($btntype == "update")
                {
                    $url = "<?= site_url() ?>admin/subcategory/updateSubcategoryData";
                    $('#subcategoryform').attr('action', $url);
                    $('#subcategoryform').submit();
                }
            }

        });

        $('.update').on("click", function() {
            $id = $(this).val().split('|');
            $main_category_id = $id[0];
            $sub_category_id = $id[1];
            
            $subcategory_name = $(this).parent().prev().text();

            $('#main_category_id').val($main_category_id);
            $('#subcategory_id').val($sub_category_id);
            $('#subcategory_name').val($subcategory_name);
            $('#saveBtn').val('update');
            $('#saveBtn').text('update');

        });

        $('.delete').on("click", function() {
            $id = $(this).val();
            alertify.confirm("Are You Sure To Delete This Subcategory  ...!!", function(e) {
                if (e) {
                    window.location.href = "<?= site_url() ?>admin/subcategory/deleteSubcategoryData?id=" + $id;
                    return true;
                }
                else {
                    return false;
                }
            });
        });

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