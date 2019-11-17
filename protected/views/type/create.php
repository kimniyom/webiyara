<?php
$this->breadcrumbs = array(
    'ProductType'
);
?>

<div class="panel panel-default">
    <div class="panel-heading">Types</div>
    <div class="panel-body">
        <div class="row" style="margin: 0px;">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <label>TypeID</label>
                <input class="form-control input-sm" id="type_id" name="type_id" type="text" value="<?php echo $type_id; ?>" readonly="readonly"/>
            </div>
        </div>
        <div class="row" style="margin: 0px;">
            <div class="col-sm-6 col-lg-6">
                <label>Category</label>
                <select id="category" class="form-control input-sm" onchange="getType(this.value)">
                    <option value="">== Select ==</option>
                    <?php foreach ($category as $cat): ?>
                        <option value="<?php echo $cat['id'] ?>"><?php echo $cat['categoryname'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="row" style="margin: 0px;">
            <div class="col-sm-12 col-lg-12">
                <label>ProductType</label>
                <input class="form-control input-sm" id="type_name" name="type_name" type="text" placeholder="TypeName ..."/>
            </div>
            <br/>

        </div>
    </div>
    <div class="panel-footer">
        <div class="btn btn-success" onclick="save_type();"><i class=" glyphicon glyphicon-save" id="loading"></i> Save</div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">ProductType</div>
    <div id="resultType"></div>
</div>

<script type="text/javascript">
    function save_type() {
        $("#loading").addClass("fa fa-spinner fa-spin");
        var url = "<?php echo Yii::app()->createUrl('backend/typeproduct/save_type') ?>";
        var type_id = $("#type_id").val();
        var type_name = $("#type_name").val();
        var category = $("#category").val();
        var data = {
            type_id: type_id,
            type_name: type_name,
            category: category
        };
        if (type_name == "" || category == "") {
            $("#loading").removeClass("fa fa-spinner fa-spin");
            $("#loading").addClass("fa fa-plus");
            $("#type_name").focus();
            return false;
        }

        $.post(url, data, function (success) {
            window.location.reload();
        });

    }

    function getType(id) {
        var url = "<?php echo Yii::app()->createUrl("backend/typeproduct/gettype") ?>";
        var data = {category: id};

        $.post(url, data, function (datas) {
            $("#resultType").html(datas);
        });
    }
</script>
