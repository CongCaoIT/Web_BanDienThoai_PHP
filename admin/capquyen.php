<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../admin/inc/header.php');
include('../admin/inc/sidebar.php');

$dh = new CapQuyen();

if (isset($_GET['ma'])) {
    $ma = $_GET['ma'];
    $Infos = $dh->getTTThanhVien($ma);
}

if (isset($_POST['btn_luuTT'])) {
    $quyen = $_POST['quyen'];
    $result = $dh->capNhatQuyen($ma, $quyen);
}
?>

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
            <h3 class="mb-4"><a href="PhanQuyenPage.php" style="color:black;">Phân Quyền</a> / Cấp quyền</h3>
        </div>
        <div class="container-fluid bg-white p-4">
            <form method="post">
                <?php if (!empty($Infos)) { ?>
                    <?php foreach ($Infos as $Info) { ?>
                        <div class="table-responsive p-3 mb-3" style="background-color: #e6f7ff;">
                            <div class="d-flex flex-wrap">
                                <label for="maTV" class="mr-5">Mã Thành viên: <?php echo $Info->getMaTV(); ?></label>
                                <label for="tenTK" class="mr-5">Tên tài khoản: <?php echo $Info->getHoTen(); ?></label>
                                <div class="form-check form-check-inline mr-5">
                                    <input class="form-check-input" type="radio" id="quyen_admin" name="quyen" value="1" <?php echo ($Info->ltv->getMaLoaiTV() == 1) ? "checked" : ""; ?>>
                                    <label class="form-check-label" for="quyen_admin">Quản trị viên</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="quyen_khachhang" name="quyen" value="2" <?php echo ($Info->ltv->getMaLoaiTV() == 2) ? "checked" : ""; ?>>
                                    <label class="form-check-label" for="quyen_khachhang">Khách hàng</label>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>

                <div class="text-right">
                    <button type="submit" class="btn btn-success" name="btn_luuTT">LƯU</button>
                </div>
            </form>
        </div>

        <?php include '../admin/inc/footer.php'; ?>
    </section>
</section>

<script src="js/bootstrap.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/jquery.scrollTo.js"></script>
<script src="js/monthly.js"></script>
<script>
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

        if (window.location.protocol === 'file:') {
            alert('Just a heads-up, events will not work when run locally.');
        }
    });
</script>
</body>

</html>