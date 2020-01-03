<div class="row">
    <?php foreach ($background as $rs): ?>
				<div class="col-md-3 col-lg-3 col-sm-6 col-xs-6 btn" style="border: #666666 solid 1px; text-align: center;" onclick="setBg('<?php echo $rs['id'] ?>')">
					<img src="<?php echo Yii::app()->baseUrl; ?>/uploads/background/<?php echo $rs['background']; ?>" class="img img-responsive"/>
			    </div>
			    <?php endforeach;?>
</div>

<script>
    function setBg(background){
        var url = "<?php echo Yii::app()->createUrl('backend/background/setbgstory') ?>";
        var position = $("#position").val();
        var data = {
            background: background,
            position: position,
            type: 's'
        };
        $.post(url,data,function(datas){
            window.location.reload();
        });
    }
</script>


