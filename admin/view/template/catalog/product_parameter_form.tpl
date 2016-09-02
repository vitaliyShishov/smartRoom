<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-parameter" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
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
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-parameter" class="form-horizontal">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-data" data-toggle="tab"><?php echo $tab_data; ?></a></li>
                        <li><a href="#tab-values" data-toggle="tab"><?php echo $tab_values; ?></a></li>
                        <li><a href="#tab-filters" data-toggle="tab"><?php echo $tab_filters; ?></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-data">
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" name="parameter_name" value="<?php echo $parameter_name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
                                <?php if ($error_name) { ?>
                                    <div class="text-danger"><?php echo $error_name; ?></div>
                                <?php } ?>
                                <?php if ($error_same_name) { ?>
                                    <div class="text-danger"><?php echo $error_same_name; ?></div>
                                <?php } ?>    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" name="parameter_sort_order" value="<?php echo $parameter_sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-category"><?php echo $entry_category; ?></span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="category" value="" placeholder="<?php echo $entry_category; ?>" id="input-category" class="form-control" />
                                    <div id="parameter-category" class="well well-sm" style="height: 150px; overflow: auto;">
                                        <?php foreach ($parameter_categories as $key => $parameter_category) { ?>
                                        <div id="parameter-category<?php echo $parameter_category['category_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $parameter_category['name']; ?>
                                            <input type="hidden" name="parameter_category[<?php echo $key ?>][category_id]" value="<?php echo $parameter_category['category_id']; ?>" />
                                        </div>
                                        <input type="hidden" name="parameter_category[<?php echo $key ?>][old_category_id]" value="<?php echo $parameter_category['category_id']; ?>" />
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-in-category"><?php echo $entry_in_category; ?></label>
                                <div class="col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <?php if ($parameter_in_category) { ?>
                                            <input type="checkbox" name="parameter_in_category" value="1" checked="checked" id="input-in-category" />
                                            <?php } else { ?>
                                            <input type="checkbox" name="parameter_in_category" value="1" id="input-in-category" />
                                            <?php } ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-values">
                            <table id="parameter-value" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <td class="text-left"><?php echo $entry_value; ?></td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $parameter_value_row = 0; ?>
                                <?php foreach ($parameter_values as $parameter_value) { ?>
                                    <input type="hidden"
                                           name="parameter_value[<?php echo $parameter_value_row; ?>][old_value]"
                                           value="<?php echo $parameter_value; ?>" 
                                           class="form-control"/>
                                    <tr id="parameter-value-row<?php echo $parameter_value_row; ?>">
                                        <td class="text-right">
                                            <input type="text"
                                                   name="parameter_value[<?php echo $parameter_value_row; ?>][value]"
                                                   value="<?php echo $parameter_value; ?>" 
                                                   class="form-control"/>
                                        </td>
                                        <td class="text-left">
                                            <button type="button" 
                                                    onclick="$('#parameter-value-row<?php echo $parameter_value_row;?>').remove();" 
                                                    data-toggle="tooltip" 
                                                    title="<?php echo $button_remove; ?>" 
                                                    class="btn btn-danger">
                                                <i class="fa fa-minus-circle"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php $parameter_value_row++; ?>
                                <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="1"></td>
                                        <td class="text-left"><button type="button" onclick="addParameterValue();" data-toggle="tooltip" title="<?php echo $button_parameter_value_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="tab-pane" id="tab-filters">
                            <table id="parameter-filters" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <td class="text-left"><?php echo $entry_title; ?></td>
                                        <td class="text-left"><?php echo $entry_min_value; ?></td>
                                        <td class="text-left"><?php echo $entry_max_value; ?></td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $filter_row = 0; ?>
                                    <?php foreach ($parameter_filters as $filter) { ?>
                                        <tr id="filter-row-<?php echo $filter_row; ?>">
                                            <td class="text-right">
                                                <input type="text"
                                                       name="filters[<?php echo $filter_row; ?>][title]"
                                                       value="<?php echo $filter['title']; ?>"
                                                       class="form-control"/>
                                            </td>
                                            <td class="text-right">
                                                <input type="text"
                                                       name="filters[<?php echo $filter_row; ?>][min]"
                                                       value="<?php echo $filter['min_value']; ?>"
                                                       class="form-control"/>
                                            </td>
                                            <td class="text-right">
                                                <input type="text"
                                                       name="filters[<?php echo $filter_row; ?>][max]"
                                                       value="<?php echo $filter['max_value']; ?>"
                                                       class="form-control"/>
                                            </td>
                                            <td class="text-left">
                                                <button type="button"
                                                        onclick="$('#filter-row<?php echo $filter_row;?>').remove();"
                                                        data-toggle="tooltip"
                                                        title="<?php echo $button_remove; ?>"
                                                        class="btn btn-danger">
                                                    <i class="fa fa-minus-circle"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <?php $filter_row++; ?>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="3"></td>
                                    <td class="text-left">
                                        <button type="button"
                                                onclick="addFilterValue();"
                                                data-toggle="tooltip"
                                                title="<?php echo $button_filter_value_add; ?>"
                                                class="btn btn-primary">
                                            <i class="fa fa-plus-circle"></i>
                                        </button>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
// Category
    $('input[name=\'category\']').autocomplete({
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
            $('input[name=\'category\']').val('');

            $('#parameter-category' + item['value']).remove();

            $('#parameter-category').append('<div id="parameter-category' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="parameter_category[][category_id]" value="' + item['value'] + '" /></div>');
        }
    });

    $('#parameter-category').delegate('.fa-minus-circle', 'click', function () {
        $(this).parent().remove();
    });

    var parameter_value_row = <?php echo $parameter_value_row; ?>;

    function addParameterValue() {
        html = '<tr id="parameter-value-row' + parameter_value_row + '">';
        html += '  <td class="text-right"><input type="text" name="parameter_value[' + parameter_value_row + '][value] value="" placeholder="<?php echo $entry_value; ?>" class="form-control" />';
        html += '  <td class="text-left"><button type="button" onclick="$(\'#parameter-value-row' + parameter_value_row + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
        html += '</tr>';

        $('#parameter-value tbody').append(html);

        parameter_value_row++;
    }

</script>
<script type="text/javascript">
    var filterRow = <?php echo $filter_row; ?>

    function addFilterValue() {
        html = '<tr id="filter-row' + filterRow + '">';
        html += '  <td class="text-right"><input type="text" name="filters[' + filterRow + '][title] value="" placeholder="<?php echo $entry_title; ?>" class="form-control" />';
        html += '  <td class="text-right"><input type="text" name="filters[' + filterRow + '][min] value="" placeholder="<?php echo $entry_min_value; ?>" class="form-control" />';
        html += '  <td class="text-right"><input type="text" name="filters[' + filterRow + '][max] value="" placeholder="<?php echo $entry_max_value; ?>" class="form-control" />';
        html += '  <td class="text-left"><button type="button" onclick="$(\'#filter-row' + filterRow + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
        html += '</tr>';

        $('#parameter-filters tbody').append(html);

        filterRow++;
    }
</script>
<?php echo $footer; ?>