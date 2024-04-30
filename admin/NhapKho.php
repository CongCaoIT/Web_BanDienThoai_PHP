<?php
include '../admin/inc/header.php';
include '../admin/inc/sidebar.php';

// Đảm bảo rằng biến $page được khởi tạo
$page = isset($_GET['page']) ? $_GET['page'] : 1;

?>
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<div class="market-updates">
			<h3 class="mb-4"><a href="NhapKho.php" style="color:black;">Nhập Kho</a> / Danh sách phiếu nhập</h3>
		</div>
		<!-- Menu ngang -->
		<div class="container-fluid bg-white p-4">
			<div id="contentArea">
				<!-- Nội dung sẽ được thay đổi tại đây -->
				<h2 class="text-center mb-4">Danh sách nhập kho</h2>

				<div class="input-group mb-3">
					<div class="col-md-3 ">
						<button class="btn btn-success">
							<a href="ThemPhieuNhap.php" style="color: white;">
								<i class="fa fa-plus-circle"></i> THÊM PHIẾU NHẬP KHO
							</a>
						</button>
					</div>
					<div class="col-md-5"></div>
					<div class="col-md-4">
						<input type="text" class="form-control" style="width: 450px;" placeholder="Tìm tên sản phẩm hoặc tên nhà cung cấp..."> 
						<div class="input-group-append">
							<button class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
						</div>
					</div>
				</div>


				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>Mã phiếu nhập</th>
								<th>Tên nhà cung cấp</th>
								<th>Tên sản phẩm</th>
								<th>Ngày nhập</th>
								<th>Đơn giá nhập</th>
								<th>Số lượng nhập</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php 
							include '../controller/phieuNhapController.php';
							$dh = new phieuNhapController();
							$dsPhieuNhap = $dh->showDSPhieuNhap();

							$recordsPerPage = 2;
							if (!empty($dsPhieuNhap)) {
								$startIndex = ($page - 1) * $recordsPerPage;
								$endIndex = min($startIndex + $recordsPerPage - 1, count($dsPhieuNhap) - 1);

								for ($i = $startIndex; $i <= $endIndex; $i++) {
									$pn = $dsPhieuNhap[$i];
							?>
									<tr>
										<td><?php echo $pn->getMaPN(); ?></td>
										<td><?php echo $pn->ncc->getTenNCC(); ?></td>
										<td><?php echo $pn->sp->getTenSP(); ?></td>
										<td><?php echo $pn->pn->getNgayNhap(); ?></td>
										<td><?php echo $pn->getDonGiaNhap(); ?></td>
										<td><?php echo $pn->getSoLuongNhap(); ?></td>
									</tr>
							<?php
								}
							} else {
								echo "<tr><td colspan='8'>Không có phiếu nhập</td></tr>";
							}
							?>
						</tbody>
					</table>
				</div>

				<!-- Phân trang -->
				<div class="row">
					<div class="col-12 text-center pagination">
						<?php
						$totalPages = ceil(count($dsPhieuNhap) / $recordsPerPage);

						if ($page > 1) {
							echo "<a href='NhapKho.php?page=" . ($page - 1) . "' class='btn btn-primary'>Prev</a>";
						}

						// Hiển thị các trang
						for ($i = 1; $i <= $totalPages; $i++) {
							$activeClass = ($i == $page) ? 'active' : '';
							echo "<a href='NhapKho.php?page=$i' class='btn btn-primary $activeClass'>$i</a>";
						}

						// Hiển thị nút "next" nếu không phải trang cuối cùng
						if ($page < $totalPages) {
							echo "<a href='NhapKho.php?page=" . ($page + 1) . "' class='btn btn-primary'>Next</a>";
						}
						?>
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