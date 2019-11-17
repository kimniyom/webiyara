<?php
/* @var $this LogproductController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'LogOrders',
);
?>

<h1>LogOrders</h1>

<table class="table" id="logorder">
    <thead>
        <tr>
            <th>#</th>
            <th>Log</th>
            <th>Author</th>
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
                <td><?php echo $rs['log'] ?></td>
                <td><?php echo $rs['name'].' '.$rs['lname'] ?></td>
                <td><?php echo $rs['date'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function(){
       $("#logorder").dataTable(); 
    });
</script>