<style type="text/css">
    #pointer:hover{
        cursor: pointer;
        opacity: 0.8;
        border: #ffffff dotted 1px;
        border-radius: 10px;
    }
</style>
<script type="text/javascript">
    $(document).ready(function () {
        var style = {"height": "auto"};
        $("#box-article img").addClass("img-responsive");
        $("#box-article img").css(style);
    });
</script>

<?php
$title = "Story";
$this->breadcrumbs = array(
	$title,
);

$BgModel = new Background();
?>
<h4>BackgroundContent</h4>
<hr/>
<?php if ($bg) {?>
    <button type="button" class="btn btn-danger pull-right" onclick="deleteBg()"><i class="fa fa-trash"></i> Delete</button>
<?php }?>
<div style="width: 200px; height: 200px; padding: 10px; position: relative;">
    <div style="position: absolute;left:0px;top:0px" id="pointer" onclick="setbg('lefttop')">
        <?php if (isset($lt)) {
	$bgImg = $BgModel->getBgName($lt)['background'];
	?>
        <img src="<?php echo Yii::app()->baseUrl ?>/uploads/background/<?php echo $bgImg ?>" alt="" style="max-height: 100px;">
         <?php } else {?>
            <button type="button" class="btn btn-default"><i class="fa fa-plus"></i></button>
        <?php }?>
    </div>

    <div style="position: absolute;right:0px;top:0px" id="pointer" onclick="setbg('righttop')">
        <?php if (isset($rt)) {
	$bgImg = $BgModel->getBgName($rt)['background'];
	?>
        <img src="<?php echo Yii::app()->baseUrl ?>/images/r1.png" alt="" style="max-height: 100px;">
        <?php } else {?>
            <button type="button" class="btn btn-default"><i class="fa fa-plus"></i></button>
        <?php }?>
    </div>

    <div style="position: absolute;left:0px;bottom:0px" id="pointer" onclick="setbg('leftbottom')">
        <?php if (isset($lb)) {
	$bgImg = $BgModel->getBgName($lb)['background'];
	?>
        <img src="<?php echo Yii::app()->baseUrl ?>/images/l2.png" alt="" style="max-height: 100px;">
         <?php } else {?>
            <button type="button" class="btn btn-default"><i class="fa fa-plus"></i></button>
        <?php }?>
    </div>

    <div style="position: absolute;right:0px;bottom:0px" id="pointer" onclick="setbg('rightbottom')">
         <?php if (isset($rb)) {
	$bgImg = $BgModel->getBgName($rb)['background'];
	?>
        <img src="<?php echo Yii::app()->baseUrl ?>/images/r2.png" alt="" style="max-height: 100px;">
        <?php } else {?>
            <button type="button" class="btn btn-default"><i class="fa fa-plus"></i></button>
        <?php }?>
    </div>
</div>
<hr/>

<div class="panel panel-default">
    <div class="panel-heading">
        <img src="<?php echo Yii::app()->baseUrl; ?>/images/Mail-icon.png" width="24"/>
        <?php echo $title ?>
        <div class="pull-right">
            <a href="<?php echo Yii::app()->createUrl('backend/about/create'); ?>"><i class="fa fa-pencil"></i> Edit</a>
            <a href="<?php echo Yii::app()->createUrl('site/story'); ?>" target="_blank"><i class="fa fa-eye"></i> Preview</a>
        </div>
    </div>
    <div class="panel-body">
        <?php echo $about['about'] ?>
    </div>
</div>


<div class="modal" tabindex="-1" role="dialog" id="popupbg">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Background</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="" id="position">
        <div id="resultBg"></div>
      </div>
      <div class="modal-footer">
        <a href="<?php echo Yii::app()->createUrl('backend/background/index') ?>"><button type="button" class="btn btn-primary">Uploads</button></a>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    function setbg(position){
        $("#popupbg").modal();
        $("#position").val(position);
        var url = "<?php echo Yii::app()->createUrl('backend/background/bg') ?>";
        var data = {};
        $.post(url,data,function(datas){
            $("#resultBg").html(datas);
        });
    }

    function deleteBg(){
        var r = confirm("Are you sure..?");
        if(r == true){
            var url = "<?php echo Yii::app()->createUrl('backend/background/deletebg') ?>";
        var data = {type: 's'};
        $.post(url,data,function(datas){
            window.location.reload();
        });
        }
    }
</script>
