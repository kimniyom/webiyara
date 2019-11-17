<style>
    .well{
        background: #FFFFFF;
    }

    /*
    .box-center{
        width: 100%;margin-left: auto;margin-right: auto;position: absolute;top: 50%;transform: translateY(-50%);
        word-wrap: break-word;
        padding: 20px;
        text-align: center;
    }

    .box-top-center{
        width: 100%;margin-left: auto;margin-right: auto;position: absolute;top:0px;
        word-wrap: break-word;
        padding: 20px;
        text-align: center;
    }
    */

    ul{
        list-style-type: none;
    }
</style>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/ckfinder.js"></script>
<?php $Config = new Configweb_model(); ?>
<script type="text/javascript">
    $(document).ready(function() {
        //load_data();
        $('#Filedata').uploadifive({
            /*'buttonText': 'กรุณาเลือกรูปภาพ ...',*/
            'auto': true, //เปิดใช้การอัพโหลดแบบอัติโนมัติ
            buttonText: "Select Image",
            //'buttonImage': '<?//= Yii::app()->baseUrl ?>/images/image-up-icon.png',

            'uploadScript': "<?= Yii::app()->createUrl('backend/page/uploadify') ?>",
            'fileSizeLimit': '<?php echo $Config->SizeFileUpload() ?>', //อัพโหลดได้ครั้งละไม่เกิน 1024kb
            //'width': '128',
            //'height': '132',
            'fileType': ["image/png", "image/jpg", "image/jpeg", "image/JPG", "image/JPEG"], //กำหนดชนิดของไฟล์ที่สามารถอัพโหลดได้
            'multi': false, //เปิดใช้งานการอัพโหลดแบบหลายไฟล์ในครั้งเดียว
            'removeCompleted': true,
            'queueSizeLimit': 1, //อัพโหลดได้ครั้งละ 5 ไฟล์
            'onUpload': function() {
                $('#Filedata').data('uploadifive').settings.formData = {
                    id: $("#iduploads").val()
                }
            },
            'onUploadComplete': function(file, data, response) {
                //alert(data);
                //load_data();
            }
        });
    });

