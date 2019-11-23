<style type="text/css">
    #add-product label{

        font-weight: bold;
    }

    .modal-dialog {
        width: 100%;
    }
</style>
<?php
$Config = new Configweb_model();
?>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/ckfinder.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        //load_data();
        $('#Filedata').uploadifive({
            /*'buttonText': 'กรุณาเลือกรูปภาพ ...',*/
            'auto': true, //เปิดใช้การอัพโหลดแบบอัติโนมัติ
            buttonText: "Uoload Photo",
            //'buttonImage': '<?//= Yii::app()->baseUrl ?>/images/image-up-icon.png',
            //'swf': '<?php //echo Yii::app()->baseUrl            ?>/assets/uploadify/uploadify.swf', //โฟเดอร์ที่เก็บไฟล์ปุ่มอัพโหลด
            'uploadScript': "<?= Yii::app()->createUrl('backend/images/uploadify') ?>",
            'fileSizeLimit': '<?php echo $Config->SizeFileUpload() ?>', //อัพโหลดได้ครั้งละไม่เกิน 1024kb
            //'width': '128',
            //'height': '132',
            'fileType': ["image/jpg", "image/jpeg", "image/JPG", "image/JPEG"], //กำหนดชนิดของไฟล์ที่สามารถอัพโหลดได้
            'multi': true, //เปิดใช้งานการอัพโหลดแบบหลายไฟล์ในครั้งเดียว
            'removeCompleted': true,
            'queueSizeLimit': 5, //อัพโหลดได้ครั้งละ 5 ไฟล์
            'onUploadComplete': function(file, data, response) {
                load_data();
            }
        });
    });

</script>

<?php
$title = "Add Product";
$this->breadcrumbs = array(
    'Product' => array('backend/product'),
    $title,
);
$ConfigWeb = new Configweb_model();
?>

<div class="well" style="width:100%;" id="add-product">
    <form class="form-horizontal">
        <fieldset>
            <legend style="margin:0px; border-bottom: #cccccc solid 1px;">
                <span class="label label-warning">
                    <img src="<?php echo Yii::app()->baseUrl; ?>/images/add-product-icon.png"/>
                    Add Product
                </span>
            </legend>

            <div class="row">
                <div class="col-md-3 col-lg-3" id="p-left" style="padding-top:10px;">
                    <div class="well" style=" border:#666666 dashed 2px; text-align: center; cursor: pointer;"
                         onclick="GetImages();">
                        <i class="fa fa-image fa-5x" style=" color: #cccccc;"></i><br/>
                        <i class="fa fa-plus"></i> <font id="font-20">Add Photo</font>
                    </div>
                    <div id="load_images_product"></div>
                </div>
                <div class="col-md-9 col-lg-9" id="p-right" style="padding-top:10px;">
                    <label for="">*Category</label>
                    <select class="form-control" id="category" onchange="combotype(this.value)">
                        <option value="">== Select ==</option>
                        <?php foreach ($categorys as $rscategory): ?>
                            <option value="<?php echo $rscategory['id'] ?>"><?php echo $rscategory['categoryname'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="">*Type</label>
                    <div id="combotype">
                        <select class="form-control" id="types">
                            <option value="">== Select ==</option>
                        </select>
                    </div>
                    <!--
                    <label for="">*Brand</label>
                    <select class="form-control" id="brand">
                        <option value="5">IYARA</option>
                    </select>
                    -->
                    <input type="hidden" value="5" id="brand" name="brand"/>
                    <label for="" style="display:none;">ProductCode</label>
                    <input type="hidden" id="product_id" name="product_id" class="form-control" value="<?php echo $product_id; ?>" readonly style="width:40%;"/>

                    <label for="">*Name</label>
                    <input type="text" id="product_name" name="product_name" class="form-control" style="width:100%;" required="required"/>
                    <label>*Description</label>
                    <textarea class="form-control" id="description" rows="5"></textarea>

                    <div style="display:none;">
                        <label for="">*Price</label>
                        <input type="text" id="product_price" name="product_price" class="form-control" onKeyUp="if (this.value * 1 != this.value)
                                    this.value = '';" style="width:30%;" required="required" value="0"/>
                        <label for="">Promotion</label>
                        <input type="text" id="product_price_pro" name="product_price_pro" class="form-control" onKeyUp="if (this.value * 1 != this.value)
                                    this.value = '';" style="width:30%;"/>
                        <p style="color:#ff0033;">*ถ้าใส่ราคาโปรหน้าเว็บจะนำราคานี้ไปแสดง</p>
                        <br/>
                        <label for="">*Status</label>
                        <input id="status" name="status" class="styled" type="radio" value="0" checked="checked"/>
                        <label for="radio">พร้อมขาย</label>
                        <input id="status" name="status" class="styled" type="radio" value="1"/>
                        <label for="radio">ไม่พร้อมขาย</label>
                        <input id="status" name="status" class="styled" type="radio" value="2"/>
                        <label for="radio">Sold Out</label>
                        <br/>
                        <label for="">*สินค้าแนะนำ</label>
                        <input id="recommend" name="recommend" class="styled" type="radio" value="1"/> <label for="radio">Yes</label>
                        <input id="recommend" name="recommend" class="styled" type="radio" value="0" checked="checked"/> <label for="radio">No</label>
                        <br/>
                        <label for="">*สินค้าขายดี</label>
                        <input id="bastseller" name="bastseller" class="styled" type="radio" value="1"/> <label for="radio">Yes</label>
                        <input id="bastseller" name="bastseller" class="styled" type="radio" value="0" checked="checked"/> <label for="radio">No</label>
                        <br/>
                        <label for="">*Option</label>
                        <input id="option" name="option" class="styled" type="radio" value="1"/> <label for="radio">Yes</label>
                        <input id="option" name="option" class="styled" type="radio" value="0" checked="checked"/> <label for="radio">No</label>
                        <br/><br/>
                        <label for="textArea">*รายละเอียด</label>
                        <textarea id="product_detail" name="product_detail" rows="3" class="form-control input-sm" required="required"></textarea>
                    </div>
                    <hr/>
                    <button type="button" class="btn btn-success" onclick="save_product()">
                        <i class="fa fa-save"></i>
                        Save
                    </button>

                    <font style=" color: #ff0033; display: none;" id="f_error">กรอกข้อมูล * ไม่ครบ ..?</font>
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
    <div class="modal-dialog modal-lg" role="document" style=" margin: 0px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="font-18">Select Photo</h4>
            </div>
            <div class="modal-body" style="overflow: auto;">
                <input id="Filedata" name="Filedata" type="file" multiple="true">
                <font id="font-16">* File Limit <?php echo $ConfigWeb->LimitFileUpload() ?> Filetype .jpg  Max Filesize <?php echo $ConfigWeb->SizeFileUpload() ?> </font>
                <hr/>
                <div id="load_images"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" onclick="DeleteImgProduct()">Delete</button>
                <button type="button" class="btn btn-primary" onclick="GetvalImg()">Select Photo</button>
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
    });</script>

