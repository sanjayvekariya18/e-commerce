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
        <h2>Order Status Management</h2>
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
                <div class="panel-body">
                    <div class="tabs">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#toapproved" data-toggle="tab">Approved</a>
                            </li>
                            <li>
                                <a href="#topickup" data-toggle="tab">Pickup</a>
                            </li>
                            <li>
                                <a href="#toshipped" data-toggle="tab">Ready To Ship</a>
                            </li>
                            <li>
                                <a href="#totransite" data-toggle="tab">Transite</a>
                            </li>
                            <li>
                                <a href="#todeliverd" data-toggle="tab">Delivered</a>
                            </li>  
                            <li>
                                <a href="#toshipcancel" data-toggle="tab">Shipped Return</a>
                            </li>  
                            <li>
                                <a href="#tocancel" data-toggle="tab">Canceled</a>
                            </li>
                            <li>
                                <a href="#toreturn" data-toggle="tab">Returned</a>
                            </li>
                            <li>
                                <a href="#toreplace" data-toggle="tab">Replace</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <a style="display:none" class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn-danger updateconformation" href="#conformation"></a>
                            <div id="toapproved" class="tab-pane active">
                                <section class="panel">
                                    <header class="panel-heading">                                        
                                        <h2 class="panel-title">Approved Order Details</h2>
                                    </header>
                                    <div class="panel-body">
                                        <button id="btnExport1" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px">Export</button>
                                        <table class="table table-bordered table-striped mb-none" id="datatable-default1" style="text-align: center">
                                            <thead>
                                                <tr>
                                                    <th>Order Date</th>
                                                    <th>Order Id</th>
                                                    <th>Status</th>
                                                    <th>Update Status</th>
                                                    <th>Live Status</th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                                <?php
                                                if (isset($approved)) {
                                                    foreach ($approved as $val) {
                                                        ?>
                                                        <tr>                                                            
                                                            <td><?= date('d-m-Y H:i:s', strtotime($val->order_date)) ?></td>
                                                            <td><?= $val->order_id ?></td>
                                                            <td><span class="label label-info">Approved</span></td>
                                                            <td>
                                                                <select name="status" class="form-control status">
                                                                    <option value="-1">--Select--</option>
                                                                    <option value="<?= $val->order_id ?>|0">In Transite</option>
                                                                    <option value="<?= $val->order_id ?>|4">Delivered</option>
                                                                    <option value="<?= $val->order_id ?>|8">Shipped Return</option>

                                                                </select>
                                                            </td>
                                                            <td><span class="label label-success"><?= $this->common->getOrderCurrentStatus($val->order_id) ?></span></td>
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
                            <div id="topickup" class="tab-pane">
                                <section class="panel">
                                    <header class="panel-heading">                                        
                                        <h2 class="panel-title">Pickup Order Details</h2>
                                    </header>
                                    <div class="panel-body">
                                        <button id="btnExport2" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px">Export</button>
                                        <table class="table table-bordered table-striped mb-none" id="datatable-default2" style="text-align: center">
                                            <thead>
                                                <tr>
                                                    <th>Order Date</th>
                                                    <th>Order Id</th>
                                                    <th>Status</th>
                                                    <th>Update Status</th>
                                                    <th>Live Status</th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                                <?php
                                                if (isset($pickup)) {
                                                    foreach ($pickup as $val) {
                                                        ?>
                                                        <tr>                                                            
                                                            <td><?= date('d-m-Y H:i:s', strtotime($val->order_date)) ?></td>
                                                            <td><?= $val->order_id ?></td>
                                                            <td><span class="label label-info">Ready To Ship</span></td>
                                                            <td>
                                                                <select name="status" class="form-control status">
                                                                    <option value="-1">--Select--</option>
                                                                    <option value="<?= $val->order_id ?>|0">In Transite</option>
                                                                    <option value="<?= $val->order_id ?>|4">Delivered</option>
                                                                    <option value="<?= $val->order_id ?>|8">Shipped Return</option>

                                                                </select>
                                                            </td>
                                                            <td><span class="label label-success"><?= $this->common->getOrderCurrentStatus($val->order_id) ?></span></td>
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
                            <div id="toshipped" class="tab-pane">
                                <section class="panel">
                                    <header class="panel-heading">                                        
                                        <h2 class="panel-title">Ready To Shipped Order Details</h2>
                                    </header>
                                    <div class="panel-body">
                                        <button id="btnExport3" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px">Export</button>
                                        <table class="table table-bordered table-striped mb-none" id="datatable-default3" style="text-align: center">
                                            <thead>
                                                <tr>
                                                    <th>Order Date</th>
                                                    <th>Order Id</th>
                                                    <th>Tracking Id</th>
                                                    <th>Status</th>
                                                    <th>Packing By</th>
                                                    <th>Update Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                                <?php
                                                if (isset($shipped)) {
                                                    foreach ($shipped as $val) {
                                                        ?>
                                                        <tr>                                                            
                                                            <td><?= date('d-m-Y H:i:s', strtotime($val->order_date)) ?></td>
                                                            <td><?= $val->order_id ?></td>
                                                            <td><?= $val->awb_no ?></td>
                                                            <td><span class="label label-info">Ready To Ship</span></td>
                                                            <td><?php
                                                                if ($val->packing_by == 1) {
                                                                    echo 'Fedex';
                                                                } else if ($val->packing_by == 2) {
                                                                    echo 'India Post';
                                                                } else if ($val->packing_by == 3) {
                                                                    echo 'DTDC';
                                                                } else {
                                                                    echo "-";
                                                                }
                                                                ?></td>
                                                            <td>
                                                                <select name="status" class="form-control status">
                                                                    <option value="-1">--Select--</option>
                                                                    <option value="<?= $val->order_id ?>|0">In Transite</option>
                                                                    <option value="<?= $val->order_id ?>|4">Delivered</option>
                                                                    <option value="<?= $val->order_id ?>|8">Shipped Return</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                if ($val->packing_by == '1') {
                                                                    ?>
                                                                    <a target="_blank" href="https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber=<?= $val->awb_no ?>&cntry_code=in"><span class="label label-primary">View</span></a>
                                                                    <?php
                                                                } else if ($val->packing_by == '2') {
                                                                    ?>
                                                                    <a target="_blank" href="http://www.indiapost.gov.in/parcelnettracking.aspx"><span class="label label-primary">View</span></a>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </td>
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
                            <div id="totransite" class="tab-pane">
                                <section class="panel">
                                    <header class="panel-heading">                                        
                                        <h2 class="panel-title">Ready To Shipped Order Details</h2>
                                    </header>
                                    <div class="panel-body">
                                        <button id="btnExport9" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px">Export</button>
                                        <table class="table table-bordered table-striped mb-none" id="datatable-default9" style="text-align: center">
                                            <thead>
                                                <tr>
                                                    <th>Order Date</th>
                                                    <th>Order Id</th>
                                                    <th>Tracking Id</th>
                                                    <th>Status</th>
                                                    <th>Packing By</th>
                                                    <th>Update Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                                <?php
                                                if (isset($transite)) {
                                                    foreach ($transite as $val) {
                                                        ?>
                                                        <tr>                                                            
                                                            <td><?= date('d-m-Y H:i:s', strtotime($val->order_date)) ?></td>
                                                            <td><?= $val->order_id ?></td>
                                                            <td><?= $val->awb_no ?></td>
                                                            <td><span class="label label-info">Ready To Ship</span></td>
                                                            <td><?php
                                                                if ($val->packing_by == 1) {
                                                                    echo 'Fedex';
                                                                } else if ($val->packing_by == 2) {
                                                                    echo 'India Post';
                                                                } else if ($val->packing_by == 3) {
                                                                    echo 'DTDC';
                                                                } else {
                                                                    echo "-";
                                                                }
                                                                ?></td>
                                                            <td>
                                                                <select name="status" class="form-control status">
                                                                    <option value="-1">--Select--</option>
                                                                    <option value="<?= $val->order_id ?>|4">Delivered</option>
                                                                    <option value="<?= $val->order_id ?>|8">Shipped Return</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                if ($val->packing_by == '1') {
                                                                    ?>
                                                                    <a target="_blank" href="https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber=<?= $val->awb_no ?>&cntry_code=in"><span class="label label-primary">View</span></a>
                                                                    <?php
                                                                } else if ($val->packing_by == '2') {
                                                                    ?>
                                                                    <a target="_blank" href="http://www.indiapost.gov.in/parcelnettracking.aspx"><span class="label label-primary">View</span></a>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </td>
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
                            <div id="todeliverd" class="tab-pane">
                                <section class="panel">
                                    <header class="panel-heading">                                        
                                        <h2 class="panel-title">Delivered Order Details</h2>
                                    </header>
                                    <div class="panel-body">
                                        <button id="btnExport4" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px">Export</button>
                                        <table class="table table-bordered table-striped mb-none" id="datatable-default4" style="text-align: center">
                                            <thead>
                                                <tr>
                                                    <th>Order Date</th>
                                                    <th>Order Id</th>
                                                    <th>Tracking Id</th>
                                                    <th>Status</th>
                                                    <th>Packing By</th>
                                                    <th>Update Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                                <?php
                                                if (isset($delivered)) {
                                                    foreach ($delivered as $val) {
                                                        ?>
                                                        <tr>                                                            
                                                            <td><?= date('d-m-Y H:i:s', strtotime($val->order_date)) ?></td>
                                                            <td><?= $val->order_id ?></td>
                                                            <td><?= $val->awb_no ?></td>
                                                            <td><span class="label label-success">Delivery</span></td>
                                                            <td><?php
                                                                if ($val->packing_by == 1) {
                                                                    echo 'Fedex';
                                                                } else if ($val->packing_by == 2) {
                                                                    echo 'India Post';
                                                                } else if ($val->packing_by == 3) {
                                                                    echo 'DTDC';
                                                                } else {
                                                                    echo "-";
                                                                }
                                                                ?></td>
                                                            <td>
                                                                <select id="status" name="status" class="form-control status">
                                                                    <option value="-1">--Select--</option>                                                                   
                                                                    <option value="<?= $val->order_id ?>|8">Shipped Return</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                if ($val->packing_by == '1') {
                                                                    ?>
                                                                    <a target="_blank" href="https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber=<?= $val->awb_no ?>&cntry_code=in"><span class="label label-primary">View</span></a>
                                                                    <?php
                                                                } else if ($val->packing_by == '2') {
                                                                    ?>
                                                                    <a target="_blank" href="http://www.indiapost.gov.in/parcelnettracking.aspx"><span class="label label-primary">View</span></a>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </td>
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
                            <div id="toshipcancel" class="tab-pane">
                                <section class="panel">
                                    <header class="panel-heading">                                        
                                        <h2 class="panel-title">Ship Cancel Order Details</h2>
                                    </header>
                                    <div class="panel-body">
                                        <button id="btnExport5" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px">Export</button>
                                        <table class="table table-bordered table-striped mb-none" id="datatable-default5" style="text-align: center">
                                            <thead>
                                                <tr>
                                                    <th>Order Date</th>
                                                    <th>Order Id</th>
                                                    <th>Tracking Id</th>
                                                    <th>Status</th>
                                                    <th>Packing By</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                                <?php
                                                if (isset($shipcancel)) {
                                                    foreach ($shipcancel as $val) {
                                                        ?>
                                                        <tr>                                                            
                                                            <td><?= date('d-m-Y H:i:s', strtotime($val->order_date)) ?></td>
                                                            <td><?= $val->order_id ?></td>
                                                            <td><?= $val->awb_no ?></td>
                                                            <td><span class="label label-danger">Shipped Cancel</span></td>
                                                            <td><?php
                                                                if ($val->packing_by == 1) {
                                                                    echo 'Fedex';
                                                                } else if ($val->packing_by == 2) {
                                                                    echo 'India Post';
                                                                } else if ($val->packing_by == 3) {
                                                                    echo 'DTDC';
                                                                } else {
                                                                    echo "-";
                                                                }
                                                                ?></td>
                                                            <td>
                                                                <?php
                                                                if ($val->packing_by == '1') {
                                                                    ?>
                                                                    <a target="_blank" href="https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber=<?= $val->awb_no ?>&cntry_code=in"><span class="label label-primary">View</span></a>
                                                                    <?php
                                                                } else if ($val->packing_by == '2') {
                                                                    ?>
                                                                    <a target="_blank" href="http://www.indiapost.gov.in/parcelnettracking.aspx"><span class="label label-primary">View</span></a>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </td>
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
                            <div id="tocancel" class="tab-pane">
                                <section class="panel">
                                    <header class="panel-heading">                                        
                                        <h2 class="panel-title">Canceled Order Details</h2>
                                    </header>
                                    <div class="panel-body">
                                        <button id="btnExport6" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px">Export</button>
                                        <table class="table table-bordered table-striped mb-none" id="datatable-default6" style="text-align: center">
                                            <thead>
                                                <tr>
                                                    <th>Order Date</th>
                                                    <th>Order Id</th>
                                                    <th>Status</th>
                                                    <th>Packing By</th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                                <?php
                                                if (isset($cancel)) {
                                                    foreach ($cancel as $val) {
                                                        ?>
                                                        <tr>                                                            
                                                            <td><?= date('d-m-Y H:i:s', strtotime($val->order_date)) ?></td>
                                                            <td><?= $val->order_id ?></td>
                                                            <td><span class="label label-info">Canceled</span></td>
                                                            <td><?php
                                                                if ($val->packing_by == 1) {
                                                                    echo 'Fedex';
                                                                } else if ($val->packing_by == 2) {
                                                                    echo 'India Post';
                                                                } else if ($val->packing_by == 3) {
                                                                    echo 'DTDC';
                                                                } else {
                                                                    echo "-";
                                                                }
                                                                ?></td>
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
                            <div id="toreturn" class="tab-pane">
                                <section class="panel">
                                    <header class="panel-heading">                                        
                                        <h2 class="panel-title">Return Order Details</h2>
                                    </header>
                                    <div class="panel-body">
                                        <button id="btnExport7" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px">Export</button>
                                        <table class="table table-bordered table-striped mb-none" id="datatable-default7" style="text-align: center">
                                            <thead>
                                                <tr>
                                                    <th>Order Date</th>
                                                    <th>Order Id</th>
                                                    <th>Status</th>
                                                    <th>Packing By</th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                                <?php
                                                if (isset($return)) {
                                                    foreach ($return as $val) {
                                                        ?>
                                                        <tr>                                                            
                                                            <td><?= date('d-m-Y H:i:s', strtotime($val->order_date)) ?></td>
                                                            <td><?= $val->order_id ?></td>
                                                            <td><span class="label label-info">Canceled</span></td>
                                                            <td><?php
                                                                if ($val->packing_by == 1) {
                                                                    echo 'Fedex';
                                                                } else if ($val->packing_by == 2) {
                                                                    echo 'India Post';
                                                                } else if ($val->packing_by == 3) {
                                                                    echo 'DTDC';
                                                                } else {
                                                                    echo "-";
                                                                }
                                                                ?></td>
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
                            <div id="toreplace" class="tab-pane">
                                <section class="panel">
                                    <header class="panel-heading">                                        
                                        <h2 class="panel-title">Replace Order Details</h2>
                                    </header>
                                    <div class="panel-body">
                                        <button id="btnExport8" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px">Export</button>
                                        <table class="table table-bordered table-striped mb-none" id="datatable-default8" style="text-align: center">
                                            <thead>
                                                <tr>
                                                    <th>Order Date</th>
                                                    <th>Order Id</th>
                                                    <th>Status</th>
                                                    <th>Packing By</th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                                <?php
                                                if (isset($replace)) {
                                                    foreach ($replace as $val) {
                                                        ?>
                                                        <tr>                                                            
                                                            <td><?= date('d-m-Y H:i:s', strtotime($val->order_date)) ?></td>
                                                            <td><?= $val->order_id ?></td>
                                                            <td><span class="label label-info">Canceled</span></td>
                                                            <td><?php
                                                                if ($val->packing_by == 1) {
                                                                    echo 'Fedex';
                                                                } else if ($val->packing_by == 2) {
                                                                    echo 'India Post';
                                                                } else if ($val->packing_by == 3) {
                                                                    echo 'DTDC';
                                                                } else {
                                                                    echo "-";
                                                                }
                                                                ?></td>
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
                    </div>                   
                </div>
            </section>
        </div>
    </div>   
    <!--Conformation Model Start-->
    <div id="conformation" class="zoom-anim-dialog modal-block modal-block-sm mfp-hide">
        <form id="conformationform" method="POST" class="form-horizontal" >
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Change Order Status</h2>
                </header>
                <div class="panel-body">  
                    <input type="hidden" id="conformationvalue" />
                    <h5>Are You Sure To Change This Order Status ? </h5>
                </div>                           
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button id="conformationconfirm" type="button" class="btn btn-primary modal-dismiss">Confirm</button>
                            <button id="conformationclose" class="btn btn-default modal-dismiss">Cancel</button>
                        </div>
                    </div>
                </footer>
            </section>
        </form>
    </div>
    <!--Conformation Model End--> 
</section>

<script type="text/javascript">
    $(document).ready(function () {

        $('#datatable-default1').dataTable({
            order: [],
            aLengthMenu: [[10, 15, 20, 25, -1], [10, 15, 20, 25, 'All']],
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0, 1, 2, 3, 4]
                }], iDisplayLength: -1
        });
        $('#datatable-default2').dataTable({
            order: [],
            aLengthMenu: [[10, 15, 20, 25, -1], [10, 15, 20, 25, 'All']],
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0, 1, 2, 3, 4]
                }], iDisplayLength: -1
        });
        $('#datatable-default3').dataTable({
            order: [],
            aLengthMenu: [[10, 15, 20, 25, -1], [10, 15, 20, 25, 'All']],
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0, 1, 2, 3, 4, 5, 6]
                }], iDisplayLength: -1
        });
        $('#datatable-default4').dataTable({
            order: [],
            aLengthMenu: [[10, 15, 20, 25, -1], [10, 15, 20, 25, 'All']],
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0, 1, 2, 3, 4, 5, 6]
                }], iDisplayLength: -1
        });
        $('#datatable-default5').dataTable({
            order: [],
            aLengthMenu: [[10, 15, 20, 25, -1], [10, 15, 20, 25, 'All']],
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0, 1, 2, 3, 4, 5]
                }], iDisplayLength: -1
        });
        $('#datatable-default6').dataTable({
            order: [],
            aLengthMenu: [[10, 15, 20, 25, -1], [10, 15, 20, 25, 'All']],
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0, 1, 2, 3]
                }], iDisplayLength: -1
        });
        $('#datatable-default7').dataTable({
            order: [],
            aLengthMenu: [[10, 15, 20, 25, -1], [10, 15, 20, 25, 'All']],
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0, 1, 2, 3]
                }], iDisplayLength: -1
        });
        $('#datatable-default8').dataTable({
            order: [],
            aLengthMenu: [[10, 15, 20, 25, -1], [10, 15, 20, 25, 'All']],
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0, 1, 2, 3]
                }], iDisplayLength: -1
        });
        $('#datatable-default9').dataTable({
            order: [],
            aLengthMenu: [[10, 15, 20, 25, -1], [10, 15, 20, 25, 'All']],
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0, 1, 2, 3, 4, 5, 6]
                }], iDisplayLength: -1
        });

        $("#btnExport1").click(function () {
            $("#datatable-default1").btechco_excelexport({
                containerid: "datatable-default1",
                datatype: $datatype.Table
            });
        });
        $("#btnExport2").click(function () {
            $("#datatable-default2").btechco_excelexport({
                containerid: "datatable-default2",
                datatype: $datatype.Table
            });
        });
        $("#btnExport3").click(function () {
            $("#datatable-default3").btechco_excelexport({
                containerid: "datatable-default3",
                datatype: $datatype.Table
            });
        });
        $("#btnExport4").click(function () {
            $("#datatable-default4").btechco_excelexport({
                containerid: "datatable-default4",
                datatype: $datatype.Table
            });
        });
        $("#btnExport5").click(function () {
            $("#datatable-default5").btechco_excelexport({
                containerid: "datatable-default5",
                datatype: $datatype.Table
            });
        });
        $("#btnExport6").click(function () {
            $("#datatable-default6").btechco_excelexport({
                containerid: "datatable-default6",
                datatype: $datatype.Table
            });
        });
        $("#btnExport7").click(function () {
            $("#datatable-default7").btechco_excelexport({
                containerid: "datatable-default7",
                datatype: $datatype.Table
            });
        });
        $("#btnExport8").click(function () {
            $("#datatable-default8").btechco_excelexport({
                containerid: "datatable-default8",
                datatype: $datatype.Table
            });
        });
        $("#btnExport9").click(function () {
            $("#datatable-default9").btechco_excelexport({
                containerid: "datatable-default9",
                datatype: $datatype.Table
            });
        });
        $('.status').on('change', function () {
            if ($(this).val() != '-1')
            {
                $('#conformationvalue').val($(this).val());
                $('.updateconformation').trigger('click');
            } else {
                $('#conformationvalue').val("");
                alertify.error("Please Select Valid Status");
            }
        });
        $('#conformationconfirm').click(function () {
            if ($('#conformationvalue').val() != "")
            {
                $id = $('#conformationvalue').val().split('|');
                $order_id = $id['0'];
                $status_id = $id['1'];
                $.ajax({
                    url: "<?= site_url() ?>admin/order_status/updateOrder",
                    type: 'POST',
                    data: {'order_id': $order_id, 'status': $status_id},
                    success: function (data, textStatus, jqXHR) {
                        alertify.success("Your Order Is Updated");
                        setTimeout(function () {
                            location.reload(true);
                        }, 500);
                    }
                });
            }
        });
    });
</script>
