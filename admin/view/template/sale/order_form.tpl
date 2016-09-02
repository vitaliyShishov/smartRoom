<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <a href="<?php echo $cancel; ?>" class="btn btn-default">
                    <i class="fa fa-reply"></i> 
                    <?php echo $button_cancel; ?>
                </a>
            </div>
            <h1><?php echo $heading_title; ?></h1>
            <ul class="breadcrumb">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li>
                    <a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
                </li>
            <?php } ?>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" id="order-form"action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" >
                    <ul id="order" class="nav nav-tabs nav-justified">
                        <li class="active"><a href="#tab-customer" data-toggle="tab">1. <?php echo $tab_customer; ?></a></li>
                        <li class=""><a href="#tab-cart" data-toggle="tab">2. <?php echo $tab_product; ?></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-customer">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-customer"><?php echo $entry_customer; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" name="customer" value="<?php echo $customer; ?>" placeholder="<?php echo $entry_customer; ?>" id="input-customer" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-email"><?php echo $entry_email; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" name="email" value="<?php echo $email; ?>" id="input-email" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-telephone"><?php echo $entry_telephone; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" name="telephone" value="<?php echo $telephone; ?>" id="input-telephone" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-cart">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td class="text-left"><?php echo $column_product; ?></td>
                                            <td class="text-left"><?php echo $column_model; ?></td>
                                            <td class="text-right"><?php echo $column_quantity; ?></td>
                                            <td class="text-right"><?php echo $column_price; ?></td>
                                            <td class="text-right"><?php echo $column_total; ?></td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody id="cart">
                                    <?php $product_row = 0; ?>
                                    <?php if ($order_products) { ?>
                                        <?php foreach ($order_products as $order_product) { ?>
                                        <tr id="row_<?php echo $product_row; ?>" class="row_product product_<?php echo $order_product['product_id']; ?>">
                                            <td class="text-left"><?php echo $order_product['name']; ?><br />
                                                <input type="hidden" name="products[<?php echo $product_row; ?>][name]" value="<?php echo $order_product['name']; ?>" />
                                                <input type="hidden" name="products[<?php echo $product_row; ?>][product_id]" value="<?php echo $order_product['product_id']; ?>" />
                                            <?php foreach ($order_product['parameters'] as $parameter) { ?>
                                                - <small><?php echo $parameter['name']; ?>: <?php echo $parameter['value']; ?></small><br />
                                            <?php } ?>
                                            </td>
                                            <td class="text-left">
                                                <?php echo $order_product['model']; ?>
                                                <input type="hidden" name="products[<?php echo $product_row; ?>][model]" value="<?php echo $order_product['model']; ?>" />
                                            </td>
                                            <td class="text-right">
                                                <input type="number"
                                                       id="product-quantity<?php echo $product_row; ?>" 
                                                       name="products[<?php echo $product_row; ?>][quantity]" 
                                                       onchange="changeQuantity('<?php echo $product_row; ?>', '<?php echo $order_product['product_id']; ?>')"
                                                       value="<?php echo $order_product['quantity']; ?>" />
                                            </td>
                                            <td class="text-right" id="product-price<?php echo $product_row; ?>" >
                                                <?php echo $order_product['price']; ?>
                                                <input type="hidden" name="products[<?php echo $product_row; ?>][price]" value="<?php echo $order_product['price']; ?>" />
                                            </td>
                                            <td class="text-right" id="product-total<?php echo $order_product['product_id']; ?>">
                                                <?php echo $order_product['total']; ?>
                                            </td>
                                            <input type="hidden" 
                                                   id="hidden-product-total<?php echo $product_row; ?>" 
                                                   name="products[<?php echo $product_row; ?>][total]" 
                                                   value="<?php echo $order_product['total']; ?>" />
                                            <td class="row_product">
                                                <a class="btn btn-danger"
                                                        onclick="removeProduct('<?php echo $product_row; ?>', '<?php echo $order_product['product_id']; ?>')">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php $product_row++; ?>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <tr id="no-result">
                                            <td class="text-center" colspan="6"><?php echo $text_no_results; ?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="text-right" colspan="5"><?php echo $text_total; ?></td>
                                            <td class="text-right" id="total">
                                                <?php echo $total; ?>
                                            </td>
                                            <input type="hidden" name="total" id="hidden-total" value="<?php echo $total; ?>"/>
                                            <input type="hidden" name="order_status_id" value="<?php echo $order_status_id?>"/>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-product">
                                    <fieldset>
                                        <legend><?php echo $text_product; ?></legend>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="input-product"><?php echo $entry_product; ?></label>
                                            <div class="col-sm-10">
                                                <input type="text" name="product" value="" id="input-product" class="form-control" />
                                                <input type="hidden" name="product_id" value="" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="input-quantity"><?php echo $entry_quantity; ?></label>
                                            <div class="col-sm-10">
                                                <input type="text" name="quantity" value="1" id="input-quantity" class="form-control" />
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="text-right">
                                        <button type="button" 
                                                onclick="addProduct()"
                                                class="btn btn-primary">
                                            <i class="fa fa-plus-circle"></i> <?php echo $button_product_add; ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-sm-12 text-right">
                                    <button type="button" id="button-submit" class="btn btn-primary"><i class="fa fa-arrow-right"></i> Сохранить</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            if($('#tab-payment #input-shipping-method :selected').val() == 1) {
                $('#tab-payment #shipping-city').show();
                $('#tab-payment #shipping-warehouse').show();
            } else {
                $('#tab-payment #shipping-city').hide();
                $('#tab-payment #shipping-warehouse').hide();
            }                
        });
  
        $('#button-submit').on('click', function() {
            $('#order-form').submit();
        });
  
        $('#tab-product input[name=\'product\']').autocomplete({
            'source': function (request, response) {
                $.ajax({
                    url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' + encodeURIComponent(request),
                    dataType: 'json',
                    success: function (json) {
                        response($.map(json, function (item) {
                            return {
                                label: item['name'],
                                value: item['product_id']
                            }
                        }));
                    }
                });
            },
            'select': function (item) {
                $('#tab-product input[name=\'product\']').val(item['label']);
                $('#tab-product input[name=\'product_id\']').val(item['value']);
            }
        });
            
        $('#tab-payment #input-shipping-city').autocomplete({
            'source': function (request, response) {
                $.ajax({
                    url: 'index.php?route=module/novaposhta&token=<?php echo $token; ?>&city_name=' + encodeURIComponent(request),
                    dataType: 'json',
                    success: function (json) {
                        response($.map(json, function (item) {
                            return {
                                label: item,
                                value: item
                            };
                        }));
                    }
                });
            },
            'select': function (cities) {
                $('#tab-payment #input-shipping-city').val(cities['label']);
                getWarehouses(cities['value']);        
            }
            
        });
        
        /**
         * Функция для получения списка складов Новой почты
         * 
         * @author Vitaliy Shishov <shishovit@gmail.com>
         */
        function getWarehouses(name) {    
            var html;
            
            if ($("#input-shipping-method").val() == 1) {
                    $.ajax({
                        type: 'POST',
                        url: 'index.php?route=module/novaposhta/getWarehouses&token=<?php echo $token; ?>',
                        data: {
                            ref: name
                        },
                        success: function (json) {
                            $('#tab-payment #input-shipping-warehouse').removeAttr('disabled');
                            for (var i = 0; i < json.length; i++) {
                                 html = '<option value="' + json[i] + '">' + json[i] + '</option>';
                                 $('#tab-payment #input-shipping-warehouse').append(html);
                            }
                        }
                    });
            }
        }
        
        var product_row = <?php echo $product_row; ?>;

        /**
         * Функция для добавления товара в заказ
         * 
         * @author Vitaliy Shishov <shishovit@gmail.com>
         */
        function addProduct() {
            $.ajax({
                url: 'index.php?route=sale/order/getProductInfoForOrder&token=<?php echo $token; ?>',
                type: 'post',
                data: $('#tab-product input[name=\'product_id\'], #tab-product input[name=\'quantity\'], #tab-product input[name^=\'option\'][type=\'text\'], #tab-product input[name^=\'option\'][type=\'hidden\'], #tab-product input[name^=\'option\'][type=\'radio\']:checked, #tab-product input[name^=\'option\'][type=\'checkbox\']:checked, #tab-product select[name^=\'option\'], #tab-product textarea[name^=\'option\']'),
                dataType: 'json',
                success: function (json) {
                    if ($('#cart .row_product').length < 1) {
                        $('#cart #no-result').remove();
                    }
                    
                    if ($('#cart .product_' + json['product_id'] + '').length == 1) {
                        var temp_total = parseInt($('#tab-cart #total').text());
                        var temp_product_total = parseInt($('#tab-cart #product-total' + json['product_id'] + '').text());
                        var temp_total_new = temp_total - temp_product_total;
                    
                        $('#tab-cart #total').html('' + temp_total_new + ' грн.');
                        $('#tab-cart #hidden-total').val(temp_total_new);
                        $('#cart .product_' + json['product_id'] + '').remove();
                    }
                    
                    html = '<tr id="row_' + product_row + '" class="row_product product_' + json['product_id'] + '">';
                    html += '    <td class="text_left">' + json['name'] + '<br />';
                    html += '        <input type="hidden" name="products[' + product_row + '][name]" value="' + json['name'] + '" />';
                    html += '        <input type="hidden" name="products[' + product_row + '][product_id]" value="' + json['product_id'] + '" />';
                    for (var i = 0; i < json.parameters.length; i++) {
                        html += '        - <small>' + json.parameters[i] + '</small><br />';
                    }
                    html += '    </td>';
                    html += '    <td class="text-left">' + json['model'] + '</td>';
                    html += '        <input type="hidden" name="products[' + product_row + '][model]" value="' + json['model'] + '" />';
                    html += '    <td class="text-right">';
                    html += '        <input type="number" name="products[' + product_row + '][quantity]" id="product-quantity' + product_row + '" onchange="changeQuantity(' + product_row + ', ' + json['product_id'] + ')" value="' + json['quantity'] + '" />';
                    html += '    </td>';
                    html += '    <td class="text-right" id="product-price' + product_row + '" name="products[' + product_row + '][price]">' + json['price'] + '</td>';
                    html += '        <input type="hidden" name="products[' + product_row + '][price]" value="' + parseInt(json['price']) + '" />';
                    html += '    <td class="text-right" id="product-total' + json['product_id'] + '" name="products[' + product_row + '][total]">' + json['total'] + '</td>';
                    html += '        <input type="hidden" id="hidden-product-total' + product_row +'" name="products[' + product_row + '][total]" value="' + parseInt(json['total']) + '" />';
                    html += '    <td><button class="btn btn-danger" onclick="removeProduct(\'' + product_row + '\', ' + json['product_id'] + ')" data-toggle="tooltip"><i class="fa fa-trash-o"></i></button></td>';
                    html += '</tr>';

                    $('#cart').append(html);
                    
                    var total = parseInt($('#tab-cart #total').text());
                    var product_total = parseInt(json['total']);
                    var total_new = total + product_total;
                    
                    $('#tab-cart #total').html('' + total_new + ' грн.');
                    $('#tab-cart #hidden-total').val(total_new);
                    $('#tab-product input[name=\'product\']').val('');
                    $('#tab-product input[name=\'product_id\']').val('');

                    product_row++;
                }
            });
        };
        
        $('#tab-payment #input-shipping-method').on('change', function () {
            if ($('#tab-payment #input-shipping-method').val() == 1) {
                $('#tab-payment #shipping-city').show();
                $('#tab-payment #shipping-warehouse').show();
            } else {
                $('#tab-payment #shipping-city').hide();
                $('#tab-payment #shipping-warehouse').hide();
            }
        });
        
        /**
         * Функция для смены кол-ва единиц товара
         * 
         * @author Vitaliy Shishov <shishovit@gmail.com>
         */
        function changeQuantity (product_row, product_id) {
            var quantity = $('#tab-cart #product-quantity' + product_row + '').val();
            var price = parseInt($('#tab-cart #product-price' + product_row + '').text());
            var total_product_temp = parseInt($('#tab-cart #product-total' + product_id + '').text());
            var total = parseInt($('#tab-cart #total').text());

            var product_total = quantity * price;
            var total_temp = total - total_product_temp;
            var total_new = total_temp + product_total;

            $('#tab-cart #total').html('' + total_new + ' грн.');
            $('#tab-cart #hidden-total').val(total_new);
            $('#tab-cart #product-total' + product_id + '').html(''+ product_total +' грн.');
            $('#tab-cart #hidden-product-total' + product_row + '').val(product_total);
            
        };
        
        /**
         * Функция для удаления товара из заказа
         * 
         * @author Vitaliy Shishov <shishovit@gmail.com>
         */
        function removeProduct (product_row, product_id) {
            var html_no_result;
            
            var total_product = parseInt($('#tab-cart #product-total' + product_id + '').text());
            var total = parseInt($('#tab-cart #total').text());
            var total_new = total - total_product;
            
            $('#tab-cart #total').html('' + total_new + ' грн.');
            $('#tab-cart #hidden-total').val(total_new);
            $('#cart .product_' + product_id + '').remove();
            
            if ($('#tab-cart .row_product').length < 1) {
                html_no_result =  '<tr id="no-result">';
                html_no_result += '<td class="text-center" colspan="6"><?php echo $text_no_results; ?></td>';
                html_no_result += '</tr>';
                
                $('#tab-cart #cart').html(html_no_result);
            };
        };

    </script>
</div>
<?php echo $footer; ?>