<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/ckfinder.js"></script>

<?php
$title = "ช่องทางแจ้งการชำระเงิน";
$this->breadcrumbs = array(
   
    $title,
);
?>

<textarea id="detail" name="detail" rows="3" class="form-control input-sm" required="required"><?php echo $popup['detail'] ?></textarea>
<hr/>
<button type="button" class="btn btn-default" onclick="save()">บันทึก</button>

<script type="text/javascript">
    function save() {
        var url = "<?php echo Yii::app()->createUrl('backend/payment/savepopup') ?>";
        var id = "<?php echo $popup['id'] ?>"
        var detail = CKEDITOR.instances.detail.getData();
        if (detail == "") {
            alert("กรอกข้อมูลไม่ครบ...");
            return false;
        }
        var data = {id: id, detail: detail};
        $.post(url, data, function (datas) {
            window.location.reload();
        });
    }
CKEDITOR.replace('detail', {
        image_removeLinkByEmptyURL: true,
//extraPlugins: 'image',
//removeDialogTabs: 'link:upload;image:Upload',
//filebrowserBrowseUrl: 'imgbrowse/imgbrowse.php',
//filebrowserUploadUrl: 'ckupload.php',

        toolbarGroups: [
            //{name: 'clipboard', groups: ['clipboard', 'undo']},
            //{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ] },
            {name: 'links'},
            {name: 'insert'},
            //{ name: 'forms' },
            {name: 'tools'},
            //{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
            //{ name: 'others' },
            //'/',
            {name: 'basicstyles', groups: ['basicstyles', 'cleanup']},
            {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi']},
            {name: 'styles'},
            {name: 'colors'}
            //{ name: 'about' }
        ],
        removeButtons: 'Strike,Subscript,Superscript,Anchor,Styles,Specialchar,Language,Flash',
        filebrowserBrowseUrl: "<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/ckfinder.html",
        filebrowserImageBrowseUrl: "<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/ckfinder.html?Type=Images",
        filebrowserFlashBrowseUrl: "<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/ckfinder.html?Type=Flash",
        filebrowserUploadUrl: "<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files",
        filebrowserImageUploadUrl: "<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images",
        filebrowserFlashUploadUrl: "<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash"
    });

</script>