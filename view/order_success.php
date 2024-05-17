<?php
include('./includeLibrary.php');
session_start();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <title>Đặt hàng thành công</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="phone" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- Custom Theme files -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/menu.css" rel="stylesheet" type="text/css" media="all" />
    <!-- menu style -->
    <link href="css/ken-burns.css" rel="stylesheet" type="text/css" media="all" />
    <!-- banner slider -->
    <link href="css/animate.min.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/owl.carousel.css" rel="stylesheet" type="text/css" media="all" />
    <!-- carousel slider -->
    <!-- //Custom Theme files -->
    <!-- font-awesome icons -->
    <link href="css/font-awesome.css" rel="stylesheet" />
    <!-- //font-awesome icons -->
    <!-- js -->
    <script src="js/jquery-2.2.3.min.js"></script>
    <!-- //js -->
    <!-- web-fonts -->
    <link href="//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
    <link href="//fonts.googleapis.com/css?family=Lovers+Quarrel" rel="stylesheet" type="text/css" />
    <link href="//fonts.googleapis.com/css?family=Offside" rel="stylesheet" type="text/css" />
    <link href="//fonts.googleapis.com/css?family=Tangerine:400,700" rel="stylesheet" type="text/css" />
    <!-- web-fonts -->
    <script src="js/owl.carousel.js"></script>
    <script>
        $(document).ready(function() {
            $("#owl-demo").owlCarousel({
                autoPlay: 3000, //Set AutoPlay to 3 seconds
                items: 4,
                itemsDesktop: [640, 5],
                itemsDesktopSmall: [480, 2],
                navigation: true,
            });
        });
    </script>
    <script src="js/jquery-scrolltofixed-min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            // Dock the header to the top of the window when scrolled past the banner. This is the default behaviour.

            $(".header-two").scrollToFixed();
            // previous summary up the page.

            var summaries = $(".summary");
            summaries.each(function(i) {
                var summary = $(summaries[i]);
                var next = summaries[i + 1];

                summary.scrollToFixed({
                    marginTop: $(".header-two").outerHeight(true) + 10,
                    zIndex: 999,
                });
            });
        });
    </script>
    <!-- start-smooth-scrolling -->
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event) {
                event.preventDefault();
                $("html,body").animate({
                        scrollTop: $(this.hash).offset().top
                    },
                    1000
                );
            });
        });
    </script>
    <!-- //end-smooth-scrolling -->
    <!-- smooth-scrolling-of-move-up -->
    <script type="text/javascript">
        $(document).ready(function() {
            var defaults = {
                containerID: "toTop", // fading element id
                containerHoverID: "toTopHover", // fading element hover id
                scrollSpeed: 1200,
                easingType: "linear",
            };

            $().UItoTop({
                easingType: "easeOutQuart"
            });
        });
    </script>
    <!-- //smooth-scrolling-of-move-up -->
    <script src="js/bootstrap.js"></script>

    <!-- Cart -->
    <!--google fonts-->
    <link href="//fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <script src="js/jquery-1.11.0.min.js"></script>

    <script>
        $(document).ready(function(c) {
            $(".close").on("click", function(c) {
                $(".cake-top").fadeOut("slow", function(c) {
                    $(".cake-top").remove();
                });
            });
        });
    </script>

    <script>
        $(document).ready(function(c) {
            $(".close-btm").on("click", function(c) {
                $(".cake-bottom").fadeOut("slow", function(c) {
                    $(".cake-bottom").remove();
                });
            });
        });
    </script>
</head>

