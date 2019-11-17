<?php
$title = "Contact";
$this->breadcrumbs = array(
    $title,
);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <img src="<?php echo Yii::app()->baseUrl; ?>/images/Contact-icon.png" width="24"/>
        <?php echo $title ?>
        <div class="pull-right">
            <a href="<?php echo Yii::app()->createUrl('backend/contact/create'); ?>"><i class="fa fa-pencil"></i> Edit</a>
        </div>
    </div>
    <div class="panel-body">
        <h3><img src="<?php echo Yii::app()->baseUrl; ?>/images/Phone-icon.png" width="24"/> Contact</h3>
        <?php if (!empty($contact)) { ?>
        <label style="margin-left:20px;">Address</label> <?php echo $contact['address'] ?><br/>
            <label style="margin-left:20px;">Email</label> <?php echo $contact['email'] ?><br/>
            <label style="margin-left:20px;">Tel</label> <?php echo $contact['tel'] ?>
        <?php } else { ?>
            <center>Empty</center>
        <?php } ?>
        <br/><br/>

        <h3><img src="<?php echo Yii::app()->baseUrl; ?>/images/Social-network-icon.png" width="24"/> Social</h3>
        <?php if (empty($social)) { ?>
            <center>Empty</center>
        <?php } ?>
        <table class="table">
            <?php foreach ($social as $datas): ?>
                <tr>
                    <td style="text-align:center;">
                        <img src="<?php echo Yii::app()->baseUrl; ?>/images/<?php echo $datas['icon'] ?>" width="24"/>
                    </td>
                    <td><?php echo $datas['social_app'] ?></td>
                    <td><?php echo $datas['account'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

    </div>
</div>
