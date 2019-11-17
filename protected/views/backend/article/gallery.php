<div class="row">
    <?php foreach ($gallery as $rs): ?>
        <div class="col-md-2 col-lg-2 col-sm-2">
            <button type="button" class="btn btn-danger pull-right" style=" position: absolute; top: 5px ; right: 20px;" onclick="DeletGallery('<?php echo $rs['id'] ?>')"><i class="fa fa-trash-o"></i></button>
            <img class="img img-responsive" src="<?php echo Yii::app()->baseUrl ?>/uploads/article/gallery/200-<?php echo $rs['images'] ?>" />
        </div>
    <?php endforeach; ?>
</div>
