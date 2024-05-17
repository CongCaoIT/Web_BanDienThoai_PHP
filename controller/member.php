<?php
class Member
{
    public static function checkUsernameAlreadyExists($username)
    {
        $sql = "SELECT * FROM thanhvien WHERE TaiKhoan = ?";
        $db = new Database();
        $result = $db->rowCount($sql, [$username]);
        if ($result > 0) {
            return true;
        }
        return false;
    }

    public static function checkEmailAlreadyExists($email)
    {
        $sql = "SELECT * FROM thanhvien WHERE Email = ?";
        $db = new Database();
        $result = $db->rowCount($sql, [$email]);
        if ($result > 0) {
            return true;
        }
        return false;
    }

    public static function addMember($username, $email, $password)
    {
        $sql = "INSERT INTO thanhvien VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $db = new Database();
        $result = $db->query($sql, [null, 2, $username, $password, null, null, $email, null, null, null, null, null, null]);
        if ($result == true) {
            return true;
        }
        return false;
    }

    public static function getMemberByUsernameAndPassword($username, $password)
    {
        $member = null;
        $sql = "SELECT * FROM thanhvien WHERE TaiKhoan = ? AND MatKhau = ? AND MaLoaiTV = 2";
        $db = new Database();
        $result = $db->fetch($sql, [$username, $password]);
        if ($result != false) {
            $member = new ThanhVien($result);
        }
        return $member;
    }

    public static function updateMemberById($memberId, $name, $address, $email, $phone)
    {
        $sql = "UPDATE thanhvien SET HoTen = ?, DiaChi = ?, Email = ?, SoDienThoai = ? WHERE MaTV = ?";
        $db = new Database();
        $result = $db->query($sql, [$name, $address, $email, $phone, $memberId]);
        return $result;
    }

    public static function updateAvatarMemberById($memberId, $avatar)
    {
        $sql = "UPDATE thanhvien SET HinhDaiDien = ? WHERE MaTV = ?";
        $db = new Database();
        $result = $db->query($sql, [$avatar, $memberId]);
        return $result;
    }

    public static function getMemberByMemberId($memberId)
    {
        $member = null;
        $sql = "SELECT * FROM thanhvien WHERE MaTV = ?";
        $db = new Database();
        $result = $db->fetch($sql, [$memberId]);
        if ($result != false) {
            $member = new ThanhVien($result);
        }
        return $member;
    }

    public static function updatePasswordByMemberId($memberId, $password)
    {
        $sql = "UPDATE thanhvien SET MatKhau = ? WHERE MaTV = ?";
        $db = new Database();
        $result = $db->query($sql, [$password, $memberId]);
        return $result;
    }
}
