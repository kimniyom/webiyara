<link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/themes/backend/bootstrap/dist/css/bootstrap-datepicker.css" type="text/css" media="all" />
<script src="<?= Yii::app()->baseUrl; ?>/themes/backend/bootstrap/dist/js/bootstrap-datepicker-custom.js" type="text/javascript"></script>
<script src="<?= Yii::app()->baseUrl; ?>/themes/backend/bootstrap/dist/locales/bootstrap-datepicker.th.min.js" charset="UTF-8"></script>
<?php
//session_start();
$this->breadcrumbs = array(
    "ข้อมูลการสั่งซื้อ",
);
?>
<h3 style=" margin-top: 0px;">ข้อมูลการสั่งซื้อ</h3>
<hr/>
<div class="row">
    <div class="col-md-3 col-lg-3">
      <label for="sel1">สถานะ:</label>
      <select class="form-control" id="status">
            <option value="">ทุกสถานะ</option>
            <option value="0">รอการยืนยัน</option>
            <option value="1">ยืนยันรายการ</option>
            <option value="3">ยกเลิกรายการ</option>
        </select>
    </div>
    <div class="col-md-3 col-lg-3">
        <div class="col-md-10">
            <label for="sel2">ตั้งแต่</label>
            <input id="datestart" class="datepicker form-control" data-date-format="dd/mm/yyyy">
        </div>
    </div>
    <div class="col-md-3 col-lg-3">
        <div class="col-md-10">
            <label for="sel3">จนถึง</label>
            <input id="dateend" class="datepicker form-control" data-date-format="dd/mm/yyyy">
        </div>
    </div>

     <div class="col-md-3 col-lg-3">
       <button class="btn btn-success" onclick="getOrders()" style="margin-top:25px;"><i class="fa fa-search"></i></button>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div id="dataorder"></div>
    </div>
</div>

<script type="text/javascript">
        getOrders();
        $(document).ready(function () {
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                //todayBtn: true,
                todayHighlight:'TRUE',
                autoclose: true,
                language: 'th',            //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true              //Set เป็นปี พ.ศ.
            }).datepicker("setDate", "0");  //กำหนดเป็นวันปัจุบัน
        });

        function getOrders(){
            $("#dataorder").text("Loading ...");
            var url = "<?php echo Yii::app()->createUrl('backend/orders/gethistory') ?>";
            var status = $("#status").val();
            var datestart = $("#datestart").val();
            var dateend = $("#dateend").val();
            var data = {status: status,datestart: datestart,dateend: dateend};
            $.post(url,data,function(datas){
                $("#dataorder").html(datas);
            });
        }
    </script>


