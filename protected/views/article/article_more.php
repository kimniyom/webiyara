<style type="text/css">
    #article-box{
        height: 120px;
        overflow: hidden;
    }
</style>

<?php if (empty($article)) {?>
    <script type="text/javascript">
        $(".load_more").attr("disabled", "disabled");
    </script>
<?php }?>


    <?php
$config = new Configweb_model();
$a = 0;
foreach ($article as $art):
	$a++;
	if (!empty($art['images'])) {
		$img_art = "uploads/article/600-" . $art['images'];
	} else {
		$img_art = "images/No_image_available.jpg";
	}
	$link = Yii::app()->createUrl('frontend/article/views/id/' . $art['id']);
	?>

												        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
												            <div class="thumbnail" style="background: #0f0f0f; border-color:#0f0f0f">
												                <span class="label label-danger" style=" position: absolute; top: 10px; left: 25px;"><?php echo $art['category_name'] ?></span>
												                <img src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $img_art; ?>" class="img img-responsive"/>
												                <div class="caption"id="article-box">
												                    <i class="fa fa-calendar-o"></i> <?php echo $art['create_date'] ?> <i class="fa fa-comment-o"></i> <?php echo $art['countread'] ?>
												                    <p class="font-THK" style=" font-size: 16px; color: #e0cd8b;"><?php echo $art['title']; ?></p>
												                </div>
												                <p style=" text-align: right;"><a href="<?php echo $link; ?>" class="btn" role="button"><i class="fa fa-angle-double-right"></i> more...</a></p>
												            </div>
												        </div>
												    <?php endforeach;?>



