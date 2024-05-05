<?php
include '../admin/inc/header.php';
include '../admin/inc/sidebar.php';
include '../controller/Admin/ChiTietSanPhamController.php';
include '../controller/Admin/SanPhamController.php';

$ctsp = new ChiTietSanPhamAdmin();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra nút Lưu đã được nhấn
    if (isset($_POST["btn_Luu"])) {
        // Lấy dữ liệu từ form
        $masp = (int)$_GET["ma"];
        $kichthuocmanhinh = $_POST["kichthuocmanhinh"];
        $congnghemanhinh = $_POST["congnghemanhinh"];
        $dophangiai = $_POST["dophangiai"];
        $tinhnangmanhinh = $_POST["tinhnangmanhinh"];
        $tansoquet = $_POST["tansoquet"];
        $camerasau = $_POST["camerasau"];
        $quayphim = $_POST["quayphim"];
        $cameratruoc = $_POST["cameratruoc"];
        $tinhnangcamera = $_POST["tinhnangcamera"];
        $hedieuhanh = $_POST["hedieuhanh"];
        $chip = $_POST["chip"];
        $tocdocpu = $_POST["tocdocpu"];
        $chipdohoa = $_POST["chipdohoa"];
        $ram = $_POST["ram"];
        $dungluong = $_POST["dungluong"];
        $mangdidong = $_POST["mangdidong"];
        $sim = $_POST["sim"];
        $wifi = $_POST["wifi"];
        $congketnoi = $_POST["congketnoi"];
        $dungluongpin = $_POST["dungluongpin"];
        $loaipin = $_POST["loaipin"];
        $hotrosac = $_POST["hotrosac"];
        $baomat = $_POST["baomat"];
        $tinhnangdacbiet = $_POST["tinhnangdacbiet"];
        $khangnuoc = $_POST["khangnuoc"];
        $thietke = $_POST["thietke"];
        $chatlieu = $_POST["chatlieu"];
        $kichthuoc = $_POST["kichthuoc"];
        $baohanh = $_POST["baohanh"];
        $ramat = $_POST["ramat"];

        // Gọi hàm để thêm chi tiết sản phẩm
        $success = $ctsp->themChiTietSanPham($masp, $kichthuocmanhinh, $congnghemanhinh, $dophangiai, $tinhnangmanhinh, $tansoquet, $camerasau, $quayphim, $cameratruoc, $tinhnangcamera, $hedieuhanh, $chip, $tocdocpu, $chipdohoa, $ram, $dungluong, $mangdidong, $sim, $wifi, $congketnoi, $dungluongpin, $loaipin, $hotrosac, $baomat, $tinhnangdacbiet, $khangnuoc, $thietke, $chatlieu, $kichthuoc, $baohanh, $ramat);

        // Kiểm tra và thông báo kết quả
        if ($success) {
            echo "<script>alert('Thêm sản phẩm thành công!');</script>";
            echo "<script>window.location.href = 'SanPham.php?ma=1';</script>";
            exit();
        } else {
            echo "<p>Có lỗi xảy ra khi thêm chi tiết sản phẩm.</p>";
        }
    }
}
?>
<section id="main-content">
    <section class="wrapper">
        <div class="market-updates">
            <h3 class="mb-2"><a href="SanPham.php?ma=1" style="color:black;">Sản phẩm</a> / Thêm sản phẩm</h3>
        </div>
        <!-- Menu ngang -->
        <div class="container-fluid bg-white p-4">
            <div id="contentArea">
                <!-- Nội dung sẽ được thay đổi tại đây -->
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
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
                                ?>
                            </div>

                            <?php
                            if ($ctsp->kiemtraCTSP($_GET['ma'])) {
                            ?>
                                <div class="ml-2 mt-2" role="alert">
                                    <h3 class="mt-2 mb-3">Sản phẩm đã có thông tin chi tiết.</h3>
                                    <div class="btn-group mb-2" role="group">
                                        <a href="SanPham.php?ma=1" class="btn btn-danger mr-2">Trở lại</a>
                                        <a href="XemChiTietSanPham.php?ma=<?php echo $_GET['ma'] ?>" class="btn btn-primary">Xem chi tiết</a>
                                    </div>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="card-body">
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="kichthuocmanhinh">Kích Thước Màn Hình:</label>
                                            <input type="text" name="kichthuocmanhinh" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="congnghemanhinh">Công Nghệ Màn Hình:</label>
                                            <input type="text" name="congnghemanhinh" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="dophangiai">Độ Phân Giải:</label>
                                            <input type="text" name="dophangiai" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="tinhnangmanhinh">Tính Năng Màn Hình:</label>
                                            <input type="text" name="tinhnangmanhinh" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="tansoquet">Tần Số Quét:</label>
                                            <input type="text" name="tansoquet" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="camerasau">Camera Sau:</label>
                                            <input type="text" name="camerasau" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="quayphim">Quay Phim:</label>
                                            <input type="text" name="quayphim" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="cameratruoc">Camera Trước:</label>
                                            <input type="text" name="cameratruoc" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="tinhnangcamera">Tính Năng Camera:</label>
                                            <input type="text" name="tinhnangcamera" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="hedieuhanh">Hệ Điều Hành:</label>
                                            <input type="text" name="hedieuhanh" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="chip">Chip:</label>
                                            <input type="text" name="chip" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="tocdocpu">Tốc Độ CPU:</label>
                                            <input type="text" name="tocdocpu" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="chipdohoa">Chip Đồ Họa:</label>
                                            <input type="text" name="chipdohoa" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="ram">RAM:</label>
                                            <input type="text" name="ram" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="dungluong">Dung Lượng:</label>
                                            <input type="text" name="dungluong" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="mangdidong">Mạng Di Động:</label>
                                            <input type="text" name="mangdidong" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="sim">SIM:</label>
                                            <input type="text" name="sim" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="wifi">Wifi:</label>
                                            <input type="text" name="wifi" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="congketnoi">Cổng Kết Nối:</label>
                                            <input type="text" name="congketnoi" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="dungluongpin">Dung Lượng Pin:</label>
                                            <input type="text" name="dungluongpin" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="loaipin">Loại Pin:</label>
                                            <input type="text" name="loaipin" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="hotrosac">Hỗ Trợ Sạc:</label>
                                            <input type="text" name="hotrosac" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="baomat">Bảo Mật:</label>
                                            <input type="text" name="baomat" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="tinhnangdacbiet">Tính Năng Đặc Biệt:</label>
                                            <input type="text" name="tinhnangdacbiet" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="khangnuoc">Kháng Nước:</label>
                                            <input type="text" name="khangnuoc" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="thietke">Thiết Kế:</label>
                                            <input type="text" name="thietke" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="chatlieu">Chất Liệu:</label>
                                            <input type="text" name="chatlieu" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="kichthuoc">Kích Thước:</label>
                                            <input type="text" name="kichthuoc" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="baohanh">Bảo Hành:</label>
                                            <input type="text" name="baohanh" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="ramat">Ra Mắt:</label>
                                            <input type="date" name="ramat" class="form-control">
                                        </div>
                                        <!-- Thêm các trường input cho các thông tin khác của sản phẩm tại đây -->

                                        <div class="form-group">
                                            <button type="submit" name="btn_Luu" class="btn btn-primary">Lưu</button>
                                            <a href="SanPham.php?ma=1" class="btn btn-danger">Trở lại</a>
                                        </div>
                                    </form>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>

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