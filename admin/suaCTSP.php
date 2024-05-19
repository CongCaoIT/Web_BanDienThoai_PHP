<?php

include('../admin/include_lib.php');

$ctsp = new ChiTietSanPhamAdmin();

$dsCTSP = $ctsp->layCTSPtheoMaSP($_GET['ma']);

if (isset($_POST['btn_Luu'])) {
    $masp = $_GET['ma'];
    $mactsp = $_POST['mactsp'];
    $kichThuocManHinh = $_POST['kichthuocmanhinh'];
    $congNgheManHinh = $_POST['congnghemanhinh'];
    $doPhanGiai = $_POST['dophangiai'];
    $tinhNangManHinh = $_POST['tinhnangmanhinh'];
    $tanSoQuet = $_POST['tansoquet'];
    $cameraSau = $_POST['camerasau'];
    $quayPhim = $_POST['quayphim'];
    $cameraTruoc = $_POST['cameratruoc'];
    $tinhNangCamera = $_POST['tinhnangcamera'];
    $heDieuHanh = $_POST['hedieuhanh'];
    $chip = $_POST['chip'];
    $tocDoCPU = $_POST['tocdocpu'];
    $chipDoHoa = $_POST['chipdohoa'];
    $ram = $_POST['ram'];
    $dungLuong = $_POST['dungluong'];
    $mangDiDong = $_POST['mangdidong'];
    $sim = $_POST['sim'];
    $wifi = $_POST['wifi'];
    $congKetNoi = $_POST['congketnoi'];
    $dungLuongPin = $_POST['dungluongpin'];
    $loaiPin = $_POST['loaipin'];
    $hoTroSac = $_POST['hotrosac'];
    $baoMat = $_POST['baomat'];
    $tinhNangDacBiet = $_POST['tinhnangdacbiet'];
    $khangNuoc = $_POST['khangnuoc'];
    $thietKe = $_POST['thietke'];
    $chatLieu = $_POST['chatlieu'];
    $kichThuoc = $_POST['kichthuoc'];
    $baoHanh = $_POST['baohanh'];
    $raMat = $_POST['ramat'];

    // Gọi hàm sửa sản phẩm và truyền dữ liệu vào
    $suactsp = $ctsp->suaChiTietSanPham($masp, $kichThuocManHinh, $congNgheManHinh, $doPhanGiai, $tinhNangManHinh, $tanSoQuet, $cameraSau, $quayPhim, $cameraTruoc, $tinhNangCamera, $heDieuHanh, $chip, $tocDoCPU, $chipDoHoa, $ram, $dungLuong, $mangDiDong, $sim, $wifi, $congKetNoi, $dungLuongPin, $loaiPin, $hoTroSac, $baoMat, $tinhNangDacBiet, $khangNuoc, $thietKe, $chatLieu, $kichThuoc, $baoHanh, $raMat, $mactsp);

    if ($suactsp) {
        echo "<script>alert('Sửa chi tiết sản phẩm thành công!');</script>";
        echo "<script>window.location.href = 'ChiTietSanPham.php?ma=1';</script>";
        exit();
    } else {
        echo "<script>alert('Sửa chi tiet sản phẩm thất bại!');</script>";
    }
}
?>

