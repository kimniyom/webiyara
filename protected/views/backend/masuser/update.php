<?php
/* @var $this MasuserController */
/* @var $model Masuser */

$this->breadcrumbs=array(
	'Masusers'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

?>

<h4>Update <?php echo $model->name; ?></h4>

<?php $this->renderPartial('_form_update', array('model'=>$model)); ?>