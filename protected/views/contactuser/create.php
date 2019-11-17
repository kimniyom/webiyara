<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - Contact Us';
$this->breadcrumbs = array(
    'Contact',
);
?>
    <script type="text/javascript">
    $(document).ready(function () {
        var style = {"height": "auto"};
        $("#box-article img").addClass("img-responsive");
        $("#box-article img").css(style);
    });
</script>
<?php
$rs = Yii::app()->db->createCommand()
                ->select('*')
                ->from('about')
                ->queryRow();

        $about = $rs;
?>
<br/>
<div class=" container">
    <div class="jumbotron">
    	<h2 class="font-supermarket">Contact Us</h2>
    	<hr/>
    <div class="row">
    	<div class="col-md-6 col-lg-6">
    		<div id="box-article">
        		<?php echo $about['about'] ?>
    		</div>
		</div>

    	<div class="col-md-6 col-lg-6">
    		<?php $this->renderPartial('_form', array('model' => $model)); ?>
		</div>
	</div>
</div>
</div>