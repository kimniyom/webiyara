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

    .Story{
        margin: 50px;
    }

    .bg-left-top{
        position: absolute; top: 0px; left: 0px; width: 100%; height: 100%; z-index:-10;
        background: url('<?php echo Yii::app()->baseUrl ?>/images/l1.png') left top no-repeat;
    }

    .bg-right-top{
        position: absolute; top: 0px; left: 0px; width: 100%; height: 100%; z-index:-10;
        background: url('<?php echo Yii::app()->baseUrl ?>/images/r1.png') right top no-repeat;
    }

    .bg-left-bottom{
        position: absolute; top: 0px; left: 0px; width: 100%; height: 100%; z-index:-10;
        background: url('<?php echo Yii::app()->baseUrl ?>/images/l2.png') left bottom no-repeat;
    }

    .bg-right-bottom{
        position: absolute; top: 0px; left: 0px; width: 100%; height: 100%; z-index:-10;
        background: url('<?php echo Yii::app()->baseUrl ?>/images/r2.png') right bottom no-repeat;
    }

</style>
<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name;
$this->breadcrumbs = array(
    'Story',
);
?>

<div class="Story" style=" margin-bottom: 0px;">
    <div class="bg-left-top"></div>
    <div class="bg-right-top"></div>
    <div class="bg-left-bottom"></div>
    <div class="bg-right-bottom"></div>
    <?php echo $data['about'] ?>
</div>

<script type="text/javascript">
    setBg();
    function setBg() {
        var w = window.innerWidth;
        if (w < 768) {
            $(".bg-left-top").hide();
            $(".bg-right-top").hide();
            $(".bg-left-bottom").hide();
            $(".bg-right-bottom").hide();
        }
    }
</script>
