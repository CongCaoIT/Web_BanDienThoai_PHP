<?php
class Advertisement
{
    public static function getAllAdvertisement()
    {
        $advertisements = array();
        $sql = "SELECT * FROM quangcao";
        $db = new Database();
        $result = $db->fetchAll($sql);
        if (count($result) > 0) {
            foreach ($result as $item) {
                array_push($advertisements, new QuangCao($item));
            }
        }
        return $advertisements;
    }
}
