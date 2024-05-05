<?php
include '../admin/inc/header.php';
include '../admin/inc/sidebar.php';
include '../controller/Admin/ChiTietSanPhamController.php';
include '../controller/Admin/SanPhamController.php';

$ctsp = new ChiTietSanPhamAdmin();
$sp = new SanPhamAdmin();
$page = isset($_GET['page']) ? $_GET['page'] : 1;
?>
<style>
    .img-product {
        max-width: 120px;
        height: auto;
    }

    .center-text {
        text-align: justify;
        text-indent: 16px;
    }

    .btn-content {
        width: 90px;
        /* Độ rộng của nút */
        margin: 4px;
        font-size: 12px;
        white-space: normal;
    }

    .btn-container {
        text-align: center;
        /* Căn giữa nội dung của td */
        vertical-align: middle;
        /* Căn giữa theo chiều dọc */
        padding: 12px 0px !important;
    }

    .container_Products {
        width: 1650px;
        margin: 0 auto;
        padding: 12px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        overflow: auto;
        /* Ẩn cuộn ngang */
        position: relative;
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        overflow-x: auto;
        /* Cho phép cuộn ngang khi cần thiết */
    }

    table,
    th,
    td {
        border: 1px solid #ddd;
    }

    th,
    td {
        padding: 9px;
    }

    thead {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    th:first-child,
    td:first-child {
        left: 0;
        background-color: #f2f2f2;
    }

    .title2 {
        color: #337ab7;
        padding-bottom: 12px;
        font-size: 20px;
    }
</style>
<section id="main-content">
    <section class="wrapper">
        <div class="market-updates">
            <h3 class="mb-2"><a href="ChiTietSanPham.php?ma=1" style="color:black;">Chi tiết sản phẩm</a> / Danh sách</h3>
        </div>
        <!-- Menu ngang -->
        <div class="container-fluid bg-white p-4">
            <div id="contentArea">
                <!-- Nội dung sẽ được thay đổi tại đây -->
                <?php
                // Di chuyển câu lệnh echo vào đây
                if (isset($_GET['ma'])) {
                    $maloai = $_GET['ma'];
                }
                ?>
                <h2 class="text-center mb-2">DANH SÁCH LOẠI SẢN PHẨM</h2>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th>Mã chi tiết</th>
                                <th>Tên sản phẩm</th>
                                <th>Kích thước màn hình</th>
                                <th>Công nghệ màn hình</th>
                                <th>Độ phân giải</th>
                                <th>Tính năng</th>
                                <th>Tần số quét</th>
                                <th>Camera sau</th>
                                <th>Quay phim</th>
                                <th>Camera trước</th>
                                <th>Tính năg</th>
                                <th>Hệ điều hành</th>
                                <th>Chip xử lý (CPU)</th>
                                <th>Tốc độ CPU</th>
                                <th>Chip đồ họa (GPU)</th>
                                <th>Ram</th>
                                <th>Dung lượng</th>
                                <th>Mạng di động</th>
                                <th>Sim</th>
                                <th>Wifi</th>
                                <th>Cổng kết nối/sạc</th>
                                <th>Dung lượng pin</th>
                                <th>Loại pin</th>
                                <th>Hỗ trợ sạc tối đa</th>
                                <th>Bảo mật nâng cao</th>
                                <th>Tính năng đặc biệt</th>
                                <th>Kháng nước, bụi</th>
                                <th>Thiết kế</th>
                                <th>Chất liệu</th>
                                <th>Kích thước, khối lượng</th>
                                <th>Bảo hành</th>
                                <th>Thời điểm ra mắt</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $dsCTSP = $ctsp->layCTSPtheoMaLoaiSP($maloai);
                            $recordsPerPage = 7;
                            if (!empty($dsCTSP)) {
                                $startIndex = ($page - 1) * $recordsPerPage;
                                $endIndex = min($startIndex + $recordsPerPage - 1, count($dsCTSP) - 1);

                                for ($i = $startIndex; $i <= $endIndex; $i++) {
                                    $ct = $dsCTSP[$i];
                            ?>
                                    <tr>
                                        <td>
                                            <!-- Nút "Thêm" -->
                                            <a href="themCTSP.php?ma=" class="btn btn-primary">
                                                <span style="color: #ffffff" class="glyphicon glyphicon-plus"></span>
                                            </a>

                                            <!-- Nút "Sửa" -->
                                            <a href="suaSP.php?ma=" class="btn btn-warning mt-1">
                                                <span style="color: #ffffff" class="glyphicon glyphicon-pencil"></span>
                                            </a>

                                            <!-- Nút "Xóa" -->
                                            <a href="#" class="btn btn-danger mt-1 delete-product" data-masp="">
                                                <span style="color: #ffffff" class="glyphicon glyphicon-trash"></span>
                                            </a>

                                            <!-- Nút "Xem" -->
                                            <a href="XemChiTietSanPham.php?ma=<?php echo $ct->getMaSP() ?>" id="showSpecifications" class="btn btn-info mt-1">
                                                <span style="color: #ffffff" class="glyphicon glyphicon-eye-open"></span>
                                            </a>
                                        </td>
                                        <td><?php echo $ct->getMaChiTietSP(); ?></td>
                                        <td style="text-align: left; ">
                                            <?php
                                            foreach ($sp->layTenSPtheoMaSP($ct->getMaSP()) as $ten) {
                                                $part = $ten->getTenSP();
                                                echo "<p style=\"width: 160px;\">$part</p>";
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $ct->getKichThuocManHinh(); ?></td>
                                        <td style="color: red;"><?php echo $ct->getCongNgheManHinh(); ?></td>
                                        <td>
                                            <?php
                                            $part = $ct->getDoPhanGiai();
                                            echo "<p style=\"width: 160px;\">- $part</p>";
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $part = $ct->getTinhNangManHinh();
                                            echo "<p style=\"width: 160px;\">- $part</p>";
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $part = $ct->getTanSoQuet();
                                            echo "<p style=\"width: 60px;\">- $part</p>";
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $str_mota = $ct->getCameraSau();
                                            $parts = explode(",", $str_mota);

                                            if (end($parts) === '') {
                                                array_pop($parts);
                                            }

                                            foreach ($parts as $part) {
                                                echo "<p style=\"width: 100px;\">- $part</p>";
                                            }
                                            ?>
                                        </td>
                                        <td style="text-align: left;">
                                            <?php
                                            $str_mota = $ct->getQuayPhim();
                                            $parts = explode(",", $str_mota);

                                            if (end($parts) === '') {
                                                array_pop($parts);
                                            }

                                            foreach ($parts as $part) {
                                                echo "<p style=\"width: 160px;\">- $part</p>";
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $ct->getCameraTruoc(); ?></td>
                                        <td>
                                            <?php
                                            $str_mota = $ct->getTinhNangCamera();
                                            $parts = explode(",", $str_mota);

                                            if (end($parts) === '') {
                                                array_pop($parts);
                                            }

                                            foreach ($parts as $part) {
                                                echo "<p style=\"width: 300px;\">- $part</p>";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $part = $ct->getHeDieuHanh();
                                            echo "<p style=\"width: 60px;\">$part</p>";
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $part = $ct->getChip();
                                            echo "<p style=\"width: 100px;\">$part</p>";
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $part = $ct->getTocDoCPU();
                                            echo "<p style=\"width: 80px;\">$part</p>";
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $part = $ct->getChipDoHoa();
                                            echo "<p style=\"width: 150px;\">$part</p>";
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $part = $ct->getRam();
                                            echo "<p style=\"width: 60px;\">$part</p>";
                                            ?>
                                        </td>
                                        <td><?php echo $ct->getDungLuong(); ?></td>
                                        <td>
                                            <?php
                                            $part = $ct->getMangDiDong();
                                            echo "<p style=\"width: 100px;\">$part</p>";
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $str_mota = $ct->getSim();
                                            $parts = explode("&", $str_mota);

                                            if (end($parts) === '') {
                                                array_pop($parts);
                                            }

                                            foreach ($parts as $part) {
                                                echo "<p style=\"width: 100px;\">- $part</p>";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $str_mota = $ct->getWifi();
                                            $parts = explode(",", $str_mota);

                                            if (end($parts) === '') {
                                                array_pop($parts);
                                            }

                                            foreach ($parts as $part) {
                                                echo "<p style=\"width: 130px;\">- $part</p>";
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $ct->getCongKetNoi(); ?></td>
                                        <td><?php echo $ct->getDungLuongPin(); ?></td>
                                        <td>
                                            <?php
                                            $part = $ct->getLoaiPin();
                                            echo "<p style=\"width: 50px;\">$part</p>";
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $part = $ct->getHoTroSac();
                                            echo "<p style=\"width: 50px;\">$part</p>";
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $part = $ct->getBaoMat();
                                            echo "<p style=\"width: 200px;\">$part</p>";
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $str_mota = $ct->getTinhNangDacBiet();
                                            $parts = explode(",", $str_mota);

                                            if (end($parts) === '') {
                                                array_pop($parts);
                                            }

                                            foreach ($parts as $part) {
                                                echo "<p style=\"width: 200px;\">- $part</p>";
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $ct->getKhangNuoc(); ?></td>
                                        <td><?php echo $ct->getThietKe(); ?></td>
                                        <td>
                                            <?php
                                            $str_mota = $ct->getChatLieu();
                                            $parts = explode("&", $str_mota);

                                            if (end($parts) === '') {
                                                array_pop($parts);
                                            }

                                            foreach ($parts as $part) {
                                                echo "<p style=\"width: 150px;\">- $part</p>";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $str_mota = $ct->getKichThuoc();
                                            $parts = explode("-", $str_mota);

                                            if (end($parts) === '') {
                                                array_pop($parts);
                                            }

                                            foreach ($parts as $part) {
                                                echo "<p style=\"width: 100px;\">- $part</p>";
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $ct->getBaoHanh(); ?> Tháng</td>
                                        <td>
                                            <?php
                                            $part = date('d/m/Y', strtotime($ct->getRaMat()));
                                            echo "<p style=\"width: 100px;\">$part</p>";
                                            ?>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='8'>Không có sản phẩm</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Phân trang -->
                <div class="row mt-2">
                    <div class="col-12 text-center pagination">
                        <?php
                        // Tính tổng số trang
                        $totalPages = ceil(count($dsCTSP) / $recordsPerPage);

                        // Hiển thị nút "prev" nếu không phải trang đầu tiên
                        if ($page > 1) {
                            echo "<a href='SanPham.php?ma=$maloai&page=" . ($page - 1) . "' class='btn btn-primary mr-1'><<</a>";
                        }

                        // Hiển thị các trang
                        for ($i = 1; $i <= $totalPages; $i++) {
                            $activeClass = ($i == $page) ? 'active' : '';
                            echo "<a href='SanPham.php?ma=$maloai&page=$i' class='btn btn-primary $activeClass mr-1'>$i</a>"; // Thêm class margin-right
                        }

                        // Hiển thị nút "next" nếu không phải trang cuối cùng
                        if ($page < $totalPages) {
                            echo "<a href='SanPham.php?ma=$maloai&page=" . ($page + 1) . "' class='btn btn-primary'>>></a>";
                        }
                        ?>
                    </div>
                </div>
                <!-- Kết thúc phân trang -->
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