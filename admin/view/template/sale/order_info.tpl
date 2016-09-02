<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
        <div class="pull-right">
            <a href="<?php echo $edit; ?>" 
               data-toggle="tooltip" 
               title="<?php echo $button_edit; ?>" 
               class="btn btn-primary">
                <i class="fa fa-pencil"></i>
            </a> 
            <a href="<?php echo $cancel; ?>" 
               data-toggle="tooltip" 
               title="<?php echo $button_cancel; ?>" 
               class="btn btn-default">
                <i class="fa fa-reply"></i></a>
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
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-list"></i> <?php echo $heading_title; ?>
                </h3>
            </div>
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#tab-order" data-toggle="tab"><?php echo $tab_order; ?></a>
                    </li>
                    <li>
                        <a href="#tab-product" data-toggle="tab"><?php echo $tab_product; ?></a>
                    </li>
                    <li>
                        <a href="#tab-history" data-toggle="tab"><?php echo $tab_history; ?></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-order">
                        <table class="table table-bordered">
                            <tr>
                                <td><?php echo $text_order_id; ?></td>
                                <td>#<?php echo $order_id; ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $text_customer; ?></td>
                                <td><?php echo $customer; ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $text_email; ?></td>
                                <td><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></td>
                            </tr>
                            <tr>
                                <td><?php echo $text_telephone; ?></td>
                                <td><?php echo $telephone; ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $text_total; ?></td>
                                <td><?php echo $total; ?></td>
                            </tr>
                            <?php if ($order_status) { ?>
                            <tr>
                                <td><?php echo $text_order_status; ?></td>
                                <td id="order-status"><?php echo $order_status; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if ($comment) { ?>
                            <tr>
                                <td><?php echo $text_comment; ?></td>
                                <td><?php echo $comment; ?></td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <td><?php echo $text_date_added; ?></td>
                                <td><?php echo $date_added; ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $text_date_modified; ?></td>
                                <td><?php echo $date_modified; ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="tab-pane" id="tab-product">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <td class="text-left"><?php echo $column_product; ?></td>
                                <td class="text-left"><?php echo $column_model; ?></td>
                                <td class="text-right"><?php echo $column_quantity; ?></td>
                                <td class="text-right"><?php echo $column_price; ?></td>
                                <td class="text-right"><?php echo $column_total; ?></td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($products as $product) { ?>
                                <tr>
                                    <td class="text-left">
                                        <a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                                    <?php foreach ($product['parameters'] as $parameter) { ?>
                                    <br />
                                    &nbsp;<small> - <?php echo $parameter['name']; ?>: <?php echo $parameter['value']; ?></small>
                                    <?php } ?>
                                    </td>
                                    <td class="text-left"><?php echo $product['model']; ?></td>
                                    <td class="text-right"><?php echo $product['quantity']; ?></td>
                                    <td class="text-right"><?php echo $product['price']; ?></td>
                                    <td class="text-right"><?php echo $product['total']; ?></td>
                                </tr>
                            <?php } ?>
                                <tr>
                                    <td colspan="4" class="text-right"><?php echo $text_total; ?>:</td>
                                    <td class="text-right"><?php echo $total; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="tab-history">
                        <div id="history"></div>
                        <br />
                        <fieldset>
                            <legend><?php echo $text_history; ?></legend>
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-order-status"><?php echo $entry_order_status; ?></label>
                                    <div class="col-sm-10">
                                        <select name="order_status_id" id="input-order-status" class="form-control">
                                        <?php foreach ($order_statuses as $order_status) { ?>
                                            <?php if ($order_status['order_status_id'] == $order_status_id) { ?>
                                            <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                                            <?php } else { ?>
                                            <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-comment"><?php echo $entry_comment; ?></label>
                                    <div class="col-sm-10">
                                        <textarea name="comment" rows="8" id="input-comment" class="form-control"></textarea>
                                    </div>
                                </div>
                            </form>
                            <div class="text-right">
                                <button id="button-history" 
                                        class="btn btn-primary">
                                    <i class="fa fa-plus-circle"></i> 
                                        <?php echo $button_history_add; ?>
                                </button>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('#history').delegate('.pagination a', 'click', function(e) {
                e.preventDefault();
                $('#history').load(this.href);
            });			

            $('#history').load('index.php?route=sale/order/getOrderHistory&token=<?php echo $token; ?>&order_id=<?php echo $order_id; ?>');
            
            $('#button-history').on('click', function () {
                var order_status_id = $('#input-order-status :selected').val();
                
                $.ajax({
                    url: 'index.php?route=sale/order/updateOrderHistory&token=<?php echo $token; ?>&order_id=<?php echo $order_id?> ',
                    type: 'POST',
                    data: 'order_status_id=' + order_status_id,
                    dataType: 'json',
                    success: function (json) {
                        $('#history').load('index.php?route=sale/order/getOrderHistory&token=<?php echo $token; ?>&order_id=<?php echo $order_id; ?>');
                        $('#tab-order #order-status').html(json['order_status_name']);
                    }
                });
            });
        </script>
    </div>
</div>
<?php echo $footer; ?> 
