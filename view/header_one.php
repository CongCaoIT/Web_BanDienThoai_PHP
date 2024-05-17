<div class="w3ls-header">
    <div class="w3ls-header-left">
        <p>
            <a href="#">ƯU ĐÃI HÀNG ĐẦU TẠI ĐÂY</a>
        </p>
    </div>
    <div class="w3ls-header-right">
        <ul>
            <li class="dropdown head-dpdn">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <?php
                    if (isset($_SESSION['login'])) {
                        $member = $_SESSION['login'];
                        echo $member->getTaiKhoan();
                    } else {
                        echo 'Tài khoản của tôi';
                    }
                    ?>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <?php
                    if (isset($_SESSION['login'])) {
                    ?>
                        <li><a href="./personal_information.php">Thông tin cá nhân </a></li>
                        <li><a href="./login.php?isLogout=true">Đăng xuất </a></li>
                    <?php
                    } else {
                    ?>
                        <li><a href="./login.php">Đăng nhập </a></li>
                        <li><a href="./signup.php">Đăng ký </a></li>
                    <?php
                    }
                    ?>

                    <!-- <li><a href="#">Giỏ hàng </a></li> -->
                    <!-- <li><a href="#">Wallet</a></li> -->
                </ul>
            </li>
            <li class="dropdown head-dpdn">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-percent" aria-hidden="true"></i>
                    Ưu đãi hôm nay
                    <!-- <span class="caret"></span> -->
                </a>
                <!-- <ul class="dropdown-menu">
                    <li>
                        <a href="offers.html">Ưu đãi hoàn tiền</a>
                    </li>
                    <li>
                        <a href="offers.html">Giảm giá sản phẩm</a>
                    </li>
                    <li>
                        <a href="offers.html">Ưu đãi đặc biệt</a>
                    </li>
                </ul> -->
            </li>
            <li class="dropdown head-dpdn">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-gift" aria-hidden="true"></i>
                    Thẻ quà tặng
                    <!-- <span class="caret"></span> -->
                </a>
                <!-- <ul class="dropdown-menu">
                    <li>
                        <a href="offers.html">Product Gift card</a>
                    </li>
                    <li>
                        <a href="offers.html">Occasions Register</a>
                    </li>
                    <li><a href="offers.html">View Balance</a></li>
                </ul> -->
            </li>
            <li class="dropdown head-dpdn">
                <a href="#" class="dropdown-toggle"><i class="fa fa-map-marker" aria-hidden="true"></i>
                    Vị trí của hàng</a>
            </li>
            <li class="dropdown head-dpdn">
                <a href="#" class="dropdown-toggle"><i class="fa fa-credit-card-alt" aria-hidden="true"></i>
                    Thẻ tín dụng </a>
            </li>
            <li class="dropdown head-dpdn">
                <a href="#" class="dropdown-toggle"><i class="fa fa-question-circle" aria-hidden="true"></i>
                    Trợ giúp</a>
            </li>
        </ul>
    </div>
    <div class="clearfix"></div>
</div>