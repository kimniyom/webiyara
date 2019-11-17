
<style type="text/css">
    #table-listorder table tr th{
        background: #000000;
        color:#FFFFFF;
    }
</style>

<br/>
<a href="<?php echo Yii::app()->createUrl('backend/orders/excelorderall',array("status" => $status,"datestart" => $datestart,"dateend" => $dateend)) ?>" target="_blank">
<button type="button" class="btn btn-success">
    <img src="<?php echo Yii::app()->baseUrl ?>/images/Excel-icon.png"/> excel
</button></a>
<br/>

<div id="table-listorder">
    <br/>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>ผู้สั่งซื้อ</th>
                <th>โทรศัพท์</th>
                <th>วันที่สั่งซื้อ</th>
                <th style="text-align:center;">จำนวน</th>
                <th style="text-align:right;">รวม</th>
                <th style="text-align:center;">สถานะ</th>
                <th></th>
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
                        <td><?php echo $i ?></td>
                        <td><?php echo $rs['order_fullname'] ?></td>
                        <td><?php echo $rs['order_phone'] ?></td>
                        <td><?php echo $rs['order_date'] ?></td>
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
                        <td>
                            <a href="<?php echo Yii::app()->createUrl('backend/orders/view', array("id" => $rs['id'])) ?>">ดูข้อมูล</a>
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
            <tr>
                <th colspan="4" style="text-align:center;">รวม</th>
                <th style="text-align:center;"><?php echo number_format($sum[0]) ?></th>
                <th style="text-align:right;"><?php echo number_format($sum[1], 2) ?></th>
                <th colspan="2"></th>
            </tr>
        </tfoot>
    </table>
</div>
