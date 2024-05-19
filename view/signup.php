<?php
include('./includeLibrary.php');
session_start();
?>

<?php
$error = null;
$username = "";
$email = "";
$password = "";
$rePassword = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['rePassword'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $rePassword = $_POST['rePassword'];

        $checkUsername = Member::checkUsernameAlreadyExists($username);
        if ($checkUsername) {
            $error = "Tên tài khoản đã tồn tại. Vui lòng nhập tên tài khoản khác!";
        }

        $checkEmail = Member::checkEmailAlreadyExists($email);
        if ($checkEmail) {
            $error = "Email đã tồn tại. Vui lòng nhập email khác!";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error =  "Địa chỉ email không hợp lệ. Vui lòng nhập đúng định dạng email!";
        }

        if (strlen($password) < 6) {
            $error = "Mật khẩu phải từ 6 ký tự trở lên. Vui lòng nhập lại mật khẩu!";
        }

        if ($password !== $rePassword) {
            $error = "Mật khẩu xác nhận không khớp. Vui lòng nhập lại!";
        }

        if ($error == null) {
            $result = Member::addMember($username, $email, $password);
            if ($result == true) {
                header("Location: ./login.php");
                exit;
            } else {
                $error = "Đăng ký tài khoản không thành công!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <title>Đăng ký</title>
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

    <!-- sign up-page -->
    <div class="login-page">
        <div class="container">
            <h3 class="w3ls-title w3ls-title1">Đăng ký</h3>

            <div class="login-body">
                <form action="#" method="post">

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
                    <input value="<?php echo $email ?>" type="text" class="user" name="email" placeholder="Nhập email" required="">
                    <input type="password" name="password" class="lock" placeholder="Nhập mật khẩu" required="">
                    <input type="password" name="rePassword" class="lock" placeholder="Nhập lại mật khẩu" required="">
                    <input type="submit" value="Đăng ký">
                    <div class="forgot-grid">
                        <!-- <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Nhớ tài khoản</label> -->
                        <div class="forgot">
                            <a href="#">Quên mật khẩu?</a>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </form>
            </div>
            <h6>Bạn đã có tài khoản? <a href="./login.php">Đăng nhập ngay »</a> </h6>
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