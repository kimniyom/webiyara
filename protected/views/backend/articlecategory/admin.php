<?php
/* @var $this ArticlecategoryController */
/* @var $model Articlecategory */

$this->breadcrumbs=array(
	'Articlecategories'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Articlecategory', 'url'=>array('index')),
	array('label'=>'Create Articlecategory', 'url'=>array('create')),
);

?>

<h4>article / event</h4>
<a href="<?php echo Yii::app()->createUrl('backend/articlecategory/create') ?>">
<button type="button" class="btn btn-default"><i class="fa fa-plus"></i> Add Category</button></a>

<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'articlecategory-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		//'id',
		'category',
		array(            // display 'create_time' using an expression
            'name'=>'active',
            'type' => 'raw',
            'value'=>function($data){
            	return ($data->active == "1") ? "Yes" : "No";
            }
        ),
		array(
			'class'=>'CButtonColumn',
			'template' => '{update}{delete}',
		),
	),
)); ?>
