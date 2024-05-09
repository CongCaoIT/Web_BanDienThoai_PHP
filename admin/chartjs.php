<?php
include('../admin/inc/header.php');
include('../admin/inc/sidebar.php');

$tk = new ThongKeAdmin();
$dsTK = $tk->layDSThongKe();

// Tạo một mảng chứa dữ liệu từ $dsTK
$dataProvider = array();
foreach ($dsTK as $thongKe) {
    $data = array(
        'date' => $thongKe->getNgay(), // Ngày
        'sales1' => $thongKe->getTienLoi(), // Tiền lời
        'sales2' => $thongKe->getTongDoanhThu(), // Tổng doanh thu
        'market1' => $thongKe->getTongSoDonDatHang(),
        'market2' => $thongKe->getTongSoDonDaThanhToan()
        // Thêm các trường khác nếu cần
    );
    array_push($dataProvider, $data);
}

// Chuyển mảng thành chuỗi JSON
$jsonDataProvider = json_encode($dataProvider);
?>
<!-- Custom CSS -->
<link href="../admin/charts/css/style.css" rel='stylesheet' type='text/css' />

<!-- side nav css file --><link href='../admin/charts/css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css' />
<!-- side nav css file -->

<!-- js-->
<script src="../admin/charts/js/jquery-1.11.1.min.js"></script>
<script src="../admin/charts/js/modernizr.custom.js"></script>

<!-- Metis Menu -->
<script src="../admin/charts/js/metisMenu.min.js"></script>
<script src="../admin/charts/js/custom.js"></script>
<link href="../admin/charts/css/custom.css" rel="stylesheet">
<!--//Metis Menu -->

<style>
    #chartdiv {
        width: 100%;
        height: 375px;
    }

    #chartdiv1 {
        width: 100%;
        height: 500px;
    }

    .jqcandlestick-container {
        width: 100%;
        height: 300px;
    }
</style>
</head>

<section id="main-content">
    <section class="wrapper">
        <div class="market-updates">
            <h3 class="mb-2"><a href="SanPham.php?ma=1" style="color:black;">Thống kê</a> / Doanh thu/h3>
        </div>
        <!-- Menu ngang -->
        <div class="container-fluid bg-white p-4">
            <div id="contentArea">
                <div id="page-wrapper pt-2">
                    <h2 class="title1">Thống kê</h2>
                    <div class="charts">

                        <div class="col-md-12 charts-grids1 widget1 states-mdl1">
                            <div class="card-header">
                                <h3>Điểu đồ cột và đường</h3>
                            </div>
                            <div id="chartdiv1"></div>
                        </div>

                        <div class="clearfix"> </div>
                    </div>

                    <!-- for amcharts js -->
                    <script src="../admin/charts/js/amcharts.js"></script>
                    <script src="../admin/charts/js/serial.js"></script>
                    <script src="../admin/charts/js/export.min.js"></script>
                    <link rel="stylesheet" href="../admin/charts/css/export.css" type="text/css" media="all" />
                    <script src="../admin/charts/js/light.js"></script>
                    <!-- for amcharts js -->

                    <script src="../admin/charts/js/index2.js"></script>

                    <!-- for amcharts js -->
                    <!-- for amcharts js -->
                    <script src="../admin/charts/js/amcharts.js"></script>
                    <script src="../admin/charts/js/serial.js"></script>
                    <script src="../admin/charts/js/export.min.js"></script>
                    <link rel="stylesheet" href="../admin/charts/css/export.css" type="text/css" media="all" />
                    <script src="../admin/charts/js/light.js"></script>
                    <!-- for amcharts js -->
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </section>
</section>

