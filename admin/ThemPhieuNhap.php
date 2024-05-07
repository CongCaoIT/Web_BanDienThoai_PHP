<?php
include ('../admin/inc/header.php');
include ('../admin/inc/sidebar.php');
$pn = new phieuNhapController();
$stt = 1;
?>

<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <div class="market-updates">
            <h3 class="mb-4"><a href="NhapKho.php" style="color:black;">Nhập Kho</a> / Phiếu nhập kho</h3>
        </div>
        <!-- Menu ngang -->
        <div class="container-fluid bg-white p-4">
            <div id="contentArea">
                <!-- Nội dung sẽ được thay đổi tại đây -->
                <h2 class="text-center mb-4">Nhập sản phẩm</h2>

                <div class="table-responsive">
                    <form method="post">
                        <div class="form-group">
                            <label for="tenNCC">Nhà cung cấp:</label>
                            <select class="form-control" id="tenNCC" name="tenNCC" required>
                                <option value="" selected disabled>Chọn nhà cung cấp</option>
                                <?php
                                $dsNCC = $pn->showTenNCC();
                                if (!empty($dsNCC)) {
                                    foreach ($dsNCC as $nhaCungCap) {
                                ?>
                                        $mncc = $nhaCungCap->ncc->getMaNCC();
                                        <option value="<?php echo $mncc; ?>"><?php echo $nhaCungCap->ncc->getTenNCC(); ?></option>
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
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Sản phẩm</th>
                                        <th>Đơn giá nhập</th>
                                        <th>Số lượng nhập</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($_POST['btn_laySP'])) {
                                        $dsSP = $pn->getTenSP($_POST['tenNCC']);
                                        if (!empty($dsSP)) {
                                            $tableNotEmpty = isset($_POST['stt_ctpn']) && !empty($_POST['stt_ctpn']);

                                            if ($tableNotEmpty) {
                                                $stt = count($_POST['stt_ctpn']) + 1;
                                            }


                                            echo "<tr>";
                                            echo "<td name='stt_ctpn'>{$stt}</td>";
                                            echo "<td>";
                                            echo "<select class='form-control' name='tenSanPham[]' required>";
                                            foreach ($dsSP as $sanPham) {
                                                $masp = $sanPham->sp->getMaSP();
                                                echo "<option value='{$masp}'>{$sanPham->sp->getTenSP()}</option>";
                                            }
                                            echo "</select>";
                                            echo "</td>";
                                            echo "<td><input type='number' class='form-control' name='donGiaNhap[]' required></td>";
                                            echo "<td><input type='number' class='form-control' name='soLuongNhap[]' required></td>";
                                            echo "<td><button type='button' class='btn btn-danger btn_xoa' onclick='deleteRow(this)'><i class='fa fa-minus-circle'></i></button></td>";
                                            echo "</tr>";
                                            // Tăng số thứ tự nếu bảng đã có dữ liệu
                                            if ($tableNotEmpty) {
                                                $stt++;
                                            }
                                        } else {
                                            echo "<tr><td colspan='5'>Không có sản phẩm.</td></tr>";
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <!-- Nút "Lấy sản phẩm" -->
                            <button type="submit" class="btn btn-success" name="btn_laySP">
                                <i class="fa fa-plus-circle"></i>
                            </button>
                            <!-- Nút "Nhập hàng" -->
                            <button type="submit" class="btn btn-primary" name="btn_nhapHang">NHẬP HÀNG</button>
                        </div>
                    </form>
                </div>
                <!-- footer -->
                <?php
                include '../admin/inc/footer.php';
                ?>
            </div>
        </div>
    </section>
</section>


<script src="js/bootstrap.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>


<script>
    function deleteRow(btn) {
        var row = btn.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }
</script>

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

        //CHARTS
        function gd(year, day, month) {
            return new Date(year, month - 1, day).getTime();
        }

        graphArea2 = Morris.Area({
            element: 'hero-area',
            padding: 10,
            behaveLikeLine: true,
            gridEnabled: false,
            gridLineColor: '#dddddd',
            axes: true,
            resize: true,
            smooth: true,
            pointSize: 0,
            lineWidth: 0,
            fillOpacity: 0.85,
            data: [{
                    period: '2015 Q1',
                    iphone: 2668,
                    ipad: null,
                    itouch: 2649
                },
                {
                    period: '2015 Q2',
                    iphone: 15780,
                    ipad: 13799,
                    itouch: 12051
                },
                {
                    period: '2015 Q3',
                    iphone: 12920,
                    ipad: 10975,
                    itouch: 9910
                },
                {
                    period: '2015 Q4',
                    iphone: 8770,
                    ipad: 6600,
                    itouch: 6695
                },
                {
                    period: '2016 Q1',
                    iphone: 10820,
                    ipad: 10924,
                    itouch: 12300
                },
                {
                    period: '2016 Q2',
                    iphone: 9680,
                    ipad: 9010,
                    itouch: 7891
                },
                {
                    period: '2016 Q3',
                    iphone: 4830,
                    ipad: 3805,
                    itouch: 1598
                },
                {
                    period: '2016 Q4',
                    iphone: 15083,
                    ipad: 8977,
                    itouch: 5185
                },
                {
                    period: '2017 Q1',
                    iphone: 10697,
                    ipad: 4470,
                    itouch: 2038
                },

            ],
            lineColors: ['#eb6f6f', '#926383', '#eb6f6f'],
            xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
            pointSize: 2,
            hideHover: 'auto',
            resize: true
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