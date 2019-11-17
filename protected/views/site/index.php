<style type="text/css" media="screen">
    .hideme{
        opacity:0;
    }
    /*
    .box-center{
        width: 100%;margin-left: auto;margin-right: auto;position: relative;top: 50%;transform: translateY(-50%);
        text-align: center;
        padding: 20px;

    }
    */

    .isimages{
        position: absolute; width: 100%; height: 100%;
    }

    @media(min-width:480px) {
        .istext ul{
            margin: 10px;
        }
    }

    @media(min-width:1024px) {
        .istext ul{
            margin-top: 10%;
        }
    }

    ul{
        list-style-type: none;
    }


.btn-links:hover {
    background-color: #212121;
}

.btn-links focus{
    background-color: #212121;
}

.btn-links {
    border-radius: 20px;
    border: none;
    text-align:center;
    background: none;
    color: #ffffff;
    font-size: 18px;
    transition:all .2s ease-in;
}

</style>
<link rel="stylesheet" type="text/css" href="<?=Yii::app()->baseUrl;?>/css/headphoneguru.css" />
<?php
$web = new Configweb_model();
$modelPage = new Page();
?>

<?php foreach ($layout as $rs): ?>
    <div class="row" style="margin-top:0px; margin:0px;">
        <div class="hideme">
            <?php
for ($i = 1; $i <= ($rs['columns']); $i++):
	$contentLayout = $modelPage->getlayoutContent("0", $rs['row_id'], $i);
	?>
																																								                <div style="padding:0px;" class="<?php echo $rs['classname']; ?>">
																																								                    <?php if ($contentLayout['content'] || $contentLayout['link']) {?>
																																								                        <div class="<?php echo ($contentLayout['images']) ? "isimages" : "istext"; ?>">
																																								                            <div class="box-center">
																																								                                <div class="box-text-content">
																																								                                    <div class="istext">
																																					                                                    <?php echo $contentLayout['content'] ?>
																																					                                                        <?php if ($contentLayout['link']) {?>
																																			                                                                    <div style="text-align: center;">
																																		                                                                           <a href="<?php echo $contentLayout['link'] ?>">
																														                                                                                            <button type="button" class="btn-links">
															                                                                                                                                                         <?php echo $contentLayout['linktext'] ?> <i class="fa fa-angle-right"></i>
																												</button>
																														                                                                                            </a>
																																		                                                                        </div>
																																					                                                        <?php }?>
																																					                                                    </div>

																																								                                </div>
																																								                            </div>
																																								                        </div>
																																								                    <?php }?>
																																								                    <img src="<?=Yii::app()->baseUrl;?>/uploads/page/<?php echo $contentLayout['images'] ?>" alt="" class="img-responsive">
																																								                </div>
																																								            <?php endfor;?>
        </div>
    </div>
<?php endforeach;?>

<script type="text/javascript">

    $(document).ready(function() {
        /* Every time the window is scrolled ... */
        $(window).scroll(function() {

            /* Check the location of each desired element */
            $('.hideme').each(function(i) {

                var bottom_of_object = $(this).offset().top + $(this).outerHeight();
                var bottom_of_window = $(window).scrollTop() + $(window).height();

                /* If the object is completely visible in the window, fade it it */

                if (bottom_of_window > bottom_of_object) {

                    $(this).animate({'opacity': '1'}, 1000);

                }

            });

        });
        var size = window.innerWidth;
        if (size >= 1024) {
            $("#box-video-title").load("<?php echo Yii::app()->createUrl('site/video') ?>");
            $("#video-title").show();
            $(".box-category-item").css({"margin-top": "30px"});
            $('.slider5').bxSlider({
                slideWidth: 300,
                minSlides: 5,
                maxSlides: 5,
                moveSlides: 5,
                slideMargin: 10,
                captions: true,
                auto: true,
                touchEnabled: true,
                pager: false
            });
            $(".text-band").css({'font-size': '30px'});
        } else if (size >= 768) {

            $("#video-title").show();
            $(".box-category-item").css({"margin-top": "30px"});
            $('.slider5').bxSlider({
                slideWidth: 300,
                minSlides: 4,
                maxSlides: 4,
                moveSlides: 4,
                slideMargin: 10,
                captions: true,
                auto: true,
                touchEnabled: true,
                pager: false
            });

            $(".text-band").css({'font-size': '24px'});
        } else if (size >= 600) {
            $("#icon-move").show();
            $("#video-title").hide();
            $(".box-category-item").css({"margin-top": "0px"});
            $('.slider5').bxSlider({
                slideWidth: 300,
                minSlides: 3,
                maxSlides: 3,
                moveSlides: 3,
                slideMargin: 10,
                captions: true,
                auto: true,
                touchEnabled: true,
                pager: false
            });
            $(".text-band").css({'font-size': '22px'});
        } else if (size > 480) {
            $("#icon-move").show();
            $("#video-title").hide();
            $(".box-category-item").css({"margin-top": "0px"});
            $('.slider5').bxSlider({
                slideWidth: 300,
                minSlides: 3,
                maxSlides: 3,
                moveSlides: 3,
                slideMargin: 10,
                captions: true,
                auto: true,
                touchEnabled: true,
                pager: false
            });
            $(".text-band").css({'font-size': '20px'});
        } else {
            $("#icon-move").show();
            $("#video-title").hide();
            $(".box-category-item").css({"margin-top": "0px"});
            $('.slider5').bxSlider({
                slideWidth: 300,
                minSlides: 2,
                maxSlides: 2,
                moveSlides: 2,
                slideMargin: 10,
                captions: true,
                auto: true,
                touchEnabled: true,
                pager: false
            });
            $(".text-band").css({'font-size': '20px'});
        }
    });
</script>
