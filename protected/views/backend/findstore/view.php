<?php
/* @var $this FindstoreController */
/* @var $model Findstore */

$this->breadcrumbs=array(
	'Findstores'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Findstore', 'url'=>array('index')),
	array('label'=>'Create Findstore', 'url'=>array('create')),
	array('label'=>'Update Findstore', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Findstore', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Findstore', 'url'=>array('admin')),
);
?>

<h1>View Findstore #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'country',
		'address',
	),
)); ?>
