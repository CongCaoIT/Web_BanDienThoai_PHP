<?php
include('./includeLibrary.php');
session_start();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <title>Giỏ hàng</title>
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
            <li class="active">Giỏ hàng của bạn</li>
        </ol>
        <div class="clearfix"> </div>
    </div>

    <style>
        .clear-cart-btn {
            background-color: red;
            color: white;
            padding: 10px 20px;
            display: inline-block;
            text-decoration: none;
        }

        .checkout-btn {
            background-color: blue;
            color: white;
            padding: 10px 20px;
            display: inline-block;
            text-decoration: none;
        }

        .checkout-btn:hover {
            background-color: #f44336;
            color: #fff;
        }

        .clear-cart-btn {
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            display: inline-block;
            text-decoration: none;
        }

        .clear-cart-btn:hover {
            background-color: #000;
            color: #fff;
        }

        .row {
            display: flex;
            justify-content: space-between;
        }
    </style>

    <?php
    if (isset($_SESSION['login'])) {
        $member = $_SESSION['login'];
        $cart = Cart::getCartByMemberId($member->getMaTV());
        if ($cart != null) {
            $cartDetails =  CartDetail::getCartDetailByCartId($cart->getMaGioHang());
            if (count($cartDetails) > 0) {
    ?>
                <div class="container">
                    <div style="border: none">
                        <table class="table">
                            <tr style="background-color: #f44336; color: #fff; font-size: 1.2em" class="row">
                                <th style="text-align: center;" class="col-md-1">
                                    <input class="check-all-checkbox" style="width: 70%; height: 70%" type="checkbox" onchange="checkAll(this)" />
                                </th>
                                <th style="text-align: center;" class="col-md-5">
                                    Sản phẩm
                                </th>
                                <th style="text-align: center;" class="col-md-2">Đơn giá</th>
                                <th style="text-align: center;" class="col-md-1">Số lượng</th>
                                <th style="text-align: center;" class="col-md-2">Thành tiền</th>
                                <th class="col-md-1"></th>
                            </tr>

                            <?php
                            foreach ($cartDetails as $cartDetail) {
                                $product = Product::getProductById($cartDetail->getMaSP());
                                $color = Color::getColorById($cartDetail->getMaMau())
                            ?>
                                <tr style="font-size: 1.2em" class="row">
                                    <td style="display: flex; justify-content: center; align-items: center;" class="col-md-1">
                                        <input style="width: 30%; height: 30%;" type="checkbox" class="item-checkbox" data-cart="<?php echo $cart->getMaGioHang() ?>" data-product="<?php echo $cartDetail->getMaSP() ?>" data-color="<?php echo $cartDetail->getMaMau() ?>" onchange="updateSelectedItemCount()" />
                                    </td>
                                    <td style="display: flex; justify-content: center; align-items: center;" class="col-md-2">
                                        <a href="./single.php?productId=<?php echo $cartDetail->getMaSP() ?>"><img style="width: 50%" src="./images/products/<?php echo $product->getHinhAnh() ?>"></a>
                                    </td>
                                    <td style="display: flex; justify-content: center; align-items: center;" class="col-md-3"><?php echo $product->getTenSP() . ' - ' . $color->getTenMau() ?></td>
                                    <td style="display: flex; justify-content: center; align-items: center;" class="col-md-2"><?php echo number_format($cartDetail->getDonGia(), 0, ',', '.') ?> ₫</td>
                                    <td style="display: flex; justify-content: center; align-items: center;" class="col-md-1">
                                        <select style="width: 70%; height: 50%; text-align: center" id="cart_count" name="cars" onchange="updateCartItem(this, <?php echo $cart->getMaGioHang() ?>, <?php echo $cartDetail->getMaSP() ?>, <?php echo $cartDetail->getMaMau() ?>)">

                                            <?php
                                            for ($i = 1; $i <= 5; $i++) {
                                                if ($cartDetail->getSoLuong() == $i) {
                                            ?>
                                                    <option selected data-original-quantity="<?php echo $i ?>" value="<?php echo $i ?>"><?php echo $i ?></option>
                                                <?php
                                                } else {
                                                ?>
                                                    <option data-original-quantity="<?php echo $i ?>" value="<?php echo $i ?>"><?php echo $i ?></option>
                                            <?php
                                                }
                                            }
                                            ?>

                                        </select>
                                    </td>

                                    <td style="display: flex; justify-content: center; align-items: center;" class="col-md-2 item-price" style="color: red"><?php echo number_format($cartDetail->getDonGia() * $cartDetail->getSoLuong(), 0, ',', '.') ?> ₫</td>
                                    <th style="display: flex; justify-content: center; align-items: center;" class="col-md-1">
                                        <img style="cursor: pointer;" data-cart=" <?php echo $cart->getMaGioHang() ?>" data-product="<?php echo $cartDetail->getMaSP() ?>" data-color="<?php echo $cartDetail->getMaMau() ?>" onclick="deleteSelectedItem(this)" src="./images/icon/remove.png" alt="">
                                    </th>
                                </tr>
                            <?php
                            }
                            ?>

                            <tr class="row">
                                <td style="display: flex; justify-content: left; align-items: center;" class="col-md-5">
                                    <a onclick="deleteSelectedItems()" class="clear-cart-btn">Xóa (0) mục đã chọn</a>
                                </td>
                                <td style="display: flex; justify-content: center; align-items: center;" class="col-md-4">
                                    <p class="count-cart-item-selected" style="color: black; ">Tổng thanh toán: 0 sản phẩm</p>
                                </td>
                                <td style="display: flex; justify-content: center; align-items: center;" class="col-md-3">
                                    <p class="total-amount" style="color: red; font-weight: bold; ">Tổng tiền: 0đ</p>
                                </td>
                            </tr>
                            <tr class="row">
                                <td style="text-align: right;" class="col-md-12">
                                    <a href="./order_information.php" class="checkout-btn" onclick="return checkSelectedItemsBeforeCheckout()">Tiến hành đặt hàng</a>
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
                <script>
                    // Hàm để đếm số lượng checkbox được chọn và cập nhật nội dung của thẻ <a>
                    function updateSelectedItemCount() {
                        var checkAllCheckbox = document.querySelector('.check-all-checkbox');
                        checkAllCheckbox.checked = true;

                        var checkboxes = document.querySelectorAll('.item-checkbox');
                        var selectedCount = 0;
                        var promises = [];
                        for (var i = 0; i < checkboxes.length; i++) {
                            if (!checkboxes[i].checked) {
                                checkAllCheckbox.checked = false;
                            }

                            cart = parseInt(checkboxes[i].getAttribute('data-cart'));
                            product = parseInt(checkboxes[i].getAttribute('data-product'));
                            color = parseInt(checkboxes[i].getAttribute('data-color'));

                            if (checkboxes[i].checked) {
                                selectedCount++;

                                var data = {
                                    cartId: cart,
                                    productId: product,
                                    colorId: color
                                };

                                var dataUpdateCheck = {
                                    cartId: cart,
                                    productId: product,
                                    colorId: color,
                                    check: 1
                                };

                                // Push each AJAX request into the promises array
                                promises.push(new Promise((resolve, reject) => {
                                    $.ajax({
                                        type: 'POST',
                                        url: './get_price_cart_detail.php',
                                        data: data,
                                        success: function(response) {
                                            resolve(parseFloat(response)); // Chuyển đổi chuỗi thành số
                                        },
                                        error: function(xhr, status, error) {
                                            reject(error);
                                        }
                                    });

                                    $.ajax({
                                        type: 'POST',
                                        url: './update_check_cart_item.php',
                                        data: dataUpdateCheck,
                                        success: function() {},
                                        error: function(xhr, status, error) {
                                            reject(error);
                                        }
                                    });
                                }));
                            } else {
                                var dataUpdateCheck = {
                                    cartId: cart,
                                    productId: product,
                                    colorId: color,
                                    check: 0
                                };

                                // Push each AJAX request into the promises array
                                promises.push(new Promise((resolve, reject) => {
                                    $.ajax({
                                        type: 'POST',
                                        url: './update_check_cart_item.php',
                                        data: dataUpdateCheck,
                                        success: function() {
                                            resolve(0);
                                        },
                                        error: function(xhr, status, error) {
                                            reject(error);
                                        }
                                    });
                                }));
                            }
                        }

                        // cơ chế để chờ cho tất cả các yêu cầu AJAX hoàn tất trước khi cập nhật tổng tiền.
                        Promise.all(promises)
                            .then((prices) => {
                                // Calculate total amount
                                var totalAmount = prices.reduce((acc, curr) => acc + curr, 0);

                                // Update DOM elements
                                var clearCartLink = document.querySelector('.clear-cart-btn');
                                clearCartLink.textContent = 'Xóa (' + selectedCount + ') mục đã chọn';

                                var clearCartLink = document.querySelector('.count-cart-item-selected');
                                clearCartLink.textContent = 'Tổng thanh toán: ' + selectedCount + ' sản phẩm';

                                var totalAmountDisplay = document.querySelector('.total-amount');
                                totalAmountDisplay.textContent = 'Tổng tiền: ' + totalAmount.toLocaleString('vi-VN', {
                                    style: 'currency',
                                    currency: 'VND'
                                });
                            })
                            .catch((error) => {
                                alert(error);
                            });
                    }

                    // Hàm để kiểm tra hoặc bỏ chọn tất cả các checkbox trong item giỏ hàng
                    function checkAll(source) {
                        var checkboxes = document.querySelectorAll('.item-checkbox');
                        for (var i = 0; i < checkboxes.length; i++) {
                            checkboxes[i].checked = source.checked;
                        }
                        // Sau khi check tất cả, cập nhật lại số lượng checkbox được chọn
                        updateSelectedItemCount();
                    }

                    function getCoutProductCartDetail(selectCartId, selectProductId, selectColorId) {
                        return new Promise(function(resolve, reject) {
                            var data = {
                                cartId: selectCartId,
                                productId: selectProductId,
                                colorId: selectColorId
                            };

                            $.ajax({
                                type: 'POST',
                                url: './get_count_product_cart_detail.php',
                                data: data,
                                success: function(response) {
                                    resolve(parseInt(response));
                                },
                                error: function(xhr, status, error) {
                                    reject(error);
                                }
                            });
                        });
                    }

                    function updateCartItem(selectElement, selectCartId, selectProductId, selectColorId) {
                        var selectedQuantity = parseInt(selectElement.value);

                        getCoutProductCartDetail(selectCartId, selectProductId, selectColorId)
                            .then(function(originalQuantity) {
                                var data = {
                                    cartId: selectCartId,
                                    productId: selectProductId,
                                    colorId: selectColorId,
                                    quantity: selectedQuantity
                                };

                                $.ajax({
                                    type: 'POST',
                                    url: './update_cart_detail.php',
                                    data: data,
                                    success: function(response) {
                                        var itemPriceElement = $(selectElement).closest('.row').find('.item-price');
                                        var newPrice = parseFloat(response);
                                        itemPriceElement.text(newPrice.toLocaleString('vi-VN', {
                                            style: 'currency',
                                            currency: 'VND'
                                        }));

                                        // Cập nhật tổng tiền của các sản phẩm được chọn
                                        updateSelectedItemCount();

                                        // Sau khi cập nhật thành công giỏ hàng (ajax bất đồng bộ), cập nhật lại số lượng item trong giỏ hàng
                                        updateCartItemCount(selectCartId);
                                    },
                                    error: function(xhr, status, error) {
                                        alert(xhr.responseText);

                                        selectElement.value = originalQuantity;

                                        // Cập nhật tổng tiền của các sản phẩm được chọn
                                        updateSelectedItemCount();

                                        // Sau khi cập nhật thành công giỏ hàng (ajax bất đồng bộ), cập nhật lại số lượng item trong giỏ hàng
                                        updateCartItemCount(selectCartId);
                                    }
                                });
                            })
                            .catch(function(error) {});
                    }


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


                    function deleteSelectedItems() {
                        var checkboxes = document.querySelectorAll('.item-checkbox');
                        var selectedItems = [];
                        var deleteRequests = [];

                        // Xác định và xử lý các mục được chọn
                        for (var i = 0; i < checkboxes.length; i++) {
                            if (checkboxes[i].checked) {
                                var item = checkboxes[i].closest('tr'); // Lấy hàng chứa checkbox
                                selectedItems.push(item);

                                cart = parseInt(checkboxes[i].getAttribute('data-cart'));
                                product = parseInt(checkboxes[i].getAttribute('data-product'));
                                color = parseInt(checkboxes[i].getAttribute('data-color'));

                                var data = {
                                    cartId: cart,
                                    productId: product,
                                    colorId: color
                                };

                                // Thực hiện yêu cầu AJAX và đẩy promise vào mảng
                                var request = $.ajax({
                                    type: 'POST',
                                    url: './remove_cart_detail.php',
                                    data: data
                                });
                                deleteRequests.push(request);
                            }
                        }

                        // Xóa các mục được chọn sau khi các yêu cầu AJAX đã hoàn thành
                        Promise.all(deleteRequests)
                            .then(() => {
                                // Tải lại trang sau khi xóa thành công (nếu cần)
                                location.reload();
                            })
                            .catch((error) => {
                                // Xử lý lỗi nếu cần
                                console.error(error);
                            });
                    }

                    function deleteSelectedItem(source) {
                        var cart = source.getAttribute('data-cart');
                        var product = source.getAttribute('data-product');
                        var color = source.getAttribute('data-color');

                        var data = {
                            cartId: cart,
                            productId: product,
                            colorId: color
                        };

                        $.ajax({
                            type: 'POST',
                            url: './remove_cart_detail.php',
                            data: data,
                            success: function(response2) {
                                location.reload();
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });
                    }

                    function checkSelectedItemsBeforeCheckout() {
                        var checkboxes = document.querySelectorAll('.item-checkbox');
                        for (var i = 0; i < checkboxes.length; i++) {
                            if (checkboxes[i].checked) {
                                // Nếu có ít nhất một mục được chọn, cho phép tiến hành đặt hàng
                                return true;
                            }
                        }
                        // Nếu không có mục nào được chọn, ngăn người dùng tiến hành đặt hàng
                        alert("Vui lòng chọn ít nhất một sản phẩm để tiến hành đặt hàng.");
                        return false;
                    }
                </script>
            <?php
            } else {
            ?>
                <div style="text-align: center; margin-top: 20px">
                    <img style="width: 10%;" src="./images/icon/empty-cart.png" alt="">
                </div>
                <h4 style="color: red; margin-top: 20px; margin-bottom: 20px; text-align: center">Giỏ hàng của bạn hiện tại đang trống!!!</h4>
            <?php
            }
            ?>
        <?php
        } else {
        ?>
            <div style="text-align: center; margin-top: 20px">
                <img style="width: 10%;" src="./images/icon/empty-cart.png" alt="">
            </div>
            <h4 style="color: red; margin-top: 20px; margin-bottom: 20px; text-align: center">Giỏ hàng của bạn hiện tại đang trống!!!</h4>
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