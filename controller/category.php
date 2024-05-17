<?php
class Category
{
    public static function getAllCategories()
    {
        $categories = array();
        $sql = "SELECT * FROM loaisanpham";
        $db = new Database();
        $result = $db->fetchAll($sql);
        if (count($result) > 0) {
            foreach ($result as $item) {
                array_push($categories, new LoaiSanPham($item));
            }
        }
        return $categories;
    }

    public static function getCategoryById($categoryId)
    {
        $category = null;
        $sql = "SELECT * FROM loaisanpham WHERE MaLoaiSP = ?";
        $db = new Database();
        $result = $db->fetch($sql, [$categoryId]);
        if ($result != false) {
            $category = new LoaiSanPham($result);
        }
        return $category;
    }
}
