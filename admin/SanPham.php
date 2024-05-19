<?php
include('../admin/include_lib.php');

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$dh = new SanPhamAdmin();
$mauclass = new MauAdmin();
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
		text-align: center;
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

<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<div class="market-updates">
			<h3 class="mb-2"><a href="SanPham.php?ma=1" style="color:black;">Sản phẩm</a> / Danh sách</h3>
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
				<h2 class="text-center mb-2">DANH SÁCH SẢN PHẨM</h2>
				<button class="btn btn-success mb-2">
					<a href="themSP.php" style="color: white;">
						<i class="fa fa-plus-circle"></i> THÊM SẢN PHẨM
					</a>
				</button>
				<div class="table-responsive">
					<table>
						<thead>
							<tr>
								<th>Mã SP</th>
								<th>Tên SP</th>
								<th>Đơn Giá</th>
								<th>Giá bán hiện tại</th>
								<th>Khuyến Mãi</th>
								<th>Ngày Cập Nhật</th>
								<th>Mô Tả</th>
								<th>Hình 1</th>
								<th>Hình 2</th>
								<th>Số lần mua</th>
								<th>Mới</th>
								<th>Đã Xóa</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php
							$dsSanPham = $dh->showSanPham($maloai);
							$recordsPerPage = 7;
							if (!empty($dsSanPham)) {
								$startIndex = ($page - 1) * $recordsPerPage;
								$endIndex = min($startIndex + $recordsPerPage - 1, count($dsSanPham) - 1);

								for ($i = $startIndex; $i <= $endIndex; $i++) {
									$sp = $dsSanPham[$i];
									$phantramkhuyenmai = $dh->layKhuyenMaitheoMaSP($sp->getMaSP());
									$dsMau = $mauclass->layTenMauSPtheoMaSP($sp->getMaSP());
									$dsSLT = $mauclass->laySLTSPtheoMaSP($sp->getMaSP());

									$isFirstColor = true;
									if ($sp->getMaKhuyenMai() != null) {
										$promotionInfo = $dh->layThongTinKhuyenMaiTheoMa($sp->getMaKhuyenMai());
										$ngayBatDau = $promotionInfo['NgayBatDau'];
										$ngayKetThuc = $promotionInfo['NgayKetThuc'];
										if ($phantramkhuyenmai != null && date('Y-m-d') >= $ngayBatDau && date('Y-m-d') <= $ngayKetThuc) {
											$giahientai = $sp->getDonGia() - ($sp->getDonGia() * $phantramkhuyenmai / 100);
										} else {
											$giahientai = $sp->getDonGia();
										}
									} else {
										$giahientai = $sp->getDonGia();
									}
							?>
									<tr>
										<td><?php echo $sp->getMaSP(); ?></td>
										<td style="text-align: left;"><?php echo $sp->getTenSP(); ?></td>
										<td>
											<?php
											if ($sp->getDonGia() == null) {
											?>
												<a href="themPN.php?ma=<?php echo $sp->getMaSP(); ?>">Thêm phiếu nhập</a>
											<?php
											} else {
												echo number_format($sp->getDonGia(), 0, ',', '.') . '₫';
											}
											?>
											<br>
											<a href="themPN.php?ma=<?php echo $sp->getMaSP(); ?>">Thêm phiếu nhập</a>
										</td>
										<td style="color: red;">
											<?php
											if ($sp->getDonGia() == null) {
											?>
												<a href="themPN.php?ma=<?php echo $sp->getMaSP(); ?>">Thêm phiếu nhập</a>
											<?php
											} else {
											?>
												<strong>
													<?php
													echo number_format($giahientai, 0, ',', '.') . '₫';
													?>
												</strong>
											<?php
											}
											?>
											<br>
											<a href="themPN.php?ma=<?php echo $sp->getMaSP(); ?>">Thêm phiếu nhập</a>
										</td>
										<td>
											<?php
											if ($phantramkhuyenmai != null && date('Y-m-d') >= $ngayBatDau && date('Y-m-d') <= $ngayKetThuc) {
												echo $phantramkhuyenmai . "%";
											} else {
											?>
												<a href="themKM.php?ma=<?php echo $sp->getMaSP(); ?>">Chương trình khuyến mãi</a>
											<?php
											}
											?>
										</td>
										<td><?php echo date('d/m/Y', strtotime($sp->getNgayCapNhat())); ?></td>
										<td style="text-align: left;">
											<?php
											$str_mota = $sp->getMoTa();
											$parts = explode(".", $str_mota);

											if (end($parts) === '') {
												array_pop($parts);
											}

											foreach ($parts as $part) {
												echo "<p>- $part.</p>";
											}
											?>
										</td>

										<?php
										if ($dsMau != null) {
											foreach ($dsMau as $index => $mau) {
										?>
												<td>
													<img src="../view/images/products/<?php echo ($isFirstColor ? $sp->getHinhAnh() : $sp->getHinhAnh2()) ?>" alt="" width="120px">
													<br />
													<p style="margin-top: 24px; font-size: 16px;">Màu: <span style="color: red; font-weight: bold;"><?php echo $mau->getTenMau() ?></span></p>
													<p style="margin-top: 8px; font-size: 16px;">Số lượng: <span style="color: red; font-weight: bold;"><?php echo $dsSLT[$index]->getSoLuongTon() ?></span></p>
												</td>
											<?php
												$isFirstColor = !$isFirstColor;
											}
										} else {
											if ($dsSLT != null) {
											?>
												<td>
													<img src="../view/images/products/<?php echo $sp->getHinhAnh() ?>" alt="" width="120px">
													<br />
													<p style="margin-top: 24px; font-size: 16px;"><a href="themMau.php?ma=<?php echo $sp->getMaSP() ?>">Thêm màu</a></p>
													<p style="margin-top: 8px; font-size: 16px;">Số lượng: <span style="color: red; font-weight: bold;"><?php echo $dsSLT[0]->getSoLuongTon() ?></span></p>
												</td>
												<td>
													<img src="../view/images/products/<?php echo $sp->getHinhAnh2() ?>" alt="" width="120px">
													<br />
													<p style="margin-top: 24px; font-size: 16px;"><a href="themMau.php?ma=<?php echo $sp->getMaSP() ?>">Thêm màu</a></p>
													<p style="margin-top: 8px; font-size: 16px;">Số lượng: <span style="color: red; font-weight: bold;"><?php echo $dsSLT[1]->getSoLuongTon() ?></span></p>
												</td>
											<?php
											} else {
											?>
												<td>
													<img src="../view/images/products/<?php echo $sp->getHinhAnh() ?>" alt="" width="120px">
													<br />
													<p style="margin-top: 24px; font-size: 16px;"><a href="themMau.php?ma=<?php echo $sp->getMaSP() ?>">Thêm màu</a></p>
													<p style="margin-top: 8px; font-size: 16px;">Số lượng: <span style="color: red; font-weight: bold;">0</span></p>
												</td>
												<td>
													<img src="../view/images/products/<?php echo $sp->getHinhAnh2() ?>" alt="" width="120px">
													<br />
													<p style="margin-top: 24px; font-size: 16px;"><a href="themMau.php?ma=<?php echo $sp->getMaSP() ?>">Thêm màu</a></p>
													<p style="margin-top: 8px; font-size: 16px;">Số lượng: <span style="color: red; font-weight: bold;">0</span></p>
												</td>
										<?php
											}
										}
										?>

										<td>
											<?php
											if ($sp->getSoLanMua() == 0) {
												echo "0";
											} else {
												echo $sp->getSoLanMua();
											}
											?>
										</td>

										<td>
											<?php
											if ($sp->getMoi() == 1) {
												echo "Hàng mới";
											} else {
												echo "Hàng cũ";
											}
											?>
										</td>
										<td>
											<?php
											if ($sp->getDaXoa() == 0) {
												echo "Còn hàng";
											} else {
												echo "Hết hàng";
											}
											?>
										</td>
										<td>
											<!-- Nút "Thêm" -->
											<a href="themCTSP.php?ma=<?php echo $sp->getMaSP() ?>" class="btn btn-primary">
												<span style="color: #ffffff" class="glyphicon glyphicon-plus"></span>
											</a>

											<!-- Nút "Sửa" -->
											<a href="suaSP.php?ma=<?php echo $sp->getMaSP() ?>" class="btn btn-warning mt-1">
												<span style="color: #ffffff" class="glyphicon glyphicon-pencil"></span>
											</a>

											<!-- Nút "Xóa" -->
											<a href="#" class="btn btn-danger mt-1 delete-product" data-masp="<?php echo $sp->getMaSP() ?>">
												<span style="color: #ffffff" class="glyphicon glyphicon-trash"></span>
											</a>

											<!-- Nút "Xem" -->
											<a href="../admin/XemChiTietSanPham.php?ma=<?php echo $sp->getMaSP() ?>" id="showSpecifications" class="btn btn-info mt-1">
												<span style="color: #ffffff" class="glyphicon glyphicon-eye-open"></span>
											</a>
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
						$totalPages = ceil(count($dsSanPham) / $recordsPerPage);

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

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		$(document).ready(function() {
			$(".delete-product").click(function(e) {
				e.preventDefault(); // Ngăn chặn hành động mặc định của thẻ a

				if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
					var masp = $(this).data('masp');
					$.ajax({
						type: 'GET',
						url: 'xoaSanPham.php?ma=' + masp,
						success: function(response, textStatus, xhr) {
							if (xhr.status == 200) {
								alert('Xóa sản phẩm thành công!');
								// Cập nhật giao diện người dùng tại đây nếu cần
								window.location.reload();
							} else {
								alert('Xóa sản phẩm thất bại!');
							}
						},
						error: function() {
							alert('Có lỗi xảy ra khi xóa sản phẩm!');
						}
					});
				}
			});
		});
	</script>
</section>