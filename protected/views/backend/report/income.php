<?php
/* @var $this BrandController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'dashboard',
);

?>
<?php 
	$yearNow = date("Y");
?>

<div class="row">
	<div class="col-md-6 col-lg-4">
		<label>ปี พ.ศ.</label>
		<select id="year" class="form-control" onchange="getPage(this.value)">
			<option value="">ทั้งหมด</option>
			<?php for($i = $yearNow; $i >= ($yearNow -3); $i--): ?>
				<option value="<?php echo $i ?>" <?php echo ($i==$year) ? "selected" : ""; ?>><?php echo $i + 543 ?></option>
			<?php endfor; ?>
		</select>
	</div>
</div>
<hr/>
<div class="row" style="margin-bottom:20px;">
	<div class="col-md-3 col-lg-3">
		<div class="well" style="text-align:center; background:#FFFFFF;">
			รายได้จากการขายหน้าเว็บ
			<hr/>
			<h4><?php echo number_format($income,2); ?></h4>
		</div>
	</div>


<div class="col-md-9 col-lg-9">
    <div id="chartincomeincategory" style="height:300px;"></div>
</div>
	
</div>


<div class="row">
	<div class="col-md-7 col-lg-7">
		<div id="chartcountproductinyear" style="height:560px;"></div>
	</div>
    <div class="col-md-5 col-lg-5">
        <table class="table table-bordered" id="reportincomr" style="background:#FFFFFF;">
            <thead>
                <tr>
                    <th>เดือน</th>
                    <th style="text-align:right; width:100px;">จำนวน</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $sum=0;
                for($i=0;$i <= 11;$i++): 
                    $sum = $sum + $chartcountproductinyear['total'][$i];
                    ?>
                <tr>
                    <td><?php echo $chartcountproductinyear['month'][$i]; ?></td>
                    <td style="text-align:right;"><?php echo number_format($chartcountproductinyear['total'][$i],2); ?></td>
                </tr>
            <?php endfor; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th style="text-align:center;">รวม</th>
                    <th style="text-align:right;"><?php echo number_format($sum,2)?></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>


<script type="text/javascript">
	function getPage(year){
		window.location="<?php echo Yii::app()->createUrl('backend/report/income') ?>" + "/year/" + year;
	}

$(document).ready(function(){
	Highcharts.chart('chartcountproductinyear', {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'รายได้'
            },

            subtitle: {
                text: 'แต่ละเดือน(ปี <?php echo ($year) ? ($year + 543) : ($yearNow + 543) ?>)'
            },

            credits: {
                enabled: false
            },

            yAxis: {
                title: {
                    text: 'จำนวน(ชิ้น)'
                }
            },
            xAxis: {
                categories: [<?php echo $chartcountproductinyear['cat']; ?>]
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },

            plotOptions: {
                series: {
                    label: {
                        connectorAllowed: false
                    },
                    //pointStart: 2010
                }
            },

            series: [{
                    colorByPoint: true,
                    name: ['จำนวน(ชิ้น)'],
                    data: [<?php echo $chartcountproductinyear['val']; ?>]
                }],

            responsive: {
                rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
            }

        });


Highcharts.chart('chartincomeincategory', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'ยอดขายสินค้าแต่ละหมวด'
    },
    credits: {
                enabled: false
            },
    subtitle: {
        text: '<?php echo ($year) ? "ปี ".($year + 543) : "ทั้งหมด" ?>'
    },
    xAxis: {
        categories: [<?php echo $chartincomecategoryinyear['cat'] ?>]
    },
    yAxis: {
        title: {
            text: 'ยอด(บาท)'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        color: 'red',
        name: 'หมวด',
        data: [<?php echo $chartincomecategoryinyear['val'] ?>]
    }]
});

        $("#reportincomr").dataTable({
            "searching": false,
            "paging": false,
            "ordering": false,
            "info":     false,
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                //'pdfHtml5'
            ]
        });
    });
</script>