</script>
<?php
$this->breadcrumbs = array(
    'Page',
);
?>
<h4>Manage webpage</h4>
<div style="padding: 10px;">
    <?php $modelPage = new Page(); ?>
    <?php
    $r = 0;
    foreach ($layout as $rs):
        $r++;
        ?>
        <div class="row" style="margin-top:0px; clear: both;">
            <div class="col-md-12 col-lg-12" style="padding-left:0px;">
                <button type="button" class="btn btn-warning" style="z-index: 5;" onclick="deleteRow('<?php echo $rs['pageid'] ?>', '<?php echo $rs['row_id'] ?>')">
                    <i class="fa fa-trash"></i> Delete Row <?php echo $r ?>
                </button>
            </div>
            <?php
            for ($i = 1; $i <= ($rs['columns']); $i++):
                $contentLayout = $modelPage->getlayoutContent("0", $rs['row_id'], $i);
                ?>
                <div style="padding:0px;" class="<?php echo $rs['classname']; ?>">
                    <button type="button" class="btn btn-default" style="position: absolute; top: 0px; right: 80px; z-index: 5;" onclick="popupImages('<?php echo $contentLayout['id'] ?>')"><i class="fa fa-image"></i> Image</button>
                    <button type="button" class="btn btn-default" style="position: absolute; top: 0px; right: 0px; z-index: 5;" onclick="popupTextcontent('<?php echo $contentLayout['id'] ?>')"><i class="fa fa-pencil"></i> Text</button>
                    <!--
                        #### ถ้ามีรูปภาพ ####
                    -->
                    <?php if ($contentLayout['images']) { ?>
                        <?php if ($contentLayout['content']) { ?>
                            <div style="position: absolute; width: 100%; height: 100%;">
                                <div class="<?php echo $contentLayout['align'] ?>">
                                    <div style="font-family: Th;"><?php echo $contentLayout['content'] ?></div>
                                </div>
                            </div>
                        <?php } ?>
                        <img src="<?= Yii::app()->baseUrl; ?>/uploads/page/<?php echo $contentLayout['images'] ?>" alt="" class="img-responsive">
                    <?php } else { ?>
                        <?php if ($contentLayout['content']) { ?>
                            <div style="position: relative; width: 100%; min-height: 300px; padding: 20px;">
                                <div class="<?php echo $contentLayout['align'] ?>">
                                    <div style="font-family: Th;"><?php echo $contentLayout['content'] ?></div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div style="position: relative; width: 100%; min-height: 300px; padding: 20px;">
                                <div class="box-center" style=" border: #004b63 dashed 2px;">
                                    <div style="font-family: Th;">No Data</div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            <?php endfor; ?>
        </div>
    <?php endforeach; ?>
    <?php $rownew = ($r + 1) ?>
    <div class="row" style="margin-top:20px;">
        <div class="col-md-12 col-lg-12" style="padding:0px;">
            <button class="btn btn-primary btn-block" style=" border: darkgray dashed 3px; text-align: center;  height: 100px;" onclick="popupLayout()">
                <i class="fa fa-plus"></i> Add Row
            </button>
        </div>
    </div>
</div>

<!--
// Laypopup
-->

<div class="modal fade" tabindex="-1" role="dialog" id="popuplayout">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Layout</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <input name="layout" type="radio" checked="checked" value="1" style=" margin-left: 5px;"/> Select Layout 1
                        <img src="<?php echo Yii::app()->baseUrl ?>/images/layout/ly1.png" class="img-responsive" style=" max-height: 100px;"/>
                    </div>
                    <div class="col-lg-12">
                        <input name="layout" type="radio"  value="2" style=" margin-left: 5px;"/> Select Layout 2
                        <img src="<?php echo Yii::app()->baseUrl ?>/images/layout/ly2.png" class="img-responsive" style=" max-height: 100px;"/>
                    </div>
                    <div class="col-lg-12">
                        <input name="layout" type="radio" value="3" style=" margin-left: 5px;"/> Select Layout 3
                        <img src="<?php echo Yii::app()->baseUrl ?>/images/layout/ly3.png" class="img-responsive" style=" max-height: 100px;"/>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="addRow()">Save</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" tabindex="-1" role="dialog" id="popupText">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Text Content</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id" />
                <textarea id="text_contect" name="text_contect" rows="5" class="form-control"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="addTextcontent()">Save</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!--
    ##### Model Images #####
-->
<div class="modal fade" tabindex="-1" role="dialog" id="popupImages" data-backdrop="static">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="font-18">Upload Images</h4>
            </div>
            <div class="modal-body" style="overflow: auto;">
                <input type="hidden" id="iduploads"/>
                <input id="Filedata" name="Filedata" type="file" multiple="true">
                <hr/>
                <font id="font-16">
                *  Filelimit <?php echo $Config->LimitFileUpload() ?>
                <br/>* Filetype png,jpg
                <br/>* Filesizelimit <?php echo $Config->SizeFileUpload() ?>
                </font>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    //Modify By Kimniyom
    CKEDITOR.replace('text_contect', {
        image_removeLinkByEmptyURL: true,
        //extraPlugins: 'image',
        //removeDialogTabs: 'link:upload;image:Upload',
        //filebrowserBrowseUrl: 'imgbrowse/imgbrowse.php',
        //filebrowserUploadUrl: 'ckupload.php',
        //uiColor: '#AADC6E',
        toolbarGroups: [
            //{name: 'clipboard', groups: ['clipboard', 'undo']},
            //{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ] },
            //{name: 'links'},
            {name: 'insert'},
            //{ name: 'forms' },
            //{name: 'tools'},
            {name: 'document', groups: ['mode', 'document', 'doctools']},
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
    });</script>
<script type="text/javascript">
    function popupLayout() {
        $("#popuplayout").modal();
    }

    function popupTextcontent(id) {
        $("#popupText").modal();
        $("#id").val(id);
        getTextRow(id);
    }

    function popupImages(id) {
        $("#popupImages").modal();
        $("#iduploads").val(id);
    }
    function getTextRow(id) {
        var url = "<?php echo Yii::app()->createUrl('backend/page/getrow') ?>";
        var data = {id: id};
        $.post(url, data, function(datas) {
            // $("#text_contect").val(datas.content);
            CKEDITOR.instances.text_contect.setData(datas.content);
        }, 'Json');
    }

    function addRow() {
        var row = "<?php echo $rownew ?>";
        var pageid = "<?php echo $pageid ?>";
        var layout = $("input[name='layout']:checked").val();
        var url = "<?php echo Yii::app()->createUrl('backend/page/addrow') ?>";
        var data = {row: row, pageid: pageid, layout: layout};
        $.post(url, data, function(datas) {
            window.location.reload();
        });
    }

    function addTextcontent() {
        var content = CKEDITOR.instances.text_contect.getData();
        var id = $("#id").val();
        var url = "<?php echo Yii::app()->createUrl('backend/page/addcontent') ?>";
        var data = {
            id: id,
            content: content
        };
        $.post(url, data, function(datas) {
            window.location.reload();
        });
    }

    function deleteRow(pageid, rowid) {
        var r = confirm("Are you sure...");
        var url = "<?php echo Yii::app()->createUrl('backend/page/deleterow') ?>";
        var data = {
            pageid: pageid,
            rowid: rowid
        };

        if (r == true) {
            $.post(url, data, function(datas) {
                window.location.reload();
            });
        }
    }
</script>



