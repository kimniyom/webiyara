
<script type="text/javascript">
    $(document).ready(function () {
        var style = {"height": "auto"};
        $("#box-article img").addClass("img-responsive");
        $("#box-article img").css(style);
    });
</script>
<?php
$config = new Configweb_model();
$this->breadcrumbs = array(
    "บทความ / event" => array('frontend/article'),
    $result['title'],
);
?>

<br/>
<section class="boxed-sm">
    <div class="container">
        <div class="row main">
            <div class="row">
                <div class="col-md-3">
                    <div class="sidebar">
                        <div class="widget widget-search">
                            <form class="organic-form form-inline btn-add-on border no-radius">
                                <div class="form-group">
                                    <input class="form-control" placeholder="Search..." type="text">
                                    <button class="btn btn-brand" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="widget widget-blog-post">
                            <h4 class="title text-center">ล่าสุด</h4>
                            <ul class="list-blog">
                                <?php foreach ($lastblog as $lastblogs):
                                    ?>
                                    <li>
                                        <a href="<?php echo Yii::app()->createUrl('frontend/article/views', array('id' => $lastblogs['id'])) ?>">
                                            <div class="img-wrapper">
                                                <img class="img img-responsive" src="<?= Yii::app()->baseUrl; ?>/uploads/article/80-<?php echo $lastblogs['images'] ?>" alt="feature-image">
                                            </div>
                                            <div class="desc" style=" padding-top: 0px;">
                                                <p class="meta-time" style=" font-size: 12px"><?php echo $config->thaidate(substr($lastblogs['create_date'], 0, 10)) ?></p>
                                                <h5 class="title"><?php echo $lastblogs['title'] ?></h5>
                                            </div>
                                        </a>
                                    </li>
                                <?php endforeach; ?>

                            </ul>
                        </div>
                        <div class="widget widget-categories">
                            <h4 class="title-widget text-center">Categories</h4>
                            <ul>
                                <?php foreach ($category as $categorys): ?>
                                    <li>
                                        <a href="shop.html"><?php echo $categorys['category'] ?>
                                            <span>(5)</span>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="widget widget-categories">
                            <h4 class="title-widget text-center">Archives</h4>
                            <ul>
                                <li>
                                    <a href="shop.html">March 2017
                                        <span>(5)</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="shop.html">Feberuary 2017
                                        <span>(7)</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="shop.html">January 2017
                                        <span>(9)</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="shop.html">December 2016
                                        <span>(10)</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="shop.html">November 2016
                                        <span>(6)</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <article class="blog-detail">
                        <h3 class="title-blog-detail"><?php echo $result['title'] ?></h3>
                        <p class="meta">
                            <span class="time">
                                <i class="fa fa-calendar"></i> <?php echo $result['create_date'] ?>
                                <i class="fa fa-user"></i> <?php echo $result['name'] . ' ' . $result['lname'] ?>
                            </span>
                            <span class="comment">0</span>
                        </p>
                        <div class="content">
                            <img class="feature-image" src="<?= Yii::app()->baseUrl; ?>/uploads/article/870-<?php echo $result['images'] ?>" alt="feature-image">
                            <?php echo $result['detail']; ?><br/>
                            <span class="label label-danger" style=" font-size: 14px;"><?php echo $result['category_name'] ?></span><br/><br/>
                        </div>
                    </article>
                    <br/>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="widget-social-color">
                                <ul>
                                    <li>
                                        <a class="facebook" data-toggle="tooltip" title="Facebook" href="http://www.facebook.com/authemes">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="pinterest" data-toggle="tooltip" title="Pinterest" href="http://www.pinterest.com/authemes">
                                            <i class="fa fa-pinterest"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="twitter" data-toggle="tooltip" title="Twitter" href="http://www.twitter.com/authemes">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="google-plus" data-toggle="tooltip" title="Google Plus" href="https://plus.google.com/authemes">
                                            <i class="fa fa-google-plus"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="instagram" data-toggle="tooltip" title="Instagram" href="https://instagram.com/authemes">
                                            <i class="fa fa-instagram"> </i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="post-control">
                                <?php if ($pre['id']) { ?>
                                    <a class="prev-post" href="<?php echo Yii::app()->createUrl('frontend/article/views', array('id' => $pre['id'])) ?>">
                                        <i class="fa fa-angle-left"></i>PREVIOUSE POST
                                        <h4 class="title-next-post"><?php echo $pre['title'] ?></h4>
                                    </a>
                                <?php } else { ?>
                                    <a class="prev-post"><i class="fa fa-angle-left"></i>PREVIOUSE POST</a>
                                <?php } ?>
                                <?php if ($next['id']) { ?>
                                    <a class="next-post" href="<?php echo Yii::app()->createUrl('frontend/article/views', array('id' => $next['id'])) ?>">NEXT POST
                                        <i class="fa fa-angle-right"></i>
                                        <h4 class="title-next-post"><?php echo $next['title'] ?></h4>
                                    </a>
                                <?php } else { ?>
                                    <a class="next-post">NEXT POST<i class="fa fa-angle-right"></i></a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <article class="blog-detail">
                        <h3 style=" text-align: center;">ที่เกี่ยวข้อง</h3><br/>
                    </article>
                    <br/>
                    <div class="row">
                        <?php foreach ($near as $nears): ?>
                            <div class="col-md-4 col-lg-4 col-sm-4">
                                <img class="img img-responsive" src="<?= Yii::app()->baseUrl; ?>/uploads/article/600-<?php echo $nears['images'] ?>" alt="feature-image"><br/>
                                <a href="<?php echo Yii::app()->createUrl('frontend/article/views', array('id' => $nears['id'])) ?>">
                                    <?php echo $config->thaidate(substr($nears['create_date'], 0, 10)) ?><br/>
                                    <?php echo $nears['title'] ?></a>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>

<script>
    $(document).ready(function () {
        var screen = $(".widget-blog-post").width();
        var w = (screen - 100);
        $(".list-blog .desc").css({'width': w, 'height': '100px', 'overflow': 'hidden'});
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