<link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl; ?>/themes/kstudio/css/main.css" />
<?php
$articleCategory = Articlecategory::model()->findAll("active=:active", array(":active" => "1"));
$Categorys = Category::model()->findAll();
?>

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
            <a href="<?= Yii::app()->createUrl('frontend/contact') ?>">Contact</a>
        </li>
        <li>
            <a href="<?= Yii::app()->createUrl('site/about') ?>">About</a>
        </li>
    </ul>
</nav>

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
<script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/js/config-banner-home-1.js"></script>
<script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/js/config-mm-menu.js"></script>
<script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/js/config-set-bg-blog-thumb.js"></script>
<script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/js/config-isotope-product-home-1.js"></script>
<script src="<?= Yii::app()->baseUrl; ?>/themes/kstudio/js/config-isotope-product-home-2.js"></script>

