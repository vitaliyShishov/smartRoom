<?php echo $header ?>
<div class="wrapper">
    <?php echo $categories_block; ?>
    <?php echo $slideshow; ?>
    <div class="container-fluid  about-us" id="about_us">
        <?php if (!empty($information_about)) { ?>
        <div class="container">
            <div class="row">
                <h2><?php echo $information_about['title']; ?></h2>
                <?php echo $information_about['text']; ?>
            </div>
        </div>
        <?php } ?>
    </div>
    <div class="container-fluid delivery" id="delivery">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h2><?php echo $information_delivery['title']; ?></h2>
                    <img src="<?php echo $information_delivery['image']; ?>" class="img-responsive" alt="ukraine-map">
                    <?php echo $information_delivery['text']; ?>
                </div>
                <div class="col-sm-6">
                    <div class="contacts-holder">
                        <h2 class="text-center"><?php echo $text_contacts; ?></h2>
                        <ul class="contacts">
                            <?php foreach ($phones as $phone) { ?>
                            <li><?php echo $phone; ?></li>
                            <?php } ?>
                            <li><?php echo $email; ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; 

