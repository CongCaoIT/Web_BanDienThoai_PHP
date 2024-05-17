<?php
include('./includeLibrary.php');
session_start();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <title>Tìm kiếm sản phẩm</title>
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
    <link href="css/menu.css" rel="stylesheet" type="text/css" media="all" /> <!-- menu style -->
    <link href="css/animate.min.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/owl.carousel.css" rel="stylesheet" type="text/css" media="all"> <!-- carousel slider -->
    <!-- //Custom Theme files -->
    <!-- font-awesome icons -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- //font-awesome icons -->
    <!-- js -->
    <script src="js/jquery-2.2.3.min.js"></script>
    <script src="js/owl.carousel.js"></script>
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
    <!-- the jScrollPane script -->
    <script type="text/javascript" src="js/jquery.jscrollpane.min.js"></script>
    <script type="text/javascript" id="sourcecode">
        $(function() {
            $('.scroll-pane').jScrollPane();
        });
    </script>
    <!-- //the jScrollPane script -->
    <script type="text/javascript" src="js/jquery.mousewheel.js"></script>
    <!-- the mousewheel plugin -->
</head>

<body>
    <!-- Header -->
    <?php include('./header.php'); ?>

    <div class="products">
        <div class="container">
            <div class="col-md-12 product-w3ls-right">

                <!-- Breadcrumbs -->
                <ol class="breadcrumb breadcrumb1">
                    <li><a href="./index.php">Trang chủ</a></li>
                    <li class="active">Tìm kiếm sản phẩm</li>
                </ol>
                <div class="clearfix"> </div>

                <!-- Lấy danh mục theo mã -->
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    if (isset($_GET['keyword'])) {
                        $keyWord = $_GET['keyword'];

                        if (isset($_GET['sort'])) {
                            $sort = $_GET['sort'];
                            if ($sort == 'price_desc') {
                                $products = Product::getProductsByKeywordOrderByPriceDesc($keyWord);
                            } else if ($sort == 'price_asc') {
                                $products = Product::getProductsByKeywordOrderByPriceAsc($keyWord);
                            }
                        } else {
                            $products = Product::getProductsByKeyword($keyWord);
                        }

                        // Số lượng sản phẩm hiển thị trên mỗi trang
                        $itemsPerPage = 8;

                        // Tính toán số lượng trang
                        $totalItems = count($products);
                        $totalPages = ceil($totalItems / $itemsPerPage);

                        if (isset($_GET['page'])) {
                            $currentPage = max(1, min($_GET['page'], $totalPages));
                        } else {
                            $currentPage = 1;
                        }

                        // Xác định vị trí của sản phẩm đầu tiên trong danh sách
                        $startIndex = ($currentPage - 1) * $itemsPerPage;
                        $endIndex = min($startIndex + $itemsPerPage - 1, $totalItems - 1);

                        // Lấy các sản phẩm cho trang hiện tại
                        $currentProducts = array_slice($products, $startIndex, $endIndex - $startIndex + 1);

                        $countProducts = count($products);
                ?>
                        <div class="product-top">
                            <h4 style="font-family: Roboto Condensed, sans-serif;">Tìm thấy <?php echo $countProducts ?> sản phẩm cho từ khóa "<?php echo $keyWord ?>"</h4>
                            <ul>
                                <li class="dropdown head-dpdn">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sắp xếp theo giá<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="./search.php?keyword=<?php echo $keyWord ?>&sort=price_desc">Giá giảm dần</a></li>
                                        <li><a href="./search.php?keyword=<?php echo $keyWord ?>&sort=price_asc">Giá tăng dần</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <div class="clearfix"> </div>
                        </div>
                        <div class="products-row">

                            <?php
                            // Lấy giảm giá
                            if (count($products) > 0) {
                                foreach ($currentProducts as $product) {
                                    $discount = 0;
                                    $promotion = Promotion::getPromotionById($product->getMaKhuyenMai());
                                    if ($promotion != null) {
                                        $startDate = strtotime($promotion->getNgayBatDau());
                                        $endDate = strtotime($promotion->getNgayKetThuc());
                                        $currentTime = time();

                                        if ($startDate <= $currentTime && $endDate >= $currentTime) {
                                            $discount = $promotion->getPhanTramGiamGia();
                                        }
                                    }

                            ?>
                                    <div class="col-md-3 product-grids">
                                        <div class="agile-products">

                                            <?php
                                            if ($discount != 0) {
                                            ?>
                                                <div class="new-tag">
                                                    <h6>-<?php echo $discount ?>%<br></h6>
                                                </div>
                                            <?php
                                            }
                                            ?>

                                            <a href="./single.php?productId=<?php echo $product->getMaSP() ?>"><img src="./images/products/<?php echo $product->getHinhAnh() ?>" class="img-responsive" alt="img"></a>
                                            <div class="agile-product-text">
                                                <h5><a href="./single.php?productId=<?php echo $product->getMaSP() ?>"><?php echo $product->getTenSP() ?></a></h5>

                                                <?php
                                                if ($discount != 0) {
                                                    // Tính tiền sau giảm giá
                                                    $price = $product->getDonGia() - ($product->getDonGia() * $discount / 100);
                                                ?>
                                                    <h6><del><?php echo number_format($product->getDonGia(), 0, ',', '.') ?>đ</del> <?php echo number_format($price, 0, ',', '.') ?>đ</h6>
                                                <?php
                                                } else {
                                                ?>
                                                    <h6><?php echo number_format($product->getDonGia(), 0, ',', '.') ?>đ</h6>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                                <div class="clearfix"> </div>
                                <div class="text-center">
                                    <ul class="pagination">
                                        <?php
                                        if ($currentPage > 1) {
                                            if (isset($sort) && !empty($sort)) {
                                        ?>
                                                <li>
                                                    <a href="<?php echo './search.php?keyword=' . $keyWord . '&sort=' . $sort . '&page=' . ($currentPage - 1); ?>">
                                                        << </a>
                                                </li>
                                            <?php
                                            } else {
                                            ?>
                                                <li>
                                                    <a href="<?php echo './search.php?keyword=' . $keyWord . '&page=' . ($currentPage - 1); ?>">
                                                        << </a>
                                                </li>
                                            <?php
                                            }
                                            ?>
                                        <?php } ?>
                                        <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                                            <li <?php if ($i == $currentPage) echo 'class="active"'; ?>>
                                                <?php
                                                if (isset($sort) && !empty($sort)) {
                                                ?>
                                                    <a href="<?php echo './search.php?keyword=' . $keyWord . '&sort=' . $sort . '&page=' . $i; ?>"><?php echo $i; ?></a>
                                                <?php
                                                } else {
                                                ?>
                                                    <a href="<?php echo './search.php?keyword=' . $keyWord . '&page=' . $i; ?>"><?php echo $i; ?></a>
                                                <?php
                                                }
                                                ?>
                                            </li>
                                        <?php } ?>
                                        <?php
                                        if ($currentPage < $totalPages) {
                                            if (isset($sort) && !empty($sort)) {
                                        ?>
                                                <li>
                                                    <a href="<?php echo './search.php?keyword=' . $keyWord . '&sort=' . $sort . '&page=' . ($currentPage + 1); ?>">
                                                        >> </a>
                                                </li>
                                            <?php
                                            } else {
                                            ?>
                                                <li>
                                                    <a href="<?php echo './search.php?keyword=' . $keyWord . '&page=' . ($currentPage + 1); ?>"> >> </a>
                                                </li>
                                            <?php
                                            }
                                            ?>
                                        <?php } ?>
                                    </ul>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div style="text-align: center; margin-top: 20px">
                                    <img style="width: 20%;" src="./images/icon/not-found.png" alt="">
                                </div>
                                <h4 style="color: red; margin-top: 20px; margin-bottom: 20px; text-align: center">Không có kết quả bạn cần tìm!!!</h4>
                            <?php
                            }
                            ?>
                        </div>
                <?php
                    }
                }
                ?>

                <!-- add-products -->
                <div class="w3ls-add-grids w3agile-add-products">
                    <a href="#">
                        <h4>GIẢM GIÁ CỰC SỐC. CHỈ CÓ TẠI <span>T C T Phones</span></h4>
                        <h6>Đi ngay <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></h6>
                    </a>
                </div>
            </div>

            <!-- Recommendations -->
            <?php include('./recommendation.php') ?>
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