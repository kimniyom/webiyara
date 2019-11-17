<?php
/* @var $this LogproductController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Logproducts',
);
?>

<h1>Logproducts</h1>

<table class="table" id="logproduct">
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
                <td><?php echo $rs['user'] ?></td>
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