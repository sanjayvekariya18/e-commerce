<section role="main" class="content-body">
    <header class="page-header">
        <h2>Add Coupon Detail</h2>

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
                    <h2 class="panel-title">Add Coupon Detail</h2>                    
                </header>
                <div class="panel-body">
                    <form id="couponform" class="form-horizontal" method="post" action="<?= site_url() ?>admin/coupon/addCouponData">                          
                        <div class="form-group">
                            <label class="col-md-3 control-label">Coupon Code</label>
                            <div class="col-md-4">
                                <input name="coupon_code" type="text" class="form-control" value="" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Flat</label>
                            <div class="col-sm-1" style="margin-top: 5px;margin-right: -10px;">
                                <div class="radio-custom radio-primary">
                                    <input type="radio" id="flat" name="type" value="0" checked>
                                    <label for="flat">Flat</label>
                                </div>
                            </div>
                            <div class="col-sm-1" style="margin-top: 5px;">
                                <div class="radio-custom radio-primary">
                                    <input type="radio" id="percent" name="type" value="1">
                                    <label for="percent">Percentage</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Coupon Value</label>
                            <div class="col-md-4">
                                <input name="coupon_value" type="text" class="form-control" value="" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Apply Type</label>
                            <div class="col-sm-1" style="margin-top: 5px;margin-right: -10px;">
                                <div class="radio-custom radio-primary">
                                    <input type="radio" id="supc" name="apply_type" value="0" checked>
                                    <label for="supc">SUPC</label>
                                </div>
                            </div>
                            <div class="col-sm-1" style="margin-top: 5px;">
                                <div class="radio-custom radio-primary">
                                    <input type="radio" id="category" name="apply_type" value="1">
                                    <label for="category">Category</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group category_block" style="display: none">
                            <label class="col-md-3 control-label">Product Category</label>
                            <div class="col-md-4">
                                <select id="sub_category_id" name="sub_category_id" class="form-control">
                                    <option value="-1">--Select--</option>
                                    <?php
                                    if (isset($subcategory)) {
                                        foreach ($subcategory as $val) {
                                            ?>
                                            <option value="<?= $val->subcategory_id ?>"><?= $val->subcategory_name ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>                                
                            </div>
                        </div>
                        <div class="form-group supc_block">
                            <label class="col-md-3 control-label">Product SUPC</label>
                            <div class="col-md-4">
                                <input id="psupc" name="supc" type="text" class="form-control" value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-4">
                                <button type="submit" name="saveBtn" class="mb-xs mt-xs mr-xs btn btn-success" value="<?= isset($sellergroup->group_id) ? 'update' : 'save' ?>"><?= isset($sellergroup->group_id) ? 'Update' : 'Save' ?></button>
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
    $(document).ready(function() {
        $('#category').click(function() {
            $('.supc_block').css('display', 'none');
            $('.category_block').css('display', 'block');
        });

        $('#supc').click(function() {
            $('.supc_block').css('display', 'block');
            $('.category_block').css('display', 'none');
        });

        $('#couponform').on('submit', function() {
            if ($('#supc').is(':checked')) {
                if ($('#psupc').val() == "") {
                    alertify.error("Please Enter Product SUPC Number");
                    return false;
                }
            } else if ($('#category').is(':checked')) {
                if ($('#sub_category_id').val() == "-1") {
                    alertify.error("Please Select Product Category");
                    return false;
                }
            } else {
                return true;
            }
        });
    });
</script>
