<link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/themes/iyara/css/styles.css" />
<link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/themes/iyara/dist/aos.css" />
<style type="text/css" media="screen">
    .hideme{
        opacity:0;
        margin-top:-300px;
    }
    .vertical-center {
        height: 100%;
        position: relative;
        overflow:hidden;
        padding: 10px;
        text-align: center;
        margin: 0;
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
            margin: 0;
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
            margin: 0;
            position: absolute; width: 100%; height: 100%;
        }
    }

    .btn-links:hover {
        background-color: #ffffff;
        color:#000000;
        opacity: 1;
    }

    .btn-links focus{
        background-color: #212121;
    }

    .btn-links {
        border-radius: 30px;
        border: none;
        text-align:center;
        background: #212121;
        color: #ffffff;
        font-size: 14px;
        transition:all .2s ease-in;
        padding: 10px;
        opacity: 0.5;
        margin-bottom: 10px;
    }

</style>
<link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl; ?>/css/headphoneguru.css" />
<?php
$web = new Configweb_model();
$modelPage = new Page();
?>

<?php
$r = 0;
foreach ($layout as $rs):
    $r++;
    $rowId = $rs['row_id'];
    $sql = "select count(*) as total from layoutcontent where pageid = '0' and row_id = ' $rowId'  and images != '' ";
    $rsCount = Yii::app()->db->createCommand($sql)->queryRow();
    $rowImages = $rsCount['total'];

    //Reverse
    $sqlReverse = "select * from layoutreverse where pageid = '0' and rowid = '$rowId'";
    $rsReverse = Yii::app()->db->createCommand($sqlReverse)->queryRow();
    if ($rsReverse['rowid'] == $rowId) {
        $revers = "1";
    } else {
        $revers = "0";
    }
    ?>
    <style type="text/css">
        @media (min-width:992px){
            .row.display-flex<?php echo $r ?> {
                display: flex;
                flex-wrap: wrap;
                margin:0px;
            }
            .row.display-flex<?php echo $r ?> > [class*='col-'] {
                display: flex;
                flex-direction: column;
                margin:0px;
            }
        }
    </style>
    <div>
        <div class="row display-flex<?php echo $r ?>" style=" margin: 0px;">
            <?php
            if ($revers == 1) {
                $reversClassLeft = " col-md-push-6";
                $reversClassRight = " col-md-pull-6";
            } else {
                $reversClassLeft = "";
                $reversClassRight = "";
            }
            for ($i = 1; $i <= ($rs['columns']); $i++):
                $contentLayout = $modelPage->getlayoutContent("0", $rs['row_id'], $i);
                if ($i == 1) {
                    $classRevers = $reversClassLeft;
                } else if ($i == 2) {
                    $classRevers = $reversClassRight;
                }
                ?>
                <div style="padding:0px; margin:0px;" class="<?php echo $rs['classname']; ?> <?php echo $classRevers ?>">

                    <!--
                        #### ถ้ามีรูปภาพ ####
                    -->
                    <?php if ($contentLayout['images']) { ?>
                        <?php if ($contentLayout['content'] || $contentLayout['link']) { ?>
                            <div style="position: absolute; width: 100%; height: 100%; margin:0px;">
                                <div class="vertical-center" data-aos="fade-right" data-aos-duration="3000">
                                    <div><?php echo $contentLayout['content'] ?>
                                        <?php if ($contentLayout['link']) { ?>
                                            <a href="<?php echo $contentLayout['link'] ?>">
                                                <button type="button" class="btn-links">
                                                    <?php echo $contentLayout['linktext'] ?> <i class="fa fa-angle-right"></i>
                                                </button>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <div data-aos="fade-up" data-aos-duration="1000">
                        <img src="<?= Yii::app()->baseUrl; ?>/uploads/page/<?php echo $contentLayout['images'] ?>" alt="" class="img-responsive">
                        </div>
                    <?php } else { ?>
                        <?php if ($contentLayout['content'] || $contentLayout['link']) { ?>
                            <div class="<?php echo ($rowImages > 0) ? 'v-none-img' : '' ?>" data-aos="fade-left" data-aos-duration="1000">
                                <div class="<?php echo ($rowImages > 0) ? ' vertical-center-none-img' : '' ?>">
                                    <div>
                                        <?php echo $contentLayout['content'] ?>
                                        <?php if ($contentLayout['link']) { ?>
                                            <center>
                                                <a href="<?php echo $contentLayout['link'] ?>" >
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

    <script src="<?= Yii::app()->baseUrl; ?>/themes/iyara/dist/aos.js"></script>
    <script>
      AOS.init({
        easing: 'ease-in-out-sine'
      });
    </script>

<script type="text/javascript">

    $(document).ready(function() {
        $(window).scroll(function() {
            $('.hideme').each(function(i) {

                var bottom_of_object = $(this).offset().top + $(this).outerHeight();
                var bottom_of_window = $(window).scrollTop() + $(window).height();
                if (bottom_of_window > bottom_of_object) {
                    $(this).animate({'opacity': '1','margin-top':'0px'}, 1000);
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
