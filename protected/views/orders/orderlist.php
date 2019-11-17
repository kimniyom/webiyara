<?php
//session_start();
$this->breadcrumbs = array(
    "รายการสินค้า",
);
?>
<div class="container" style=" margin-top: 30px;">

    <div class="panel panel-info" style=" border: #cccccc solid 1px;">
        <div class="panel-heading" style=" padding: 10px; background: #ffffff; border-bottom: #cccccc solid 1px;">
            <i class="fa fa-cart-plus"></i> รายการสินค้าของคุณ
        </div>
        <div class="panel-body table-responsive" id="order_list_load">
            <?php if ($meCount > 0) { ?>
                <form action="<?php echo Yii::app()->createUrl('frontend/orders/updatecart') ?>" method="post" name="fromupdate">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style=" text-align: center;">#</th>
                                <th>รหัสสินค้า</th>
                                <th>ชื่อสินค้า</th>
                                <th style=" text-align: center;">จำนวน</th>
                                <th style=" text-align: center;">ราคาต่อหน่วย</th>
                                <th style=" text-align: center;">จำนวนเงิน</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total_price = 0;
                            $num = 0;
                            $a = 0;
                            foreach ($orders as $meResult):
                                $a++;
                                $key = array_search($meResult['product_id'], $_SESSION['cart']);
                                if ($meResult['product_price_pro'] > 0) {
                                    $product_price = $meResult['product_price_pro'];
                                } else {
                                    $product_price = $meResult['product_price'];
                                }
                                ?>
                                <tr>
                                    <td style=" text-align: center;"><?php echo $a ?></td>
                                    <td><?php echo $meResult['product_id']; ?></td>
                                    <td>
                                        <b><?php echo $meResult['product_name']; ?></b><br/>
                                        <?php
                                        $options = $_SESSION['options'][$meResult['product_id']];
                                        $priceOption = 0;
                                        for ($i = 0; $i <= count($options) - 1; $i++) {
                                            $sqls = "select o.*,m.product_id,m.masoption from optionproduct o inner join masoption m ON o.group_id = m.id where o.id = '" . $options[$i] . "'";
                                            $rsOption = Yii::app()->db->createCommand($sqls)->queryRow();
                                            $priceOption = $priceOption + $rsOption['price'];
                                            if ($rsOption['price'] > 0) {
                                                $priceOptionShow = " (+ " . $rsOption['price'] . ")";
                                            } else {
                                                $priceOptionShow = "";
                                            };
                                            echo "- " . $rsOption['masoption'] . " " . $rsOption['option'] . $priceOptionShow . "<br/>";
                                        }

                                        $total_price = $total_price + (($product_price + $priceOption) * $_SESSION['qty'][$key]);
                                        ?>
                                    </td>
                                    <td style="text-align: center;">
                            <center>
                                <input type="text" name="qty[<?php echo $num; ?>]" value="<?php echo $_SESSION['qty'][$key]; ?>" class="form-control" style="width: 60px;text-align: center;">
                                <input type="hidden" name="arr_key_<?php echo $num; ?>" value="<?php echo $key; ?>">
                            </center>
                            </td>
                            <td style=" text-align: right;"><?php echo number_format(($product_price + $priceOption), 2); ?></td>
                            <td style=" text-align: right;"><?php echo number_format((($product_price + $priceOption) * $_SESSION['qty'][$key]), 2); ?></td>
                            <td  style="text-align: center;">
                                <a class="btn btn-danger" href="<?php echo Yii::app()->createUrl('frontend/orders/removecart', array("itemId" => $meResult['product_id'])) ?>" role="button">
                                    <span class="glyphicon glyphicon-trash"></span>
                                    ลบทิ้ง</a>
                            </td>
                            </tr>
                            <?php
                            $num++;
                        endforeach;
                        ?>
                        <tr>
                            <td colspan="8" style="text-align: right;">
                                <h4>จำนวนเงินรวมทั้งหมด <?php echo number_format($total_price, 2); ?> บาท</h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="8" style="text-align: right;">
                                <button type="submit" class="btn btn-info">คำนวณราคาสินค้าใหม่</button>
                                <a href="<?php echo Yii::app()->createUrl('frontend/orders/order') ?>" type="button" class="btn btn-primary">สั่งซื้อสินค้า</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form>
            <?php } else { ?>
                <div class="alert alert-danger">ไม่มีสินค้าในตระกร้า</div>
            <?php } ?>
        </div>

    </div>
</div>

