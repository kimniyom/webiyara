<?php
//คำสั่ง connect db เขียนเพิ่มเองนะ

$strExcelFileName = $order['order_fullname'].".xls";
header("Content-Type: application/x-msexcel; name=\"$strExcelFileName\"");
header("Content-Disposition: inline; filename=\"$strExcelFileName\"");
header("Pragma:no-cache");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:o="urn:schemas-microsoft-com:office:office"xmlns:x="urn:schemas-microsoft-com:office:excel"xmlns="http://www.w3.org/TR/REC-html40">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>
        <div id="SiXhEaD_Excel" align=center x:publishsource="Excel">
            <table x:str border=1 cellpadding=0 cellspacing=1 width=100% style="border-collapse:collapse; font-size: 16px;">
               <thead>
                <tr>
                    <th colspan="6" style=" text-align: left;">
                        ผู้สั่งซื้อ:: <?php echo $order['order_fullname'] ?><br/>
                        ที่อยู่:: <?php echo $order['order_address'] ?><br/>
                        โทรศัพท์:: <?php echo $order['order_phone'] ?><br/>
                        อีเมล์:: <?php echo $order['order_email'] ?>
                    </th>
                <tr>
                    <th style=" text-align: center;">#</th>
                    <th style=" text-align: left;">รหัสสินค้า</th>
                    <th style=" text-align: left;">ชื่อสินค้า</th>
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
                    <tr style=" font-size: 14px;">
                        <td style=" text-align: center;"><?php echo $a ?></td>
                        <td style=" text-align: left;"><?php echo $meResult['product_id']; ?></td>
                        <td style=" text-align: left;"><?php echo $meResult['product_name']; ?></td>
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
                    <th colspan="6" style="text-align: right; font-size: 16px;">
                        <h4>จำนวนเงินรวมทั้งหมด <?php echo number_format($total_price, 2); ?> บาท</h4>
                    </th>
                </tr>
            </tfoot>
            </table>
        </div>
    </body>
</html>


