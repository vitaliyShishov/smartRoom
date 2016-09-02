<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" 
                        onclick="$('#form_liqpay').submit();"
                        form="form-cheque" 
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
                    <li>
                        <a href="<?php echo $breadcrumb['href']; ?>">
                            <?php echo $breadcrumb['text']; ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
    <?php if ($error_warning) { ?>
        <div class="alert alert-danger">
            <i class="fa fa-exclamation-circle"></i>
            <?php echo $error_warning; ?>
        </div>
    <?php } ?>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1><img src="view/image/payment/liqpay.png" alt="" /> <?php echo $heading_title ?></h1>
        </div>
        <div class="panel-body">
            <form action="<?php echo $action ?>" 
                  method="post" 
                  class="form-horizontal"
                  enctype="multipart/form-data" 
                  id="form_liqpay">
                <table class="form" class="form-horizontal">
                    <tr>
                        <td>
                            <span class="required">*</span> <?php echo $entry_public_key ?>
                        </td>
                        <td>
                            <input type="text" name="liqpay_public_key" value="<?php echo $liqpay_public_key ?>" class="form-control" />
                            <?php if ($error_public_key) { ?>
                                <span class="text-danger">
                                    <?php echo $error_public_key ?>
                                </span>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="required">*</span> <?php echo $entry_private_key ?>
                        </td>
                        <td>
                            <input type="text" name="liqpay_private_key" value="<?php echo $liqpay_private_key ?>" class="form-control" />
                            <?php if ($error_private_key) { ?>
                                <span class="text-danger">
                                    <?php echo $error_private_key ?>
                                </span>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="required">*</span> <?php echo $entry_action ?>
                        </td>
                        <td>
                            <input type="text" name="liqpay_action" value="<?php echo $liqpay_action ?>" class="form-control" />
                            <?php if ($error_action) { ?>
                                <span class="text-danger">
                                    <?php echo $error_action ?>
                                </span>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $entry_pay_way ?></td>
                        <td>
                            <label onclick="payWay()">
                                <input type="checkbox" 
                                       value="card" 
                                       name="card" 
                                       class="pay_way"  
                                       <?php if (strpos($liqpay_pay_way, "card") !== false) { ?>
                                           checked="checked"
                                       <?php } ?> /> 
                                Карта
                            </label>
                            <label onclick="payWay()" >
                                <input type="checkbox" 
                                       value="liqpay" 
                                       name="liqpay" 
                                       class="pay_way" 
                                       <?php if (strpos($liqpay_pay_way, "liqpay") !== false) { ?>
                                           checked="checked"
                                       <?php } ?> /> 
                                Liqpay
                            </label>
                            <label onclick="payWay()">
                                <input type="checkbox" 
                                       value="delayed" 
                                       name="delayed" 
                                       class="pay_way"
                                       <?php if (strpos($liqpay_pay_way, "delayed") !== false) { ?>
                                           checked="checked"
                                       <?php } ?> /> 
                                Терминал
                            </label>
                            <label onclick="payWay()">
                                <input type="checkbox" 
                                       value="invoice" 
                                       name="invoice" 
                                       class="pay_way" 
                                       <?php if (strpos($liqpay_pay_way, "invoice") !== false) { ?>
                                           checked="checked"
                                       <?php } ?> /> 
                                Invoice
                            </label>
                            <label onclick="payWay()">
                                <input type="checkbox" 
                                       value="privat24" 
                                       name="privat24" 
                                       class="pay_way"
                                       <?php if (strpos($liqpay_pay_way, "privat24") !== false) { ?>
                                           checked="checked"
                                       <?php } ?> /> 
                                Privat24
                            </label>
                            <input type="text" id="pay_way" name="liqpay_pay_way" value="<?php echo $liqpay_pay_way ?>" hidden/>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $entry_total ?></td>
                        <td>
                            <input type="text" name="liqpay_total" value="<?php echo $liqpay_total ?>" class="form-control" />
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $entry_order_status ?></td>
                        <td>
                            <select name="liqpay_order_status_id" class="form-control">
                                <?php foreach ($order_statuses as $order_status) { ?>
                                   <?php $order_status_id = $order_status['order_status_id']; ?>
                                   <?php $sel = ($order_status_id == $liqpay_order_status_id); ?>
                                    <option 
                                        <?php if ($sel) { ?>
                                            selected="selected"
                                         <?php } ?> 
                                         value="<?php echo $order_status_id ?>">
                                        <?php echo $order_status['name'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $entry_geo_zone ?></td>
                        <td>
                            <select name="liqpay_geo_zone_id" class="form-control">
                                <option value="0"><?php echo $text_all_zones ?></option>
                                <?php foreach ($geo_zones as $geo_zone) { ?>
                                    <?php $geo_zone_id = $geo_zone['geo_zone_id']; ?>
                                    <?php $sel = ($geo_zone_id == $liqpay_geo_zone_id); ?>
                                    <option 
                                        <?php if ($sel) { ?>
                                            selected="selected"
                                        <?php } ?> 
                                        value="<?php echo $geo_zone_id ?>">
                                        <?php echo $geo_zone['name'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $entry_status ?></td>
                        <td>
                            <select name="liqpay_status" class="form-control">
                                <option 
                                    <?php if ($liqpay_status) { ?>
                                        selected="selected"
                                    <?php } ?> 
                                    value="1">
                                    <?php echo $text_enabled ?>
                                </option>
                                <option 
                                    <?php if (!$liqpay_status) { ?>
                                        selected="selected"
                                    <?php } ?> 
                                    value="0">
                                    <?php echo $text_disabled ?>
                                </option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $entry_language ?></td>
                        <td>
                            <select name="liqpay_language" class="form-control">
                                <option 
                                    <?php if ($liqpay_language == 'ru') { ?>
                                        selected="selected"
                                    <?php } ?> 
                                    value="ru">
                                    ru
                                </option>
                                <option 
                                    <?php if ($liqpay_language == 'en') { ?>
                                        selected="selected"
                                    <?php } ?> 
                                    value="en">
                                    en
                                </option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $entry_sort_order ?></td>
                        <td>
                            <input type="text" 
                                   name="liqpay_sort_order" 
                                   class="form-control"
                                   value="<?php echo $liqpay_sort_order ?>" 
                                   size="1" />
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $entry_sandbox ?></td>
                        <td>
                            <select name="liqpay_sandbox" class="form-control">
                                <option
                                    <?php if ($liqpay_sandbox == 0) { ?>
                                        selected="selected"
                                    <?php } ?>
                                    value="0">
                                    <?php echo $entry_sandbox_no ?>
                                </option>
                                <option
                                    <?php if ($liqpay_sandbox == 1) { ?>
                                        selected="selected"
                                    <?php } ?>
                                    value="1">
                                    <?php echo $entry_sandbox_yes ?>
                                </option>
                            </select>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php echo $footer ?>
<script>
    function payWay() {
        var elems = $(".pay_way:checked");
        var str = '';
        elems.each(function () {
            str += $(this).prop("name") + ',';
        })
        $("#pay_way").val(str);
    }
</script>