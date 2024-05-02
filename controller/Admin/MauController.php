<?php
include_once '../model/config/config.php';
include_once '../model/lib/database.php';
include '../model/Mau.php';
include '../model/SanPham_Mau.php';

class MauAdmin
{
    private $fm;
    private $db;
    public $completedOrders = array();
    public $updateResult;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function layTenMauSPtheoMaSP(int $masp)
    {
        $query = "SELECT MAU.TenMau, SANPHAM_MAU.SoLuongTon
        FROM SANPHAM
        JOIN SANPHAM_MAU ON SANPHAM.MaSP = SANPHAM_MAU.MaSP
        JOIN MAU ON SANPHAM_MAU.MaMau = MAU.MaMau
        WHERE SANPHAM.MaSP = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $masp);
        $stmt->execute();
        $result = $stmt->get_result();
        $dsMau = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $mau = new Mau();
                $mau->setTenMau($row['TenMau']);
                $dsMau[] = $mau;
            }
        } else {
            return null;
        }
        return $dsMau;
    }

    public function laySLTSPtheoMaSP(int $masp)
    {
        $query = "SELECT SANPHAM_MAU.SoLuongTon
        FROM SANPHAM
        JOIN SANPHAM_MAU ON SANPHAM.MaSP = SANPHAM_MAU.MaSP
        WHERE SANPHAM.MaSP = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $masp);
        $stmt->execute();
        $result = $stmt->get_result();
        $dsSLT = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $slt = new SanPham_Mau();
                $slt->setSoLuongTon($row['SoLuongTon']);
                $dsSLT[] = $slt;
            }
        } else {
            return null;
        }
        return $dsSLT;
    }

    public function layDSMau()
    {
        $query = "SELECT * FROM `mau`";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $dsMau = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $mau = new Mau();
                $mau->setMaMau($row['MaMau']);
                $mau->setTenMau($row['TenMau']);
                $dsMau[] = $mau;
            }
        } else {
            return null;
        }
        return $dsMau;
    }

    public function themMau(int $masp, int $mamau)
    {
        $query = "INSERT INTO `sanpham_mau`(`MaSP`, `MaMau`) VALUES (?, ?)";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $masp, $mamau);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
