<?php

include('../admin/include_lib.php');
$sp = new SanPhamAdmin();
$ctsp = new ChiTietSanPhamAdmin();
?>

<style>
    .specification {
        position: relative;
        margin: auto;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        max-width: 700px;
        width: 700px;
        border-radius: 5px;
        display: block;
    }

    .header-specification {
        position: relative;
        text-align: center;
        color: #fff;
        /* Thay đổi màu tiêu đề container thành trắng */
        position: sticky;
        top: 0;
        /* Giữ tiêu đề ở vị trí trên cùng khi cuộn */
        background-color: #1accfd;
        /* Màu nền của tiêu đề */
        margin: 0;
        padding: 10px 0;
        border-radius: 5px;
        font-size: 24px;
        font-weight: 900;
    }

    .close-button {
        position: absolute;
        right: 10px;
        top: 9px;
        font-size: 12px;
        cursor: pointer;
    }

    .group-header {
        background-color: #f2f2f2;
        /* Màu nền cho tiêu đề nhóm */
        color: #000;
        /* Màu tiêu đề nhóm đổi thành đen */
        font-weight: bold;
        font-size: 20px;
    }

    .table-container {
        padding: 20px;
        max-height: 80vh;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .table-specification {
        width: 100%;
        border-collapse: collapse;
    }

    .table-specification,
    .table-specification th,
    .table-specification td {
        border: 1px solid #ddd;
    }

    .table-specification th,
    .table-specification td {
        padding: 12px;
        text-align: left;
    }

    .row-specification {
        background-color: #ffffff;
        /* Màu xám cho hàng chẵn */
    }
</style>

<section id="main-content">
    <section class="wrapper">
        <div class="market-updates">
            <h3 class="mb-2"><a href="SanPham.php?ma=1" style="color:black;">Sản phẩm</a> / Xem chi tiết sản phẩm</h3>
        </div>
        <!-- Menu ngang -->
        <div class="container-fluid bg-white p-4">
            <div id="contentArea">
                <!-- Nội dung sẽ được thay đổi tại đây -->
                <?php
                // Di chuyển câu lệnh echo vào đây
                if (isset($_GET['ma'])) {
                    $masp = $_GET['ma'];
                }
                $dsSanPham = $sp->showSanPhamTheoMaSP($masp);
                $dsCTSP = $ctsp->layCTSPtheoMaSP($masp);
                foreach ($dsSanPham as $sp) {
                ?>
                    <h2 class="text-center mb-3"><?php echo $sp->getTenSP() ?></h2>
                <?php
                }
                ?>
                <div class="specification">
                    <h1 class="header-specification">
                        THÔNG SỐ KỸ THUẬT
                    </h1>
                    <div class="table-container">
                        <table class="table-specification">
                            <?php
                            foreach ($dsCTSP as $ctsp) {
                            ?>
                                <tr class="group-header">
                                    <th colspan="2">Màn hình</th>
                                </tr>
                                <tr class="row-specification">
                                    <td class="col-md-4">Kích thước màn hình</td>
                                    <td class="col-md-8">
                                        <?php echo $ctsp->getKichThuocManHinh() ?>
                                    </td>
                                </tr>
                                <tr class="row-specification">
                                    <td class="col-md-4">Công nghệ màn hình</td>
                                    <td class="col-md-8">
                                        <?php echo $ctsp->getCongNgheManHinh() ?>
                                    </td>
                                </tr>
                                <tr class="row-specification">
                                    <td class="col-md-4">Độ phân giải</td>
                                    <td class="col-md-8">
                                        <?php echo $ctsp->getDoPhanGiai() ?>
                                    </td>
                                </tr>
                                <tr class="row-specification">
                                    <td class="col-md-4">Tính năng</td>
                                    <td class="col-md-8">
                                        <?php echo $ctsp->getTinhNangManHinh() ?>
                                    </td>
                                </tr>
                                <tr class="row-specification">
                                    <td class="col-md-4">Tần số quét</td>
                                    <td class="col-md-8">
                                        <?php echo $ctsp->getTanSoQuet() ?>
                                    </td>
                                </tr>
                                <tr class="group-header">
                                    <th colspan="2">Camera</th>
                                </tr>
                                <tr class="row-specification">
                                    <td class="col-md-4">Camera sau</td>
                                    <td class="col-md-8">
                                        <?php echo $ctsp->getCameraSau() ?>
                                    </td>
                                </tr>
                                <tr class="row-specification">
                                    <td class="col-md-4">Camera trước</td>
                                    <td class="col-md-8">
                                        <?php echo $ctsp->getCameraTruoc() ?>
                                    </td>
                                </tr>
                                <tr class="row-specification">
                                    <td class="col-md-4">Quay phim</td>
                                    <td class="col-md-8">
                                        <?php
                                        $str = $ctsp->getQuayPhim();
                                        $parts = explode(",", $str);

                                        if (end($parts) === '') {
                                            array_pop($parts);
                                        }

                                        foreach ($parts as $part) {
                                            echo $part . "<br>";
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr class="row-specification">
                                    <td class="col-md-4">Tính năng</td>
                                    <td class="col-md-8">
                                        <?php
                                        $str = $ctsp->getTinhNangCamera();
                                        $parts = explode(",", $str);

                                        if (end($parts) === '') {
                                            array_pop($parts);
                                        }

                                        foreach ($parts as $part) {
                                            echo $part . "<br>";
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr class="group-header">
                                    <th colspan="2">Hệ điều hành & CPU</th>
                                </tr>
                                <tr class="row-specification">
                                    <td class="col-md-4">Hệ điều hành</td>
                                    <td class="col-md-8">
                                        <?php echo $ctsp->getHeDieuHanh() ?>
                                    </td>
                                </tr>
                                <tr class="row-specification">
                                    <td class="col-md-4">Chip xử lý (CPU)</td>
                                    <td class="col-md-8">
                                        <?php echo $ctsp->getChip() ?>
                                    </td>
                                </tr>
                                <tr class="row-specification">
                                    <td class="col-md-4">Tốc độ CPU</td>
                                    <td class="col-md-8">
                                        <?php
                                        $str = $ctsp->getTocDoCPU();
                                        $parts = explode(",", $str);

                                        if (end($parts) === '') {
                                            array_pop($parts);
                                        }

                                        foreach ($parts as $part) {
                                            echo $part . "<br>";
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr class="row-specification">
                                    <td class="col-md-4">Chip đồ họa (GPU)</td>
                                    <td class="col-md-8">
                                        <?php echo $ctsp->getChipDoHoa() ?>
                                    </td>
                                </tr>
                                <tr class="group-header">
                                    <th colspan="2">Bộ nhớ & Lưu trữ</th>
                                </tr>
                                <tr class="row-specification">
                                    <td class="col-md-4">Ram</td>
                                    <td class="col-md-8">
                                        <?php echo $ctsp->getRam() ?>
                                    </td>
                                </tr>
                                <tr class="row-specification">
                                    <td class="col-md-4">Dung lượng</td>
                                    <td class="col-md-8">
                                        <?php echo $ctsp->getDungLuong() ?>
                                    </td>
                                </tr>
                                <tr class="group-header">
                                    <th colspan="2">Kết nối</th>
                                </tr>
                                <tr class="row-specification">
                                    <td class="col-md-4">Mạng di động</td>
                                    <td class="col-md-8">
                                        <?php echo $ctsp->getMangDiDong() ?>
                                    </td>
                                </tr>
                                <tr class="row-specification">
                                    <td class="col-md-4">Sim</td>
                                    <td class="col-md-8">
                                        <?php echo $ctsp->getSim() ?>
                                    </td>
                                </tr>
                                <tr class="row-specification">
                                    <td class="col-md-4">Wifi</td>
                                    <td class="col-md-8">
                                        <?php
                                        $str = $ctsp->getWifi();
                                        $parts = explode(",", $str);

                                        if (end($parts) === '') {
                                            array_pop($parts);
                                        }

                                        foreach ($parts as $part) {
                                            echo $part . "<br>";
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr class="row-specification">
                                    <td class="col-md-4">Cổng kết nối/sạc</td>
                                    <td class="col-md-8">
                                        <?php echo $ctsp->getCongKetNoi() ?>
                                    </td>
                                </tr>
                                <tr class="group-header">
                                    <th colspan="2">Pin & Sạc</th>
                                </tr>
                                <tr class="row-specification">
                                    <td class="col-md-4">Mạng di động</td>
                                    <td class="col-md-8">
                                        <?php echo $ctsp->getMangDiDong() ?>
                                    </td>
                                </tr>
                                <tr class="row-specification">
                                    <td class="col-md-4">Loại pin</td>
                                    <td class="col-md-8">
                                        <?php echo $ctsp->getLoaiPin() ?>
                                    </td>
                                </tr>
                                <tr class="row-specification">
                                    <td class="col-md-4">Hỗ trợ sạc tối đa</td>
                                    <td class="col-md-8">
                                        <?php echo $ctsp->getHoTroSac() ?>
                                    </td>
                                </tr>
                                <tr class="group-header">
                                    <th colspan="2">Tiện ích</th>
                                </tr>
                                <tr class="row-specification">
                                    <td class="col-md-4">Bảo mật nâng cao</td>
                                    <td class="col-md-8">
                                        <?php echo $ctsp->getBaoMat() ?>
                                    </td>
                                </tr>
                                <tr class="row-specification">
                                    <td class="col-md-4">Tính năng đặc biệt</td>
                                    <td class="col-md-8">
                                        <?php
                                        $str = $ctsp->getTinhNangDacBiet();
                                        $parts = explode(",", $str);

                                        if (end($parts) === '') {
                                            array_pop($parts);
                                        }

                                        foreach ($parts as $part) {
                                            echo $part . "<br>";
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr class="row-specification">
                                    <td class="col-md-4">Kháng nước, bụi</td>
                                    <td class="col-md-8">
                                        <?php echo $ctsp->getKhangNuoc() ?>
                                    </td>
                                </tr>
                                <tr class="group-header">
                                    <th colspan="2">Thông tin chung</th>
                                </tr>
                                <tr class="row-specification">
                                    <td class="col-md-4">Thiết kế</td>
                                    <td class="col-md-8">
                                        <?php echo $ctsp->getThietKe() ?>
                                    </td>
                                </tr>
                                <tr class="row-specification">
                                    <td class="col-md-4">Chất liệu</td>
                                    <td class="col-md-8">
                                        <?php echo $ctsp->getChatLieu() ?>
                                    </td>
                                </tr>
                                <tr class="row-specification">
                                    <td class="col-md-4">Kích thước, khối lượng</td>
                                    <td class="col-md-8">
                                        <?php echo $ctsp->getKichThuoc() ?>
                                    </td>
                                </tr>
                                <tr class="row-specification">
                                    <td class="col-md-4">Bảo hành</td>
                                    <td class="col-md-8">
                                        <div><?php echo $ctsp->getBaoHanh() ?></div>
                                    </td>
                                </tr>
                                <tr class="row-specification">
                                    <td class="col-md-4">Thời điểm ra mắt</td>
                                    <td class="col-md-8">
                                        <?php
                                        $ngayRaMat = $ctsp->getRaMat();
                                        $timestamp = strtotime($ngayRaMat);
                                        $ngayRaMatFormatted = date("d/m/Y", $timestamp);
                                        echo $ngayRaMatFormatted;
                                        ?>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
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