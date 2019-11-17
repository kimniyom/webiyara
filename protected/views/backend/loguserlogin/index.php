<?php
/* @var $this LoguserloginController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Loguserlogins',
);

?>

<h1>Loguserlogins</h1>

<table class="table" id="logproduct">
    <thead>
        <tr>
            <th>#</th>
            <th>Log</th>
            <th>Ip</th>
            <th>Author</th>
            <th>Status</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($log as $rs): $i++;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td>
                    <?php echo ($rs['status'] == "TRUE") ? "<i class='fa fa-check text-success'></i>" : "<i class='fa fa-remove text-danger'></i>";  ?>
                    <?php echo $rs['log'] ?>
                </td>
                <td><?php echo $rs['ip'] ?></td>
                <td><?php echo $rs['user'] ?></td>
                <td><?php echo $rs['status'] ?></td>
                <td><?php echo $rs['dupdate'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function(){
       $("#logproduct").dataTable(); 
    });
</script>