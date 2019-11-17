<?php
/* @var $this LogordersController */
/* @var $model Logorders */

$this->breadcrumbs=array(
	'Logorders'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Logorders', 'url'=>array('index')),
	array('label'=>'Manage Logorders', 'url'=>array('admin')),
);
?>

<h1>Create Logorders</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>