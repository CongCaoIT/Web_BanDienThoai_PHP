<?php
include('../admin/inc/header.php');
include('../admin/inc/sidebar.php');
$sp = new SanPhamAdmin();
$mauclass = new MauAdmin();
if (isset($_POST['btnLuuMau'])) {
    $masp = $_GET['ma'];
    $mamau = isset($_POST['MaMau']) ? (int)$_POST['MaMau'] : 0;
    $mamau2 = isset($_POST['MaMau2']) ? (int)$_POST['MaMau2'] : 0;

    $result1 = $mauclass->themMau($masp, $mamau);
    $result2 = $mauclass->themMau($masp, $mamau2);

    if ($result1 && $result2) {
        echo "<script>alert('Thêm màu thành công!');</script>";
        echo "<script>window.location.href = 'SanPham.php?ma=1';</script>";
        exit();
    } else {
        echo "Insert failed!";
    }
}
?>

<section id="main-content">
    <section class="wrapper">
        <div class="market-updates">
            <h3 class="mb-2"><a href="SanPham.php?ma=1" style="color:black;">Sản phẩm</a> / Thêm màu</h3>
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
                $dsMau = $mauclass->layDSMau();
                foreach ($dsSanPham as $sp) {
                ?>
                    <h2 class="text-center mb-2"><?php echo $sp->getTenSP() ?></h2>
                <?php
                }
                ?>
                <div class="table-responsive">
                    <form method="POST">
                        <div class="container mt-3">
                            <div class="row">
                                <?php
                                foreach ($dsSanPham as $sp) {
                                ?>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <img src="../view/images/products/<?php echo $sp->getHinhAnh() ?>" class="card-img-top img-fluid ">
                                            <div class="card-body">
                                                <h2 class="card-title  text-center"><?php echo $sp->getHinhAnh() ?></h2>
                                                <label class="mb10">Vui lòng chọn màu</label>
                                                <select class="form-control" name="MaMau" id="color">
                                                    <?php
                                                    foreach ($dsMau as $mau) {
                                                    ?>
                                                        <option value="<?php echo $mau->getMaMau() ?>"><?php echo $mau->getTenMau() ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <img src="../view/images/products/<?php echo $sp->getHinhAnh2() ?>" class="card-img-top img-fluid ">
                                            <div class="card-body">
                                                <h2 class="card-title  text-center"><?php echo $sp->getHinhAnh2() ?></h2>
                                                <label class="mb10">Vui lòng chọn màu</label>
                                                <select class="form-control" name="MaMau2" id="color">
                                                    <?php
                                                    foreach ($dsMau as $mau) {
                                                    ?>
                                                        <option value="<?php echo $mau->getMaMau() ?>"><?php echo $mau->getTenMau() ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                }
                                ?>
                            </div>
                            <div class="container mt-3">
                                <input type="submit" value="Lưu" class="btn btn-primary" style="margin-left: 14px;" id="btnLuuMau" name="btnLuuMau" />
                            </div>
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