<div class="item-holder">
    <?php foreach ($products as $product) { ?>
        <a href="<?php echo $product['href']; ?>" class="search-item clearfix">
            <img src="<?php echo $product['image']; ?>" alt="search-image" class="pull-left">
            <div class="text-block pull-left">
                <h3><?php echo $product['name']; ?></h3>
                <span><?php echo $product['model']; ?></span>
            </div>
            <span class="price"><?php echo $product['price']; ?></span>
        </a>
    <?php } ?>
</div>
