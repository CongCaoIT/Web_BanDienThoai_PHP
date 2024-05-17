<?php
include('./includeLibrary.php');
session_start();
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['old-password'], $_POST['new-password'], $_POST['confirm-password'], $_POST['memberId'])) {
        $oldPassword = $_POST['old-password'];
        $newPassword = $_POST['new-password'];
        $confirmPassword = $_POST['confirm-password'];
        $memberId = $_POST['memberId'];

        $member = Member::getMemberByMemberId($memberId);
        if ($member->getMatKhau() === $oldPassword) {
            if (strlen($newPassword) >= 6) {
                if ($newPassword === $confirmPassword) {
                    Member::updatePasswordByMemberId($memberId, $newPassword);
?>
                    <script>
                        window.location.href = "./login.php";
                    </script>
                <?php
                } else {
                ?>
                    <script>
                        alert("Mật khẩu xác nhận không khớp! Vui lòng nhập lại.");
                    </script>
                <?php
                }
            } else {
                ?>
                <script>
                    alert("Mật khẩu phải từ 6 ký tự trở lên! Vui lòng nhập lại.");
                </script>
            <?php
            }
        } else {
            ?>
            <script>
                alert("Mật khẩu hiện tại không chính xác! Vui lòng nhập lại.");
            </script>
<?php
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <title>Đổi mật khẩu</title>
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
            <li class="active">Đổi mật khẩu</li>
        </ol>
        <div class="clearfix"> </div>
    </div>

    <?php
    if (isset($_SESSION['login'])) {
        $member = $_SESSION['login'];
    ?>
        <style>
            .personalInfor h2 {
                color: red;
                text-align: center;
                font-weight: bold;
            }

            .personalInfor input[type="password"] {
                border: 1px solid #ccc;
                padding: 10px;
                border-radius: 5px;
                box-sizing: border-box;
            }

            .personalInfor input[type="password"]:focus {
                border-color: #f44336 !important;
                outline: none;
            }

            .btn-update-password {
                font-weight: bold;
                border: none;
                outline: none;
                background-color: #f44336;
                color: white;
                padding: 10px 20px;
                display: inline-block;
                text-decoration: none;
            }

            .btn-update-password:hover {
                outline: none;
                background-color: #0280e1;
                color: #fff;
            }
        </style>

        <div style="width: 50%;" class="container personalInfor">
            <h2>Tạo mật khẩu mới</h2>
            <form method="post" action="./change_password.php" enctype="multipart/form-data">

                <h3 style="font-weight: bold; margin-bottom: 20px">Nhập mật khẩu hiện tại:</h3>
                <div class="container" style="margin-bottom: 20px; width: 100%">
                    <div style="display: flex; align-items: center; margin-bottom: 10px; " class="row">
                        <label class="col-md-3 col-sm-12" for="old-password">Nhập mật khẩu hiện tại:</label>
                        <input class="col-md-9 col-sm-12" type="password" id="old-password" name="old-password" required>
                    </div>
                </div>

                <hr>

                <h3 style="font-weight: bold; margin-bottom: 20px">Tạo mật khẩu mới:</h3>
                <div class="container" style="margin-bottom: 20px; width: 100%">
                    <div style="display: flex; align-items: center; margin-bottom: 10px; " class="row">
                        <label class="col-md-3 col-sm-12" for="new-password">Nhập mật khẩu mới:</label>
                        <input class="col-md-9 col-sm-12" type="password" id="new-password" name="new-password" required>
                    </div>
                    <div style="display: flex; align-items: center; margin-bottom: 10px; " class="row">
                        <label class="col-md-3 col-sm-12" for="confirm-password">Xác nhận mật khẩu:</label>
                        <input class="col-md-9 col-sm-12" type="password" id="confirm-password" name="confirm-password" required>
                    </div>
                </div>

                <hr>

                <div style="width: 50%; margin: 0 auto; margin-bottom: 20px;">
                    <input hidden name="memberId" value="<?php echo $member->getMaTV() ?>" type="number">
                    <button class="btn-update-password" style="width: 100%; margin-bottom: 10px;" type="submit">CẬP NHẬT MẬT KHẨU</button>
                </div>
            </form>
        </div>
    <?php
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