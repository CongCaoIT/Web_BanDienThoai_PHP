<?php
include '../admin/inc/header.php';
include '../admin/inc/sidebar.php';
include '../controller/Admin/SanPhamController.php';
include '../controller/Admin/NhaCungCapController.php';
include '../controller/Admin/LoaiSanPhamController.php';

$ncc = new NhaCungCapAdmin();
$dsNCC = $ncc->layDSNhaCungCap();

$lsp =  new LoaiSanPhamAdmin();
$dsLSP = $lsp->layDSLSP();

$sp = new SanPhamAdmin();

if (isset($_POST['btn_Luu'])) {
    $mancc = isset($_POST['MaNCC']) ? (int)$_POST['MaNCC'] : 0;
    $maloaisp = isset($_POST['MaLoaiSP']) ? (int)$_POST['MaLoaiSP'] : 0;
    $tensp = isset($_POST['TenSP']) ? $_POST['TenSP'] : "";
    $ngaycapnhat = isset($_POST['NgayCapNhat']) ? $_POST['NgayCapNhat'] : "";
    $mota = isset($_POST['MoTa']) ? $_POST['MoTa'] : "";
    $moi = isset($_POST['Moi']) ? (int)$_POST['Moi'] : 0;
    $daxoa = isset($_POST['DaXoa']) ? (int)$_POST['DaXoa'] : 0;

    $targetDir = "../data/Products/";

    $hinh1 = $_FILES['HinhAnh1']['name'];
    $hinh2 = $_FILES['HinhAnh2']['name'];
    $hinh3 = $_FILES['HinhAnh3']['name'];

    // Di chuyển và lưu file vào thư mục trên server
    move_uploaded_file($_FILES['HinhAnh1']['tmp_name'], $targetDir . $hinh1);
    move_uploaded_file($_FILES['HinhAnh2']['tmp_name'], $targetDir . $hinh2);
    move_uploaded_file($_FILES['HinhAnh3']['tmp_name'], $targetDir . $hinh3);

    $themsp = $sp->themSanPham($mancc, $maloaisp, $tensp, $ngaycapnhat, $mota, $hinh1, $hinh2, $hinh3, $moi, $daxoa);
    
    if ($themsp) {
        echo "<script>alert('Thêm sản phẩm thành công!');</script>";
        echo "<script>window.location.href = 'SanPham.php?ma=1';</script>";
        exit();
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

                <form method="post" enctype="multipart/form-data">
                    <h2 class="text-center"><strong>Sản phẩm mới</strong></h2>
                    <div class="form-group">
                        <label for="MaNCC">Nhà cung cấp</label>
                        <select id="MaNCC" name="MaNCC" class="form-control">
                            <?php
                            foreach ($dsNCC as $nhacc) {
                            ?>
                                <option value="<?php echo $nhacc->getMaNCC() ?>"><?php echo $nhacc->getTenNCC() ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="MaLoaiSP">Loại sản phẩm</label>
                        <select id="MaLoaiSP" class="form-control" name="MaLoaiSP">
                            <?php
                            foreach ($dsLSP as $lsp) {
                            ?>
                                <option value="<?php echo $lsp->getMaLoaiSP() ?>"><?php echo $lsp->getTenLoaiSP() ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="TenSp">Tên sản phẩm</label>
                        <input type="text" id="TenSp" name="TenSP" class="form-control" placeholder="Tên sản phẩm ...">
                    </div>

                    <div class="form-group">
                        <label for="NgayCapNhat">Ngày cập nhật</label>
                        <input type="date" id="NgayCapNhat" name="NgayCapNhat" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="MoTa">Mô tả</label>
                        <textarea id="MoTa" class="form-control" name="MoTa" placeholder="Mô tả sản phẩm ..."></textarea>
                    </div>

                    <div class="form-group">
                        <label for="HinhAnh1">Hình ảnh 1</label>
                        <input type="file" id="HinhAnh1" name="HinhAnh1" class="form-control-file">
                    </div>

                    <div class="form-group">
                        <label for="HinhAnh2">Hình ảnh 2</label>
                        <input type="file" id="HinhAnh2" name="HinhAnh2" class="form-control-file">
                    </div>

                    <div class="form-group">
                        <label for="HinhAnh3">Hình ảnh 3</label>
                        <input type="file" id="HinhAnh3" name="HinhAnh3" class="form-control-file">
                    </div>

                    <div class="form-group">
                        <label for="Moi">Tình trạng</label>
                        <select id="Moi" name="Moi" class="form-control">
                            <option value="0">Mới</option>
                            <option value="1">Cũ</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="DaXoa">Chọn trạng thái</label>
                        <select id="DaXoa" name="DaXoa" class="form-control">
                            <option value="0">Chưa xóa</option>
                            <option value="1">Đã Xóa</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <a href="" class="btn btn-danger">Trở lại</a>
                        <input type="submit" value="Lưu" name="btn_Luu" class="btn btn-primary" />
                    </div>
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
</section>