<?php
include '../controller/adminlogin.php';
Session::checkLogin();
$class = new adminlogin();
if (isset($_POST['login'])) {
	$adminUser = $_POST['adminUser'];
	$adminPass = $_POST['adminPass'];
	$login_check = $class->login_admin($adminUser, $adminPass);
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
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
	<style>
		.log-w3 {
			text-align: center;
		}
	</style>
</head>

<body>
	<div class="log-w3">
		<div class="w3layouts-main">
			<h2>ĐĂNG NHÂP</h2>
			<div class="text-center" style="color: red;">
				<?php
				if (isset($login_check)) {
					echo $login_check; // xuất ra thông báo nếu nhập sai 
				}
				?>
			</div>
			<form method="post">
				<input type="text" class="ggg" placeholder="Username" name="adminUser" required="">
				<input type="password" class="ggg" placeholder="Password" name="adminPass" required="">
				<span><input type="checkbox" /> Nhớ Mật Khẩu</span>
				<h6><a href="ForgotPass.php">Quên Mật Khẩu?</a></h6>
				<div class="clearfix"></div>
				<input type="submit" value="Sign In" name="login">
			</form>
			<p>Bạn chưa có tài khoản?<a href="registration.php">Tạo tài khoản</a></p>
		</div>
	</div>
	<script src="js/bootstrap.js"></script>
	<script src="js/jquery.dcjqaccordion.2.7.js"></script>
	<script src="js/scripts.js"></script>
	<script src="js/jquery.slimscroll.js"></script>
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/jquery.scrollTo.js"></script>
</body>

</html>