<?php
class OrderInformation
{
    public static function insertAndGetPrimaryKeyOrderInformation($name, $phone, $email, $address)
    {
        $sql = "INSERT INTO thongtindathang VALUES (?, ?, ?, ?, ?)";
        $db = new Database();
        $result = $db->query($sql, [null, $name, $phone, $email, $address]);
        if ($result == true) {
            $lastInsertedId = $db->getPDO()->lastInsertId();
            return $lastInsertedId;
        }
        return false;
    }
}
