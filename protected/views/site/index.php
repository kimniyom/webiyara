<style type="text/css" media="screen">
    .hideme{
        opacity:0;
    }
    .vertical-center {
        height: 100%;
        position: relative;
        overflow:hidden;
        padding: 10px;
        text-align: center;
    }

    .vertical-center div {
        margin: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        word-wrap: break-word;

    }

    @media (min-width:992px){
        .vertical-center-none-img {
            height: 100%;
            position: relative;
            overflow:hidden;
            padding: 10px;
            text-align: center;
        }

        .vertical-center-none-img div {
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            word-wrap: break-word;
        }

        .v-none-img{
            position: absolute; width: 100%; height: 100%;
        }
    }

    .btn-links:hover {
        background-color: #212121;
    }

    .btn-links focus{
        background-color: #212121;
    }

    .btn-links {
        border-radius: 18px;
        border: none;
        text-align:center;
        background: none;
        color: #ffffff;
        font-size: 18px;
        transition:all .2s ease-in;
    }

</style>
<link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl; ?>/css/headphoneguru.css" />
<?php
$web = new Configweb_model();
$modelPage = new Page();
?>

<div style="padding: 10px;">
    <?php
    $r = 0;
    foreach ($layout as $rs):
        $r++;
        ?>
        <style type="text/css">
            @media (min-width:992px){
                .row.display-flex<?php echo $r ?> {
                    display: flex;
                    flex-wrap: wrap;
                }
                .row.display-flex<?php echo $r ?> > [class*='col-'] {
                    display: flex;
                    flex-direction: column;
                }
            }
        </style>
        <div class="hideme">
            <div class="row display-flex<?php echo $r ?>">

                <?php
                for ($i = 1; $i <= ($rs['columns']); $i++):
                    $contentLayout = $modelPage->getlayoutContent("0", $rs['row_id'], $i);
                    ?>
                    <div style="padding:0px;" class="<?php echo $rs['classname']; ?>">

                        <!--
                            #### ถ้ามีรูปภาพ ####
                        -->
                        <?php if ($contentLayout['images']) { ?>
                            <?php if ($contentLayout['content'] || $contentLayout['link']) { ?>
                                <div style="position: absolute; width: 100%; height: 100%;">
                                    <div class="vertical-center">
                                        <div><?php echo $contentLayout['content'] ?>
                                            <?php if ($contentLayout['link']) { ?>
                                                <a href="<?php echo $contentLayout['link'] ?>"  target="_bank">
                                                    <button type="button" class="btn-links">
                                                        <?php echo $contentLayout['linktext'] ?> <i class="fa fa-angle-right"></i>
                                                    </button>
                                                </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <img src="<?= Yii::app()->baseUrl; ?>/uploads/page/<?php echo $contentLayout['images'] ?>" alt="" class="img-responsive">
                        <?php } else { ?>
                            <?php if ($contentLayout['content'] || $contentLayout['link']) { ?>
                                <div class="v-none-img">
                                    <div class="vertical-center-none-img">
                                        <div>
                                            <?php echo $contentLayout['content'] ?>
                                            <?php if ($contentLayout['link']) { ?>
                                                <center>
                                                    <a href="<?php echo $contentLayout['link'] ?>"  target="_bank">
                                                        <button type="button" class="btn-links">
                                                            <?php echo $contentLayout['linktext'] ?> <i class="fa fa-angle-right"></i>
                                                        </button>
                                                    </a>
                                                </center>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div style="position: relative; width: 100%; height: 100%; padding: 20px;">
                                    <div class="box-center" style=" border: #004b63 dashed 2px;">
                                        <div style="font-family: Th;">No Data</div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
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
