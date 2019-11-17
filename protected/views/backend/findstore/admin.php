<?php
/* @var $this FindstoreController */
/* @var $model Findstore */

$this->breadcrumbs = array(
    'Findstores' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Findstore', 'url' => array('index')),
    array('label' => 'Create Findstore', 'url' => array('create')),
);
?>

<h4>Manage Findstores</h4>
<a href="<?php echo Yii::app()->createUrl('backend/findstore/create') ?>">
    <button type="button" class="btn btn-success"><i class="fa fa-plus"></i> Add Store</button></a>
<hr/>
<div class="row">
    <?php
    $store = Findstore::model()->findAll();
    foreach ($store as $rs):
        $cName = Country::model()->find("id=:id", array(":id" => $rs['country']))['ct_name_en'];
        ?>
        <div class="col-md-6 col-lg-6">
            <div class="well">
                <h4><?php echo $cName ?></h4>
                <hr/>
                <?php echo $rs['address'] ?>
                <div class="pull-right">
                    <a href="<?php echo Yii::app()->createUrl('backend/findstore/update', array('id' => $rs['id'])) ?>"><i class="fa fa-pencil"></i> edit</a> |
                    <a href="javascript:deletes('<?php echo $rs['id'] ?>')"><i class="fa fa-trash"></i> delete</a>
                </div>
                <br/>
            </div>

        </div>
        <?php
    endforeach;
    ?>
</div>

<script type="text/javascript">
    function deletes(id) {
        var r = confirm("Are you sure");
        var url = "<?php echo Yii::app()->createUrl('backend/findstore/delete') ?>";
        var data = {id: id};
        if (r == true) {
            $.post(url, data, function(datas) {
                window.location.reload();
            });
        }
    }
</script>
