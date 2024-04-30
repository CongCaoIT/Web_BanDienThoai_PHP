<?php
include '../model/lib/session.php';
$onlineUsers = Session::countOnlineUsers();
?>

<?php
include '../admin/inc/header.php';
include '../admin/inc/sidebar.php';
?>

<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<!-- //market-->
		<div class="market-updates">
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-2">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-eye"> </i>
					</div>
					<div class="col-md-8 market-update-left">
						<h4><?php echo $onlineUsers; ?></h4>
						<p>Số người online</p>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>

			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-1">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-users"></i>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>1</h4>
						<p>Số người truy cập</p>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-3">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-usd"></i>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>0đ</h4>
						<p>Tổng doanh thu</p>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-4">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>0</h4>
						<p>Tổng đơn hàng</p>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
		<!-- //market-->
		<div class="container-fluid bg-white p-4">
			<h2 class="text-center mb-4">Danh sách đơn hàng</h2>
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>Mã đơn hàng</th>
							<th>Mã khách hàng</th>
							<th>Ngày đặt hàng</th>
							<th>Ngày giao hàng</th>
							<th>Tên sản phẩm</th>
							<th>Số lượng</th>
							<th>Đơn giá</th>
							<th>Tổng tiền</th>
						</tr>
					</thead>
					<tbody>
						<?php
						include '../controller/donHang.php';
						$dh = new donHang();
						// Gọi hàm showDonDatHang() để lấy mảng đơn hàng đã hoàn thành
						$completedOrders = $dh->showDonDatHang();

						// Kiểm tra xem mảng có dữ liệu hay không
						if (!empty($completedOrders)) {
							// Xác định trang hiện tại
							$page = isset($_GET['page']) ? $_GET['page'] : 1;
							// Số lượng bản ghi trên mỗi trang
							$recordsPerPage = 2;
							// Tính chỉ số bắt đầu và kết thúc của các bản ghi trên trang hiện tại
							$startIndex = ($page - 1) * $recordsPerPage;
							$endIndex = min($startIndex + $recordsPerPage - 1, count($completedOrders) - 1);

							// Lặp qua mỗi đơn hàng trong mảng và hiển thị thông tin vào các thẻ td
							for ($i = $startIndex; $i <= $endIndex; $i++) {
								$donDatHang = $completedOrders[$i];
						?>
								<tr>
									<td><?php echo $donDatHang->getMaDDH(); ?></td>
									<td><?php echo $donDatHang->getMaTV(); ?></td>
									<td><?php echo $donDatHang->getNgayDatHang(); ?></td>
									<td><?php echo $donDatHang->getNgayGiao(); ?></td>
									<td><?php echo $donDatHang->getTenSP(); ?></td>
									<td><?php echo $donDatHang->getSoLuongNhap(); ?></td>
									<td><?php echo $donDatHang->getDonGia(); ?></td>
									<td><?php echo $donDatHang->getThanhTien(); ?></td>
								</tr>
						<?php
							}
						} else {
							echo "<tr><td colspan='8'>Không có đơn hàng</td></tr>";
						}
						?>
					</tbody>
				</table>
			</div>

			<!-- Phân trang -->
			<div class="row">
				<div class="col-12 text-center pagination">
					<?php
					// Tính tổng số trang
					$totalPages = ceil(count($completedOrders) / $recordsPerPage);

					// Hiển thị nút "prev" nếu không phải trang đầu tiên
					if ($page > 1) {
						echo "<a href='index.php?page=" . ($page - 1) . "' class='btn btn-primary'>Prev</a>";
					}

					// Hiển thị các trang
					for ($i = 1; $i <= $totalPages; $i++) {
						$activeClass = ($i == $page) ? 'active' : '';
						echo "<a href='index.php?page=$i' class='btn btn-primary $activeClass'>$i</a>";
					}

					// Hiển thị nút "next" nếu không phải trang cuối cùng
					if ($page < $totalPages) {
						echo "<a href='index.php?page=" . ($page + 1) . "' class='btn btn-primary'>Next</a>";
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