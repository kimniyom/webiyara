<style type="text/css">
    .panel{
        border-color: #000000;
    }
    
    .panel .panel-heading{
        background: #000000;
    }
</style>

<?php
//session_start();
$this->breadcrumbs = array(
    "Orders" => array('backend/orders/index'),
    $order['id']
);
?>
<a href="<?php echo Yii::app()->createUrl('backend/orders/excelorder',array("id" => $order['id'])) ?>" target="_blank">
<button type="button" class="btn btn-success">
    <img src="<?php echo Yii::app()->baseUrl ?>/images/Excel-icon.png"/> excel
</button></a>
<br/><br/>
<div class="panel panel-primary">
    <div class="panel-heading" style=" border-radius: 0px;">ข้อมูลการสั่งซื้อ</div>
        <div class="panel-body">
        <table class="table">
            <thead>
                <tr>
                    <th colspan="6">
                        ผู้สั่งซื้อ <?php echo $order['order_fullname'] ?><br/>
                        ที่อยู่ <?php echo $order['order_address'] ?><br/>
                        โทรศัพท์ <?php echo $order['order_phone'] ?><br/>
                        อีเมล์ <?php echo $order['order_email'] ?>
                    </th>
                <tr>
                    <th style=" text-align: center;">#</th>
                    <th>รหัสสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th style=" text-align: center;">จำนวน</th>
                    <th style=" text-align: right;">ราคาต่อหน่วย</th>
                    <th style=" text-align: right;">จำนวนเงิน</th>
                </tr>
                </tr>
            </thead>
            <tbody>
       
                <?php
                $total_price = 0;
                $a = 0;
                $sumRow = 0;
                foreach ($orderList as $meResult):
                    $a++;
                    $sumRow = ($meResult['order_detail_price'] * $meResult['order_detail_quantity']);
                    $total_price = $total_price + $sumRow;
                    ?>
                    <tr>
                        <td style=" text-align: center;"><?php echo $a ?></td>
                        <td><?php echo $meResult['product_id']; ?></td>
                        <td>
                            <b><?php echo $meResult['product_name']; ?></b>
                            <?php if($meResult['product_option']){ ?>
                                <br/><?php echo $meResult['product_option']; ?>
                            <?php } ?>
                            </td>
                        <td style="text-align: center;">
                            <?php echo $meResult['order_detail_quantity'] ?>
                        </td>
                        <td style=" text-align: right;"><?php echo number_format($meResult['order_detail_price'], 2); ?></td>
                        <td style=" text-align: right;"><?php echo number_format($sumRow, 2) ?></td>
                    </tr>
                    <?php
                endforeach;
                ?>
               
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="6" style="text-align: right;">
                        <h4>จำนวนเงินรวมทั้งหมด <?php echo number_format($total_price, 2); ?> บาท</h4>
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>