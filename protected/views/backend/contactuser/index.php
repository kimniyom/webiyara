<?php
/* @var $this ContactuserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Contactusers',
);

$this->menu=array(
	array('label'=>'Create Contactuser', 'url'=>array('create')),
	array('label'=>'Manage Contactuser', 'url'=>array('admin')),
);
?>

<h1>Contactusers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
