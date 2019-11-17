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
    <br/>
    <h1 class="font-supermarket">Contact Us</h1>
    <br/>
    <?php $this->renderPartial('_form', array('model' => $model)); ?>
</div>