<?php
$this->breadcrumbs = array(
    $product['categoryname'] => array('backend/product/category/categoryID/' . $product['category']),
    $product['type_name'] => array('backend/product/getproduct/category/' . $product['category'] . '/type/' . $product['type_id']),
    $product['product_name'],
);

$Config = new Configweb_model();
$ProductModel = new Backend_Product();
?>
<style type="text/css">
    table tr td{ height:30px;}
    #im-resize{height: 75px; padding: 5px; margin-bottom: 5px;}
    #cart_box{
        float: right; margin-top: 0px; padding-top: 15px;
        position:fixed; top:10px; right:20px;z-index:3;
    }
    .well{
        background: #FFFFFF;
    }
    ul{
        list-style-type: none;
    }
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

    .vertical-center {
        height: 100%;
        position: relative;
        overflow:hidden;
        padding: 10px;
        text-align: center;
    }

    .vertical-center div {
        margin: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        word-wrap: break-word;

    }

    @media (min-width:992px){
        .vertical-center-none-img {
            height: 100%;
            position: relative;
            overflow:hidden;
            padding: 10px;
            text-align: center;
        }

        .vertical-center-none-img div {
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            word-wrap: break-word;
        }

        .v-none-img{
            position: absolute; width: 100%; height: 100%;
        }
    }
</style>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/ckfinder.js"></script>

<script type="text/javascript">
    function set_group_img(img) {
        $("#img_group").html("<img src='<?php echo Yii::app()->baseUrl ?>/uploads" + "/" + img + " ' width='80%' style='margin-right:20px;' />");
    }
    $(document).ready(function() {
        $('[data-toggle="popover"]').popover();
        $('.img_zoom').magnificPopup({
            delegate: 'a', // child items selector, by clicking on it popup will open
            type: 'image',
            gallery: {
                enabled: true
            }
            // other options
        });
    });

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
                window.location.reload();
                //alert(data);
                //load_data();
            }
        });
    });
</script>

<div class="row">
    <div class="col-lg-6 col-md-6 col-xs-12">
        <a href="<?php echo Yii::app()->createUrl('backend/product/update', array("product_id" => $product['product_id'])) ?>">
            <button type="button" class="btn btn-default"><i class="fa fa-pencil"></i> Update</button></a>
        <hr/>
        <font style=" color: #F00; font-size: 24px; font-weight: normal;">
        <img src="<?php echo Yii::app()->baseUrl; ?>/images/yellow-tag-icon.png"/>
        <?= $product['product_name'] ?>
        </font><br/>
        <b>Category</b> <?= $product['categoryname'] ?><br/>
        <b>Type</b> <?= $product['type_name'] ?><br/>
        <b>Last Update</b> <?php echo $product['d_update']; ?><br/><br/>
        <b>Description</b> <br/>
        <?php echo $product['description'] ?>
    </div>
</div>