<!-- <script src="../admin/js/bootstrap.js"></script> -->
<script src="../admin/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="../admin/js/scripts.js"></script>
<script src="../admin/js/jquery.slimscroll.js"></script>
<script src="../admin/js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="../admin/js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="../admin/js/jquery.scrollTo.js"></script>
<!-- morris JavaScript -->
<!-- calendar -->
<script type="text/javascript" src="../admin/js/monthly.js"></script>
<script type="text/javascript">
    $(window).load(function() {

        $('#mycalendar').monthly({
            mode: 'event',

        });

        $('#mycalendar2').monthly({
            mode: 'picker',
            target: '#mytarget',
            setWidth: '250px',
            startHidden: true,
            showTrigger: '#mytarget',
            stylePast: true,
            disablePast: true
        });

        switch (window.location.protocol) {
            case 'http:':
            case 'https:':
                // running on a server, should be good.
                break;
            case 'file:':
                alert('Just a heads-up, events will not work when run locally.');
        }

    });
</script>

<script src="../admin/charts/js/Chart.bundle.js"></script>
<script src="../admin/charts/js/utils.js"></script>

<script>
    var MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var color = Chart.helpers.color;
    var barChartData = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [{
            label: 'Dataset 1',
            backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
            borderColor: window.chartColors.red,
            borderWidth: 1,
            data: [
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor()
            ]
        }, {
            label: 'Dataset 2',
            backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
            borderColor: window.chartColors.blue,
            borderWidth: 1,
            data: [
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor()
            ]
        }]

    };

    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Chart.js Bar Chart'
                }
            }
        });

    };

    document.getElementById('randomizeData').addEventListener('click', function() {
        var zero = Math.random() < 0.2 ? true : false;
        barChartData.datasets.forEach(function(dataset) {
            dataset.data = dataset.data.map(function() {
                return zero ? 0.0 : randomScalingFactor();
            });

        });
        window.myBar.update();
    });

    var colorNames = Object.keys(window.chartColors);
    document.getElementById('addDataset').addEventListener('click', function() {
        var colorName = colorNames[barChartData.datasets.length % colorNames.length];;
        var dsColor = window.chartColors[colorName];
        var newDataset = {
            label: 'Dataset ' + barChartData.datasets.length,
            backgroundColor: color(dsColor).alpha(0.5).rgbString(),
            borderColor: dsColor,
            borderWidth: 1,
            data: []
        };

        for (var index = 0; index < barChartData.labels.length; ++index) {
            newDataset.data.push(randomScalingFactor());
        }

        barChartData.datasets.push(newDataset);
        window.myBar.update();
    });

    document.getElementById('addData').addEventListener('click', function() {
        if (barChartData.datasets.length > 0) {
            var month = MONTHS[barChartData.labels.length % MONTHS.length];
            barChartData.labels.push(month);

            for (var index = 0; index < barChartData.datasets.length; ++index) {
                //window.myBar.addData(randomScalingFactor(), index);
                barChartData.datasets[index].data.push(randomScalingFactor());
            }

            window.myBar.update();
        }
    });

    document.getElementById('removeDataset').addEventListener('click', function() {
        barChartData.datasets.splice(0, 1);
        window.myBar.update();
    });

    document.getElementById('removeData').addEventListener('click', function() {
        barChartData.labels.splice(-1, 1); // remove the label first

        barChartData.datasets.forEach(function(dataset, datasetIndex) {
            dataset.data.pop();
        });

        window.myBar.update();
    });
</script>
<!-- new added graphs chart js-->

<!-- Classie --><!-- for toggle left push menu script -->
<script src="../admin/charts/js/classie.js"></script>
<script>
    var menuLeft = document.getElementById('cbp-spmenu-s1'),
        showLeftPush = document.getElementById('showLeftPush'),
        body = document.body;

    showLeftPush.onclick = function() {
        classie.toggle(this, 'active');
        classie.toggle(body, 'cbp-spmenu-push-toright');
        classie.toggle(menuLeft, 'cbp-spmenu-open');
        disableOther('showLeftPush');
    };

    function disableOther(button) {
        if (button !== 'showLeftPush') {
            classie.toggle(showLeftPush, 'disabled');
        }
    }
</script>
<!-- //Classie --><!-- //for toggle left push menu script -->

<!--scrolling js-->
<script src="../admin/charts/js/jquery.nicescroll.js"></script>
<script src="../admin/charts/js/scripts.js"></script>
<!--//scrolling js-->


