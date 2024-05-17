<?php
include('../admin/inc/header.php');
include('../admin/inc/sidebar.php');
$sp = new SanPhamAdmin();
if (isset($_POST['btn_Luu'])) {
    $masp = $_GET['ma'];
    $makm = isset($_POST['MaKhuyenMai']) ? (int)$_POST['MaKhuyenMai'] : 0;

    $updateKM = $sp->themKhuyenMai($makm, $masp);

    if ($updateKM) {
        echo "<script>alert('Thêm chương trình khuyến mãi thành công!');</script>";
        echo "<script>window.location.href = 'SanPham.php?ma=1';</script>";
        exit();
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
                        <div class="row">
                            <div class="col-md-8 mx-auto">
                                <form method="POST">
                                    <label for="PhanTramGiamGia">Chương trình khuyến mãi</label>
                                    <select class="form-control" name="MaKhuyenMai" id="selectKhuyenMai">
                                        <?php
                                        $dh = new donHang();
                                        $dsKhuyenMai = $dh->showTTKhuyenMai();
                                        foreach ($dsKhuyenMai as $km) {
                                        ?>
                                            <option value="<?php echo $km->getMaKhuyenMai() ?>" data-phantramgiamgia="<?php echo $km->getPhanTramGiamGia() ?>" data-ngaybatdau="<?php echo $km->getNgayBatDau() ?>" data-ngayketthuc="<?php echo $km->getNgayKetThuc() ?>"><?php echo $km->getTenKhuyenMai() ?></option>
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

                                    <div class="form-group">
                                        <label for="">Ngày bắt đầu</label>
                                        <select class="form-control" name="" id="selectNgayBatDau" disabled>
                                            <?php
                                            foreach ($dsKhuyenMai as $km) {
                                            ?>
                                                <option value="<?php echo $km->getNgayBatDau() ?>"><?php echo $km->getNgayBatDau() ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Ngày kết thúc</label>
                                        <select class="form-control" name="PhanTramGiamGia" id="selectNgayKetThuc" disabled>
                                            <?php
                                            foreach ($dsKhuyenMai as $km) {
                                            ?>
                                                <option value="<?php echo $km->getNgayKetThuc() ?>"><?php echo $km->getNgayKetThuc() ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group" style="margin-top: 12px;">
                                        <a href="SanPham.php?ma=<?php echo $masp ?>" class="btn btn-danger">Trở lại</a>
                                        <button type="submit" class="btn btn-primary" name="btn_Luu">Lưu</button>
                                    </div>
                                </form>
                            </div>
                        </div>
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

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            // Lắng nghe sự kiện khi chọn chương trình khuyến mãi thay đổi
            document.getElementById('selectKhuyenMai').addEventListener('change', function() {
                // Lấy giá trị phần trăm giảm giá từ thuộc tính data-phantramgiamgia của tùy chọn đã chọn
                var selectedOption = this.options[this.selectedIndex];
                var phanTramGiamGia = selectedOption.getAttribute('data-phantramgiamgia');
                // Lấy giá trị ngày bắt đầu và kết thúc từ thuộc tính data-ngaybatdau và data-ngayketthuc của tùy chọn đã chọn
                var ngayBatDau = selectedOption.getAttribute('data-ngaybatdau');
                var ngayKetThuc = selectedOption.getAttribute('data-ngayketthuc');

                // Cập nhật giá trị phần trăm giảm giá trong phần tử selectPhanTram
                var selectPhanTram = document.getElementById('selectPhanTram');
                selectPhanTram.value = phanTramGiamGia;

                // Cập nhật giá trị ngày bắt đầu và kết thúc trong các trường nhập ngày tương ứng
                var selectNgayBatDau = document.getElementById('selectNgayBatDau');
                selectNgayBatDau.value = ngayBatDau;
                var selectNgayKetThuc = document.getElementById('selectNgayKetThuc');
                selectNgayKetThuc.value = ngayKetThuc;
            });
        });
    </script>


</section>