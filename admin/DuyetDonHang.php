<?php
include ('../admin/inc/header.php');
include ('../admin/inc/sidebar.php');
?>

<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <div class="market-updates">
            <h3 class="mb-4"><a href="index.php" style="color:black;">Thống kê</a> / Danh sách đơn hàng</h3>
        </div>
        <?php
        $page = isset($_GET['page']) ? $_GET['page'] : 'chuaduyet';
        $dh = new donHang();
        $donHangs = array();
        switch ($page) {
            case 'chuaduyet':
                $message = "Danh sách đơn hàng chưa duyệt";
                $donHangs = $dh->showDonChuaDuyet();
                $tenNut = "Duyệt đơn";
                $chedo = "DuyetDH.php";
                break;
            case 'daduyet':
                $message = "Danh sách đơn hàng đã duyệt";
                $donHangs = $dh->showDonDaDuyet();
                $tenNut = "In hóa đơn";
                $chedo = "#";
                break;
            case 'dagiao':
                $message = "Danh sách đơn hàng đã giao";
                $donHangs = $dh->showDonDaGiao();
                $tenNut = "In hóa đơn";
                $chedo = "#";
                break;
            default:
                $message = "Trang không tồn tại";
                break;
        }
        ?>
        <!-- Menu ngang -->
        <div class="container-fluid">
            <div style="background-color: rgba(255, 255, 255, 0.5);">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link" href="DuyetDonHang.php?page=chuaduyet">Chưa duyệt</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="DuyetDonHang.php?page=daduyet">Đã duyệt</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="DuyetDonHang.php?page=dagiao">Đã giao</a>
                    </li>
                </ul>
            </div>
            <div id="contentArea" style="background-color: rgba(255, 255, 255, 0.5);">
                <!-- Nội dung sẽ được thay đổi tại đây -->
                <h2 class="text-center mb-4"><?php echo $message; ?></h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Mã khách hàng</th>
                                <th>Ngày đặt hàng</th>
                                <th>Ngày nhận hàng</th>
                                <th>Quà tặng</th>
                                <th>Thanh toán</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($donHangs as $donDatHang) {
                                $ma = $donDatHang->getMaDDH();
                            ?>
                                <tr>
                                    <td><?php echo $ma; ?></td>
                                    <td><?php echo $donDatHang->getMaTV(); ?></td>
                                    <td><?php echo $donDatHang->getNgayDatHang(); ?></td>
                                    <td><?php echo $donDatHang->getNgayGiao(); ?></td>
                                    <td><?php echo $donDatHang->getQuaTang(); ?></td>
                                    <td><?php echo $donDatHang->getThanhTien(); ?></td>
                                    <td>
                                        <input type="button" class="btn btn-primary" onclick="window.location.href='<?php echo $chedo; ?>?id=<?php echo $ma; ?>'" value="<?php echo $tenNut; ?>" />

                                    </td>
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>

            <!-- footer -->
            <?php
            include '../admin/inc/footer.php';
            ?>
            <!--main content end-->
    </section>
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/jquery.nicescroll.js"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    <script src="js/jquery.scrollTo.js"></script>
    <!-- morris JavaScript -->
    <script>
        $(document).ready(function() {
            //BOX BUTTON SHOW AND CLOSE
            jQuery('.small-graph-box').hover(function() {
                jQuery(this).find('.box-button').fadeIn('fast');
            }, function() {
                jQuery(this).find('.box-button').fadeOut('fast');
            });
            jQuery('.small-graph-box .box-close').click(function() {
                jQuery(this).closest('.small-graph-box').fadeOut(200);
                return false;
            });

            //CHARTS
            function gd(year, day, month) {
                return new Date(year, month - 1, day).getTime();
            }

            graphArea2 = Morris.Area({
                element: 'hero-area',
                padding: 10,
                behaveLikeLine: true,
                gridEnabled: false,
                gridLineColor: '#dddddd',
                axes: true,
                resize: true,
                smooth: true,
                pointSize: 0,
                lineWidth: 0,
                fillOpacity: 0.85,
                data: [{
                        period: '2015 Q1',
                        iphone: 2668,
                        ipad: null,
                        itouch: 2649
                    },
                    {
                        period: '2015 Q2',
                        iphone: 15780,
                        ipad: 13799,
                        itouch: 12051
                    },
                    {
                        period: '2015 Q3',
                        iphone: 12920,
                        ipad: 10975,
                        itouch: 9910
                    },
                    {
                        period: '2015 Q4',
                        iphone: 8770,
                        ipad: 6600,
                        itouch: 6695
                    },
                    {
                        period: '2016 Q1',
                        iphone: 10820,
                        ipad: 10924,
                        itouch: 12300
                    },
                    {
                        period: '2016 Q2',
                        iphone: 9680,
                        ipad: 9010,
                        itouch: 7891
                    },
                    {
                        period: '2016 Q3',
                        iphone: 4830,
                        ipad: 3805,
                        itouch: 1598
                    },
                    {
                        period: '2016 Q4',
                        iphone: 15083,
                        ipad: 8977,
                        itouch: 5185
                    },
                    {
                        period: '2017 Q1',
                        iphone: 10697,
                        ipad: 4470,
                        itouch: 2038
                    },

                ],
                lineColors: ['#eb6f6f', '#926383', '#eb6f6f'],
                xkey: 'period',
                redraw: true,
                ykeys: ['iphone', 'ipad', 'itouch'],
                labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
                pointSize: 2,
                hideHover: 'auto',
                resize: true
            });


        });
    </script>
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
    <!-- //calendar -->
    </body>

    </html>