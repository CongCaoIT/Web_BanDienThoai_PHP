<?php

include('../admin/include_lib.php');
$km = new donHang();
if (isset($_POST['btn_luuCTKM'])) {
    $tenCT = $_POST['tenChuongTrinh'];
    $mt = $_POST['moTa'];
    $giam = $_POST['phanTramGiamGia'];
    $ngayBD = $_POST['ngayBatDau'];
    $ngayKT = $_POST['ngayKetThuc'];

    $insertCTKM = $km->insertCTKM($tenCT, $mt, $giam, $ngayBD, $ngayKT);

    if ($insertCTKM) {
        echo "<script>alert('Thêm chương trình khuyến mãi thành công!');</script>";
        echo "<script>window.location.href = 'KhuyenMai.php?';</script>";
        exit();
    }
}
?>
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <div class="market-updates">
            <h3 class="mb-4"><a href="KhuyenMai.php" style="color:black;">Khuyến mãi</a> / Thêm khuyến mãi</h3>
        </div>
        <!-- Menu ngang -->
        <div class="container-fluid bg-white p-4">
            <div id="contentArea">
                <!-- Nội dung sẽ được thay đổi tại đây -->
                <h2 class="text-center mb-4">Chương trình khuyến mãi</h2>
                <?php
                if (isset($insertCTKM)) {
                    echo $insertCTKM;
                }
                ?>

                <div class="table-responsive">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <form action="ThemCTKhuyenMai.php" method='post'>
                                <div class="form-group">
                                    <label for="tenChuongTrinh">Tên chương trình:</label>
                                    <input type="text" class="form-control" id="tenChuongTrinh" name="tenChuongTrinh" required>
                                </div>
                                <div class="form-group">
                                    <label for="moTa">Mô tả:</label>
                                    <input type="text" class="form-control" id="moTa" name="moTa" required>
                                </div>
                                <div class="form-group">
                                    <label for="phanTramGiamGia">Phần trăm giảm giá:</label>
                                    <input type="number" class="form-control" id="phanTramGiamGia" name="phanTramGiamGia" required>
                                </div>
                                <div class="form-group">
                                    <label for="ngayBatDau">Ngày bắt đầu:</label>
                                    <input type="date" class="form-control" id="ngayBatDau" name="ngayBatDau" required>
                                </div>
                                <div class="form-group">
                                    <label for="ngayKetThuc">Ngày kết thúc:</label>
                                    <input type="date" class="form-control" id="ngayKetThuc" name="ngayKetThuc" required>
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-danger">
                                        <a href="KhuyenMai.php" style="color: white;">TRỞ LẠI</a>
                                    </button>
                                    <button type="submit" class="btn btn-primary" name="btn_luuCTKM">LƯU</button>
                                </div>
                            </form>
                        </div>
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