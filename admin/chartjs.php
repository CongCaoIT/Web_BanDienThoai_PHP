<?php
include('../admin/inc/header.php');
include('../admin/inc/sidebar.php');
?>

<!-- Bootstrap Core CSS -->
<!-- <link href="../admin/charts/css/bootstrap.css" rel='stylesheet' type='text/css' /> -->

<!-- Custom CSS -->
<link href="../admin/charts/css/style.css" rel='stylesheet' type='text/css' />

<!-- font-awesome icons CSS -->
<!-- <link href="../admin/charts/css/font-awesome.css" rel="stylesheet"> -->
<!-- //font-awesome icons CSS -->

<!-- side nav css file -->
<link href='../admin/charts/css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css' />
<!-- side nav css file -->

<!-- js-->
<script src="../admin/charts/js/jquery-1.11.1.min.js"></script>
<script src="../admin/charts/js/modernizr.custom.js"></script>

<!--webfonts-->
<link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
<!--//webfonts-->

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
        height: 295px;
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
            <h3 class="mb-2"><a href="SanPham.php?ma=1" style="color:black;">Sản phẩm</a> / Thêm sản phẩm</h3>
        </div>
        <!-- Menu ngang -->
        <div class="container-fluid bg-white p-4">
            <div id="contentArea">
                <div id="page-wrapper">
                    <h2 class="title1">Charts</h2>
                    <div class="charts">

                        <div class="col-md-12 charts-grids1 widget1 states-mdl1">
                            <div class="card-header">
                                <h3>Column & Line Graph</h3>
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
<!-- main content start-->

<script src="../admin/charts/js/index.js"></script>

<!-- new added graphs chart js-->
<!-- <script src="js/bootstrap.js"></script> -->
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="js/jquery.scrollTo.js"></script>
<!-- morris JavaScript -->
<!-- calendar -->
<script type="text/javascript" src="js/monthly.js"></script>
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

<!-- Bootstrap Core JavaScript -->
<script src="../admin/charts/js/bootstrap.js"> </script>

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