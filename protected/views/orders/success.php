<?php

$this->breadcrumbs = array(
    'Success',
);
?>

<div class="container">
    <div class="alert alert-success" style=" text-align: center; margin-top: 30px;">
        <i class="fa fa-check fa-3x"></i><br/>
        สั่งซื้อสินค้าเรียบร้อยแล้ว
    </div>
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
    <div class="jumbotron">
        <h3>แจ้งการโอนเงิน</h3>
        <hr/>
        <?php echo $popup['detail'] ?>
    </div>
</div>


