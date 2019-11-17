<div class="panel panel-default">
    <div class="panel-heading">BANNER</div>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>BANNER</th>
                <th style="text-align:center;">STATUS</th>
                <th style="text-align:center;">DELETE</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($banner as $rs): $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td>
                        <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/banner/<?php echo $rs['banner_images']; ?>" class="img-resize" style="max-width:200px;"/>
                    </td>
                    <td style="text-align:center;">
            <center>
                <?php if ($rs['status'] == '1') { ?>
                    <input id="status" name="status" class="styled" type="checkbox" checked="checked"  onclick="set_active('<?php echo $rs['banner_id'] ?>', '0');">
                <?php } else { ?>
                    <input id="status" name="status" class="styled" type="checkbox" onclick="set_active('<?php echo $rs['banner_id'] ?>', '1');">
                <?php } ?>
            </center>
            </td>
            <td style="text-align:center;">
                <button type="button" class="btn btn-danger btn-sm" onclick="delete_banner('<?php echo $rs['banner_id'] ?>')"><i class="fa fa-trash"></i> delete</button>
            </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>