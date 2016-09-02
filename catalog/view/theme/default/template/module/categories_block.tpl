<div class="container-fluid products" id="all_products">
    <?php if (!empty($categories)) { ?>
        <div class="container">
            <h2><?php echo $text_choose_category; ?></h2>
            <div class="row">
                <?php foreach ($categories as $category) { ?>
                <div class="col-sm-3">
                    <div class="ih-item circle effect5">
                        <a href="<?php echo $category['href']; ?>">
                            <div class="img">
                                <img src="<?php echo $category['image']; ?>" height="263" width="263" alt="img">
                            </div>
                            <div class="info">
                                <div class="info-back">
                                    <h3><?php echo $category['name']; ?></h3>
                                    <p><?php echo $text_more; ?></p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <?php }?>
            </div>
        </div>
    <?php }?>
</div>
