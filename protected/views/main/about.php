<script type="text/javascript">
    $(document).ready(function () {
        var style = {"height": "auto"};
        $("#box-article img").addClass("img-responsive");
        $("#box-article img").css(style);
    });
</script>
<?php
$title = "เกี่ยวกับเรา";
$this->breadcrumbs = array(
    $title,
);
?>
<div class=" container">
    <br/>
    <h1 class="font-supermarket"><?php echo $title ?></h1>
    
    <div id="box-article">
        <?php echo $about['about'] ?>
    </div>

</div>