<div style="padding: 10px;">
    <?php $modelPage = new Page(); ?>
    <?php
    $r = 0;
    foreach ($layout as $rs):
        $r++;
        $rowId = $rs['row_id'];
        $sql = "select count(*) as total from layoutcontent where pageid = '$pageid' and row_id = ' $rowId'  and images != '' ";
        $rsCount = Yii::app()->db->createCommand($sql)->queryRow();
        $rowImages = $rsCount['total'];

        //Reverse
        $sqlReverse = "select * from layoutreverse where pageid = '$pageid' and rowid = '$rowId'";
        $rsReverse = Yii::app()->db->createCommand($sqlReverse)->queryRow();
        if ($rsReverse['rowid'] == $rowId) {
            $revers = "1";
        } else {
            $revers = "0";
        }
        ?>
        <style type="text/css">
            @media (min-width:992px){
                .row.display-flex<?php echo $r ?> {
                    display: flex;
                    flex-wrap: wrap;
                }
                .row.display-flex<?php echo $r ?> > [class*='col-'] {
                    display: flex;
                    flex-direction: column;
                }
            }
        </style>
        <div class="row" style="margin-top:0px; clear: both;">
            <div class="col-md-12 col-lg-12" style="padding-left:0px;">
                <button type="button" class="btn btn-link" style="z-index: 5;" onclick="deleteRow('<?php echo $rs['pageid'] ?>', '<?php echo $rs['row_id'] ?>')">
                    <i class="fa fa-trash"></i> Delete Row <?php echo $r ?>
                </button>
                <!-- ถ้า columns = 2-->
                <?php if ($rs['columns'] == 2) { ?>
                    <?php if ($revers == 1) { ?>
                        <input type="checkbox" checked="checked" onclick="delRevers('<?php echo $rs['pageid'] ?>', '<?php echo $rs['row_id'] ?>')"/> Reverse Columns Responsive
                    <?php } else { ?>
                        <input type="checkbox" onclick="addRevers('<?php echo $rs['pageid'] ?>', '<?php echo $rs['row_id'] ?>')"/> Reverse Columns Responsive
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
        <div class="row display-flex<?php echo $r ?>">
            <?php
            if ($revers == 1) {
                $reversClassLeft = " col-md-push-6";
                $reversClassRight = " col-md-pull-6";
            } else {
                $reversClassLeft = "";
                $reversClassRight = "";
            }

            for ($i = 1; $i <= ($rs['columns']); $i++):
                $contentLayout = $modelPage->getlayoutContent($pageid, $rs['row_id'], $i);
                if ($i == 1) {
                    $classRevers = $reversClassLeft;
                } else if ($i == 2) {
                    $classRevers = $reversClassRight;
                }
                ?>
                <div style="padding:0px;" class="<?php echo $rs['classname']; ?> <?php echo $classRevers ?>">
                    <div class="btn-group pull-right" role="group" aria-label="..." style="position: absolute; top: 0px; right: 0px; z-index: 5; opacity: 0.8;">
                        <button type="button" class="btn btn-primary btn-sm" title="image" onclick="popupImages('<?php echo $contentLayout['id'] ?>')"><i class="fa fa-image"></i></button>
                        <button type="button" class="btn btn-primary btn-sm" title="content" onclick="popupTextcontent('<?php echo $contentLayout['id'] ?>')"><i class="fa fa-pencil"></i></button>
                        <button type="button" class="btn btn-primary btn-sm" title="link" onclick="popupLink('<?php echo $contentLayout['id'] ?>')"><i class="fa fa-link"></i></button>
                    </div>
                    <!--
                        #### ถ้ามีรูปภาพ ####
                    -->
                    <?php if ($contentLayout['images']) { ?>
                        <?php if ($contentLayout['content'] || $contentLayout['link']) { ?>
                            <div style="position: absolute; width: 100%; height: 100%;">
                                <div class="vertical-center">
                                    <div><?php echo $contentLayout['content'] ?>
                                        <?php if ($contentLayout['link']) { ?>
                                            <a href="<?php echo $contentLayout['link'] ?>" class="btn btn-text" target="_bank"><?php echo $contentLayout['linktext'] ?></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <img src="<?= Yii::app()->baseUrl; ?>/uploads/page/<?php echo $contentLayout['images'] ?>" alt="" class="img-responsive">
                    <?php } else { ?>
                        <?php if ($contentLayout['content'] || $contentLayout['link']) { ?>

                            <div class="<?php echo ($rowImages > 0) ? 'v-none-img' : '' ?>">
                                <div class="<?php echo ($rowImages > 0) ? ' vertical-center-none-img' : '' ?>">
                                    <div>
                                        <?php echo $contentLayout['content'] ?>
                                        <?php if ($contentLayout['link']) { ?>
                                            <center>
                                                <a href="<?php echo $contentLayout['link'] ?>" class="btn btn-text" target="_bank"><?php echo $contentLayout['linktext'] ?></a>
                                            </center>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div style="position: relative; width: 100%; height: 100%;  margin-top: 30px;">
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
    <div class="row" style="margin-top:50px;">
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

<!--
<div class="modal fade" tabindex="-1" role="dialog" id="popupText">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Text Content</h4>
          </div>
          <div class="modal-body">

              <input type="hidden" id="id" />
              <textarea id="text_contect" name="text_contect" rows="5" class="form-control" style="z-index:20;"></textarea>

          </div>

          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="addTextcontent()">Save</button>
          </div>
      </div>
  </div>
</div>
-->


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


<div class="modal fade" tabindex="-1" role="dialog" id="popupLink">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Link</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="idlink"/>
                <label>Link Url</label>
                <input type="text" id="link"  class="form-control"/>
                <label>Link Text</label>
                <input type="text" id="linktext"  class="form-control"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="addLink()">Save</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<div id="popupText" style="width:100%; height:100%; position: fixed; display: none;top:0px; right: 0px;z-index:10000;background: url('<?php echo Yii::app()->baseUrl ?>/images/black-glass-boxtext.png')">
    <div style="padding:20px; max-width:700px; min-width:300px; margin:auto; margin-top: 50px;background:#333333;">
        <p style="cursor: pointer;" onclick="hidePopup()">
            <i class="fa fa-remove"></i> Close
        </p>
        <hr/>
        <input type="hidden" id="id" />
        <textarea id="text_contect" name="text_contect" rows="5" class="form-control" style="z-index:20;"></textarea>
        <hr/>
        <div style="height:30px;">
            <button type="button" class="btn btn-success btn-sm pull-right" onclick="addTextcontent()"><i class='fa fa-save'></i> Save</button>
        </div>
    </div>
</div>



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
    function hidePopup() {
        $("#popupText").hide();
    }
    function popupLayout() {
        $("#popuplayout").modal();
    }

    function popupTextcontent(id) {
        $("#popupText").show();
        $("#id").val(id);
        getTextRow(id);
    }

    function popupImages(id) {
        $("#popupImages").modal();
        $("#iduploads").val(id);
    }

    function popupLink(id) {
        $("#popupLink").modal();
        $("#idlink").val(id);
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

    function addLink() {
        var id = $("#idlink").val();
        var link = $("#link").val();
        var linktext = $("#linktext").val();

        var url = "<?php echo Yii::app()->createUrl('backend/page/addlink') ?>";
        var data = {
            id: id,
            link: link,
            linktext: linktext
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

    function delRevers(pageId, rowId) {
        var url = "<?php echo Yii::app()->createUrl('backend/page/delrevers') ?>";
        var data = {
            pageid: pageId,
            rowid: rowId
        };
        $.post(url, data, function(datas) {
            window.location.reload();
        });
    }

    function addRevers(pageId, rowId) {
        var url = "<?php echo Yii::app()->createUrl('backend/page/addrevers') ?>";
        var data = {
            pageid: pageId,
            rowid: rowId
        };
        $.post(url, data, function(datas) {
            window.location.reload();
        });
    }

</script>
