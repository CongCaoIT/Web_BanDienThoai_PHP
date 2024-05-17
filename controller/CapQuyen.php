<?php

class CapQuyen
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function showTTTV()
    {
        $query = "SELECT thanhvien.MaTV, loaithanhvien.TenLoai, thanhvien.HoTen, thanhvien.Email, thanhvien.SoDienThoai 
        FROM thanhvien
        JOIN loaithanhvien ON thanhvien.MaLoaiTV = loaithanhvien.MaLoaiTV;";

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $dsThanhVien = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $tv = new ThanhVien();
                $tv->setMaTV($row['MaTV']);
                $tv->setHoTen($row['HoTen']);
                $tv->setEmail($row['Email']);
                $tv->setSdt($row['SoDienThoai']);
                $tv->ltv->setTenLoai($row['TenLoai']);
                $dsThanhVien[] = $tv;
            }
        }
        return $dsThanhVien;
    }

    public function getTTThanhVien(int $ma)
    {
        $query = "SELECT MaTV, HoTen, MaLoaiTV
        FROM thanhvien
        WHERE MaTV = ?;";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $ma);
        $stmt->execute();
        $result = $stmt->get_result();
        $dsTV = array();

        while ($row = $result->fetch_assoc()) {
            $dh = new ThanhVien();
            $dh->setMaTV($row['MaTV']);
            $dh->setHoTen($row['HoTen']);
            $dh->ltv->setMaLoaiTV($row['MaLoaiTV']);

            $dsTV[] = $dh;
        }

        return $dsTV;
    }

    public function capNhatQuyen($ma, $quyen)
    {
        $ma = $this->fm->validation($ma);
        $quyen = $this->fm->validation($quyen);

        // Lấy ID tài khoản đang đăng nhập từ session
        $currentAdminId = Session::get('adminId');

        // Kiểm tra nếu tài khoản hiện tại cố gắng thay đổi quyền hạn của chính nó
        if ($ma == $currentAdminId) {
            echo '<script>alert("Bạn không thể thay đổi quyền hạn của chính mình!");</script>';
            echo '<script>window.location.href = "PhanQuyenPage.php";</script>';
            return;
        }

        $query = "UPDATE thanhvien SET MaLoaiTV = '$quyen' WHERE MaTV = '$ma'";
        $result = $this->db->update($query);

        if ($result != false) {
            echo '<script>window.location.href = "PhanQuyenPage.php";</script>';
        }
    }
}
