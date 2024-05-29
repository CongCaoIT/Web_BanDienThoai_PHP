<div class="products">
    <div class="container">
        <div class="col-md-9 product-w3ls-right">

            <!-- Breadcrumbs -->
            <ol class="breadcrumb breadcrumb1">
                <li><a href="./index.php">Trang chủ</a></li>
                <li class="active">Sản phẩm</li>
            </ol>
            <div class="clearfix"> </div>

            <!-- Lấy danh mục theo mã -->
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                if (isset($_GET['categoryId'])) {
                    $categoryId = $_GET['categoryId'];

                    // Lấy danh sách các sản phẩm theo điều kiện
                    if (isset($_GET['sort'])) {
                        $sort = $_GET['sort'];
                        if ($sort == 'price_desc') {
                            $products = Product::getProductsByCategoryOrderByPriceDesc($categoryId);
                        } else if ($sort == 'price_asc') {
                            $products = Product::getProductsByCategoryOrderByPriceAsc($categoryId);
                        }
                    } else if (isset($_GET['price'])) {
                        $priceFilter = $_GET['price'];
                        $priceFilterArray = explode('-', $priceFilter);
                        $firstPrice = $priceFilterArray[0];
                        $secondPrice = $priceFilterArray[1];
                        $products = Product::getProductsByPriceRange($firstPrice, $secondPrice, $categoryId);
                    } else if (isset($_GET['ram'])) {
                        $ram = $_GET['ram'];
                        $products = Product::getProductsByCategoryAndRam($categoryId, $ram);
                    } else if (isset($_GET['storage'])) {
                        $storage = $_GET['storage'];
                        $products = Product::getProductsByCategoryAndStorage($categoryId, $storage);
                    } else if (isset($_GET['scanning-frequency'])) {
                        $scanningFrequency = $_GET['scanning-frequency'];
                        $products = Product::getProductsByCategoryAndScanningFrequency($categoryId, $scanningFrequency);
                    } else if (isset($_GET['color'])) {
                        $colorId = $_GET['color'];
                        $products = Product::getProductsByCategoryAndColor($categoryId, $colorId);
                    } else {
                        $products = Product::getProductsByCategory($categoryId);
                    }

                    // Số lượng sản phẩm hiển thị trên mỗi trang
                    $itemsPerPage = 6;

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


                    $category = Category::getCategoryById($categoryId);
            ?>
                    <div class="product-top">
                        <h4><?php echo $category->getTenLoaiSP() ?></h4>
                        <ul>
                            <li class="dropdown head-dpdn">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sắp xếp theo giá<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="./products.php?categoryId=<?php echo $categoryId ?>&sort=price_desc">Giá giảm dần</a></li>
                                    <li><a href="./products.php?categoryId=<?php echo $categoryId ?>&sort=price_asc">Giá tăng dần</a></li>
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
                                <div class="col-md-4 product-grids">
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
                                                <a href="<?php echo './products.php?categoryId=' . $categoryId . '&sort=' . $sort . '&page=' . ($currentPage - 1); ?>">
                                                    << </a>
                                            </li>
                                        <?php
                                        } else if (isset($priceFilter) && !empty($priceFilter)) {
                                        ?>
                                            <li>
                                                <a href="<?php echo './products.php?categoryId=' . $categoryId . '&price=' . $priceFilter . '&page=' . ($currentPage - 1); ?>">
                                                    << </a>
                                            </li>
                                        <?php
                                        } else if (isset($ram) && !empty($ram)) {
                                        ?>
                                            <li>
                                                <a href="<?php echo './products.php?categoryId=' . $categoryId . '&ram=' . $ram . '&page=' . ($currentPage - 1); ?>">
                                                    << </a>
                                            </li>
                                        <?php
                                        } else if (isset($storage) && !empty($storage)) {
                                        ?>
                                            <li>
                                                <a href="<?php echo './products.php?categoryId=' . $categoryId . '&storage=' . $storage . '&page=' . ($currentPage - 1); ?>">
                                                    << </a>
                                            </li>
                                        <?php
                                        } else if (isset($scanningFrequency) && !empty($scanningFrequency)) {
                                        ?>
                                            <li>
                                                <a href="<?php echo './products.php?categoryId=' . $categoryId . '&scanning-frequency=' . $scanningFrequency . '&page=' . ($currentPage - 1); ?>">
                                                    << </a>
                                            </li>
                                        <?php
                                        } else if (isset($colorId) && !empty($colorId)) {
                                        ?>
                                            <li>
                                                <a href="<?php echo './products.php?categoryId=' . $categoryId . '&color=' . $colorId . '&page=' . ($currentPage - 1); ?>">
                                                    << </a>
                                            </li>
                                        <?php
                                        } else {
                                        ?>
                                            <li>
                                                <a href="<?php echo './products.php?categoryId=' . $categoryId . '&page=' . ($currentPage - 1); ?>">
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
                                                <a href="<?php echo './products.php?categoryId=' . $categoryId . '&sort=' . $sort . '&page=' . $i; ?>"><?php echo $i; ?></a>
                                            <?php
                                            } else if (isset($priceFilter) && !empty($priceFilter)) {
                                            ?>
                                                <a href="<?php echo './products.php?categoryId=' . $categoryId . '&price=' . $priceFilter . '&page=' . $i; ?>"><?php echo $i; ?></a>
                                            <?php
                                            } else if (isset($ram) && !empty($ram)) {
                                            ?>
                                                <a href="<?php echo './products.php?categoryId=' . $categoryId . '&ram=' . $ram . '&page=' . $i; ?>"><?php echo $i; ?></a>
                                            <?php
                                            } else if (isset($storage) && !empty($storage)) {
                                            ?>
                                                <a href="<?php echo './products.php?categoryId=' . $categoryId . '&storage=' . $storage . '&page=' . $i; ?>"><?php echo $i; ?></a>
                                            <?php
                                            } else if (isset($scanningFrequency) && !empty($scanningFrequency)) {
                                            ?>
                                                <a href="<?php echo './products.php?categoryId=' . $categoryId . '&scanning-frequency=' . $scanningFrequency . '&page=' . $i; ?>"><?php echo $i; ?></a>
                                            <?php
                                            } else if (isset($colorId) && !empty($colorId)) {
                                            ?>
                                                <a href="<?php echo './products.php?categoryId=' . $categoryId . '&color=' . $colorId . '&page=' . $i; ?>"><?php echo $i; ?></a>
                                            <?php
                                            } else {
                                            ?>
                                                <a href="<?php echo './products.php?categoryId=' . $categoryId . '&page=' . $i; ?>"><?php echo $i; ?></a>
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
                                                <a href="<?php echo './products.php?categoryId=' . $categoryId . '&sort=' . $sort . '&page=' . ($currentPage + 1); ?>">
                                                    >> </a>
                                            </li>
                                        <?php
                                        } else if (isset($priceFilter) && !empty($priceFilter)) {
                                        ?>
                                            <li>
                                                <a href="<?php echo './products.php?categoryId=' . $categoryId . '&price=' . $priceFilter . '&page=' . ($currentPage + 1); ?>"> >> </a>
                                            </li>
                                        <?php
                                        } else if (isset($ram) && !empty($ram)) {
                                        ?>
                                            <li>
                                                <a href="<?php echo './products.php?categoryId=' . $categoryId . '&ram=' . $ram . '&page=' . ($currentPage + 1); ?>"> >> </a>
                                            </li>
                                        <?php
                                        } else if (isset($storage) && !empty($storage)) {
                                        ?>
                                            <li>
                                                <a href="<?php echo './products.php?categoryId=' . $categoryId . '&storage=' . $storage . '&page=' . ($currentPage + 1); ?>"> >> </a>
                                            </li>
                                        <?php
                                        } else if (isset($scanningFrequency) && !empty($scanningFrequency)) {
                                        ?>
                                            <li>
                                                <a href="<?php echo './products.php?categoryId=' . $categoryId . '&scanning-frequency=' . $scanningFrequency . '&page=' . ($currentPage + 1); ?>"> >> </a>
                                            </li>
                                        <?php
                                        } else if (isset($colorId) && !empty($colorId)) {
                                        ?>
                                            <li>
                                                <a href="<?php echo './products.php?categoryId=' . $categoryId . '&color=' . $colorId . '&page=' . ($currentPage + 1); ?>"> >> </a>
                                            </li>
                                        <?php
                                        } else {
                                        ?>
                                            <li>
                                                <a href="<?php echo './products.php?categoryId=' . $categoryId . '&page=' . ($currentPage + 1); ?>"> >> </a>
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

        <!-- Right sidebar -->
        <?php include('./right_sidebar.php') ?>

        <!-- Recommendations -->
        <?php include('./recommendation.php') ?>
    </div>
</div>