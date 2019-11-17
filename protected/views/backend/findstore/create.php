<?php
/* @var $this FindstoreController */
/* @var $model Findstore */

$this->breadcrumbs=array(
	'Findstores'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Findstore', 'url'=>array('index')),
	array('label'=>'Manage Findstore', 'url'=>array('admin')),
);
?>

<h1>Create Findstore</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>