<body>
    <!-- Header -->
    <?php include('./header.php'); ?>

    <!-- Breadcrumbs -->
    <div class="container">
        <ol class="breadcrumb breadcrumb1">
            <li><a href="./index.php">Trang chủ</a></li>
            <li class="active">Đặt hàng thành công</li>
        </ol>
        <div class="clearfix"> </div>
    </div>

    <script>
        // Hàm để cập nhật số lượng item trong giỏ hàng
        function updateCartItemCount(cartId) {
            var cartItemCount = document.querySelector('.cart-item-count');
            var data2 = {
                cartId: cartId
            };

            // Thực hiện AJAX request để lấy số lượng item trong giỏ hàng
            $.ajax({
                type: 'POST',
                url: './get_count_product_of_cart.php',
                data: data2,
                success: function(response2) {
                    cartItemCount.textContent = response2;
                },
                error: function(xhr, status, error) {}
            });
        }
    </script>

    <?php
    // xóa item khỏi giỏ hàng
    if (isset($_SESSION['login'])) {
        $member = $_SESSION['login'];
        $cart = Cart::getCartByMemberId($member->getMaTV());
        if ($cart != null) {
            $cartDetails =  CartDetail::getCartDetailByCartIdAndChecked($cart->getMaGioHang());
            if (count($cartDetails) > 0) {
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    if (isset($_POST['customerName'], $_POST['customerPhone'], $_POST['customerEmail'], $_POST['specific-address'], $_POST['province'], $_POST['district'], $_POST['commune'], $_POST['totalPrice'])) {
                        $customerName = $_POST['customerName'];
                        $customerPhone = $_POST['customerPhone'];
                        $customerEmail = $_POST['customerEmail'];

                        $specificAddress = $_POST['specific-address'];
                        $province = $_POST['province'];
                        $district = $_POST['district'];
                        $commune = $_POST['commune'];

                        $address = $specificAddress . ', ' . $commune . ', ' . $district . ', ' . $province;

                        $totalPrice = $_POST['totalPrice'];

                        date_default_timezone_set('Asia/Ho_Chi_Minh');

                        $orderDate = date("Y-m-d H:i:s");

                        $orderInfoId = OrderInformation::insertAndGetPrimaryKeyOrderInformation($customerName, $customerPhone, $customerEmail, $address);
                        $orderId = Order::insertAndGetPrimaryKeyOrder($member->getMaTV(), $orderDate, "Chưa duyệt", $totalPrice, $orderInfoId);

                        foreach ($cartDetails as $cartDetail) {
                            OrderDetail::insertOrderDetail($orderId, $cartDetail->getMaSP(), $cartDetail->getSoLuong(), $cartDetail->getDonGia(), $cartDetail->getMaMau());
                            CartDetail::removeCartDetailByProductIdAndColorId($cartDetail->getMaSP(), $cartDetail->getMaMau(), $cart->getMaGioHang());
                        }

                        $cartId = $cart->getMaGioHang();
                        echo "<script>updateCartItemCount($cartId);</script>";
    ?>
                        <style>
                            .order-details strong {
                                font-weight: normal;
                                color: #189d36;
                            }

                            .order-details p {
                                margin-bottom: 10px;
                                font-weight: bold;
                                color: #155724;
                            }

                            .btn-back {
                                text-align: center;
                                font-weight: bold;
                                border: 1px solid #f44336;
                                outline: none;
                                background-color: #fff;
                                color: #f44336;
                                padding: 10px 20px;
                                display: inline-block;
                                text-decoration: none;
                            }

                            .btn-back:hover {
                                outline: none;
                                border: 1px solid #fff;
                                background-color: #000;
                                color: #fff;
                            }
                        </style>

                        <?php

                        ?>

                        <div style="background-color: #d4edda; border-radius: 10px; padding: 10px; width: 50%; margin-bottom: 20px;" class="container">
                            <h1 style="color: #155724; font-weight: bold; text-align: center">ĐẶT HÀNG THÀNH CÔNG</h1>
                            <div class="order-details">
                                <p><strong>Mã đơn hàng:</strong> <?php echo $orderId ?></p>
                                <p><strong>Người nhận:</strong> <?php echo $customerName ?></p>
                                <p><strong>Số điện thoại:</strong> <?php echo $customerPhone ?></p>
                                <p><strong>Email:</strong> <?php echo $customerEmail ?></p>
                                <p><strong>Địa chỉ nhận hàng:</strong> <?php echo $address ?></p>
                                <p><strong>Hình thức thanh toán:</strong> Thanh toán khi nhận hàng</p>
                                <p><strong>Tổng tiền:</strong> <?php echo number_format($totalPrice, 0, ',', '.') ?> ₫</p>
                            </div>
                            <div style="text-align: center;">
                                <img style="width: 25%;" src="./images/icon/thank-you.png" alt="">
                            </div>
                            <div class="thank-you-message">
                                <p style="color: red; text-align: center; font-weight: bold">Cảm ơn bạn đã tin tưởng và đặt hàng từ chúng tôi!</p>
                            </div>
                        </div>
                <?php

                    }
                }
            } else {
                ?>
                <script>
                    window.location.href = "./index.php";
                </script>
            <?php
            }
        } else {
            ?>
            <script>
                window.location.href = "./index.php";
            </script>
        <?php
        }
    } else {
        ?>
        <script>
            window.location.href = "./login.php";
        </script>
    <?php
    }
    ?>

    <!-- Footer -->
    <?php include('./footer.php'); ?>

    <!-- cart-js -->
    <!-- <script src="js/minicart.js"></script>
    <script>
        w3ls.render();

        w3ls.cart.on("w3sb_checkout", function(evt) {
            var items, len, i;

            if (this.subtotal() > 0) {
                items = this.items();

                for (i = 0, len = items.length; i < len; i++) {
                    items[i].set("shipping", 0);
                    items[i].set("shipping2", 0);
                }
            }
        });
    </script> -->

    <!-- menu js aim -->
    <script src="js/jquery.menu-aim.js"></script>
    <script src="js/main.js"></script>
    <!-- Resource jQuery -->
    <!-- //menu js aim -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
</body>

</html>