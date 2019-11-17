<?php
/* @var $this LogordersController */
/* @var $model Logorders */

$this->breadcrumbs=array(
	'Logorders'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Logorders', 'url'=>array('index')),
	array('label'=>'Create Logorders', 'url'=>array('create')),
	array('label'=>'Update Logorders', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Logorders', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Logorders', 'url'=>array('admin')),
);
?>

<h1>View Logorders #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'admin_id',
		'log',
		'order_id',
		'date',
	),
)); ?>
