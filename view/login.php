<?php
include('./includeLibrary.php');

session_start();
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['isLogout'])) {
        $isLogout = $_GET['isLogout'];
        if ($isLogout == true) {
            unset($_SESSION['login']);
        }
    }
}

$error = null;
$username = "";
$password = "";

if (isset($_COOKIE['username'], $_COOKIE['password'])) {
    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
    }

    $member = Member::getMemberByUsernameAndPassword($username, $password);
    if ($member != null) {
        if (isset($_POST['remember'])) {
            if ($_POST['remember'] == "remember") {
                setcookie("username", $username, time() + (7 * 24 * 60 * 60), "/");
                setcookie("password", $password, time() + (7 * 24 * 60 * 60), "/");
            }
        }
        $_SESSION['login'] = $member;
        header("Location: ./index.php");
        exit;
    } else {
        $error = "Sai tài khoản hoặc mật khẩu!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <title>Đăng nhập</title>
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
    <!-- //Custom Theme files -->
    <!-- font-awesome icons -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- //font-awesome icons -->
    <!-- js -->
    <script src="js/jquery-2.2.3.min.js"></script>
    <script src="js/jquery-scrolltofixed-min.js" type="text/javascript"></script><!-- fixed nav js -->
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
    <!-- //js -->
    <!-- web-fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Lovers+Quarrel' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Offside' rel='stylesheet' type='text/css'>
    <!-- web-fonts -->
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

    <!-- login-page -->
    <div class="login-page">
        <div class="container">
            <h3 class="w3ls-title w3ls-title1">Đăng nhập</h3>
            <div class="login-body">
                <form action="./login.php" method="post">

                    <?php
                    if ($error != null) {
                    ?>
                        <div style="margin-bottom: 20px; padding: 5px; border: 1px solid red">
                            <p style="text-align: left; color: red;"><?php echo $error ?></p>
                        </div>
                    <?php
                    }
                    ?>

                    <input value="<?php echo $username ?>" type="text" class="user" name="username" placeholder="Nhập tài khoản" required="">
                    <input value="<?php echo $password ?>" type="password" name="password" class="lock" placeholder="Nhập mật khẩu" required="">
                    <input type="submit" value="Đăng nhập">
                    <div class="forgot-grid">
                        <label class="checkbox">
                            <input value="remember" type="checkbox" name="remember">
                            <i></i>
                            Ghi nhớ tài khoản
                        </label>
                        <div class="forgot">
                            <a href="#">Quên mật khẩu?</a>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </form>
            </div>
            <h6> Bạn chưa có tài khoản? <a href="./signup.php">Đăng ký ngay »</a> </h6>
            <div class="login-page-bottom social-icons">
                <h5>Khôi phục tài khoản của bạn</h5>
                <ul>
                    <li><a href="#" class="fa fa-facebook icon facebook"> </a></li>
                    <li><a href="#" class="fa fa-twitter icon twitter"> </a></li>
                    <li><a href="#" class="fa fa-google-plus icon googleplus"> </a></li>
                    <li><a href="#" class="fa fa-dribbble icon dribbble"> </a></li>
                    <li><a href="#" class="fa fa-rss icon rss"> </a></li>
                </ul>
            </div>
        </div>
    </div>

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
    <script src="js/bootstrap.js"></script>
</body>

</html>