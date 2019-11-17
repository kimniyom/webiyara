<?php
/* @var $this ArticlecategoryController */
/* @var $model Articlecategory */

$this->breadcrumbs=array(
	'Articlecategories'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Articlecategory', 'url'=>array('index')),
	array('label'=>'Create Articlecategory', 'url'=>array('create')),
	array('label'=>'Update Articlecategory', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Articlecategory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Articlecategory', 'url'=>array('admin')),
);
?>

<h1>View Articlecategory #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'category',
		'active',
	),
)); ?>
