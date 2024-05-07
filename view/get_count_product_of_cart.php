<?php
include('./includeLibrary.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cartId = $_POST['cartId'];
    $count = 0;
    $cartDetails = CartDetail::getCartDetailByCartId($cartId);
    foreach ($cartDetails as $cartDetail) {
        $count += $cartDetail->getSoLuong();
    }
    echo $count;
}
