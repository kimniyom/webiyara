<?php
/* @var $this FindstoreController */
/* @var $model Findstore */
/* @var $form CActiveForm */
?>
<div class="form" style=" padding: 20px;">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'findstore-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>
    <div class="">
        <div class="row">
            <?php echo $form->labelEx($model, 'country'); ?>
            <?php
            $data = CHtml::listData(Country::model()->findAll(), 'id', 'ct_name_en');
            $form->widget('ext.select2.ESelect2', array(
                'model' => $model,
                'attribute' => 'country',
                'data' => $data,
            ));
            ?>
            <?php echo $form->error($model, 'country'); ?>


        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'address'); ?>
            <?php
            $form->widget('application.components.widgets.XHeditor', array(
                'model' => $model,
                'modelAttribute' => 'address',
                'showModelAttributeValue' => true, // defaults to true, displays the value of $modelInstance->attribute in the textarea
                'config' => array(
                    'id' => 'address',
                    //'name' => 'address',
                    //'tools' => 'mini', // mini, simple, fill or from XHeditor::$_tools
                    'width' => '100%',
                //see XHeditor::$_configurableAttributes for more
                ),
            ));
            ?>


            <?php //echo $form->textArea($model, 'address', array('rows' => 6, 'cols' => 50, 'class' => 'form-control')); ?>
            <?php echo $form->error($model, 'address'); ?>
        </div>
        <div class="row">
            <hr/>
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array("class" => 'btn btn-default')); ?>
        </div>
        <?php $this->endWidget(); ?>

    </div><!-- form -->
</div>