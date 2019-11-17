<?php
/* @var $this ArticlecategoryController */
/* @var $model Articlecategory */

$this->breadcrumbs=array(
	'article / event'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Articlecategory', 'url'=>array('index')),
	array('label'=>'Manage Articlecategory', 'url'=>array('admin')),
);
?>

<h4>Create Category</h4>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>