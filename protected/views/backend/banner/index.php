<?php
$Config = new Configweb_model();
?>

<script type="text/javascript">
    $(document).ready(function () {
        $('#Filedata').uploadifive({
            'buttonText': 'กรุณาเลือกรูปภาพ ...',
            'auto': false, //เปิดใช้การอัพโหลดแบบอัติโนมัติ
            //'swf': '<?php //echo  Yii::app()->baseUrl            ?>/assets/uploadify/uploadify.swf', //โฟเดอร์ที่เก็บไฟล์ปุ่มอัพโหลด
            'uploadScript': "<?= Yii::app()->createUrl('backend/banner/uploadify', array("id" => $id)) ?>",
            'fileSizeLimit': '<?php echo $Config->SizeFileUpload() ?>', //อัพโหลดได้ครั้งละไม่เกิน 2MB
            //'width': '350',
            //'height': '40',
            'fileType': ["image/gif", "image/jpeg", "image/png", "image/PNG", "image/JPG", "image/JPEG"], //กำหนดชนิดของไฟล์ที่สามารถอัพโหลดได้
            'multi': false, //เปิดใช้งานการอัพโหลดแบบหลายไฟล์ในครั้งเดียว
            'queueSizeLimit': 1, //อัพโหลดได้ครั้งละ 5 ไฟล์
            'onAddQueueItem': function (file) {
                $("#images").val(file.name);
            },
            'onError': function (errorType) {
                alert('The error was: ' + errorType);
                $("#images").val("");
            },

            'onCancel': function (file) {
                $("#images").val("");
            },
            'onUploadComplete': function (file, data, response) {
                window.location.reload();
            }
        });
    });


</script>

<?php
$this->breadcrumbs = array(
    "BANNER"
);
?>

<div class="panel panel-default">
    <div class="panel-heading"><b>อัพโหลดรูปภาพ</b></div>
    <div class="panel-body">
        <label>Title</label>
        <input type="text" class="form-control" id="title"/>
        <label>Link</label>
        <input type="text" class="form-control" id="link"/>
        <label>Detail</label>
        <textarea id="detail" class="form-control" rows="5"></textarea>
        <br/>
        <label>Text-Color</label>
        <input type="color" value="#000000" id="color">
        <hr/>
        <div class="upload">
            <input type="hidden" id="images"/>
            <ul style=" font-size: 14px; color: #ff3300;">
                <li>อัพโหลดได้เฉพาะ .jpg , .png</li>
                <li>อัพโหลดได้ไม่เกินครั้งละ 2MB</li>
                <li>รูปภาพจะแสดงผลได้ดีที่ขนาด 1900 x 900 พิกเซล</li>
            </ul>
            <form>
                <div id="queue"></div>
                <div style="width:350px; float:left;">
                    <input  name="Filedata" id="Filedata" type="file">
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
    <div class="panel-footer">
        <button type="button" class="btn btn-default" onclick="Save()"><i class="fa fa-save"></i> บันทึก</button>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">BANNER</div>
    <table class="table">
        <thead>
            <tr>
                <th>BANNER</th>
                <th></th>
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
                    <td>
                        <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/banner/thumbnail/<?php echo $rs['banner_images']; ?>" class="img-resize" style="max-width:200px;"/>
                    </td>
                    <td>
                        <?php echo $rs['title'] ?><br/>
                        <?php echo $rs['detail'] ?>
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

<script type="text/javascript">

    function set_active(id, status) {
        var url = "<?php echo Yii::app()->createUrl('backend/banner/set_active') ?>";
        var data = {banner_id: id, status: status};
        $.post(url, data, function (success) {

        });
    }

    function Save() {
        var url = "<?php echo Yii::app()->createUrl('backend/banner/save') ?>";
        var title = $("#title").val();
        var color = $("#color").val();
        var link = $("#link").val();
        var detail = $("#detail").val();
        var img = $("#images").val();
        var id = "<?php echo $id ?>";
        if (img == "") {
            alert('ยังไม่ได้เลือกรูปภาพ...');
            return false;
        }

        if (img == "") {
        }
        var data = {id: id,title: title, link: link, detail: detail, color: color};

        $.post(url, data, function (success) {
            if (success == 1) {
                $('#Filedata').uploadifive('upload');
            }
        });
    }

    function delete_banner(id) {
        var r = confirm("คุณแน่ใจหรือไม่ ...");
        var url = "<?php echo Yii::app()->createUrl('backend/banner/delete') ?>";
        var data = {banner_id: id};
        if (r == true) {
            $.post(url, data, function (success) {
                window.location.reload();
            });
        }
    }
</script>
