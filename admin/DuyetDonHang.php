<?php

include('../admin/include_lib.php');
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
                                <th>Tên khách hàng</th>
                                <th>Ngày đặt hàng</th>
                                <th>Tình trạng</th>
                                <th>Ngày nhận hàng</th>
                                <th>Thanh toán</th>
                                <th>Quà tặng</th>
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
                                    <td><?php echo $donDatHang->ttdh->getHoTen(); ?></td>
                                    <td><?php echo $donDatHang->getNgayDatHang(); ?></td>
                                    <td><?php echo $donDatHang->getTinhTrang(); ?></td>
                                    <td>
                                        <?php
                                        if ($donDatHang->getNgayGiao() != null) {
                                            echo $donDatHang->getNgayGiao();
                                        } else {
                                            echo "Trống";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($donDatHang->getDaThanhToan() != null) {
                                            echo "Đã thanh toán";
                                        } else {
                                            echo "Chưa thanh toán";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($donDatHang->getQuaTang() != null) {
                                            echo $donDatHang->getQuaTang();
                                        } else {
                                            echo "Không";
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $donDatHang->getThanhTien(); ?></td>
                                    <td>
                                        <input type="button" class="btn btn-primary" onclick="window.location.href='<?php echo $chedo; ?>?ma=<?php echo $ma; ?>'" value="<?php echo $tenNut; ?>" />
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
</section>
<!-- //calendar -->
</body>

</html>