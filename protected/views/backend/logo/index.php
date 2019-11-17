<?php
$Config = new Configweb_model();
?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#Filedata').uploadifive({
            'buttonText': 'กรุณาเลือกรูปภาพ ...',
            'auto': true, //เปิดใช้การอัพโหลดแบบอัติโนมัติ
            //'swf': '<?php //echo Yii::app()->baseUrl          ?>/assets/uploadify/uploadify.swf', //โฟเดอร์ที่เก็บไฟล์ปุ่มอัพโหลด
            'uploadScript': "<?= Yii::app()->createUrl('backend/logo/saveupload') ?>",
            'fileSizeLimit': '<?php echo $Config->SizeFileUpload() ?>', //อัพโหลดได้ครั้งละไม่เกิน 1024kb
            /*
             'width': '350',
             'height': '40',
             */
            'fileType': ["image/jpg", "image/jpeg", "image/png", "image/PNG", "image/JPG", "image/JPEG"], //กำหนดชนิดของไฟล์ที่สามารถอัพโหลดได้
            'multi': true, //เปิดใช้งานการอัพโหลดแบบหลายไฟล์ในครั้งเดียว
            'queueSizeLimit': 1, //อัพโหลดได้ครั้งละ 5 ไฟล์
            'onUploadComplete': function (file, data, response) {
                if (data == 2) {
                    alert("ขนาดไฟล์ 258 x 59 px เท่านั้น...!");
                    return false;
                } else {
                    window.location.reload();
                }
                //window.location.reload();
            }
        });
    });
</script>

<?php
$this->breadcrumbs = array(
    "LOGO"
);
?>

<div class="well well-sm">
    <h4 style=" font-size: 20px; color: #ff0000;">
        <i class="fa fa-smile-o"></i> โลโก้
    </h4>
</div>
<div class="row">
    <div class="col-md-6 col-lg-5">
        <div class="panel panel-default">
            <div class="panel-heading">อัพโหลด</div>
            <div class="panel-body">
                <div class="upload">
                    <ul style=" font-size: 12px;">
                        <li>อัพโหลดได้เฉพาะ .jpg , .png</li>
                        <li>อัพโหลดได้ไม่เกินครั้งละ <?php echo $Config->SizeFileUpload() ?></li>
                        <li>อัพโหลดได้ไม่เกินครั้งละ 1 ไฟล์</li>
                        <li>ขนาด 258 x 59 px</li>
                    </ul>
                    <form>
                        <div id="queue"></div>
                        <div style="width:350px; float:left;">
                            <input id="Filedata" name="Filedata" type="file" multiple="true">
                            <p style="color:#ff0000;">*ขนาด 258 x 59 px</p>
                        </div>
                        <div style="width:300px; float:left;">
                            <!--
                            <a href="javascript:$('#Filedata').uploadify('upload')" style="float:left; cursor:pointer;">
                                <input type="button" class="btn btn-success" value="อัพโหลดรูปภาพ"/>
                            </a>
                            -->
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-7">
        <div class="panel panel-default">
            <div class="panel-heading">LOGO</div>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>LOGO</th>
                        <th style="text-align:center;">STATUS</th>
                        <th style="text-align:center;">DELETE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($logo as $rs): $i++;
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td>
                                <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/logo/<?php echo $rs['logo']; ?>" class="img-resize" style="max-width:50px;"/>
                            </td>
                            <td style="text-align:center;">
                                <?php if ($rs['active'] == '1') { ?>
                                    <input id="status" name="status" class="styled" type="radio" checked="checked"  onclick="set_active('<?php echo $rs['id'] ?>');">
                                <?php } else { ?>
                                    <input id="status" name="status" class="styled" type="radio" onclick="set_active('<?php echo $rs['id'] ?>');">
                                <?php } ?>
                            </td>
                            <td style="text-align:center;">
                                <button type="button" class="btn btn-danger btn-sm" onclick="delete_logo('<?php echo $rs['id'] ?>')"><i class="fa fa-trash"></i> delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php
            if (empty($logo)) {
                echo "<div class='well'><center>ไม่มีข้อมูล</center></div>";
            }
            ?>
        </div>

    </div>
</div>



<script type="text/javascript">
    function set_active(id) {
        var url = "<?php echo Yii::app()->createUrl('backend/logo/set_active') ?>";
        var data = {id: id};
        $.post(url, data, function (success) {
            window.location.reload();
        });
    }

    function delete_logo(id) {
        var r = confirm("คุณแน่ใจหรือไม่ ...");
        var url = "<?php echo Yii::app()->createUrl('backend/logo/delete') ?>";
        var data = {id: id};
        if (r == true) {
            $.post(url, data, function (success) {
                window.location.reload();
            });
        }
    }
</script>
