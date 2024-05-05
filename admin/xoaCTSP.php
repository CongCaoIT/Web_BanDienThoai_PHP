<?php
include '../admin/inc/header.php';
include '../admin/inc/sidebar.php';
include '../controller/Admin/ChiTietSanPhamController.php';

$ctsp = new ChiTietSanPhamAdmin();
// Kiểm tra xem yêu cầu đã được gửi bằng phương thức POST chưa
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Kiểm tra xem biến ma có tồn tại trong yêu cầu không
    if (isset($_GET['ma'])) {
        // Lấy mã sản phẩm từ yêu cầu
        $mactsp = $_GET['ma'];

        // Thực hiện xóa sản phẩm với mã sản phẩm nhận được
        $xoaThanhCong = $ctsp->xoaChiTietSanPham($mactsp);
        // Trả về mã trạng thái HTTP tương ứng
        http_response_code($xoaThanhCong ? 200 : 500);
    } else {
        // Nếu biến ma không tồn tại trong yêu cầu, trả về mã trạng thái HTTP 400 (Bad Request)
        http_response_code(400);
    }
} else {
    // Nếu yêu cầu không phải là phương thức GET, trả về mã trạng thái HTTP 405 (Method Not Allowed)
    http_response_code(405);
}
