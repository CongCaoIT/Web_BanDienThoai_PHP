<?php
class Color
{
    public static function getColorsByProductId($productId)
    {
        $colors = array();
        $sql = "SELECT mau.* FROM sanpham_mau, mau WHERE MaSP = ? AND sanpham_mau.MaMau = mau.MaMau";
        $db = new Database();
        $result = $db->fetchAll($sql, [$productId]);
        if (count($result) > 0) {
            foreach ($result as $item) {
                array_push($colors, new Mau($item));
            }
        }
        return $colors;
    }

    public static function getColorById($colorId)
    {
        $color = null;
        $sql = "SELECT * FROM mau WHERE MaMau = ?";
        $db = new Database();
        $result = $db->fetch($sql, [$colorId]);
        if ($result != false) {
            $color = new Mau($result);
        }
        return $color;
    }
}
