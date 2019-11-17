<?php
/* @var $this MasuserController */
/* @var $model Masuser */

$this->breadcrumbs = array(
    'แก้ไขรหัสผ่าน',
);
?>

<h4>แก้ไขรหัสผ่าน</h4>
<hr/>
<div class="row">
    <div class="col-md-4 col-lg-4">
        <label>Username</label>
        <input type="text" id="username" class="form-control" />
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-lg-4">
        <label>รหัสผ่านใหม่</label>
        <input type="password" id="newpassword" class="form-control" />
    </div>
</div>
<hr/>
<div class="row">
    <div class="col-md-4 col-lg-4">
        <button type="button" class="btn btn-default" onclick="sendpassword()">บันทึกข้อมูล</button>
    </div>
</div><br/>

<script type="text/javascript">
    function sendpassword() {
        var url = "<?php echo Yii::app()->createUrl('backend/masuser/savenewpassword') ?>";
        var oldusername = "<?php echo $user['username'] ?>";
        var checkusername = $("#username").val();
        var newpassword = $("#newpassword").val();
        var data = {newpassword: newpassword};
        if (checkusername == "" || newpassword == "") {
            alert("กรอกข้อมูลไม่ครบ..!");
            return false;
        }
        if (checkusername != oldusername) {
            alert("ข้อทูลไม่ถูกต้อง...");
            return false;
        }

        $.post(url, data, function (datas) {
            window.location = "<?php echo Yii::app()->createUrl('site/logout') ?>";
        });

    }
</script>



