<div class="header-three">
    <div class="container">
        <div class="menu">
            <div class="cd-dropdown-wrapper">
                <a class="cd-dropdown-trigger" href="#0">Danh mục sản phẩm</a>
                <nav class="cd-dropdown">
                    <a href="#0" class="cd-close">Close</a>
                    <ul class="cd-dropdown-content">

                        <!-- Load loại sản phẩm -->
                        <?php
                        $categories = Category::getAllCategories();
                        foreach ($categories as $category) {
                        ?>
                            <li>
                                <a href="./products.php?categoryId=<?php echo $category->getMaLoaiSP() ?>"><?php echo $category->getTenLoaiSP() ?></a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="move-text">
            <div class="marquee">
                <a href="#">
                    Sản phẩm mới có sẵn ở đây ......
                    <span>Được giảm giá cho tất cả sản phẩm | không tính thuế
                    </span>
                    <span>
                        Miễn phí vẫn chuyển đối với tất cả sản phẩm</span></a>
            </div>
            <script type="text/javascript" src="js/jquery.marquee.min.js"></script>
            <script>
                $(".marquee").marquee({
                    pauseOnHover: true
                });
            </script>
        </div>
    </div>
</div>