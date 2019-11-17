<br/>
<?php
foreach ($masoption as $rs):
    $sql = "select * from optionproduct o where o.group_id = '" . $rs['id'] . "' ";
    $Option = Yii::app()->db->createCommand($sql)->queryAll();
    ?>
    <b><?php echo $rs['masoption'] ?></b>
    <ul>
        <?php foreach ($Option as $rss) : ?>
            <li><?php echo $rss['option'] ?> <?php echo ($rss['price'] > 0) ? "(+" . $rss['price'] . ")" : ""; ?></li>
        <?php endforeach; ?>
    </ul>
    <a href="javascript:popupaddoption('<?php echo $rs['id'] ?>')"><i class="fa fa-plus"></i> เพิ่มตัวเลือก</a>
    <hr/>
<?php endforeach; ?>