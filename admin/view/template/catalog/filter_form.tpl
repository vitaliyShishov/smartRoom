<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" 
                        form="form_filter" 
                        data-toggle="tooltip" 
                        title="<?php echo $button_save; ?>" 
                        class="btn btn-primary">
                    <i class="fa fa-save"></i>
                </button>
                <a href="<?php echo $cancel; ?>" 
                   data-toggle="tooltip" 
                   title="<?php echo $button_cancel; ?>" 
                   class="btn btn-default">
                    <i class="fa fa-reply"></i>
                </a>
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
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form_filter" class="form-horizontal">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
                        <li><a href="#tab_data" data-toggle="tab"><?php echo $tab_data; ?></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active in" id="tab_general">
                            <ul class="nav nav-tabs" id="language">
                                <?php foreach ($languages as $language) { ?>
                                    <li>
                                        <a href="#language<?php echo $language['language_id']; ?>" 
                                           data-toggle="tab" 
                                           aria-expanded="true">
                                            <img src="view/image/flags/<?php echo $language['image']; ?>" 
                                                 title="<?php echo $language['name']; ?>" />
                                                 <?php echo $language['name']; ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                            <div class="tab-content" aria-expanded="true">
                                <?php foreach ($languages as $language) { ?>
                                    <div class="tab-pane active" id="language<?php echo $language['language_id']; ?>">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="input_name<?php echo $language['language_id']; ?>">
                                                    <?php echo $entry_name; ?>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" 
                                                       name="filter_description[<?php echo $language['language_id']; ?>][name]" 
                                                       value="<?php echo isset($filter_description[$language['language_id']]) ? $filter_description[$language['language_id']]['name'] : ''; ?>" 
                                                       placeholder="<?php echo $entry_name; ?>" 
                                                       id="input_name<?php echo $language['language_id']; ?>" 
                                                       class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="input_h1<?php echo $language['language_id']; ?>">
                                                    <?php echo $entry_h1; ?>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" 
                                                       name="filter_description[<?php echo $language['language_id']; ?>][h1]" 
                                                       value="<?php echo isset($filter_description[$language['language_id']]) ? $filter_description[$language['language_id']]['h1'] : ''; ?>" 
                                                       placeholder="<?php echo $entry_h1; ?>" 
                                                       id="input_h1<?php echo $language['language_id']; ?>" 
                                                       class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" 
                                                   for="input_description<?php echo $language['language_id']; ?>">
                                                       <?php echo $entry_description; ?>
                                            </label>
                                            <div class="col-sm-10">
                                                <textarea name="filter_description[<?php echo $language['language_id']; ?>][description]" 
                                                          placeholder="<?php echo $entry_description; ?>" 
                                                          id="input_description<?php echo $language['language_id']; ?>" 
                                                          class="form-control"><?php echo isset($filter_description[$language['language_id']]) ? $filter_description[$language['language_id']]['description'] : ''; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" 
                                                   for="input_meta_title<?php echo $language['language_id']; ?>">
                                                       <?php echo $entry_meta_title; ?>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" 
                                                       name="filter_description[<?php echo $language['language_id']; ?>][meta_title]" 
                                                       value="<?php echo isset($filter_description[$language['language_id']]) ? $filter_description[$language['language_id']]['meta_title'] : ''; ?>" 
                                                       placeholder="<?php echo $entry_meta_title; ?>" 
                                                       id="input_meta_title<?php echo $language['language_id']; ?>" 
                                                       class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" 
                                                   for="input_meta_description<?php echo $language['language_id']; ?>">
                                                       <?php echo $entry_meta_description; ?>
                                            </label>
                                            <div class="col-sm-10">
                                                <textarea name="filter_description[<?php echo $language['language_id']; ?>][meta_description]" 
                                                          rows="5" 
                                                          placeholder="<?php echo $entry_meta_description; ?>" 
                                                          id="input_meta_description<?php echo $language['language_id']; ?>" 
                                                          class="form-control"><?php echo isset($filter_description[$language['language_id']]) ? $filter_description[$language['language_id']]['meta_description'] : ''; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" 
                                                   for="input_meta_keyword<?php echo $language['language_id']; ?>">
                                                       <?php echo $entry_meta_keyword; ?>
                                            </label>
                                            <div class="col-sm-10">
                                                <textarea 
                                                    name="filter_description[<?php echo $language['language_id']; ?>][meta_keyword]" 
                                                    rows="5" 
                                                    placeholder="<?php echo $entry_meta_keyword; ?>" 
                                                    id="input_meta_keyword<?php echo $language['language_id']; ?>" 
                                                    class="form-control"><?php echo isset($filter_description[$language['language_id']]) ? $filter_description[$language['language_id']]['meta_keyword'] : ''; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab_data">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input_keyword">
                                    <?php echo $entry_keyword; ?>
                                </label>
                                <div class="col-sm-10">
                                    <input disabled="disabled" 
                                           type="text" 
                                           name="keyword" 
                                           value="<?php echo $keyword; ?>" 
                                           class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">
                                    <?php echo $entry_category; ?>
                                </label>
                                <div class="col-sm-10">
                                    <input disabled="disabled" 
                                           type="text" 
                                           name="category" 
                                           value="<?php echo $filter['name']; ?>" 
                                           id="input_category" 
                                           class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">
                                    <?php echo $entry_param_value; ?>
                                </label>
                                <div class="col-sm-10">
                                    <div id="filter_param_value">
                                        <?php if (isset($param_values)) { ?>
                                            <?php foreach ($param_values as $param_id => $param_value) { ?>
                                                <input disabled="disabled" 
                                                       type="text" 
                                                       name="<?php echo $param_value['param_value_id'] ?>" 
                                                       value="<?php echo $param_value['param_name'] ?> <?php echo ($param_value['param_value_name']) ? $param_value['param_value_name'] : "' '" ?>" 
                                                       id="input_category" 
                                                       class="form-control" />
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo $entry_is_popular; ?></label>
                                <div class="col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <?php if ($filter['is_popular']) { ?>
                                                <input type="checkbox" name="is_popular" value="1" checked="checked" id="input_is_popular" />
                                            <?php } else { ?>
                                                <input type="checkbox" name="is_popular" value="1" id="input_is_popular" />
                                            <?php } ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo $entry_is_index; ?></label>
                                <div class="col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <?php if ($filter['is_index'] == 1) { ?>
                                                <input type="checkbox" name="is_index" value="1" checked="checked" id="input_is_index" />
                                            <?php } else { ?>
                                                <input type="checkbox" name="is_index" value="1" id="input_is_index" />
                                            <?php } ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
<?php foreach ($languages as $language) { ?>
        $('#input_description<?php echo $language['language_id']; ?>').summernote({
            height: 300
        });
<?php } ?>
</script>

<?php echo $footer; ?> 