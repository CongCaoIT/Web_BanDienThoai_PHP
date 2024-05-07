<div class="recommend">
    <h3 class="w3ls-title">Khuyến nghị của chúng tôi </h3>
    <script>
        $(document).ready(function() {
            $("#owl-demo5").owlCarousel({

                autoPlay: 3000,

                items: 4,
                itemsDesktop: [640, 5],
                itemsDesktopSmall: [414, 4],
                navigation: true

            });

        });
    </script>
    <div id="owl-demo5" class="owl-carousel">

        <?php
        $products = Product::getRandomProducts();
        foreach ($products as $product) {
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
            <div class="item">
                <div class="glry-w3agile-grids agileits">
                    <div class="new-tag">
                        <h6><?php echo $discount ?>% <br> Off</h6>
                    </div>
                    <a href="#">
                        <img style="width: 180px; height: 216px; object-fit: contain;" src="./images/products/<?php echo $product->getHinhAnh() ?>" alt="<?php echo $product->getTenSP() ?>" />
                    </a>
                    <div class="view-caption agileits-w3layouts">
                        <h4>
                            <p style="color: #f44336; font-weight: bold;"><?php echo $category->getTenLoaiSP() ?></p>
                        </h4>
                        <p>
                            <?php echo $product->getTenSP() ?>
                        </p>

                        <a style="display: block; background: #f44336; color: #fff; font-size: 1em; text-align: center; border-radius: 3px; border: 1px solid; width: 80%; outline: none; padding: 0.5em 0; margin: 0 auto; margin-top: 10px;" href="./single.php?productId=<?php echo $product->getMaSP() ?>">
                            <i class="fa fa-mobile" aria-hidden="true"></i> Xem chi tiết
                        </a>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>