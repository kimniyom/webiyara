<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - Contact Us';
$this->breadcrumbs = array(
    'Contact',
);
?>
<div class="container">
    <h1>Contact Us</h1>

    <?php if (Yii::app()->user->hasFlash('contact')): ?>

        <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('contact'); ?>
        </div>

    <?php else: ?>

        <p>
            If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
        </p>

        <div class="form">

            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'contactuser-form',
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
            ));
            ?>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <p class="note">Fields with <span class="required">*</span> are required.</p>

                    <?php echo $form->errorSummary($model); ?>
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
                    <?php echo CHtml::submitButton('Submit', array('class' => 'btn btn-default')); ?>
                </div>
            </div>

            <?php $this->endWidget(); ?>

        </div><!-- form -->

    <?php endif; ?>
</div>
<br/>