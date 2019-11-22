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

    .text-head{
      text-align:center; color:#ffffff;
      padding: 20px 50px 0px 50px;
    }

    .text-description{
      text-align: center;
      padding: 20px 50px 0px 50px;
      color: #FFFFFF;
      font-size: 24px;
    }

</style>
<link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl; ?>/css/headphoneguru.css" />
<?php
$web = new Configweb_model();
$modelPage = new Page();
?>

<div class="text-head">
  <?php echo $product['product_name'] ?>
</div>
<div class="text-description">
  <?php echo $product['description'] ?>
</div>

 <div class="row" style="margin-top:0px;margin:0px;">

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
        <div class="<?php echo $class ?>">
            <div class="row display-flex<?php echo $r ?>">
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
                                <div class="<?php echo ($rowImages > 0) ? 'v-none-img' : '' ?>">
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
<script type="text/javascript">
setFont();
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
    });

    function setFont(){
      var w = window.innerWidth;
      if(w <= 480){
        $(".text-head").css({'font-size':'20px'});
        $(".text-description").css({'font-size':'16px'});
      } else if(w <= 768){
        $(".text-head").css({'font-size':'36px'});
        $(".text-description").css({'font-size':'18px'});
      } else if(w > 768){
        $(".text-head").css({'font-size':'50px'});
        $(".text-description").css({'font-size':'24px'});
      }
    }
</script>