<script type="text/javascript">
    checkheight();
    //loadimagesProduct();
    function GetImages() {
        load_data();
        $("#popupImages").modal();
    }

    function save_product() {
        var url = "<?php echo Yii::app()->createUrl('backend/product/save') ?>";
        var product_name = $("#product_name").val();
        var type = $("#type").val();
        var category = $("#category").val();
        var brand = $("#brand").val();
        var product_price = $("#product_price").val();
        var product_id = $("#product_id").val();
        var status = $("input[name='status']:checked").val();
        var product_detail = CKEDITOR.instances.product_detail.getData();
        var recomment = $("input[name='recomment']:checked").val();
        var description = $("#description").val();
        var bastseller = $("input[name='bastseller']:checked").val();
        var option = $("input[name='option']:checked").val();
        var product_price_pro = $("#product_price_pro").val();
        if (category == "" || product_name == '' || product_price == '' || type == '' || brand == '' || description == "") {
            $("#f_error").show().delay(5000).fadeOut(500);
            return false;
        }

        var data = {
            product_id: product_id,
            product_name: product_name,
            category: category,
            type: type,
            brand: brand,
            product_price: product_price,
            status: status,
            product_detail: product_detail,
            recomment: recomment,
            description: description,
            bastseller: bastseller,
            product_price_pro: product_price_pro,
            option: option
        };

        $.post(url, data, function(success) {
            window.location = "<?php echo Yii::app()->createUrl('backend/product/detail_product/product_id') ?>" + "/" + product_id;
        });
    }

    function load_data() {
        $("#load_images").html("<center><i class=\"fa fa-spinner fa-spin\"></i></center>");
        var url = "<?php echo Yii::app()->createUrl('backend/images/loadimages') ?>";
        var data = {};
        $.post(url, data, function(datas) {
            $("#load_images").html(datas);
        });
    }

    function loadimagesProduct() {
        $("#load_images_product").html("<center><i class=\"fa fa-spinner fa-spin\"></i></center>");
        var url = "<?php echo Yii::app()->createUrl('backend/product/get_images') ?>";
        var productID = $("#product_id").val();
        var data = {product_id: productID};
        $.post(url, data, function(datas) {
            $("#load_images_product").html(datas);
            checkheight();
        });
    }

    function delete_images(id) {
        var r = confirm("คุณแน่ใจหรือไม่ ...?");
        var url = "<?php echo Yii::app()->createUrl('backend/product/delete_images') ?>";
        var productID = $("#product_id").val();
        var data = {id: id, product_id: productID};

        if (r == true) {
            $.post(url, data, function(datas) {
                load_data();
                loadimagesProduct();
            });
        }
    }

    function checkheight() {
        var w = window.innerWidth;
        var height = window.innerHeight;
        var heights = height - 140;
        $(".modal-dialog  .modal-body").css({'height': heights});
        if (w >= 768) {
            var p_left = $("#p-left").height();
            var p_right = $("#p-right").height();
            //alert(p_left + " - " + p_right);
            if (p_left > p_right) {
                $("#p-right").removeClass("p-right");
                $("#p-left").addClass("p-left");
            } else {
                $("#p-left").removeClass("p-left");
                $("#p-right").addClass("p-right");
            }
        } else {
            $("#p-left").css({"border": "none"});
            $("#p-right").css({"border": "none"});
        }

    }

    function combotype(category) {
        var url = "<?php echo Yii::app()->createUrl('backend/typeproduct/combotype') ?>";
        var data = {category: category, type: ""};
        $.post(url, data, function(datas) {
            $("#combotype").html(datas);
        });
    }
</script>
