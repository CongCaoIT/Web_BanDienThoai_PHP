<?php
class Promotion
{
    public static function getPromotionById($promotionId)
    {
        $promotion = null;
        $sql = "SELECT * FROM khuyenmai WHERE MaKhuyenMai = ?";
        $db = new Database();
        $result = $db->fetch($sql, [$promotionId]);
        if ($result != false) {
            $promotion = new KhuyenMai($result);
        }
        return $promotion;
    }
}
