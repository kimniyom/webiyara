<?php
/* @var $this MasuserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Masusers',
);

$this->menu=array(
	array('label'=>'Create Masuser', 'url'=>array('create')),
	array('label'=>'Manage Masuser', 'url'=>array('admin')),
);
?>

<h1>Masusers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
