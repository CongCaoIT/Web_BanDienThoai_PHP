<?php
include('./includeLibrary.php');
session_start();
?>

<?php
$check = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['avartar'], $_POST['memberId'])) {
        $memberId = $_POST['memberId'];
        if ($_FILES['avartar']['name'] != null) {
            if ($_FILES['avartar']['type'] == 'image/jpeg' || $_FILES['avartar']['type'] == 'image/png' || $_FILES['avartar']['type'] == 'image/gif') {
                $path = "./images/avatar/";
                $tmpName = $_FILES["avartar"]["tmp_name"];
                $avatarName = $_FILES["avartar"]["name"];
                move_uploaded_file($tmpName, $path . $avatarName);

                Member::updateAvatarMemberById($memberId, $avatarName);
                $_SESSION['login'] = Member::getMemberByMemberId($memberId);
                $check = true;
            }
        }
    }

    if (isset($_POST['memberId'], $_POST['fullname'], $_POST['phone'], $_POST['email'], $_POST['specific-address'], $_POST['province'], $_POST['district'], $_POST['commune'])) {
        $memberId = $_POST['memberId'];
        $name = $_POST['fullname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];

        $specificAddress = $_POST['specific-address'];
        $province = $_POST['province'];
        $district = $_POST['district'];
        $commune = $_POST['commune'];

        $address = $specificAddress . ', ' . $commune . ', ' . $district . ', ' . $province;

        $result = Member::updateMemberById($memberId, $name, $address, $email, $phone);
        $_SESSION['login'] = Member::getMemberByMemberId($memberId);
        $check = true;
    }

    if ($check == true) {
?>
        <script>
            alert("Cập nhật thông tin thành công.");
        </script>
<?php
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <title>Thông tin cá nhân</title>
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
            <li class="active">Thông tin cá nhân</li>
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

            .personalInfor input[type="text"],
            .personalInfor input[type="number"],
            .personalInfor input[type="file"],
            .personalInfor input[type="email"],
            .personalInfor select {
                border: 1px solid #ccc;
                padding: 10px;
                border-radius: 5px;
                box-sizing: border-box;
            }

            .personalInfor input[type="text"]:focus,
            .personalInfor input[type="number"]:focus,
            .personalInfor input[type="file"]:focus,
            .personalInfor input[type="email"]:focus,
            .personalInfor select:focus {
                border-color: #f44336 !important;
                outline: none;
            }

            .btn-update {
                font-weight: bold;
                border: none;
                outline: none;
                background-color: #f44336;
                color: white;
                padding: 10px 20px;
                display: inline-block;
                text-decoration: none;
            }

            .btn-update:hover {
                outline: none;
                background-color: #0280e1;
                color: #fff;
            }

            .changePassword {
                text-align: center;
                font-weight: bold;
                border: none;
                outline: none;
                background-color: #f44336;
                color: #fff;
                padding: 10px 20px;
                display: inline-block;
                text-decoration: none;
            }

            .changePassword:hover {
                outline: none;
                background-color: #0280e1;
                color: #fff;
            }

            .avatar-container {
                margin-bottom: 10px;
                text-align: center;
            }

            .custom-file-upload {
                border: 1px solid #ccc;
                display: inline-block;
                padding: 6px 12px;
                cursor: pointer;
            }

            .custom-file-upload:hover {
                background: rgba(0, 0, 0, .02);
            }
        </style>

        <div style="width: 50%;" class="container personalInfor">
            <h2>Hồ sơ của bạn</h2>
            <form method="post" action="./personal_information.php" enctype="multipart/form-data">

                <h3 style="font-weight: bold; margin-bottom: 20px">Thông tin của bạn:</h3>
                <div class="container" style="margin-bottom: 20px; width: 100%">
                    <div class="avatar-container">
                        <img id="imgAvartar" src="./images/avatar/<?php echo $member->getHinhDaiDien() ?>" alt="Ảnh Đại Diện" style="width: 100px; max-height: 100px; display: block; margin: 0 auto; border-radius: 50%; margin-bottom: 10px" />
                        <input type="file" class="form-control-file" id="avartar" name="avartar" style="display: none;" accept="image/*">
                        <label for="avartar" class="custom-file-upload">
                            Chọn ảnh
                        </label>
                    </div>

                    <div style="display: flex; align-items: center; margin-bottom: 10px; " class="row">
                        <label class="col-md-2 col-sm-12" for="fullname">Họ tên:</label>
                        <input class="col-md-10 col-sm-12" type="text" id="fullname" name="fullname" value="<?php if ($member->getHoTen() != null) {
                                                                                                                echo $member->getHoTen();
                                                                                                            } ?>" required>
                    </div>
                    <div style="display: flex; align-items: center; margin-bottom: 10px; " class="row">
                        <label class="col-md-2 col-sm-12" for="phone">Số điện thoại:</label>
                        <input oninput="checkPhoneNumber()" class="col-md-10 col-sm-12" type="text" id="phone" name="phone" value="<?php if ($member->getSdt() != null) {
                                                                                                                                        echo $member->getSdt();
                                                                                                                                    } ?>" required>
                    </div>
                    <div style="display: flex; align-items: center; margin-bottom: 10px; " class="row">
                        <label class="col-md-2 col-sm-12" for="email">Email:</label>
                        <input class="col-md-10 col-sm-12" type="email" id="email" name="email" value="<?php if ($member->getEmail() != null) {
                                                                                                            echo $member->getEmail();
                                                                                                        } ?>" required>
                    </div>
                </div>

                <script>
                    function checkPhoneNumber() {
                        var phoneField = document.getElementById('phone');
                        var phoneNumber = phoneField.value;

                        var isNumeric = /^\d+$/.test(phoneNumber);

                        if (isNumeric && phoneNumber.length >= 10) {
                            phoneField.setCustomValidity('');
                        } else {
                            phoneField.setCustomValidity('Số điện thoại phải chứa ít nhất 10 chữ số và chỉ chứa ký tự số.');
                        }
                    }

                    $(document).ready(function() {
                        $('#avartar').change(function(e) {
                            var input = e.target;
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();

                                reader.onload = function(e) {
                                    $('#imgAvartar').attr('src', e.target.result);
                                }

                                reader.readAsDataURL(input.files[0]);
                            }
                        });
                    });
                </script>

                <hr>

                <h3 style="font-weight: bold; margin-bottom: 20px">Tài khoản của bạn:</h3>
                <div class="container" style="margin-bottom: 20px; width: 100%">
                    <div style="display: flex; align-items: center; margin-bottom: 10px; " class="row">
                        <label class="col-md-2 col-sm-12" for="account">Tài khoản:</label>
                        <input readonly class="col-md-10 col-sm-12" type="text" id="account" name="account" value="<?php if ($member->getTaiKhoan() != null) {
                                                                                                                        echo $member->getTaiKhoan();
                                                                                                                    } ?>" required>
                    </div>
                    <div style="display: flex; align-items: center; margin-bottom: 10px; " class="row">
                        <label class="col-md-2 col-sm-12" for="membershipType">Loại tài khoản:</label>
                        <input readonly class="col-md-10 col-sm-12" type="text" id="membershipType" name="membershipType" value="Khách hàng" required>
                    </div>
                    <div style="display: flex; align-items: center; margin-bottom: 10px; " class="row">
                        <label class="col-md-2 col-sm-12" for="changePassword">Mật khẩu:</label>
                        <a class="changePassword" href="./change_password.php">Đổi mật khẩu</a>
                    </div>
                </div>

                <hr>

                <?php
                // $json_data = file_get_contents('https://vietnamprovince.tonyit.id.vn/API_TinhThanhVietNam');
                $json_data = file_get_contents('./data/vietnam.json');
                $data = json_decode($json_data, true);

                $province = "";
                $district = "";
                $commune = "";
                $specific = "";

                if ($member->getDiaChi() != null) {
                    $address = $member->getDiaChi();

                    $parts = explode(", ", $address);

                    $count = count($parts);

                    $province = trim($parts[$count - 1]);
                    $district = trim($parts[$count - 2]);
                    $commune = trim($parts[$count - 3]);
                    $specific = implode(', ', array_map('trim', array_slice($parts, 0, $count - 3)));
                }
                ?>

                <h3 style="font-weight: bold; margin-bottom: 20px">Địa chỉ:</h3>
                <div class="container" style="margin-bottom: 20px; width: 100%">
                    <div style="display: flex; align-items: center; margin-bottom: 10px;" class="row">
                        <label class="col-md-2 col-sm-12" for="specific-address">Địa chỉ cụ thể:</label>
                        <input required class="col-md-10 col-sm-12" type="text" id="specific-address" name="specific-address" value="<?php echo $specific; ?>">
                    </div>

                    <div style="display: flex; align-items: center; margin-bottom: 10px;" class="row">
                        <label class="col-md-2 col-sm-12" for="province">Thành phố/Tỉnh:</label>
                        <select required class="col-md-10 col-sm-12" id="province" name="province" onchange='loadDistricts()' value="<?php echo $province; ?>">
                            <option value=''>Chọn thành phố/tỉnh</option>
                            <?php
                            foreach ($data as $prov) {
                                $selected = ($prov['name'] == $province) ? "selected" : "";
                                echo "<option value='" . $prov['name'] . "' $selected>" . $prov['name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div style="display: flex; align-items: center; margin-bottom: 10px;" class="row">
                        <label class="col-md-2 col-sm-12" for="district">Quận/huyện:</label>
                        <select required class="col-md-10 col-sm-12" id="district" name="district" onchange='loadCommunes()' value="<?php echo $district; ?>">
                            <option value=''>Chọn quận/huyện</option>
                        </select>
                    </div>

                    <div style="display: flex; align-items: center; margin-bottom: 10px;" class="row">
                        <label class="col-md-2 col-sm-12" for="commune">Phường/xã:</label>
                        <select required class="col-md-10 col-sm-12" id="commune" name="commune" value="<?php echo $commune; ?>">
                            <option value=''>Chọn phường/xã</option>
                        </select>
                    </div>
                </div>

                <script>
                    // Tạo biến để lưu các giá trị mặc định
                    var defaultProvince = "<?php echo $province; ?>";
                    var defaultDistrict = "<?php echo $district; ?>";
                    var defaultCommune = "<?php echo $commune; ?>";

                    // Hàm loadDistricts sẽ được gọi khi select province thay đổi
                    function loadDistricts() {
                        var provinceName = document.getElementById("province").value;
                        var districts = <?php echo json_encode($data); ?>;
                        var districtSelect = document.getElementById("district");
                        districtSelect.innerHTML = "<option value=''>Chọn quận/huyện</option>";

                        for (var i = 0; i < districts.length; i++) {
                            if (districts[i]['name'] == provinceName) {
                                var districtList = districts[i]['districts'];
                                for (var j = 0; j < districtList.length; j++) {
                                    var option = document.createElement("option");
                                    option.text = districtList[j]['name'];
                                    option.value = districtList[j]['name'];
                                    if (districtList[j]['name'] == defaultDistrict) {
                                        option.selected = true; // Đánh dấu giá trị mặc định được chọn
                                    }
                                    districtSelect.appendChild(option);
                                }
                                break;
                            }
                        }
                        loadCommunes(); // Load communes dựa trên giá trị mặc định của quận/huyện
                    }

                    // Hàm loadCommunes sẽ được gọi khi select district thay đổi
                    function loadCommunes() {
                        var districtName = document.getElementById("district").value;
                        var districts = <?php echo json_encode($data); ?>;
                        var communeSelect = document.getElementById("commune");
                        communeSelect.innerHTML = "<option value=''>Chọn phường/xã</option>";

                        for (var i = 0; i < districts.length; i++) {
                            var districtList = districts[i]['districts'];
                            for (var j = 0; j < districtList.length; j++) {
                                if (districtList[j]['name'] == districtName) {
                                    var communeList = districtList[j]['wards'];
                                    for (var k = 0; k < communeList.length; k++) {
                                        var option = document.createElement("option");
                                        option.text = communeList[k]['name'];
                                        option.value = communeList[k]['name'];
                                        if (communeList[k]['name'] == defaultCommune) {
                                            option.selected = true; // Đánh dấu giá trị mặc định được chọn
                                        }
                                        communeSelect.appendChild(option);
                                    }
                                    break;
                                }
                            }
                        }
                    }

                    // Gọi hàm loadDistricts khi trang được tải để chọn giá trị mặc định của tỉnh/thành phố
                    window.onload = function() {
                        loadDistricts();
                    };
                </script>

                <hr>

                <div style="width: 50%; margin: 0 auto; margin-bottom: 20px;">
                    <input hidden name="memberId" value="<?php echo $member->getMaTV() ?>" type="number">
                    <button class="btn-update" style="width: 100%; margin-bottom: 10px;" type="submit">CẬP NHẬT THÔNG TIN</button>
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