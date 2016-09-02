<div class="container-fluid header-bottom">
    <div class="container">
        <div class="row">
            <a href="<?php echo $home; ?>" class="logo pull-left hidden-xs hidden-sm">
                <img src="<?php echo $logo_white; ?>" height="25" width="250" alt="logo">
            </a>
            <button type="button" class="navbar-toggle mobile_nav pull-left">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <ul class="nav header-nav pull-left">
                <li><a class="menuLink" href="<?php echo $home; ?>"><?php echo $text_main; ?></a></li>
                <li class="drop">
                    <a class="menuLink" href="<?php echo $products; ?>"><?php echo $text_categories; ?></a>
                    <div class="dropdown-holder">
                        <ul>
                            <?php foreach ($categories as $category) { ?>
                                <li>
                                    <a href="<?php echo $category['href']; ?>">
                                        <?php echo $category['name']; ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </li>
                <li><a class="menuLink" href="<?php echo $about_us; ?>"><?php echo $text_about_us; ?></a></li>
                <li><a class="menuLink" href="<?php echo $delivery; ?>"><?php echo $text_delivery; ?></a></li>
                <li><a class="menuLink" href="<?php echo $contacts; ?>"><?php echo $text_contacts; ?></a></li>
            </ul>
        </div>
    </div>
</div>