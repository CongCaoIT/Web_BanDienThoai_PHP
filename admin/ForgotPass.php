<?php
include '../controller/ad_ForgotPass.php';
$class = new ad_ForgotPass();
if (isset($_POST['ForgotPass'])) {
    $ma1 = $_POST['VerificationCode'];
    $ma2 = $_POST['VerCode'];
    if (strcasecmp($ma1, $ma2) === 0) {
        $ad_mail = $_POST['Email'];
        $pass_check = $class->ad_ForgotPass($ad_mail);
    } else {
        $loi = "Mã xác nhận không khớp. Vui lòng nhập lại.";
        echo '<script>refreshCode();</script>';
    }
}
?>

<!DOCTYPE html>

<head>
    <title>Forgot Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/style-responsive.css" rel="stylesheet" />
    <!-- font CSS -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="css/font.css" type="text/css" />
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- //font-awesome icons -->
    <script src="js/jquery2.0.3.min.js"></script>
</head>

<body>
    <div class="reg-w3">
        <div class="w3layouts-main">
            <h2>QUÊN MẬT KHẨU</h2>
            <?php if (isset($loi)) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $loi; ?>
                </div>
            <?php } ?>
            <?php if (isset($pass_check)) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $pass_check; ?>
                </div>
            <?php } ?>
            <form method="post">
                <input type="email" class="ggg" name="Email" placeholder="E-MAIL" required="">
                <input type="text" id="verificationCode" name="VerificationCode" required="" readonly>
                <button type="button" onclick="refreshCode()">Làm mới mã</button>
                <input type="text" class="ggg" name="VerCode" placeholder="NHẬP MÃ" required="">

                <div class="clearfix"></div>
                <input type="submit" value="Gửi yêu cầu" name="ForgotPass">
            </form>
        </div>
    </div>
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/jquery.nicescroll.js"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    <script src="js/jquery.scrollTo.js"></script>
    <script>
        function generateCode() {
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var code = '';
            for (var i = 0; i < 5; i++) {
                code += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            document.getElementById('verificationCode').value = code;
        }

        function refreshCode() {
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var code = '';
            for (var i = 0; i < 5; i++) {
                code += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            document.getElementById('verificationCode').value = code;
        }

        window.onload = generateCode;
    </script>
</body>

</html>