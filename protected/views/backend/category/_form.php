<?php
/* @var $this CategoryController */
/* @var $model Category */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'category-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'), // จุดสำคัญ ห้ามลืมใส่ กรณี "อัพโหลดไฟล์ทุกชนิด"
    ));
    ?>
    <?php if ($model->icons) { ?>
        <img src="<?php echo Yii::app()->baseUrl ?>/uploads/category/thumbnail/<?php echo $model->icons ?>" style="height:200px;"/>
    <?php } ?>
    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>
    <div style="padding:10px;">
        <div class="row">
            <?php echo $form->labelEx($model, 'categoryname'); ?><br/>
            <?php echo $form->textField($model, 'categoryname', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
            <?php echo $form->error($model, 'categoryname'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'active'); ?><br/>
            <?php echo $form->radioButtonList($model, 'active', array("1" => "Yes", "0" => "No")); ?>
            <?php echo $form->error($model, 'active'); ?>
        </div>

        <div class="row">
            <?php
            echo $form->label($model, 'icons');
            echo $form->fileField($model, 'icons');
            echo $form->error($model, 'icons');
            ?>
            <p style="color:#ff0066;">*Photo scale 1:1</p>
        </div>

        <div class="row buttons" style="margin-top:10px;">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array("class" => "btn btn-success")); ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>

</div><!-- form -->
