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
</style>
<script type="text/javascript">
    $(document).ready(function() {
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
    $(document).ready(function() {
        var track_click = 0; //track user click on "load more" button, righ now it is 0 click
        //fetch_pages.php
        var total_pages = "<?php echo $count; ?>";
        var category = "<?php echo $category['id']; ?>";
        $('#results').load("<?php echo Yii::app()->createUrl('frontend/product/pagescategory') ?>", {'page': track_click, category: category}, function() {
            track_click++;
        }); //initial data to load

        $(".load_more").click(function(e) { //user clicks on button

            $(this).hide(); //hide load more button on click
            $('.animation_image').show(); //show loading image

            if (track_click <= total_pages) //make sure user clicks are still less than total pages
            {
                //post page number and load returned data into result element
                $.post('<?php echo Yii::app()->createUrl('frontend/product/pagescategory') ?>',
                        {'page': track_click, category: category},
                        function(data) {
                            if (data == 0) {
                                $('.animation_image').hide();
                                $(".load_more").attr("disabled", "disabled");
                                return false;
                            }
                            $(".load_more").show(); //bring back load more button


                            $("#results").append(data); //append data received from server

                            //scroll page to button element
                            $("html, body").animate({scrollTop: $("#load_more_button").offset().top}, 500);

                            //hide loading image
                            $('.animation_image').hide(); //hide loading image once data is received

                            track_click++; //user click increment on load button

                        }).fail(function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError); //alert any HTTP error
                    $(".load_more").show(); //bring back load more button
                    $('.animation_image').hide(); //hide loading image once data is received
                });

                //total_pages - 1

                if ((track_click * 8) <= (total_pages - 1)) {
                    $(".load_more").attr("disabled", "disabled");
                }
            }
        });
    });
</script>

<?php
$this->breadcrumbs = array(
    $category['categoryname']
);
?>

<div class="container" style=" padding: 30px;">
    <div class="row" style=" margin-bottom: 30px;">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div style=" float: left;">
                <img src="<?php echo Yii::app()->baseUrl ?>/uploads/category/thumbnail/<?php echo $category['icons'] ?>" style=" width: 80px;"/>
            </div>
            <div style=" float: left; margin-left: 0px; padding-left: 20px; color: #e0cd8b;">
                <h2 class="font-supermarket"><?php echo $category['categoryname'] ?></h2>
                <hr style=" margin: 10px 0px; border-bottom: #e0cd8b solid 2px;"/>
                <h4 class="font-supermarket">total <?php echo $count ?> items</h4>
            </div>
        </div>
    </div>
    <div class="row product-grid-equal-height-wrapper product-equal-height-4-columns flex multi-row" id="results"></div>
</div>

<div align="center">
    <button class="load_more btn btn-default" id="load_more_button" style=" background:none; border-color:#e0cd8b;  color:#e0cd8b">
        LOAD MORE <i class="fa fa-angle-down"></i>
    </button>
    <div class="animation_image" style="display:none;">
        <i class="fa fa-spinner fa-spin fa-3x fa-fw text-warning"></i> Loading...
    </div>
</div><br/>
