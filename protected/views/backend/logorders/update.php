<?php
/* @var $this LogordersController */
/* @var $model Logorders */

$this->breadcrumbs=array(
	'Logorders'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Logorders', 'url'=>array('index')),
	array('label'=>'Create Logorders', 'url'=>array('create')),
	array('label'=>'View Logorders', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Logorders', 'url'=>array('admin')),
);
?>

<h1>Update Logorders <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>