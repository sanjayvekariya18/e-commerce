<section role="main" class="content-body">
    <header class="page-header">
        <h2>Search Engine Optimization</h2>

        <div class="right-wrapper pull-right" style="padding-right: 10px;">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= site_url() ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>                
                <li><span>seo</span></li>
            </ol>           
        </div>
    </header>
    <!--body wrapper start-->
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    Search Engine Optimization
                </header>
                <div class="panel-body">
                    <table class="table table-bordered table-striped mb-none" id="datatable-default">
                        <thead>
                            <tr>
                                <th>Page</th>
                                <th>Title</th>
                                <th>Keyword</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($seo as $value) { ?>
                                <tr>
                                    <td><?= $value->page ?></td>
                                    <td><?= $value->title ?></td>
                                    <td><?= $value->keyword ?></td>
                                    <td><?= $value->description ?></td>
                                    <td>
                                        <a href="#modalForm" id="<?= $value->seo_id ?>" class="modal-with-form btn btn-primary btn-xs edit">Edit</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</section>
<!-- Modal Form -->
<div id="modalForm" class="modal-block modal-block-primary mfp-hide">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title"></h2>
        </header>
        <div class="panel-body">
            <form id="seoForm" class="form-horizontal mb-lg" novalidate="novalidate">
                <div class="form-group mt-lg">
                    <label class="col-sm-3 control-label">Title</label>
                    <div class="col-sm-9">
                        <input type="text" name="title" class="form-control" placeholder="Page Title" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Keywords</label>
                    <div class="col-sm-9">
                        <input type="text" name="keyword" class="form-control" placeholder="Keywords..." />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Description</label>
                    <div class="col-sm-9">
                        <textarea name="description" rows="5" class="form-control" placeholder="Description..." ></textarea>
                    </div>
                </div>
                <input type="hidden" name="seoid" value="" />
            </form>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="button" id="save" class="btn btn-primary modal-dismiss">Save</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
</div>
<script type="text/javascript">
    $(function () {
        $('#datatable-default').dataTable({
            order: [],
            aLengthMenu: [[10, 15, 20, 25, -1], [10, 15, 20, 25, 'All']],
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0, 1, 2, 3, 4]
                }],
            iDisplayLength: 10
        });
    });
</script>
<script>
    jQuery(document).ready(function () {
        editSeo();        
        $form = $('#seoForm');

        function editSeo() {
            $('a.edit').click(function () {
                var seoid = $(this).attr('id');
                $('input[name="seoid"]').val(seoid);
                $tr = $(this).parents('tr');
                $form.find('input[name="title"]').val($tr.children().eq(1).text());
                $form.find('input[name="keyword"]').val($tr.children().eq(2).text());
                $form.find('textarea[name="description"]').val($tr.children().eq(3).text());
            });
        }
        $('.dataTables_paginate').click(function () {
            editSeo();           
        });
        
        $('.dataTables_filter input').change(function(){
            editSeo();
        });
        
        $('#save').click(function () {
            $.ajax({
                type: 'POST',
                data: $('#seoForm').serialize(),
                url: "<?= site_url() ?>admin/seo/updateMetadata",
                success: function (data, textStatus, jqXHR) {
                    if (data == '1') {
                        alertify.success("Metadata Successfully Updated..!");
                        $tr.children().eq(1).text($form.find('input[name="title"]').val());
                        $tr.children().eq(2).text($form.find('input[name="keyword"]').val());
                        $tr.children().eq(3).text($form.find('textarea[name="description"]').val());
                    } else {
                        alertify.error("Metadata not Updated..!");
                    }
                }
            });
        });
    });
</script>