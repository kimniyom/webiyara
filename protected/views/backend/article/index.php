<script type="text/javascript">
    $(document).ready(function () {
        $("#article").DataTable({
            //"sPaginationType": "full_numbers", // แสดงตัวแบ่งหน้า
            "bLengthChange": false, // แสดงจำนวน record ที่จะแสดงในตาราง
            "iDisplayLength": 20, // กำหนดค่า default ของจำนวน record 
            "bFilter": true, // แสดง search box
            "sort": false
            //"sScrollY": "400px", // กำหนดความสูงของ ตาราง
        });
    });
</script>

<?php
$this->breadcrumbs = array(
    'article',
);

$ArtcleModel = new Backend_article();
?>

<div class="panel panel-default">
    <div class="panel-heading">
        article
    </div>
    <div class="panel-body">
<div class="row">
    <div class="col-md-3 col-lg-3">
        <h4>Category</h4>
        <div class="list-group">
            <?php 
                $sum = 0;
                foreach($categorylist as $c): 
                $CountRow = $ArtcleModel->CountArticleByCategory($c['id']);
                $sum = $sum + $CountRow;
            ?>
                <a href="<?php echo Yii::app()->createUrl('backend/article/index',array("category" => $c['id'])) ?>" class="list-group-item <?php echo ($c['id'] == $category) ? "active" : ""; ?>">
                    <?php echo $c['category'] ?>
                    <span class="badge"><?php echo $CountRow ?></span>
                </a>
            <?php endforeach; ?>
            <a href="<?php echo Yii::app()->createUrl('backend/article/index/category') ?>" class="list-group-item <?php echo (!$category) ? "active" : ""; ?>">
                All
                <span class="badge"><?php echo $sum ?></span>
            </a>
        </div>
    </div>
    <div class="col-md-9 col-lg-9">
        <div class="well">
        <table class="table table-striped" id="article">
    <thead>
        <tr>
            <th><i class="fa fa-newspaper-o"></i> All</th>
            <th style="text-align: right;">
                <a href="<?php echo Yii::app()->createUrl('backend/article/create') ?>">
                    <button type="button" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> create</button></a>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($article as $rs) {
            if (!empty($rs['images'])) {
                $img = "uploads/article/" . $rs['images'];
            } else {
                $img = "images/No-image.jpg";
            }


            ?>
            <tr>
                <td>
                    <img class="media-object img-responsive" src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $img ?>" style=" max-width: 100px;">
                </td>
                <td>
                    <a href="<?php echo Yii::app()->createUrl('backend/article/view/id/' . $rs['id']) ?>">
                        <h4 class="media-heading"><?php echo $rs['title'] ?></h4></a>
                    <font id="font-glay">
                    <i class="fa fa-user"></i> <?php echo $rs['name'] . ' ' . $rs['lname'] ?>
                    <i class="fa fa-calendar"></i> <?php echo $rs['create_date'] ?>
                    </font>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</div>
    </div>
</div>
</div>
</div>

