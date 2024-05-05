<?php
include_once '../model/config/config.php';
include_once '../model/lib/database.php';
include '../model/NhaCungCap.php';

class NhaCungCapAdmin
{
    private $fm;
    private $db;
    public $completedOrders = array();
    public $updateResult;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function layDSNhaCungCap()
    {
        $query = "SELECT * FROM `nhacungcap`";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $dsNCC = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ncc = new NhaCungCap();
                $ncc->setMaNCC($row['MaNCC']);
                $ncc->setTenNCC($row['TenNCC']);
                $ncc->setDiaChi($row['DiaChi']);
                $ncc->setEmail($row['Email']);
                $ncc->setSoDienThoai($row['SoDienThoai']);
                $dsNCC[] = $ncc;
            }
        } else {
            return null;
        }
        return $dsNCC;
    }

    public function layNhaCungCaptheoMaSP($masp)
    {
        $query = "SELECT nhacungcap.MaNCC, nhacungcap.TenNCC FROM `sanpham`, `nhacungcap` WHERE sanpham.MaNCC = nhacungcap.MaNCC AND `MaSP` = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $masp);
        $stmt->execute();
        $result = $stmt->get_result();
        $dsNCC = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ncc = new NhaCungCap();
                $ncc->setMaNCC($row['MaNCC']);
                $ncc->setTenNCC($row['TenNCC']);
                $dsNCC[] = $ncc;
            }
        } else {
            return null;
        }
        return $dsNCC;
    }
}
