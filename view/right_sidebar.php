<div class="col-md-3 rsidebar">
    <div class="rsidebar-top">
        <div class="slider-left">
            <h4>Lọc theo giá</h4>
            <div class="row row1 scroll-pane">
                <?php
                $sql = "SELECT MAX(DonGia) DonGiaMax FROM sanpham WHERE MaLoaiSP = ?";
                $db = new Database();
                $result = $db->fetch($sql, [$categoryId]);
                $maxPrice = 0;
                if ($result != false) {
                    $maxPrice = $result['DonGiaMax'];
                }
                for ($i = 0; $i <= $maxPrice; $i += 10000000) {
                ?>
                    <p style="text-align: left;"><a style="color: black; font-size: 14px;" href="./products.php?categoryId=<?php echo $categoryId ?>&price=<?php echo $i . '-' . $i + 10000000 ?>"><?php echo number_format($i, 0, ',', '.') . ' - ' . number_format($i + 10000000, 0, ',', '.') ?></a></p>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="sidebar-row">
            <h4> Tiêu chí</h4>
            <ul class="faq">
                <li class="item1"><a href="#">Dung lượng RAM<span class="glyphicon glyphicon-menu-down"></span></a>
                    <ul>
                        <?php
                        $db = new Database();
                        $sql = "SELECT RAM FROM chitietsanpham GROUP BY RAM ORDER BY RAM ASC";
                        $result = $db->fetchAll($sql);
                        foreach ($result as $item) {
                        ?>
                            <li class="subitem1"><a href="./products.php?categoryId=<?php echo $categoryId ?>&ram=<?php echo $item['RAM'] ?>"> <?php echo $item['RAM'] ?></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </li>
                <li class="item2"><a href="#">Bộ nhớ trong<span class="glyphicon glyphicon-menu-down"></span></a>
                    <ul>
                        <?php
                        $db = new Database();
                        $sql = "SELECT DUNGLUONG FROM chitietsanpham GROUP BY DUNGLUONG ORDER BY DUNGLUONG ASC";
                        $result = $db->fetchAll($sql);
                        foreach ($result as $item) {
                        ?>
                            <li class="subitem1"><a href="./products.php?categoryId=<?php echo $categoryId ?>&storage=<?php echo $item['DUNGLUONG'] ?>"> <?php echo $item['DUNGLUONG'] ?></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </li>
                <li class="item3"><a href="#">Tần số quét<span class="glyphicon glyphicon-menu-down"></span></a>
                    <ul>
                        <?php
                        $db = new Database();
                        $sql = "SELECT TANSOQUET FROM chitietsanpham GROUP BY TANSOQUET ORDER BY TANSOQUET ASC";
                        $result = $db->fetchAll($sql);
                        foreach ($result as $item) {
                        ?>
                            <li class="subitem1"><a href="./products.php?categoryId=<?php echo $categoryId ?>&scanning-frequency=<?php echo $item['TANSOQUET'] ?>"> <?php echo $item['TANSOQUET'] ?></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </li>
            </ul>
            <!-- script for tabs -->
            <script type="text/javascript">
                $(function() {

                    var menu_ul = $('.faq > li > ul'),
                        menu_a = $('.faq > li > a');

                    menu_ul.hide();

                    menu_a.click(function(e) {
                        e.preventDefault();
                        if (!$(this).hasClass('active')) {
                            menu_a.removeClass('active');
                            menu_ul.filter(':visible').slideUp('normal');
                            $(this).addClass('active').next().stop(true, true).slideDown('normal');
                        } else {
                            $(this).removeClass('active');
                            $(this).next().stop(true, true).slideUp('normal');
                        }
                    });

                });
            </script>
            <!-- script for tabs -->
        </div>
        <!-- <div class="sidebar-row">
            <h4>DISCOUNTS</h4>
            <div class="row row1 scroll-pane">
                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Upto - 10% (20)</label>
                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>70% - 60% (5)</label>
                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>50% - 40% (7)</label>
                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>30% - 20% (2)</label>
                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>10% - 5% (5)</label>
                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>30% - 20% (7)</label>
                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>10% - 5% (2)</label>
                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Other(50)</label>
            </div>
        </div> -->
        <div class="sidebar-row">
            <h4>Màu</h4>
            <div class="row row1 scroll-pane">
                <?php
                $db = new Database();
                $sql = "SELECT * FROM mau";
                $result = $db->fetchAll($sql);
                foreach ($result as $item) {
                    $color = $item['TenMau'];
                ?>
                    <p style="text-align: left;"><a style="color: black; font-size: 14px;" href="./products.php?categoryId=<?php echo $categoryId ?>&color=<?php echo $item['MaMau']; ?>"><?php echo $color ?></a></p>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Load gợi ý tìm kiếm -->
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['categoryId'])) {
            $categoryId = $_GET['categoryId'];
            $category = Category::getCategoryById($categoryId);
            if ($category != null) {
                $fileName = '../data/search_suggestions/' . $category->getTenLoaiSP() . '.txt';
                $file = fopen($fileName, "r");
    ?>
                <div class="related-row">
                    <h4>Tìm kiếm liên quan</h4>
                    <ul>
                        <?php
                        while (!feof($file)) {
                            $word = fgets($file);
                        ?>
                            <li><a href="./search.php?keyword=<?php echo $word ?>"><?php echo $word ?> </a></li>
                        <?php
                        }

                        ?>
                    </ul>
                </div>
    <?php
                fclose($file);
            }
        }
    }
    ?>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['categoryId'])) {
            $categoryId = $_GET['categoryId'];
            $product = Product::getMaxPriceProductByCategory($categoryId);
            if ($product != null) {
                // Tính tiền sau giảm giá
                $price = Product::getPriceByDeal($product);
    ?>
                <div class="related-row">
                    <h4>CÓ THỂ BẠN SẼ THÍCH</h4>
                    <div class="galry-like">
                        <a href="./single.php?productId=<?php echo $product->getMaSP() ?>"><img src="./images/products/<?php echo $product->getHinhAnh() ?>" class="img-responsive" alt="img"></a>
                        <h4><a href="!"><?php echo $product->getTenSP() ?></a></h4>
                        <h5><?php echo number_format($price, 0, ',', '.') ?>đ</h5>
                    </div>
                </div>
    <?php
            }
        }
    }
    ?>
</div>
<div class="clearfix"> </div>