<style type="text/css">
  #font-18{color:#666666;}
</style>
<?php
echo $chartmonth;
echo $chartvisit;
echo $charttype;
?>

<?php
$this->breadcrumbs = array(
    'สมาชิก' => Yii::app()->createUrl('backend/user/userall'),
    $user['name'] . ' ' . $user['lname']
);
$config = new Configweb_model();
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-user"></i> ID <?php echo $user['pid'] ?>
    </div>
    <div class="row" id="font-rsu-16">
        <div class="col-md-3 col-lg-3" style="text-align: center;">

            <?php
            if (isset($rs['images'])) {
                $img_profile = "profile/" . $rs['images'];
            } else {
                if ($user['sex'] == 'ชาย') {
                    $img_profile = "images/Big-user-icon.png";
                } else if ($user['sex'] == 'หญิง') {
                    $img_profile = "images/Big-user-icon-female.png";
                } else {
                    $img_profile = "images/Big-user.png";
                }
            }
            ?>
            <br/>
            <img src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $img_profile; ?>"/><br/>
            <?php echo $user['alias']; ?><br/>
            เป็นสมาชิกเมื่อ <br/><?php echo $user['create_date']; ?>
        </div>
        <div class="col-md-9 col-lg-9">
            <div class="well" style=" margin: 5px;">
                ชื่อ - สกุล <p class="label" id="font-18"><?php echo $user['name'] . ' ' . $user['lname'] ?></p><br/>
                นามแฝง <p class="label" id="font-18"><?php
                    if (isset($user['alias'])) {
                        echo $user['alias'];
                    } else {
                        echo "-";
                    }
                    ?></p><br/>
                เพศ <p class="label" id="font-18"><?php
                    if (isset($user['sex'])) {
                        echo $user['sex'];
                    } else {
                        echo "-";
                    }
                    ?></p><br/>
                อายุ <p class="label" id="font-18"><?php
                    if (isset($user['birth'])) {
                        echo $config->get_age($user['birth']);
                    } else {
                        echo "-";
                    }
                    ?></p> ปี<br/>
                อีเมล์ <p class="label" id="font-18"><?php
                    if (isset($user['email'])) {
                        echo $user['email'];
                    } else {
                        echo "-";
                    }
                    ?></p><br/>

                เบอร์โทรศัพท์ <p class="label" id="font-18"><?php
                    if (isset($user['tel'])) {
                        echo $user['tel'];
                    } else {
                        echo "-";
                    }
                    ?></p><br/><br/>

                ที่อยู่ <br/>
                <ul style="padding-top: 5px;">
                    <?php
                    echo "<li>เลขที่ ";
                    if (isset($user['number'])) {
                        echo ($user['number']);
                    } else {
                        echo "-";
                    } "</li>";
                    echo "<li>อาคาร ";
                    if (isset($user['building'])) {
                        echo ($user['building']);
                    } else {
                        echo "-";
                    } "</li>";
                    echo "<li>ชั้น ";
                    if (isset($user['class'])) {
                        echo ($user['class']);
                    } else {
                        echo "-";
                    }
                    echo " ห้อง ";
                    if (isset($user['room'])) {
                        echo ($user['room']);
                    } else {
                        echo "-";
                    } "</li>";
                    echo "<li>ต. ";
                    if (isset($user['tambon_name'])) {
                        echo ($user['tambon_name']);
                    } else {
                        echo "-";
                    }
                    echo " &nbsp;&nbsp;อ. ";
                    if (isset($user['ampur_name'])) {
                        echo ($user['ampur_name']);
                    } else {
                        echo "-";
                    }
                    echo " &nbsp;&nbsp;จ. ";
                    if (isset($user['changwat_name'])) {
                        echo ($user['changwat_name']);
                    } else {
                        echo "-";
                    } "</li>";
                    echo "<li>รหัสไปรษณีย์ ";
                    if (isset($user['zipcode'])) {
                        echo ($user['zipcode']);
                    } else {
                        echo "-";
                    } "</li>";
                    ?>
                </ul>
            </div>
        </div>

    </div>

    <div class="panel panel-default" style=" margin: 5px;">
        <div class="panel-heading">
            <i class="fa fa-list-alt"></i> ประวัติการซื้อสินค้า
        </div>
        <?php if (!empty($order)) { ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th style="text-align: center;">ดูสินค้า</th>
                        <th>รหัสการสั่ง</th>
                        <th style="text-align: center;">วันที่</th>
                        <th style="text-align: center;">จำนวน</th>
                        <th style="text-align: right;">ราคารวม</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    $sumprice = 0;
                    foreach ($order as $orders):
                        $i++;
                        $sumprice = $sumprice + $orders['price_total'];
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td style=" text-align: center;">
                                <div class="btn btn-info btn-xs" onclick="Get_list_basket('<?php echo $orders['order_id'] ?>');"><i class="fa fa-eye"></i></div>
                            </td>
                            <td><?php echo $orders['order_id']; ?></td>
                            <td style="text-align: center;"><?php echo $config->thaidate($orders['order_date']); ?></td>
                            <td style="text-align: center;"><?php echo $orders['product_total']; ?></td>
                            <td style="text-align: right; background: #22282e; color: #ff0000;"><?php echo number_format($orders['price_total'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" style="text-align:center; background: #22282e;"><label>รวม</label></td>
                        <td style="text-align:right; background: #1c1e22; color: #ff0000;"><label><?php echo number_format($sumprice, 2); ?></label></td>
                    </tr>
                </tfoot>
            </table>
        <?php } else { ?>
            <center>ยังไม่มีการสั่งซื้อ</center>
        <?php } ?>
    </div>

    <div class="panel panel-default" style=" margin: 5px;">
        <div class="panel-heading"><i class="fa fa-bars"></i> การซื้อในแต่ละเดือนที่ผ่านมา</div>
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div id="chart-month"></div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div id="chart-month-visit"></div>
            </div>
        </div>
    </div>

    <div class="panel panel-default" style=" margin: 5px;">
        <div class="panel-heading"><i class="fa fa-bars"></i> การซื้อในแต่ละประเภท</div>
        <div id="chart-type"></div>
    </div>

</div>

<!-- Dialog Basket -->
<div class="modal fade" id="popup_basket">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-cart-arrow-down"></i> รายการสินค้า <font id="h_order"></font></h4>
            </div>

            <div id="basket"></div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">

    function Get_list_basket(order_id) {
        $("#h_order").text(order_id);
        var url = "<?php echo Yii::app()->createUrl('backend/orders/get_list_basket') ?>";
        var data = {order_id: order_id};
        $.post(url, data, function (result) {
            $("#basket").html(result);
            $("#popup_basket").modal();
        });
    }
</script>
