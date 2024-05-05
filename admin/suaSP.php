<?php
include '../admin/inc/header.php';
include '../admin/inc/sidebar.php';
include '../controller/Admin/SanPhamController.php';
include '../controller/Admin/NhaCungCapController.php';
include '../controller/Admin/LoaiSanPhamController.php';

$sp = new SanPhamAdmin();

$ncc = new NhaCungCapAdmin();
$dsNCC = $ncc->layDSNhaCungCap();

$lsp =  new LoaiSanPhamAdmin();
$dsLSP = $lsp->layDSLSP();


if (isset($_POST['btn_Luu'])) {
    $masp = isset($_GET['ma']) ? (int)$_GET['ma'] : 0;
    $mancc = isset($_POST['MaNCC']) ? (int)$_POST['MaNCC'] : 0;
    $maloaisp = isset($_POST['MaLoaiSP']) ? (int)$_POST['MaLoaiSP'] : 0;
    $tensp = isset($_POST['TenSP']) ? $_POST['TenSP'] : "";
    $ngaycapnhat = isset($_POST['NgayCapNhat']) ? $_POST['NgayCapNhat'] : "";
    $mota = isset($_POST['MoTa']) ? $_POST['MoTa'] : "";
    $moi = isset($_POST['Moi']) ? (int)$_POST['Moi'] : 0;
    $daxoa = isset($_POST['DaXoa']) ? (int)$_POST['DaXoa'] : 0;

    // Kiểm tra xem người dùng đã chọn file hình ảnh mới hay chưa
    $hinh1 = isset($_FILES['HinhAnh1']['name']) ? $_FILES['HinhAnh1']['name'] : "";
    $hinh2 = isset($_FILES['HinhAnh2']['name']) ? $_FILES['HinhAnh2']['name'] : "";
    $hinh3 = isset($_FILES['HinhAnh3']['name']) ? $_FILES['HinhAnh3']['name'] : "";

    // Đường dẫn mặc định cho hình ảnh
    $defaultImagePath = ""; // Đường dẫn mặc định cho hình ảnh

    $dsSanPham = $sp->showSanPhamTheoMaSP($masp);
    foreach ($dsSanPham as $sptheoma) {
        // Nếu người dùng đã chọn file hình ảnh mới, di chuyển và lưu file vào thư mục trên server
        if (!empty($hinh1)) {
            $targetDir = "../data/Products/";
            move_uploaded_file($_FILES['HinhAnh1']['tmp_name'], $targetDir . $hinh1);
        } else {
            $hinh1 = $sptheoma->getHinhAnh(); // Sử dụng đường dẫn mặc định cho hình ảnh
        }

        if (!empty($hinh2)) {
            $targetDir = "../data/Products/";
            move_uploaded_file($_FILES['HinhAnh2']['tmp_name'], $targetDir . $hinh2);
        } else {
            $hinh2 = $sptheoma->getHinhAnh2(); // Sử dụng đường dẫn mặc định cho hình ảnh
        }

        if (!empty($hinh3)) {
            $targetDir = "../data/Products/";
            move_uploaded_file($_FILES['HinhAnh3']['tmp_name'], $targetDir . $hinh3);
        } else {
            $hinh3 = $sptheoma->getHinhAnh3(); // Sử dụng đường dẫn mặc định cho hình ảnh
        }
    }

    // Gọi hàm sửa sản phẩm và truyền dữ liệu vào
    $suasp = $sp->suaSanPham($mancc, $maloaisp, $tensp, $ngaycapnhat, $mota, $hinh1, $hinh2, $hinh3, $moi, $daxoa, $masp);

    if ($suasp) {
        echo "<script>alert('Sửa sản phẩm thành công!');</script>";
        echo "<script>window.location.href = 'SanPham.php?ma=1';</script>";
        exit();
    } else {
        echo "<script>alert('Sửa sản phẩm thất bại!');</script>";
    }
}
?>

