

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'brand-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
<!--
	<div class="row">
		<?php //echo $form->labelEx($model,'type'); ?>
		<?php //echo $form->textField($model,'type'); ?>
		<?php //echo $form->error($model,'type'); ?>
	</div>
-->
	<div class="row">
		<div class="col-md-6 col-lg-6">
			<?php echo $form->labelEx($model,'brandname'); ?>
			<?php echo $form->textField($model,'brandname',array('size'=>60,'maxlength'=>100,'class' => 'form-control')); ?>
			<?php echo $form->error($model,'brandname'); ?>
		</div>
	</div>

	<div class="row" style="margin-top:10px; margin-bottom:10px;">
		<div class="col-md-6 col-lg-6">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class' => 'btn btn-default')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->