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

    ul{
        list-style-type: none;
    }

</style>
<link rel="stylesheet" type="text/css" href="<?=Yii::app()->baseUrl;?>/css/headphoneguru.css" />
<?php
$ConfigWeb = new Configweb_model();
$modelPage = new Page();

$UrlShare = $ConfigWeb->GetFullLink(Yii::app()->request->url);
?>

<?php
/*
$this->pageTitle = $product['product_name'];
$title = $product['product_name'];
$this->breadcrumbs = array(
$product['categoryname'] => array('frontend/product/category/id' . '/' . $product['category']),
$product['type_name'] => array('frontend/product/view/type' . '/' . $product['type_id']),
$title,
);
 * */
?>

<div class="text-head">
  <?php echo $product['product_name'] ?>
</div>
<div class="text-description">
  <?php echo $product['description'] ?>
</div>
<?php $i = 0;foreach ($layout as $rs): $i++;
	if ($i == 1) {
		$class = "";
	} else {
		$class = "hideme";
	}
	?>
		    <div class="row" style="margin-top:0px;margin:0px;">
		        <div class="<?php echo $class ?>">
		            <?php
	for ($i = 1; $i <= ($rs['columns']); $i++):
		$contentLayout = $modelPage->getlayoutContent($productid, $rs['row_id'], $i);
		?>
				                <div style="padding:0px;" class="<?php echo $rs['classname']; ?>">
				                    <?php if ($contentLayout['content']) {?>
				                        <div class="<?php echo ($contentLayout['images']) ? "isimages" : "istext"; ?>">
				                            <div class="box-center">
				                                <div class="box-text-content">
				                                    <div class="istext" style="font-family: THK;"><?php echo $contentLayout['content'] ?></div>
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


<div class="widget-social align-center" style=" text-align: center; padding-top: 20px; padding-bottom: 20px; background: #e0cd8b;">
    <ul>
        <li style="text-align:center;">
            <!-- Facebook -->
            <a href="http://www.facebook.com/sharer.php?u=<?php echo $UrlShare ?>" target="_blank">
                <img src="<?php echo Yii::app()->baseUrl ?>/images/facebook.png" alt="Facebook" style="width:32px;"/>
            </a>
        </li>

        <li>
            <!-- Pinterest -->
            <a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());">
                <img src="<?php echo Yii::app()->baseUrl ?>/images/pinterest.png" alt="Pinterest" style="width:32px;"/>
            </a>
        </li>
        <li>
            <!-- Twitter -->
            <a href="https://twitter.com/share?url=<?php echo $UrlShare ?>&amp;text=<?php echo Yii::app()->session['fbtitle']; ?>;hashtags=<?php echo $ConfigWeb->get_webname() ?>" target="_blank">
                <img src="<?php echo Yii::app()->baseUrl ?>/images/twitter.png" alt="Twitter" style="width:32px;"/>
            </a>
        </li>
        <li>
            <a href="https://lineit.line.me/share/ui?url=<?php echo $UrlShare ?>" target="_blank">
                <img src="<?php echo Yii::app()->baseUrl ?>/images/line-icon.png" alt="Line" style="width:32px;"/>
            </a>
        </li>

    </ul>
</div>

<script type="text/javascript">
setFont();
    $(document).ready(function() {

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
