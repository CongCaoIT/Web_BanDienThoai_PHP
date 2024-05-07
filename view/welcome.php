<div class="welcome">
    <div class="container">
        <div class="welcome-info">
            <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                <ul id="myTab" class="nav-tabs" role="tablist">

                    <!-- Load icon loại sản phẩm -->
                    <?php
                    $categories = Category::getAllCategories();
                    if (count($categories) > 0) {
                        $category = $categories[0];
                    ?>
                        <li role="presentation" class="active">
                            <a href="#<?php echo $category->getTenLoaiSP() ?>" id="<?php echo $category->getTenLoaiSP() . '-tab' ?>" role="tab" data-toggle="tab">
                                <i class="fa" aria-hidden="true">
                                    <img style="width: 50px;" src="./images/icon/<?php echo $category->getIcon() ?>" alt="">
                                </i>

                                <h5><?php echo $category->getTenLoaiSP() ?></h5>
                            </a>
                        </li>
                    <?php
                    }
                    for ($i = 1; $i < count($categories); $i++) {
                        $category = $categories[$i];
                    ?>
                        <li role="presentation">
                            <a href="#<?php echo $category->getTenLoaiSP() ?>" id="<?php echo $category->getTenLoaiSP() . '-tab' ?>" role="tab" data-toggle="tab">
                                <i class="fa" aria-hidden="true">
                                    <img style="width: 50px;" src="./images/icon/<?php echo $category->getIcon() ?>" alt="">
                                </i>

                                <h5><?php echo $category->getTenLoaiSP() ?></h5>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
                <div class="clearfix"></div>
                <h3 class="w3ls-title">Sản phẩm nổi bật</h3>
                <div id="myTabContent" class="tab-content">

                    <!-- Hiển thị 1 số sản phẩm của từng danh mục -->
                    <?php
                    if (count($categories) > 0) {
                        $category = $categories[0];

                    ?>
                        <div role="tabpanel" class="tab-pane fade in active" id="<?php echo $category->getTenLoaiSP() ?>" aria-labelledby="<?php echo $category->getTenLoaiSP() . '-tab' ?>">
                            <div class="tabcontent-grids">
                                <div id="owl-demo" class="owl-carousel">

                                    <?php
                                    $products = Product::getRandomProductsByCategory($category->getMaLoaiSP());
                                    foreach ($products as $product) {
                                    ?>
                                        <div class="item">
                                            <div class="glry-w3agile-grids agileits">
                                                <div class="new-tag">
                                                    <h6>Sale</h6>
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
                        </div>
                        <?php

                        for ($i = 1; $i < count($categories); $i++) {
                            $category = $categories[$i];
                        ?>
                            <div role="tabpanel" class="tab-pane fade" id="<?php echo $category->getTenLoaiSP() ?>" aria-labelledby="<?php echo $category->getTenLoaiSP() . '-tab' ?>">
                                <div class="tabcontent-grids">
                                    <script>
                                        $(document).ready(function() {
                                            $("#owl-demo<?php echo $i ?>").owlCarousel({
                                                autoPlay: 3000, //Set AutoPlay to 3 seconds

                                                items: 4,
                                                itemsDesktop: [640, 5],
                                                itemsDesktopSmall: [414, 4],
                                                navigation: true,
                                            });
                                        });
                                    </script>
                                    <div id="owl-demo<?php echo $i ?>" class="owl-carousel">

                                        <?php
                                        $products = Product::getRandomProductsByCategory($category->getMaLoaiSP());
                                        foreach ($products as $product) {
                                        ?>
                                            <div class="item">
                                                <div class="glry-w3agile-grids agileits">
                                                    <img style="width: 180px; height: 216px; object-fit: contain;" src="./images/products/<?php echo $product->getHinhAnh() ?>" alt="<?php echo $product->getTenSP() ?>" />
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
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>