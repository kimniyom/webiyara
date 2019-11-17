
<?php
//คำสั่ง connect db เขียนเพิ่มเองนะ

$strExcelFileName = "รายการสั่งซื้อ.xls";
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
                        <th colspan="7" style=" text-align: left;">
                            ข้อมูลวันที่ <?php echo $datestart." ถึง ".$dateend ?>
                        </th>
                    </tr>
                    <tr>
                        <th style=" width: 50px;">#</th>
                        <th style=" text-align: left;">ผู้สั่งซื้อ</th>
                        <th style=" text-align: left;">โทรศัพท์</th>
                        <th style=" text-align: center;">วันที่สั่งซื้อ</th>
                        <th style="text-align:center;">จำนวน</th>
                        <th style="text-align:right;">รวม</th>
                        <th style="text-align:center;">สถานะ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sum = array(0, 0);
                    if ($orderlist) {
                        ?>
                        <?php
                        $i = 0;
                        foreach ($orderlist as $rs):
                            $i++;
                            $sum[0] = $sum[0] + $rs['number'];
                            $sum[1] = $sum[1] + $rs['total'];
                            ?>
                            <tr>
                                <td style=" text-align: center;"><?php echo $i ?></td>
                                <td style=" text-align: left;"><?php echo $rs['order_fullname'] ?></td>
                                <td style=" text-align: left;"><?php echo $rs['order_phone'] ?></td>
                                <td style=" text-align: center;"><?php echo $rs['order_date'] ?></td>
                                <td style="text-align:center;"><?php echo $rs['number'] ?></td>
                                <td style="text-align:right;"><?php echo number_format($rs['total'], 2) ?></td>
                                <td style="text-align:center;">
                                    <?php
                                    if ($rs['order_confirm'] == "0") {
                                        echo "<i class='fa fa-info' style='color:orange;'></i> รอยืนยัน";
                                    } else if ($rs['order_confirm'] == "1") {
                                        echo "<i class='fa fa-check' style='color:green;'></i> ยืนยัน";
                                    } else if ($rs['order_confirm'] == "3") {
                                        echo "<i class='fa fa-remove' style='color:red;'></i> ยกเลิก";
                                    }
                                    ?>
                                </td>
                                
                            </tr>	
                            <?php
                        endforeach;
                        ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="7" style=" text-align: center;">== ไม่มีข้อมูล ==</td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr style=" background: #cccccc;">
                        <th colspan="4" style="text-align:center;">รวม</th>
                        <th style="text-align:center;"><?php echo number_format($sum[0]) ?></th>
                        <th style="text-align:right;"><?php echo number_format($sum[1], 2) ?></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <p style=" text-align: left; font-size: 12px; float: right; width: 100%;"><?php echo date("d/m/Y H:i:s") ?></p>
    </body>
</html>
