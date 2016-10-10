<?php echo $header; ?>
<div class="wrapper category-item-page" ng-app="categoryPage" ng-controller="categoryController" scroll>
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
    <div class="container-fluid category-title"
         ng-init="limit = limitIncrement = <?php echo $limit; ?>;
                  init(<?php echo $products; ?>, <?php echo $filters; ?>, <?php echo $url; ?>);
                  sortArray = <?php echo $sort_array; ?>;
                  categoryId = <?php echo $category_id; ?>;">
        <div class="container">
            <div class="row">
            </div>
        </div>
    </div>
    <div class="container-fluid category-item-holder">
        <div class="container tv-sort">
            <div class="row">
                <form class="form-inline sort-wrapper">

                    <select class="form-control" filters="{{filterKey}}" ng-repeat="(filterKey, filterArray) in filters">
                        <option>{{filterArray.param_name}}</option>
                        <option data-filter-key="{{key}}" ng-repeat="(key, item) in filterArray.values">{{item.title}}</option>
                    </select>
                </form>
            </div>
        </div>
        <div class="container">
            <div class="row" ng-show="products">
                <div class="col-sm-4" ng-repeat="product in products |orderBy : 'sort_order'"  ng-show="product.flag">
                    <div class="product-holder">
                        <figure>
                            <img ng-src="{{product.image}}"
                                 alt="{{product.name}}">
                            <figcaption>
                                <h3>{{product.name}} {{product.product_kod}}</h3>
                                <span>{{product.model}}</span>
                                <a href="{{product.href}}">
                                    {{product.price}}
                                </a>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <div class="col-sm-12 text-center"  ng-show="!products">
                    <p><?php echo $text_no_results; ?></p>
                </div>
            </div>
        </div>
    </div>
<?php echo $footer;