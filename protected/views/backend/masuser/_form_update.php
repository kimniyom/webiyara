<?php
/* @var $this MasuserController */
/* @var $model Masuser */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'masuser-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="col-md-5 col-lg-5">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100,'class' => 'form-control')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	</div>

	<div class="row">
		<div class="col-md-5 col-lg-5">
		<?php echo $form->labelEx($model,'lname'); ?>
		<?php echo $form->textField($model,'lname',array('size'=>60,'maxlength'=>100,'class' => 'form-control')); ?>
		<?php echo $form->error($model,'lname'); ?>
	</div>
	</div>

	<div class="row">
		<div class="col-md-4 col-lg-4">
		<?php echo $form->labelEx($model,'alias'); ?>
		<?php echo $form->textField($model,'alias',array('size'=>60,'maxlength'=>255,'class' => 'form-control')); ?>
		<?php echo $form->error($model,'alias'); ?>
	</div>
	</div>

	<div class="row">
		<div class="col-md-5 col-lg-5">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100,'class' => 'form-control')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	</div>

	<div class="row">
		<div class="col-md-4 col-lg-4">
		<?php echo $form->labelEx($model,'tel'); ?>
		<?php echo $form->textField($model,'tel',array('size'=>10,'maxlength'=>10,'class' => 'form-control')); ?>
		<?php echo $form->error($model,'tel'); ?>
	</div>
	</div>
<br/>
	<div class="row">
		<div class="col-md-4 col-lg-4">
		<?php echo $form->labelEx($model,'sex'); ?>
		<?php 
		echo $form->radioButtonList($model,'sex',
                    array('M' => 'ชาย','F' => 'หญิง'),
				    array('labelOptions'=>array('style'=>'display:inline'),'separator'=>'',
				));
		//echo $form->textField($model,'sex',array('size'=>1,'maxlength'=>1,'class' => 'form-control'));
		 ?>
		<?php echo $form->error($model,'sex'); ?>
		</div>
	</div>

	<hr/>
	
	<div class="row">
		<div class="col-md-4 col-lg-4">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class' => 'btn btn-default')); ?>
		</div>
	</div>
	<br/>

<?php $this->endWidget(); ?>

</div><!-- form -->