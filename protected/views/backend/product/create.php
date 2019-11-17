<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/ckfinder.js"></script>

<script src="<?= Yii::app()->baseUrl ?>/assets/uploadify/jquery.uploadify.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl ?>/assets/uploadify/uploadify.css">

<script type="text/javascript">
    $(document).ready(function () {
        //load_data();
        $('#Filedata').uploadify({
            /*'buttonText': 'กรุณาเลือกรูปภาพ ...',*/
            'auto': true, //เปิดใช้การอัพโหลดแบบอัติโนมัติ
            buttonText: "อัพโหลดรูปภาพ",
            //'buttonImage': '<?//= Yii::app()->baseUrl ?>/images/image-up-icon.png',
            'swf': '<?= Yii::app()->baseUrl ?>/assets/uploadify/uploadify.swf', //โฟเดอร์ที่เก็บไฟล์ปุ่มอัพโหลด
            'uploader': "<?= Yii::app()->createUrl('backend/images/uploadify') ?>",
            'fileSizeLimit': '1MB', //อัพโหลดได้ครั้งละไม่เกิน 1024kb
            //'width': '128',
            //'height': '132',
            'fileTypeExts': '*.jpg;', //กำหนดชนิดของไฟล์ที่สามารถอัพโหลดได้
            'multi': true, //เปิดใช้งานการอัพโหลดแบบหลายไฟล์ในครั้งเดียว
            'queueSizeLimit': 5, //อัพโหลดได้ครั้งละ 5 ไฟล์
            'onUploadSuccess': function (file, data, response) {
                load_data();
            }
        });
    });

</script>

<?php
$title = "เพิ่มสินค้า";
$this->breadcrumbs = array(
    $type_name => array('backend/product/getproduct&type_id=' . $type_id),
    $title,
);
?>

<div class="well" style="width:100%;">
    <form class="form-horizontal">
        <fieldset>
            <legend>
                <span class="label label-warning">
                    <img src="<?php echo Yii::app()->baseUrl; ?>/images/add-product-icon.png"/>
                    เพิ่มข้อมูลสินค้า
                </span>
            </legend>

            <div class="row">
                <div class="col-md-3 col-lg-3" id="p-left">
                    <div class="well" style=" border:#666666 dashed 2px; text-align: center; cursor: pointer;"
                         onclick="GetImages();">
                        <i class="fa fa-image fa-5x" style=" color: #cccccc;"></i><br/>
                        <i class="fa fa-plus"></i> <font id="font-20">เพิ่มรูปสินค้า</font>
                    </div>
                    <div id="load_images_product"></div>
                </div>
                <div class="col-md-9 col-lg-9" id="p-right">
                    <label for="">รหัสสินค้า</label>
                    <input type="text" id="product_id" name="product_id" class="form-control" value="<?php echo $product_id; ?>" readonly style="width:40%;"/>

                    <label for="">ชื่อสินค้า</label>
                    <input type="text" id="product_name" name="product_name" class="form-control" style="width:100%;" required="required"/>

                    <label for="">ราคา</label>
                    <input type="text" id="product_price" name="product_price" class="form-control" onkeypress="return chkNumber()" style="width:30%;" required="required"/>

                    <label for="">จำนวน</label>
                    <input type="text" id="product_num" name="product_num"
                           value="1"
                           class="form-control" onkeypress="return chkNumber()" style="width:30%;" required="required"/>

                    <label for="textArea">รายละเอียด</label>
                    <textarea id="product_detail" name="product_detail" rows="3" class="form-control input-sm" required="required"></textarea>

                    <hr/>
                    <button type="button" class="btn btn-success" onclick="save_product()">
                        <i class="fa fa-save"></i>
                        บันทึกข้อมูล
                    </button>

                    <font style=" color: #ff0033; display: none;" id="f_error">กรอกข้อมูลไม่ครบ ..?</font>
                    <!--
                    <button id="save_regis" name="save_regis" class="btn btn-success"
                            onclick="save_product();">
                        <span class="glyphicon glyphicon-save"></span> <b>บันทึกข้อมูล</b></button>
                    -->
                </div>
            </div>
        </fieldset>
    </form>
