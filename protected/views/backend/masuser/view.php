<?php
/* @var $this MasuserController */
/* @var $model Masuser */

$this->breadcrumbs = array(
    'Masusers' => array('index'),
    $model->name,
);
?>



<div class="row" style=" margin-top: 20px;">
    <div class="col-md-4 col-lg-4" style=" text-align: center;">
        <img src="<?php echo Yii::app()->baseUrl ?>/images/User-null.png"/>
        <h4>#<?php echo $model->name; ?></h4>
        <hr/>
        <div class="well">
            <?php
            $sql = "select * from privilege where user = '" . $model->id . "'";
            $rs = Yii::app()->db->createCommand($sql)->queryRow();
            $this->widget('booster.widgets.TbDetailView', array(
                'data' => $model,
                'attributes' => array(
                    //'id',
                    //'oid',
                    //'pid',
                    'name',
                    'lname',
                    'alias',
                    //'password',
                    'email',
                    'username',
                //'tel',
                //'sex',
                //'birth',
                //'status',
                //'d_update',
                //'create_date',
                //'images',
                ),
            ));
            ?>
        </div>
    </div>
    <div class="col-md-8 col-lg-8">
        <h4><i class="fa fa-key"></i> สิทธิ์การใช้งาน</h4>
        <hr/>
        <ul class="list-group">
            <?php if ($rs['shop'] == 1) { ?>
                <li class="list-group-item"><input type="checkbox" checked="checked" onclick="setPrivilege('shop', 'del')"/> ข้อมูลร้านค้า</li>
            <?php } else { ?>
                <li class="list-group-item"><input type="checkbox" onclick="setPrivilege('shop', 'add')"/> ข้อมูลร้านค้า</li>
            <?php } ?>

            <?php if ($rs['setting'] == 1) { ?>
                <li class="list-group-item"><input type="checkbox" checked="checked" onclick="setPrivilege('setting', 'del')"/> ตั้งค่าระบบ</li>
            <?php } else { ?>
                <li class="list-group-item"><input type="checkbox" onclick="setPrivilege('setting', 'add')"/> ตั้งค่าระบบ</li>
            <?php } ?>

            <?php if ($rs['product'] == 1) { ?>
                <li class="list-group-item"><input type="checkbox" checked="checked" onclick="setPrivilege('product', 'del')"/> สินค้า</li>
            <?php } else { ?>
                <li class="list-group-item"><input type="checkbox" onclick="setPrivilege('product', 'add')"/> สินค้า</li>
            <?php } ?>

            <?php if ($rs['article'] == 1) { ?>
                <li class="list-group-item"><input type="checkbox" checked="checked" onclick="setPrivilege('article', 'del')"/> บทความ / event</li>
            <?php } else { ?>
                <li class="list-group-item"><input type="checkbox" onclick="setPrivilege('article', 'add')"/> บทความ / event</li>
            <?php } ?>

            <?php if ($rs['contact'] == 1) { ?>
                <li class="list-group-item"><input type="checkbox" checked="checked" onclick="setPrivilege('contact', 'del')"/> ติดต่อจากลูกค้า</li>
            <?php } else { ?>
                <li class="list-group-item"><input type="checkbox" onclick="setPrivilege('contact', 'add')"/> ติดต่อจากลูกค้า</li>
            <?php } ?>
            <?php if ($rs['log'] == 1) { ?>
                <li class="list-group-item"><input type="checkbox" checked="checked" onclick="setPrivilege('log', 'del')"/> log</li>
            <?php } else { ?>
                <li class="list-group-item"><input type="checkbox" onclick="setPrivilege('log', 'add')"/> log</li>
                <?php } ?>
        </ul>
    </div>
</div>






<script type="text/javascript">
    function setPrivilege(menu, e) {
        var user = "<?php echo $model->id ?>";
        var data = {user: user, menu: menu, event: e};
        var url = "<?php echo Yii::app()->createUrl('backend/masuser/privilege') ?>";
        $.post(url, data, function (datas) {
            window.location.reload();
        });
    }
</script>