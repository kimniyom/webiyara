<?php
/* @var $this ArticlecategoryController */
/* @var $model Articlecategory */

$this->breadcrumbs=array(
	'article / event'=>array('admin'),
	//$model->id=>array('view','id'=>$model->id),
	'Update',
);

?>

<h4>Update <?php echo $model->category; ?></h4>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>