<?php echo $header; ?>
<div class="karta_page">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-offset-1 col-lg-11">
                <h1>
                    <?php echo $product['single_name'] ?>
                    <span><?php echo $product['name']; ?></span>
                </h1>
                <div class="not_move_star">
                    <div class="yelow_line" style="width: <?php echo $product['average_rating'] . '%'; ?>">
                        <div class="star"></div>
                    </div>
                </div>
                <span class="colvo">(<?php echo $product['total_rating']; ?>)</span>
                <p class="tovar_number">
                    <?php echo $text_code; ?>
                    <span><?php echo $product['model']?></span>
                </p>
            </div> 
            <div class="col-md-6 col-lg-offset-1 col-lg-5 max-width-column">
                <div class="prev_button">
                    <i></i>
                </div>
                <div id="carousela">
                    <?php foreach ($product['images'] as $image) { ?>
                    <div class="slide_item">
                        <img src="<?php echo $image['thumb']; ?>" alt="alt" />
                    </div>
                    <?php } ?>
                </div>
                <div class="next_button">
                    <i></i>
                </div>
            </div>
            <div class="col-md-6">
                <p class="checked_tov">
                    <i></i>
                    <?php echo $product['stock_status']; ?>
                </p>
                <p>
                <?php if (isset($unit) && isset($measure)) { ?>
                    <?php echo $text_price_for ?><?php echo $measure ?><?php echo $unit?>:
                <?php } else { ?>
                    <?php echo $text_price; ?>
                <?php } ?>
                    <span class="sale_price"><?php echo $product['special']; ?></span>
                    <span class="not_sale_price"><?php echo $product['price']; ?></span>
                </p>
                <div class="col-md-6 karta_buttons">
                    <button><?php echo $button_buy; ?></button>
                    <button><?php echo $button_click; ?></button>
                    <button><?php echo $button_credit; ?></button>
                </div>
                <div class="col-md-6 after_karta_buttons">

                    <?php if ($count > 1) { ?>
                    <a href="<?php echo $compare_href; ?>"
                       class="checkbox_link">
                        <?php echo $text_compare; ?>
                    </a>
                    <?php } else { ?>
                        <a href="javascript:void(0);"
                           class="checkbox_link">
                            <?php echo $text_compare; ?>
                        </a>
                    <?php } ?>
                    <a href="javascript:void(0);"
                       class="checkbox_link_image"
                       style="display: inline-block"
                       id="addCompare<?php echo $product['product_id']; ?>"
                       onclick="general.addProductToCompare('<?php echo $product_id; ?>')">
                    </a>
                    <a href="javascript:void(0);"
                       class="checkbox_link_image checked"
                       style="display: none"
                       id="deleteCompare<?php echo $product['product_id']; ?>"
                       onclick="general.deleteProductFromCompare('<?php echo $product_id; ?>')">
                    </a>
                    <a href="javascript:void(0);" class="heart">
                        <?php echo $text_wishes; ?>
                            <i></i>
                    </a>
                </div>
            </div>
            <div class="col-md-6 padding-left-right-none">
                <a href="javascript:void(0);" class="repost">
                    <p>
                        <i></i>
                        <?php echo $text_repost_discount; ?>
                    </p>
                </a>
                    <?php echo $social_share ?>
            </div>
        </div>
    </div>
    <div class="blue_row_mnu">
        <div class="container">
            <div class="row">
                <div class="wrapper_kabinet_tabs">
                    <div class="tabs">
                        <span class="tab"><?php echo $tab_description; ?></span>
                        <span class="tab"><?php echo $tab_same_product; ?></span>
                        <span class="tab"><?php echo $tab_review; ?></span>              
                    </div>
                </div>
            </div>       
        </div>       
    </div>
    <div class="tab_content">
        <div class="container karta_page_tabs">
            <div class="tab_item">
                <div class="col-md-12 col-lg-offset-1 col-lg-10 karta_page_text">
                    <?php foreach ($product_parameters as $parameter) { ?>
                    <?php echo $parameter['name']; ?>:
                    <?php echo $parameter['value']; ?><br/>
                    <?php } ?>
                 <?php echo $product['description']; ?>
                </div>  
            </div>
            <div class="tab_item">
                <div class="row">
                    <div class="sider_karta_page">
                        <div class="col-md-1 button_prev"><i></i>
                        </div>
                        <div class="col-md-10">
                            <div id="carouselka_2">
                            <?php foreach ($same_products as $product_id => $same_product) { ?>
                                <div class="slide_item">
                                    <div class="wish_item">
                                        <img src="<?php echo $same_product['image']; ?>" alt="wish_image"/>
                                        <a href="javascript:void(0);">
                                            <?php echo $product['single_name']?> <br />
                                            <span><?php echo $same_product['name']?></span>
                                        </a>
                                        <div class="wrap_star">
                                            <div class="yelow_line"></div>
                                            <ul class="stars">
                                                <li><a class="star6" href="javascript:void(0);"></a></li>
                                                <li><a class="star7" href="javascript:void(0);"></a></li>
                                                <li><a class="star8" href="javascript:void(0);"></a></li>
                                                <li><a class="star9" href="javascript:void(0);"></a></li>
                                                <li><a class="star10" href="javascript:void(0);"></a></li>
                                            </ul>
                                        </div>
                                        <span class="colvo">(<?php echo $same_product['reviews']; ?>)</span>
                                        <div class="wish_price">
                                        <?php if ($count > 1) { ?>
                                            <a href="<?php echo $compare_href; ?>"
                                               class="checkbox_link">
                                                <?php echo $text_compare; ?>
                                            </a>
                                        <?php } else { ?>
                                            <a href="<?php echo $compare_href; ?>"
                                               class="checkbox_link">
                                                <?php echo $text_compare; ?>
                                            </a>
                                        <?php } ?>
                                            <a href="javascript:void(0);"
                                               class="checkbox_link_image"
                                               style="display: inline-block"
                                               id="addCompare<?php echo $product_id; ?>"
                                               onclick="general.addProductToCompare('<?php echo $product_id; ?>')">
                                            </a>
                                            <a href="javascript:void(0);"
                                               class="checkbox_link_image checked"
                                               style="display: none"
                                               id="deleteCompare<?php echo $product_id; ?>"
                                               onclick="general.deleteProductFromCompare('<?php echo $product_id; ?>')">
                                            </a>
                                            <p>
                                                <span><?php echo $same_product['reviews']; ?></span>
                                                <?php echo $text_review; ?>
                                            </p>
                                        </div>
                                        <div class="wish_buy">
                                            <p><?php echo $same_product['price']; ?></p>
                                            <button><?php echo $button_buy; ?></button>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-1 button_next"><i></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab_item">
                <div class="row">
                    <div class="col-md-4">
                        <h4>Оценить товар</h4>
                        <div class="wrap_star">
                            <div class="yelow_line"></div>
                            <ul class="stars">
                                <li><a href="javascript:void(0);" class="star1"></a></li>
                                <li><a href="javascript:void(0);" class="star2"></a></li>
                                <li><a href="javascript:void(0);" class="star3"></a></li>
                                <li><a href="javascript:void(0);" class="star4"></a></li>
                                <li><a href="javascript:void(0);" class="star5"></a></li>
                            </ul>
                        </div>
                        <h2><?php echo $text_write; ?></h2>
                        <form method="POST"
                              id='send_review'
                              onsubmit="general.sendReview('<?php echo $product_id ?>'); return false;"
                              class="main_form_karta">
                            <input type="hidden"
                                   name="product_review[rating]"
                                   id="rating"
                                   value="" />
                            <textarea name="product_review[text]"
                                      id="text"
                                      placeholder="<?php echo $text_message; ?>"
                                      required >
                            </textarea>
                            <button type='submit'><?php echo $button_send; ?></button>
                        </form>
                    </div>
                    <div class="col-md-8 what-said-about">
                        <div class="about_prev_button"><i></i></div>
                        <div id="carousela_2">
                        <?php foreach($product_reviews as $review) { ?>    
                            <div class="slide_item">
                                <h3>
                                    <?php echo $review['author']; ?>
                                </h3>
                                    <?php echo $review['text']; ?>
                                </div>
                        <?php } ?>
                        </div>
                        <div class="about_next_button"><i></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="backet_grey_block">
    <div class="container">
        <div class="row">
            <h2><?php echo $text_buy_with; ?></h2>
            <div class="sider_container">
                <div class="col-md-1 prev_button"><i></i>
                </div>
                <div class="col-md-10">
                    <div class="carouselka">
                    <?php if (isset($product_complects['by_product'])) { ?>
                        <?php foreach ($product_complects['by_product'] as $complect) { ?>
                        <div class="slide_item">
                            <a href="javascript:void(0);">
                                <img src="<?php echo $complect['product_image']; ?>" alt="alt" />
                                <p class="descr_slider_price"><?php echo $complect['single_name'] ?><br/>
                                    <span><?php echo $product['name']; ?></span>
                                </p>
                                <p class="slider_price">
                            <?php echo $complect['product_new_price']; ?>
                                    <span><?php echo $complect['product_old_price']; ?></span>
                                </p>
                                <div class="sale_flag"><?php echo $complect['product_discount']; ?></div>
                            </a>
                            <div class="plus"></div>
                            <a href="javascript:void(0);">
                                <img src="<?php echo $complect['bonus_product_image']; ?>" alt="alt" />
                                <p class="descr_slider_price"><?php echo $complect['single_name'] ?><br/>
                                    <span><?php echo $complect['name']; ?></span>
                                </p>
                                <p class="slider_price"><?php echo $complect['bonus_new_price']?>
                                    <span><?php echo $complect['bonus_old_price']; ?></span>
                                </p>
                                <div class="sale_flag"><?php echo $complect['bonus_discount']; ?></div>
                            </a>
                            <div class="is"></div>
                            <div class="last_child_carusel">
                                <p class="econom"><?php echo $text_economy; ?>
                                    <span><?php echo $complect['complect_discount']; ?></span>
                                </p>
                                <p class="new_price"><?php echo $complect['complect_new_price']; ?>
                                    <span><?php echo $complect['complect_old_price']; ?></span>
                                </p>
                                <button><?php echo $button_buy_complect; ?></button>
                            </div>
                        </div>
                            <?php } ?>
                        <?php } ?>
                        <?php if (isset($product_complects['by_category'])) { ?>
                            <?php foreach ($product_complects['by_category'] as $complect) { ?>
                        <div class="slide_item">
                            <a href="javascript:void(0);">
                                <img src="<?php echo $complect['product_image']; ?>" alt="alt" />
                                <p class="descr_slider_price"><?php echo $complect['single_name'] ?><br/>
                                    <span><?php echo $product['name']; ?></span>
                                </p>
                                <p class="slider_price">
                            <?php echo $complect['product_new_price']; ?>
                                    <span><?php echo $complect['product_old_price']; ?></span>
                                </p>
                                <div class="sale_flag">
                            <?php echo $complect['product_discount']; ?>
                                </div>
                            </a>
                            <div class="plus"></div>
                            <a href="javascript:void(0);">
                                <img src="<?php echo $complect['bonus_product_image']; ?>" alt="alt" />
                                <p class="descr_slider_price"><?php echo $complect['single_name'] ?><br/>
                                    <span><?php echo $complect['name']; ?></span>
                                </p>
                                <p class="slider_price">
                            <?php echo $complect['bonus_new_price']?>
                                    <span><?php echo $complect['bonus_old_price']; ?></span>
                                </p>
                                <div class="sale_flag"><?php echo $complect['bonus_discount']; ?></div>
                            </a>
                            <div class="is"></div>
                            <div class="last_child_carusel">
                                <p class="econom"><?php echo $text_economy; ?>
                                    <span><?php echo $complect['complect_discount']; ?></span>
                                </p>
                                <p class="new_price">
                            <?php echo $complect['complect_new_price']; ?>
                                    <span><?php echo $complect['complect_old_price']; ?></span>
                                </p>
                                <button><?php echo $button_buy_complect; ?></button>
                            </div>
                        </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-1 next_button"><i></i>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>