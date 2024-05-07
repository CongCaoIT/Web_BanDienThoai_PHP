<style>
    .specification {
        margin: auto;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        width: 100%;
        border-radius: 5px;
    }

    .group-header {
        background-color: #f2f2f2;
        /* Màu nền cho tiêu đề nhóm */
        color: #000;
        /* Màu tiêu đề nhóm đổi thành đen */
        font-weight: bold;
        font-size: 20px;
    }

    .table-container {
        padding: 20px;
    }

    .table-specification {
        width: 100%;
        border-collapse: collapse;
    }

    .table-specification,
    .table-specification th,
    .table-specification td {
        border: 1px solid #ddd;
    }

    .table-specification th,
    .table-specification td {
        padding: 12px;
        text-align: left;
    }

    .row-specification {
        background-color: #ffffff;
    }

    .color-button {
        font-weight: bold;
        background-color: #fff;
        height: 40px;
        width: 100px;
        border-radius: 10px;
        margin-right: 10px;
        margin-top: 10px;
        border: 1px solid #ccc;
        cursor: pointer;
    }

    .color-button.selected {
        border: 2px solid orange;
    }
</style>

<!-- Breadcrumbs -->
<div class="container">
    <ol class="breadcrumb breadcrumb1">
        <li><a href="./index.php">Trang chủ</a></li>
        <li class="active">Chi tiết sản phẩm</li>
    </ol>
    <div class="clearfix"> </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' || $_SERVER['REQUEST_METHOD'] == 'POST') {
    $productId = null;
    if (isset($_GET['productId'])) {
        $productId = $_GET['productId'];
    }

    if ($productId != null) {
        $product = Product::getProductById($productId);
        if ($product != null) {

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
            <div class="products">
                <div class="container">
                    <div class="single-page">
                        <div class="single-page-row" id="detail-21">
                            <div class="col-md-6 single-top-left">
                                <div class="flexslider">
                                    <ul class="slides">
                                        <li data-thumb="./images/products/<?php echo $product->getHinhAnh() ?>">
                                            <div class="thumb-image detail_images"> <img src="./images/products/<?php echo $product->getHinhAnh() ?>" data-imagezoom="true" class="img-responsive" alt=""> </div>
                                        </li>
                                        <li data-thumb="./images/products/<?php echo $product->getHinhAnh2() ?>">
                                            <div class="thumb-image"> <img src="./images/products/<?php echo $product->getHinhAnh2() ?>" data-imagezoom="true" class="img-responsive" alt=""> </div>
                                        </li>
                                        <li data-thumb="./images/products/<?php echo $product->getHinhAnh3() ?>">
                                            <div class="thumb-image"> <img src="./images/products/<?php echo $product->getHinhAnh3() ?>" data-imagezoom="true" class="img-responsive" alt=""> </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 single-top-right">
                                <h3 class="item_name"><?php echo $product->getTenSP() ?></h3>

                                <p>Chọn màu cho sản phẩm:</p>
                                <div class="color-options">

                                    <?php
                                    $colors = Color::getColorsByProductId($productId);
                                    foreach ($colors as $color) {
                                    ?>
                                        <button class="color-button" type="button" data-color="<?php echo $color->getMaMau() ?>">
                                            <?php echo $color->getTenMau() ?>
                                        </button>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <p style="margin-top: 20px;">Miễn phí phí vận chuyển. </p>
                                <div class="single-rating">
                                    <ul>
                                        <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                        <li class="rating">20 đánh giá</li>
                                        <li><a href="#">Thêm đánh giá của bạn</a></li>
                                    </ul>
                                </div>
                                <div class="single-price">

                                    <?php
                                    if ($discount != 0) {
                                        $price = $product->getDonGia() - ($product->getDonGia() * $discount / 100);
                                    ?>
                                        <ul>
                                            <li><?php echo number_format($price, 0, ',', '.') ?>đ</li>
                                            <li><del><?php echo number_format($product->getDonGia(), 0, ',', '.') ?>đ</del></li>
                                            <li><span class="w3off">Sale <?php echo $discount ?>%</span></li>
                                            <li>Ngày kết thúc: <?php echo date('d/m/Y', $endDate); ?></li>
                                            <li><a href="#"><i class="fa fa-gift" aria-hidden="true"></i> Phiếu mua hàng</a></li>
                                        </ul>
                                    <?php
                                    } else {
                                        $price = $product->getDonGia();
                                    ?>
                                        <ul>
                                            <li><?php echo number_format($price, 0, ',', '.') ?>đ</li>
                                            <li><a href="#"><i class="fa fa-gift" aria-hidden="true"></i> Phiếu mua hàng</a></li>
                                        </ul>
                                    <?php
                                    }
                                    ?>


                                </div>
                                <p style="text-align: justify; text-indent: 20px;" class="single-price-text"><?php echo $product->getMoTa() ?></p>
                                <form action="./single.php?productId=<?php echo $productId ?>" method="post">
                                    <input type="hidden" name="selectedProductId" id="selectedProductId" value="<?php echo $productId ?>">
                                    <input type="hidden" name="selectedColorId" id="selectedColorId">
                                    <input type="hidden" name="selectedPrice" id="selectedPrice" value="<?php echo $price ?>">
                                    <button type="submit" class="w3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Thêm vào giỏ hàng</button>
                                </form>
                                <!-- <button style="padding: 5px;" class="w3ls-cart w3ls-cart-like"><i class="fa fa-heart-o" aria-hidden="true"></i> Thêm vào danh sách yêu thích</button> -->
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                        <div class="single-page-icons social-icons">
                            <ul>
                                <li>
                                    <h4>Chia sẻ đến</h4>
                                </li>
                                <li><a href="#" class="fa fa-facebook icon facebook"> </a></li>
                                <li><a href="#" class="fa fa-twitter icon twitter"> </a></li>
                                <li><a href="#" class="fa fa-google-plus icon googleplus"> </a></li>
                                <li><a href="#" class="fa fa-dribbble icon dribbble"> </a></li>
                                <li><a href="#" class="fa fa-rss icon rss"> </a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Recommendations -->
                    <?php include('./recommendation.php') ?>

                    <!-- Specifications -->
                    <?php include('./specification.php') ?>

                    <!-- offers-cards -->
                    <div class="w3single-offers offer-bottom">
                        <div class="col-md-6 offer-bottom-grids">
                            <div class="offer-bottom-grids-info2">
                                <h4>Big deals</h4>
                                <h6>Hàng ngàng ưu đãi lớn đang chờ bạn. <br> Hãy khám phá!</h6>
                            </div>
                        </div>
                        <div class="col-md-6 offer-bottom-grids">
                            <div class="offer-bottom-grids-info">
                                <h4>Free shipping</h4>
                                <h6>Miễn phí vận chuyển tất cả các sản phẩm. <br> Mua ngay!</h6>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>

                </div>
            </div>
        <?php
        }
    } else {
        ?>
        <div style="text-align: center; margin-top: 20px">
            <img style="width: 20%;" src="./images/icon/not-found.png" alt="">
        </div>
        <h4 style="color: red; margin-top: 20px; margin-bottom: 20px; text-align: center">Không có kết quả bạn cần tìm!!!</h4>
<?php
    }
}
?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Lấy danh sách tất cả các nút màu
        var colorButtons = document.querySelectorAll('.color-button');

        // Mặc định chọn màu đầu tiên
        if (colorButtons.length > 0) {
            colorButtons[0].classList.add('selected');
            document.getElementById('selectedColorId').value = colorButtons[0].getAttribute('data-color');
        }

        // Thêm sự kiện click cho mỗi nút màu
        colorButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                // Loại bỏ lớp 'selected' từ tất cả các nút màu
                colorButtons.forEach(function(btn) {
                    btn.classList.remove('selected');
                });

                // Thêm lớp 'selected' cho nút màu được chọn
                button.classList.add('selected');
                document.getElementById('selectedColorId').value = button.getAttribute('data-color');
            });
        });
    });
</script>