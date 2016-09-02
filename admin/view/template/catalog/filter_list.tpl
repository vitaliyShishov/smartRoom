<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <a href="<?php echo $generator; ?>" data-toggle="tooltip" title="<?php echo $button_generate; ?>" class="btn btn-primary btn-info"><?php echo $button_generate; ?></a>
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
                                <label class="control-label" for="input-url-alias">
                                    <?php echo $entry_url_alias; ?>
                                </label>
                                <input type="text" 
                                       name="filter_url_alias" 
                                       value="<?php echo $filter_url_alias ?>" 
                                       placeholder="<?php echo $entry_url_alias; ?>" 
                                       class="form-control" />
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="input-category">
                                    <?php echo $entry_category; ?>
                                </label>
                                <input type="text" 
                                       name="filter_category" 
                                       value="<?php echo $filter_category; ?>" 
                                       placeholder="<?php echo $entry_category; ?>" 
                                       class="form-control" />
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="input-product-kod">
                                    <?php echo $entry_param_value; ?>
                                </label>
                                <input type="text" 
                                       name="filter_param_value" 
                                       value="<?php echo $filter_param_value; ?>" 
                                       placeholder="<?php echo $entry_param_value; ?>" 
                                       class="form-control" />
                            </div>
                        </div>
                        <button type="button" id="button-filter" class="btn btn-primary pull-right">
                            <i class="fa fa-search"></i> <?php echo $button_filter; ?>
                        </button>
                    </div>
                </div>
                <form method="post" enctype="multipart/form-data" id="form-filter">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td style="width: 1px;" class="text-center">
                                        <input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" />
                                    </td>
                                    <td class="text-left">
                                        <?php echo $column_seo_url ?></a>
                                    </td>
                                    <td class="text-left">
                                        <?php echo $column_category ?></a>
                                    </td>
                                    <td class="text-left">
                                        <?php echo $column_param_values ?></a>
                                    </td>
                                    <td class="text-right">
                                        <?php echo $column_action ?>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($filters) { ?>
                                    <?php foreach ($filters as $filter) { ?>
                                        <tr>
                                            <td class="text-center">
                                                <?php if (in_array($filter['filter_id'], $selected)) { ?>
                                                    <input type="checkbox" 
                                                           name="selected[]" 
                                                           value="<?php echo $filter['filter_id']; ?>" 
                                                           checked="checked" />
                                                <?php } else { ?>
                                                    <input type="checkbox" 
                                                           name="selected[]" 
                                                           value="<?php echo $filter['filter_id']; ?>" />
                                                <?php } ?>
                                            </td>
                                            <td class="text-left"><?php echo $filter['url_alias']; ?></td>
                                            <td class="text-left"><?php echo $filter['category']; ?></td>
                                            <td class="text-left">
                                                <?php foreach ($filter['param_values'] as $param_value) { ?>
                                                    <div>
                                                        <?php echo $param_value['param_name'] ?> <?php echo $param_value['param_value_name'] ?> 
                                                    </div>
                                                <?php } ?>
                                            </td>
                                            <td class="text-right">
                                                <a href="<?php echo $filter['edit']; ?>" 
                                                   data-toggle="tooltip" 
                                                   title="<?php echo $button_edit; ?>" 
                                                   class="btn btn-primary">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td class="text-center" colspan="5">
                                            <?php echo $text_no_results; ?>
                                        </td>
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
<script type="text/javascript">
    $('#button-filter').on('click', function() {
        var url = 'index.php?route=catalog/filter&token=<?php echo $token; ?>';

        var filter_url_alias = $('input[name=\'filter_url_alias\']').val();

        if (filter_url_alias) {
            url += '&filter_url_alias=' + encodeURIComponent(filter_url_alias);
        }

        var filter_category = $('input[name=\'filter_category\']').val();

        if (filter_category) {
            url += '&filter_category=' + encodeURIComponent(filter_category);
        }

        var filter_param_value = $('input[name=\'filter_param_value\']').val();

        if (filter_param_value) {
            url += '&filter_param_value=' + encodeURIComponent(filter_param_value);
        }
        location = url;
    });
</script>
<?php echo $footer; ?>