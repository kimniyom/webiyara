<style type="text/css">
    #body{
        background: rgba(69,67,59,1);
        background: -moz-radial-gradient(center, ellipse cover, rgba(69,67,59,1) 0%, rgba(0,0,0,1) 100%);
        background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, rgba(69,67,59,1)), color-stop(100%, rgba(0,0,0,1)));
        background: -webkit-radial-gradient(center, ellipse cover, rgba(69,67,59,1) 0%, rgba(0,0,0,1) 100%);
        background: -o-radial-gradient(center, ellipse cover, rgba(69,67,59,1) 0%, rgba(0,0,0,1) 100%);
        background: -ms-radial-gradient(center, ellipse cover, rgba(69,67,59,1) 0%, rgba(0,0,0,1) 100%);
        background: radial-gradient(ellipse at center, rgba(69,67,59,1) 0%, rgba(0,0,0,1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#45433b', endColorstr='#000000', GradientType=1 )
    }

    #actives {
        font-weight: bold;
        color: brown;
        font-size: 28px;
    }
</style>

<script type="text/javascript">
    $(document).ready(function () {
        var width = $(window).width();
        if (width >= 768) {
            var styles = {
                "white-space": "nowrap",
                "width": "220px",
                "overflow": "hidden",
                "text - overflow": "ellipsis"
            };
            $(".caption").css(styles);
            //$(".box_product").css("height", "350px");
        }
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        var track_click = 0; //track user click on "load more" button, righ now it is 0 click
        //fetch_pages.php
        var total_pages = "<?php echo $count; ?>";
        var category = "<?php echo $category ?>"
        $('#results').load("<?php echo Yii::app()->createUrl('frontend/article/pages') ?>", {page: track_click, 'category': category}, function () {
            track_click++;
        }); //initial data to load

        $(".load_more").click(function (e) { //user clicks on button

            $(this).hide(); //hide load more button on click
            $('.animation_image').show(); //show loading image

            if (track_click <= total_pages) //make sure user clicks are still less than total pages
            {
                //post page number and load returned data into result element
                $.post('<?php echo Yii::app()->createUrl('frontend/article/pages') ?>', {page: track_click, category: category}, function (data) {

                    $(".load_more").show(); //bring back load more button

                    $("#results").append(data); //append data received from server

                    //scroll page to button element
                    //$("html, body").animate({scrollTop: $("#load_more_button").offset().top}, 500);

                    //hide loading image
                    $('.animation_image').hide(); //hide loading image once data is received

                    track_click++; //user click increment on load button

                }).fail(function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError); //alert any HTTP error
                    $(".load_more").show(); //bring back load more button
                    $('.animation_image').hide(); //hide loading image once data is received
                });

                //total_pages - 1
                if (track_click >= total_pages - 1)
                {
                    //reached end of the page yet? disable load button
                    $(".load_more").attr("disabled", "disabled");
                }
            }

        });
    });
</script>

<?php
$articleModel = new Article();
$config = new Configweb_model();
if ($category != "") {
	$Cat = Articlecategory::model()->find("id=:id", array(":id" => $category));
	$title = $Cat['category'];
} else {
	$title = "article";
}
$this->breadcrumbs = array(
	"Article" => array('frontend/article/index'),
	$title,
);
?>

<div class="container">
    <br/>
    <div class="row" style="margin:0px;">
        <div class="col-lg-12">
            <div style=" float: left; color: #e0cd8b;">
                <?php if ($category != "") {?>
                    <h2 class="font-supermarket"><?php echo $Cat['category'] ?></h2>
                    <hr style=" margin: 10px 0px; border-bottom: #000000 solid 2px;"/>
                    <h4 class="font-supermarket" style=" font-size: 20px;" >total <?php echo $count ?> items</h4>
                <?php } else {?>
                    <h4 class="font-supermarket" style=" font-size: 20px; padding-top: 30px;" >total <?php echo $count ?> items</h4>
                <?php }?>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-9 col-lg-9">
            <div class="row" id="results" style="margin-top:20px;"></div>
        </div>
        <div class="col-md-3">
                    <div class="sidebar" style="margin-top:20px;">
                        <div class="widget widget-categories" style="background:#0f0f0f;border:none;">
                            <h4 class="title-widget text-center font-supermarket" style=" font-size: 24px; color:#e0cd8b;">Categories</h4>
                            <ul>
                                <?php foreach ($categoryList as $categorys): ?>
                                    <li style="margin-bottom: 0px; padding: 0px;border-color:#e0cd8b;">
                                        <a href="<?php echo Yii::app()->createUrl('frontend/article/index', array('category' => $categorys['id'])) ?>" class=" font-THK" id="<?php echo ($categorys['id'] == $category) ? "actives" : ""; ?>" style="font-size: 18px;color:#e0cd8b;">
                                            <?php echo $categorys['category'] ?>
                                            <span class="badge pull-right" style=" color: #000; font-size: 20px; margin-top: 5px;background:#e0cd8b;"><?php echo $articleModel->CountArticleByCategory($categorys['id']) ?></span>
                                        </a>
                                    </li>
                                <?php endforeach;?>
                            </ul>
                        </div>

                        <div class="widget widget-blog-post" style="background:#0f0f0f;border:none;">
                            <h4 class="title text-center font-supermarket" style=" font-size: 24px; color:#e0cd8b;">Last Post</h4>
                            <ul class="list-blog">
                                <?php foreach ($lastblog as $lastblogs):
?>
                                    <li style="border-color:#e0cd8b;">
                                        <a href="<?php echo Yii::app()->createUrl('frontend/article/views', array('id' => $lastblogs['id'])) ?>">
                                            <div class="img-wrapper">
                                                <img class="img img-responsive" src="<?=Yii::app()->baseUrl;?>/uploads/article/80-<?php echo $lastblogs['images'] ?>" alt="feature-image">
                                            </div>
                                            <div class="desc" style=" padding-top: 0px;">
                                                <p class="meta-time" style=" font-size: 10px; color:#e0cd8b;">
                                                    <?php echo $lastblogs['create_date'] ?></p>
                                                <h5 class="title font-THK" style=" font-size: 16px; color:#e0cd8b;"><?php echo $lastblogs['title'] ?></h5>
                                            </div>
                                        </a>
                                    </li>
                                <?php endforeach;?>
                            </ul>
                        </div>


                    </div>
                </div>
    </div>

    <br/>

    <div align="center">
        <button class="load_more btn btn-default" id="load_more_button" style=" background:none; border-color:#e0cd8b;  color:#e0cd8b">
        LOAD MORE <i class="fa fa-angle-down"></i>
    </button>
        <div class="animation_image" style="display:none;">
            <i class="fa fa-spinner fa-spin fa-3x fa-fw text-warning"></i> Loading...
        </div>
    </div>
    <br/>
</div>


<script>
    $(document).ready(function () {
        var screen = $(".widget-blog-post").width();
        var w = (screen - 100);
        $(".list-blog .desc").css({'width': w, 'height': '90px', 'overflow': 'hidden'});

    });

    function delete_article(id) {
        var url = "<?php echo Yii::app()->createUrl('backend/article/delete') ?>";
        var r = confirm("คุณแน่ใจหรือไม่ ...?");
        var data = {id: id};
        if (r == true) {
            $.post(url, data, function (success) {
                window.location = "<?php echo Yii::app()->createUrl('backend/article') ?>";
            });
        }
    }
</script>
