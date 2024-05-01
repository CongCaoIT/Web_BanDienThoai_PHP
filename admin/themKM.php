<?php
include '../admin/inc/header.php';
include '../admin/inc/sidebar.php';
include '../controller/Admin/SanPhamController.php';

$sp = new SanPhamAdmin();
if (isset($_POST['btn_Luu'])) {
    $masp = $_GET['ma'];
    $makm = isset($_POST['MaKhuyenMai']) ? (int)$_POST['MaKhuyenMai'] : 0;

    $updateKM = $sp->themKhuyenMai($makm, $masp);

    if ($updateKM) {
        echo "<script>window.location.href = 'SanPham.php?ma=1';</script>";
        exit(); // Đảm bảo không có output nào được gửi trước khi chuyển trang
    }
}
?>

<section id="main-content">
    <section class="wrapper">
        <div class="market-updates">
            <h3 class="mb-2"><a href="SanPham.php?ma=1" style="color:black;">Sản phẩm</a> / Thêm chương trình khuyến mãi</h3>
        </div>
        <!-- Menu ngang -->
        <div class="container-fluid bg-white p-4">
            <div id="contentArea">
                <!-- Nội dung sẽ được thay đổi tại đây -->
                <?php
                if (isset($_GET['ma'])) {
                    $masp = $_GET['ma'];

                    $dsSanPham = $sp->layTenSPtheoMaSP($masp);
                    foreach ($dsSanPham as $tenSP) {
                ?>
                        <h2 class="text-center mb-2"><?php echo $tenSP->getTenSP() ?></h2>
                        <form method="POST">
                            <label for="PhanTramGiamGia">Chương trình khuyến mãi</label>
                            <select class="form-control" name="MaKhuyenMai" id="selectKhuyenMai">
                                <?php
                                include '../controller/donHang.php';
                                $dh = new donHang();
                                $dsKhuyenMai = $dh->showTTKhuyenMai();
                                foreach ($dsKhuyenMai as $km) {
                                ?>
                                    <option value="<?php echo $km->getMaKhuyenMai() ?>" data-phantramgiamgia="<?php echo $km->getPhanTramGiamGia() ?>"><?php echo $km->getTenKhuyenMai() ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <div class="form-group">
                                <label for="PhanTramGiamGia">Giảm giá</label>
                                <select class="form-control" name="PhanTramGiamGia" id="selectPhanTram" disabled>
                                    <?php
                                    foreach ($dsKhuyenMai as $km) {
                                    ?>
                                        <option value="<?php echo $km->getPhanTramGiamGia() ?>"><?php echo $km->getPhanTramGiamGia() ?>%</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group" style="margin-top: 12px;">
                                <a href="SanPham?ma=<?php echo $masp ?>" class="btn btn-danger">Trở lại</a>
                                <button type="submit" class="btn btn-primary" name="btn_Luu">Lưu</button>
                            </div>
                        </form>
                <?php
                    }
                }
                ?>
                <!-- footer -->
                <?php
                include '../admin/inc/footer.php';
                ?>
                <!--main content end-->
            </div>
        </div>
    </section>

    <script src="js/bootstrap.js"></script>
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
</section>