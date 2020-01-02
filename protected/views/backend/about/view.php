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
?>

<div style="width: 200px; height: 200px; padding: 10px;">
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6" id="pointer" onclick="setbg('l','t')">
            <img src="<?php echo Yii::app()->baseUrl ?>/images/l1.png" alt="" class="img-responsive">
        </div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6" id="pointer" onclick="setbg('r','t')">
            <img src="<?php echo Yii::app()->baseUrl ?>/images/r1.png" alt="" class="img-responsive">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6" id="pointer" onclick="setbg('l','b')">
            <img src="<?php echo Yii::app()->baseUrl ?>/images/l2.png" alt="" class="img-responsive">
        </div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6" id="pointer" onclick="setbg('r','b')">
            <img src="<?php echo Yii::app()->baseUrl ?>/images/r2.png" alt="" class="img-responsive">
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <img src="<?php echo Yii::app()->baseUrl; ?>/images/Mail-icon.png" width="24"/>
        <?php echo $title ?>
        <div class="pull-right">
            <a href="<?php echo Yii::app()->createUrl('backend/about/create'); ?>"><i class="fa fa-pencil"></i> Edit</a>
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
        <input type="hidden" name="" id="position1">
        <input type="hidden" name="" id="position2">
        <div id="resultBg"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Uploads</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    function setbg(position1,position2){
        $("#popupbg").modal();
        $("#position1").val(position1);
        $("#position2").val(position2);
        var url = "<?php echo Yii::app()->createUrl('backend/background/bg') ?>";
        var data = {};
        $.post(url,data,function(datas){
            $("#resultBg").html(datas);
        });
    }
</script>
