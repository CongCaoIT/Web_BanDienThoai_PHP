<?php
include('../admin/include_lib.php');

$onlineUsers = Session::countOnlineUsers();

// Helper function to format date
function formatDate($date)
{
	$dateObj = new DateTime($date);
	return $dateObj->format('d/m/Y'); // Desired format: day/month/year
}

// Helper function to format price
function formatPrice($price)
{
	return number_format($price, 0, ',', '.') . ' VND'; // Format with thousands separator and currency
}

$dh = new donHang();
// Gọi hàm showDonDatHang() để lấy mảng đơn hàng đã hoàn thành
$completedOrders = $dh->showDonDatHang();

$totalRevenue = 0;
$totalOrders = count($completedOrders);

// Loop through completed orders to calculate total revenue
foreach ($completedOrders as $order) {
	$totalRevenue += $order->getThanhTien();
}

// Group orders by order ID
$groupedOrders = [];
foreach ($completedOrders as $order) {
	$maDDH = $order->getMaDDH();
	if (!isset($groupedOrders[$maDDH])) {
		$groupedOrders[$maDDH] = [
			'maDDH' => $order->getMaDDH(),
			'maTV' => $order->getMaTV(),
			'ngayDatHang' => $order->getNgayDatHang(),
			'ngayGiao' => $order->getNgayGiao(),
			'sanPham' => [],
		];
	}
	$groupedOrders[$maDDH]['sanPham'][] = [
		'tenSP' => $order->getTenSP(),
		'soLuongNhap' => $order->getSoLuongNhap(),
		'donGia' => $order->getDonGia(),
		'thanhTien' => $order->getThanhTien(),
	];
}
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
						<h4><?php echo formatPrice($totalRevenue); ?></h4>
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
						<h4><?php echo $totalOrders; ?></h4>
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
						// Kiểm tra xem mảng có dữ liệu hay không
						if (!empty($groupedOrders)) {
							// Xác định trang hiện tại
							$page = isset($_GET['page']) ? $_GET['page'] : 1;
							// Số lượng bản ghi trên mỗi trang
							$recordsPerPage = 10;
							// Tính chỉ số bắt đầu và kết thúc của các bản ghi trên trang hiện tại
							$startIndex = ($page - 1) * $recordsPerPage;
							$endIndex = min($startIndex + $recordsPerPage - 1, count($groupedOrders) - 1);

							// Lặp qua mỗi đơn hàng trong mảng và hiển thị thông tin vào các thẻ td
							$i = 0;
							foreach ($groupedOrders as $maDDH => $order) {
								if ($i >= $startIndex && $i <= $endIndex) {
									$sanPhamCount = count($order['sanPham']);
									$isFirstRow = true; // Check if it's the first row for rowspan

									foreach ($order['sanPham'] as $sanPham) {
						?>
										<tr>
											<?php if ($isFirstRow) { ?>
												<td rowspan="<?php echo $sanPhamCount; ?>"><?php echo $order['maDDH']; ?></td>
												<td rowspan="<?php echo $sanPhamCount; ?>"><?php echo $order['maTV']; ?></td>
												<td rowspan="<?php echo $sanPhamCount; ?>"><?php echo formatDate($order['ngayDatHang']); ?></td>
												<td rowspan="<?php echo $sanPhamCount; ?>"><?php echo formatDate($order['ngayGiao']); ?></td>
											<?php } ?>
											<td><?php echo $sanPham['tenSP']; ?></td>
											<td><?php echo $sanPham['soLuongNhap']; ?></td>
											<td><?php echo formatPrice($sanPham['donGia']); ?></td>
											<td><?php echo formatPrice($sanPham['thanhTien']); ?></td>
										</tr>
						<?php
										$isFirstRow = false; // Set to false after the first iteration
									}
								}
								$i++;
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
					$totalPages = ceil(count($groupedOrders) / $recordsPerPage);

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
</section>

<!-- Jquery -->
<script src="js/jquery2.0.3.min.js"></script>
<!-- Bootstrap JS -->
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- Scripts -->
<script src="js/scripts.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/jquery.scrollTo.js"></script>
<!-- Morris Charts JavaScript -->
<script src="js/raphael-min.js"></script>
<script src="js/morris.js"></script>
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