<!-- candlestick --><!-- for points and multiple y-axis charts js -->
<script type="text/javascript" src="../admin/charts/js/jquery.jqcandlestick.min.js"></script>
<link rel="stylesheet" type="text/css" href="../admin/charts/css/jqcandlestick.css" />
<!-- //candlestick --><!-- //for points and multiple y-axis charts js -->

<!-- side nav js -->
<script src='../admin/charts/js/SidebarNav.min.js' type='text/javascript'></script>
<script>
    $('.sidebar-menu').SidebarNav()
</script>
<!-- //side nav js -->

<script>
    var chart = AmCharts.makeChart("chartdiv1", {
        type: "serial",
        theme: "light",
        dataDateFormat: "YYYY-MM-DD",
        precision: 2,
        valueAxes: [{
                id: "v1",
                title: "Tiền",
                position: "left",
                autoGridCount: false,
                labelFunction: function(value) {
                    return value.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + " VND";
                },
            },
            {
                id: "v2",
                title: "Số đơn",
                gridAlpha: 0,
                position: "right",
                autoGridCount: false,
            },
        ],
        graphs: [{
                id: "g3",
                valueAxis: "v1",
                lineColor: "#e1ede9",
                fillColors: "#e1ede9",
                fillAlphas: 1,
                type: "column",
                title: "Tổng",
                valueField: "sales2",
                clustered: false,
                columnWidth: 0.5,
                legendValueText: "[[value]] VND",
                balloonText: "[[title]]<br /><b style='font-size: 130%'>[[value]] VND</b>",
            },
            {
                id: "g4",
                valueAxis: "v1",
                lineColor: "#62cf73",
                fillColors: "#62cf73",
                fillAlphas: 1,
                type: "column",
                title: "Tiền lời",
                valueField: "sales1",
                clustered: false,
                columnWidth: 0.3,
                legendValueText: "[[value]] VND",
                balloonText: "[[title]]<br /><b style='font-size: 130%'>[[value]] VND</b>",
            },
            {
                id: "g1",
                valueAxis: "v2",
                bullet: "round",
                bulletBorderAlpha: 1,
                bulletColor: "#FFFFFF",
                bulletSize: 5,
                hideBulletsCount: 50,
                lineThickness: 2,
                lineColor: "#20acd4",
                type: "smoothedLine",
                title: "Đơn đã đặt hàng",
                useLineColorForBulletBorder: true,
                valueField: "market1",
                balloonText: "[[title]]<br /><b style='font-size: 130%'>[[value]]</b>",
            },
            {
                id: "g2",
                valueAxis: "v2",
                bullet: "round",
                bulletBorderAlpha: 1,
                bulletColor: "#FFFFFF",
                bulletSize: 5,
                hideBulletsCount: 50,
                lineThickness: 2,
                lineColor: "#e1ede9",
                type: "smoothedLine",
                dashLength: 5,
                title: "Đơn đã thanh toán",
                useLineColorForBulletBorder: true,
                valueField: "market2",
                balloonText: "[[title]]<br /><b style='font-size: 130%'>[[value]]</b>",
            },
        ],
        chartScrollbar: {
            graph: "g1",
            oppositeAxis: false,
            offset: 30,
            scrollbarHeight: 50,
            backgroundAlpha: 0,
            selectedBackgroundAlpha: 0.1,
            selectedBackgroundColor: "#888888",
            graphFillAlpha: 0,
            graphLineAlpha: 0.5,
            selectedGraphFillAlpha: 0,
            selectedGraphLineAlpha: 1,
            autoGridCount: true,
            color: "#AAAAAA",
        },
        chartCursor: {
            pan: true,
            valueLineEnabled: true,
            valueLineBalloonEnabled: true,
            cursorAlpha: 0,
            valueLineAlpha: 0.2,
        },
        categoryField: "date",
        categoryAxis: {
            parseDates: true,
            dashLength: 1,
            minorGridEnabled: true,
        },
        legend: {
            useGraphSettings: true,
            position: "top",
        },
        balloon: {
            borderThickness: 1,
            shadowAlpha: 0,
        },
        export: {
            enabled: true,
        },
        dataProvider: <?php echo $jsonDataProvider; ?>
    });
</script>