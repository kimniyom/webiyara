<div class="row">
    <?php foreach ($background as $rs): ?>
				<div class="col-md-4 col-lg-4 col-sm-6 col-xs-6 btn" style="border: #666666 solid 1px; text-align: center;" onclick="setBg('<?php echo $rs['id'] ?>')">
					<img src="<?php echo Yii::app()->baseUrl; ?>/uploads/background/<?php echo $rs['background']; ?>" class="img-resize" style="height:100px;"/>
			    </div>
			    <?php endforeach;?>
</div>

<script>
    function setBg(id){
        var url = "<?php echo Yii::app()->createUrl('backend/background/setbgstory') ?>";
        var position1 = $("#position1").val();
        var position2 = $("#position2").val();
        var data = {
            background: id,
            position1: position1,
            position2: position2
        };
        $.post(url,data,function(datas){
            window.location.reload();
        });
    }
</script>


