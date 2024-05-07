<div class="deals">
    <div class="container">
        <h3 class="w3ls-title">DANH MỤC SẢN PHẨM</h3>
        <div class="deals-row">

            <!-- Lấy các danh mục -->
            <?php
            $categories = Category::getAllCategories();
            foreach ($categories as $category) {
            ?>
                <div class="col-md-3 focus-grid" style="width: calc(100% / <?php echo count($categories) ?>)">
                    <a href="./products.php?categoryId=<?php echo $category->getMaLoaiSP() ?>" class="wthree-btn">
                        <div class="focus-image">
                            <i class="fa">
                                <img style="width: 50px;" src="./images/icon/<?php echo $category->getIcon() ?>" alt="">
                            </i>
                        </div>
                        <h4 class="clrchg"><?php echo $category->getTenLoaiSP() ?></h4>
                    </a>
                </div>
            <?php
            }
            ?>

            <div class="clearfix"></div>
        </div>
    </div>
</div>