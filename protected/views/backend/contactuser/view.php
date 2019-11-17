<?php
/* @var $this ContactuserController */
/* @var $model Contactuser */

$this->breadcrumbs = array(
    'Contactusers' => array('contact'),
    $model->name,
);
?>

<h1>View Contactuser #<?php echo $model->subject; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        //'id',
        'name',
        'email',
        'subject',
        'body',
        'createdate'
    ),
));
?>
