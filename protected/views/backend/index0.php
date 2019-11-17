<script>
    $(document).ready(function () {
        $(".breadcrumb").hide();
    });
</script>

<?php $config = new Configweb_model(); ?>

<h4 style=" margin-top: 20px;"><i class="fa fa-dashboard"></i> DashBoard</h4>
<hr/>
<div class="row">
    <div class="col-md-4 col-lg-4">
        <div class="panel panel-success" style=" padding-left: 1px;">
            <div class="panel-body text-success" style=" text-align: center;">
                <h3><?php echo $countOederAll ?></h3>
                <h4>การสั่งซื้อทั้งหมด</h4>
            </div>
            
        </div>
    </div>

<div class="col-md-4 col-lg-4">
        <div class="panel panel-success" style=" padding-left: 1px;">
            <div class="panel-body text-success" style=" text-align: center;">
                <h3><?php echo $countOederSuccess ?></h3>
                <h4>การสั่งซื้อสำเร็จ</h4>
            </div>
            
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-4 col-lg-4">
        <div class="panel panel-success" style=" padding-left: 1px;">
            <div class="panel-body text-success" style=" text-align: center;">
                <h3><?php echo $viewMaxcategory['total'] ?></h3>
                <h4><?php echo $viewMaxcategory['categoryname'] ?></h4>
            </div>
            <div class="panel-footer" style=" text-align: center;">
                หมวดที่มีการดูมากสุด
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg-4">
        <div class="panel panel-warning" style=" padding-left: 1px;">
            <div class="panel-body text-warning" style=" text-align: center;">
                <h3><?php echo $viewMaxproduct['total'] ?></h3>
                <h4><?php echo $viewMaxproduct['productname'] ?></h4>
            </div>
            <div class="panel-footer" style=" text-align: center;">
                สินค้าที่มีการดูมากสุด
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg-4">
        <div class="panel panel-danger" style=" padding-left: 1px;">
            <div class="panel-body text-danger" style=" text-align: center;">
                <h3><?php echo $viewMaxbrand['total'] ?></h3>
                <h4><?php echo $viewMaxbrand['brandname'] ?></h4>
            </div>
            <div class="panel-footer" style=" text-align: center;">
                Brand ที่มีการดูมากสุด
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-lg-6">
        <div id="viewcategory"></div>
    </div>
    <div class="col-md-6 col-lg-6">
        <div id="viewbrand"></div>
    </div>
</div>
<div class="row" style=" margin-top: 30px;">
    <div class="col-md-12 col-lg-12">
        <div id="containers"></div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        Highcharts.chart('containers', {

            title: {
                text: 'จำนวนการเข้าดูสินค้าในแต่ละเดือน'
            },

            subtitle: {
                text: 'เข้าดูสินค้ามากสุดในเดือน'
            },

            credits: {
                enabled: false
            },

            yAxis: {
                title: {
                    text: 'จำนวนการเข้าดู'
                }
            },
            xAxis: {
                categories: [<?php echo $category ?>]
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
                    color: 'red',
                    name: ['จำนวน'],
                    data: [<?php echo $val ?>]
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

        Highcharts.chart('viewcategory', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: 0,
                plotShadow: false
            },
            credits: {
                enabled: false
            },
            title: {
                text: 'การดู<br>สินค้า<br/>แต่ละหมวด',
                align: 'center',
                verticalAlign: 'middle',
                y: 40
            },
            tooltip: {
                //pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                pointFormat: '{series.name}: <b>{point.y} ครั้ง</b>'
            },
            plotOptions: {
                pie: {
                    dataLabels: {
                        enabled: true,
                        distance: -50,
                        style: {
                            fontWeight: 'bold',
                            color: 'white'
                        }
                    },
                    startAngle: -90,
                    endAngle: 90,
                    center: ['50%', '75%'],
                    size: '110%'
                }
            },
            series: [{
                    type: 'pie',
                    name: 'จำนวนการดู',
                    innerSize: '50%',
                    data: [<?php echo $viewcategory ?>]
                }]
        });


        Highcharts.chart('viewbrand', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'จำนวนการเข้าดูสินค้า'
            },

            subtitle: {
                text: 'แต่ละ brand'
            },

            credits: {
                enabled: false
            },

            yAxis: {
                title: {
                    text: 'จำนวนการเข้าดู'
                }
            },
            xAxis: {
                categories: [<?php echo $brandcat ?>]
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
                    name: ['จำนวน'],
                    data: [<?php echo $brandval ?>]
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
    });

</script>