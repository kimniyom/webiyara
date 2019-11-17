<?php
/* @var $this BrandController */
/* @var $model Brand */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
	<div class="col-md-4 col-lg-4">
		<?php echo $form->label($model,'brandname'); ?>
		<?php echo $form->textField($model,'brandname',array('size'=>60,'maxlength'=>100,'class' => 'form-control')); ?>
	</div>
	</div>
	<div class="row" style="margin-top:10px;">
	<div class="col-md-4 col-lg-4">
		<?php echo CHtml::submitButton('Search',array('class' => 'btn btn-default')); ?>
	</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->