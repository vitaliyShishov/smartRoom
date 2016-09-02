<?php echo $header; ?><?php echo $columnLeft; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-information" data-toggle="tooltip" title="<?php echo $button_save; ?>"
                        class="btn btn-primary">
                    <i class="fa fa-save"></i>
                </button>
                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>"
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
                <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $textForm; ?></h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data"
                      id="form-information" class="form-horizontal">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
                        <li><a href="#tab-data" data-toggle="tab"><?php echo $tab_data; ?></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-general">
                            <ul class="nav nav-tabs" id="language">
                                <?php foreach ($languages as $language) { ?>
                                <li>
                                    <a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab">
                                        <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" />
                                            <?php echo $language['name']; ?>
                                    </a>
                                </li>
                                <?php } ?>
                            </ul>
                            <div class="tab-content">
                                <?php foreach ($languages as $language) { ?>
                                <div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
                                    <div class="form-group required">
                                        <label class="col-sm-2 control-label" for="input-title<?php echo $language['language_id']; ?>"><?php echo $entryTitle; ?></label>
                                        <div class="col-sm-10">
                                            <input
                                                type="text"
                                                name="information_description[<?php echo $language['language_id']; ?>][title]"
                                                value="<?php echo isset($informationDescription[$language['language_id']]) ? $informationDescription[$language['language_id']]['title'] : ''; ?>"
                                                placeholder="<?php echo $entryTitle; ?>"
                                                id="input-title<?php echo $language['language_id']; ?>"
                                                class="form-control" />
                                                        <?php if (isset($errorTitle[$language['language_id']])) { ?>
                                            <div class="text-danger"><?php echo $errorTitle[$language['language_id']]; ?></div>
                                                    <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <label class="col-sm-2 control-label" for="input-description<?php echo $language['language_id']; ?>"><?php echo $entryDescription; ?></label>
                                        <div class="col-sm-10">
                                            <textarea name="information_description[<?php echo $language['language_id']; ?>][description]" placeholder="<?php echo $entryDescription; ?>" id="input-description<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($informationDescription[$language['language_id']]) ? $informationDescription[$language['language_id']]['description'] : ''; ?></textarea>
                                                <?php if (isset($errorDescription[$language['language_id']])) { ?>
                                            <div class="text-danger"><?php echo $errorDescription[$language['language_id']]; ?></div>
                                                <?php } ?>
                                        </div>
                                    </div>

                                    <div class="form-group required">
                                        <label class="col-sm-2 control-label" for="input-meta-title<?php echo $language['language_id']; ?>"><?php echo $entryMetaTitle; ?></label>
                                        <div class="col-sm-10">
                                            <input type="text" name="information_description[<?php echo $language['language_id']; ?>][meta_title]" value="<?php echo isset($informationDescription[$language['language_id']]) ? $informationDescription[$language['language_id']]['meta_title'] : ''; ?>" placeholder="<?php echo $entryMetaTitle; ?>" id="input-meta-title<?php echo $language['language_id']; ?>" class="form-control" />
                                                <?php if (isset($error_meta_title[$language['language_id']])) { ?>
                                            <div class="text-danger"><?php echo $error_meta_title[$language['language_id']]; ?></div>
                                                <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-meta-description<?php echo $language['language_id']; ?>"><?php echo $entryMetaDescription; ?></label>
                                        <div class="col-sm-10">
                                            <textarea name="information_description[<?php echo $language['language_id']; ?>][meta_description]" rows="5" placeholder="<?php echo $entryMetaDescription; ?>" id="input-meta-description<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($informationDescription[$language['language_id']]) ? $informationDescription[$language['language_id']]['meta_description'] : ''; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-meta-keyword<?php echo $language['language_id']; ?>"><?php echo $entryMetaKeyword; ?></label>
                                        <div class="col-sm-10">
                                            <textarea name="information_description[<?php echo $language['language_id']; ?>][meta_keyword]" rows="5" placeholder="<?php echo $entryMetaKeyword; ?>" id="input-meta-keyword<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($informationDescription[$language['language_id']]) ? $informationDescription[$language['language_id']]['meta_keyword'] : ''; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-data">
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo $entryStore; ?></label>
                                <div class="col-sm-10">
                                    <div class="well well-sm" style="height: 150px; overflow: auto;">
                                        <div class="checkbox">
                                            <label>
                                                <?php if (in_array(0, $informationStore)) { ?>
                                                <input type="checkbox" name="information_store[]" value="0" checked="checked" />
                                                    <?php echo $text_default; ?>
                                                <?php } else { ?>
                                                <input type="checkbox" name="information_store[]" value="0" />
                                                    <?php echo $text_default; ?>
                                                <?php } ?>
                                            </label>
                                        </div>
                                        <?php foreach ($stores as $store) { ?>
                                        <div class="checkbox">
                                            <label>
                                                    <?php if (in_array($store['store_id'], $informationStore)) { ?>
                                                <input type="checkbox" name="information_store[]" value="<?php echo $store['store_id']; ?>" checked="checked" />
                                                        <?php echo $store['name']; ?>
                                                    <?php } else { ?>
                                                <input type="checkbox" name="information_store[]" value="<?php echo $store['store_id']; ?>" />
                                                        <?php echo $store['name']; ?>
                                                    <?php } ?>
                                            </label>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-image"><?php echo $entry_image; ?></label>
                                <div class="col-sm-10">
                                    <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                                    <input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-keyword"><span data-toggle="tooltip" title="<?php echo $helpKeyword; ?>"><?php echo $entryKeyword; ?></span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="keyword" value="<?php echo $keyword; ?>"
                                           placeholder="<?php echo $entryKeyword; ?>" id="input-keyword" class="form-control" />
                                           <?php if ($errorKeyword) { ?>
                                    <div class="text-danger"><?php echo $errorKeyword; ?></div>
                                           <?php } ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-publish"><?php echo $entryPublish; ?></label>
                                <div class="col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <?php if ($publish) { ?>
                                            <input type="checkbox" name="publish" value="1" checked="checked" id="input-publish" />
                                            <?php } else { ?>
                                            <input type="checkbox" name="publish" value="1" id="input-publish" /><br>
                                            <?php } ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo $entryPublishDate; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" name="publish_date" value="<?php echo $publishDate; ?>" placeholder="<?php echo $publishDate; ?>" class="form-control" disabled />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entrySortOrder; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" name="sort_order" value="<?php echo $sortOrder; ?>"
                                           placeholder="<?php echo $entrySortOrder; ?>" id="input-sort-order"
                                           class="form-control" />
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
<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
$('#input-description<?php echo $language['language_id']; ?>').summernote({
    height: 300
});
<?php } ?>
//--></script>
<script type="text/javascript"><!--
$('#language a:first').tab('show');
//--></script></div>
<?php echo $footer; ?>