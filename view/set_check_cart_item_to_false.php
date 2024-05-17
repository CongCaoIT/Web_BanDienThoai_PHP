<?php
include('./includeLibrary.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $cartDetail = CartDetail::setCheckToFalse();
}
