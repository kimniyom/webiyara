<?php
//session_start();
$this->breadcrumbs = array(
    "รายการสินค้า",
);
?>
<div class="container" style=" padding-bottom: 20px; padding-top: 20px;">
    <form action="<?php echo Yii::app()->createUrl('frontend/orders/updateorder') ?>" method="post" name="formupdate" role="form" id="formupdate" onsubmit="JavaScript:return updateSubmit();">
        <div class="jumbotron">
            <h3>ข้อมูลผู้สั่งซื้อ<span class=" text-danger">*</span></h3>
            <hr/>
            <div class="form-group">
                <label for="exampleInputEmail1">ชื่อ-นามสกุล <span class=" text-danger">*</span></label>
                <input type="text" class="form-control" id="order_fullname" placeholder="ใส่ชื่อนามสกุล" style="width: 300px;" name="order_fullname">
            </div>
            <div class="form-group">
                <label for="exampleInputAddress">ที่อยู่ <span class=" text-danger">*</span></label>
                <textarea class="form-control" rows="6" style="width: 500px;" name="order_address" id="order_address"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputPhone">เบอร์โทรศัพท์ <span class=" text-danger">*</span></label>
                <input type="text" class="form-control" id="order_phone" placeholder="ใส่เบอร์โทรศัพท์ที่สามารถติดต่อได้" style="width: 300px;" name="order_phone" maxlength="10">
            </div>
            <div class="form-group">
                <label for="exampleInputPhone">EMAIL <span class=" text-danger">*</span></label>
                <input type="email" class="form-control" id="order_email" placeholder="ใส่ Email ที่สามารถติดต่อได้" style="width: 500px;" name="order_email">
            </div>
        </div>
        <div class="jumbotron">
            <h3>ข้อมูลการสั่งซื้อ</h3>
            <hr/>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>รหัสสินค้า</th>
                        <th>ชื่อสินค้า</th>
                        <th style=" text-align: center;">จำนวน</th>
                        <th style=" text-align: right;">ราคาต่อหน่วย</th>
                        <th style=" text-align: right;">จำนวนเงิน</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total_price = 0;
                    $num = 0;
                    foreach ($orders as $meResult) {
                        $key = array_search($meResult['product_id'], $_SESSION['cart']);
                        if ($meResult['product_price_pro'] > 0) {
                            $product_price = $meResult['product_price_pro'];
                        } else {
                            $product_price = $meResult['product_price'];
                        }
                        //$total_price = $total_price + ($product_price * $_SESSION['qty'][$key]);
                        ?>
                        <tr>
                            <td><?php echo $meResult['product_id']; ?></td>
                            <td>
                                <?php echo $meResult['product_name']; ?><br/>
                                <?php
                                $options = $_SESSION['options'][$meResult['product_id']];
                                $priceOption = 0;
                                $ProductOption = "";
                                for ($i = 0; $i <= count($options) - 1; $i++) {
                                    $sql = "select o.*,m.product_id,m.masoption from optionproduct o inner join masoption m ON o.group_id = m.id where o.id = '" . $options[$i] . "'";
                                    $rsOption = Yii::app()->db->createCommand($sql)->queryRow();
                                    $priceOption = $priceOption + $rsOption['price'];
                                    if ($rsOption['price'] > 0) {
                                        $priceOptionShow = " (+ " . $rsOption['price'] . ")";
                                    } else {
                                        $priceOptionShow = "";
                                    };
                                    echo "- " . $rsOption['masoption'] . " " . $rsOption['option'] . $priceOptionShow . "<br/>";
                                    $ProductOption .= "-".$rsOption['masoption'] . " " . $rsOption['option'] . "<br/>";
                                }
                                $total_price = $total_price + (($product_price + $priceOption) * $_SESSION['qty'][$key]);
                                ?>
                            </td>
                            <td style=" text-align: center;">
                                <?php echo $_SESSION['qty'][$key]; ?>
                                <input type="hidden" name="qty[]" value="<?php echo $_SESSION['qty'][$key]; ?>" />
                                <input type="hidden" name="product_id[]" value="<?php echo $meResult['product_id']; ?>" />
                                <input  type="hidden" name="product_price[]" value="<?php echo ($product_price + $priceOption); ?>" />
                                <input  type="hidden" name="product_option[]" value="<?php echo $ProductOption ?>" />
                            </td>
                            <td style=" text-align: right;"><?php echo number_format(($product_price + $priceOption), 2); ?></td>
                            <td style=" text-align: right; font-weight: bold;"><?php echo number_format((($product_price + $priceOption) * $_SESSION['qty'][$key]), 2); ?></td>
                        </tr>
                        <?php
                        $num++;
                    }
                    ?>
                    <tr>
                        <td colspan="8" style="text-align: right;">
                            <div style=" font-weight: bold; font-size: 20px;">จำนวนเงินรวมทั้งหมด <?php echo number_format($total_price, 2); ?> บาท</div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8" style="text-align: right;">
                            <input type="hidden" name="formid" value="<?php echo $_SESSION['formid']; ?>"/>
                            <a href="<?php echo Yii::app()->createUrl('frontend/orders/cart') ?>" type="button" class="btn btn-danger">ย้อนกลับ</a>
                            <button type="submit" class="btn btn-primary">บันทึกการสั่งซื้อสินค้า</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </form>
    <div class="jumbotron">
        <h3>ช่องทางการชำระเงิน</h3>
        <hr/>
        <h4>โอนเงินผ่านบัญชีธนาคาร</h4><br/>
        <div class="row">
            <?php
            $i = 1;
            foreach ($payment as $rs): $i++;
                ?>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="row">
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                            <img src="<?php echo Yii::app()->baseUrl . '/images/' . $rs['bank_img']; ?>" class="img-resize img-responsive"/>
                        </div>
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                            <b style="font-size: 18px;"><?php echo $rs['bank_name']; ?></b><br/>
                            ชื่อบัญชี <?php echo $rs['bookbank_name']; ?><br/>
                            สาขา <?php echo $rs['bank_branch']; ?><br/>
                            <b>เลขที่บัญชี <?php echo $rs['bookbank_number']; ?></b>
                        </div>
                    </div>
                    <hr/>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


</div>

<script type="text/javascript">
    function updateSubmit() {
        if (document.formupdate.order_fullname.value == "") {
            alert('โปรดใส่ชื่อนามสกุลด้วย!');
            document.formupdate.order_fullname.focus();
            return false;
        }
        if (document.formupdate.order_address.value == "") {
            alert('โปรดใส่ที่อยู่ด้วย!');
            document.formupdate.order_address.focus();
            return false;
        }
        if (document.formupdate.order_phone.value == "") {
            alert('โปรดใส่เบอร์โทรด้วย!');
            document.formupdate.order_phone.focus();
            return false;
        }

        if (document.formupdate.order_email.value == "") {
            alert('โปรดใส่ Email ด้วย!');
            document.formupdate.order_email.focus();
            return false;
        }
        document.formupdate.submit();
        return false;
    }
</script>