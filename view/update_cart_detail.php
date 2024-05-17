<?php
include('./includeLibrary.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cartId = $_POST['cartId'];
    $productId = $_POST['productId'];
    $colorId = $_POST['colorId'];
    $quantity = $_POST['quantity'];

    $countOfProduct = Product::getCountOfProductByColor($productId, $colorId);
    if ($quantity > $countOfProduct) {
        echo "Số lượng sản phẩm còn lại không đủ. Quý khách vui lòng liên hệ nhân viên tư vấn để được hổ trợ. Xin cảm ơn.";
        http_response_code(400);
    } else {
        CartDetail::updateCountCartDetailByProductIdAndColorId($productId, $colorId, $cartId, $quantity);
        $cartDetail = CartDetail::getCartDetailByProductIdAndColorId($productId, $colorId, $cartId);
        echo $cartDetail->getDonGia() * $cartDetail->getSoLuong();
    }
}
