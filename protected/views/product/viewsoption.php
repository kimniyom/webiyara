<style type="text/css">
    #setColorNear{
        background: #FFFFFF;
    }
    .product {

        padding:0px;
        transition: all 0.3s ease-in-out;
    }
    .product:hover {
        box-shadow: #eeeeee 0px 0px 5px 0px;
        padding:10px;
        transition: all 0.3s ease-in-out;
    }

    .product img{
        transition: all 0.3s ease-in-out;
    }

    .view-products #text-color-product{
        color:#9d1419;
    }

    .view-products a{
        color: #9d1419;
    }

</style>
<script>
    /*
     (function (d, s, id) {
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id))
     return;
     js = d.createElement(s);
     js.id = id;
     js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.5&appId=266256337158296";
     fjs.parentNode.insertBefore(js, fjs);
     }(document, 'script', 'facebook-jssdk'));
     */
</script>
<script type="text/javascript">
    $(document).ready(function () {

        var style = {"height": "auto"};
        $("#box-article img").addClass("img-responsive");
        $("#box-article img").css(style);

        $('.img_zoom').magnificPopup({
            delegate: 'a', // child items selector, by clicking on it popup will open
            type: 'image',
            gallery: {
                enabled: true
            }
            // other options
        });

    });
</script>
<?php
$this->pageTitle = $product['product_name'];
$title = $product['product_name'];
$this->breadcrumbs = array(
    $product['categoryname'] => array('frontend/product/category/id' . '/' . $product['category']),
    $product['type_name'] => array('frontend/product/view/type' . '/' . $product['type_id']),
    $title,
);
?>
<?php
$productModel = new Product();
$ConfigWeb = new Configweb_model();

