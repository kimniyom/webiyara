<?php
/* @var $this ContactuserController */
/* @var $model Contactuser */

$this->breadcrumbs=array(
	'Contactusers'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Contactuser', 'url'=>array('index')),
	array('label'=>'Create Contactuser', 'url'=>array('create')),
	array('label'=>'View Contactuser', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Contactuser', 'url'=>array('admin')),
);
?>

<h1>Update Contactuser <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>