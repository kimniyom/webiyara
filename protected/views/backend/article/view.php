<?php $config = new Configweb_model(); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#file_upload').uploadifive({
            'buttonText': 'select photo ...',
            'uploadScript': '<?php echo Yii::app()->createUrl('backend/article/gallery', array('id' => $result['id'])) ?>',
            'auto': true,
            'removeCompleted' : true,
            'fileSizeLimit': '<?php echo $config->SizeFileUpload() ?>',
            'fileType': ["image/jpeg", "image/jpg", "image/JPG", "image/JPEG"],
            'queueSizeLimit': 5, //อัพโหลดได้ครั้งละ 5 ไฟล์
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
                loadgallery();
            }
        });
    });
</script>
<?php
$this->breadcrumbs = array(
    "article all" => array('backend/article'),
    $result['title'],
);
?>
<div class="pull-right">
    <a href="<?php echo Yii::app()->createUrl('backend/article/update/id/' . $result['id']) ?>">
        <button type="button" class="btn btn-warning btn-sm" title="edit"><i class="fa fa-edit"></i> edit</button></a>
    <button type="button" class="btn btn-danger btn-sm" title="delete" onclick="delete_article('<?php echo $result['id'] ?>')"><i class="fa fa-trash"></i> delete</button>
</div>
<div class="well" style="border-left: solid #009900 3px; border-radius: 0px; background: none;">
    <div class="row">
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
            <?php if (!empty($result['images'])) { ?>
                <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/article/200-<?php echo $result['images'] ?>" style=" max-width: 100%;" class="img-responsive"/>
            <?php } else { ?>
                <img src="<?php echo Yii::app()->baseUrl; ?>/images/No_image.jpg" style=" max-width: 100%;" class="img-responsive"/>
            <?php } ?>
        </div>
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
            <h4><?php echo $result['title'] ?></h4>
        </div>
    </div>

</div>

<div class="well" style="border-radius: 0px; background: none;">
    <?php echo $result['detail']; ?><br/><br/>
    <i class="fa fa-user"></i> <?php echo $result['name'] . ' ' . $result['lname'] ?>
    <i class="fa fa-calendar"></i> <?php echo $result['create_date'] ?>
    <br/><br/>
    <h4>Gallery</h4>
    <input type="file" name="file_upload" id="file_upload" />
    (filetype jpg limit 2MB)
    <div id="gallery"></div>
</div>

<script>
    loadgallery();
    function delete_article(id) {
        var url = "<?php echo Yii::app()->createUrl('backend/article/delete') ?>";
        var r = confirm("คุณแน่ใจหรือไม่ ...?");
        var data = {id: id};
        if (r == true) {
            $.post(url, data, function (success) {
                window.location = "<?php echo Yii::app()->createUrl('backend/article') ?>";
            });
        }
    }

    function loadgallery() {
        var url = "<?php echo Yii::app()->createUrl('backend/article/getgallery') ?>";
        var article = "<?php echo $result['id'] ?>";
        var data = {article: article};
        $.post(url, data, function (datas) {
            $("#gallery").html(datas);
        });
    }

    function DeletGallery(id) {
        var url = "<?php echo Yii::app()->createUrl('backend/article/deletegallery') ?>";
        var data = {id: id};
        $.post(url, data, function (datas) {
            loadgallery();
        });
    }
</script>