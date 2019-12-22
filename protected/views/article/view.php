<style type="text/css">
    #body{
        background: rgba(69,67,59,1);
        background: -moz-radial-gradient(center, ellipse cover, rgba(69,67,59,1) 0%, rgba(0,0,0,1) 100%);
        background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, rgba(69,67,59,1)), color-stop(100%, rgba(0,0,0,1)));
        background: -webkit-radial-gradient(center, ellipse cover, rgba(69,67,59,1) 0%, rgba(0,0,0,1) 100%);
        background: -o-radial-gradient(center, ellipse cover, rgba(69,67,59,1) 0%, rgba(0,0,0,1) 100%);
        background: -ms-radial-gradient(center, ellipse cover, rgba(69,67,59,1) 0%, rgba(0,0,0,1) 100%);
        background: radial-gradient(ellipse at center, rgba(69,67,59,1) 0%, rgba(0,0,0,1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#45433b', endColorstr='#000000', GradientType=1 );
    }


    .image-link img {
        transition: opacity 0.3s ease-out;
    }
    .image-link img:hover {
        opacity: 0.5;
        transition: opacity 0.3s ease-in;
    }

    .mfp-with-zoom .mfp-container,
    .mfp-with-zoom.mfp-bg {
        opacity: 0;
        -webkit-backface-visibility: hidden;
        /* ideally, transition speed should match zoom duration */
        -webkit-transition: all 0.3s ease-out;
        -moz-transition: all 0.3s ease-out;
        -o-transition: all 0.3s ease-out;
        transition: all 0.3s ease-out;
    }

    .mfp-with-zoom.mfp-ready .mfp-container {
        opacity: 1;
    }
    .mfp-with-zoom.mfp-ready.mfp-bg {
        opacity: 0.8;
    }

    .mfp-with-zoom.mfp-removing .mfp-container,
    .mfp-with-zoom.mfp-removing.mfp-bg {
        opacity: 0;
    }
</style>

<script type="text/javascript">
    $(document).ready(function() {
        var style = {"height": "auto"};
        $("#box-article img").addClass("img-responsive");
        $("#box-article img").css(style);

        $('.image-link').magnificPopup({
            type: 'image',
            mainClass: 'mfp-with-zoom', // this class is for CSS animation below
            gallery: {
                enabled: true
            },
            zoom: {
                enabled: true, // By default it's false, so don't forget to enable it

                duration: 300, // duration of the effect, in milliseconds
                easing: 'ease-in-out', // CSS transition easing function

                // The "opener" function should return the element from which popup will be zoomed in
                // and to which popup will be scaled down
                // By defailt it looks for an image tag:
                opener: function(openerElement) {
                    // openerElement is the element on which popup was initialized, in this case its <a> tag
                    // you don't need to add "opener" option if this code matches your needs, it's defailt one.
                    return openerElement.is('img') ? openerElement : openerElement.find('img');
                }
            }
        });
    });
</script>
<?php
$config = new Configweb_model();
$articleModel = new Article();
$this->breadcrumbs = array(
    "article" => array('frontend/article'),
    $result['title'],
);

$UrlShare = $config->GetFullLink(Yii::app()->request->url);
?>

<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.5&appId=266256337158296";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

</script>

<script type="text/javascript">
    $(document).ready(function() {

        var style = {"height": "auto"};
        $("#box-article img").addClass("img-responsive");
        $("#box-article img").css(style);

        $('.img_zoom').magnificPopup({
            delegate: 'a', // child items selector, by clicking on it popup will open
            type: 'image',
            gallery: {
                enabled: true
            }
            // other options
        });

    });
</script>

<br/>

<section class="boxed-sm">
    <div class="container">
        <div class="row main">
            <div class="row">
                <div class="col-md-9">
                    <article class="blog-detail" style="border-bottom:#e0cd8b solid 1px;">
                        <h3 class="title-blog-detail font-THK" style="font-size: 34px; color: #ffffff;"><?php echo $result['title'] ?></h3>
                        <p class="meta" style=" color: #ffffff;">
                            <span class="time">
                                <i class="fa fa-calendar"></i> <?php echo $result['create_date'] ?>
                                <i class="fa fa-user"></i> <?php echo $result['name'] . ' ' . $result['lname'] ?>
                            </span>
                            <span class="comment"><?php echo $result['countread'] ?></span>
                        </p>
                        <div class="content">
                            <img class="feature-image" src="<?= Yii::app()->baseUrl; ?>/uploads/article/870-<?php echo $result['images'] ?>" alt="feature-image">
                            <div id="box-article" style="color:#e0cd8b">
                                <?php echo $result['detail']; ?>
                            </div>
                            <br/>
                            <span class="label label-danger" style=" font-size: 14px;"><i class="fa fa-tag"></i> <?php echo $result['category_name'] ?></span><br/><br/>
                        </div>
                    </article>

                    <br/>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="widget-social-color">
                                <ul>
                                    <li>
                                        <a href="http://www.facebook.com/sharer.php?u=<?php echo $UrlShare ?>" target="_blank">
                                            <img src="<?php echo Yii::app()->baseUrl ?>/images/facebook.png" alt="Facebook" style="width:48px;"/>
                                        </a>
                                    </li>

                                    <li>
                                        <!-- Pinterest -->
                                        <a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());">
                                            <img src="<?php echo Yii::app()->baseUrl ?>/images/pinterest.png" alt="Pinterest" style="width:48px;"/>
                                        </a>
                                    </li>
                                    <li>
                                        <!-- Twitter -->
                                        <a href="https://twitter.com/share?url=<?php echo $UrlShare ?>&amp;text=<?php echo Yii::app()->session['fbtitle']; ?>;hashtags=<?php echo $config->get_webname() ?>" target="_blank">
                                            <img src="<?php echo Yii::app()->baseUrl ?>/images/twitter.png" alt="Twitter" style="width:48px;"/>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://lineit.line.me/share/ui?url=<?php echo $UrlShare ?>" target="_blank">
                                            <img src="<?php echo Yii::app()->baseUrl ?>/images/line-icon.png" alt="Line" style="width:48px;"/>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <br/>

                    <?php if (count($gallery) > 0) { ?>
                        <h4 class=" font-supermarket" style=" font-size: 24px; color:#e0cd8b;">Gallery</h4>
                        <br/>
                        <div class="img_zoom">
                            <div class="row">
                                <?php foreach ($gallery as $gallerys): ?>
                                    <div class="col-md-3 col-lg-2 col-sm-3 col-xs-3">
                                        <a class="image-link" href="<?php echo Yii::app()->baseUrl; ?>/uploads/article/gallery/600-<?= $gallerys['images'] ?>">
                                            <img src="<?php echo Yii::app()->baseUrl ?>/uploads/article/gallery/200-<?php echo $gallerys['images'] ?>" class="img img-responsive"/></a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <hr style="color:#e0cd8b; border-color:#e0cd8b"/>
                    <?php } ?>

                    <?php if (count($near) > 0) { ?>

                        <br/>
                        <div class="row" style="margin-bottom:20px;">
                            <?php foreach ($near as $nears): ?>
                                <div class="col-md-4 col-lg-4 col-sm-4">
                                    <div style="background:#0f0f0f; padding-bottom:20px;">
                                        <img class="img img-responsive" src="<?= Yii::app()->baseUrl; ?>/uploads/article/600-<?php echo $nears['images'] ?>" alt="feature-image"><br/>
                                        <a href="<?php echo Yii::app()->createUrl('frontend/article/views', array('id' => $nears['id'])) ?>">
                                            <div style="height:100px; padding:10px; overflow:hidden; color:#e0cd8b; font-size:16px;">
                                                <?php echo $nears['create_date'] ?><br/>
                                                <?php echo $nears['title'] ?>
                                            </div></a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-md-3">
                    <div class="sidebar">
                        <div class="widget widget-blog-post" style="background:#0f0f0f;border:none;">
                            <h4 class="title text-center font-supermarket" style=" font-size: 24px; color:#e0cd8b;">Last Post</h4>
                            <ul class="list-blog">
                                <?php foreach ($lastblog as $lastblogs):
                                    ?>
                                    <li style="border-color:#e0cd8b;">
                                        <a href="<?php echo Yii::app()->createUrl('frontend/article/views', array('id' => $lastblogs['id'])) ?>">
                                            <div class="img-wrapper">
                                                <img class="img img-responsive" src="<?= Yii::app()->baseUrl; ?>/uploads/article/80-<?php echo $lastblogs['images'] ?>" alt="feature-image">
                                            </div>
                                            <div class="desc" style=" padding-top: 0px; color:#e0cd8b;">
                                                <p class="meta-time" style=" font-size: 12px; color:#e0cd8b;"><?php echo $lastblogs['create_date'] ?></p>
                                                <h5 class="title font-THK" style=" font-size: 16px;"><?php echo $lastblogs['title'] ?></h5>
                                            </div>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="widget widget-categories" style="background:#0f0f0f;border:none;">
                            <h4 class="title-widget text-center font-supermarket" style=" font-size: 24px; color:#e0cd8b;">Categories</h4>
                            <ul>
                                <?php foreach ($category as $categorys): ?>
                                    <li style="margin-bottom: 0px; padding: 0px;border-color:#e0cd8b;">
                                        <a href="<?php echo Yii::app()->createUrl('frontend/article/index', array('category' => $categorys['id'])) ?>" class=" font-THK" style=" font-size: 22px;color:#e0cd8b;"><?php echo $categorys['category'] ?>
                                            <span class="badge pull-right" style=" color: #000; font-size: 18px; margin-top: 5px;background:#e0cd8b;"><?php echo $articleModel->CountArticleByCategory($categorys['id']) ?></span>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        var screen = $(".widget-blog-post").width();
        var w = (screen - 100);
        $(".list-blog .desc").css({'width': w, 'height': '90px', 'overflow': 'hidden'});

    });

    function delete_article(id) {
        var url = "<?php echo Yii::app()->createUrl('backend/article/delete') ?>";
        var r = confirm("คุณแน่ใจหรือไม่ ...?");
        var data = {id: id};
        if (r == true) {
            $.post(url, data, function(success) {
                window.location = "<?php echo Yii::app()->createUrl('backend/article') ?>";
            });
        }
    }
</script>