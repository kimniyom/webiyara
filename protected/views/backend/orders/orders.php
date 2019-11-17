<?php
//session_start();
$this->breadcrumbs = array(
    "Orders",
);
?>
<h3 style=" margin-top: 0px;">รายการสั้งซื้อสินค้า</h3>
<hr/>
<?php 
    if(!$order){
        echo "ไม่มีรายการสั่งซื้อ";
    }
?>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <?php
    $i = 0;
    foreach ($order as $rs): $i++;
        if ($i == 1) {
            $class = "";
            $expanded = "true";
            $panelCol = "in";
        } else {
            $class = "class='panel-title'";
            $expanded = "false";
            $panelCol = "";
        }

        $sql = "select o.*,p.product_name from order_details o inner join product p on o.product_id = p.product_id where order_id = '" . $rs['id'] . "' ";
        $orderList = Yii::app()->db->createCommand($sql)->queryAll();
        ?>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading<?php echo $rs['id'] ?>">
                <h4 class="panel-title">
                    <a <?php echo $class ?> role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $rs['id'] ?>" aria-expanded="<?php echo $expanded ?>" aria-controls="collapse<?php echo $rs['id'] ?>">
                        คุณ <?php echo $rs['order_fullname'] ?>(<?php echo $rs['order_date'] ?>)
                    </a>
                </h4>
            </div>
            <div id="collapse<?php echo $rs['id'] ?>" class="panel-collapse collapse <?php echo $panelCol ?>" role="tabpanel" aria-labelledby="heading<?php echo $rs['id'] ?>">
                <div class="panel-body">
                    <div class="well">
                        <b>ที่อยู่.</b> <?php echo $rs['order_address'] ?><br/>
                        <b>Tel.</b> <?php echo $rs['order_phone'] ?><br/>
                        <b>E-mail.</b> <?php echo $rs['order_email'] ?><br/>
                    </div>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style=" text-align: center;">#</th>
                                <th>รหัสสินค้า</th>
                                <th>ชื่อสินค้า</th>
                                <th style=" text-align: center;">จำนวน</th>
                                <th style=" text-align: center;">ราคาต่อหน่วย</th>
                                <th style=" text-align: center;">จำนวนเงิน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total_price = 0;
                            $num = 0;
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
                                        <?php if ($meResult['product_option']) { ?>
                                            <br/>
                                            <?php echo $meResult['product_option']; ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: center;">
                            <center>
                                <?php echo $meResult['order_detail_quantity'] ?>
                            </center>
                            </td>
                            <td style=" text-align: right;"><?php echo number_format($meResult['order_detail_price'], 2); ?></td>
                            <td style=" text-align: right;"><?php echo number_format($sumRow, 2) ?></td>

                            </tr>
                            <?php
                            $num++;
                        endforeach;
                        ?>
                        <tr>
                            <td colspan="6" style="text-align: right;">
                                <h4>จำนวนเงินรวมทั้งหมด <?php echo number_format($total_price, 2); ?> บาท</h4>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class=" panel-footer">
                    <div class="row">
                        <div class="col-md-9 col-lg-9 col-sm-7">
                            <button type="button" class="btn btn-success btn-block btn-lg" onclick="ConfirmOrder('<?php echo $rs['id'] ?>')"><i class="fa fa-check"></i> ยืนยัน</button>
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-5">
                            <button type="button" class="btn btn-danger btn-block btn-lg" onclick="CancelOrder('<?php echo $rs['id'] ?>')"><i class="fa fa-trash"></i> ยกเลิก</button>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    <?php endforeach; ?>

</div>

<script type="text/javascript">
    function ConfirmOrder(order_id) {
        var r = confirm("ตรวจสอบความถูกต้องก่อนยืนยันรายการ...?");
        if (r == true) {
            var url = "<?php echo Yii::app()->createUrl('backend/orders/confirmorder') ?>";
            var data = {order_id: order_id};
            $.post(url, data, function(datas) {
                window.location.reload();
            });
        }
    }

    function CancelOrder(order_id) {
        var r = confirm("Are you sure...?");
        if (r == true) {
            var url = "<?php echo Yii::app()->createUrl('backend/orders/deleteorder') ?>";
            var data = {order_id: order_id};
            $.post(url, data, function(datas) {
                window.location.reload();
            });
        }
    }
</script>

