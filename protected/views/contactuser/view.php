<?php
/* @var $this ContactuserController */
/* @var $model Contactuser */

$this->breadcrumbs=array(
	'Contactusers'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Contactuser', 'url'=>array('index')),
	array('label'=>'Create Contactuser', 'url'=>array('create')),
	array('label'=>'Update Contactuser', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Contactuser', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Contactuser', 'url'=>array('admin')),
);
?>

<h1>View Contactuser #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'email',
		'subject',
		'body',
	),
)); ?>
