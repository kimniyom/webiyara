<link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/themes/iyara/css/styles.css" />
<link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/themes/iyara/dist/aos.css" />
<style type="text/css" media="screen">
    #body{
        background: #000000;
        background: url("<?php echo Yii::app()->baseUrl . "/uploads/product/" . $bgproduct; ?>") no-repeat center center fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
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

    @media (max-width:992px){
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
    }

    .main-content {
        margin: 0px;
        background: rgba(0, 0, 0, 0.8);
        position: relative;
    }

    .main-content .box-title {
        position: absolute;
        float: left;
        top: 35%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }

    @media only screen and (min-width: 992px) {
        .main-content .box-title .text-head{
            font-size: 48px;
            color:#FFFFFF;
            margin-bottom:20px;
        }

        .main-content .box-title .text-description{
            font-size: 22px;
            color:#FFFFFF;
        }

        .spect .headspect{
            font-size: 48px;
            color: #ffffff;
        }

        .spect table tbody tr td p{
            font-size: 18px;
            color: #FFFFFF;
        }

        .spect table tbody tr td p b{
            font-size: 20px;
            color: #FFFFFF;
            font-weight: bold;
        }
    }

    @media only screen and (max-width: 992px) {
        .main-content .box-title .text-head{
            font-size: 38px;
            color:#FFFFFF;
            margin-bottom:20px;
        }

        .main-content .box-title .text-description{
            font-size: 20px;
            color:#FFFFFF;
        }

        .spect .headspect{
            font-size: 26px;
            color: #ffffff;
        }

        .spect table tbody tr td p{
            font-size: 16px;
            color: #FFFFFF;
        }

        .spect table tbody tr td p b{
            font-size: 18px;
            color: #FFFFFF;
            font-weight: bold;
        }
    }

    @media only screen and (max-width: 768px) {
        .main-content .box-title .text-head{
            font-size: 32px;
            color:#FFFFFF;
            margin-bottom:20px;
        }

        .main-content .box-title .text-description{
            font-size: 18px;
            color:#FFFFFF;
        }

        #body{
            background: #000000;
            background: url("<?php echo Yii::app()->baseUrl . "/images/bg-product-mobile.jpg"; ?>");
        }

        .spect .headspect{
            font-size: 32px;
            color: #ffffff;
        }

        .spect table tbody tr td p{
            font-size: 14px;
            color: #FFFFFF;
        }

        .spect table tbody tr td p b{
            font-size: 16px;
            color: #FFFFFF;

        }


        @media only screen and (max-width: 468px) {
            .main-content .box-title .text-head{
                font-size: 30px;
                color:#FFFFFF;
                margin-bottom:20px;
                margin-top:80px;
            }

            .main-content .box-title .text-description{
                font-size: 18px;
                color:#FFFFFF;
            }

            #body{
                background: #000000;
                background: url("<?php echo Yii::app()->baseUrl . "/images/bg-product-mobile.jpg"; ?>");
            }

            .spect .headspect{
                font-size: 24px;
            }

            .spect table tbody tr td p{
                font-size: 18px;
                color: #FFFFFF;
            }
        }

    </style>
    <link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl; ?>/css/headphoneguru.css" />
    <?php
    $web = new Configweb_model();
    $modelPage = new Page();
    $UrlShare = $web->GetFullLink(Yii::app()->request->url);
    ?>
    <div class="main-content">
        <div class="box-title">
            <div class="text-head">
                <?php echo $product['product_name'] ?>
            </div>
            <div class="text-description" style=" margin-bottom: 20px;">
                <?php echo $product['description'] ?>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="widget-social-color">
                        <ul>
                            <li>
                                <a href="http://www.facebook.com/sharer.php?u=<?php echo $UrlShare ?>" target="_blank">
                                    <img src="<?php echo Yii::app()->baseUrl ?>/images/facebook.png" alt="Facebook" style="width:36px;"/>
                                </a>
                            </li>

                            <li>
                                <!-- Pinterest -->
                                <a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());" target="_blank">
                                    <img src="<?php echo Yii::app()->baseUrl ?>/images/pinterest.png" alt="Pinterest" style="width:36px;"/>
                                </a>
                            </li>
                            <li>
                                <!-- Twitter -->
                                <a href="https://twitter.com/share?url=<?php echo $UrlShare ?>&amp;text=<?php echo Yii::app()->session['fbtitle']; ?>;hashtags=<?php echo $web->get_webname() ?>" target="_blank">
                                    <img src="<?php echo Yii::app()->baseUrl ?>/images/twitter.png" alt="Twitter" style="width:36px;"/>
                                </a>
                            </li>
                            <li>
                                <a href="https://lineit.line.me/share/ui?url=<?php echo $UrlShare ?>" target="_blank">
                                    <img src="<?php echo Yii::app()->baseUrl ?>/images/line-icon.png" alt="Line" style="width:36px;"/>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="rows" style="margin-top:0px;margin:0px;">

        <?php
        $r = 0;
        foreach ($layout as $rs):
            $r++;
            if ($r == 1) {
                $class = "";
            } else {
                $class = "hideme";
            }
            $rowId = $rs['row_id'];
            $sql = "select count(*) as total from layoutcontent where pageid = '$productid' and row_id = ' $rowId'  and images != '' ";
            $rsCount = Yii::app()->db->createCommand($sql)->queryRow();
            $rowImages = $rsCount['total'];

            //Reverse
            $sqlReverse = "select * from layoutreverse where pageid = '$productid' and rowid = '$rowId'";
            $rsReverse = Yii::app()->db->createCommand($sqlReverse)->queryRow();
            if ($rsReverse['rowid'] == $rowId) {
                $revers = "1";
            } else {
                $revers = "0";
            }
            ?>
            <style type="text/css">
                @media (min-width:992px){
                    .row {
                        display: -webkit-box;
                        display: -webkit-flex;
                        display: -ms-flexbox;
                        display:         flex;
                    }
                    .row > [class*='col-'] {
                        display: flex;
                        flex-direction: column;
                    }
                }
            </style>
            <div>
                <div class="row" style="margin: 0px;">
                    <?php
                    if ($revers == 1) {
                        $reversClassLeft = " col-md-push-6";
                        $reversClassRight = " col-md-pull-6";
                    } else {
                        $reversClassLeft = "";
                        $reversClassRight = "";
                    }
                    for ($i = 1; $i <= ($rs['columns']); $i++):
                        $contentLayout = $modelPage->getlayoutContent($productid, $rs['row_id'], $i);
                        if ($i == 1) {
                            $classRevers = $reversClassLeft;
                        } else if ($i == 2) {
                            $classRevers = $reversClassRight;
                        }
                        ?>
                        <div style="padding:0px;" class="<?php echo $rs['classname']; ?> <?php echo $classRevers ?>">

                            <!--
                                #### ถ้ามีรูปภาพ ####
                            -->
                            <div data-aos="fade-up" data-aos-duration="1000">
                                <img src="<?= Yii::app()->baseUrl; ?>/uploads/page/<?php echo $contentLayout['images'] ?>" alt="" class="img-responsive">
                            </div>
                            <?php if ($contentLayout['images']) { ?>
                                <?php if ($contentLayout['content'] || $contentLayout['link']) { ?>
                                    <div style="position: absolute; width: 100%; height: 100%;">
                                        <div class="vertical-center" data-aos="fade-down" data-aos-duration="1000">
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

                            <?php } else { ?>
                                <?php if ($contentLayout['content'] || $contentLayout['link']) { ?>
                                    <div class="<?php echo ($rowImages > 0) ? 'v-none-img' : '' ?>" data-aos="fade-left" data-aos-duration="1000">
                                        <div class="<?php echo ($rowImages > 0) ? ' vertical-center-none-img' : '' ?>">
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
    <div class="container" style="padding:100px 50px;">
        <div class="spect">
            <div class="headspect">Specifiaction</div>
            <hr/>
            <?php echo $product['spect'] ?>
        </div>
    </div>

    <script src="<?= Yii::app()->baseUrl; ?>/themes/iyara/dist/aos.js"></script>
    <script>
        AOS.init({
            easing: 'ease-in-out-sine'
        });</script>
    <script type="text/javascript">
        //setFont();
        setHeadBox();
        $(document).ready(function() {
            /* Every time the window is scrolled ... */
            $(window).scroll(function() {
                var h = window.innerHeight;
                var w = window.innerWidth;
                var y = $(this).scrollTop();
                if (y < h) {
                    if (w > 768) {
                        $('#body').css({
                            'background': 'url("<?php echo Yii::app()->baseUrl . "/uploads/product/" . $bgproduct; ?>") no-repeat center center fixed',
                            'background-position': 'center',
                            'background-repeat': 'no-repeat',
                            'background-size': 'cover'
                        });
                    } else {
                        $('#body').css({
                            'background': 'url("<?php echo Yii::app()->baseUrl . "/images/bg-product-mobile.jpg"; ?>")'
                        });
                    }
                } else {
                    $('#body').css({
                        'background': 'none',
                        'background-color': '#000000'
                    });
                }
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
        });
        function setHeadBox() {
            var h = window.innerHeight;
            var height = (h - 100);
            $(".main-content").css({'height': h});
        }

        /*
         function setFont() {
         var w = window.innerWidth;
         if (w <= 480) {
         $(".text-head").css({'font-size': '28px'});
         $(".text-description").css({'font-size': '10px', });
         } else if (w <= 768) {
         $(".text-head").css({'font-size': '32px'});
         $(".text-description").css({'font-size': '20px'});
         } else if (w > 768) {
         $(".text-head").css({'font-size': '60px', 'margin-top': '100px'});
         $(".text-description").css({'font-size': '28px', 'margin-bottom': '100px', 'margin-top': '100px'});
         }
         }
         */
    </script>
