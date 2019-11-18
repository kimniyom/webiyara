<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <?php $web = new Configweb_model(); ?>
        <title>IYARA,iyara,ไอยารา,เครื่องเสียง,หูฟัง,ลำโพง,sound,music,home,audio</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        <meta name="description" content="<?php echo Yii::app()->session['description']; ?>" />
        <meta name="keywords" content="iyara,IYARA,ไอยารา,เครื่องเสียง,หูฟัง,ลำโพง,sound,music,home,audio,studio,หูฟัง" />

        <link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl; ?>/themes/kstudio/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl; ?>/css/footer.css" />
        <style>
            .menuheadphoneguru ul li a{
                font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
                color: #e0cd8b;
                /*font-size: 20px;*/
            }

            .menuheadphoneguru ul li a:hover{
                color: #ffffff;
            }

            .menuheadphoneguru ul li a:focus{
                color: #e0cd8b;
            }
            #lisubmenu{
                /*border-bottom:solid 1px #eeeeee;*/
            }
            #lisubmenu a{
                padding: 10px;
                color:#e0cd8b;
                /*font-size: 18px;*/
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
                font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
                font-weight: bold;
                margin-bottom: 5px;
                color: #000000;
            }

            #_footer ul li{
                margin-bottom: 0px;
            }

            #_footer ul li a{
                font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
                font-size: 14px;

            }

            .widget-link ul li{
                font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;

                font-size: 14px;
            }
            .breadcrumbs a{
                color: #e0cd8b;
            }
            .breadcrumbs a:hover{
                color: #ffffff;
            }
            .breadcrumbs span{
                color: #999999;
            }

            #body{
                background: #000000;
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

        $contactSocail = $ContactModel->get_social_media();
        ?>
    </head>
    <body class="animsition animsition" id="body">
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
        <div class="home-1" id="page" style="margin-bottom:0px;">
            <!-- Menu Nav -->
            <div id="kkmenusidebar">

            </div>
            <nav id="menu" style="background:#e0cd8b; color:#000000;">
                <ul>
                    <li><a href="<?php echo Yii::app()->createUrl('site/index') ?>">HOME</a></li>
                    <li><a class="active" href="<?php echo Yii::app()->createUrl('frontend/product') ?>" >PRODUCT</a>
                        <ul>
                            <?php
                            foreach ($Categorys as $rsCategory):
                                ?>
                                <li>
                                    <a href="<?php echo Yii::app()->createUrl('frontend/product/category', array('id' => $rsCategory['id'])) ?>"><?php echo $rsCategory['categoryname'] ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('frontend/product') ?>">BRAND</a>
                        <?php $BrandsMenu = Brand::model()->findAll() ?>
                        <ul>
                            <?php foreach ($BrandsMenu as $rsBrandMenu): ?>
                                <li><a href="<?php echo Yii::app()->createUrl('frontend/product/brand', array('id' => $rsBrandMenu['id'])) ?>"><?php echo $rsBrandMenu['brandname'] ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li><a href="<?php echo Yii::app()->createUrl('site/story') ?>" >STORY</a>
                    <li><a href="<?php echo Yii::app()->createUrl('site/findstore') ?>" >FIND STORE</a>
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
                    <!--
                    <li>
                        <a href="<?php //Yii::app()->createUrl('contactuser/create')   ?>">CONTACT</a>
                    </li>
                    -->
                </ul>
            </nav>

            <!-- -->
            <header class="header-style-2 nav navbar-fixed-top" id="header-nav" style="background:#0f0f0f;border-bottom: #cccccc solid 0px; padding: 10px;"><!-- /images/bgheader.png -->
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
                                                                <label><?php //echo $rsCategory['categoryname']                                                  ?></label>
                                                                <hr style="border-bottom: #cccccc solid 1px; margin-top: 0px; margin-bottom: 5px;"/>
                                    <?php