$UrlShare = $ConfigWeb->GetFullLink(Yii::app()->request->url);
?>
<div class="view-products" style=" padding-top: 10px; background: #FFFFFF;">
    <div class="shop-detail-3 woocommerce" id="page">
        <!--
        <section class="sub-header shop-detail-1">
            <img class="rellax bg-overlay" src="<?php //echo Yii::app()->baseUrl                                                                         ?>/themes/kstudio/images/sub-header/017.jpg" alt="">
            <div class="overlay-call-to-action"></div>
            <h3 class="heading-style-3">Shop Detail</h3>
        </section>
        -->
        <section class="boxed-sm" style="margin:0px;">
            <div class="container" style=" background: #FFFFFF;">
                <div class="row product-detail" style=" margin: 0px;padding: 5px;">
                    <div class="row product-detail-wrapper" style="margin:0px;">
                        <div class="col-md-6">
                            <div class="woocommerce-product-gallery vertical" style="margin:0px;">
                                <div class="main-carousel">
                                    <?php foreach ($images as $al): ?>
                                        <div class="item">
                                            <img class="img-responsive" src="<?php echo Yii::app()->baseUrl; ?>/uploads/product/thumbnail/482-<?= $al['images'] ?>" alt="product thumbnail">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="thumbnail-carousel">
                                    <!--482x455
                                    <div class="item">
                                        <img class="img-responsive" src="<?php //echo Yii::app()->baseUrl                                                                                 ?>/themes/kstudio/images/product/01.jpg" alt="product thumbnail">
                                    </div>
                                    -->
                                    <?php foreach ($images as $al): ?>
                                        <div class="item">
                                            <img class="img-responsive" src="<?php echo Yii::app()->baseUrl; ?>/uploads/product/thumbnail/482-<?= $al['images'] ?>" alt="product thumbnail">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="summary">
                                <div class="desc">
                                    <div class="header-desc">
                                        <h2 class="product-title font-supermarket" id="text-color-product"><?php echo $product['product_name'] ?></h2>
                                        <p class="price">ราคา :
                                            <?php
                                            if ($product['product_price_pro'] > 0) {
                                                echo "<del style='color:red;'>" . number_format($product['product_price']) . "</del> ";
                                                echo number_format($product['product_price_pro']) . " .-";
                                            } else {
                                                echo number_format($product['product_price']) . ' .-';
                                            }
                                            ?>
                                        </p>
                                    </div>
                                    <div class="body-desc">
                                        <div class="woocommerce-product-details-short-description">
                                            <p><?php echo $product['description'] ?></p>
                                        </div>
                                    </div>
                                    <div class="footer-desc">
                                        <div class="cart">
                                            <h4 style=" margin-bottom: 10px;">Available Options</h4>
                                            <?php
                                            foreach ($masoption as $rs):
                                                $sql = "select * from optionproduct o where o.group_id = '" . $rs['id'] . "' ";
                                                $Option = Yii::app()->db->createCommand($sql)->queryAll();
                                                ?>
                                                <b><font style="color:#9d1419">*</font> <?php echo $rs['masoption'] ?></b>
                                                <?php foreach ($Option as $rss) : ?><br/>
                                                    &nbsp;&nbsp;&nbsp;<input type="radio" name="option<?php echo $rs['id'] ?>" value="<?php echo $rss['id'] ?>"/> <?php echo $rss['option'] ?> <?php echo ($rss['price'] > 0) ? "(+" . $rss['price'] . ")" : ""; ?>
                                                <?php endforeach; ?>
                                                <br/><br/>
                                            <?php endforeach; ?>
                                            <div id="validate" style=" color: #9d1419">* กรุณาเลือก Option</div>
                                            <br/>
                                            <!--
                                            <div class="quantity buttons-added">
                                                <input class="minus" value="-" type="button">
                                                <input class="input-text qty text" step="1" min="1" max="" name="quantity" value="1" title="Qty" size="4" pattern="[0-9]*" inputmode="numeric" type="number">
                                                <input class="plus" value="+" type="button">
                                            </div>
                                            -->
                                            <div class="group-btn-control-wrapper">
                                                <!--
                                                <a href="https://www.messenger.com/t/kstudiothai" target="_black">
                                                    <button class="btn btn-default"><i class="fa fa-comment text-success"></i> <font class="text-success">แชทเลย</font></button></a>
                                                -->
                                                <button type="button" class="btn btn-danger btn-lg btn-block" onclick="Buyproduct()" style=" border-radius: 0px; font-size: 20px;"><i class="fa fa-shopping-cart"></i> สั่งซื้อ</button>
                                                <!--
                                                <a href="<?php //echo Yii::app()->createUrl('frontend/orders/add', array("itemId" => $product['product_id'])) ?>">
                                                    <button class="btn btn-danger btn-lg btn-block" style=" border-radius: 0px; font-size: 20px;"><i class="fa fa-shopping-cart"></i> สั่งซื้อ</button></a>
                                                -->
                                                <!--
                                                     <button class="btn btn-wishlist btn-default">
                                                     <i class="fa fa-heart text-danger"></i>
                                                 </button>
                                                -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="product-meta">
                                    <p class="posted-in">Categories:
                                        <a href="#" rel="tag"><?php echo $product['categoryname'] ?></a>
                                    </p>
                                    <p class="tagged-as">Tags:
                                        <a href="#" rel="tag"><?php echo $product['categoryname'] ?></a>,
                                        <a href="#" rel="tag"><?php echo $product['type_name'] ?></a>,
                                        <a href="#" rel="tag"><?php echo $product['brandname'] ?></a>
                                    </p>
                                    <p class="id">ID:
                                        <a href="#"><?php echo $product['product_id'] ?></a>
                                    </p>
                                </div>

                                <!-- I got these buttons from simplesharebuttons.com -->




                                <div class="widget-social align-center">

                                    <ul>
                                        <li style="text-align:center;">
                                            <!-- Share FaceBook -->
                                            <!--
                                            <div style=" float: left; margin-top: 1px; margin-right: 10px;">Share : </div><div class="fb-share-button" data-layout="button_count"></div><br/>
                                            -->
                                            <!-- Your share button code -->
                                            <!--
                                            <div class="fb-share-button" data-layout="button_count">
                                            </div>
                                            -->
                                            <!--
                                            <a class="facebook" data-toggle="tooltip" title="Facebook" href="http://www.facebook.com/Upperthemes">
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                            -->
                                            <!-- Facebook -->
                                            <a href="http://www.facebook.com/sharer.php?u=<?php echo $UrlShare ?>" target="_blank">
                                                <img src="<?php echo Yii::app()->baseUrl ?>/images/facebook.png" alt="Facebook" style="width:32px;"/>
                                            </a>
                                        </li>
                                        <li>
                                            <!-- Google+ -->
                                            <a href="https://plus.google.com/share?url=<?php echo $UrlShare ?>" target="_blank">
                                                <img src="<?php echo Yii::app()->baseUrl ?>/images/google.png" alt="Google" style="width:32px;"/>
                                            </a>
                                        </li>
                                        <li>
                                            <!-- Pinterest -->
                                            <a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());">
                                                <img src="<?php echo Yii::app()->baseUrl ?>/images/pinterest.png" alt="Pinterest" style="width:32px;"/>
                                            </a>
                                        </li>
                                        <li>
                                            <!-- Twitter -->
                                            <a href="https://twitter.com/share?url=<?php echo $UrlShare ?>&amp;text=<?php echo Yii::app()->session['fbtitle']; ?>;hashtags=<?php echo $ConfigWeb->get_webname() ?>" target="_blank">
                                                <img src="<?php echo Yii::app()->baseUrl ?>/images/twitter.png" alt="Twitter" style="width:32px;"/>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://lineit.line.me/share/ui?url=<?php echo $UrlShare ?>" target="_blank">
                                                <img src="<?php echo Yii::app()->baseUrl ?>/images/line-icon.png" alt="Line" style="width:32px;"/>
                                            </a>
                                        </li>

                                    </ul>

                                    <div style=" clear: both; font-size:18px;">
                                        <br/>
                                        <i class="fa fa-eye"></i> คนเข้าดูสินค้า : <?php echo $product['countread'] ?> ครั้ง
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container" style=" border: #e7f0f2 solid 1px; background: #FFFFFF; padding:0px;">
                <div class="woocommerce-tabs">
                    <div class="row" style="margin:0px;">
                        <div class="col-md-12 woocommerce-tabs-inner" style="border:none;">
                            <div class="row" style=" background: #e7f0f2;">
                                <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-3 col-sm-offset-3 col-xs-offset-2">
                                    <ul class="tabs tab-style-2" role="tablist">
                                        <li class="active" role="presentation">
                                            <a href="#Description" aria-controls="Description" role="tab" data-toggle="tab">รายละเอียด</a>
                                        </li>
                                        <!--
                                        <li role="presentation">
                                            <a href="#Additional-Information" aria-controls="Additional-Information" role="tab" data-toggle="tab">Additional Information</a>
                                        </li>
                                        -->
                                        <li role="presentation">
                                            <a href="#Review" onclick="loadreview()" aria-controls="Review" role="tab" data-toggle="tab">Review (<?php echo $countreview ?>)</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-md-offset-2">
                            <div class="tab-content tab-content-style-2">
                                <div class="tab-pane fade in active" id="Description" role="tabpanel">
                                    <div id="box-article">
                                    <?php echo $product['product_detail'] ?>
                                </div>
                                </div>
                                <div class="tab-pane fade" id="Review" role="tabpanel">
                                    <div id="box-review"></div>
                                    <br/>
                                    <div class="font-THK">
                                        <h2 class="font-THK">เขียนรีวิว</h2>
                                        <p style=" font-size: 20px;">ที่อยู่อีเมลของคุณจะไม่ถูกเผยแพร่ ช่องที่ต้องการถูกทำเครื่องหมาย *</p>
                                    </div>
                                    <br/>
                                    <form id="form-review">
                                        <div class="row" style="margin:0px;">
                                            <div class="col-md-12 col-lg-12">
                                                <textarea class="form-control" rows="5" id="reviews" required="required" placeholder="Your Review *"></textarea>
                                            </div>
                                        </div>
                                        <div class="row" style=" margin: 10px 0px 0px 0px;">
                                            <div class="col-md-6 col-lg-6" style=" padding-bottom: 10px;">
                                                <input type="text" class="form-control" id="name" placeholder="Name *" required="required"/>
                                            </div>
                                            <div class="col-md-6 col-lg-6" style=" padding-bottom: 10px;">
                                                <input type="email" class="form-control" id="email" placeholder="Email *" required="required"/>
                                            </div>
                                        </div>
                                        <div class="row" style=" margin-top: 10px; margin:0px;">
                                            <div class="col-md-6 col-lg-6" style=" padding-bottom: 10px;">
                                                <button type="submit" class="btn btn-default">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="relate-product">
                    <div class="heading-wrapper text-center">
                        <h3 class="heading font-THK">สินค้าในหมวดเดียวกัน</h3>
                    </div>
                    <div class="row" style="margin:0px;">
                        <div class="carousel-product">
                            <?php
                            foreach ($near as $nears):
                                $fimg = $productModel->firstpictures($nears['product_id']);
                                ?>
                                <div class="item">
                                    <figure class="item" style=" background: #fafafa;">
                                        <div class="product product-style-1">
                                            <div class="img-wrappers">
                                                <img class="img-responsive" src="<?php echo Yii::app()->baseUrl ?>/uploads/product/thumbnail/482-<?php echo $fimg ?>" alt="product thumbnail">
                                            </div>
                                            <figcaption class="desc text-center" id="setColorNear" style=" background: #fafafa;">
                                                <h3 style="height:50px; overflow: hidden;white-space: wrap;text-overflow: ellipsis;">
                                                    <a class="product-name font-supermarket" href="<?php echo Yii::app()->createUrl('frontend/product/views', array('id' => $nears['product_id'])) ?>"><?php echo $nears['product_name'] ?></a>
                                                </h3>
                                                <span class="price">
                                                    <?php if ($nears['product_price_pro'] > 0) { ?>
                                                        <del style=" color: #9d1419;"><?php echo number_format($nears['product_price']) ?></del>
                                                        <?php echo number_format($nears['product_price_pro']) ?> .-
                                                    <?php } else { ?>
                                                        <?php echo number_format($nears['product_price']) ?> .-
                                                    <?php } ?>
                                                </span>
                                            </figcaption>
                                        </div>
                                    </figure>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<script type="text/javascript">
    function Buyproduct() {
        var check = true;
        $("input:radio").each(function() {
            var name = $(this).attr("name");
            if ($("input:radio[name=" + name + "]:checked").length == 0) {
                check = false;
            }
        });

        if (check) {
            //alert('One radio in each group is checked.');
            $("#validate").hide();
            var options = [];
            $("input[type=radio]:checked").each(function() {
                options.push($(this).val());
            });
            var url = "<?php echo Yii::app()->createUrl('frontend/orders/add', array("itemId" => $product['product_id'])) ?>" + "/options/" + options;
            window.location = url;
        } else {
            //alert('Please select one option in each question.');
            $("#validate").show();
        }



    }

    $(document).ready(function($) {
        $(document).on('submit', '#form-review', function(event) {
            event.preventDefault();
            var product_id = "<?php echo $product['product_id'] ?>";
            var reviews = $("#reviews").val();
            var name = $("#name").val();
            var email = $("#email").val();
            var url = "<?php echo Yii::app()->createUrl('frontend/product/savereview') ?>";
            var data = {product_id: product_id, reviews: reviews, name: name, email: email};
            if (name == "") {
                $("#reviews").focus();
                return false;
            }
            if (name == "") {
                $("#name").focus();
                return false;
            }
            if (email == "") {
                $("#email").focus();
                return false;
            }
            $.post(url, data, function(result) {
                loadreview();
                $("#name").val("");
                $("#email").val("");
                $("#reviews").val("");
            });
        });
    });
    //load_comment();
    loadreview();
    function load_comment() {
        $("#comment").html("<center><i class='fa fa-spinner fa-spin fa-2x'></i></center>");
        var product_id = "<?php echo $product['product_id'] ?>";
        var url = "<?php echo Yii::app()->createUrl('frontend/comment') ?>";
        var data = {product_id: product_id};

        $.post(url, data, function(result) {
            $("#comment").html(result);
        });
    }

    function send_comment() {
        var product_id = "<?php echo $product['product_id'] ?>";
        var box_comment = $("#box_comment").val();
        var url = "<?php echo Yii::app()->createUrl('frontend/comment/send_comment') ?>";
        var data = {product_id: product_id, box_comment: box_comment};
        if (box_comment == '') {
            $("#box_comment").focus();
            return false;
        }
        $.post(url, data, function(result) {
            load_comment();
        });
    }

    function submitReview() {
        var product_id = "<?php echo $product['product_id'] ?>";
        var reviews = $("#reviews").val();
        var name = $("#name").val();
        var email = $("#email").val();
        var url = "<?php echo Yii::app()->createUrl('frontend/comment/savereview') ?>";
        var data = {product_id: product_id, reviews: reviews};
        if (name == "") {
            $("#reviews").focus();
            return false;
        }
        if (name == "") {
            $("#name").focus();
            return false;
        }
        if (email == "") {
            $("#email").focus();
            return false;
        }
        $.post(url, data, function(result) {
            loadreview();

        });
    }

    function loadreview() {
        $("#box-review").html("<center><i class='fa fa-spinner fa-spin fa-2x'></i></center>");
        var product_id = "<?php echo $product['product_id'] ?>";
        var url = "<?php echo Yii::app()->createUrl('frontend/product/review') ?>";
        var data = {product_id: product_id};

        $.post(url, data, function(result) {
            $("#box-review").html(result);
        });
    }

</script>

