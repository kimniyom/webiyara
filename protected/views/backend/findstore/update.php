<?php
/* @var $this FindstoreController */
/* @var $model Findstore */

$this->breadcrumbs = array(
    'Findstores' => array('index'),
    'Update',
);

$this->menu = array(
    array('label' => 'List Findstore', 'url' => array('index')),
    array('label' => 'Create Findstore', 'url' => array('create')),
    array('label' => 'View Findstore', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'Manage Findstore', 'url' => array('admin')),
);
?>

<h1>Update Findstore <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>