//foreach ($Types as $type):
                                    ?>
                                                                    <a href=""><?php //echo $type['type_name']                                               ?></a>
                                    <?php //endforeach;     ?>
                                                            </div>
                                    <?php //endforeach;      ?>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    -->
                                    <li>
                                        <a href="<?php echo Yii::app()->createUrl('frontend/product') ?>">brand <i class="fa fa-angle-down"></i></a>

                                        <ul id="ulmenu" style="max-height:500px; overflow-x:hidden; overflow-y:auto;">

                                            <?php foreach ($BrandsMenu as $rsBrandMenu): ?>
                                                <li id="lisubmenu"><a href="<?php echo Yii::app()->createUrl('frontend/product/brand', array('id' => $rsBrandMenu['id'])) ?>"><?php echo $rsBrandMenu['brandname'] ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="<?= Yii::app()->createUrl('site/story') ?>">Story</a>
                                    </li>
                                    <li>
                                        <a href="<?= Yii::app()->createUrl('site/findstore') ?>">Find Store</a>
                                    </li>
                                    <!--
                                    <li>
                                        <a href="<?php //Yii::app()->createUrl('contactuser/create')   ?>">Contact</a>
                                    </li>
                                    -->
                                </ul>
                            </nav>
                            <aside class="right">
                                <div class="widget widget-control-header widget-search-header">
                                    <a class="control btn-open-search-form js-open-search-form-header" style="cursor: pointer;" onclick="searchproduct()">
                                        <span class="lnr lnr-magnifier" style="color:#e0cd8b;"> <font style="font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-size: 16px;">Search</font></span>
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

                                <div class="widget widget-control-header hidden-lg hidden-md hidden-sm">
                                    <a class="navbar-toggle js-offcanvas-has-events" type="button" href="#menu">
                                        <span class="icon-bar" style="background:#e0cd8b;"></span>
                                        <span class="icon-bar" style="background:#e0cd8b;"></span>
                                        <span class="icon-bar" style="background:#e0cd8b;"></span>
                                    </a>
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>

            </header>
            <div style="height:73px;"></div>

            <div id="box-video-title" style="text-align: center;">
                <i class="fa fa-angle-double-down fa-5x text-warning" id="icon-move" style="display: none;"></i>
            </div>

            <?php if ($this->breadcrumbs): ?>
                <div class="font-THK" style="padding: 10px; color: #ffffff; background: none;border-bottom: #cccccc solid 0px; text-align: center; font-family: Helvetica Neue, Helvetica, Arial, sans-serif; z-index:1;">
                    <div class="container">
                        <?php
                        $this->widget('zii.widgets.CBreadcrumbs', array(
                            'homeLink' => '<i class="fa fa-home"></i> ' . CHtml::link('home', Yii::app()->createUrl('site/index')),
                            'links' => $this->breadcrumbs,
                        ));
                        ?><!-- breadcrumbs -->
                    </div>
                </div>
            <?php endif ?>

            <?php echo $content; ?>
        </div>
        <footer class="home-footer">
            <div class="container">
                <div class="row" style="padding-bottom: 10px;">
                    <div class="col-3">
                        <div class="link-cat" onclick="footerToggle(this)">
                            <span class="footer-toggle"></span>
                            <span class="footer-cat">SHOP</span>
                        </div>
                        <ul class="footer-cat-links">
                            <?php foreach ($Categorys as $Category): ?>
                                <li>
                                    <a href="<?php echo Yii::app()->createUrl('frontend/product/category', array("id" => $Category['id'])) ?> "><?php echo $Category['categoryname'] ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="col-3">
                        <div class="link-cat" onclick="footerToggle(this)">
                            <span class="footer-toggle"></span>
                            <span class="footer-cat">BRAND</span>
                        </div>
                        <ul class="footer-cat-links">
                            <?php foreach ($BrandsMenu as $rsBrandMenu): ?>
                                <li>
                                    <a href="<?php echo Yii::app()->createUrl('frontend/product/brand', array("id" => $rsBrandMenu['id'])) ?> "><?php echo $rsBrandMenu['brandname'] ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="col-3">
                        <div class="link-cat" onclick="footerToggle(this)">
                            <span class="footer-toggle"></span>
                            <span class="footer-cat" id="headfooter">BLOG</span>
                        </div>
                        <ul class="footer-cat-links">
                            <?php foreach ($articleCategory as $articleCategorys): ?>
                                <li>
                                    <a href="<?php echo Yii::app()->createUrl('frontend/article/index', array('category' => $articleCategorys['id'])) ?> "><?php echo $articleCategorys['category'] ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="col-3">
                        <div style="text-align: center;">
                            <img class="logo-footer" src="<?php echo Yii::app()->baseUrl; ?>/uploads/logo/logo-white.png" alt="headphoneguru" />
                        </div>
                        <br/>
                        <div class="home-address" style=" text-align:center;">
                            <span><?php echo $Contact['address'] ?></span><br/>
                            <span class="lnr lnr-phone-handset icon"></span>
                            <span><?php echo $Contact['tel'] ?></span><br/>
                            <span class="lnr lnr-envelope icon"></span>
                            <span><?php echo $Contact['email'] ?></span>
                        </div>
                    </div>

                </div> <!-- End row -->

                <div class="social-links">
                    <?php foreach ($contactSocail as $rsSocail): ?>
                        <a href="<?php echo $rsSocail['account'] ?>" target="_bank"><i class="<?php echo $rsSocail['fronticon'] ?>"></i></a>
                    <?php endforeach; ?>

                    <p class="pull-right"><a href="<?php echo Yii::app()->createUrl('backend/backend') ?> " target="_blank">Administrator</a></p>
                </div> <!-- End row -->

            </div><!-- End Containner -->


        </footer>
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
        <script src="<?php //Yii::app()->baseUrl;                              ?>/themes/kstudio/js/config-banner-home-1.js"></script>
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
                                    //$("#header-nav").addClass("nav navbar-fixed-top");
                                    $("#icon-move").hide();
                                } else {
                                    //$("#header-nav").removeClass("nav navbar-fixed-top");
                                }
                            });
                            //getMenu();
                            function setScreen() {
                                var w = window.innerWidth;
                                if (w >= 768) {

                                    $("#menuBar").css({"padding-bottom": "0px"});
                                } else {

                                    //$("#video-title").hide();
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

                            function footerToggle(footerBtn) {
                                $(footerBtn).toggleClass("btnActive");
                                $(footerBtn).next().toggleClass("active");
                            }
        </script>
        <!-- WhatsHelp.io widget
        <script type="text/javascript">
            (function() {
                var options = {
                    facebook: "304494626300538", // Facebook page ID
                    line: "//line.me/R/ti/p/%40headphoneguru", // Line QR code URL
                    call_to_action: "Contact IYARA", // Call to action
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
        /WhatsHelp.io widget -->
    </body>
</html>
