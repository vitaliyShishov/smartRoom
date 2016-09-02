<?php echo $header; ?>
<div class="wrapper category-item-page">
    <div class="container-fluid breadcrumbs-holder">
        <div class="container">
            <div class="row">
                <ol class="breadcrumb">
                    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                         <?php if (isset($breadcrumb['href'])) { ?>
                            <li>
                                <a href="<?php echo $breadcrumb['href']; ?>">
                                    <?php echo $breadcrumb['text']; ?>
                                </a>
                            </li>
                        <?php } else { ?>
                            <li class="active"><?php echo $breadcrumb['text']; ?></li>
                        <?php } ?>
                    <?php } ?>
                </ol>
            </div>
        </div>
    </div>
    <div class="container-fluid category-title">
        <div class="container">
            <div class="row">
                <h2 class=""><?php echo $heading_title; ?></h2>
            </div>
        </div>
    </div>
    <div class="container-fluid category-item-holder">
        <div class="container">
            <div class="row">
                <?php if (!empty($products)) { ?>
                    <?php foreach ($products as $product) { ?>
                        <div class="col-sm-4">
                            <div class="product-holder">
                                <figure>
                                    <img src="<?php echo $product['image']; ?>"
                                         alt="<?php echo $product['name']; ?>">
                                    <figcaption>
                                        <h3><?php echo $product['name']; ?></h3>
                                        <span><?php echo $product['model']; ?></span>
                                        <a href="<?php echo $product['href']; ?>">
                                            <?php echo $text_more; ?>
                                        </a>
                                    </figcaption>
                                </figure>
                            </div>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="col-sm-12 text-center">
                        <p><?php echo $text_no_results; ?></p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php echo $footer; ?> 