<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../admin/include_lib.php');

$dh = new donHang();

if (isset($_GET['ma'])) {
    $ma = $_GET['ma'];

    $donHangInfos = $dh->getTTDonChuaDuyet($ma);
}

if (isset($_POST['btn_luuThayDoi'])) {
    $ngDat = $_POST['ngayDat'];
    $ngGiao = $_POST['ngayGiao'];

    if ($ngGiao <= $ngDat) {
        $error_message = "Ngày giao phải lớn hơn ngày đặt.";
    }

    $tt = $_POST['trangThai'];

    if ($tt != 1) {
        $error_message1 = "Vui lòng chọn trạng thái.";
    } else {
        $madh = $_POST['madonhang'];
        $tenTrangThai = "Đã duyệt";
        $tt2 = $_POST['thanhToan'];
        $mail = $_POST['mailnd'];
        $tennd = $_POST['ten'];
        $result = $dh->capNhatDuyetDon($madh, $ngGiao, $tenTrangThai, $tt2, $mail, $tennd);
        $dsDDH = $dh->layTTDDH($ma);

        foreach ($dsDDH as $item) {
            $capnhatsoluongton = $dh->capNhapSLTon($item->getSoLuong(), $item->getMaSP(), $item->getMaMau());
        }
    }
}
?>

<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <?php if (isset($error_message1)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message1; ?>
            </div>
        <?php } ?>
        <?php if (isset($error_message)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php } ?>
        <div class="market-updates">
            <h3 class="mb-4"><a href="DuyetDonHang.php" style="color:black;">Thông tin đơn hàng</a> / Duyệt đơn</h3>
        </div>
        <!-- Menu ngang -->
        <div class="container-fluid bg-white p-4">
            <form method="post">
                <?php if (!empty($donHangInfos)) {
                ?>
                    <div class="table-responsive" style="background-color: #e6f7ff; padding: 10px;">
                        <div class="d-flex flex-wrap">
                            <div class="form-group mr-3 d-inline">
                                <h4 class="mr-2 d-inline">Mã hóa đơn:</h4>
                                <input type="text" class="form-control d-inline" name="madonhang" value="<?php echo $donHangInfos[0]->getMaDDH(); ?>" readonly>
                            </div>

                            <div class="form-group mr-3 d-inline">
                                <h4 class="mr-2 d-inline">Tên khách hàng:</h4>
                                <input type="hidden" class="form-control d-inline" name="mailnd" value="<?php echo $donHangInfos[0]->tv->getEmail(); ?>">
                                <input type="text" class="form-control d-inline" name="ten" value="<?php echo $donHangInfos[0]->ttdh->getHoTen(); ?>" readonly>
                            </div>
                            <div class="form-group mr-3 d-inline">
                                <h4 class="mr-2 d-inline">Ngày đặt hàng:</h4>
                                <input type="text" name="ngayDat" class="form-control d-inline" value="<?php echo $donHangInfos[0]->getNgayDatHang(); ?>" readonly>
                            </div>
                            <div class="form-group mr-3 d-inline">
                                <h4 class="mr-2 d-inline">Ngày giao:</h4>
                                <input type="date" class="form-control d-inline" name="ngayGiao" required>
                            </div>
                            <div class="form-group mr-3 d-inline">
                                <h4 class="mr-2 d-inline">Trạng thái:</h4>
                                <select class="form-control d-inline" name="trangThai" required>
                                    <option value="0" selected>Chưa duyệt</option>
                                    <option value="1">Đã duyệt</option>
                                </select>
                            </div>

                            <div class="form-group mr-3 d-inline">
                                <h4 class="mr-2 d-inline">Thanh toán:</h4>
                                <select class="form-control d-inline" name="thanhToan" required>
                                    <option value="0" <?php if ($donHangInfos[0]->getDaThanhToan() == 0) echo "selected"; ?>>Chưa thanh toán</option>
                                    <option value="1" <?php if ($donHangInfos[0]->getDaThanhToan() == 1) echo "selected"; ?>>Đã thanh toán</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="contentArea">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Mã sản phẩm</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Đơn giá</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($donHangInfos as $donHangInfo) { ?>
                                        <tr>
                                            <td><?php echo $donHangInfo->sp->getMaSP(); ?></td>
                                            <td><?php echo $donHangInfo->sp->getTenSP(); ?></td>
                                            <td><?php echo $donHangInfo->chitietDH->getSoLuong(); ?></td>
                                            <td><?php echo number_format($donHangInfo->chitietDH->getDonGia(), 0, ',', '.') . " VNĐ"; ?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td colspan="4">
                                            <h4 name='<?php echo number_format($donHangInfo->getThanhTien(), 0, ',', '.'); ?> '>
                                                <strong>Tổng tiền: </strong><?php echo number_format($donHangInfos[0]->getThanhTien(), 0, ',', '.') . " VNĐ"; ?>
                                            </h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <button type="submit" class="btn btn-success" name="btn_luuThayDoi">LƯU ĐƠN HÀNG</button>
                                        </td>
                                    </tr>
                                <?php
                            }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
            </form>
        </div>
        <!-- footer -->
        <?php include '../admin/inc/footer.php'; ?>
        <!--main content end-->
        </div>
    </section>
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
<!-- //calendar -->
</body>

</html>