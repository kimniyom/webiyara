<?php
$Config = new Configweb_model();
$Background = $Config->GetBackground();
$Option = $Config->GetBackgroundOption();
if ($Option == 1) {
    $style = "background-repeat: no-repeat;background-attachment: fixed;";
} else if ($Option == 2) {
    $style = "height: 100%;background-position: center;background-repeat: no-repeat;background-size: cover;";
} else {
    $style = "";
}
?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#Filedata').uploadifive({
            'buttonText': 'select photo ...',
            'auto': true, //เปิดใช้การอัพโหลดแบบอัติโนมัติ
            //'swf': '<?php //echo Yii::app()->baseUrl                                                            ?>/assets/uploadify/uploadify.swf', //โฟเดอร์ที่เก็บไฟล์ปุ่มอัพโหลด
            'uploadScript': "<?= Yii::app()->createUrl('backend/background/saveupload') ?>",
            'fileSizeLimit': '<?php echo $Config->SizeFileUpload() ?>', //อัพโหลดได้ครั้งละไม่เกิน 1024kb
            /*
             'width': '350',
             'height': '40',
             */
            'fileType': ["image/jpg", "image/jpeg", "image/png", "image/PNG", "image/JPG", "image/JPEG"], //กำหนดชนิดของไฟล์ที่สามารถอัพโหลดได้
            'multi': true, //เปิดใช้งานการอัพโหลดแบบหลายไฟล์ในครั้งเดียว
            'queueSizeLimit': 1, //อัพโหลดได้ครั้งละ 5 ไฟล์
            'onUploadComplete': function(file, data, response) {
                window.location.reload();
                //window.location.reload();
            }
        });
    });
</script>

<?php
$this->breadcrumbs = array(
    "Background"
);
?>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Background</div>
            <div class="panel-body">
                <div class="upload">
                    <?php if ($Background['id'] == 1) { ?>
                        <div style="height: 100px; width: 200px; background: #000000; float: left; margin-right: 20px;"></div>
                    <?php } else { ?>
                        <div style="height: 100px; width: 200px; float: left; margin-right: 20px; overflow: hidden;">
                            <img src="<?php echo Yii::app()->baseUrl ?>/uploads/background/<?php echo $Background['background'] ?>" style=" width:200px;"/>
                        </div>
                    <?php } ?>
                    <div style=" margin-left: 20px;">
                        <ul style=" font-size: 12px;">
                            <li>File Type .jpg , .png</li>
                            <li>Limit size <?php echo $Config->SizeFileUpload() ?></li>
                        </ul>
                        <form>
                            <div id="queue"></div>
                            <div style="width:350px; float:left;">
                                <input id="Filedata" name="Filedata" type="file" multiple="true">
                            </div>
                            <div style="width:300px; float:left;">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-lg-7">
        <div class="panel panel-default">
            <div class="panel-heading">Background</div>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Background</th>
                        <th style="text-align:center;">Active</th>
                        <th style="text-align:center;">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($background as $rs): $i++;
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td>
                                <?php if ($rs['id'] == 1) { ?>
                                    None background
                                <?php } else { ?>
                                    <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/background/<?php echo $rs['background']; ?>" class="img-resize" style="max-width:50px;"/>
                                <?php } ?>
                            </td>
                            <td style="text-align:center;">
                                <?php if ($rs['active'] == '1') { ?>
                                    <input id="status" name="status" class="styled" type="checkbox" checked="checked"  onclick="set_active('<?php echo $rs['id'] ?>');">
                                <?php } else { ?>
                                    <input id="status" name="status" class="styled" type="checkbox" onclick="set_active('<?php echo $rs['id'] ?>');">
                                <?php } ?>
                            </td>
                            <td style="text-align:center;">
                                <?php if ($rs['id'] != '1') { ?>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="delete_logo('<?php echo $rs['id'] ?>')"><i class="fa fa-trash"></i> delete</button>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php
            if (empty($background)) {
                echo "<div class='well'><center>No Result</center></div>";
            }
            ?>
        </div>

    </div>
    <div class="col-md-6 col-lg-5">
        <div class="panel panel-default">
            <div class="panel-heading">Option</div>
            <div class="panel-body">
                <ul class="list-group">
                    <li class="list-group-item"><input type="radio" name="option" checked="<?php echo ($Option == 2) ? "checked" : ""; ?>" onclick="setOption('2')"/> full screen</li>
                    <li class="list-group-item"><input type="radio" name="option"  <?php echo ($Option == 1) ? "checked" : ""; ?> onclick="setOption('1')"/> fixed</li>
                    <li class="list-group-item"><input type="radio" name="option" <?php echo ($Option == 0) ? "checked" : ""; ?>  onclick="setOption('0')"/> repeat</li>
                </ul>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    function set_active(id) {
        var url = "<?php echo Yii::app()->createUrl('backend/background/set_active') ?>";
        var data = {id: id};
        $.post(url, data, function(success) {
            window.location.reload();
        });
    }

    function delete_logo(id) {
        var r = confirm("Are you sure ...");
        var url = "<?php echo Yii::app()->createUrl('backend/background/delete') ?>";
        var data = {id: id};
        if (r == true) {
            $.post(url, data, function(success) {
                window.location.reload();
            });
        }
    }

    function setOption(option) {
        var url = "<?php echo Yii::app()->createUrl('backend/background/setoption') ?>";
        var data = {option: option};
        $.post(url, data, function(success) {
            window.location.reload();
        });
    }
</script>
