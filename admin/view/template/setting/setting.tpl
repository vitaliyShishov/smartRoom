<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-setting" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
            <h1><?php echo $headingTitle; ?></h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <?php if ($errorWarning) { ?>
            <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $errorWarning; ?>
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
                <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-setting" class="form-horizontal">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
                        <li style="display:none;"><a href="#tab-store" data-toggle="tab"><?php echo $tab_store; ?></a></li>
                        <li><a href="#tab-local" data-toggle="tab"><?php echo $tab_local; ?></a></li>
                        <li><a href="#tab-option" data-toggle="tab"><?php echo $tab_option; ?></a></li>
                        <li><a href="#tab-image" data-toggle="tab"><?php echo $tab_image; ?></a></li>
                        <li><a href="#tab-mail" data-toggle="tab"><?php echo $tab_mail; ?></a></li>
                        <li><a href="#tab-server" data-toggle="tab"><?php echo $tab_server; ?></a></li>
                        <li><a href="#tab-api" data-toggle="tab"><?php echo $tab_api; ?></a></li>
                        <li><a href="#tab-content" data-toggle="tab"><?php echo $tab_content; ?></a></li>
                        <li><a href="#tab-seo" data-toggle="tab"><?php echo $tab_seo; ?></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-general">
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-name"><?php echo $entryName; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" name="config_name" value="<?php echo $config_name; ?>" placeholder="<?php echo $entryName; ?>" id="input-name" class="form-control" />
                                    <?php if ($errorName) { ?>
                                        <div class="text-danger"><?php echo $errorName; ?></div>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-address"><?php echo $entryAddress; ?></label>
                                <div class="col-sm-10">
                                    <textarea name="config_address" placeholder="<?php echo $entryAddress; ?>" rows="5" id="input-address" class="form-control"><?php echo $config_address; ?></textarea>
                                    <?php if ($errorAddress) { ?>
                                        <div class="text-danger"><?php echo $errorAddress; ?></div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-email"><?php echo $entryEmail; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" name="config_email" value="<?php echo $config_email; ?>" placeholder="<?php echo $entryEmail; ?>" id="input-email" class="form-control" />
                                    <?php if ($errorEmail) { ?>
                                        <div class="text-danger"><?php echo $errorEmail; ?></div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-telephone"><?php echo $entryTelephone; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" name="config_telephone" value="<?php echo $config_telephone; ?>" placeholder="<?php echo $entryTelephone; ?>" id="input-telephone" class="form-control" />
                                    <?php if ($errorTelephone) { ?>
                                        <div class="text-danger"><?php echo $errorTelephone; ?></div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-open"><span data-toggle="tooltip" data-container="#tab-general" title="<?php echo $helpOpen; ?>"><?php echo $entryOpen; ?></span></label>
                                <div class="col-sm-10">
                                    <textarea name="config_open" rows="5" placeholder="<?php echo $entryOpen; ?>" id="input-open" class="form-control"><?php echo $config_open; ?></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane" id="tab-store" style="display:none;">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-template"><?php echo $entryTemplate; ?></label>
                                <div class="col-sm-10">
                                    <select name="config_template" id="input-template" class="form-control">
                                        <?php foreach ($templates as $template) { ?>
                                            <?php if ($template == $config_template) { ?>
                                                <option value="<?php echo $template; ?>" selected="selected"><?php echo $template; ?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo $template; ?>"><?php echo $template; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                    <br />
                                    <img src="" alt="" id="template" class="img-thumbnail" /></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-layout"><?php echo $entryLayout; ?></label>
                                <div class="col-sm-10">
                                    <select name="config_layout_id" id="input-layout" class="form-control">
                                        <?php foreach ($layouts as $layout) { ?>
                                            <?php if ($layout['layout_id'] == $config_layout_id) { ?>
                                                <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-local">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-country"><?php echo $entryCountry; ?></label>
                                <div class="col-sm-10">
                                    <select name="config_country_id" id="input-country" class="form-control">
                                        <?php foreach ($countries as $country) { ?>
                                            <?php if ($country['country_id'] == $config_country_id) { ?>
                                                <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-zone"><?php echo $entryZone; ?></label>
                                <div class="col-sm-10">
                                    <select name="config_zone_id" id="input-zone" class="form-control">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-language"><?php echo $entryLanguage; ?></label>
                                <div class="col-sm-10">
                                    <select name="config_language" id="input-language" class="form-control">
                                        <?php foreach ($languages as $language) { ?>
                                            <?php if ($language['code'] == $config_language) { ?>
                                                <option value="<?php echo $language['code']; ?>" selected="selected"><?php echo $language['name']; ?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo $language['code']; ?>"><?php echo $language['name']; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-admin-language"><?php echo $entryAdminLanguage; ?></label>
                                <div class="col-sm-10">
                                    <select name="config_admin_language" id="input-admin-language" class="form-control">
                                        <?php foreach ($languages as $language) { ?>
                                            <?php if ($language['code'] == $config_admin_language) { ?>
                                                <option value="<?php echo $language['code']; ?>" selected="selected"><?php echo $language['name']; ?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo $language['code']; ?>"><?php echo $language['name']; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-currency"><span data-toggle="tooltip" title="<?php echo $helpCurrency; ?>"><?php echo $entryCurrency; ?></span></label>
                                <div class="col-sm-10">
                                    <select name="config_currency" id="input-currency" class="form-control">
                                        <?php foreach ($currencies as $currency) { ?>
                                            <?php if ($currency['code'] == $config_currency) { ?>
                                                <option value="<?php echo $currency['code']; ?>" selected="selected"><?php echo $currency['title']; ?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo $currency['code']; ?>"><?php echo $currency['title']; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-option">
                            <fieldset>
                                <legend><?php echo $text_product; ?></legend>
                                <div class="form-group" hidden="hidden">
                                    <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $helpProductCount; ?>"><?php echo $entryProductCount; ?></span></label>
                                    <div class="col-sm-10">
                                        <label class="radio-inline">
                                            <?php if ($config_product_count) { ?>
                                                <input type="radio" name="config_product_count" value="1" checked="checked" />
                                                <?php echo $text_yes; ?>
                                            <?php } else { ?>
                                                <input type="radio" name="config_product_count" value="1" />
                                                <?php echo $text_yes; ?>
                                            <?php } ?>
                                        </label>
                                        <label class="radio-inline">
                                            <?php if (!$config_product_count) { ?>
                                                <input type="radio" name="config_product_count" value="0" checked="checked" />
                                                <?php echo $text_no; ?>
                                            <?php } else { ?>
                                                <input type="radio" name="config_product_count" value="0" />
                                                <?php echo $text_no; ?>
                                            <?php } ?>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-catalog-limit"><span data-toggle="tooltip" title="<?php echo $helpProductLimit; ?>"><?php echo $entryProductLimit; ?></span></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="config_product_limit" value="<?php echo $config_product_limit; ?>" placeholder="<?php echo $entryProductLimit; ?>" id="input-catalog-limit" class="form-control" />
                                        <?php if ($error_product_limit) { ?>
                                            <div class="text-danger"><?php echo $error_product_limit; ?></div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-product-search-limit">
                                        <span data-toggle="tooltip" title="<?php echo $help_product_search_limit; ?>">
                                            <?php echo $entry_product_search_limit; ?>
                                        </span>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                               name="config_product_search_limit"
                                               value="<?php echo $config_product_search_limit ?>"
                                               placeholder="<?php echo $entry_product_search_limit; ?>"
                                               id="input-product-search-limit"
                                               class="form-control" />
                                        <?php if ($error_product_limit) { ?>
                                            <div class="text-danger">
                                                <?php echo $error_product_limit; ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-admin-limit"><span data-toggle="tooltip" title="<?php echo $helpLimitAdmin; ?>"><?php echo $entryLimitAdmin; ?></span></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="config_limit_admin" value="<?php echo $config_limit_admin; ?>" placeholder="<?php echo $entryLimitAdmin; ?>" id="input-admin-limit" class="form-control" />
                                        <?php if ($errorLimit_admin) { ?>
                                            <div class="text-danger"><?php echo $errorLimit_admin; ?></div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend><?php echo $text_tax; ?></legend>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><?php echo $entryTax; ?></label>
                                    <div class="col-sm-10">
                                        <label class="radio-inline">
                                            <?php if ($config_tax) { ?>
                                                <input type="radio" name="config_tax" value="1" checked="checked" />
                                                <?php echo $text_yes; ?>
                                            <?php } else { ?>
                                                <input type="radio" name="config_tax" value="1" />
                                                <?php echo $text_yes; ?>
                                            <?php } ?>
                                        </label>
                                        <label class="radio-inline">
                                            <?php if (!$config_tax) { ?>
                                                <input type="radio" name="config_tax" value="0" checked="checked" />
                                                <?php echo $text_no; ?>
                                            <?php } else { ?>
                                                <input type="radio" name="config_tax" value="0" />
                                                <?php echo $text_no; ?>
                                            <?php } ?>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-tax-default"><span data-toggle="tooltip" title="<?php echo $helpTaxDefault; ?>"><?php echo $entryTaxDefault; ?></span></label>
                                    <div class="col-sm-10">
                                        <select name="config_tax_default" id="input-tax-default" class="form-control">
                                            <option value=""><?php echo $text_none; ?></option>
                                            <?php if ($config_tax_default == 'shipping') { ?>
                                                <option value="shipping" selected="selected"><?php echo $text_shipping; ?></option>
                                            <?php } else { ?>
                                                <option value="shipping"><?php echo $text_shipping; ?></option>
                                            <?php } ?>
                                            <?php if ($config_tax_default == 'payment') { ?>
                                                <option value="payment" selected="selected"><?php echo $text_payment; ?></option>
                                            <?php } else { ?>
                                                <option value="payment"><?php echo $text_payment; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-tax-customer"><span data-toggle="tooltip" title="<?php echo $helpTaxCustomer; ?>"><?php echo $entryTax_customer; ?></span></label>
                                    <div class="col-sm-10">
                                        <select name="config_tax_customer" id="input-tax-customer" class="form-control">
                                            <option value=""><?php echo $text_none; ?></option>
                                            <?php if ($config_tax_customer == 'shipping') { ?>
                                                <option value="shipping" selected="selected"><?php echo $text_shipping; ?></option>
                                            <?php } else { ?>
                                                <option value="shipping"><?php echo $text_shipping; ?></option>
                                            <?php } ?>
                                            <?php if ($config_tax_customer == 'payment') { ?>
                                                <option value="payment" selected="selected"><?php echo $text_payment; ?></option>
                                            <?php } else { ?>
                                                <option value="payment"><?php echo $text_payment; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <legend><?php echo $text_checkout; ?></legend>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-order-status"><span data-toggle="tooltip" title="<?php echo $helpOrderStatus; ?>"><?php echo $entryOrderStatus; ?></span></label>
                                    <div class="col-sm-10">
                                        <select name="config_order_status_id" id="input-order-status" class="form-control">
                                            <?php foreach ($order_statuses as $order_status) { ?>
                                            <?php if ($order_status['order_status_id'] == $config_order_status_id) { ?>
                                            <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                                            <?php } else { ?>
                                            <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                                            <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" 
                                           for="input-payment-status">
                                        <?php echo $entry_payment_status; ?>
                                    </label>
                                    <div class="col-sm-10">
                                        <select name="config_payment_status_id" id="input-payment-status" class="form-control">
                                            <?php foreach ($order_statuses as $order_status) { ?>
                                                <?php if ($order_status['order_status_id'] == $config_payment_status_id) { ?>
                                                    <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected">
                                                        <?php echo $order_status['name']; ?>
                                                    </option>
                                                <?php } else { ?>
                                                    <option value="<?php echo $order_status['order_status_id']; ?>">
                                                        <?php echo $order_status['name']; ?>
                                                    </option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-process-status"><span data-toggle="tooltip" title="<?php echo $helpProcessingStatus; ?>"><?php echo $entryProcessingStatus; ?></span></label>
                                    <div class="col-sm-10">
                                        <div class="well well-sm" style="height: 150px; overflow: auto;">
                                            <?php foreach ($order_statuses as $order_status) { ?>
                                            <div class="checkbox">
                                                <label>
                                                    <?php if (in_array($order_status['order_status_id'], $config_processing_status)) { ?>
                                                    <input type="checkbox" name="config_processing_status[]" value="<?php echo $order_status['order_status_id']; ?>" checked="checked" />
                                                    <?php echo $order_status['name']; ?>
                                                    <?php } else { ?>
                                                    <input type="checkbox" name="config_processing_status[]" value="<?php echo $order_status['order_status_id']; ?>" />
                                                    <?php echo $order_status['name']; ?>
                                                    <?php } ?>
                                                </label>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <?php if ($errorProcessingStatus) { ?>
                                        <div class="text-danger"><?php echo $errorProcessingStatus; ?></div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-complete-status"><span data-toggle="tooltip" title="<?php echo $helpCompleteStatus; ?>"><?php echo $entryCompleteStatus; ?></span></label>
                                    <div class="col-sm-10">
                                        <div class="well well-sm" style="height: 150px; overflow: auto;">
                                            <?php foreach ($order_statuses as $order_status) { ?>
                                            <div class="checkbox">
                                                <label>
                                                    <?php if (in_array($order_status['order_status_id'], $config_complete_status)) { ?>
                                                    <input type="checkbox" name="config_complete_status[]" value="<?php echo $order_status['order_status_id']; ?>" checked="checked" />
                                                    <?php echo $order_status['name']; ?>
                                                    <?php } else { ?>
                                                    <input type="checkbox" name="config_complete_status[]" value="<?php echo $order_status['order_status_id']; ?>" />
                                                    <?php echo $order_status['name']; ?>
                                                    <?php } ?>
                                                </label>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <?php if ($errorCompleteStatus) { ?>
                                        <div class="text-danger"><?php echo $errorCompleteStatus; ?></div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $helpOrderMail; ?>"><?php echo $entryOrderMail; ?></span></label>
                                    <div class="col-sm-10">
                                        <label class="radio-inline">
                                            <?php if ($config_order_mail) { ?>
                                                <input type="radio" name="config_order_mail" value="1" checked="checked" />
                                                <?php echo $text_yes; ?>
                                            <?php } else { ?>
                                                <input type="radio" name="config_order_mail" value="1" />
                                                <?php echo $text_yes; ?>
                                            <?php } ?>
                                        </label>
                                        <label class="radio-inline">
                                            <?php if (!$config_order_mail) { ?>
                                                <input type="radio" name="config_order_mail" value="0" checked="checked" />
                                                <?php echo $text_no; ?>
                                            <?php } else { ?>
                                                <input type="radio" name="config_order_mail" value="0" />
                                                <?php echo $text_no; ?>
                                            <?php } ?>
                                        </label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="tab-pane" id="tab-image">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-logo"><?php echo $entryLogo; ?></label>
                                <div class="col-sm-10"><a href="" id="thumb-logo" data-toggle="image" class="img-thumbnail"><img src="<?php echo $logo; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                                    <input type="hidden" name="config_logo" value="<?php echo $config_logo; ?>" id="input-logo" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-logo-white">Логотип(белый)</label>
                                <div class="col-sm-10">
                                    <a href="" id="thumb-logo-white" data-toggle="image" class="img-thumbnail">
                                        <img src="<?php echo $logo_white; ?>" alt="" title=""
                                             data-placeholder="<?php echo $placeholder; ?>" />
                                    </a>
                                    <input type="hidden" name="config_logo_white" value="<?php echo $config_logo_white; ?>" id="input-logo-white" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-icon"><?php echo $entryIcon; ?></label>
                                <div class="col-sm-10"><a href="" id="thumb-icon" data-toggle="image" class="img-thumbnail"><img src="<?php echo $icon; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                                    <input type="hidden" name="config_icon" value="<?php echo $config_icon; ?>" id="input-icon" />
                                </div>
                            </div>                           
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-image-category-width"><?php echo $entryImageCategory; ?></label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="text" name="config_image_category_width" value="<?php echo $config_image_category_width; ?>" placeholder="<?php echo $entry_width; ?>" id="input-image-category-width" class="form-control" />
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" name="config_image_category_height" value="<?php echo $config_image_category_height; ?>" placeholder="<?php echo $entry_height; ?>" class="form-control" />
                                        </div>
                                    </div>
                                    <?php if ($errorImageCategory) { ?>
                                        <div class="text-danger"><?php echo $errorImageCategory; ?></div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-image-tab-category-width"><?php echo $entry_image_tab_category; ?></label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="text" name="config_image_tab_category_width" value="<?php echo $config_image_tab_category_width; ?>" placeholder="<?php echo $entry_width; ?>" id="input-image-category-width" class="form-control" />
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" name="config_image_tab_category_height" value="<?php echo $config_image_tab_category_height; ?>" placeholder="<?php echo $entry_height; ?>" class="form-control" />
                                        </div>
                                    </div>
                                    <?php if ($error_image_tab_category) { ?>
                                        <div class="text-danger"><?php echo $error_image_tab_category; ?></div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-image-logo-width"><?php echo $entry_image_logo; ?></label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="text" name="config_image_logo_width" value="<?php echo $config_image_logo_width; ?>" placeholder="<?php echo $entry_width; ?>" id="input-image-logo-width" class="form-control" />
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" name="config_image_logo_height" value="<?php echo $config_image_logo_height; ?>" placeholder="<?php echo $entry_height; ?>" class="form-control" />
                                        </div>
                                    </div>
                                    <?php if ($error_image_logo) { ?>
                                        <div class="text-danger"><?php echo $error_image_logo; ?></div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-image-thumb-width"><?php echo $entryImageThumb; ?></label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="text" name="config_image_thumb_width" value="<?php echo $config_image_thumb_width; ?>" placeholder="<?php echo $entry_width; ?>" id="input-image-thumb-width" class="form-control" />
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" name="config_image_thumb_height" value="<?php echo $config_image_thumb_height; ?>" placeholder="<?php echo $entry_height; ?>" class="form-control" />
                                        </div>
                                    </div>
                                    <?php if ($errorImageThumb) { ?>
                                        <div class="text-danger"><?php echo $errorImageThumb; ?></div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-image-product-width"><?php echo $entryImageProduct; ?></label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="text" name="config_image_product_width" value="<?php echo $config_image_product_width; ?>" placeholder="<?php echo $entry_width; ?>" id="input-image-product-width" class="form-control" />
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" name="config_image_product_height" value="<?php echo $config_image_product_height; ?>" placeholder="<?php echo $entry_height; ?>" class="form-control" />
                                        </div>
                                    </div>
                                    <?php if ($errorImageProduct) { ?>
                                        <div class="text-danger"><?php echo $errorImageProduct; ?></div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-image-search">
                                    <?php echo $entry_image_search; ?>
                                </label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="text"
                                                   name="config_image_search_width"
                                                   value="<?php echo $config_image_search_width; ?>"
                                                   placeholder="<?php echo $entry_width; ?>"
                                                   id="input-image-search"
                                                   class="form-control" />
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" 
                                                   name="config_image_search_height"
                                                   value="<?php echo $config_image_search_height; ?>"
                                                   placeholder="<?php echo $entry_height; ?>"
                                                   class="form-control" />
                                        </div>
                                    </div>
                                    <?php if ($error_image_search) { ?>
                                        <div class="text-danger">
                                            <?php echo $error_image_search; ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-mail">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-mail-protocol"><span data-toggle="tooltip" title="<?php echo $helpMailProtocol; ?>"><?php echo $entryMailProtocol; ?></span></label>
                                <div class="col-sm-10">
                                    <select name="config_mail_protocol" id="input-mail-protocol" class="form-control">
                                        <?php if ($config_mail_protocol == 'mail') { ?>
                                            <option value="mail" selected="selected"><?php echo $text_mail; ?></option>
                                        <?php } else { ?>
                                            <option value="mail"><?php echo $text_mail; ?></option>
                                        <?php } ?>
                                        <?php if ($config_mail_protocol == 'smtp') { ?>
                                            <option value="smtp" selected="selected"><?php echo $text_smtp; ?></option>
                                        <?php } else { ?>
                                            <option value="smtp"><?php echo $text_smtp; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-mail-parameter"><span data-toggle="tooltip" title="<?php echo $helpMailParameter; ?>"><?php echo $entryMailParameter; ?></span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="config_mail_parameter" value="<?php echo $config_mail_parameter; ?>" placeholder="<?php echo $entryMailParameter; ?>" id="input-mail-parameter" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-mail-smtp-hostname"><span data-toggle="tooltip" title="<?php echo $helpMailSmtpHostname; ?>"><?php echo $entryMailSmtpHostname; ?></span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="config_mail_smtp_hostname" value="<?php echo $config_mail_smtp_hostname; ?>" placeholder="<?php echo $entryMailSmtpHostname; ?>" id="input-mail-smtp-hostname" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-mail-smtp-username"><?php echo $entryMailSmtpUsername; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" name="config_mail_smtp_username" value="<?php echo $config_mail_smtp_username; ?>" placeholder="<?php echo $entryMailSmtpUsername; ?>" id="input-mail-smtp-username" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-mail-smtp-password"><?php echo $entryMailSmtpPassword; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" name="config_mail_smtp_password" value="<?php echo $config_mail_smtp_password; ?>" placeholder="<?php echo $entryMailSmtpPassword; ?>" id="input-mail-smtp-password" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-mail-smtp-port"><?php echo $entryMailSmtpPort; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" name="config_mail_smtp_port" value="<?php echo $config_mail_smtp_port; ?>" placeholder="<?php echo $entryMailSmtpPort; ?>" id="input-mail-smtp-port" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-mail-smtp-timeout"><?php echo $entryMailSmtpTimeout; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" name="config_mail_smtp_timeout" value="<?php echo $config_mail_smtp_timeout; ?>" placeholder="<?php echo $entryMailSmtpTimeout; ?>" id="input-mail-smtp-timeout" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-alert-email"><span data-toggle="tooltip" title="<?php echo $helpMailAlert; ?>"><?php echo $entryMailAlert; ?></span></label>
                                <div class="col-sm-10">
                                    <textarea name="config_mail_alert" rows="5" placeholder="<?php echo $entryMailAlert; ?>" id="input-alert-email" class="form-control"><?php echo $config_mail_alert; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-server">
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $helpSecure; ?>"><?php echo $entrySecure; ?></span></label>
                                <div class="col-sm-10">
                                    <label class="radio-inline">
                                        <?php if ($config_secure) { ?>
                                            <input type="radio" name="config_secure" value="1" checked="checked" />
                                            <?php echo $text_yes; ?>
                                        <?php } else { ?>
                                            <input type="radio" name="config_secure" value="1" />
                                            <?php echo $text_yes; ?>
                                        <?php } ?>
                                    </label>
                                    <label class="radio-inline">
                                        <?php if (!$config_secure) { ?>
                                            <input type="radio" name="config_secure" value="0" checked="checked" />
                                            <?php echo $text_no; ?>
                                        <?php } else { ?>
                                            <input type="radio" name="config_secure" value="0" />
                                            <?php echo $text_no; ?>
                                        <?php } ?>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $helpShared; ?>"><?php echo $entryShared; ?></span></label>
                                <div class="col-sm-10">
                                    <label class="radio-inline">
                                        <?php if ($config_shared) { ?>
                                            <input type="radio" name="config_shared" value="1" checked="checked" />
                                            <?php echo $text_yes; ?>
                                        <?php } else { ?>
                                            <input type="radio" name="config_shared" value="1" />
                                            <?php echo $text_yes; ?>
                                        <?php } ?>
                                    </label>
                                    <label class="radio-inline">
                                        <?php if (!$config_shared) { ?>
                                            <input type="radio" name="config_shared" value="0" checked="checked" />
                                            <?php echo $text_no; ?>
                                        <?php } else { ?>
                                            <input type="radio" name="config_shared" value="0" />
                                            <?php echo $text_no; ?>
                                        <?php } ?>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-robots"><span data-toggle="tooltip" title="<?php echo $helpRobots; ?>"><?php echo $entryRobots; ?></span></label>
                                <div class="col-sm-10">
                                    <textarea name="config_robots" rows="5" placeholder="<?php echo $entryRobots; ?>" id="input-robots" class="form-control"><?php echo $config_robots; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $helpSeoUrl; ?>"><?php echo $entrySeoUrl; ?></span></label>
                                <div class="col-sm-10">
                                    <label class="radio-inline">
                                        <?php if ($config_seo_url) { ?>
                                            <input type="radio" name="config_seo_url" value="1" checked="checked" />
                                            <?php echo $text_yes; ?>
                                        <?php } else { ?>
                                            <input type="radio" name="config_seo_url" value="1" />
                                            <?php echo $text_yes; ?>
                                        <?php } ?>
                                    </label>
                                    <label class="radio-inline">
                                        <?php if (!$config_seo_url) { ?>
                                            <input type="radio" name="config_seo_url" value="0" checked="checked" />
                                            <?php echo $text_no; ?>
                                        <?php } else { ?>
                                            <input type="radio" name="config_seo_url" value="0" />
                                            <?php echo $text_no; ?>
                                        <?php } ?>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-file-max-size"><span data-toggle="tooltip" title="<?php echo $helpFileMaxSize; ?>"><?php echo $entryFileMaxSize; ?></span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="config_file_max_size" value="<?php echo $config_file_max_size; ?>" placeholder="<?php echo $entryFileMaxSize; ?>" id="input-file-max-size" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-file-ext-allowed"><span data-toggle="tooltip" title="<?php echo $helpFileExtAllowed; ?>"><?php echo $entryFileExtAllowed; ?></span></label>
                                <div class="col-sm-10">
                                    <textarea name="config_file_ext_allowed" rows="5" placeholder="<?php echo $entryFileExtAllowed; ?>" id="input-file-ext-allowed" class="form-control"><?php echo $config_file_ext_allowed; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-file-mime-allowed"><span data-toggle="tooltip" title="<?php echo $helpFileMimeAllowed; ?>"><?php echo $entryFileMimeAllowed; ?></span></label>
                                <div class="col-sm-10">
                                    <textarea name="config_file_mime_allowed" cols="60" rows="5" placeholder="<?php echo $entryFileMimeAllowed; ?>" id="input-file-mime-allowed" class="form-control"><?php echo $config_file_mime_allowed; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $helpMaintenance; ?>"><?php echo $entryMaintenance; ?></span></label>
                                <div class="col-sm-10">
                                    <label class="radio-inline">
                                        <?php if ($config_maintenance) { ?>
                                            <input type="radio" name="config_maintenance" value="1" checked="checked" />
                                            <?php echo $text_yes; ?>
                                        <?php } else { ?>
                                            <input type="radio" name="config_maintenance" value="1" />
                                            <?php echo $text_yes; ?>
                                        <?php } ?>
                                    </label>
                                    <label class="radio-inline">
                                        <?php if (!$config_maintenance) { ?>
                                            <input type="radio" name="config_maintenance" value="0" checked="checked" />
                                            <?php echo $text_no; ?>
                                        <?php } else { ?>
                                            <input type="radio" name="config_maintenance" value="0" />
                                            <?php echo $text_no; ?>
                                        <?php } ?>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $helpPassword; ?>"><?php echo $entryPassword; ?></span></label>
                                <div class="col-sm-10">
                                    <label class="radio-inline">
                                        <?php if ($config_password) { ?>
                                            <input type="radio" name="config_password" value="1" checked="checked" />
                                            <?php echo $text_yes; ?>
                                        <?php } else { ?>
                                            <input type="radio" name="config_password" value="1" />
                                            <?php echo $text_yes; ?>
                                        <?php } ?>
                                    </label>
                                    <label class="radio-inline">
                                        <?php if (!$config_password) { ?>
                                            <input type="radio" name="config_password" value="0" checked="checked" />
                                            <?php echo $text_no; ?>
                                        <?php } else { ?>
                                            <input type="radio" name="config_password" value="0" />
                                            <?php echo $text_no; ?>
                                        <?php } ?>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-encryption"><span data-toggle="tooltip" title="<?php echo $helpEncryption; ?>"><?php echo $entryEncryption; ?></span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="config_encryption" value="<?php echo $config_encryption; ?>" placeholder="<?php echo $entryEncryption; ?>" id="input-encryption" class="form-control" />
                                    <?php if ($errorEncryption) { ?>
                                        <div class="text-danger"><?php echo $errorEncryption; ?></div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-compression"><span data-toggle="tooltip" title="<?php echo $helpCompression; ?>"><?php echo $entryCompression; ?></span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="config_compression" value="<?php echo $config_compression; ?>" placeholder="<?php echo $entryCompression; ?>" id="input-compression" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo $entryErrorDisplay; ?></label>
                                <div class="col-sm-10">
                                    <label class="radio-inline">
                                        <?php if ($config_error_display) { ?>
                                            <input type="radio" name="config_error_display" value="1" checked="checked" />
                                            <?php echo $text_yes; ?>
                                        <?php } else { ?>
                                            <input type="radio" name="config_error_display" value="1" />
                                            <?php echo $text_yes; ?>
                                        <?php } ?>
                                    </label>
                                    <label class="radio-inline">
                                        <?php if (!$config_error_display) { ?>
                                            <input type="radio" name="config_error_display" value="0" checked="checked" />
                                            <?php echo $text_no; ?>
                                        <?php } else { ?>
                                            <input type="radio" name="config_error_display" value="0" />
                                            <?php echo $text_no; ?>
                                        <?php } ?>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo $entryErrorLog; ?></label>
                                <div class="col-sm-10">
                                    <label class="radio-inline">
                                        <?php if ($config_error_log) { ?>
                                            <input type="radio" name="config_error_log" value="1" checked="checked" />
                                            <?php echo $text_yes; ?>
                                        <?php } else { ?>
                                            <input type="radio" name="config_error_log" value="1" />
                                            <?php echo $text_yes; ?>
                                        <?php } ?>
                                    </label>
                                    <label class="radio-inline">
                                        <?php if (!$config_error_log) { ?>
                                            <input type="radio" name="config_error_log" value="0" checked="checked" />
                                            <?php echo $text_no; ?>
                                        <?php } else { ?>
                                            <input type="radio" name="config_error_log" value="0" />
                                            <?php echo $text_no; ?>
                                        <?php } ?>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-error-filename"><?php echo $entryErrorFilename; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" name="config_error_filename" value="<?php echo $config_error_filename; ?>" placeholder="<?php echo $entryErrorFilename; ?>" id="input-error-filename" class="form-control" />
                                    <?php if ($errorErrorFilename) { ?>
                                        <div class="text-danger"><?php echo $errorErrorFilename; ?></div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-api">
                            <fieldset>
                                <legend><?php echo $text_social_group; ?></legend>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-facebook"><span data-toggle="tooltip" title="<?php echo $help_total; ?>"><?php echo $entry_facebook_group; ?></span></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="social_facebook" value="<?php echo $social_facebook; ?>" placeholder="<?php echo $entry_facebook_group; ?>" id="input-facebook" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-vkontakte"><span data-toggle="tooltip" title="<?php echo $help_total; ?>"><?php echo $entry_vkontakte_group; ?></span></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="social_vkontakte" value="<?php echo $social_vkontakte; ?>" placeholder="<?php echo $entry_vkontakte_group; ?>" id="input-vkontakte" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-instagram"><span data-toggle="tooltip" title="<?php echo $help_total; ?>"><?php echo $entry_instagram_group; ?></span></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="social_instagram" value="<?php echo $social_instagram; ?>" placeholder="<?php echo $entry_instagram_group; ?>" id="input-instagram" class="form-control" />
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend><?php echo $text_google_map; ?></legend>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-config-google-map"><span data-toggle="tooltip" title="<?php echo $help_google_map; ?>"><?php echo $entry_google_map ?></span></label>
                                    <div class="col-sm-10">
                                        <textarea rows="4" cols="45" name="config_google_map" placeholder="<?php echo $entry_google_map ?>" class="form-control"><?php echo $config_google_map; ?></textarea>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend><?php echo $text_social_share; ?></legend>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-social-share-js">
                                        <span data-toggle="tooltip" title="<?php echo $help_social_share_js ?>"><?php echo $entry_social_share_js ?></span>
                                    </label>
                                    <div class="col-sm-10">
                                        <textarea rows="5" cols="45" name="config_social_share_js" placeholder="<?php echo $entry_social_share_js ?>" class="form-control"><?php echo $config_social_share_js ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-social-share-buttons">
                                        <span data-toggle="tooltip" title="<?php echo $help_social_share_buttons ?>"><?php echo $entry_social_share_buttons ?></span>
                                    </label>
                                    <div class="col-sm-10">
                                        <textarea rows="5" cols="45" name="config_social_share_buttons" placeholder="<?php echo $entry_social_share_buttons ?>" class="form-control"><?php echo $config_social_share_buttons ?></textarea>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset style="display:none;">
                                <legend><?php echo $entry_apikey_novaposhta; ?></legend>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-config-apikey-novaposhta">
                                        <span data-toggle="tooltip" title="<?php echo $help_apikey_novaposhta; ?>"><?php echo $entry_apikey_novaposhta ?></span>
                                    </label>
                                    <div class="col-sm-10">
                                        <input name="config_apikey_novaposhta" placeholder="<?php echo $entry_apikey_novaposhta ?>" value="<?php echo $config_apikey_novaposhta ?>" class="form-control" />
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset style="display:none;">
                                <legend><?php echo $entry_turbosms; ?></legend>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-config-apikey-novaposhta">
                                        <?php echo $entry_turbosms_login; ?>
                                    </label>
                                    <div class="col-sm-10">
                                        <input name="config_turbosms_login" 
                                               placeholder="<?php echo $entry_turbosms_login; ?>" 
                                               value="<?php echo $config_turbosms_login; ?>" 
                                               class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-config-apikey-novaposhta">
                                        <?php echo $entry_turbosms_password; ?>
                                    </label>
                                    <div class="col-sm-10">
                                        <input name="config_turbosms_password" 
                                               placeholder="<?php echo $entry_turbosms_password; ?>" 
                                               value="<?php echo $config_turbosms_password; ?>" 
                                               class="form-control" />
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="tab-pane" id="tab-content">
                            <fieldset style="display:none;">
                                <legend><?php echo $text_sms_settings; ?></legend>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="sms-admin-numbers">
                                        <?php echo $entry_sms_phones; ?>
                                    </label>
                                    <div class="col-sm-10" id="sms-admin-numbers">
                                        <input name="config_sms_phones" 
                                               placeholder="<?php echo $entry_sms_phones_placeholder; ?>" 
                                               value="<?php echo $config_sms_phones; ?>" 
                                               class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="sms-text-client">
                                        <?php echo $entry_sms_client; ?>
                                    </label>
                                    <div class="col-sm-10" id="sms-text-client">
                                        <input name="config_client_sms_text" 
                                               placeholder="<?php echo $entry_sms_client; ?>" 
                                               value="<?php echo $config_client_sms_text; ?>" 
                                               class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="sms-text-admin">
                                        <?php echo $entry_sms_admin; ?>
                                    </label>
                                    <div class="col-sm-10" id="sms-text-admin">
                                        <input name="config_admin_sms_text" 
                                               placeholder="<?php echo $entry_sms_admin; ?>" 
                                               value="<?php echo $config_admin_sms_text; ?>" 
                                               class="form-control" />
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend><?php echo $text_contacts; ?></legend>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-about-information"><?php echo $entry_about_information; ?></label>
                                    <div class="col-sm-10">
                                        <select name="config_about_information" id="input-about-information" class="form-control">
                                            <?php foreach ($informations as $information) { ?>
                                                <?php if ($information['information_id'] == $config_about_information) { ?>
                                                    <option value="<?php echo $information['information_id']; ?>" selected="selected"><?php echo $information['title']; ?></option>
                                                <?php } else { ?>
                                                    <option value="<?php echo $information['information_id']; ?>"><?php echo $information['title']; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-about-information">
                                        Доставка
                                    </label>
                                    <div class="col-sm-10">
                                        <select name="config_delivery_information" id="input-delivery-information" class="form-control">
                                            <?php foreach ($informations as $information) { ?>
                                            <?php if ($information['information_id'] == $config_delivery_information) { ?>
                                            <option value="<?php echo $information['information_id']; ?>" selected="selected"><?php echo $information['title']; ?></option>
                                            <?php } else { ?>
                                            <option value="<?php echo $information['information_id']; ?>"><?php echo $information['title']; ?></option>
                                            <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="tab-pane" id="tab-seo">
                            <fieldset>
                                <legend><?php echo $text_seo_scripts; ?></legend>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-seo-google">
                                        <?php echo $text_seo_google; ?>
                                    </label>
                                    <div class="col-sm-10">
                                        <textarea name="config_seo_google" rows="10" placeholder="<?php echo $text_seo_google; ?>" id="input-seo-google" class="form-control"><?php echo $config_seo_google; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-seo-yandex">
                                        <?php echo $text_seo_yandex; ?>
                                    </label>
                                    <div class="col-sm-10">
                                        <textarea name="config_seo_yandex" rows="10" placeholder="<?php echo $text_seo_yandex; ?>" id="input-seo-yandex" class="form-control"><?php echo $config_seo_yandex; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-seo-remarketing">
                                        <?php echo $text_seo_remarketing; ?>
                                    </label>
                                    <div class="col-sm-10">
                                        <textarea name="config_seo_remarketing" rows="10" placeholder="<?php echo $text_seo_remarketing; ?>" id="input-seo-remarketing" class="form-control"><?php echo $config_seo_remarketing; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-google-conversion">
                                        <?php echo $entry_google_conversion; ?>
                                    </label>
                                    <div class="col-sm-10">
                                        <textarea name="config_google_conversion" rows="10" placeholder="<?php echo $entry_google_conversion; ?>" id="input-google-conversion" class="form-control"><?php echo $config_google_conversion; ?></textarea>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend><?php echo $text_meta_for_main; ?></legend>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-meta-title-main">
                                        <?php echo $entry_meta_title; ?>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="config_meta_title_main" value="<?php echo $config_meta_title_main; ?>" placeholder="<?php echo $entry_meta_title; ?>" id="input-meta-title-main" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-meta-description-main">
                                        <?php echo $entry_meta_description; ?>
                                    </label>
                                    <div class="col-sm-10">
                                        <textarea name="config_meta_description_main" rows="5" placeholder="<?php echo $entry_meta_description; ?>" id="input-meta-description-main" class="form-control"><?php echo $config_meta_description_main; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-meta-keywords-main">
                                        <?php echo $entry_meta_keywords; ?>
                                    </label>
                                    <div class="col-sm-10">
                                        <textarea name="config_meta_keyword_main" rows="5" placeholder="<?php echo $entry_meta_keywords; ?>" id="input-meta-keywords-main" class="form-control"><?php echo $config_meta_keyword_main; ?></textarea>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend><?php echo $text_meta_for_category; ?></legend>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-meta-title-category">
                                        <span data-toggle="tooltip" title="<?php echo $help_meta_category; ?>">
                                            <?php echo $entry_meta_title; ?>
                                        </span>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="config_meta_title_category" value="<?php echo $config_meta_title_category; ?>" placeholder="<?php echo $entry_meta_title; ?>" id="input-meta-title-category" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-meta-description-category">
                                        <span data-toggle="tooltip" title="<?php echo $help_meta_category; ?>">
                                            <?php echo $entry_meta_description; ?>
                                        </span>
                                    </label>
                                    <div class="col-sm-10">
                                        <textarea name="config_meta_description_category" rows="5" placeholder="<?php echo $entry_meta_description; ?>" id="input-meta-description-category" class="form-control"><?php echo $config_meta_description_category; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-meta-keywords-category">
                                        <span data-toggle="tooltip" title="<?php echo $help_meta_category; ?>">
                                            <?php echo $entry_meta_keywords; ?>
                                        </span>
                                    </label>
                                    <div class="col-sm-10">
                                        <textarea name="config_meta_keyword_category" rows="5" placeholder="<?php echo $entry_meta_keywords; ?>" id="input-meta-keywords-category" class="form-control"><?php echo $config_meta_keyword_category; ?></textarea>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend><?php echo $text_meta_for_product; ?></legend>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-meta-title-product">
                                        <span data-toggle="tooltip" title="<?php echo $help_meta_product; ?>">
                                            <?php echo $entry_meta_title; ?>
                                        </span>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="config_meta_title_product" value="<?php echo $config_meta_title_product; ?>"placeholder="<?php echo $entry_meta_title; ?>"id="input-meta-title-product"class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-meta-description-product">
                                        <span data-toggle="tooltip" title="<?php echo $help_meta_product; ?>">
                                            <?php echo $entry_meta_description; ?>
                                        </span>
                                    </label>
                                    <div class="col-sm-10">
                                        <textarea name="config_meta_description_product" rows="5" placeholder="<?php echo $entry_meta_description; ?>" id="input-meta-description-product" class="form-control"><?php echo $config_meta_description_product; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-meta-keywords-product">
                                        <span data-toggle="tooltip" title="<?php echo $help_meta_product; ?>">
                                            <?php echo $entry_meta_keywords; ?>
                                        </span>
                                    </label>
                                    <div class="col-sm-10">
                                        <textarea name="config_meta_keyword_product" rows="5" placeholder="<?php echo $entry_meta_keywords; ?>" id="input-meta-keywords-product" class="form-control"><?php echo $config_meta_keyword_product; ?></textarea>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset style="display:none;">
                                <legend><?php echo $text_meta_for_news; ?></legend>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-meta-title-blog">
                                        <?php echo $entry_meta_title; ?>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="config_meta_title_blog" value="<?php echo $config_meta_title_blog; ?>" placeholder="<?php echo $entry_meta_title; ?>"id="input-meta-title-blog" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-meta-description-blog">
                                        <?php echo $entry_meta_description; ?>
                                    </label>
                                    <div class="col-sm-10">
                                        <textarea name="config_meta_description_blog" rows="5" placeholder="<?php echo $entry_meta_description; ?>" id="input-meta-description-blog" class="form-control"><?php echo $config_meta_description_blog; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-meta-keywords-blog">
                                        <?php echo $entry_meta_keywords; ?>
                                    </label>
                                    <div class="col-sm-10">
                                        <textarea name="config_meta_keyword_blog" rows="5" placeholder="<?php echo $entry_meta_keywords; ?>" id="input-meta-keywords-blog" class="form-control"><?php echo $config_meta_keyword_blog; ?></textarea>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend><?php echo $text_meta_for_search; ?></legend>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-meta-title-search">
                                        <?php echo $entry_meta_title; ?>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="config_meta_title_search" value="<?php echo $config_meta_title_search; ?>" placeholder="<?php echo $entry_meta_title; ?>"id="input-meta-title-search" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-meta-description-search">
                                        <?php echo $entry_meta_description; ?>
                                    </label>
                                    <div class="col-sm-10">
                                        <textarea name="config_meta_description_search" rows="5" placeholder="<?php echo $entry_meta_description; ?>" id="input-meta-description-search" class="form-control"><?php echo $config_meta_description_search; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-meta-keywords-search">
                                        <?php echo $entry_meta_keywords; ?>
                                    </label>
                                    <div class="col-sm-10">
                                        <textarea name="config_meta_keyword_search" rows="5" placeholder="<?php echo $entry_meta_keywords; ?>" id="input-meta-keywords-search" class="form-control"><?php echo $config_meta_keyword_search; ?></textarea>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
            $('#input-privacy-policy').summernote({
                height: 300
            });
            $('#input-payment').summernote({
                height: 300
            });
            $('#input-delivery').summernote({
                height: 300
            });
            $('#input-wholesale').summernote({
                height: 300
            });
            $('#input-main').summernote({
                height: 300
            });
            $('#input-repost-discount').summernote({
                height: 300
            });
            $('#input-seo-home').summernote({
                height: 300
            });
            $('#input-seo-catalog').summernote({
                height: 300
            });
            $('#input-dilers-information').summernote({
                height: 300
            });
            $('#input-table-parameters').summernote({
                height: 300
            });
    </script>
    <script type="text/javascript"><!--
  $('select[name=\'config_template\']').on('change', function () {
            $.ajax({
                url: 'index.php?route=setting/setting/template&token=<?php echo $token; ?>&template=' + encodeURIComponent(this.value),
                dataType: 'html',
                beforeSend: function () {
                    $('select[name=\'country_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
                },
                complete: function () {
                    $('.fa-spin').remove();
                },
                success: function (html) {
                    $('#template').attr('src', html);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        });

        $('select[name=\'config_template\']').trigger('change');
        //--></script>
    <script type="text/javascript"><!--
        $('select[name=\'config_country_id\']').on('change', function () {
            $.ajax({
                url: 'index.php?route=setting/setting/country&token=<?php echo $token; ?>&country_id=' + this.value,
                dataType: 'json',
                beforeSend: function () {
                    $('select[name=\'config_country_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
                },
                complete: function () {
                    $('.fa-spin').remove();
                },
                success: function (json) {
                    html = '<option value=""><?php echo $text_select; ?></option>';

                    if (json['zone'] && json['zone'] != '') {
                        for (i = 0; i < json['zone'].length; i++) {
                            html += '<option value="' + json['zone'][i]['zone_id'] + '"';

                            if (json['zone'][i]['zone_id'] == '<?php echo $config_zone_id; ?>') {
                                html += ' selected="selected"';
                            }

                            html += '>' + json['zone'][i]['name'] + '</option>';
                        }
                    } else {
                        html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
                    }

                    $('select[name=\'config_zone_id\']').html(html);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        });

        $('select[name=\'config_country_id\']').trigger('change');
        //--></script></div>
<?php echo $footer; ?>