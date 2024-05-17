<?php
include('../admin/inc/header.php');
include('../admin/inc/sidebar.php');
$sp = new SanPhamAdmin();
$pn = new phieuNhapController();
$mau = new MauAdmin();

if (isset($_POST['btn_nhapHang'])) {
    $mancc = $_POST['MaNCC'];
    $ngayNhap = $_POST['ngayNhapHang'];

    $mapn = $pn->themPN($mancc, $ngayNhap);

    $masp = $_GET['ma'];
    $dongianhap = $_POST['donGiaNhap'];
    $mamau1 = $_POST['MaMau1'];
    $mamau2 = $_POST['MaMau2'];
    $sl1 = $_POST['soLuongNhap1'];
    $sl2 = $_POST['soLuongNhap2'];

    $themCTPN = $pn->themCTPN($mapn, $masp, $mamau1, $mamau2, $dongianhap, $sl1, $sl2);

    if ($themCTPN) {
        $updateDonGia = $sp->updateGiaSanPham($mapn);
        $updateSLTMau1 = $mau->updateSoLuongTon1($mapn, $masp);
        $updateSLTMau2 = $mau->updateSoLuongTon2($mapn, $masp);
        echo "<script>alert('Thêm phiếu nhập thành công!');</script>";
        echo "<script>window.location.href = 'SanPham.php?ma=1';</script>";
        exit();
    } else {
        echo "<p>Có lỗi xảy ra khi thêm phiếu nhập.</p>";
    }
}
?>

<section id="main-content">
    <section class="wrapper">
        <div class="market-updates">
            <h3 class="mb-2"><a href="SanPham.php?ma=1" style="color:black;">Sản phẩm</a> / Thêm phiếu nhập</h3>
        </div>
        <!-- Menu ngang -->
        <div class="container-fluid bg-white p-4">
            <div id="contentArea">
                <!-- Nội dung sẽ được thay đổi tại đây -->
                <?php
                if (isset($_GET['ma'])) {
                    $masp = $_GET['ma'];
                    $dsSanPham = $sp->layTenSPtheoMaSP($masp);
                    $dsMau = $mau->layTenMauSPtheoMaSP($masp);
                    foreach ($dsSanPham as $tenSP) {
                ?>
                        <h2 class="text-center"><?php echo $tenSP->getTenSP() ?></h2>
                <?php
                    }
                }
                ?>
                <div class="table-responsive">
                    <form method="post">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="tenNCC">Nhà cung cấp:</label>
                                    <select class="form-control" id="tenNCC" name="MaNCC" required>
                                        <option value="" selected disabled>Chọn nhà cung cấp</option>
                                        <?php
                                        $dsNCC = $pn->showTenNCC();
                                        if (!empty($dsNCC)) {
                                            foreach ($dsNCC as $nhaCungCap) {
                                        ?>
                                                <option value="<?php echo $nhaCungCap->ncc->getMaNCC(); ?>"><?php echo $nhaCungCap->ncc->getTenNCC(); ?></option>
                                        <?php
                                            }
                                        } else {
                                            echo "<option disabled>Không có nhà cung cấp</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="ngayNH">Ngày nhập hàng</label>
                                    <input type="date" class="form-control" id="ngayNhapHang" name="ngayNhapHang" required>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Đơn giá nhập</th>
                                        <th>Màu 1</th>
                                        <th>Số lượng nhập 1</th>
                                        <th>Màu 2</th>
                                        <th>Số lượng nhập 2</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="col-md-2">
                                            <?php
                                            foreach ($dsSanPham as $pro) {
                                            ?>
                                                <input type="text" class="form-control" id="ngayNhapHang" name="TenSP" value="<?php echo $pro->getTenSP() ?>" readonly>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="col-md-2">
                                            <!-- Ô input cho Đơn giá nhập -->
                                            <input type="text" class="form-control" name="donGiaNhap">
                                        </td>
                                        <?php
                                        $isFirstColor = true;
                                        foreach ($dsMau as $color) {
                                            if ($isFirstColor) {
                                        ?>
                                                <td class="col-md-2">
                                                    <!-- Ô input cho Màu 1 -->
                                                    <select class="form-control" id="tenNCC" name="MaMau1" readonly>
                                                        <option value="<?php echo $color->getMaMau() ?>"><?php echo $color->getTenMau() ?></option>
                                                    </select>
                                                </td>
                                                <td class="col-md-1">
                                                    <!-- Ô input cho Số lượng nhập -->
                                                    <input type="number" class="form-control" name="soLuongNhap1">
                                                </td>
                                            <?php
                                                $isFirstColor = false;
                                            } else {
                                            ?>
                                                <td class="col-md-2">
                                                    <select class="form-control" id="tenNCC" name="MaMau2" readonly>
                                                        <option value="<?php echo $color->getMaMau() ?>"><?php echo $color->getTenMau() ?></option>
                                                    </select>
                                                </td>
                                                <td class="col-md-1">
                                                    <!-- Ô input cho Số lượng nhập 2 -->
                                                    <input type="number" class="form-control" name="soLuongNhap2">
                                                </td>
                                        <?php
                                            }
                                        }
                                        ?>

                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="form-group">
                            <!-- Nút "Nhập hàng" -->
                            <button type="submit" class="btn btn-primary" name="btn_nhapHang">NHẬP HÀNG</button>
                        </div>
                    </form>
                </div>

                <!-- Kết thúc phân trang -->
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