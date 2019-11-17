<style type="text/css">
    .center-cropped {
        width: 50px;
        height: 50px;
        background-position: center center;
        background-repeat: no-repeat;
    }
</style>

<script type="text/javascript">
    $(document).ready(function() {
        $("#p_product").dataTable({
            //"sPaginationType": "full_numbers", // แสดงตัวแบ่งหน้า
            "bLengthChange": false, // แสดงจำนวน record ที่จะแสดงในตาราง
            "iDisplayLength": 10, // กำหนดค่า default ของจำนวน record
            "bFilter": true // แสดง search box
                    //"sScrollY": "400px", // กำหนดความสูงของ ตาราง
        });
    });
</script>

<?php
$this->breadcrumbs = array(
    'product' => array('backend/product'),
    $brand['brandname'],
);
?>

<div class="panel panel-default">
    <div class="panel-heading" style=" padding-bottom: 15px; padding-right: 5px;">
        <?php echo $brand['brandname'] ?> total
        <?php echo count($product); ?> items
        <div class="pull-right">
            <a href="<?php echo Yii::app()->createUrl('backend/product/createproduct') ?>">
                <div class="btn btn-success btn-sm">
                    <i class="fa fa-plus"></i>
                    <i class="fa fa-cart-plus"></i>
                    Add Producr</div></a>
        </div>
    </div>
    <div class="panel-body">
        <table class="table" id="p_product">
            <thead>
                <tr>
                    <th style="width:20px;">#</th>
                    <th>Photo</th>
                    <th>Product Name</th>
                    <th style="text-align:center;"><i class="fa fa-cog"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $product_model = new Product();
                $i = 0;
                foreach ($product as $last):
                    //$img_title = $product_model->get_images_product_title($last['product_id']);
                    $firstImg = $product_model->firstpictures($last['product_id']);
                    if (!empty($firstImg)) {
                        $img = "uploads/product/thumbnail/100-" . $firstImg;
                    } else {
                        $img = "images/No_image_available.jpg";
                    }
                    $link = Yii::app()->createUrl('backend/product/detail_product/product_id/' . $last['product_id']);
                    $i++;
                    $trid = "td" . $i;
                    ?>
                    <tr id="<?php echo $trid; ?>">
                        <td><?php echo $i ?></td>
                        <td>
                            <div class="center-cropped"
                                 style="background: url('<?php echo Yii::app()->baseUrl; ?>/<?php echo $img; ?>')no-repeat top center;
                                 -webkit-background-size: cover;
                                 -moz-background-size: cover;
                                 -o-background-size: cover;
                                 background-size: cover;">
                            </div>
                        </td>
                        <td>
                            <?php echo $last['product_name']; ?><br/>
                            <?php echo $last['description'] ?>
                        </td>
                        <td style="width:150px;">
                            <a href="<?php echo $link; ?>"><i class="fa fa-eye"></i> view</a><br/>
                            <a href="<?php echo Yii::app()->createUrl('backend/product/update', array('product_id' => $last['product_id'])); ?>"><i class="fa fa-edit"></i> update</a><br/>
                            <a href="javascript:Deletes('<?php echo $last['product_id'] ?>')"><i class="fa fa-trash"></i> delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    function Deletes(id) {
        var r = confirm("Are you sure ...?");
        if (r == true) {
            var url = "<?php echo Yii::app()->createUrl('backend/product/deleteproduct') ?>";
            var data = {product_id: id};

            $.post(url, data, function(result) {
                window.location.reload();
            });
        }
    }
</script>
