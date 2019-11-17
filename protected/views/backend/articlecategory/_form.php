<?php
/* @var $this ArticlecategoryController */
/* @var $model Articlecategory */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'articlecategory-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="col-md-8 col-lg-8">
		<?php echo $form->labelEx($model,'category'); ?>
		<?php echo $form->textField($model,'category',array('size'=>60,'maxlength'=>100,'class' => 'form-control')); ?>
		<?php echo $form->error($model,'category'); ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4 col-lg-4">
		<?php echo $form->labelEx($model,'active'); ?><br/>
		<?php echo $form->radioButtonList($model,'active',array("1" => "Yes","0" => "No")); ?>
		<?php echo $form->error($model,'active'); ?>
		</div>
	</div>
	<hr/>
	<div class="row" style="margin-bottom:10px;">
		<div class="col-md-4 col-lg-4">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class' => 'btn btn-default')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->