<?php
include('./includeLibrary.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'GET' || $_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['selectedProductId']) && isset($_POST['selectedColorId']) && isset($_POST['selectedPrice'])) {
        $selectedProductId = $_POST['selectedProductId'];
        $selectedColorId = $_POST['selectedColorId'];
        $selectedPrice = $_POST['selectedPrice'];

        if (isset($_SESSION['login'])) {
            $member = $_SESSION['login'];

            $cart = Cart::getCartByMemberId($member->getMaTV());
            if ($cart == null) {
                Cart::addCart($member->getMaTV());
                $cart = Cart::getCartByMemberId($member->getMaTV());
            }

            $flag = false;
            $count = 1;
            $cartDetails = CartDetail::getCartDetailByCartId($cart->getMaGioHang());
            foreach ($cartDetails as $cartDetail) {
                if ($cartDetail->getMaSP() == $selectedProductId && $cartDetail->getMaMau() == $selectedColorId) {
                    $flag = true;
                    $count = $cartDetail->getSoLuong() + 1;
                    break;
                }
            }

            if ($count > 5) {
?>
                <script>
                    alert("Số lượng sản phẩm đã đạt đến mức tối đa.\nĐơn hàng của Quý khách sẽ được phòng bán hàng doanh nghiệp TCT tiếp nhận và hỗ trợ. Liên hệ nhanh:\nEmail: tctphones@gmail.com\nPhone: 0123456789");
                </script>
                <?php
            } else {
                $countOfProduct = Product::getCountOfProductByColor($selectedProductId, $selectedColorId);
                if ($count > $countOfProduct) {
                ?>
                    <script>
                        alert("Số lượng sản phẩm còn lại không đủ.\nQuý khách vui lòng liên hệ nhân viên tư vấn để được hổ trợ.\nXin cảm ơn.");
                    </script>
            <?php
                } else {
                    if ($flag == true) {
                        CartDetail::updateCountCartDetailByProductIdAndColorId($selectedProductId, $selectedColorId, $cart->getMaGioHang(), $count);
                    } else {
                        CartDetail::addCartDetail($cart->getMaGioHang(), $selectedProductId, $count, $selectedPrice, $selectedColorId);
                    }
                }
            }
        } else {
            ?>
            <script>
                window.location.href = "./login.php";
            </script>
<?php
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <title>Chi tiết sản phẩm</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <link href="css/animate.min.css" rel="stylesheet" type="text/css" media="all" /><!-- animation -->
    <link href="css/menu.css" rel="stylesheet" type="text/css" media="all" /> <!-- menu style -->
    <link href="css/owl.carousel.css" rel="stylesheet" type="text/css" media="all"> <!-- carousel slider -->
    <!-- //Custom Theme files -->
    <!-- font-awesome icons -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- //font-awesome icons -->
    <!-- js -->
    <script src="js/jquery-2.2.3.min.js"></script>
    <script src="js/owl.carousel.js"></script>
    <script src="js/bootstrap.js"></script>
    <!--flex slider-->
    <script defer src="js/jquery.flexslider.js"></script>
    <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
    <script>
        // Can also be used with $(document).ready()
        $(window).load(function() {
            $('.flexslider').flexslider({
                animation: "slide",
                controlNav: "thumbnails"
            });
        });
    </script>
    <!--flex slider-->
    <script src="js/imagezoom.js"></script>
    <!-- //js -->
    <!-- web-fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Lovers+Quarrel' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Offside' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Tangerine:400,700' rel='stylesheet' type='text/css'>
    <!-- web-fonts -->
    <!-- scroll to fixed-->
    <script src="js/jquery-scrolltofixed-min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {

            // Dock the header to the top of the window when scrolled past the banner. This is the default behaviour.

            $('.header-two').scrollToFixed();
            // previous summary up the page.

            var summaries = $('.summary');
            summaries.each(function(i) {
                var summary = $(summaries[i]);
                var next = summaries[i + 1];

                summary.scrollToFixed({
                    marginTop: $('.header-two').outerHeight(true) + 10,
                    zIndex: 999
                });
            });
        });
    </script>
    <!-- //scroll to fixed-->
    <!-- start-smooth-scrolling -->
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event) {
                event.preventDefault();
                $('html,body').animate({
                    scrollTop: $(this.hash).offset().top
                }, 1000);
            });
        });
    </script>
    <!-- //end-smooth-scrolling -->
    <!-- smooth-scrolling-of-move-up -->
    <script type="text/javascript">
        $(document).ready(function() {

            var defaults = {
                containerID: 'toTop', // fading element id
                containerHoverID: 'toTopHover', // fading element hover id
                scrollSpeed: 1200,
                easingType: 'linear'
            };

            $().UItoTop({
                easingType: 'easeOutQuart'
            });

        });
    </script>
    <!-- //smooth-scrolling-of-move-up -->
</head>

<body>
    <!-- Header -->
    <?php include('./header.php'); ?>

    <!-- Product details -->
    <?php include('./product_details.php'); ?>

    <!-- Footer -->
    <?php include('./footer.php'); ?>

    <!-- cart-js -->
    <!-- <script src="js/minicart.js"></script>
    <script>
        w3ls.render();

        w3ls.cart.on('w3sb_checkout', function(evt) {
            var items, len, i;

            if (this.subtotal() > 0) {
                items = this.items();

                for (i = 0, len = items.length; i < len; i++) {
                    items[i].set('shipping', 0);
                    items[i].set('shipping2', 0);
                }
            }
        });
    </script> -->
    <!-- //cart-js -->
    <!-- menu js aim -->
    <script src="js/jquery.menu-aim.js"> </script>
    <script src="js/main.js"></script> <!-- Resource jQuery -->
    <!-- //menu js aim -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
</body>

</html>