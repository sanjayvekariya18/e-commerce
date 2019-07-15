<style type="text/css">
    .screenhide{
        position: fixed;
        width: 100%;        
        height: 100%;        
        z-index: 99999;
        opacity: 0.5;
        background-color: white;
        top: 0px;
        left: 0px;
    }
</style> 

<section role="main" class="content-body">
    <header class="page-header">
        <h2>Add Product</h2>

        <div class="right-wrapper pull-right" style="padding-right: 10px;">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= site_url() ?>seller">
                        <i class="fa fa-home"></i>
                    </a>
                </li>                
                <li><span>Add Product</span></li>
            </ol>           
        </div>
    </header>
    <!-- start: page -->
    <div class="row">
        <div class="col-md-12">
            <section class="panel form-wizard panel-featured panel-featured-primary" id="w4">
                <header class="panel-heading">                    
                    <h2 class="panel-title">Add Product</h2>
                </header>
                <form id="productform" name="productform" class="form-horizontal" method="post" novalidate="novalidate" enctype="multipart/form-data">
                    <input type="hidden" name="product_id" value="<?= isset($product->product_id) ? $product->product_id : '' ?>"/>
                    <div class="panel-body">
                        <div class="wizard-progress wizard-progress-lg" style="width:100%">
                            <div class="steps-progress" style="margin: 0 40px;top: 34px;">
                                <div class="progress-indicator"></div>
                            </div>
                            <ul class="wizard-steps">
                                <li class="active">
                                    <a href="#w4-general" data-toggle="tab" style="font-size: 12px;"><span>1</span>General</a>
                                </li>
                                <li>
                                    <a href="#w4-data" data-toggle="tab" style="font-size: 12px;"><span>2</span>Data</a>
                                </li>
                                <li>
                                    <a href="#w4-variation" data-toggle="tab" style="font-size: 12px;"><span>3</span>Variation</a>
                                </li>
                                <li>
                                    <a href="#w4-image" data-toggle="tab" style="font-size: 12px;"><span>4</span>Image</a>
                                </li>                                                       
                            </ul>
                        </div>                    
                        <div class="tab-content">
                            <div id="w4-general" class="tab-pane active">
                                <div class="form-group">
                                    <label class="col-md-3 control-label text-danger">Main Category *</label>
                                    <div class="col-md-4">
                                        <select id="main_category_id" name="main_category_id" class="form-control">
                                            <option value="-1">--Select--</option>
                                            <option value="1">Women's Ethnic Wear</option>
                                            <option value="2">Jewellery</option>
                                            <option value="3">Western Wear</option>
                                        </select>                                
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label text-danger">Sub Category *</label>
                                    <div class="col-md-4">
                                        <select id="sub_category_id" name="sub_category_id" class="form-control">
                                            <option value="-1">--Select--</option>
                                        </select>                                
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" >Description</label>
                                    <div class="col-sm-8">
                                        <textarea type="text" class="form-control" name="product_desc" value="" rows="4"><?= isset($product->product_desc) ? $product->product_desc : '' ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group" style="display: none">
                                    <label class="col-sm-3 control-label text-danger" >Meta Tag Title *</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="meta_title" value="<?= isset($product->meta_title) ? $product->meta_title : '' ?>" >
                                    </div>
                                </div>
                                <div class="form-group" style="display: none">
                                    <label class="col-sm-3 control-label" >Meta Tag Description</label>
                                    <div class="col-sm-8">
                                        <textarea type="text" class="form-control" name="meta_desc" value="" rows="4"><?= isset($product->meta_desc) ? $product->meta_desc : '' ?></textarea>
                                    </div>
                                </div><div class="form-group">
                                    <label class="col-sm-3 control-label" >Meta Tag Keyword</label>
                                    <div class="col-sm-8">
                                        <textarea type="text" class="form-control" name="meta_keyword" value="<?= isset($product->meta_keyword) ? $product->meta_keyword : '' ?>" rows="4"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label text-danger" >Style Code *</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="style_code" value="<?= isset($product->style_code) ? $product->style_code : '' ?>" required>
                                    </div>
                                </div>
                            </div> 
                            <div id="w4-data" class="tab-pane">                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Image</label>
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
                                                    <input id="product_image" type="file" name='product_image' <?= isset($product->image_thumb) ? '' : 'required' ?>/>
                                                </span>
                                                <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label text-danger" >Vendor Code (SKU) *</label>
                                    <div class="col-sm-4">
                                        <input id="sku" type="text" class="form-control" name="sku" value="<?= isset($product->sku) ? $product->sku : '' ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label text-danger" >MRP *</label>
                                    <div class="col-sm-4">
                                        <input id="mrp" type="text" class="form-control" name="mrp" value="<?= isset($product->mrp) ? $product->mrp : '' ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label text-danger" >Selling Price *</label>
                                    <div class="col-sm-4">
                                        <input id="selling_price" type="text" class="form-control" name="selling_price" value="<?= isset($product->selling_price) ? $product->selling_price : '' ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label text-danger" >Web Price *</label>
                                    <div class="col-sm-4">
                                        <input id="web_price" type="text" class="form-control" name="web_price" value="<?= isset($product->web_price) ? $product->web_price : '' ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label text-danger" >Weight In Gram *</label>
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control" name="weight" value="<?= isset($product->weight) ? $product->weight : '' ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label text-danger">Shipping Time *</label>
                                    <div class="col-md-4">
                                        <select id="shipping_time" name="shipping_time" class="form-control">
                                            <option value="1">1-Day(s)</option>
                                            <option value="2">2-Day(s)</option>
                                            <option value="3">3-Day(s)</option>
                                            <option value="4">4-Day(s)</option>
                                            <option value="5">5-Day(s)</option>
                                            <option value="6">6-Day(s)</option>
                                            <option value="7">7-Day(s)</option>
                                            <option value="8">8-Day(s)</option>
                                            <option value="9">9-Day(s)</option>
                                            <option value="10">10-Day(s)</option>
                                        </select>                                
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label text-danger" >Settlement Value *</label>
                                    <div class="col-sm-9">
                                        <table width="100%" class="table table-bordered">
                                            <tr>
                                                <td><a id="<?= isset($product->product_id) ? $product->product_id : '' ?>" class="mb-xs mt-xs mr-xs modal-with-move-anim calculator" href="#modalPrice"><i class="fa fa-th"></i></a></td>
                                                <td><label class="text-dark settlementvalue" style="width:70px;text-align: center;"></label></td>
                                                <td>
                                                    <table width="100%" class="table table-bordered" style="text-align: center">
                                                        <thead>
                                                            <tr>
                                                                <th style="text-align: center">Commission</th>
                                                                <th style="text-align: center">Fixed</th>
                                                                <th style="text-align: center">Service Tax</th>
                                                                <th style="text-align: center">Listing Fee</th>
                                                                <th style="text-align: center">Marketing Fee</th>
                                                                <th style="text-align: center">Payment Collection Fee</th>
                                                                <th style="text-align: center">Other</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><label id="" class="text-dark tcommission"></label> (<label class="text-dark tcommissionrate"></label>%)</td>
                                                                <td><label id="" class="text-dark tfixed" ></label></td>
                                                                <td><label id="" class="text-dark tservice"></label> (<label class="text-dark tservicerate"></label>%)</td>
                                                                <td><label id="" class="text-dark tlisting"></label></td>
                                                                <td><label id="" class="text-dark tmarketing"></label> (<label  class="text-dark tmarketingrate"></label>%)</td>
                                                                <td><label id="" class="text-dark tpay"></label> (<label class="text-dark tpayrate"></label>%)</td>
                                                                <td><label id="" class="text-dark tother"></label></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label text-danger" >Quantity *</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="qty" value="<?= isset($product->qty) ? $product->qty : '' ?>" required>
                                    </div>
                                </div>
                            </div> 
                            <div id="w4-variation" class="tab-pane">
                                <div class="row width" style="border:1px solid">
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Width</label>
                                    </div>
                                    <div class="col-md-2" style="border-left: 1px solid">                                        
                                        <input type="text" class="form-control" name="width" value="<?= isset($product->width) ? $product->width : '' ?>" style="margin: 5px 0px;">
                                    </div>
                                </div>
                                <div class="row height" style="border:1px solid">
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Height</label>
                                    </div>
                                    <div class="col-md-2" style="border-left: 1px solid">                                        
                                        <input type="text" class="form-control" name="height" value="<?= isset($product->height) ? $product->height : '' ?>" style="margin: 5px 0px;">
                                    </div>
                                </div>
                                <div class="row length" style="border:1px solid">
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Length</label>
                                    </div>
                                    <div class="col-md-2" style="border-left: 1px solid">                                        
                                        <input type="text" class="form-control" name="length" value="<?= isset($product->length) ? $product->length : '' ?>" style="margin: 5px 0px;">
                                    </div>
                                </div>
                                <div class="row diameter" style="border:1px solid">
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Diameter</label>
                                    </div>
                                    <div class="col-md-2" style="border-left: 1px solid">                                        
                                        <input type="text" class="form-control" name="diameter" value="<?= isset($product->diameter) ? $product->diameter : '' ?>" style="margin: 5px 0px;">
                                    </div>
                                </div>
                                <div class="row company" style="border:1px solid">
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Brand Name</label>
                                    </div>
                                    <div class="col-md-4" style="border-left: 1px solid">                                        
                                        <input type="text" class="form-control" name="company" value="<?= isset($product->company) ? $product->company : '' ?>" style="margin: 5px 0px;">
                                    </div>
                                </div>                                
                                <div class="row fabric" style="border:1px solid">
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Fabric</label>
                                    </div>
                                    <div class="col-md-10" style="border-left: 1px solid">  
                                        <div class="row">
                                            <?php
                                            if (isset($fabric)) {
                                                foreach ($fabric as $val) {
                                                    ?>
                                                    <div class="col-md-2">
                                                        <input type="checkbox" name="variations1[]" value="<?= $val['id'] ?>" style='padding: 5px'> 
                                                        <label class="text-dark" style='padding: 5px'><?= $val['name'] ?></label>  
                                                    </div>

                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row fabric_care" style="border:1px solid">
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Fabric Care</label>
                                    </div>
                                    <div class="col-md-10" style="border-left: 1px solid">  
                                        <div class="row">
                                            <?php
                                            if (isset($fabric_care)) {
                                                foreach ($fabric_care as $val) {
                                                    ?>   
                                                    <div class="col-md-2">
                                                        <input type="radio" name="variations2[]" value="<?= $val['id'] ?>" style='padding: 5px'> 
                                                        <label class="text-dark" style='padding: 5px'><?= $val['name'] ?></label>  
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row bottom_fabric" style="border:1px solid" >
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Bottom Fabric</label>
                                    </div>
                                    <div class="col-md-10" style="border-left: 1px solid">    
                                        <div class="row">
                                            <?php
                                            if (isset($bottom_fabric)) {
                                                foreach ($bottom_fabric as $val) {
                                                    ?>     
                                                    <div class="col-md-2">
                                                        <input type="radio" name="variations3[]" value="<?= $val['id'] ?>" style='padding: 5px'> 
                                                        <label class="text-dark" style='padding: 5px'><?= $val['name'] ?></label>  
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row inner_fabric" style="border:1px solid" >
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Inner Fabric</label>
                                    </div>
                                    <div class="col-md-10" style="border-left: 1px solid"> 
                                        <div class="row">
                                            <?php
                                            if (isset($inner_fabric)) {
                                                foreach ($inner_fabric as $val) {
                                                    ?>     
                                                    <div class="col-md-2">
                                                        <input type="radio" name="variations4[]" value="<?= $val['id'] ?>" style='padding: 5px'> 
                                                        <label class="text-dark" style='padding: 5px'><?= $val['name'] ?></label>  
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row dupatta_fabric" style="border:1px solid" >
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Dupatta Fabric</label>
                                    </div>
                                    <div class="col-md-10" style="border-left: 1px solid">    
                                        <div class="row">
                                            <?php
                                            if (isset($dupatta_fabric)) {
                                                foreach ($dupatta_fabric as $val) {
                                                    ?>   
                                                    <div class="col-md-2">
                                                        <input type="radio" name="variations5[]" value="<?= $val['id'] ?>" style='padding: 5px'> 
                                                        <label class="text-dark" style='padding: 5px'><?= $val['name'] ?></label>  
                                                    </div> 
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row blouse_fabric" style="border:1px solid">
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Blouse Fabric</label>
                                    </div>
                                    <div class="col-md-10" style="border-left: 1px solid"> 
                                        <div class="row">
                                            <?php
                                            if (isset($blouse_fabric)) {
                                                foreach ($blouse_fabric as $val) {
                                                    ?>         
                                                    <div class="col-md-2">
                                                        <input type="radio" name="variations6[]" value="<?= $val['id'] ?>" style='padding: 5px'> 
                                                        <label class="text-dark" style='padding: 5px'><?= $val['name'] ?></label>  
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row colour" style="border:1px solid">
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Colour</label>
                                    </div>
                                    <div class="col-md-10" style="border-left: 1px solid"> 
                                        <div class="row">
                                            <?php
                                            if (isset($colour)) {
                                                foreach ($colour as $val) {
                                                    ?>             
                                                    <div class="col-md-2">
                                                        <input type="checkbox" name="variations[]" value="<?= $val['id'] ?>" style='padding: 5px'> 
                                                        <label class="text-dark" style='padding: 5px'><?= $val['name'] ?></label>  
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row type" style="border:1px solid">
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Type</label>
                                    </div>
                                    <div class="col-md-10" style="border-left: 1px solid"> 
                                        <div class="row">
                                            <?php
                                            if (isset($type)) {
                                                foreach ($type as $val) {
                                                    ?>           
                                                    <div class="col-md-3">
                                                        <input type="checkbox" name="variations[]" value="<?= $val['id'] ?>" style='padding: 5px'> 
                                                        <label class="text-dark" style='padding: 5px'><?= $val['name'] ?></label>  
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pattern" style="border:1px solid">
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Pattern</label>
                                    </div>
                                    <div class="col-md-10" style="border-left: 1px solid">    
                                        <div class="row">
                                            <?php
                                            if (isset($work)) {
                                                foreach ($work as $val) {
                                                    ?>         
                                                    <div class="col-md-2">
                                                        <input type="checkbox" name="variations7[]" value="<?= $val['id'] ?>" style='padding: 5px'> 
                                                        <label class="text-dark" style='padding: 5px'><?= $val['name'] ?></label>  
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row size" style="border:1px solid">
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Size</label>
                                    </div>
                                    <div class="col-md-10" style="border-left: 1px solid">   
                                        <div class="row">
                                            <?php
                                            if (isset($size)) {
                                                foreach ($size as $val) {
                                                    ?>           
                                                    <div class="col-md-2">
                                                        <input type="checkbox" name="variations[]" value="<?= $val['id'] ?>" style='padding: 5px'> 
                                                        <label class="text-dark" style='padding: 5px'><?= $val['name'] ?></label>  
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row sleeve" style="border:1px solid">
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Sleeve</label>
                                    </div>
                                    <div class="col-md-10" style="border-left: 1px solid">  
                                        <div class="row">
                                            <?php
                                            if (isset($sleeve)) {
                                                foreach ($sleeve as $val) {
                                                    ?>   
                                                    <div class="col-md-2">
                                                        <input type="radio" name="variations8[]" value="<?= $val['id'] ?>" style='padding: 5px'> 
                                                        <label class="text-dark" style='padding: 5px'><?= $val['name'] ?></label>  
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row style" style="border:1px solid">
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Style</label>
                                    </div>
                                    <div class="col-md-10" style="border-left: 1px solid"> 
                                        <div class="row">
                                            <?php
                                            if (isset($style)) {
                                                foreach ($style as $val) {
                                                    ?>          
                                                    <div class="col-md-2">
                                                        <input type="checkbox" name="variations[]" value="<?= $val['id'] ?>" style='padding: 5px'> 
                                                        <label class="text-dark" style='padding: 5px'><?= $val['name'] ?></label>  
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row collection" style="border:1px solid">
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Collection</label>
                                    </div>
                                    <div class="col-md-10" style="border-left: 1px solid"> 
                                        <div class="row">
                                            <?php
                                            if (isset($collection)) {
                                                foreach ($collection as $val) {
                                                    ?>
                                                    <div class="col-md-2">
                                                        <input type="checkbox" name="variations[]" value="<?= $val['id'] ?>" style='padding: 5px'> 
                                                        <label class="text-dark" style='padding: 5px'><?= $val['name'] ?></label>  
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>                                
                                <div class="row occasion" style="border:1px solid">
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Occasion</label>
                                    </div>
                                    <div class="col-md-10" style="border-left: 1px solid">   
                                        <div class="row">
                                            <?php
                                            if (isset($occasion)) {
                                                foreach ($occasion as $val) {
                                                    ?>      
                                                    <div class="col-md-2">
                                                        <input type="checkbox" name="variations9[]" value="<?= $val['id'] ?>" style='padding: 5px'> 
                                                        <label class="text-dark" style='padding: 5px'><?= $val['name'] ?></label>  
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row celebrity" style="border:1px solid">
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Celebrity</label>
                                    </div>
                                    <div class="col-md-10" style="border-left: 1px solid"> 
                                        <div class="row">
                                            <?php
                                            if (isset($celebrity)) {
                                                foreach ($celebrity as $val) {
                                                    ?>       
                                                    <div class="col-md-3">
                                                        <input type="checkbox" name="variations[]" value="<?= $val['id'] ?>" style='padding: 5px'> 
                                                        <label class="text-dark" style='padding: 5px'><?= $val['name'] ?></label>  
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row sstyle" style="border:1px solid">
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Saree Style</label>
                                    </div>
                                    <div class="col-md-10" style="border-left: 1px solid"> 
                                        <div class="row">
                                            <?php
                                            if (isset($saree_style)) {
                                                foreach ($saree_style as $val) {
                                                    ?>         
                                                    <div class="col-md-2">
                                                        <input type="checkbox" name="variations[]" value="<?= $val['id'] ?>" style='padding: 5px'> 
                                                        <label class="text-dark" style='padding: 5px'><?= $val['name'] ?></label>  
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row skstyle" style="border:1px solid">
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Salwar Kameez Style</label>
                                    </div>
                                    <div class="col-md-10" style="border-left: 1px solid"> 
                                        <div class="row">
                                            <?php
                                            if (isset($salwar_kameez_style)) {
                                                foreach ($salwar_kameez_style as $val) {
                                                    ?>    
                                                    <div class="col-md-2">
                                                        <input type="checkbox" name="variations[]" value="<?= $val['id'] ?>" style='padding: 5px'> 
                                                        <label class="text-dark" style='padding: 5px'><?= $val['name'] ?></label>  
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div> 
                                <div class="row saree_border" style="border:1px solid">
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Saree Border</label>
                                    </div>
                                    <div class="col-md-10" style="border-left: 1px solid">  
                                        <div class="row">
                                            <?php
                                            if (isset($saree_border)) {
                                                foreach ($saree_border as $val) {
                                                    ?>   
                                                    <div class="col-md-3">
                                                        <input type="radio" name="variations10[]" value="<?= $val['id'] ?>" style='padding: 5px'> 
                                                        <label class="text-dark" style='padding: 5px'><?= $val['name'] ?></label>  
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row saree_length" style="border:1px solid">
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Saree Length</label>
                                    </div>
                                    <div class="col-md-10" style="border-left: 1px solid">  
                                        <div class="row">
                                            <?php
                                            if (isset($saree_length)) {
                                                foreach ($saree_length as $val) {
                                                    ?>
                                                    <div class="col-md-2">
                                                        <input type="radio" name="variations11[]" value="<?= $val['id'] ?>" style='padding: 5px'> 
                                                        <label class="text-dark" style='padding: 5px'><?= $val['name'] ?></label>  
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="row bottom_colour" style="border:1px solid">
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Bottom Colour</label>
                                    </div>
                                    <div class="col-md-10" style="border-left: 1px solid"> 
                                        <div class="row">
                                            <?php
                                            if (isset($bottom_colour)) {
                                                foreach ($bottom_colour as $val) {
                                                    ?>             
                                                    <div class="col-md-2">
                                                        <input type="checkbox" name="variations[]" value="<?= $val['id'] ?>" style='padding: 5px'> 
                                                        <label class="text-dark" style='padding: 5px'><?= $val['name'] ?></label>  
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row dupatta_colour" style="border:1px solid">
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Dupatta Colour</label>
                                    </div>
                                    <div class="col-md-10" style="border-left: 1px solid"> 
                                        <div class="row">
                                            <?php
                                            if (isset($dupatta_colour)) {
                                                foreach ($dupatta_colour as $val) {
                                                    ?>             
                                                    <div class="col-md-2">
                                                        <input type="checkbox" name="variations[]" value="<?= $val['id'] ?>" style='padding: 5px'> 
                                                        <label class="text-dark" style='padding: 5px'><?= $val['name'] ?></label>  
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row bottom_size" style="border:1px solid">
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Bottom Size</label>
                                    </div>
                                    <div class="col-md-10" style="border-left: 1px solid"> 
                                        <div class="row">
                                            <?php
                                            if (isset($bottom_size)) {
                                                foreach ($bottom_size as $val) {
                                                    ?>             
                                                    <div class="col-md-2">
                                                        <input type="checkbox" name="variations[]" value="<?= $val['id'] ?>" style='padding: 5px'> 
                                                        <label class="text-dark" style='padding: 5px'><?= $val['name'] ?></label>  
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row top_size" style="border:1px solid">
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Top Size</label>
                                    </div>
                                    <div class="col-md-10" style="border-left: 1px solid"> 
                                        <div class="row">
                                            <?php
                                            if (isset($top_size)) {
                                                foreach ($top_size as $val) {
                                                    ?>             
                                                    <div class="col-md-2">
                                                        <input type="checkbox" name="variations[]" value="<?= $val['id'] ?>" style='padding: 5px'> 
                                                        <label class="text-dark" style='padding: 5px'><?= $val['name'] ?></label>  
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row dupatta_size" style="border:1px solid">
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Dupatta Size</label>
                                    </div>
                                    <div class="col-md-10" style="border-left: 1px solid"> 
                                        <div class="row">
                                            <?php
                                            if (isset($dupatta_size)) {
                                                foreach ($dupatta_size as $val) {
                                                    ?>             
                                                    <div class="col-md-2">
                                                        <input type="checkbox" name="variations[]" value="<?= $val['id'] ?>" style='padding: 5px'> 
                                                        <label class="text-dark" style='padding: 5px'><?= $val['name'] ?></label>  
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row stitching" style="border:1px solid">
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Stitching</label>
                                    </div>
                                    <div class="col-md-10" style="border-left: 1px solid">  
                                        <div class="row">
                                            <?php
                                            if (isset($stitching)) {
                                                foreach ($stitching as $val) {
                                                    ?>
                                                    <div class="col-md-2">
                                                        <input type="radio" name="variations12[]" value="<?= $val['id'] ?>" style='padding: 5px'> 
                                                        <label class="text-dark" style='padding: 5px'><?= $val['name'] ?></label>  
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="row fashion" style="border:1px solid">
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Fine or Fashion</label>
                                    </div>
                                    <div class="col-md-10" style="border-left: 1px solid">  
                                        <div class="row">
                                            <?php
                                            if (isset($fine_or_fashion)) {
                                                foreach ($fine_or_fashion as $val) {
                                                    ?>
                                                    <div class="col-md-2">
                                                        <input type="radio" name="variations13[]" value="<?= $val['id'] ?>" style='padding: 5px' checked> 
                                                        <label class="text-dark" style='padding: 5px'><?= $val['name'] ?></label>  
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="row gender" style="border:1px solid">
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Gender</label>
                                    </div>
                                    <div class="col-md-10" style="border-left: 1px solid">  
                                        <div class="row">
                                            <?php
                                            if (isset($gender)) {
                                                foreach ($gender as $val) {
                                                    ?>
                                                    <div class="col-md-2">
                                                        <input type="radio" name="variations14[]" value="<?= $val['id'] ?>" style='padding: 5px' checked> 
                                                        <label class="text-dark" style='padding: 5px'><?= $val['name'] ?></label>  
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="row material" style="border:1px solid">
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Material</label>
                                    </div>
                                    <div class="col-md-10" style="border-left: 1px solid">  
                                        <div class="row">
                                            <?php
                                            if (isset($material)) {
                                                foreach ($material as $val) {
                                                    ?>
                                                    <div class="col-md-3">
                                                        <input type="checkbox" name="variations15[]" value="<?= $val['id'] ?>" style='padding: 5px'> 
                                                        <label class="text-dark" style='padding: 5px'><?= $val['name'] ?></label>  
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="row metals_type" style="border:1px solid">
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Metals Type</label>
                                    </div>
                                    <div class="col-md-10" style="border-left: 1px solid"> 
                                        <div class="row">
                                            <?php
                                            if (isset($metals_type)) {
                                                foreach ($metals_type as $val) {
                                                    ?>             
                                                    <div class="col-md-2">
                                                        <input type="checkbox" name="variations[]" value="<?= $val['id'] ?>" style='padding: 5px'> 
                                                        <label class="text-dark" style='padding: 5px'><?= $val['name'] ?></label>  
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row gem_stone" style="border:1px solid">
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Gem Stone</label>
                                    </div>
                                    <div class="col-md-10" style="border-left: 1px solid">  
                                        <div class="row">
                                            <?php
                                            if (isset($gem_stone)) {
                                                foreach ($gem_stone as $val) {
                                                    ?>
                                                    <div class="col-md-3">
                                                        <input type="radio" name="variations16[]" value="<?= $val['id'] ?>" style='padding: 5px' checked> 
                                                        <label class="text-dark" style='padding: 5px'><?= $val['name'] ?></label>  
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="row shape" style="border:1px solid">
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Shape</label>
                                    </div>
                                    <div class="col-md-10" style="border-left: 1px solid">  
                                        <div class="row">
                                            <?php
                                            if (isset($shape)) {
                                                foreach ($shape as $val) {
                                                    ?>
                                                    <div class="col-md-2">
                                                        <input type="radio" name="variations17[]" value="<?= $val['id'] ?>" style='padding: 5px' checked> 
                                                        <label class="text-dark" style='padding: 5px'><?= $val['name'] ?></label>  
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="row setting_type" style="border:1px solid">
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Setting Type</label>
                                    </div>
                                    <div class="col-md-10" style="border-left: 1px solid"> 
                                        <div class="row">
                                            <?php
                                            if (isset($setting_type)) {
                                                foreach ($setting_type as $val) {
                                                    ?>             
                                                    <div class="col-md-2">
                                                        <input type="checkbox" name="variations[]" value="<?= $val['id'] ?>" style='padding: 5px'> 
                                                        <label class="text-dark" style='padding: 5px'><?= $val['name'] ?></label>  
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row fit" style="border:1px solid">
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Fit</label>
                                    </div>
                                    <div class="col-md-10" style="border-left: 1px solid"> 
                                        <div class="row">
                                            <?php
                                            if (isset($fit)) {
                                                foreach ($fit as $val) {
                                                    ?>             
                                                    <div class="col-md-2">
                                                        <input type="checkbox" name="variations[]" value="<?= $val['id'] ?>" style='padding: 5px'> 
                                                        <label class="text-dark" style='padding: 5px'><?= $val['name'] ?></label>  
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row rise" style="border:1px solid">
                                    <div class="col-md-2">
                                        <label class="text-dark" style="font-weight: bold;padding: 5px">Rise</label>
                                    </div>
                                    <div class="col-md-10" style="border-left: 1px solid"> 
                                        <div class="row">
                                            <?php
                                            if (isset($rise)) {
                                                foreach ($rise as $val) {
                                                    ?>             
                                                    <div class="col-md-2">
                                                        <input type="checkbox" name="variations[]" value="<?= $val['id'] ?>" style='padding: 5px'> 
                                                        <label class="text-dark" style='padding: 5px'><?= $val['name'] ?></label>  
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div id="w4-image" class="tab-pane">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Product Other Images</label>
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
                                                    <input type="file" name='product_images[]' multiple/>
                                                </span>
                                                <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div class="panel-footer">
                            <ul class="pager">
                                <li class="previous disabled">
                                    <a><i class="fa fa-angle-left"></i> Previous</a>
                                </li>
                                <li class="finish hidden pull-right">
                                    <a>save & Finish</a>
                                </li>
                                <li class="next">
                                    <a>Next <i class="fa fa-angle-right"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
    <!--Price Calculator Model Start -->
    <div id="modalPrice" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title">Commission Calculator</h2>
            </header>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-2">
                                <label class="text-dark" style="font-weight: bold;">Set Selling Price :</label>
                            </div>
                            <div class="col-md-2">
                                <input id="model_selling_price" name="sell_price" type="number" class="form-control" />
                            </div>
                        </div>                        
                        <div class="row" style="padding-top: 10px;">
                            <div class="col-md-12">
                                <table width="100%" class="table table-bordered" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">Commission</th>
                                            <th style="text-align: center">Fixed</th>
                                            <th style="text-align: center">Service Tax</th>
                                            <th style="text-align: center">Listing Fee</th>
                                            <th style="text-align: center">Marketing Fee</th>
                                            <th style="text-align: center">Payment Collection Fee</th>
                                            <th style="text-align: center">Other</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><label id="" class="text-dark tcommission_sales"></label> (<label class="text-dark tcommissionrate"></label>%)</td>
                                            <td><label id="" class="text-dark tfixed" ></label></td>
                                            <td><label id="" class="text-dark tservice_sales"> </label> (<label class="text-dark tservicerate"></label>%)</td>
                                            <td><label id="" class="text-dark tlisting"></label></td>
                                            <td><label id="" class="text-dark tmarketing_sales"> </label> (<label  class="text-dark tmarketingrate"></label>%)</td>
                                            <td><label id="" class="text-dark tpay_sales"></label> (<label class="text-dark tpayrate"></label>%)</td>
                                            <td><label id="" class="text-dark tother"></label></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="text-align: right;font-size: 16px;">
                                <label class="text-dark" style="font-weight: bold">Settlement Value:</label>
                                <label class="text-primary settlementvalue_sales" style="font-weight: bold"></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="text-align: right;font-size: 14px;">
                                <label class="text-muted ">(Note: Settlement value is calculated based on selling price and shipping fees)</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="text-danger">Disclaimer: The commission and discount are based on the current rate card. The actual charges may vary depending on order date. The calculated Settlement Value include Shipping Charges.</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                           
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">                        
                        <button class="btn btn-default modal-dismiss">Cancel</button>
                    </div>
                </div>
            </footer>
        </section>
    </div>
    <!--Price Calculator Model End-->
    <div id="productloader" class="screenhide" style="display:none">
        <center>
            <img src="<?= base_url() ?>assets/images/loading_blue.gif" style="margin-top: 200px;width: 150px;height: 150px"/>
            <h3 class="page-heading-title2" style="color:#0088CC;font-size: 28px;margin-top: 50px;">Please Wait ..!!! We Are Uploading Your Product...</h3>
        </center>
    </div>
    <!-- end: page -->
</section>
<script type="text/javascript">
    $(document).ready(function() {
        // WIZARD 4 CODE START 

        var $w4finish = $('#w4').find('ul.pager li.finish'),
                $w4validator = $("#w4 form").validate({
            highlight: function(element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function(element) {
                $(element).closest('.form-group').removeClass('has-error');
                $(element).remove();
            },
            errorPlacement: function(error, element) {
                element.parent().append(error);
            }
        });
        $w4finish.on('click', function(ev) {
            ev.preventDefault();
            var validated = $('#w4 form').valid();
            if (validated) {
                $('#productform').submit();
            }
        });
        $('#w4').bootstrapWizard({
            tabClass: 'wizard-steps',
            nextSelector: 'ul.pager li.next',
            previousSelector: 'ul.pager li.previous',
            firstSelector: null,
            lastSelector: null,
            onNext: function(tab, navigation, index, newindex) {

                var validated = $('#w4 form').valid();
                if (!validated) {
                    $w4validator.focusInvalid();
                    return false;
                }

            },
            onTabClick: function(tab, navigation, index, newindex) {
                if (newindex == index + 1) {
                    return this.onNext(tab, navigation, index, newindex);
                } else if (newindex > index + 1) {
                    return false;
                } else {
                    return true;
                }
            },
            onTabChange: function(tab, navigation, index, newindex) {
                var $total = navigation.find('li').size() - 1;
                $w4finish[ newindex != $total ? 'addClass' : 'removeClass' ]('hidden');
                $('#w4').find(this.nextSelector)[ newindex == $total ? 'addClass' : 'removeClass' ]('hidden');
            },
            onTabShow: function(tab, navigation, index) {
                var $total = navigation.find('li').length - 1;
                var $current = index;
                var $percent = Math.floor(($current / $total) * 100);
                $('#w4').find('.progress-indicator').css({'width': $percent + '%'});
                tab.prevAll().addClass('completed');
                tab.nextAll().removeClass('completed');
            }
        });
        // WIZARD 4 CODE END

        // OWN JQUERY START         

        $product_id = "<?= isset($product->product_id) ? $product->product_id : '' ?>";
        $shipping_time = "<?= isset($product->shipping_time) ? $product->shipping_time : '1' ?>";
        $variation_ids = "<?= isset($product->variation_id) ? $product->variation_id : '' ?>";
        $main_category_id = "<?= isset($product->main_category_id) ? $product->main_category_id : '' ?>";
        $sub_category_id = "<?= isset($product->sub_category_id) ? $product->sub_category_id : '' ?>";

        if ($main_category_id != "") {
            $('#main_category_id > option').each(function() {
                if ($(this).val() == $main_category_id) {
                    $(this).prop('selected', true);
                }
            });
            setTimeout(function() {
                $('#main_category_id').trigger('change');
            }, 500);
            setTimeout(function() {
                $('#sub_category_id > option').each(function() {
                    if ($(this).val() == $sub_category_id) {
                        $(this).prop('selected', true);
                    }
                });
                $('#sub_category_id').trigger('change');
            }, 1000);
        }

        $('#shipping_time').val($shipping_time);
        $variation_arr = $variation_ids.split(',');
        $("input:checkbox").each(function() {
            $checkvalue = $(this).val();
            if ($.inArray($checkvalue, $variation_arr) !== -1)
            {
                $(this).parent('.icheckbox_minimal').iCheck('check');
            }
        });
        $("input:radio").each(function() {
            $checkvalue = $(this).val();
            if ($.inArray($checkvalue, $variation_arr) !== -1)
            {
                $(this).parent('.iradio_minimal-blue').iCheck('check');
            }
        });
        $('#selling_price').focusout(function() {
            if (parseFloat($('#mrp').val()) < parseFloat($(this).val())) {
                alertify.error('Selling price must be less or equal to MRP');
                $(this).val('');
                $(this).focus();
            }
        });
        $('#sku').focusout(function() {
            $sku = $(this).val();
            $.ajax({
                url: '<?= site_url() ?>seller/product/checkSkuExist',
                type: 'post',
                data: {'sku': $sku},
                success: function(data, textStatus, jqXHR) {
                    if (data > 0) {
                        $(this).val('');
                        alertify.error('This SKU Already Exist ..!!');
                    }
                }
            });
        });
        $('#main_category_id').change(function() {
            $main_category_id = $(this).val();
            if ($main_category_id != -1) {
                $.ajax({
                    url: "<?= site_url() ?>seller/product/getSubCategoryByMain",
                    type: "POST",
                    data: {'main_category_id': $main_category_id},
                    success: function(data, textStatus, jqXHR) {
                        $('#sub_category_id').html(data);
                    }
                });
            } else {
                $('#sub_category_id').html('<option value="-1">--Select--</option>');
            }
        });
        // Variation Bloack Display Setting
        $('#sub_category_id').change(function() {
            $subcatid = $(this).val();
            if ($subcatid == 1) {
                $(".fabric,.fabric_care,.bottom_fabric,.inner_fabric,.dupatta_fabric,.blouse_fabric,.colour,.type,.size,.sleeve,.style,.collection,.celebrity,.sstyle,.skstyle,.saree_border,.saree_length,.bottom_colour,.dupatta_colour,.bottom_size,.top_size,.dupatta_size,.stitching,.pattern").css('display', 'block');
                $(".fashion,.gender,.material,.metals_type,.gem_stone,.shape,.setting_type,.pattern,.width,.height,.length,.diameter").css('display', 'none');
            } else if ($subcatid == 2) {
                $(".fabric,.fabric_care,.bottom_fabric,.inner_fabric,.dupatta_fabric,.blouse_fabric,.colour,.type,.size,.sleeve,.style,.collection,.celebrity,.sstyle,.skstyle,.saree_border,.saree_length,.bottom_colour,.dupatta_colour,.bottom_size,.top_size,.dupatta_size,.stitching,.fashion,.gender,.material,.metals_type,.gem_stone,.shape,.setting_type,.width,.height,.length,.diameter,.company,.fit,.rise,.pattern").css('display', 'none');
                $(".fabric,.fabric_care,.bottom_fabric,.inner_fabric,.dupatta_fabric,.colour,.type,.size,.celebrity,.pattern,.stitching").css('display', 'block');
            } else if ($subcatid == 3) {
                $(".fabric,.fabric_care,.bottom_fabric,.inner_fabric,.dupatta_fabric,.blouse_fabric,.colour,.type,.size,.sleeve,.style,.collection,.celebrity,.sstyle,.skstyle,.saree_border,.saree_length,.bottom_colour,.dupatta_colour,.bottom_size,.top_size,.dupatta_size,.stitching,.fashion,.gender,.material,.metals_type,.gem_stone,.shape,.setting_type,.width,.height,.length,.diameter,.company,.fit,.rise,.pattern").css('display', 'none');
                $(".fabric,.fabric_care,.bottom_fabric,.inner_fabric,.dupatta_fabric,.colour,.type,.size,.sleeve,.pattern,.stitching").css('display', 'block');
            } else if ($subcatid == 4) {
                $(".fabric,.fabric_care,.bottom_fabric,.inner_fabric,.dupatta_fabric,.blouse_fabric,.colour,.type,.size,.sleeve,.style,.collection,.celebrity,.sstyle,.skstyle,.saree_border,.saree_length,.bottom_colour,.dupatta_colour,.bottom_size,.top_size,.dupatta_size,.stitching,.fashion,.gender,.material,.metals_type,.gem_stone,.shape,.setting_type,.width,.height,.length,.diameter,.company,.fit,.rise,.pattern").css('display', 'none');
                $(".fabric,.fabric_care,.blouse_fabric,.colour,.type,.saree_border,.saree_length,.pattern").css('display', 'block');
            } else if ($subcatid == 5) {
                $(".fabric,.fabric_care,.bottom_fabric,.inner_fabric,.dupatta_fabric,.blouse_fabric,.colour,.type,.size,.sleeve,.style,.collection,.celebrity,.sstyle,.skstyle,.saree_border,.saree_length,.bottom_colour,.dupatta_colour,.bottom_size,.top_size,.dupatta_size,.stitching,.fashion,.gender,.material,.metals_type,.gem_stone,.shape,.setting_type,.width,.height,.length,.diameter,.company,.fit,.rise,.pattern").css('display', 'none');
                $(".fabric,.fabric_care,.bottom_fabric,.inner_fabric,.dupatta_fabric,.colour,.type,.size,.celebrity,.bottom_colour,.dupatta_colour,.bottom_size,.top_size,.dupatta_size,.stitching,.sleeve,.pattern").css('display', 'block');
            } else if ($subcatid == 6) {
                $(".fabric,.fabric_care,.bottom_fabric,.inner_fabric,.dupatta_fabric,.blouse_fabric,.colour,.type,.size,.sleeve,.style,.collection,.celebrity,.sstyle,.skstyle,.saree_border,.saree_length,.bottom_colour,.dupatta_colour,.bottom_size,.top_size,.dupatta_size,.stitching,.fashion,.gender,.material,.metals_type,.gem_stone,.shape,.setting_type,.width,.height,.length,.diameter,.company,.fit,.rise,.pattern").css('display', 'none');
                $(".fabric,.fabric_care,.blouse_fabric,.colour,.type,.pattern,.stitching").css('display', 'block');
            } else if ($subcatid == 7) {
                $(".fabric,.fabric_care,.bottom_fabric,.inner_fabric,.dupatta_fabric,.blouse_fabric,.colour,.type,.size,.sleeve,.style,.collection,.celebrity,.sstyle,.skstyle,.saree_border,.saree_length,.bottom_colour,.dupatta_colour,.bottom_size,.top_size,.dupatta_size,.stitching,.fashion,.gender,.material,.metals_type,.gem_stone,.shape,.setting_type,.width,.height,.length,.diameter,.company,.fit,.rise,.pattern").css('display', 'none');
                $(".fabric,.fabric_care,.colour,.type,.size,.sleeve,.pattern,.stitching").css('display', 'block');
            } else if ($subcatid == 8) {
                $(".fabric,.fabric_care,.bottom_fabric,.inner_fabric,.dupatta_fabric,.blouse_fabric,.colour,.type,.size,.sleeve,.style,.collection,.celebrity,.sstyle,.skstyle,.saree_border,.saree_length,.bottom_colour,.dupatta_colour,.bottom_size,.top_size,.dupatta_size,.stitching,.fashion,.gender,.material,.metals_type,.gem_stone,.shape,.setting_type,.width,.height,.length,.diameter,.company,.fit,.rise,.pattern").css('display', 'none');
                $(".fabric,.colour,.size,.pattern").css('display', 'block');
            } else if ($subcatid == 9) {
                $(".fabric,.fabric_care,.bottom_fabric,.inner_fabric,.dupatta_fabric,.blouse_fabric,.colour,.type,.size,.sleeve,.style,.collection,.celebrity,.sstyle,.skstyle,.saree_border,.saree_length,.bottom_colour,.dupatta_colour,.bottom_size,.top_size,.dupatta_size,.stitching,.fashion,.gender,.material,.metals_type,.gem_stone,.shape,.setting_type,.width,.height,.length,.diameter,.company,.fit,.rise,.pattern").css('display', 'none');
                $(".fabric,.colour,.type,.size,.sleeve,.pattern").css('display', 'block');
            } else if ($subcatid == 10) {
                $(".fabric,.fabric_care,.bottom_fabric,.inner_fabric,.dupatta_fabric,.blouse_fabric,.colour,.type,.size,.sleeve,.style,.collection,.celebrity,.sstyle,.skstyle,.saree_border,.saree_length,.bottom_colour,.dupatta_colour,.bottom_size,.top_size,.dupatta_size,.stitching,.fashion,.gender,.material,.metals_type,.gem_stone,.shape,.setting_type,.width,.height,.length,.diameter,.company,.fit,.rise,.pattern").css('display', 'none');
                $(".fabric,.colour,.pattern").css('display', 'block');
            } else if ($subcatid == 11) {
                $(".fabric,.fabric_care,.bottom_fabric,.inner_fabric,.dupatta_fabric,.blouse_fabric,.colour,.type,.size,.sleeve,.style,.collection,.celebrity,.sstyle,.skstyle,.saree_border,.saree_length,.bottom_colour,.dupatta_colour,.bottom_size,.top_size,.dupatta_size,.stitching,.fashion,.gender,.material,.metals_type,.gem_stone,.shape,.setting_type,.width,.height,.length,.diameter,.company,.fit,.rise,.pattern").css('display', 'none');
                $(".fabric,.colour,.size,.pattern,.stitching").css('display', 'block');
            } else if ($subcatid == 12) {
                $(".fabric,.fabric_care,.bottom_fabric,.inner_fabric,.dupatta_fabric,.blouse_fabric,.colour,.type,.size,.sleeve,.style,.collection,.celebrity,.sstyle,.skstyle,.saree_border,.saree_length,.bottom_colour,.dupatta_colour,.bottom_size,.top_size,.dupatta_size,.stitching,.fashion,.gender,.material,.metals_type,.gem_stone,.shape,.setting_type,.width,.height,.length,.diameter,.company,.fit,.rise,.pattern").css('display', 'none');
                $(".fabric,.size,.pattern,.stitching").css('display', 'block');
            } else if ($subcatid == 13) {
                $(".fabric,.fabric_care,.bottom_fabric,.inner_fabric,.dupatta_fabric,.blouse_fabric,.colour,.type,.size,.sleeve,.style,.collection,.celebrity,.sstyle,.skstyle,.saree_border,.saree_length,.bottom_colour,.dupatta_colour,.bottom_size,.top_size,.dupatta_size,.stitching,.fashion,.gender,.material,.metals_type,.gem_stone,.shape,.setting_type,.width,.height,.length,.diameter,.company,.fit,.rise,.pattern").css('display', 'none');
                $(".colour,.size,.pattern,.stitching").css('display', 'block');
            } else if ($subcatid >= 16 && $subcatid <= 58) {
                $(".fabric,.fabric_care,.bottom_fabric,.inner_fabric,.dupatta_fabric,.blouse_fabric,.colour,.type,.size,.sleeve,.style,.collection,.celebrity,.sstyle,.skstyle,.saree_border,.saree_length,.bottom_colour,.dupatta_colour,.bottom_size,.top_size,.dupatta_size,.stitching,.fashion,.gender,.material,.metals_type,.gem_stone,.shape,.setting_type,.pattern,.width,.height,.length,.diameter,.company,.fit,.rise,.pattern").css('display', 'none');
                $(".fashion,.gender,.colour,.material,.metals_type,.style,.gem_stone,.shape,.setting_type,.width,.height,.length,.diameter").css('display', 'block');
            }else if ($subcatid == 59) {
                $(".fabric,.fabric_care,.bottom_fabric,.inner_fabric,.dupatta_fabric,.blouse_fabric,.colour,.type,.size,.sleeve,.style,.collection,.celebrity,.sstyle,.skstyle,.saree_border,.saree_length,.bottom_colour,.dupatta_colour,.bottom_size,.top_size,.dupatta_size,.stitching,.fashion,.gender,.material,.metals_type,.gem_stone,.shape,.setting_type,.width,.height,.length,.diameter,.company,.fit,.rise,.pattern").css('display', 'none');
                $(".fabric,.fabric_care,.colour,.fit,.shape,.pattern,.size,.length,.rise,.company").css('display', 'block');
            }
        });
        // CODE FOR FILE DATA + FORM DATA SEND USING AJAX

        $("input:file").change(function() {
            var file = this.files[0];
            var reader = new FileReader();
            //reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
        });
        $('#productform').on('submit', function() {
            $('#productloader').css('display', 'block');
            $.ajax({
                url: "<?= site_url() ?>seller/product/addProductData", // Url to which the request is send
                type: "POST", // Type of request to be send, called as method
                data: new FormData(this), // Data sent to server, a set of key/value pairs representing form fields and values 
                contentType: false, // The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
                cache: false, // To unable request pages to be cached
                processData: false, // To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
                success: function(data)  		// A function to be called if request succeeds
                {
                    if (data == "add_success") {
                        alertify.success("Product Add Successfully ...!!");
                        setTimeout(function() {
                            location.reload(true);
                        }, 500);
                    } else if (data == "update_success") {
                        alertify.success("Product Update Successfully ...!!");
                        setTimeout(function() {
                            window.location.href = "<?= site_url() ?>seller/rejected";
                        }, 500);
                    }
                }
            });
            return false;
        });
        // CODE FOR FILE DATA + FORM DATA SEND USING AJAX END

        // SETTLEMENT VALUE CALCULATION 

        $commission_fee = "<?= isset($commission->commission_fee) ? $commission->commission_fee : '0' ?>";
        $fixed_fee = "<?= isset($commission->fixed_fee) ? $commission->fixed_fee : '0' ?>";
        $service_fee = "<?= isset($commission->service_fee) ? $commission->service_fee : '0' ?>";
        $listing_fee = "<?= isset($commission->listing_fee) ? $commission->listing_fee : '0' ?>";
        $marketing_fee = "<?= isset($commission->marketing_fee) ? $commission->marketing_fee : '0' ?>";
        $pay_fee = "<?= isset($commission->pay_fee) ? $commission->pay_fee : '0' ?>";
        $other_fee = "<?= isset($commission->other_fee) ? $commission->other_fee : '0' ?>";
        $('.tcommissionrate').text($commission_fee);
        $('.tservicerate').text($service_fee);
        $('.tmarketingrate').text($marketing_fee);
        $('.tpayrate').text($pay_fee);
        $('.tfixed').text($fixed_fee);
        $('.tlisting').text($listing_fee);
        $('.tother').text($other_fee);
        $('#selling_price').on('input', function(e) {
            $sales_price = $(this).val();
            if ($sales_price != "") {
                $commission_charge = $sales_price * $commission_fee / 100;
                //$service_charge = ($commission_charge + +$fixed_fee + +$listing_fee + +$other_fee) * $service_fee / 100;
                $service_charge = $commission_charge * $service_fee / 100;
                $marketing_charge = $sales_price * $marketing_fee / 100;
                $pay_charge = $sales_price * $pay_fee / 100;
                $('.tcommission').text(Math.round($commission_charge));
                $('.tservice').text(Math.round($service_charge));
                $('.tmarketing').text(Math.round($marketing_charge));
                $('.tpay').text(Math.round($pay_charge));
                $settlement_value = Math.round($sales_price - (+$commission_charge + +$service_charge + +$marketing_charge + +$pay_charge + +$fixed_fee + +$listing_fee + +$other_fee));
                $('.settlementvalue').text($settlement_value);
                $('#web_price').val($sales_price);
            } else {
                clear();
            }
        });
        if ($('#selling_price') != "") {
            $('#selling_price').trigger('input');
        }

        // SETTLEMENT VALUE CALCULATION END

        // SETTLEMENT VALUE CALCULATOR POPUP  

        $('#model_selling_price').on('input', function(e) {
            $sales_price = $(this).val();
            if ($sales_price != "") {
                $commission_charge = $sales_price * $commission_fee / 100;
                //$service_charge = ($commission_charge + +$fixed_fee + +$listing_fee + +$other_fee) * $service_fee / 100;
                $service_charge = $commission_charge * $service_fee / 100;
                $marketing_charge = $sales_price * $marketing_fee / 100;
                $pay_charge = $sales_price * $pay_fee / 100;
                $('.tcommission_sales').text(Math.round($commission_charge));
                $('.tservice_sales').text(Math.round($service_charge));
                $('.tmarketing_sales').text(Math.round($marketing_charge));
                $('.tpay_sales').text(Math.round($pay_charge));
                $settlement_value = Math.round($sales_price - (+$commission_charge + +$service_charge + +$marketing_charge + +$pay_charge + +$fixed_fee + +$listing_fee + +$other_fee));
                $('.settlementvalue_sales').text($settlement_value);
            } else {
                clearSalesModel();
            }
        });
        $('#model_settlement_price').on('input', function(e) {
            $settlement_price = $(this).val();
            if ($settlement_price != "") {
                $commission_charge = $settlement_price * $commission_fee / 100;
                //$service_charge = ($commission_charge + +$fixed_fee + +$listing_fee + +$other_fee) * $service_fee / 100;
                $service_charge = $commission_charge * $service_fee / 100;
                $marketing_charge = $settlement_price * $marketing_fee / 100;
                $pay_charge = $settlement_price * $pay_fee / 100;
                $('.tcommission_settlement').text(Math.round($commission_charge));
                $('.tservice_settlement').text(Math.round($service_charge));
                $('.tmarketing_settlement').text(Math.round($marketing_charge));
                $('.tpay_settlement').text(Math.round($pay_charge));
                $sales_value = Math.round(+$settlement_price + (+$commission_charge + +$service_charge + +$marketing_charge + +$pay_charge + +$fixed_fee + +$listing_fee + +$other_fee));
                $('.sallingprice').text($sales_value);
            } else {
                clearSettlementsModel();
            }
        });
        $('.calculator').click(function() {
            $('#model_selling_price').val($('#selling_price').val());
            $('#model_selling_price').trigger('input');
        });
        function clear() {
            $('.tcommission').text('0');
            $('.tservice').text('0');
            $('.tmarketing').text('0');
            $('.tpay').text('0');
            $('.settlementvalue').text('0');
        }

        function clearSalesModel() {
            $('.tcommission_sales').text('0');
            $('.tservice_sales').text('0');
            $('.tmarketing_sales').text('0');
            $('.tpay_sales').text('0');
            $('.settlementvalue_sales').text('0');
        }

        function clearSettlementsModel() {
            $('.tcommission_settlement').text('0');
            $('.tservice_settlement').text('0');
            $('.tmarketing_settlement').text('0');
            $('.tpay_settlement').text('0');
            $('.sallingprice').text('0');
        }

        // SETTLEMENT VALUE CALCULATOR POPUP END
    });


</script>