<section id="main-content">
    <section class="wrapper">
        <div class="market-updates">
            <h3 class="mb-2"><a href="ChiTietSanPham.php?ma=1" style="color:black;">Chi tiết sản phẩm</a> / Sửa</h3>
        </div>
        <!-- Menu ngang -->
        <div class="container-fluid bg-white p-4">
            <div id="contentArea">
                <!-- Nội dung sẽ được thay đổi tại đây -->

                <form method="post" enctype="multipart/form-data">
                    <?php
                    if (isset($_GET['ma'])) {
                        $masp = $_GET['ma'];
                        $sp = new SanPhamAdmin();
                        $dsSanPham = $sp->layTenSPtheoMaSP($masp);
                        foreach ($dsSanPham as $tenSP) {
                    ?>
                            <h2 class="text-center"><?php echo $tenSP->getTenSP() ?></h2>
                        <?php
                        }
                    }

                    foreach ($dsCTSP as $ct) {
                        ?>
                        <input type="hidden" name="mactsp" class="form-control" value="<?php echo $ct->getMaChiTietSP() ?>">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="kichthuocmanhinh">Kích Thước Màn Hình:</label>
                                            <input type="text" name="kichthuocmanhinh" class="form-control" value="<?php echo $ct->getKichThuocManHinh() ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="congnghemanhinh">Công Nghệ Màn Hình:</label>
                                            <input type="text" name="congnghemanhinh" class="form-control" value="<?php echo $ct->getCongNgheManHinh() ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="dophangiai">Độ Phân Giải:</label>
                                            <input type="text" name="dophangiai" class="form-control" value="<?php echo $ct->getDoPhanGiai() ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="tinhnangmanhinh">Tính Năng Màn Hình:</label>
                                            <input type="text" name="tinhnangmanhinh" class="form-control" value="<?php echo $ct->getTinhNangManHinh() ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="tansoquet">Tần Số Quét:</label>
                                            <input type="text" name="tansoquet" class="form-control" value="<?php echo $ct->getTanSoQuet() ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="camerasau">Camera Sau:</label>
                                            <input type="text" name="camerasau" class="form-control" value="<?php echo $ct->getCameraSau() ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="quayphim">Quay Phim:</label>
                                            <input type="text" name="quayphim" class="form-control" value="<?php echo $ct->getQuayPhim() ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="cameratruoc">Camera Trước:</label>
                                            <input type="text" name="cameratruoc" class="form-control" value="<?php echo $ct->getCameraTruoc() ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="tinhnangcamera">Tính Năng Camera:</label>
                                            <input type="text" name="tinhnangcamera" class="form-control" value="<?php echo $ct->getTinhNangCamera() ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="hedieuhanh">Hệ Điều Hành:</label>
                                            <input type="text" name="hedieuhanh" class="form-control" value="<?php echo $ct->getHeDieuHanh() ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="chip">Chip:</label>
                                            <input type="text" name="chip" class="form-control" value="<?php echo $ct->getChip() ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="tocdocpu">Tốc Độ CPU:</label>
                                            <input type="text" name="tocdocpu" class="form-control" value="<?php echo $ct->getTocDoCPU() ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="chipdohoa">Chip Đồ Họa:</label>
                                            <input type="text" name="chipdohoa" class="form-control" value="<?php echo $ct->getChipDoHoa() ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="ram">RAM:</label>
                                            <input type="text" name="ram" class="form-control" value="<?php echo $ct->getRam() ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="dungluong">Dung Lượng:</label>
                                            <input type="text" name="dungluong" class="form-control" value="<?php echo $ct->getDungLuong() ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="mangdidong">Mạng Di Động:</label>
                                            <input type="text" name="mangdidong" class="form-control" value="<?php echo $ct->getMangDiDong() ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="sim">SIM:</label>
                                            <input type="text" name="sim" class="form-control" value="<?php echo $ct->getKichThuocManHinh() ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="wifi">Wifi:</label>
                                            <input type="text" name="wifi" class="form-control" value="<?php echo $ct->getWifi() ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="congketnoi">Cổng Kết Nối:</label>
                                            <input type="text" name="congketnoi" class="form-control" value="<?php echo $ct->getCongKetNoi() ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="dungluongpin">Dung Lượng Pin:</label>
                                            <input type="text" name="dungluongpin" class="form-control" value="<?php echo $ct->getDungLuongPin() ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="loaipin">Loại Pin:</label>
                                            <input type="text" name="loaipin" class="form-control" value="<?php echo $ct->getLoaiPin() ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="hotrosac">Hỗ Trợ Sạc:</label>
                                            <input type="text" name="hotrosac" class="form-control" value="<?php echo $ct->getHoTroSac() ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="baomat">Bảo Mật:</label>
                                            <input type="text" name="baomat" class="form-control" value="<?php echo $ct->getBaoMat() ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="tinhnangdacbiet">Tính Năng Đặc Biệt:</label>
                                            <input type="text" name="tinhnangdacbiet" class="form-control" value="<?php echo $ct->getTinhNangDacBiet() ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="khangnuoc">Kháng Nước:</label>
                                            <input type="text" name="khangnuoc" class="form-control" value="<?php echo $ct->getKhangNuoc() ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="thietke">Thiết Kế:</label>
                                            <input type="text" name="thietke" class="form-control" value="<?php echo $ct->getThietKe() ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="chatlieu">Chất Liệu:</label>
                                            <input type="text" name="chatlieu" class="form-control" value="<?php echo $ct->getChatLieu() ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="kichthuoc">Kích Thước:</label>
                                            <input type="text" name="kichthuoc" class="form-control" value="<?php echo $ct->getKichThuoc() ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="baohanh">Bảo Hành:</label>
                                            <input type="text" name="baohanh" class="form-control" value="<?php echo $ct->getBaoHanh() ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="ramat">Ra Mắt:</label>
                                            <input type="date" name="ramat" class="form-control" value="<?php echo $ct->getRaMat() ?>">
                                        </div>
                                        <!-- Thêm các trường input cho các thông tin khác của sản phẩm tại đây -->

                                        <div class="form-group">
                                            <button type="submit" name="btn_Luu" class="btn btn-primary">Lưu</button>
                                            <a href="ChiTietSanPham.php?ma=1" class="btn btn-danger">Trở lại</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                </form>

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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var form = document.querySelector('form');

            form.addEventListener('submit', function(event) {
                var errors = [];

                // Kiểm tra trường Nhà cung cấp
                var maNCC = document.getElementById('MaNCC').value;
                if (!maNCC) {
                    errors.push('Vui lòng chọn Nhà cung cấp.');
                }

                // Kiểm tra trường Loại sản phẩm
                var maLoaiSP = document.getElementById('MaLoaiSP').value;
                if (!maLoaiSP) {
                    errors.push('Vui lòng chọn Loại sản phẩm.');
                }

                // Kiểm tra trường Tên sản phẩm
                var tenSP = document.getElementById('TenSp').value;
                if (!tenSP) {
                    errors.push('Vui lòng nhập Tên sản phẩm.');
                }

                // Kiểm tra trường Ngày cập nhật
                var ngayCapNhat = document.getElementById('NgayCapNhat').value;
                if (!ngayCapNhat) {
                    errors.push('Vui lòng chọn Ngày cập nhật.');
                }

                // Kiểm tra trường Mô tả
                var moTa = document.getElementById('MoTa').value;
                if (!moTa) {
                    errors.push('Vui lòng nhập Mô tả sản phẩm.');
                }

                // Hiển thị lỗi nếu có
                if (errors.length > 0) {
                    event.preventDefault(); // Ngăn chặn gửi biểu mẫu
                    alert(errors.join('\n')); // Hiển thị tất cả các lỗi trong một cửa sổ thông báo
                }
            });
        });
    </script>
</section>