</div>

<!--
    ##### Model Images #####
-->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="popupImages" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="font-18">เลือกรูปภาพ</h4>
            </div>
            <div class="modal-body" style="height: 400px; overflow: auto;">
                <input id="Filedata" name="Filedata" type="file" multiple="true">
                <font id="font-16">* อัพโหลดได้ครั้งละไม่เกิน 5 ภาพ,นามสกุลไฟล์ .jpg,ขนาดไม่เกิน 1 MB </font>
                <hr/>
                <div id="load_images"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                <button type="button" class="btn btn-primary" onclick="GetvalImg()">เลือกรูปภาพ</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>

    //Modify By Kimniyom
    CKEDITOR.replace('product_detail', {
        image_removeLinkByEmptyURL: true,
        //extraPlugins: 'image',
        //removeDialogTabs: 'link:upload;image:Upload',
        //filebrowserBrowseUrl: 'imgbrowse/imgbrowse.php',
        //filebrowserUploadUrl: 'ckupload.php',
        //uiColor: '#AADC6E',
        filebrowserBrowseUrl: "<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/ckfinder.html",
        filebrowserImageBrowseUrl: "<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/ckfinder.html?Type=Images",
        filebrowserFlashBrowseUrl: "<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/ckfinder.html?Type=Flash",
        filebrowserUploadUrl: "<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files",
        filebrowserImageUploadUrl: "<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images",
        filebrowserFlashUploadUrl: "<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash"
    });</script>

<script type="text/javascript">
    checkheight();
    //loadimagesProduct();
    function GetImages() {
        load_data();
        $("#popupImages").modal();
    }

    function save_product() {
        var url = "<?php echo Yii::app()->createUrl('backend/product/save_product') ?>";
        var product_name = $("#product_name").val();
        var type_id = "<?php echo $type_id ?>";
        var product_num = $("#product_num").val();
        var product_price = $("#product_price").val();
        var product_id = $("#product_id").val();
        var product_detail = CKEDITOR.instances.product_detail.getData();

        if (product_name == '' || product_price == '' || product_detail == '' || product_num == '') {
            $("#f_error").show().delay(5000).fadeOut(500);

            return false;
        }

        var data = {
            product_id: product_id,
            product_name: product_name,
            type_id: type_id,
            product_num: product_num,
            product_price: product_price,
            product_detail: product_detail
        };

        $.post(url, data, function (success) {
            window.location = "<?php echo Yii::app()->createUrl('backend/product/detail_product&product_id=') ?>" + product_id;
        });
    }

    function load_data() {
        $("#load_images").html("<center><i class=\"fa fa-spinner fa-spin\"></i></center>");
        var url = "<?php echo Yii::app()->createUrl('backend/images/loadimages') ?>";
        var data = {};
        $.post(url, data, function (datas) {
            $("#load_images").html(datas);
        });
    }

    function loadimagesProduct() {
        $("#load_images_product").html("<center><i class=\"fa fa-spinner fa-spin\"></i></center>");
        var url = "<?php echo Yii::app()->createUrl('backend/product/get_images') ?>";
        var productID = $("#product_id").val();
        var data = {product_id: productID};
        $.post(url, data, function (datas) {
            $("#load_images_product").html(datas);
            checkheight();
        });
    }

    function delete_images(id) {
        var r = confirm("คุณแน่ใจหรือไม่ ...?");
        var url = "<?php echo Yii::app()->createUrl('backend/product/delete_images') ?>";
        var productID = $("#product_id").val();
        var data = {id: id,product_id: productID};

        if (r == true) {
            $.post(url, data, function (datas) {
                load_data();
                loadimagesProduct();
            });
        }
    }
    
    function checkheight() {
        var p_left = $("#p-left").height();
        var p_right = $("#p-right").height();
        //alert(p_left + " - " + p_right);
        if(p_left > p_right){
            $("#p-right").removeClass("p-right");
            $("#p-left").addClass("p-left");
        } else {
            $("#p-left").removeClass("p-left");
            $("#p-right").addClass("p-right");
        }
    }
</script>
