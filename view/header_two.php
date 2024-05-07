<style>
    .cart-item-count {
        color: #fff;
        border-radius: 50%;
        padding: 5px 10px;
        position: absolute;
        bottom: 60%;
        background-color: #f44336;
        font-weight: bold;
        font-size: 14px;
    }
</style>

<div class="header-two">
    <div class="container">
        <div class="header-logo">
            <h1>
                <a href="./index.php"><span>T</span> C T<i>Phones</i></a>
            </h1>
            <h6>Tinh tế, Chất lượng, Tiện ích</h6>
        </div>
        <div class="header-search">
            <form action="#" method="post">
                <input type="search" name="Search" placeholder="Tìm kiếm sản phẩm tại đây..." required="" />
                <button type="submit" class="btn btn-default" aria-label="Left Align">
                    <i class="fa fa-search" aria-hidden="true"> </i>
                </button>
            </form>
        </div>
        <div class="header-cart">
            <div class="my-account">
                <a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i>
                    LIÊN HỆ</a>
            </div>
            <div class="cart">
                <form action="./cart.php" method="post" class="last">
                    <button style="position: relative" class="w3view-cart" type="submit" name="submit" value="">
                        <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>

                        <?php
                        $count = 0;
                        if (isset($_SESSION['login'])) {
                            $member = $_SESSION['login'];
                            $cart = Cart::getCartByMemberId($member->getMaTV());
                            if ($cart != null) {
                                $cartDetails = CartDetail::getCartDetailByCartId($cart->getMaGioHang());
                                foreach ($cartDetails as $cartDetail) {
                                    $count += $cartDetail->getSoLuong();
                                }
                            }
                        }
                        ?>

                        <span class="cart-item-count"><?php echo $count ?></span>
                    </button>
                </form>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>