<section id="main-content">
    <section class="wrapper">
        <div class="market-updates">
            <h3 class="mb-2"><a href="SanPham.php?ma=1" style="color:black;">Sản phẩm</a> / Sửa sản phẩm</h3>
        </div>
        <!-- Menu ngang -->
        <div class="container-fluid bg-white p-4">
            <div id="contentArea">
                <!-- Nội dung sẽ được thay đổi tại đây -->

                <form method="post" enctype="multipart/form-data">
                    <?php
                    if (isset($_GET['ma'])) {
                        $masp = $_GET['ma'];
                    }
                    $dsSanPham = $sp->showSanPhamTheoMaSP($masp);
                    $dsNCCtheoMa = $ncc->layNhaCungCaptheoMaSP($masp);
                    $dsLoaiSPtheoMa = $lsp->layLSPtheoMaSP($masp);
                    foreach ($dsSanPham as $sp) {
                    ?>
                        <h2 class="text-center mb-2"><?php echo $sp->getTenSP() ?></h2>
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="MaNCC">Nhà cung cấp</label>
                                    <select id="MaNCC" name="MaNCC" class="form-control">
                                        <?php
                                        // Mảng tạm thời để lưu các mã nhà cung cấp đã được thêm vào option đầu tiên
                                        $addedNCC = array();

                                        // Thêm option cho nhà cung cấp theo mã
                                        foreach ($dsNCCtheoMa as $nhacc) {
                                            $addedNCC[$nhacc->getMaNCC()] = true; // Đánh dấu đã thêm vào
                                        ?>
                                            <option value="<?php echo $nhacc->getMaNCC() ?>"><?php echo $nhacc->getTenNCC() ?></option>
                                            <?php
                                        }

                                        // Thêm tất cả các option cho nhà cung cấp, loại bỏ các nhà cung cấp trùng lặp
                                        foreach ($dsNCC as $nhacc) {
                                            // Kiểm tra xem mã nhà cung cấp đã được thêm vào option đầu tiên hay chưa
                                            if (!isset($addedNCC[$nhacc->getMaNCC()])) {
                                            ?>
                                                <option value="<?php echo $nhacc->getMaNCC() ?>"><?php echo $nhacc->getTenNCC() ?></option>
                                        <?php
                                                $addedNCC[$nhacc->getMaNCC()] = true; // Đánh dấu đã thêm vào
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="MaLoaiSP">Loại sản phẩm</label>
                                    <select id="MaLoaiSP" class="form-control" name="MaLoaiSP">
                                        <?php
                                        // Mảng tạm thời để lưu các mã loại sản phẩm đã được thêm vào option đầu tiên
                                        $addedLSP = array();

                                        // Thêm option cho loại sản phẩm theo mã
                                        foreach ($dsLoaiSPtheoMa as $lsp) {
                                            $addedLSP[$lsp->getMaLoaiSP()] = true; // Đánh dấu đã thêm vào
                                        ?>
                                            <option value="<?php echo $lsp->getMaLoaiSP() ?>"><?php echo $lsp->getTenLoaiSP() ?></option>
                                            <?php
                                        }

                                        // Thêm tất cả các option cho loại sản phẩm, loại bỏ các loại sản phẩm trùng lặp
                                        foreach ($dsLSP as $lsp) {
                                            // Kiểm tra xem mã loại sản phẩm đã được thêm vào option đầu tiên hay chưa
                                            if (!isset($addedLSP[$lsp->getMaLoaiSP()])) {
                                            ?>
                                                <option value="<?php echo $lsp->getMaLoaiSP() ?>"><?php echo $lsp->getTenLoaiSP() ?></option>
                                        <?php
                                                $addedLSP[$lsp->getMaLoaiSP()] = true; // Đánh dấu đã thêm vào
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="TenSp">Tên sản phẩm</label>
                                    <input type="text" id="TenSp" name="TenSP" class="form-control" placeholder="Tên sản phẩm ..." value="<?php echo $sp->getTenSP() ?>">
                                </div>

                                <div class="form-group">
                                    <label for="NgayCapNhat">Ngày cập nhật</label>
                                    <input type="date" id="NgayCapNhat" name="NgayCapNhat" class="form-control" value="<?php echo date('Y-m-d', strtotime($sp->getNgayCapNhat())) ?>">
                                </div>

                                <div class="form-group">
                                    <label for="MoTa">Mô tả</label>
                                    <textarea style="height: 100px;" id="MoTa" class="form-control" name="MoTa" placeholder="Mô tả sản phẩm ..."><?php echo $sp->getMoTa() ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="HinhAnh1">Hình ảnh 1</label>
                                    <input type="file" id="HinhAnh1" name="HinhAnh1" class="form-control-file">
                                    <br />
                                    <img src="../data/Products/<?php echo $sp->getHinhAnh() ?>" alt="Alternate Text" style="width:250px;height:auto;" />
                                </div>

                                <div class="form-group">
                                    <label for="HinhAnh2">Hình ảnh 2</label>
                                    <input type="file" id="HinhAnh2" name="HinhAnh2" class="form-control-file">
                                    <br />
                                    <img src="../data/Products/<?php echo $sp->getHinhAnh2() ?>" alt="Alternate Text" style="width:250px;height:auto;" />
                                </div>

                                <div class="form-group">
                                    <label for="HinhAnh3">Hình ảnh 3</label>
                                    <input type="file" id="HinhAnh3" name="HinhAnh3" class="form-control-file">
                                    <br />
                                    <img src="../data/Products/<?php echo $sp->getHinhAnh3() ?>" alt="Alternate Text" style="width:250px;height:auto;" />
                                </div>

                                <div class="form-group">
                                    <label for="Moi">Tình trạng</label>
                                    <select id="Moi" name="Moi" class="form-control">
                                        <option value="0" <?php if ($sp->getMoi() == 0) echo 'selected="selected"'; ?>>Cũ</option>
                                        <option value="1" <?php if ($sp->getMoi() == 1) echo 'selected="selected"'; ?>>Mới</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="DaXoa">Chọn trạng thái</label>
                                    <select id="DaXoa" name="DaXoa" class="form-control">
                                        <option value="0" <?php if ($sp->getDaXoa() == 0) echo 'selected="selected"'; ?>>Chưa xóa</option>
                                        <option value="1" <?php if ($sp->getDaXoa() == 1) echo 'selected="selected"'; ?>>Đã Xóa</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <a href="SanPham.php?ma=1" class="btn btn-danger">Trở lại</a>
                                    <input type="submit" value="Lưu" name="btn_Luu" class="btn btn-primary" />
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