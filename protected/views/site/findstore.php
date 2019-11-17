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

    .findstore{
        margin: 50px;
    }

    .findstore h3{
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        color: #e0cd8b;
        font-size: 32px;
    }


</style>

<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

//$this->pageTitle = Yii::app()->name;
//$this->breadcrumbs = array(
//'Find Store',
//);
?>
<div class="container">
    <div style="text-align: center; font-size: 48px;font-family: Helvetica Neue, Helvetica, Arial, sans-serif;;color: #e0cd8b; margin-top: 50px;">
        <i class="fa fa-building"></i><br/>
        <font style="border-bottom:#e0cd8b solid 2px;">Find Store</font>
    </div>
<div class="findstore">
    <div class="row">
            <?php foreach ($data as $rs): ?>
                <div class="col-md-4 col-lg-4" style="margin-bottom:20px;">
                    <h3><p><?php echo $rs['ct_name_en'] ?></p></h3>
                    <div style="padding:10px; color:#ffffff; font-family: Helvetica Neue, Helvetica, Arial, sans-serif; font-size: 20px;">
                    <?php echo $rs['address'] ?>
                    </div>
                </div>
            <?php endforeach;?>

    </div>
</div>
</div>
