<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>
            <?php
            $web = new Configweb_model();
            echo $web->get_webname();
            ?>
        </title>

        <meta property="og:type" content="website" />
        <meta property="fb:app_id" content="266256337158296" />
        <meta property="og:title" content="<?php echo Yii::app()->session['fbtitle']; ?>" />
        <meta property="og:image" content="<?php echo Yii::app()->session['fbimages']; ?>" />
        <meta property="og:url" content="<?php echo Yii::app()->session['fburl']; ?>" />

        <meta name="description" content="headphoneguru,headphoneguru,headphoneguru,เครื่องเสียง,หูฟัง,ลำโพง" />
        <meta name="keywords" content="headphoneguru,headphoneguru,headphoneguru,เครื่องเสียง,หูฟัง,ลำโพง" />

        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/themes/backend/bootstrap/css/bootstrap.css" type="text/css" media="all" />
        <script src="<?= Yii::app()->baseUrl; ?>/js/jquery.js" type="text/javascript"></script>
        <script src="<?= Yii::app()->baseUrl; ?>/themes/backend/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <style>
            #lisubmenu{
                /*border-bottom:solid 1px #eeeeee;*/
            }
            #lisubmenu a{
                padding: 10px;
            }
            #ulmenu{
                padding-top: 5px; 
                z-index: 1000;
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
        ?>
    </head>
    <body class="animsition animsition" style="background: #f2f2f2;">
        <!-- Load Facebook SDK for JavaScript -->
        <div id="fb-root"></div>
        <script>(function (d, s, id) {
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
        <?php $BrandsMenu = Brand::model()->findAll() ?>
        <div class="home-1" id="page">

            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Brand</a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                            <li><a href="#">Link</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#">One more separated link</a></li>
                                </ul>
                            </li>
                        </ul>
                        <form class="navbar-form navbar-left">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Search">
                            </div>
                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#">Link</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>

            <?php if ($this->breadcrumbs): ?>
                <div class="font-THK" style="padding: 10px; color: #666666; background: #f2f2f2;border-bottom: #cccccc solid 0px; text-align: center; font-size: 20px; z-index:1;">
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
            <div>
                <?php
                echo $content;
                ?>
            </div>
        </div>

        <footer class="footer-style-1" style=" border-top: #eeeeee solid 1px; background: #f2f2f2;">
            <div class="container">
                <div class="row">
                    <div class="footer-style-1-inner">
                        <div class="widget-footer widget-text col-first col-small">
                            <a href="">
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
                        <div class="widget-footer widget-link col-second col-medium" id="_footer">
                            <div class="list-link">
                                <h4 class="h4 heading">SHOP</h4>
                                <ul>
                                    <?php foreach ($Categorys as $Category): ?>
                                        <li>
                                            <a href="<?php echo Yii::app()->createUrl('frontend/product/category', array("id" => $Category['id'])) ?> "><?php echo $Category['categoryname'] ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="list-link">
                                <h4 class="h4 heading">BRAND</h4>
                                <ul>
                                    <?php foreach ($BrandsMenu as $rsBrandMenu): ?>
                                        <li>
                                            <a href="<?php echo Yii::app()->createUrl('frontend/product/brand', array("id" => $rsBrandMenu['id'])) ?> "><?php echo $rsBrandMenu['brandname'] ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <div class="list-link">
                                <h4 class="h4 heading">BLOG</h4>

                                <ul>
                                    <?php foreach ($articleCategory as $articleCategorys): ?>
                                        <li id="lisubmenu">
                                            <a href="<?php echo Yii::app()->createUrl('frontend/article/index', array('category' => $articleCategorys['id'])) ?> "><?php echo $articleCategorys['category'] ?></a>
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
                                            <img src="<?php //echo Yii::app()->baseUrl;                                                   ?>/themes/kstudio/images/icons/creadit-card-01.png" alt="creadit card" />
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="<?php //echo Yii::app()->baseUrl;                                                   ?>/themes/kstudio/images/icons/creadit-card-02.png" alt="creadit card" />
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="<?php //echo Yii::app()->baseUrl;                                                   ?>/themes/kstudio/images/icons/creadit-card-03.png" alt="creadit card" />
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="<?php //echo Yii::app()->baseUrl;                                                   ?>/themes/kstudio/images/icons/creadit-card-04.png" alt="creadit card" />
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
                                $(window).scroll(function () {
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
                                    $.get(url, function (data) {
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
    </body>
</html>
