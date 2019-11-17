<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle = 'ยังไม่อ่าน';
$this->breadcrumbs = array(
    $this->pageTitle
);
?>

<br/>
<h1 class="font-supermarket"><?php echo $this->pageTitle ?></h1>
<br/>
<table class="table">
    <thead>
        <tr>
            <th style=" width: 20px;">#</th>
            <th style="width: 50px;"></th>
            <th style=" width: 200px;">Date</th>
            <th>Subject</th>
            <th style=" width: 300px;">Name</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 0;
        foreach ($contact as $rs): $i++; ?>
            <tr>
                <td><?php echo $i ?></td>
                <td>
    <?php echo ($rs['readsmsg'] == 0) ? "<i class='fa fa-folder'></i>" : "<i class='fa fa-folder-open'></i>"; ?>
                </td>
                <td><?php echo $rs['createdate'] ?></td>
                <td><a href="<?php echo Yii::app()->createUrl('backend/contactuser/view', array('id' => $rs['id']))?>"><b><?php echo $rs['subject'] ?></b></a></td>
                <td><?php echo $rs['name'] ?></td>
                <td style=" text-align: center; width: 20px;">
                    <a href="javascript:deletecontact('<?php echo $rs['id'] ?>') "><i class="fa fa-trash text-danger"></i></a>
                </td>
            </tr>
<?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript">
    function deletecontact(id) {
        var r = confirm("Are you sure...?");
        if (r == true) {
            var url = "<?php echo Yii::app()->createUrl('backend/contactuser/delete') ?>";
            var data = {id: id};
            $.post(url, data, function (datas) {
                window.location.reload();
            });
        }
    }
</script>
