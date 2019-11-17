<!DOCTYPE html>
<html>
    <head>
        <title>
            <?php
            $web = new Configweb_model();
            echo $web->get_webname();
            ?>
        </title>
        <meta charset="utf-8" />
        <meta name="description" content="" />
        <meta name="keywords" content="kstudio,KSTUDIO,kstudiothai,เครื่องเสียง,หูฟัง,ลำโพง" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i,900,900i" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl; ?>/themes/kstudio/css/main.css" />
        <style>
            #lisubmenu{
                border-bottom:solid 1px #eeeeee;
            }
            #ulmenu{
                box-shadow:none;border:1px solid #eeeeee;border-bottom:none;
            }

        </style>
        <?php
        $productModel = new Product();
        $lastProduct = $productModel->_get_last_product();
        $bestProduct = $productModel->_get_best_product();
        $saleProduct = $productModel->_get_sale_products();

        $articleModel = new Article();
        $NewsBlog = $articleModel->Get_article_limit(3);
        $articleCategory = Articlecategory::model()->findAll("active=:active", array(":active" => "1"));
        $Banner = Banner::model()->findAll("status=:status", array(":status" => "1"));

        $ContactModel = new Contact();
        $Contact = $ContactModel->gat_contact();
        ?>
    </head>
    <body class="animsition animsition">
        <?php
        $Categorys = Category::model()->findAll();
        ?>
        <div class="home-1" id="page">
            <nav id="menu">
                <ul>
                    <li>
                        <a href="">Home</a>
                    </li>
                    <li>
                        <a class="active" href="" >Shop</a>
                        <ul>

                            <?php
                            foreach ($Categorys as $rsCategory):
                                $Types = ProductType::model()->findAll("category=:id", array(":id" => $rsCategory['id']));
                                if (count($Types) <= 0) {
                                    ?>
                                    <li>
                                        <a href=""><?php echo $rsCategory['categoryname'] ?></a>
                                    </li>
                                <?php } else { ?>
                                    <li>
                                        <a href=""><?php echo $rsCategory['categoryname'] ?></a>
                                        <ul>
                                            <?php
                                            foreach ($Types as $rsTypes):
                                                $sqlGetBrand = "select b.id,b.brandname from product p inner join brand b ON p.brand = b.id where p.type_id = '" . $rsTypes['type_id'] . "' group by brand";
                                                $Brands = Yii::app()->db->createCommand($sqlGetBrand)->queryAll();
                                                if (count($Brands) <= 0) {
                                                    ?>
                                                    <li>
                                                        <a href=""><?php echo $rsTypes['type_name'] ?></a>
                                                    </li>
                                                <?php } else { ?>
                                                    <li>
                                                        <a href=""><?php echo $rsTypes['type_name'] ?></a>
                                                        <ul>
                                                            <?php foreach ($Brands as $rsBrand): ?>
                                                                <li><a href=""><?php echo $rsBrand['brandname'] ?></a></li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </li>
                                                <?php } ?>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                <?php } ?>
                            <?php endforeach; ?>

                        </ul>
                    </li>
                    <li>
                        <a href="">BRAND</a>
                        <?php $BrandsMenu = Brand::model()->findAll() ?>
                        <ul>
                            <?php foreach ($BrandsMenu as $rsBrandMenu): ?>
                                <li id="lisubmenu"><a href=""><?php echo $rsBrandMenu['brandname'] ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li>
                        <a href="">BLOG</a>
                        <ul>
                            <?php foreach ($articleCategory as $articleCategorys): ?>
                                <li>
                                    <a href="blog.html"><?php echo $articleCategorys['category'] ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li>
                        <a href="">About</a>
                    </li>
                    <li>
                        <a href="">Contact</a>
                    </li>

                </ul>
            </nav>
            <header class="header-style-1" style="background:#ffffff;"><!-- /images/bgheader.png-->
                <div class="container" id="menuBar">
                    <div class="row">
                        <div class="header-1-inner">
                            <a class="brand-logo animsition-link" href="index.html">
                                <img class="img-responsive" src="<?php echo Yii::app()->baseUrl; ?>/uploads/logo/<?php echo $web->get_logoweb(); ?>" alt="" style="max-height: 52px;"/>
                            </a>
                            <nav>
                                <ul class="menu hidden-xs">
                                    <li>
                                        <a href="index.html">Home</a>
                                    </li>
                                    <li>
                                        <a class="active" href="shop.html" >Shop <i class="fa fa-angle-down"></i></a>
                                        <ul id="ulmenu">

                                            <?php
                                            foreach ($Categorys as $rsCategory):
                                                $Types = ProductType::model()->findAll("category=:id", array(":id" => $rsCategory['id']));
                                                if (count($Types) <= 0) {
                                                    ?>
                                                    <li id="lisubmenu">
                                                        <a href="shop.html"><?php echo $rsCategory['categoryname'] ?></a>
                                                    </li>
                                                <?php } else { ?>
                                                    <li id="lisubmenu">
                                                        <a href="shop.html"><?php echo $rsCategory['categoryname'] ?> <i class="fa fa-angle-right" style="right:10px; top:20px; position:absolute;"></i></a>
                                                        <ul id="ulmenu">
                                                            <?php
                                                            foreach ($Types as $rsTypes):
                                                                $sqlGetBrand = "select b.id,b.brandname from product p inner join brand b ON p.brand = b.id where p.type_id = '" . $rsTypes['type_id'] . "' group by brand";
                                                                $Brands = Yii::app()->db->createCommand($sqlGetBrand)->queryAll();
                                                                if (count($Brands) <= 0) {
                                                                    ?>
                                                                    <li id="lisubmenu">
                                                                        <a href="shop-detail.html"><?php echo $rsTypes['type_name'] ?></a>
                                                                    </li>
                                                                <?php } else { ?>
                                                                    <li id="lisubmenu">
                                                                        <a href="shop-detail.html"><?php echo $rsTypes['type_name'] ?> <i class="fa fa-angle-right" style="right:10px; top:20px; position:absolute;"></i></a>
                                                                        <ul id="ulmenu">
                                                                            <?php foreach ($Brands as $rsBrand): ?>
                                                                                <li id="lisubmenu"><a href=""><?php echo $rsBrand['brandname'] ?></a></li>
                                                                            <?php endforeach; ?>
                                                                        </ul>
                                                                    </li>
                                                                <?php } ?>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </li>
                                                <?php } ?>
                                            <?php endforeach; ?>

                                        </ul>
                                    </li>

                                    <li>
                                        <a href="">BRAND <i class="fa fa-angle-down"></i></a>

                                        <ul id="ulmenu">
                                            <?php foreach ($BrandsMenu as $rsBrandMenu): ?>
                                                <li id="lisubmenu"><a href=""><?php echo $rsBrandMenu['brandname'] ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="">BLOG <i class="fa fa-angle-down"></i></a>
                                        <ul id="ulmenu">
                                            <?php foreach ($articleCategory as $articleCategorys): ?>
                                                <li id="lisubmenu">
                                                    <a href="blog.html"><?php echo $articleCategorys['category'] ?></a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="">Contact</a>
                                    </li>
                                    <li>
                                        <a href="">About</a>
                                    </li>

                                </ul>
                            </nav>
                            <aside class="right">
                                <!--
                                <div class="widget widget-control-header">
                                    <div class="select-custom-wrapper">
                                        <select class="no-border">
                                            <option>USD</option>
                                            <option>VND</option>
                                            <option>EUR</option>
                                            <option>JPY</option>
                                        </select>
                                    </div>
                                </div>
                                -->
                                <div class="widget widget-control-header widget-search-header">
                                    <a class="control btn-open-search-form js-open-search-form-header" href="#">
                                        <span class="lnr lnr-magnifier"></span>
                                    </a>
                                    <div class="form-outer">
                                        <button class="btn-close-form-search-header js-close-search-form-header">
                                            <span class="lnr lnr-cross"></span>
                                        </button>
                                        <form>
                                            <input placeholder="Search" />
                                            <button class="search">
                                                <span class="lnr lnr-magnifier"></span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <!--
                                <div class="widget widget-control-header widget-shop-cart js-widget-shop-cart">
                                    <a class="control" href="shop-cart.html">
                                        <p class="counter">0</p>
                                        <span class="lnr lnr-cart"></span>
                                    </a>
                                </div>
                                -->
                                <div class="widget widget-control-header hidden-lg hidden-md hidden-sm">
                                    <a class="navbar-toggle js-offcanvas-has-events" type="button" href="#menu">
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </a>
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </header>
            <div class="banner banner-image-fit-screen">
                <div class="rev_slider slider-home-1" id="slider_1" style="display:none">
                    <ul>
                        <?php foreach ($Banner as $baners): ?>
                            <li>
                                <img class="rev-slidebg" src="<?php echo Yii::app()->baseUrl; ?>/uploads/banner/<?php echo $baners['banner_images'] ?>" alt="demo" data-bgposition="center center">
                                <?php if (isset($baners['title'])) { ?>
                                    <div class="tp-caption" data-x="center" data-y="center" data-voffset="['-100','-100','-140','-140']" data-transform_in="y:-80px;opacity:0;s:800;e:easeInOutCubic;" data-transform_out="y:-80px;opacity:0;s:300;" data-start="1000">
                                        <h2 style="color:<?php echo $baners['color'] ?>;"><?php echo $baners['title'] ?></h2>
                                    </div>
                                <?php } ?>
                                <?php if (isset($baners['detail'])) { ?>
                                    <div class="tp-caption" data-x="center" data-y="center" data-voffset="['20','20','40','40']" data-width="['650','550','480','320']" data-whitespace="normal" data-transform_in="y:80px;opacity:0;s:800;e:easeInOutCubic;" data-transform_out="y:80px;opacity:0;s:300;"
                                         data-start="1400">
                                        <h4 style="color:<?php echo $baners['color'] ?>; text-align:center;"><?php echo $baners['detail'] ?></h4>
                                    </div>
                                <?php } ?>
                                <?php
                                if (!$baners['link']) {
                                    $style = "style='display:none;'";
                                } else {
                                    $style = "";
                                }
                                ?>
                                <div class="tp-caption" data-x="center" data-y="center" data-voffset="['120','120','200','200']" data-transform_in="y:100px;opacity:0;s:800;e:easeInOutCubic;" data-transform_out="y:200px;opacity:0;s:300;" data-start="1600" <?php echo $style ?>>

                                    <a class="btn btn-brand pill" href="http://<?php echo $baners['link'] ?>" target="_blank" style="color:#ffffff;">SHOP NOW</a>

                                </div>

                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="heading-wrapper text-center">
                <h3 class="heading" style=" margin-bottom: 0px;">SHOP BY CATEGORY</h3>
            </div>
            <section class="boxed-sm">
                <div class="container">
                    <div class="row">
                        <div class="product-category-grid-style-1" style=" padding-bottom: 30px;">
                            <div class="row">
                                <?php
                                foreach ($Categorys as $Category):
                                    $CountProductInCat = $productModel->countProductCategory($Category['id']);
                                    ?>
                                    <div class="col-sm-4 col-xs-4">
                                        <a href="#">
                                            <figure class="product-category-item">
                                                <div class="thumbnails">
                                                    <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/category/<?php echo $Category['icons'] ?>" alt="" class="img img-responsive"/>
                                                </div>
                                                <figcaption style=" background:#91b376;">
                                                    <h3 class="font-supermarket"><?php echo $Category['categoryname'] ?> <?php echo $CountProductInCat ?> Items</h3>
                                                </figcaption>
                                            </figure>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <section class="boxed-sm">
                <div class="container">
                    <div class="product-filter-home-2-wraper">
                        <div class="js-product-filter-home-2 product-filter-home-2 text-center">
                            <div class="product-filter-home-2-inner">
                                <h4 class="filter-title is-checked" data-filter=".Newproduct">New Products</h4>
                                <h4 class="filter-title" data-filter=".Bsetproduct">Best Sellers</h4>
                                <h4 class="filter-title" data-filter=".Saleproduct">Sales Products</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row js-product-masonry-filter-layout-2 product-masonry-filter-layout-2">
                        <div class="grid-sizer"></div>
                        <?php
                        foreach ($lastProduct as $rsProduct):
                            $img_title = $productModel->firstpictures($rsProduct['product_id']);
                            if (!empty($img_title)) {
                                $img = "uploads/product/thumbnail/480-" . $img_title;
                            } else {
                                $img = "images/No_image_available.jpg";
                            }
                            ?>
                            <figure class="item Newproduct">
                                <div class="product product-style-3" style=" background: #f1f2f4;">
                                    <div class="img-wrapper" style="border:none;">
                                        <a href="">
                                            <span class="label label-success font-supermarket" style=" position: absolute;top: 20px;left: 0px; font-size: 14px; border-radius: 0px;">New</span>
                                            <!--
                                            <img class="img-responsive" src="<?php //echo Yii::app()->baseUrl;                    ?>/themes/kstudio/images/product/010.jpg" alt="product thumbnail">
                                            -->
                                            <img class="img-responsive" src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $img ?>" alt="product thumbnail" />
                                        </a>
                                        <div class="product-control-wrapper bottom-right">
                                            <div class="wrapper-control-item">
                                                <a class="js-quick-view" href="#" type="button" data-toggle="modal" data-target="#quick-view-product">
                                                    <span class="lnr lnr-eye"></span>
                                                </a>
                                            </div>
                                            <div class="wrapper-control-item item-wish-list">
                                                <a class="js-wish-list js-notify-add-wish-list" href="#">
                                                    <span class="lnr lnr-heart"></span>
                                                </a>
                                            </div>
                                            <div class="wrapper-control-item item-add-cart js-action-add-cart">
                                                <a class="animate-icon-cart" href="https://www.messenger.com/t/kstudiothai" target="_blank">
                                                    <span class="lnr lnr-cart"></span>
                                                </a>
                                                <svg x="0px" y="0px" width="36px" height="32px" viewbox="0 0 36 32">
                                                <path stroke-dasharray="19.79 19.79" fill="none" , stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M9,17l3.9,3.9c0.1,0.1,0.2,0.1,0.3,0L23,11"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <figcaption class="desc">
                                        <h4 class="font-supermarket">
                                            <a class="product-name" style="color:#5c5c5c;" href=""><?php echo $rsProduct['product_name'] ?></a>
                                        </h4>
                                        <span class="price" style="color:#000000;"><?php echo number_format($rsProduct['product_price']) ?>.-</span>
                                    </figcaption>
                                </div>
                            </figure>
                        <?php endforeach; ?>

                        <?php
                        foreach ($bestProduct as $rsBestProduct):
                            $img_besttitle = $productModel->firstpictures($rsBestProduct['product_id']);
                            if (!empty($img_besttitle)) {
                                $imgBest = "uploads/product/thumbnail/480-" . $img_besttitle;
                            } else {
                                $imgBest = "images/No_image_available.jpg";
                            }
                            ?>
                            <figure class="item Bsetproduct">
                                <div class="product product-style-3" style=" background: #f1f2f4;">
                                    <div class="img-wrapper" style="border:none;">
                                        <a href="">
                                            <span class="label label-danger font-supermarket" style=" position: absolute;top: 20px;left: 0px; font-size: 14px; border-radius: 0px;">Hot</span>
                                            <!--
                                            <img class="img-responsive" src="<?php //echo Yii::app()->baseUrl;                    ?>/themes/kstudio/images/product/010.jpg" alt="product thumbnail">
                                            -->
                                            <img class="img-responsive" src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $imgBest ?>" alt="product thumbnail" />
                                        </a>
                                        <div class="product-control-wrapper bottom-right">
                                            <div class="wrapper-control-item">
                                                <a class="js-quick-view" href="#" type="button" data-toggle="modal" data-target="#quick-view-product">
                                                    <span class="lnr lnr-eye"></span>
                                                </a>
                                            </div>
                                            <div class="wrapper-control-item item-wish-list">
                                                <a class="js-wish-list js-notify-add-wish-list" href="#">
                                                    <span class="lnr lnr-heart"></span>
                                                </a>
                                            </div>
                                            <div class="wrapper-control-item item-add-cart js-action-add-cart">
                                                <a class="animate-icon-cart" href="https://www.messenger.com/t/kstudiothai" target="_blank">
                                                    <span class="lnr lnr-cart"></span>
                                                </a>
                                                <svg x="0px" y="0px" width="36px" height="32px" viewbox="0 0 36 32">
                                                <path stroke-dasharray="19.79 19.79" fill="none" , stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M9,17l3.9,3.9c0.1,0.1,0.2,0.1,0.3,0L23,11"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <figcaption class="desc">
                                        <h4 class="font-supermarket">
                                            <a class="product-name" style="color:#5c5c5c;" href=""><?php echo $rsBestProduct['product_name'] ?></a>
                                        </h4>
                                        <span class="price" style="color:#000000;"><?php echo number_format($rsBestProduct['product_price']) ?>.-</span>
                                    </figcaption>
                                </div>
                            </figure>
                        <?php endforeach; ?>
                        <?php
                        foreach ($saleProduct as $rsSaleProduct):
                            $img_saletitle = $productModel->firstpictures($rsSaleProduct['product_id']);
                            if (!empty($img_saletitle)) {
                                $imgSale = "uploads/product/thumbnail/480-" . $img_saletitle;
                            } else {
                                $imgSale = "images/No_image_available.jpg";
                            }
                            ?>
                            <figure class="item Saleproduct">
                                <div class="product product-style-3" style=" background: #f1f2f4;">
                                    <div class="img-wrapper" style="border:none;">
                                        <a href="">
                                            <span class="label label-warning font-supermarket" style=" position: absolute;top: 20px;left: 0px; font-size: 14px; border-radius: 0px;">10 %</span>
                                            <!--
                                            <img class="img-responsive" src="<?php //echo Yii::app()->baseUrl;                    ?>/themes/kstudio/images/product/010.jpg" alt="product thumbnail">
                                            -->
                                            <img class="img-responsive" src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $imgSale ?>" alt="product thumbnail" />
                                        </a>
                                        <div class="product-control-wrapper bottom-right">
                                            <div class="wrapper-control-item">
                                                <a class="js-quick-view" href="#" type="button" data-toggle="modal" data-target="#quick-view-product">
                                                    <span class="lnr lnr-eye"></span>
                                                </a>
                                            </div>
                                            <div class="wrapper-control-item item-wish-list">
                                                <a class="js-wish-list js-notify-add-wish-list" href="#">
                                                    <span class="lnr lnr-heart"></span>
                                                </a>
                                            </div>
                                            <div class="wrapper-control-item item-add-cart js-action-add-cart">
                                                <a class="animate-icon-cart" href="https://www.messenger.com/t/kstudiothai" target="_blank">
                                                    <span class="lnr lnr-cart"></span>
                                                </a>
                                                <svg x="0px" y="0px" width="36px" height="32px" viewbox="0 0 36 32">
                                                <path stroke-dasharray="19.79 19.79" fill="none" , stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M9,17l3.9,3.9c0.1,0.1,0.2,0.1,0.3,0L23,11"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <figcaption class="desc">
                                        <h4 class="font-supermarket">
                                            <a class="product-name" style="color:#5c5c5c;" href=""><?php echo $rsSaleProduct['product_name'] ?></a>
                                        </h4>
                                        <span class="price" style="color:#000000;"><?php echo number_format($rsSaleProduct['product_price']) ?>.-</span>
                                    </figcaption>
                                </div>
                            </figure>
                        <?php endforeach; ?>

                    </div>
                </div>
            </section>
            <!-- Slide Brands -->
            <div class="main">
                <div class="container-fluid">
                    <div class="relate-product">
                        <div class="heading-wrapper text-center">
                            <h3 class="heading">SHOP BY BRAND</h3>
                        </div>
                        <div class="row">
                            <div class="carousel-product">
                                <?php
                                $sqlBradProduct = "select t.brandname,p.product_id from product p inner join brand t on p.brand = t.id group by p.brand ";
                                $resultBrand = Yii::app()->db->createCommand($sqlBradProduct)->queryAll();
                                foreach ($resultBrand as $rsBrands):
                                    $img_brand = $productModel->firstpictures($rsBrands['product_id']);
                                    if (!empty($img_brand)) {
                                        $imgBrans = "uploads/product/thumbnail/600-" . $img_brand;
                                    } else {
                                        $imgBrans = "images/No_image_available.jpg";
                                    }
                                    ?>
                                    <div class="item">
                                        <figure class="item">
                                            <div class="product product-style-1">
                                                <div class="img-wrapper">
                                                    <div style=" position: absolute;z-index:10; width:100%; bottom: 0px; right: 0px; text-align:center; font-size: 30px; background: url('<?php echo Yii::app()->baseUrl; ?>/images/bgheader.png');" class="font-supermarket"><?php echo $rsBrands['brandname'] ?></div>
                                                    <a href="">
                                                        <!-- themes/kstudio/images/product/01.jpg -->
                                                        <img class="img-responsive" src="<?= Yii::app()->baseUrl; ?>/<?php echo $imgBrans ?>" alt="product thumbnail">
                                                    </a>
                                                </div>
                                            </div>
                                        </figure>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--
            <div class="call-to-action-style-1">
                <img class="rellax bg-overlay" src="<?php //echo Yii::app()->baseUrl;       ?>/themes/kstudio/images/call-to-action/1.jpg" alt="" />
                <div class="overlay-call-to-action"></div>
                <div class="container">
                    <div class="row">
                        <p class="h3">Orchid Food</p>
                        <h2>Healthy - Fresh - Delicious.</h2>
                        <a class="btn btn-brand pill" href="#">VIEW MORE </a>
                    </div>
                </div>
            </div>
            -->
            <section class="boxed-sm">
                <div class="container">
                    <div class="heading-wrapper text-center">
                        <h3 class="heading">The Blog</h3>
                    </div>
                    <div class="row">
                        <div class="row blog-h reverse flex one-row multi-row-sm">
                            <?php foreach ($NewsBlog as $rsblog): ?>
                                <div class="col-md-4">
                                    <div class="post">
                                        <div class="img-wrapper js-set-bg-blog-thumb">
                                            <a href="">
                                                <img src="<?= Yii::app()->baseUrl; ?>/uploads/article/600-<?php echo $rsblog['images'] ?>" alt="Image" />
                                            </a>
                                        </div>
                                        <div class="desc">
                                            <h4 class="font-supermarket">
                                                <a href=""><?php echo $rsblog['title'] ?></a>
                                            </h4>
                                            <p class="meta">
                                                <span class="time"><?php echo $rsblog['create_date'] ?></span>
                                                <span class="comment">2</span>
                                            </p>
                                            <p></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!--
                <div class="call-to-action-style-2">
                    <div class="wrapper-carousel-background">
                        <a href=""><img src="<?php //echo Yii::app()->baseUrl;            ?>/themes/kstudio/images/call-to-action/1-1.jpg" alt="" /></a>
                        <a href=""><img src="<?php //echo Yii::app()->baseUrl;            ?>/themes/kstudio/images/call-to-action/1-2.jpg" alt="" /></a>
                        <a href=""><img src="<?php //echo Yii::app()->baseUrl;            ?>/themes/kstudio/images/call-to-action/1-3.jpg" alt="" /></a>
                        <a href=""><img src="<?php //echo Yii::app()->baseUrl;            ?>/themes/kstudio/images/call-to-action/1-4.jpg" alt="" /></a>
                    </div>
                    
                    <div class="overlay-call-to-action"></div>
                    <a class="btn btn-brand pill icon-left" href="#">
                        <i class="fa fa-instagram"></i>FOWLLOW US</a>
                    
                </div>
        -->
        <footer class="footer-style-1">
            <div class="container">
                <div class="row">
                    <div class="footer-style-1-inner">
                        <div class="widget-footer widget-text col-first col-small">
                            <a href="#">
                                <img class="logo-footer" src="<?php echo Yii::app()->baseUrl; ?>/uploads/logo/<?php echo $web->get_logoweb(); ?>" alt="kstudio" />
                            </a>
                            <div class="widget-link">
                                <ul>
                                    <li>
                                        <span class="lnr lnr-map-marker icon"></span>
                                        <span><?php echo $Contact['address'] ?></span>
                                    </li>
                                    <li>
                                        <span class="lnr lnr-phone-handset icon"></span>
                                        <?php echo $Contact['tel'] ?>
                                    </li>
                                    <li>
                                        <span class="lnr lnr-envelope icon"></span>
                                        <?php echo $Contact['email'] ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="widget-footer widget-link col-second col-medium">
                            <div class="list-link">
                                <h4 class="h4 heading">SHOP</h4>
                                <ul>
                                    <?php foreach ($Categorys as $Category): ?>
                                        <li>
                                            <a href=""><?php echo $Category['categoryname'] ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="list-link">
                                <h4 class="h4 heading">BRAND</h4>
                                <ul>
                                    <?php foreach ($BrandsMenu as $rsBrandMenu): ?>
                                        <li>
                                            <a href="#"><?php echo $rsBrandMenu['brandname'] ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <div class="list-link">
                                <h4 class="h4 heading">BLOG</h4>
                                <div id="fb-root"></div>
                                <ul>
                                    <?php foreach ($articleCategory as $articleCategorys): ?>
                                        <li id="lisubmenu">
                                            <a href=""><?php echo $articleCategorys['category'] ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="widget-footer widget-newsletter-footer col-last col-small">
                            <script>(function (d, s, id) {
                                    var js, fjs = d.getElementsByTagName(s)[0];
                                    if (d.getElementById(id))
                                        return;
                                    js = d.createElement(s);
                                    js.id = id;
                                    js.src = 'https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v3.2&appId=1637139006560611&autoLogAppEvents=1';
                                    fjs.parentNode.insertBefore(js, fjs);
                                }(document, 'script', 'facebook-jssdk'));</script>
                            <div class="fb-page" data-href="https://www.facebook.com/kstudiothai/" data-tabs="timeline" data-height="100" data-small-header="false" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true"><blockquote cite="https://www.facebook.com/kstudiothai/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/kstudiothai/">Kstudio</a></blockquote></div>
                            <!--
                            <h4 class="h4 heading">NEWSLETTER</h4>
                            <p>Subscribe now to get daily updates</p>
                            <form class="Orchid-form form-inline btn-add-on circle border">
                                <div class="form-group">
                                    <input class="form-control pill transparent" placeholder="Your Email..." type="email" />
                                    <button class="btn btn-brand circle" type="submit">
                                        <i class="fa fa-envelope-o"></i>
                                    </button>
                                </div>
                            </form>
                            -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="copy-right style-1">
                <div class="container">
                    <div class="row">
                        <div class="copy-right-inner">
                            <p>Copyright © 2018 Designed by Kimniyom.</p>
                            <!--
                            <div class="widget widget-footer widget-footer-creadit-card">
                                <ul class="list-unstyle">
                                    <li>
                                        <a href="#">
                                            <img src="<?php //echo Yii::app()->baseUrl;        ?>/themes/kstudio/images/icons/creadit-card-01.png" alt="creadit card" />
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="<?php //echo Yii::app()->baseUrl;        ?>/themes/kstudio/images/icons/creadit-card-02.png" alt="creadit card" />
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="<?php //echo Yii::app()->baseUrl;        ?>/themes/kstudio/images/icons/creadit-card-03.png" alt="creadit card" />
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="<?php //echo Yii::app()->baseUrl;        ?>/themes/kstudio/images/icons/creadit-card-04.png" alt="creadit card" />
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            -->
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!--
        <div class="modal fade" id="quick-view-product" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg modal-quickview woocommerce" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="woocommerce-product-gallery">
                                    <div class="main-carousel-product-quick-view">
                                        <div class="item">
                                            <img class="img-responsive" src="<?//= Yii::app()->baseUrl; ?>/themes/kstudio/images/product/01.jpg" alt="product thumbnail" />
                                        </div>
                                        <div class="item">
                                            <img class="img-responsive" src="<?//= Yii::app()->baseUrl; ?>/themes/kstudio/images/product/02.jpg" alt="product thumbnail" />
                                        </div>
                                        <div class="item">
                                            <img class="img-responsive" src="<?//= Yii::app()->baseUrl; ?>/themes/kstudio/images/product/03.jpg" alt="product thumbnail" />
                                        </div>
                                        <div class="item">
                                            <img class="img-responsive" src="<?//= Yii::app()->baseUrl; ?>/themes/kstudio/images/product/04.jpg" alt="product thumbnail" />
                                        </div>
                                        <div class="item">
                                            <img class="img-responsive" src="<?//= Yii::app()->baseUrl; ?>/themes/kstudio/images/product/05.jpg" alt="product thumbnail" />
                                        </div>
                                    </div>
                                    <div class="thumbnail-carousel-product-quickview">
                                        <div class="item">
                                            <img class="img-responsive" src="<?//= Yii::app()->baseUrl; ?>/themes/kstudio/images/product/01.jpg" alt="product thumbnail" />
                                        </div>
                                        <div class="item">
                                            <img class="img-responsive" src="<?//= Yii::app()->baseUrl; ?>/themes/kstudio/images/product/02.jpg" alt="product thumbnail" />
                                        </div>
                                        <div class="item">
                                            <img class="img-responsive" src="<?//= Yii::app()->baseUrl; ?>/themes/kstudio/images/product/03.jpg" alt="product thumbnail" />
                                        </div>
                                        <div class="item">
                                            <img class="img-responsive" src="<?//= Yii::app()->baseUrl; ?>/themes/kstudio/images/product/04.jpg" alt="product thumbnail" />
                                        </div>
                                        <div class="item">
                                            <img class="img-responsive" src="<?//= Yii::app()->baseUrl; ?>/themes/kstudio/images/product/05.jpg" alt="product thumbnail" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="summary">
                                    <div class="desc">
                                        <div class="header-desc">
                                            <h2 class="product-title">Sald</h2>
                                            <p class="price">$2.00</p>
                                        </div>
                                        <div class="body-desc">
                                            <div class="woocommerce-product-details-short-description">
                                                <p>Duis vestibulum ante velit. Pellentesque orci felis, pharetra ut pharetra ut, interdum at mauris. Aenean efficitur aliquet libero sit amet scelerisque. Suspendisse efficitur mollis eleifend. Aliquam tortor nibh, venenatis quis
                                                    sem dapibus, varius egestas lorem a sollicitudin. </p>
                                            </div>
                                        </div>
                                        <div class="footer-desc">
                                            <form class="cart">
                                                <div class="quantity buttons-added">
                                                    <input class="minus" value="-" type="button" />
                                                    <input class="input-text qty text" step="1" min="1" max="" name="quantity" value="1" title="Qty" size="4" pattern="[0-9]*" inputmode="numeric" type="number" />
                                                    <input class="plus" value="+" type="button" />
                                                </div>
                                                <div class="group-btn-control-wrapper">
                                                    <button class="btn btn-brand no-radius">ADD TO CART</button>
                                                    <button class="btn btn-wishlist btn-brand-ghost no-radius">
                                                        <i class="fa fa-heart"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="product-meta">
                                        <p class="posted-in">Categories:
                                            <a href="#" rel="tag">Food</a>
                                        </p>
                                        <p class="tagged-as">Tags:
                                            <a href="#" rel="tag">Natural</a>,
                                            <a href="#" rel="tag">Orchid</a>,
                                            <a href="#" rel="tag">Health</a>,
                                            <a href="#" rel="tag">Green</a>,
                                            <a href="#" rel="tag">Vegetable</a>
                                        </p>
                                        <p class="id">ID:
                                            <a href="#">A203</a>
                                        </p>
                                    </div>
                                    <div class="widget-social align-left">
                                        <ul>
                                            <li>
                                                <a class="facebook" data-toggle="tooltip" title="Facebook" href="http://www.facebook.com/Upperthemes">
                                                    <i class="fa fa-facebook"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="pinterest" data-toggle="tooltip" title="Pinterest" href="http://www.pinterest.com/Upperthemes">
                                                    <i class="fa fa-pinterest"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="twitter" data-toggle="tooltip" title="Twitter" href="http://www.twitter.com/Upperthemes">
                                                    <i class="fa fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="google-plus" data-toggle="tooltip" title="Google Plus" href="https://plus.google.com/Upperthemes">
                                                    <i class="fa fa-google-plus"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="instagram" data-toggle="tooltip" title="Instagram" href="https://instagram.com/Upperthemes">
                                                    <i class="fa fa-instagram"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        -->
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/js/library/jquery.min.js"></script>
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/js/library/bootstrap.min.js"></script>
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/js/function-check-viewport.js"></script>
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/js/library/slick.min.js"></script>
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/js/library/select2.full.min.js"></script>
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/js/library/imagesloaded.pkgd.min.js"></script>
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/js/library/jquery.mmenu.all.min.js"></script>
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/js/library/rellax.min.js"></script>
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/js/library/isotope.pkgd.min.js"></script>
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/js/library/bootstrap-notify.min.js"></script>
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/js/library/bootstrap-slider.js"></script>
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/js/library/in-view.min.js"></script>
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/js/library/countUp.js"></script>
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/js/library/animsition.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/themes/kstudio/revolution/css/settings.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/themes/kstudio/revolution/css/layers.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/themes/kstudio/revolution/css/navigation.css" />
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/revolution/js/jquery.themepunch.tools.min.js"></script>
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/revolution/js/jquery.themepunch.revolution.min.js"></script>
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/revolution/js/extensions/revolution.extension.actions.min.js"></script>
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/revolution/js/extensions/revolution.extension.carousel.min.js"></script>
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/revolution/js/extensions/revolution.extension.migration.min.js"></script>
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/revolution/js/extensions/revolution.extension.video.min.js"></script>
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/js/global.js"></script>
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/js/config-banner-home-1.js">


        </script>
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/js/config-mm-menu.js"></script>
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/js/config-set-bg-blog-thumb.js"></script>
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/js/config-isotope-product-home-1.js"></script>
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/js/config-isotope-product-home-2.js"></script>

        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/js/config-carousel.js"></script>

        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/js/config-carousel-thumbnail.js"></script>
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/js/config-carousel-product-quickview.js"></script>
        <!-- Demo Only-->
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/js/demo-add-to-cart.js">


        </script>
        <script tyle="text/javascript">
            setScreen();
            function setScreen() {
                var w = window.innerWidth;
                if (w >= 768) {
                    $("#menuBar").css({"padding-bottom": "20px"});
                } else {
                    $("#slider_1").hide();
                    $("#slider_1").css({"height": "20px"});
                }
            }

            function getMenu() {
                var url = "<?php echo Yii::app()->createUrl('site/getmenu') ?>";
                $.get(url, function (data) {
                    $("#kkmenusidebar").html(data);
                });
            }
        </script>
    </body>
</html>
