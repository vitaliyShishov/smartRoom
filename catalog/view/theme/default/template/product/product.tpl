<?php echo $header ?>

<div class="wrapper item-page">
    <div class="container-fluid breadcrumbs-holder">
        <div class="container">
            <div class="row">
                <ol class="breadcrumb">
                    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                        <li class="<?php echo isset($breadcrumb['href']) ? '' : 'active'; ?>">
                            <?php if (isset($breadcrumb['href'])) { ?>
                                <a href="<?php echo $breadcrumb['href']; ?>">
                                    <?php echo $breadcrumb['text']; ?>
                                </a>
                            <?php } else { ?>
                                <?php echo $breadcrumb['text']; ?>
                            <?php } ?>
                        </li>
                    <?php } ?>
                </ol>
            </div>
        </div>
    </div>
    <div class="container-fluid item-page-holder">
        <div class="container">
            <div class="row item-wrapper">
                <div class="col-sm-7">
                    <div class="item-slider">
                        <?php foreach ($product['images'] as $image) { ?>
                            <div class="item">
                                <img src="<?php echo $image['thumb']; ?>"
                                     class="img-responsive"
                                     alt="<?php echo $product['name']; ?>">
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-sm-5 item-description">
                    <h2><?php echo $product['model']; ?></h2>
                    <span><?php echo $product['name']; ?></span>
                    <div class="tab-item">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#description"
                                   aria-controls="description"
                                   role="tab"
                                   data-toggle="tab">
                                    <?php echo $text_description; ?>
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#characteristics"
                                   aria-controls="characteristics"
                                   role="tab"
                                   data-toggle="tab">
                                    <?php echo $text_parameters; ?>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content clearfix">
                            <div role="tabpanel" class="tab-pane active" id="description">
                                <p>
                                    <?php if ($product['description']) { ?>
                                        <?php echo $product['description']; ?>
                                    <?php } else { ?>
                                        <?php echo $text_non_description; ?>
                                    <?php } ?>
                                </p>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="characteristics">
                                <?php foreach ($parameters as $array) { ?>
                                    <ul class="col-sm-6 col-xs-12 char-list">
                                        <?php foreach ($array as $param) { ?>
                                            <li>
                                                <span><?php echo $param['name']; ?></span>
                                                <span><?php echo $param['value']; ?></span>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <a href="javascript:void(0);" class="order" id="open-order-window">
                        <?php echo $text_order; ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="order-wrapper">
        <div class="order-window">
            <span class="close-order"></span>
            <h3 class="text-uppercase text-center"><?php echo $text_order; ?></h3>
            <form id="form_callback" role="form">
                <div class="input-holder">
                    <input type="text"
                           class="form-control"
                           name="name"
                           placeholder="<?php echo $text_name; ?>">
                    <span class="error-name" id="order_error_name"><?php $error_name; ?></span>
                </div>
                <input type="hidden" name="company" value="">
                <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                <div class="input-holder">
                    <input type="text"
                           class="form-control"
                           id="order_phone"
                           name="telephone"
                           placeholder="<?php echo $text_phone; ?>">
                    <span class="error-name" id="order_error_telephone"><?php $error_phone; ?></span>
                </div>
                <a class="order text-center" onclick="saveOrder();" href="javascript:void(0);">
                    <?php echo $text_order; ?>
                </a>
            </form>
        </div>
    </div>
<?php echo $footer ?>
