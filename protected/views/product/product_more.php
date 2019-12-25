<style type="text/css">
    #body{
        background: rgba(69,67,59,1);
        background: -moz-radial-gradient(center, ellipse cover, rgba(69,67,59,1) 0%, rgba(0,0,0,1) 100%);
        background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, rgba(69,67,59,1)), color-stop(100%, rgba(0,0,0,1)));
        background: -webkit-radial-gradient(center, ellipse cover, rgba(69,67,59,1) 0%, rgba(0,0,0,1) 100%);
        background: -o-radial-gradient(center, ellipse cover, rgba(69,67,59,1) 0%, rgba(0,0,0,1) 100%);
        background: -ms-radial-gradient(center, ellipse cover, rgba(69,67,59,1) 0%, rgba(0,0,0,1) 100%);
        background: radial-gradient(ellipse at center, rgba(69,67,59,1) 0%, rgba(0,0,0,1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#45433b', endColorstr='#000000', GradientType=1 );
    }
</style>
<?php
$productModel = new Product();
?>

<?php
foreach ($product as $rsProduct):
    $img_title = $productModel->firstpictures($rsProduct['product_id']);
    if (!empty($img_title)) {
        $img = "uploads/product/thumbnail/480-" . $img_title;
    } else {
        $img = "images/No_image_available.jpg";
    }
    ?>
    <!--
    box-shadow: #999999 3px 3px 10px 0px;
    -->
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 hover10">
        <figure style=" margin-bottom: 35px;"> <!-- class="item" -->

            <div class="product product-style-3" style=" background: #000000;  border-radius: 5px 5px 5px 5px;">
                <div class="img-wrapper" style="border:none;">
                    <a href="<?php echo Yii::app()->createUrl('frontend/product/views', array("id" => $rsProduct['product_id'])) ?>">
                        <img class="img-responsive" src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $img ?>" alt="product thumbnail" style="border-radius: 4px 4px 0px 0px;"/>
                    </a>
                </div>
                <figcaption class="desc">
                    <h4 class="font-supermarket" style=" height: 50px; overflow: hidden;">
                        <a class="product-name" style="color:#e0cd8b;" href="<?php echo Yii::app()->createUrl('frontend/product/views', array("id" => $rsProduct['product_id'])) ?>"><?php echo $rsProduct['product_name'] ?></a>
                    </h4>
                </figcaption>
            </div>

        </figure>
    </div>
<?php endforeach; ?>





