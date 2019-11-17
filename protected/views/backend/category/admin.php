<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs = array(
    'Categories' => array('admin'),
    'Manage',
);
?>

<h4>Manage Categories</h4>
<div style="padding-bottom:10px;">
    <a href="<?php echo Yii::app()->createUrl('backend/category/create') ?>">
        <button type="button" class="btn btn-default"><i class="fa fa-plus"></i> Create Categories</button></a>
    <div class="row" style="margin-top:10px;">
        <?php foreach ($category as $rs): ?>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="panel panel-default">
                    <img src="<?php echo Yii::app()->baseUrl ?>/uploads/category/<?php echo $rs['icons'] ?>" class="img img-responsive" />
                    <button type="button" class="btn btn-default btn-block" style="border:0px;box-shadow:none;">
                        <?php echo $rs['categoryname'] ?>
                    </button>
                    <div class="panel-footer">
                        <div class="row" style="text-align:center;">
                            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
                                <a href="<?php echo Yii::app()->createUrl('backend/category/update', array("id" => $rs['id'])) ?>"><i class="fa fa-pencil"></i> edit</a>
                            </div>
                            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
                                <a href="javascript:deleteCat('<?php echo $rs['id'] ?>')"><i class="fa fa-trash"></i> delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script type="text/javascript">
    function deleteCat(categoryID) {
        var urlCheck = "<?php echo Yii::app()->createUrl('backend/category/checkproduct') ?>";

        var data = {categoryID: categoryID};
        $.post(urlCheck, data, function (datas) {
            if (datas == 1) {
                alert("มีรายการสินค้าในหมวดนี้ไม่สามารถลบข้อมูลได้...!");
                return false;
            } else {
                var r = confirm("Are you sure..? เมื่อคุณลบข้อมูลประเภทสินค้าที่อยู่ในหมวดนี้จะถูกลบไปด้วย");
                if (r == true) {
                    var url = "<?php echo Yii::app()->createUrl('backend/category/delete') ?>";
                    $.post(url, data, function (res) {
                        window.location.reload();
                    });
                }
            }
        });
    }
</script>
