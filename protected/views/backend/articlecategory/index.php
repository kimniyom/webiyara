<?php
/* @var $this ArticlecategoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Articlecategories',
);

$this->menu=array(
	array('label'=>'Create Articlecategory', 'url'=>array('create')),
	array('label'=>'Manage Articlecategory', 'url'=>array('admin')),
);
?>

<h1>Articlecategories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
