<script type="text/javascript">
    function edit_type() {
        $("#loading").addClass("fa fa-spinner fa-spin");
        var url = "<?php echo Yii::app()->createUrl('backend/typeproduct/save_edit_type') ?>";
        var id = "<?php echo $type['id'] ?>";
        var type_name = $("#type_name").val();
        var category = $("#category").val();
        var data = {
            id: id,
            type_name: type_name,
            category: category
        };
        if (type_name == "" || category == "") {
            $("#type_name").focus();
            return false;
        }

        $.post(url, data, function (success) {
            $("#loading").addClass("fa fa-check");
            window.location.reload();
        });

    }
</script>

<?php
$this->breadcrumbs = array(
    'ประเภทสินค้า' => array("backend/typeproduct/from_add_type"),
    $type['type_name']
);
?>

<div class="panel panel-default">
    <div class="panel-heading">จัดการประเภทสินค้า</div>
    <div class="panel-body">
        <div class="row" style="margin: 0px;">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <label>รหัส</label>
                <input class="form-control input-sm" id="type_id" name="type_id" type="text" value="<?php echo $type['type_id']; ?>" readonly="readonly"/>
            </div>
        </div>
        <div class="row" style="margin: 0px;">
            <div class="col-sm-6 col-lg-6">
                <label>Category</label>
                <select id="category" class="form-control input-sm" onchange="getType(this.value)">
                    <?php foreach ($category as $cat): ?>
                        <option value="<?php echo $cat['id'] ?>" <?php echo ($cat['id'] == $type['category']) ? "selected" : ""; ?>><?php echo $cat['categoryname'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="row" style="margin: 0px;">
            <div class="col-sm-12 col-lg-12">
                <label>ประเภท</label>
                <input class="form-control input-sm" id="type_name" name="type_name" type="text" placeholder="ชื่อประเภทสินค้า ..." value="<?php echo $type['type_name'] ?>"/>
            </div>
            <br/>

        </div>
    </div>
    <div class="panel-footer">
        <div class="btn btn-success" onclick="edit_type();">
            <i class="fa fa-save" id="loading"></i> 
            แก้ไขข้อมูล</div>
    </div>
</div>

<div id="resultType"></div>

<script type="text/javascript">
    getType('<?php echo $type['category'] ?>');
    function getType(id) {
        var url = "<?php echo Yii::app()->createUrl("backend/typeproduct/gettype") ?>";
        var data = {category: id};

        $.post(url, data, function (datas) {
            $("#resultType").html(datas);
        });
    }
</script>




