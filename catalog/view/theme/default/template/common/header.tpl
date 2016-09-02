<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php if ($open_graph) { ?>
    <?php foreach ($open_graph as $property => $content) { ?>
    <meta property="<?php echo $property ?>" content="<?php echo $content ?>"/>
    <?php } ?>
    <?php } ?>
    <title><?php echo $title; ?></title>
    <?php if ($description) { ?>
    <meta name="description" content="<?php echo $description; ?>"/>
    <?php } ?>
    <?php if ($keywords) { ?>
    <meta name="keywords" content="<?php echo $keywords; ?>"/>
    <?php } ?>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic&subset=latin,cyrillic'
          rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="<?php echo $icon; ?>" type="image/x-icon">
    <link href="../assets/css/ihover.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css"/>
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
    <link type="text/css" href="../assets/css/main.css" rel="stylesheet" media="screen"/>
    <link type="text/css" href="../assets/css/media.css" rel="stylesheet" media="screen"/>
    <link rel="stylesheet" type="text/css" href="http://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"/>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.8/angular.min.js"></script>
    <script type="text/javascript" src="http://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/9636700c7b.js"></script>
    <script type="text/javascript" src="../assets/js/common.js"></script>
    <script type="text/javascript" src="../assets/js/angular/app.js"></script>
    <script type="text/javascript" src="../assets/js/angular/categoryPage.js"></script>
    <script type="text/javascript" src="../assets/js/angular/categoryPageDirective.js"></script>
    <script type="text/javascript" src="../assets/js/angular/categoryPageFilter.js"></script>
    <script type="text/javascript" src="../assets/js/angular/categoryPageService.js"></script>
</head>
<body data-spy="scroll" data-target=".nav">
<!-- Start Header -->
<header>
    <div class="container header" id="home">
        <div class="row">
            <div class="col-md-3 logo-holder">
                <a href="<?php echo $home; ?>" class="logo">
                    <img src="<?php echo $logo; ?>" height="26" width="250" alt="smart-room">
                </a>
            </div>
            <div class="col-md-9 menu list-inline text-right clearfix">
                <div class="adress-phones pull-right">
                    <?php foreach ($phones as $phone) { ?>
                        <span><?php echo $phone; ?></span>
                    <?php } ?>
                </div>
                <div class="search pull-right">
                    <input id="search" onkeyup="searchAutocomplete(event);" onclick="searchAutocomplete(event);" type="text" placeholder="<?php echo $text_search_find_product; ?>">
                    <a href="javascript:void(0);" onclick="_searchButton(event);"></a>
                </div>
                <div class="search-block"></div>
            </div>
        </div>
    </div>
    <?php echo $navigation_block; ?>
</header>
<!-- End Header -->