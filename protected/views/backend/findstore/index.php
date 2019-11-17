<?php
/* @var $this FindstoreController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Findstores',
);

$this->menu=array(
	array('label'=>'Create Findstore', 'url'=>array('create')),
	array('label'=>'Manage Findstore', 'url'=>array('admin')),
);
?>

<h1>Findstores</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
