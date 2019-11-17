<?php
/* @var $this BrandController */
/* @var $model Brand */

$this->breadcrumbs=array(
	'Brands'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Brand', 'url'=>array('index')),
	array('label'=>'Manage Brand', 'url'=>array('admin')),
);
?>

<h4>Create Brand</h4>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>