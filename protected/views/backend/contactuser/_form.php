<?php
/* @var $this ContactuserController */
/* @var $model Contactuser */
/* @var $form CActiveForm */
?>


    <div class="form">

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'contactuser-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
                //'enableAjaxValidation'=>false,
        ));
        ?>
        <p>
            If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
        </p>
       
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <p class="note">Fields with <span class="required">*</span> are required.</p>

                <?php //echo $form->errorSummary($model); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-lg-4">
                <?php echo $form->labelEx($model, 'name'); ?>
                <?php echo $form->textField($model, 'name', array('class' => 'form-control')); ?>
                <?php echo $form->error($model, 'name'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 col-lg-4">
                <?php echo $form->labelEx($model, 'email'); ?>
                <?php echo $form->textField($model, 'email', array('class' => 'form-control')); ?>
                <?php echo $form->error($model, 'email'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <?php echo $form->labelEx($model, 'subject'); ?>
                <?php echo $form->textField($model, 'subject', array('rows' => 3, 'class' => 'form-control')); ?>
                <?php echo $form->error($model, 'subject'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <?php echo $form->labelEx($model, 'body'); ?>
                <?php echo $form->textArea($model, 'body', array('rows' => 6, 'class' => 'form-control')); ?>
                <?php echo $form->error($model, 'body'); ?>
            </div>
        </div>

        <?php if (CCaptcha::checkRequirements()): ?>
            <div class="row">
                <div class="col-md-5 col-lg-5">
                    <?php echo $form->labelEx($model, 'verifyCode'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-lg-3">
                    <?php $this->widget('CCaptcha'); ?>
                    <?php echo $form->textField($model, 'verifyCode', array('class' => 'form-control')); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="hint">Please enter the letters as they are shown in the image above.
                        <br/>Letters are not case-sensitive.</div>
                    <?php echo $form->error($model, 'verifyCode'); ?>
                </div>
            </div>
        <?php endif; ?>
        <hr/>
        <div class="row buttons">
            <div class="col-md-12 col-lg-12">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save', array('class' => 'btn btn-default')); ?>
            </div>
        </div>


        <?php $this->endWidget(); ?>

    </div><!-- form -->
    <br/>
    <br/>
