<table class="table table-striped table-hover" id="product_type">
    <thead>
        <tr>
            <th>TypeID</th>
            <th>TypeName</th>
            <th style=" text-align: center;">Setting</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($type as $rs): ?>
            <tr>
                <td><?php echo $rs['type_id'] ?></td>
                <td><?php echo $rs['type_name'] ?></td>
                <td style=" text-align: center;">
                    <a href="<?php echo Yii::app()->createUrl('backend/typeproduct/edit', array('id' => $rs['id'])) ?>">
                        <div class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</div></a>
                    <div class="btn btn-default btn-xs" onclick="deleteType('<?php echo $rs['type_id'] ?>')"><i class="glyphicon glyphicon-edit"></i> Delete</div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript">
    function deleteType(id) {
        var r = confirm("Are you sure ...?");
        if (r === true) {
            var url = "<?php echo Yii::app()->createUrl("backend/typeproduct/delete") ?>";
            var data = {typeId: id};

            $.post(url, data, function (success) {
                window.location.reload();
            });
        }
    }
</script>
