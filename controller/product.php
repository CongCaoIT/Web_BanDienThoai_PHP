<?php
class Product
{
    public static function getRandomProductsByCategory($categoryId)
    {
        $products = array();
        $sql = "SELECT * FROM sanpham WHERE MaLoaiSP = ? ORDER BY RAND() LIMIT 6";
        $db = new Database();
        $result = $db->fetchAll($sql, [$categoryId]);
        if (count($result) > 0) {
            foreach ($result as $item) {
                array_push($products, new SanPham($item));
            }
        }
        return $products;
    }

    public static function getRandomProducts()
    {
        $products = array();
        $sql = "SELECT * FROM sanpham ORDER BY RAND() LIMIT 12";
        $db = new Database();
        $result = $db->fetchAll($sql);
        if (count($result) > 0) {
            foreach ($result as $item) {
                array_push($products, new SanPham($item));
            }
        }
        return $products;
    }

    public static function getProductsByCategory($categoryId)
    {
        $products = array();
        $sql = "SELECT * FROM sanpham WHERE MaLoaiSP = ?";
        $db = new Database();
        $result = $db->fetchAll($sql, [$categoryId]);
        if (count($result) > 0) {
            foreach ($result as $item) {
                array_push($products, new SanPham($item));
            }
        }
        return $products;
    }

    public static function getPriceByDeal($product)
    {
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

        return $product->getDonGia() - ($product->getDonGia() * $discount / 100);
    }

    public static function getProductsByCategoryOrderByPriceDesc($categoryId)
    {
        $products = Product::getProductsByCategory($categoryId);

        usort($products, function ($product1, $product2) {
            $price1 = Product::getPriceByDeal($product1);

            $price2 = Product::getPriceByDeal($product2);

            return $price2 - $price1;
        });

        return $products;
    }

    public static function getProductsByCategoryOrderByPriceAsc($categoryId)
    {
        $products = Product::getProductsByCategory($categoryId);

        usort($products, function ($product1, $product2) {
            $price1 = Product::getPriceByDeal($product1);

            $price2 = Product::getPriceByDeal($product2);

            return $price1 - $price2;
        });

        return $products;
    }

    public static function getMaxPriceProductByCategory($categoryId)
    {
        $product = null;
        $products = Product::getProductsByCategoryOrderByPriceDesc($categoryId);
        if (count($products) > 0) {
            $product = $products[0];
        }
        return $product;
    }

    public static function getProductsByPriceRange($firstPrice, $secondPrice, $categoryId)
    {
        $productsResult = array();
        $products = Product::getProductsByCategory($categoryId);
        foreach ($products as $product) {
            $priceDeal = Product::getPriceByDeal($product);
            if ($priceDeal >= $firstPrice && $priceDeal <= $secondPrice) {
                array_push($productsResult, $product);
            }
        }
        return $productsResult;
    }

    public static function getProductsByCategoryAndRam($categoryId, $ram)
    {
        $products = array();
        $sql = "SELECT sanpham.* FROM sanpham, chitietsanpham WHERE sanpham.MaSP = chitietsanpham.MaSP AND MaLoaiSP = ? AND RAM = ?";
        $db = new Database();
        $result = $db->fetchAll($sql, [$categoryId, $ram]);
        if (count($result) > 0) {
            foreach ($result as $item) {
                array_push($products, new SanPham($item));
            }
        }
        return $products;
    }

    public static function getProductsByCategoryAndStorage($categoryId, $storage)
    {
        $products = array();
        $sql = "SELECT sanpham.* FROM sanpham, chitietsanpham WHERE sanpham.MaSP = chitietsanpham.MaSP AND MaLoaiSP = ? AND DUNGLUONG = ?";
        $db = new Database();
        $result = $db->fetchAll($sql, [$categoryId, $storage]);
        if (count($result) > 0) {
            foreach ($result as $item) {
                array_push($products, new SanPham($item));
            }
        }
        return $products;
    }

    public static function getProductsByCategoryAndScanningFrequency($categoryId, $scanningFrequency)
    {
        $products = array();
        $sql = "SELECT sanpham.* FROM sanpham, chitietsanpham WHERE sanpham.MaSP = chitietsanpham.MaSP AND MaLoaiSP = ? AND TANSOQUET = ?";
        $db = new Database();
        $result = $db->fetchAll($sql, [$categoryId, $scanningFrequency]);
        if (count($result) > 0) {
            foreach ($result as $item) {
                array_push($products, new SanPham($item));
            }
        }
        return $products;
    }

    public static function getProductsByCategoryAndColor($categoryId, $colorId)
    {
        $products = array();
        $sql = "SELECT sanpham.* FROM sanpham, sanpham_mau WHERE MaLoaiSP = ? AND sanpham.MaSP = sanpham_mau.MaSP AND sanpham_mau.MaMau = ?";
        $db = new Database();
        $result = $db->fetchAll($sql, [$categoryId, $colorId]);
        if (count($result) > 0) {
            foreach ($result as $item) {
                array_push($products, new SanPham($item));
            }
        }
        return $products;
    }

    public static function getProductById($productId)
    {
        $product = null;
        $sql = "SELECT * FROM sanpham WHERE MaSP = ?";
        $db = new Database();
        $result = $db->fetch($sql, [$productId]);
        if ($result != false) {
            $product = new SanPham($result);
        }
        return $product;
    }

    public static function getCountOfProductByColor($productId, $colorId)
    {
        $sql = "SELECT SoLuongTon FROM sanpham_mau WHERE MaSP = ? AND MaMau = ?";
        $db = new Database();
        $result = $db->fetch($sql, [$productId, $colorId]);
        if ($result != false) {
            return $result['SoLuongTon'];
        }
        return null;
    }

    public static function getProductsByKeyword($keyword)
    {
        $products = array();
        $sql = "SELECT * FROM sanpham WHERE TenSP LIKE ?";
        $db = new Database();
        $result = $db->fetchAll($sql, ['%' . $keyword . '%']);
        if (count($result) > 0) {
            foreach ($result as $item) {
                array_push($products, new SanPham($item));
            }
        }
        return $products;
    }

    public static function getProductsByKeywordOrderByPriceDesc($keyword)
    {
        $products = Product::getProductsByKeyword($keyword);

        usort($products, function ($product1, $product2) {
            $price1 = Product::getPriceByDeal($product1);

            $price2 = Product::getPriceByDeal($product2);

            return $price2 - $price1;
        });

        return $products;
    }

    public static function getProductsByKeywordOrderByPriceAsc($keyword)
    {
        $products = Product::getProductsByKeyword($keyword);

        usort($products, function ($product1, $product2) {
            $price1 = Product::getPriceByDeal($product1);

            $price2 = Product::getPriceByDeal($product2);

            return $price1 - $price2;
        });

        return $products;
    }
}
