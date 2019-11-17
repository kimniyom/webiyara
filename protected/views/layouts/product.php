
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <?php $web = new Configweb_model(); ?>
        <title>IYARA,iyara,ไอยารา,เครื่องเสียง,หูฟัง,ลำโพง,sound,music,home</title>
        <link rel="shortcut icon" href="<?php echo Yii::app()->baseUrl; ?>/uploads/logo/logo.png">
        <meta property="og:type" content="website" />
        <meta property="fb:app_id" content="266256337158296" />
        <meta property="og:title" content="<?php echo Yii::app()->session['fbtitle']; ?>" />
        <meta property="og:image" content="<?php echo Yii::app()->session['fbimages']; ?>" />
        <meta property="og:image:url" content="<?php echo Yii::app()->session['fbimages']; ?>" />
        <meta property="og:image:secure_url" content="<?php echo Yii::app()->session['fbimages']; ?>" />
        <meta property="og:url" content="<?php echo Yii::app()->session['fburl']; ?>" />
        <meta property="og:hashtag" content="<?php echo $web->get_webname() ?>" />

        <meta property="og:caption" content="<?php echo Yii::app()->session['description']; ?>" />
        <meta property="og:description" content="<?php echo Yii::app()->session['description']; ?>" />

        <!--
        <meta name="description" content="headphoneguru,headphoneguru,headphoneguru,เครื่องเสียง,หูฟัง,ลำโพง" />
        -->

        <meta name="description" content="<?php echo Yii::app()->session['description']; ?>" />
        <meta name="keywords" content="iyara,IYARA,ไอยารา,เครื่องเสียง,หูฟัง,ลำโพง,sound,music,home" />

        <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i,900,900i" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl; ?>/themes/kstudio/css/main.css" />
        <style>
            .menuheadphoneguru ul li a{
                font-family: THK;
                color: #e0cd8b;
                font-size: 20px;
            }

            .menuheadphoneguru ul li a:hover{
                color: #ffffff;
            }

            .menuheadphoneguru ul li a:focus{
                color: #d00517;
            }
            #lisubmenu{
                /*border-bottom:solid 1px #eeeeee;*/
            }
            #lisubmenu a{
                padding: 10px;
                color:#e0cd8b;
                font-size: 18px;
            }

            #lisubmenu a:hover{
                padding: 10px;
                color: #ffffff;

            }
            #ulmenu{
                padding-top: 5px;
                z-index: 1000;
                background:#0f0f0f;
            }

            #ulmenufull a{
                padding: 5px;

            }

            #ulmenufull a:hover{
                padding-left: 10px;
            }


            @media (min-width: 768px) {
                #ulmenufull{
                    top: 30px;
                }
            }

            @media (min-width: 992px) {
                #ulmenufull{
                    top: 35px;
                }
            }

            @media (min-width: 1200px) {
                #ulmenufull{
                    top: 40px;
                }
            }



            #_footer h4{
                font-family: 'supermarket';
                font-weight: bold;
                margin-bottom: 5px;
                color: #000000;
            }

            #_footer ul li{
                margin-bottom: 0px;
            }

            #_footer ul li a{
                font-family: 'supermarket';
                font-size: 16px;

            }

            .widget-link ul li{
                font-family: 'supermarket';

                font-size: 16px;
            }
            .breadcrumbs a{
                color: #FFFFFF;
            }
            .breadcrumbs a:hover{
                color: #00ccff;
            }
            .breadcrumbs span{
                color: #999999;
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


        $ContactModel = new Contact();
        $Contact = $ContactModel->gat_contact();
        $logoMini = "<img src='" . Yii::app()->baseUrl . "/images/logo.png' class='img-responsive' alt='Image'>";
        $iconsloader = "<img src='" . Yii::app()->baseUrl . "/images/icons/spin.svg' />";


        //Cart
        $itemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
        if (isset($_SESSION['qty'])) {
            $meQty = 0;
            foreach ($_SESSION['qty'] as $meItem) {
                $meQty = $meQty + (int) $meItem;
            }
        } else {
            $meQty = 0;
        }
        ?>
    </head>
    <body class="animsition animsition" style="background: #000000;">
        <!-- Load Facebook SDK for JavaScript -->
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>

        <input value="<?php echo $logoMini ?>" id="logomini" type="hidden" />
        <?php
        $Categorys = Category::model()->findAll();
        ?>
        <div class="home-1" id="page">
            <!-- Menu Nav -->
            <div id="kkmenusidebar">

            </div>
            <nav id="menu" style="background:#000000; color:red;">
                <ul>
                    <li>
                        <a href="">HOME</a>
                    </li>
                    <li>
                        <a class="active" href="<?php echo Yii::app()->createUrl('frontend/product') ?>" >SHOP</a>
                        <ul>
                            <?php
                            foreach ($Categorys as $rsCategory):
                                $Types = ProductType::model()->findAll("category=:id", array(":id" => $rsCategory['id']));
                                if (count($Types) <= 0) {
                                    ?>
                                    <li>
                                        <a href="<?php echo Yii::app()->createUrl('frontend/product/category', array('id' => $rsCategory['id'])) ?>"><?php echo $rsCategory['categoryname'] ?></a>
                                    </li>
                                <?php } else { ?>
                                    <li>
                                        <a href="<?php echo Yii::app()->createUrl('frontend/product/category', array('id' => $rsCategory['id'])) ?>"><?php echo $rsCategory['categoryname'] ?></a>
                                        <ul>
                                            <?php
                                            foreach ($Types as $rsTypes):
                                                $sqlGetBrand = "select b.id,b.brandname from product p inner join brand b ON p.brand = b.id where p.type_id = '" . $rsTypes['type_id'] . "' group by brand";
                                                $Brands = Yii::app()->db->createCommand($sqlGetBrand)->queryAll();
                                                if (count($Brands) <= 0) {
                                                    ?>
                                                    <li>
                                                        <a href="<?php echo Yii::app()->createUrl('frontend/product/view', array('type' => $rsTypes['type_id'])) ?>"><?php echo $rsTypes['type_name'] ?></a>
                                                    </li>
                                                <?php } else { ?>
                                                    <li>
                                                        <a href="<?php echo Yii::app()->createUrl('frontend/product/view', array('type' => $rsTypes['type_id'])) ?>"><?php echo $rsTypes['type_name'] ?></a>
                                                        <ul>
                                                            <?php foreach ($Brands as $rsBrand): ?>
                                                                <li><a href="<?php echo Yii::app()->createUrl('frontend/product/brand', array('id' => $rsBrand['id'])) ?>"><?php echo $rsBrand['brandname'] ?></a></li>
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
                        <a href="<?php echo Yii::app()->createUrl('frontend/product') ?>">BRAND</a>
                        <?php $BrandsMenu = Brand::model()->findAll() ?>
                        <ul>
                            <?php foreach ($BrandsMenu as $rsBrandMenu): ?>
                                <li id="lisubmenu"><a href="<?php echo Yii::app()->createUrl('frontend/product/brand', array('id' => $rsBrandMenu['id'])) ?>"><?php echo $rsBrandMenu['brandname'] ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('frontend/article') ?>">BLOG</a>
                        <ul>
                            <?php foreach ($articleCategory as $articleCategorys): ?>
                                <li>
                                    <a href="<?php echo Yii::app()->createUrl('frontend/article/index', array('category' => $articleCategorys['id'])) ?>"><?php echo $articleCategorys['category'] ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li>
                        <a href="<?= Yii::app()->createUrl('contactuser/create') ?>">CONTACT</a>
                    </li>

                </ul>
            </nav>

            <!-- -->
            <header class="header-style-2" id="header-nav" style="background:#0f0f0f;border-bottom: #cccccc solid 0px; padding: 10px;"><!-- /images/bgheader.png-->
                <div class="container" id="menuBar">
                    <div class="row">
                        <div class="header-1-inner">
                            <a class="brand-logo animsition-link" href="<?php echo Yii::app()->createUrl('site/index') ?>">
                                <img class="img-responsive" src="<?php echo Yii::app()->baseUrl; ?>/uploads/logo/<?php echo $web->get_logoweb(); ?>" alt="" style="max-height: 52px;"/>
                            </a>
                            <nav class="menuheadphoneguru">
                                <ul class="menu hidden-xs">
                                    <li>
                                        <a href="<?php echo Yii::app()->createUrl('site/index') ?>">Home</a>
                                    </li>

                                    <li>
                                        <a class="active" href="<?php echo Yii::app()->createUrl('frontend/product') ?>" >Product <i class="fa fa-angle-down"></i></a>
                                        <ul id="ulmenu">
                                            <?php foreach ($Categorys as $rsCategory): ?>
                                                <li id="lisubmenu">
                                                    <a href="<?php echo Yii::app()->createUrl('frontend/product/category', array('id' => $rsCategory['id'])) ?>"><?php echo $rsCategory['categoryname'] ?></a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                    <!--
                                    <li>
                                        <a class="active" href="shop.html" >MENU <i class="fa fa-angle-down"></i></a>
                                        <ul id="ulmenufull" style=" position: fixed; left: 0px;width: 100%; padding: 10px;z-index: 1000;  background: none; box-shadow: none;">
                                            <li>
                                                <div class="container" style=" background: #FFFFFF; padding-top: 20px; width: 700px;">
                                                    <div class="row">
                                    <?php
                                    //foreach ($Categorys as $rsCategory):
                                    //$Types = ProductType::model()->findAll("category=:id", array(":id" => $rsCategory['id']));
                                    ?>
                                                            <div class="col-md-4 col-lg-4 col-sm-4">
                                                                <label><?php //echo $rsCategory['categoryname']                                    ?></label>
                                                                <hr style="border-bottom: #cccccc solid 1px; margin-top: 0px; margin-bottom: 5px;"/>
                                    <?php
                                    //foreach ($Types as $type):
                                    ?>
                                                                    <a href=""><?php //echo $type['type_name']                                  ?></a>
                                    <?php //endforeach;    ?>
                                                            </div>
                                    <?php //endforeach;     ?>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    -->
                                    <li>
                                        <a href="<?php echo Yii::app()->createUrl('frontend/product') ?>">BRAND <i class="fa fa-angle-down"></i></a>

                                        <ul id="ulmenu" style="max-height:500px; overflow-x:hidden; overflow-y:auto;">

                                            <?php foreach ($BrandsMenu as $rsBrandMenu): ?>
                                                <li id="lisubmenu"><a href="<?php echo Yii::app()->createUrl('frontend/product/brand', array('id' => $rsBrandMenu['id'])) ?>"><?php echo $rsBrandMenu['brandname'] ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                    <!--
                                    <li>
                                        <a href="<?php //echo Yii::app()->createUrl('frontend/article')       ?>">BLOG <i class="fa fa-angle-down"></i></a>
                                        <ul id="ulmenu">
                                    <?php //foreach ($articleCategory as $articleCategorys): ?>
                                                <li id="lisubmenu">
                                                    <a href="<?php //echo Yii::app()->createUrl('frontend/article/index', array('category' => $articleCategorys['id']))       ?>"><?php //echo $articleCategorys['category']       ?></a>
                                                </li>
                                    <?php //endforeach; ?>
                                        </ul>
                                    </li>
                                    -->
                                    <!--
                                    <li>
                                        <a href="<?php // Yii::app()->createUrl('site/payment')       ?>">แจ้งชำระเงิน / วิธีชำระเงิน</a>
                                    </li>
                                    -->
                                    <li>
                                        <a href="<?= Yii::app()->createUrl('contactuser/create') ?>">About</a>
                                    </li>
                                    <li>
                                        <a href="<?= Yii::app()->createUrl('contactuser/create') ?>">Contact</a>
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
                                    <a class="control btn-open-search-form js-open-search-form-header" href="javascript:searchproduct()">
                                        <span class="lnr lnr-magnifier" style="color:#f1debf"> Search</span>
                                    </a>
                                    <div class="form-outer" style=" background: url('<?php echo Yii::app()->baseUrl ?>/images/black-glass.png'); ">
                                        <button class="btn-close-form-search-header js-close-search-form-header">
                                            <span class="lnr lnr-cross"></span>
                                        </button>
                                        <form onsubmit="return false;">
                                            <input placeholder="Search" id="searchproduct"/>
                                            <button class="search">
                                                <span class="lnr lnr-magnifier" onclick="searchproduct()"></span>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <div class="widget widget-control-header widget-shop-cart js-widget-shop-cart">
                                    <a class="control" href="<?php echo Yii::app()->createUrl('frontend/orders/cart') ?>">
                                        <span class="lnr lnr-cart"  style="color:#f1debf"></span>
                                        <span class="badge" style=" background: #cc0033;"><?php echo $meQty; ?></span>
                                    </a>
                                </div>

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

            <video id="video-title" style="width: 100%; height: auto; display:none;" muted autoplay loop>
                <source src="<?php echo Yii::app()->baseUrl; ?>/uploads/video/SpotIYARA.mp4" type="video/mp4" >
                Your browser does not support the video tag.
            </video>

            <?php if ($this->breadcrumbs): ?>
                <div class="font-THK" style="padding: 10px; color: #ffffff; background: #171721;border-bottom: #cccccc solid 0px; text-align: center; font-size: 20px; z-index:1;">
                    <div class="container">
                        <?php
                        $this->widget('zii.widgets.CBreadcrumbs', array(
                            'homeLink' => '<i class="fa fa-home"></i> ' . CHtml::link('หน้าแรก', Yii::app()->createUrl('site/index')),
                            'links' => $this->breadcrumbs,
                        ));
                        ?><!-- breadcrumbs -->
                    </div>
                </div>
            <?php endif ?>

            <?php
            echo $content;
            ?>

        </div>

        <footer class="footer-style-1" style=" border-top: #e0cd8b solid 1px; background: #0f0f0f;">
            <div class="container">
                <div class="row">
                    <div class="footer-style-1-inner">
                        <div class="widget-footer widget-text col-first col-small">
                            <div style="text-align: center;">
                                <img class="logo-footer" src="<?php echo Yii::app()->baseUrl; ?>/uploads/logo/logo-white.png" alt="headphoneguru" />
                            </div>
                            <div class="widget-link">
                                <ul>
                                    <li>

                                        <span><?php echo $Contact['address'] ?></span>
                                    </li>
                                    <li>
                                        <span class="lnr lnr-phone-handset icon"></span>
                                        <span><?php echo $Contact['tel'] ?></span>
                                    </li>
                                    <li>
                                        <span class="lnr lnr-envelope icon"></span>
                                        <span><?php echo $Contact['email'] ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="widget-footer widget-link col-second col-medium" id="footers">
                            <div class="list-link">
                                <h4 class="h4 heading" id="headfooter">SHOP</h4>
                                <ul>
                                    <?php foreach ($Categorys as $Category): ?>
                                        <li>
                                            <a href="<?php echo Yii::app()->createUrl('frontend/product/category', array("id" => $Category['id'])) ?> "><?php echo $Category['categoryname'] ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="list-link">
                                <h4 class="h4 heading" id="headfooter">BRAND</h4>
                                <ul>
                                    <?php foreach ($BrandsMenu as $rsBrandMenu): ?>
                                        <li>
                                            <a href="<?php echo Yii::app()->createUrl('frontend/product/brand', array("id" => $rsBrandMenu['id'])) ?> "><?php echo $rsBrandMenu['brandname'] ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <div class="list-link">
                                <h4 class="h4 heading" id="headfooter">BLOG</h4>
                                <ul>
                                    <?php foreach ($articleCategory as $articleCategorys): ?>
                                        <li>
                                            <a href="<?php echo Yii::app()->createUrl('frontend/article/index', array('category' => $articleCategorys['id'])) ?> "><?php echo $articleCategorys['category'] ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="widget-footer widget-newsletter-footer col-last col-small">

                            <div class="row">
                                <div class="col-md-12 col-lg-12" id="box-pop-footer">
                                    <h4 class="h4 heading" id="headfooter">POPULAR POSTS</h4>
                                    <?php
                                    $Blogpopw = $articleModel->Getpopulation(2);
                                    foreach ($Blogpopw as $bpop):
                                        ?>
                                        <div class="row" id="box-custom-small" style="margin-bottom: 10px;">
                                            <div class="col-lg-4 col-md-4 col-sm-2 col-xs-3">
                                                <a href="<?php echo Yii::app()->createUrl('frontend/article/views', array('id' => $bpop['id'])) ?>">
                                                    <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/article/600-<?php echo $bpop['images'] ?>" alt="Image" class="img img-responsive" style=" border-radius: 10px;"/>
                                                </a>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-10 col-xs-9">
                                                <div id="font-costom">
                                                    <h4 class="font-THK">
                                                        <a href="<?php echo Yii::app()->createUrl('frontend/article/views', array('id' => $bpop['id'])) ?>"><?php echo $bpop['title'] ?></a>
                                                    </h4>

                                                </div>
                                            </div>
                                        </div>

                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copy-right style-1" style=" background: #0f0f16;">
                <div class="container">
                    <div class="row">
                        <div class="copy-right-inner">
                            <p>Copyright © 2018 Designed by Kimniyom.</p>
                            <p class="pull-right"><a href="<?php echo Yii::app()->createUrl('backend/backend') ?> " target="_blank">Administrator</a></p>
                            <!--
                            <div class="widget widget-footer widget-footer-creadit-card">
                                <ul class="list-unstyle">
                                    <li>
                                        <a href="#">
                                            <img src="<?php //echo Yii::app()->baseUrl;                                                                ?>/themes/kstudio/images/icons/creadit-card-01.png" alt="creadit card" />
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="<?php //echo Yii::app()->baseUrl;                                                                ?>/themes/kstudio/images/icons/creadit-card-02.png" alt="creadit card" />
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="<?php //echo Yii::app()->baseUrl;                                                                ?>/themes/kstudio/images/icons/creadit-card-03.png" alt="creadit card" />
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="<?php //echo Yii::app()->baseUrl;                                                                ?>/themes/kstudio/images/icons/creadit-card-04.png" alt="creadit card" />
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
        <!--
        <script src="<?php //Yii::app()->baseUrl;                ?>/themes/kstudio/js/config-banner-home-1.js"></script>
        -->
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/js/config-mm-menu.js"></script>
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/js/config-set-bg-blog-thumb.js"></script>
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/js/config-isotope-product-home-1.js"></script>
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/js/config-isotope-product-home-2.js"></script>



        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/js/config-carousel.js"></script>

        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/js/config-carousel-thumbnail.js"></script>
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/js/config-carousel-product-quickview.js"></script>
        <!-- Demo Only-->
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/js/demo-add-to-cart.js"></script>

        <!-- Jquery.Bxslide-->
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/themes/kstudio/jquery.bxslider/jquery.bxslider.css" media="screen">
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/jquery.bxslider/jquery.bxslider.js"></script>

        <!-- fancybox -->
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/themes/kstudio/fancyBox2.1.5/source/jquery.fancybox.css" media="screen">
        <script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/fancyBox2.1.5/source/jquery.fancybox.js"></script>

        <!-- images hover effect -->
        <link href="<?= Yii::app()->baseUrl; ?>/themes/kstudio/css/images-hover-effect.css" rel="stylesheet" type="text/css" />

        <!-- Gallery -->
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/assets/gallery_img/dist/magnific-popup.css" type="text/css" media="all" />
        <script type="text/javascript" charset="utf-8"src="<?= Yii::app()->baseUrl; ?>/assets/gallery_img/dist/jquery.magnific-popup.js"></script>

        <script tyle="text/javascript">
                                                    setScreen();
                                                    $(window).scroll(function() {
                                                        if ($(this).scrollTop()) {
                                                            $("#header-nav").addClass("nav navbar-fixed-top");
                                                        } else {
                                                            $("#header-nav").removeClass("nav navbar-fixed-top");
                                                        }
                                                    });
                                                    //getMenu();
                                                    function setScreen() {
                                                        var w = window.innerWidth;
                                                        if (w >= 768) {
                                                            $("#menuBar").css({"padding-bottom": "0px"});
                                                        } else {
                                                            $("#slider_1").hide();
                                                            $("#slider_1").css({"height": "20px"});
                                                        }
                                                    }

                                                    function getMenu() {
                                                        var url = "<?php echo Yii::app()->createUrl('site/getmenu') ?>";
                                                        $.get(url, function(data) {
                                                            $("#kkmenusidebar").html(data);
                                                        });
                                                    }

                                                    function searchproduct() {
                                                        var url = "<?php echo Yii::app()->createUrl('frontend/product/search') ?>";
                                                        var search = $("#searchproduct").val();
                                                        if (search == "") {
                                                            $("#searchproduct").focus();
                                                            return false;
                                                        }

                                                        window.location = url + "/product/" + search;
                                                    }
        </script>
        <!-- WhatsHelp.io widget -->
        <script type="text/javascript">
            (function() {
                var options = {
                    facebook: "304494626300538", // Facebook page ID
                    line: "//line.me/R/ti/p/%40headphoneguru", // Line QR code URL
                    call_to_action: "ติดต่อ headphoneguru", // Call to action
                    button_color: "#E74339", // Color of button
                    position: "left", // Position may be 'right' or 'left'
                    order: "facebook,line", // Order of buttons
                };
                var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
                var s = document.createElement('script');
                s.type = 'text/javascript';
                s.async = true;
                s.src = url + '/widget-send-button/js/init.js';
                s.onload = function() {
                    WhWidgetSendButton.init(host, proto, options);
                };
                var x = document.getElementsByTagName('script')[0];
                x.parentNode.insertBefore(s, x);
            })();
        </script>
        <!-- /WhatsHelp.io widget -->
    </body>
</html>
