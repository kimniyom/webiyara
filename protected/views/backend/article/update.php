<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/ckfinder.js"></script>
<?php $Config = new Configweb_model(); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#file_upload').uploadifive({
            'buttonText': 'select photo ...',
            'uploadScript': '<?php echo Yii::app()->createUrl('backend/article/upload', array('id' => $id)) ?>',
            'auto': true,
            'fileSizeLimit': '<?php echo $Config->SizeFileUpload() ?>',
            'fileType': ["image/jpeg", "image/png", "image/PNG", "image/JPG", "image/JPEG"],
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
                var id = data;
                window.location = "<?php echo Yii::app()->createUrl('backend/article/view/id/') ?>" + "/" + id;
            }
        });
    });


    function check_form() {
        var url = "<?php echo Yii::app()->createUrl('backend/article/save_update') ?>";
        var id = "<?php echo $rs['id'] ?>";
        var title = $("#title").val();
        var category = $("#category").val();
        var msg = CKEDITOR.instances.msg.getData();
        var data = {
            id: id,
            title: title,
            msg: msg,
            category: category
        };
        if (title == '' || msg == '') {
            $("#f_error").show().delay(5000).fadeOut(500);
            return false();
        }

        $.post(url, data, function (success) {
            $('#file_upload').uploadifive('upload');
            window.location = "<?php echo Yii::app()->createUrl('backend/article/view/id/') ?>" + "/" + id;
        });
    }
</script>
<?php
$this->breadcrumbs = array(
    "article" => array('backend/article'),
    $rs['title']
        )
?>

<div class="panel panel-default">
    <div class="panel-body">
        <label>Category</label>
        <select id="category" class="form-control">
            <option value="">== Select ==</option>
        <?php foreach($category as $rss): ?>
            <option value="<?php echo $rss['id'] ?>" <?php echo ($rss['id'] == $rs['category']) ? "selected" : ""; ?>><?php echo $rss['category'] ?></option>
        <?php endforeach; ?>
        </select>
        <label>Title</label>
        <input type="text" id="title" name="title" class="form-control" value="<?php echo $rs['title']?>"/>
        <label>Detail</label>
        <textarea id="msg" name="msg" rows="5" class="form-control input-sm" required="required"><?php echo $rs['detail']?></textarea>
        <label>Photo</label><br/>
        <img src="<?php echo Yii::app()->baseUrl;?>/uploads/article/<?php echo $rs['images']?>" style=" max-width: 80px;"/><br/><br/>
        <input type="hidden" id="images" name="images" />
        <input type="file" name="file_upload" id="file_upload" />
        (filetype jpg,png filelimit 2MB)
    </div>
    <div class="panel-footer">
        <button type="button" class="btn btn-default" style="border-radius:0px;"
                onclick="check_form()"><i class="fa fa-save"></i> Save</button>

        <font style="color:#ff3300; display: none;" id="f_error">Warning...</font>
    </div>
</div>


<script>
    //Modify By Kimniyom
    CKEDITOR.replace('msg', {
        language: 'th',
        //uiColor: '#FFFFFF',
        toolbarGroups: [
            //{name: 'clipboard', groups: ['clipboard', 'undo']},
            //{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ] },
            {name: 'links'},
            {name: 'insert'},
            //{ name: 'forms' },
            {name: 'tools'},
            //{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
            //{ name: 'others' },
            '/',
            {name: 'basicstyles', groups: ['basicstyles', 'cleanup']},
            {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi']},
            {name: 'styles'},
            {name: 'colors'},
            //{ name: 'about' }
        ],
        removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar,Language,Flash',
        image_removeLinkByEmptyURL: true,
        filebrowserBrowseUrl: "<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/ckfinder.html",
        filebrowserImageBrowseUrl: "<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/ckfinder.html?Type=Images",
        filebrowserFlashBrowseUrl: "<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/ckfinder.html?Type=Flash",
        filebrowserUploadUrl: "<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files",
        filebrowserImageUploadUrl: "<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images",
        filebrowserFlashUploadUrl: "<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash"
    });

</script>

