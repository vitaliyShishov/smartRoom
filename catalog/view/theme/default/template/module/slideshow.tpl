<?php if (!empty($banners)) { ?>
    <div class="container-fluid slider">
        <?php foreach ($banners as $slide) { ?>
            <div class="item">
                <img src="<?php echo $slide['image']; ?>" class="img-responsive" alt="smart-room">
                <div class="banner-description">
                    <h2>smart-room</h2>
                    <span><?php echo $slide['title']; ?></span>
                    <a href="<?php echo $slide['link']; ?>" class="btn">
                        <?php echo $text_choose; ?>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } ?>