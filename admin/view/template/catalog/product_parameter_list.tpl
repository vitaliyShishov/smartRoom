<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-product').submit() : false;"><i class="fa fa-trash-o"></i></button>
            </div>
            <h1><?php echo $heading_title; ?></h1>
            <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
    <?php if ($error_warning) { ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php } ?>
    <?php if ($success) { ?>
        <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
            </div>
            <div class="panel-body">
                <div class="well">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="input-name"><?php echo $entry_name; ?></label>
                                <input type="text" name="filter_name" value="<?php echo $filter_name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="input-category"><?php echo $entry_category; ?></label>
                                <input type="text" name="filter_category" value="<?php echo $filter_category; ?>" placeholder="<?php echo $entry_category; ?>" id="input-category" class="form-control" />
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="control-label" style='opacity: 0; display: block' for="button-filter">Filter</label>
                            <button type="button" id="button-filter" class="btn btn-primary"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
                        </div>
                    </div>
                </div>
                <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-option">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td class="text-left"><?php if ($sort == 'paramName') { ?>
                                        <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
                    <?php } else { ?>
                                        <a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
                    <?php } ?></td>
                                    <td class="text-left"><?php if ($sort == 'categoryName') { ?>
                                        <a href="<?php echo $sort_category; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_category; ?></a>
                    <?php } else { ?>
                                        <a href="<?php echo $sort_category; ?>"><?php echo $column_category; ?></a>
                    <?php } ?></td>
                                    <td class="text-right"><?php if ($sort == 'p.sort_order') { ?>
                                        <a href="<?php echo $sort_sort_order; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_sort_order; ?></a>
                    <?php } else { ?>
                                        <a href="<?php echo $sort_sort_order; ?>"><?php echo $column_sort_order; ?></a>
                    <?php } ?></td>
                                    <td class="text-right"><?php echo $column_action; ?></td>
                                </tr>
                            </thead>
                            <tbody>
                <?php if ($parameters) { ?>
                <?php foreach ($parameters as $parameter) { ?>
                                <tr>
                                    <td class="text-left"><?php echo $parameter['parameter_name']; ?></td>
                                    <td class="text-left"><?php echo $parameter['category_name']; ?></td>
                                    <td class="text-right"><?php echo $parameter['sort_order']; ?></td>
                                    <td class="text-right"><a href="<?php echo $parameter['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                                </tr>
                <?php } ?>
                <?php } else { ?>
                                <tr>
                                    <td class="text-center" colspan="5"><?php echo $text_no_results; ?></td>
                                </tr>
                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </form>
                <div class="row">
                    <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
                    <div class="col-sm-6 text-right"><?php echo $results; ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>

<script type="text/javascript"><!--
$('#button-filter').on('click', function () {
        var url = 'index.php?route=catalog/product_parameter&token=<?php echo $token; ?>';

        var filter_name = $('input[name=\'filter_name\']').val();

        if (filter_name) {
            url += '&filter_name=' + encodeURIComponent(filter_name);
        }

        var filter_category = $('input[name=\'filter_category\']').val();

        if (filter_category) {
            url += '&filter_category=' + encodeURIComponent(filter_category);
        }

        location = url;
    });
    $('input[name=\'filter_category\']').autocomplete({
        'source': function (request, response) {
            $.ajax({
                url: 'index.php?route=catalog/category/autocomplete&token=<?php echo $token; ?>&filter_name=' + encodeURIComponent(request),
                dataType: 'json',
                success: function (json) {
                    response($.map(json, function (item) {
                        return {
                            label: item['name'],
                            value: item['category_id']
                        }
                    }));
                }
            });
        },
        'select': function (item) {
            $('input[name=\'filter_category\']').val(item['label']);
        }
    });
//--></script>