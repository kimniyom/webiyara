<style>
    .well{
        background: #FFFFFF;
    }
</style>
<?php
/* @var $this MasuserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Page',
);


?>
<h4>เลือกข้อมูล</h4>
<select id="article" class="form-control">
    <option value="">== เลือกข้อมูล ==</option>
    <?php foreach ($articlelist as $rs): ?>
        <option value="<?php echo $rs['id'] ?>"><?php echo $rs['title'] ?></option>
    <?php endforeach; ?>
</select>
<hr/>
<button type="button" class="btn btn-default" onclick="savepage()"><i class="fa fa-save"></i> บันทึก</button>

<script type="text/javascript">
    function savepage(){
        var url = "<?php echo Yii::app()->createUrl('backend/page/save') ?>";
        var type = "<?php echo $type ?>";
        var seq = "<?php echo $seq ?>";
        var article = $("#article").val();
        if(article == ""){
            alert("ยังไม่ได้เลือกข้อมูล...?");
            return false;
        }
        var data = {article: article,type: type,seq: seq};
        $.post(url,data,function(datas){
            window.location = "<?php echo Yii::app()->createUrl('backend/page/index') ?>";
        });
    }
</script>

