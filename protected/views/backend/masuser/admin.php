<?php
/* @var $this MasuserController */
/* @var $model Masuser */

$this->breadcrumbs = array(
    'Masusers' => array('index'),
    'Manage',
);
?>

<h4>Manage Users</h4>


<?php
$this->widget('booster.widgets.TbGridView', array(
    'id' => 'masuser-grid',
    'dataProvider' => $model->search(),
    //'filter' => $model,
    'columns' => array(
        //'id',
        //'oid',
        //'pid',
        array(
            'name' => 'name',
            'value' => function($data) {
                return $data->name . '-' . $data->lname;
            }
        ),
        'alias',
        /*
          'password',
          'email',
          'tel',
          'sex',
          'birth',
          'status',
          'd_update',
          'create_date',
          'images',
          'username',
         */
        'email',
        'username',
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}{delete}',
        ),
    ),
));
?>
