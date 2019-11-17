<link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl; ?>/css/headphoneguru.css" />
<?php
$web = new Configweb_model();
$productModel = new Product();
$lastProduct = $productModel->_get_last_product();
//$bestProduct = $productModel->_get_best_product();
//$saleProduct = $productModel->_get_sale_products();

$articleModel = new Article();
//$FNewsBlog = $articleModel->Get_article_limit(1);
$NewsBlog = $articleModel->Get_article_limit(3);

$articleCategory = Articlecategory::model()->findAll("active=:active", array(":active" => "1"));
?>

<div class="container" id="pagehome">
    <div class="row" style=" margin: 0px;">
        <div class="col-lg-6 col-md-6" id="homepage-left">
            <?php
            $sql1 = "select a.* from page p inner join article a on p.code = a.id where p.type = 1 and p.seq = 1";
            $rsblogs = Yii::app()->db->createCommand($sql1)->queryRow();
            if ($rsblogs['id']) {
                ?>
                <div class="row" style="background: #FFFFFF; margin-bottom: 10px;  box-shadow: #dbdbdb 3px 3px 3px 0px; border-radius: 5px;">

                    <div class="col-lg-12 col-md-12" style=" padding-left: 0px; padding-right: 0px;">
                        <div class="col-lg-12 col-md-12 col-sm-4" style=" padding: 0px; margin: 0px;">
                            <a href="<?php echo Yii::app()->createUrl('frontend/article/views', array('id' => $rsblogs['id'])) ?>">
                                <img src="<?= Yii::app()->baseUrl; ?>/uploads/article/600-<?php echo $rsblogs['images'] ?>" alt="Image" class="img img-responsive" style=" border-radius: 5px 5px 0px 0px;"/>
                            </a>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-8" style=" padding: 0px; margin: 0px;">
                            <div id="font-costom" style=" padding: 15px; position: relative; padding-bottom: 5px;">
                                <h4 class="font-THK" style="position:relative;">
                                    <a href="<?php echo Yii::app()->createUrl('frontend/article/views', array('id' => $rsblogs['id'])) ?>"><?php echo $rsblogs['title'] ?></a>
                                <div id="fade-box-post"></div>
                                </h4>
                                <div>
                                    <span class="time"><?php echo $rsblogs['create_date'] ?></span>
                                    <div class="pull-right" style=" bottom: 5px; right: 10px; position: absolute;"><i class="fa fa-eye"></i> <?php echo $rsblogs['countread'] ?></div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            <?php } ?>
        </div>
        <div class="col-lg-6 col-md-6" id="homepage-right">
            <?php
            $sql2 = "select a.* from page p inner join article a on p.code = a.id where p.type = 1 and p.seq = 2";
            $rsblogs2 = Yii::app()->db->createCommand($sql2)->queryRow();
            if ($rsblogs2['id']) {
                ?>
                <div class="row" id="box-custom-small">

                    <div class="col-lg-5 col-md-5 col-sm-4 col-xs-3" style=" padding: 0px; margin: 0px; padding-right: 0px;">
                        <a href="<?php echo Yii::app()->createUrl('frontend/article/views', array('id' => $rsblogs2['id'])) ?>">
                            <img src="<?= Yii::app()->baseUrl; ?>/uploads/article/600-<?php echo $rsblogs2['images'] ?>" alt="Image" class="img img-responsive" style=" border-radius: 5px 0px 0px 5px; margin-right: 0px;"/>
                        </a>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-8 col-xs-9">
                        <div id="font-costom">
                            <h4 class="font-THK" style="position:relative;">
                                <a href="<?php echo Yii::app()->createUrl('frontend/article/views', array('id' => $rsblogs2['id'])) ?>"><?php echo $rsblogs2['title'] ?></a>
                            <div id="fade-box-post"></div>
                            </h4>
                            <div>
                                <span class="time"><?php echo $rsblogs2['create_date'] ?> <i class="fa fa-eye"></i> <?php echo $rsblogs2['countread'] ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php
            $sql3 = "select a.* from page p inner join article a on p.code = a.id where p.type = 1 and p.seq = 3";
            $rsblogs3 = Yii::app()->db->createCommand($sql3)->queryRow();
            if ($rsblogs3['id']) {
                ?>
                <div class="row" id="box-custom-small">
                    <div class="col-lg-7 col-md-7 col-sm-8 col-xs-9">
                        <div id="font-costom">
                            <h4 class="font-THK" style="position:relative;">
                                <a href="<?php echo Yii::app()->createUrl('frontend/article/views', array('id' => $rsblogs3['id'])) ?>"><?php echo $rsblogs3['title'] ?></a>
                            <div id="fade-box-post"></div>
                            </h4>
                            <div>
                                <span class="time"><?php echo $rsblogs3['create_date'] ?> <i class="fa fa-eye"></i> <?php echo $rsblogs3['countread'] ?></span>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-4 col-xs-3" style=" padding: 0px; margin: 0px;">
                        <a href="<?php echo Yii::app()->createUrl('frontend/article/views', array('id' => $rsblogs3['id'])) ?>">
                            <img src="<?= Yii::app()->baseUrl; ?>/uploads/article/600-<?php echo $rsblogs3['images'] ?>" alt="Image" class="img img-responsive" style=" border-radius: 0px 5px 5px 0px;"/>
                        </a>
                    </div>
                </div>
            <?php } ?>
             <?php
            $sql4 = "select a.* from page p inner join article a on p.code = a.id where p.type = 1 and p.seq = 4";
            $rsblogs4 = Yii::app()->db->createCommand($sql4)->queryRow();
            if ($rsblogs4['id']) {
                ?>
                <div class="row" id="box-custom-small">

                    <div class="col-lg-5 col-md-5 col-sm-4 col-xs-3" style=" padding: 0px; margin: 0px; padding-right: 0px;">
                        <a href="<?php echo Yii::app()->createUrl('frontend/article/views', array('id' => $rsblogs4['id'])) ?>">
                            <img src="<?= Yii::app()->baseUrl; ?>/uploads/article/600-<?php echo $rsblogs4['images'] ?>" alt="Image" class="img img-responsive" style=" border-radius: 5px 0px 0px 5px; margin-right: 0px;"/>
                        </a>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-8 col-xs-9">
                        <div id="font-costom">
                            <h4 class="font-THK" style="position:relative;">
                                <a href="<?php echo Yii::app()->createUrl('frontend/article/views', array('id' => $rsblogs4['id'])) ?>"><?php echo $rsblogs4['title'] ?></a>
                            <div id="fade-box-post"></div>
                            </h4>
                            <div>
                                <span class="time"><?php echo $rsblogs4['create_date'] ?> <i class="fa fa-eye"></i> <?php echo $rsblogs4['countread'] ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

</div>

<div class="container" style=" text-align: center; margin-top: 30px;">
    <div class="row" style=" margin-top: 0px;">
        <a class="btn btn-default pill" href="<?php echo Yii::app()->createUrl('frontend/article') ?>">VIEW MORE </a>
    </div>
</div>

<br/>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-lg-8" id="box-lastnew">
            <hr style=" border-bottom: #5c5c5c solid 3px;"/>
           
             <div class="row">
                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
                    <h2 class=" font-supermarket" style=" margin-bottom: 15px;">
                        <b>LATEST NEWS</b>
                    </h2>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
                    <div class="pull-right">
                        <a href="<?php echo Yii::app()->createUrl('frontend/article') ?>">VIEW MORE</a>
                    </div>
                </div>
            </div>

            <div class="row" id="new-custom">
                <?php
                for ($i = 1; $i <= 4; $i++) {
                    $sqlLastnew = "select * from page where type = '2' and seq = '$i'";
                    $rsLastnew = Yii::app()->db->createCommand($sqlLastnew)->queryRow();
                        if (!$rsLastnew['id']) {
                    ?>
                    
                <?php } else { ?>
                <?php
                $sqlArticle = "select * from article where id = '" . $rsLastnew['code'] . "'";
                $breview = Yii::app()->db->createCommand($sqlArticle)->queryRow();
   
                    ?>
                    <div class="col-md-6 col-lg-6 col-sm-6" style=" margin-bottom: 20px;">
                        <div id="box-custom-small">
                            <a href="<?php echo Yii::app()->createUrl('frontend/article/views', array('id' => $breview['id'])) ?>">
                                <img src="<?= Yii::app()->baseUrl; ?>/uploads/article/600-<?php echo $breview['images'] ?>" alt="Image" class="img img-responsive" style=" border-radius: 5px 5px 0px 0px;"/>
                            </a>
                            <div id="font-costom">
                                <h4 class="font-THK" style="position:relative;">
                                    <a href="<?php echo Yii::app()->createUrl('frontend/article/views', array('id' => $breview['id'])) ?>"><?php echo $breview['title'] ?></a>
                                <div id="fade-box-post"></div>
                                </h4>
                                <p>
                                    <span class="time"><?php echo $breview['create_date'] ?></span>
                                    <span class="comment"><?php echo $breview['countread'] ?></span>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php } ?>
            </div>
        </div>
        <div class="col-md-4 col-lg-4" id="box-pop">
            <hr style=" border-bottom: #5c5c5c solid 3px;"/>
            <h2 class=" font-supermarket" style=" margin-bottom: 15px;"><b>SOCIAL</b></h2>

            <?php
            //$Blogpopw = $articleModel->Get_article_limit(3);
            //foreach ($Blogpopw as $bpop):
            ?>
            <!--
                <div class="row" id="box-custom-small">
                    <div class="col-lg-5 col-md-5 col-sm-4 col-xs-3" style=" padding: 0px; margin: 0px;">
                        <a href="<?php //echo Yii::app()->createUrl('frontend/article/views', array('id' => $bpop['id']))             ?>">
                            <img src="<?php //echo Yii::app()->baseUrl;             ?>/uploads/article/600-<?php //echo $bpop['images']             ?>" alt="Image" class="img img-responsive" style=" border-radius: 5px 0px 0px 5px;"/>
                        </a>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-8 col-xs-9">
                        <div id="font-costom">
                            <h4 class="font-THK">
                                <a href="<?php //echo Yii::app()->createUrl('frontend/article/views', array('id' => $rsblog['id']))             ?>"><?php //echo $bpop['title']             ?></a>
                            </h4>
                            <p>
                                <span class="time"><?php //echo $bpop['create_date']             ?></span>
                                <span class="comment"><?php //echo $bpop['countread']             ?></span>
                            </p>
                        </div>
                    </div>
                </div>
            -->
            <?php //endforeach ?>

            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-6" style=" padding-right: 0px;">
                    <div style="box-shadow: #dbdbdb 3px 3px 3px 0px; border-radius: 5px; padding: 17px;background: #ffffff;">
                        <div class="fb-page" data-href="https://www.facebook.com/headphoneguru/" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-height="392"  data-width="650"><blockquote cite="https://www.facebook.com/headphoneguru/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/headphoneguru/">HeadphoneGuru</a></blockquote></div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-12 col-sm-6" id="box-social">

                    <div id="box-body-social">
                        <div style=" text-align: left;">
                            <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/logo/<?php echo $web->get_logoweb(); ?>" />
                            <hr style=" border-bottom: #5c5c5c solid 2px; margin: 5px 0px;"/>
                            <h3 class=" font-supermarket">LET'S HANG OUT ON SOCIAL</h3>
                        </div>

                        <div class="row">

                            <?php foreach($social as $socials): 
                            if($socials['account'] == ""){
                                $classBtn = "disabled";
                                $linkSocial = "";
                                $traget = "";
                            } else {
                                $classBtn = "";
                                $linkSocial = $socials['account'];
                                $traget = "target='_blank'";
                            }
                            ?>
                                <div class="col-md-6 col-lg-6 col-sm-6" style=" margin-bottom: 5px; padding: 5px;">
                                    <a href="<?php echo $linkSocial ?>" <?php echo $traget ?>>
                                        <button type="button" class="btn btn-default btn-block <?php echo $classBtn ?>" style="text-align:left;"><b>
                                            <img src="<?php echo Yii::app()->baseUrl ?>/images/<?php echo $socials['icon'] ?>" style="height:32px;"/> <?php echo $socials['social_app'] ?></b>
                                        </button>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                            <!--
                            <div class="col-md-6 col-lg-6 col-sm-6" style=" margin-bottom: 5px; padding: 5px;">
                                <button type="button" class="btn btn-primary btn-block"><b><i class="fa fa-facebook"></i> FACEBOOK</b></button>
                            </div>
                            <div class="col-md-6 col-lg-6 col-sm-6" style=" margin-bottom: 5px;padding: 5px;">
                                <button type="button" class="btn btn-danger btn-block"><b><i class="fa fa-google-plus"></i> GOOGLE +</b></button>
                            </div>
                            <div class="col-md-6 col-lg-6 col-sm-6" style=" margin-bottom: 5px;padding: 5px;">
                                <button type="button" class="btn btn-primary btn-info btn-block"><b><i class="fa fa-twitter"></i> TWITTER</b></button>
                            </div>
                            <div class="col-md-6 col-lg-6 col-sm-6" style=" margin-bottom: 5px;padding: 5px;">
                                <button type="button" class="btn btn-warning btn-block btn-block"><b><i class="fa fa-instagram"></i> INSTAGRAM</b></button>
                            </div>
                            <div class="col-md-6 col-lg-6 col-sm-6" style=" margin-bottom: 5px;padding: 5px;">
                                <button type="button" class="btn btn-danger btn-block btn-block"><b><i class="fa fa-youtube"></i> YUTTUBE</b></button>
                            </div>
                        -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="boxed-sm">
    <div class="container">
        <!--
       <div class="product-filter-home-2-wraper">
           <div class="js-product-filter-home-2 product-filter-home-2 text-center">
               <div class="product-filter-home-2-inner">
                   <h4 class="filter-title is-checked" data-filter=".Newproduct">New Products</h4>
                   <h4 class="filter-title" data-filter=".Bsetproduct">Best Sellers</h4>
                   <h4 class="filter-title" data-filter=".Saleproduct">Sales Products</h4> 
               </div>
           </div>
       </div>
        -->
        <hr style=" border-bottom: #5c5c5c solid 3px;"/>
       
            <div class="row">
                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
                    <h2 class=" font-supermarket" style=" margin-bottom: 15px;">
                        <b>PRODUCT</b>
                    </h2>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
                    <div class="pull-right">
                        <a href="<?php echo Yii::app()->createUrl('frontend/product') ?>">VIEW MORE</a>
                    </div>
                </div>
            </div>
            
            
        
        <div class="row js-product-masonry-filter-layout-2 product-masonry-filter-layout-2">

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
                    <div class="products product-style-3" style="background: #ffffff;box-shadow: #dbdbdb 3px 3px 3px 0px; border-radius: 5px">
                        <div class="img-wrappers" style="border:none;">
                            <a href="<?php echo Yii::app()->createUrl('frontend/product/views', array("id" => $rsProduct['product_id'])) ?>">
                                <img class="img-responsive" src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $img ?>" alt="product thumbnail" style=" border-radius: 5px 5px 0px 0px;"/>
                            </a>
                            <!--
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
                            -->
                        </div>
                        <figcaption class="desc">
                            <h4 class="font-supermarket" style=" height: 50px; overflow: hidden;">
                                <a href="<?php echo Yii::app()->createUrl('frontend/product/views', array("id" => $rsProduct['product_id'])) ?>" class="product-name" style="color:#5c5c5c;"><?php echo $rsProduct['product_name'] ?></a>
                            </h4>
                            <span class="price font-supermarket" id="text-price">
                                <?php if ($rsProduct['product_price_pro'] > 0) { ?> 
                                    <del style=" color: #ff0000;"><?php echo number_format($rsProduct['product_price']) ?></del>
                                    <?php echo number_format($rsProduct['product_price_pro']) ?>  .-
                                <?php } else { ?>
                                    <?php echo number_format($rsProduct['product_price']) ?>  .-
                                <?php } ?>

                            </span>
                        </figcaption>
                    </div>
                </figure>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<br/>




<script type="text/javascript">
    $(document).ready(function () {
        $("#video-title").show();
        var size = window.innerWidth;
        if (size >= 1024) {
            $(".box-category-item").css({"margin-top": "30px"});
            $('.slider5').bxSlider({
                slideWidth: 300,
                minSlides: 5,
                maxSlides: 5,
                moveSlides: 5,
                slideMargin: 10,
                captions: true,
                auto: true,
                touchEnabled: true,
                pager: false
            });
            $(".text-band").css({'font-size': '30px'});
        } else if (size >= 768) {
            $(".box-category-item").css({"margin-top": "30px"});
            $('.slider5').bxSlider({
                slideWidth: 300,
                minSlides: 4,
                maxSlides: 4,
                moveSlides: 4,
                slideMargin: 10,
                captions: true,
                auto: true,
                touchEnabled: true,
                pager: false
            });

            $(".text-band").css({'font-size': '24px'});
        } else if (size >= 600) {
            $(".box-category-item").css({"margin-top": "0px"});
            $('.slider5').bxSlider({
                slideWidth: 300,
                minSlides: 3,
                maxSlides: 3,
                moveSlides: 3,
                slideMargin: 10,
                captions: true,
                auto: true,
                touchEnabled: true,
                pager: false
            });
            $(".text-band").css({'font-size': '22px'});
        } else if (size > 480) {
            $(".box-category-item").css({"margin-top": "0px"});
            $('.slider5').bxSlider({
                slideWidth: 300,
                minSlides: 3,
                maxSlides: 3,
                moveSlides: 3,
                slideMargin: 10,
                captions: true,
                auto: true,
                touchEnabled: true,
                pager: false
            });
            $(".text-band").css({'font-size': '20px'});
        } else {
            $(".box-category-item").css({"margin-top": "0px"});
            $('.slider5').bxSlider({
                slideWidth: 300,
                minSlides: 2,
                maxSlides: 2,
                moveSlides: 2,
                slideMargin: 10,
                captions: true,
                auto: true,
                touchEnabled: true,
                pager: false
            });
            $(".text-band").css({'font-size': '20px'});
        }
    });
</script>
