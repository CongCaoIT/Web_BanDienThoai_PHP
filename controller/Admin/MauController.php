<?php
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
        $query = "SELECT mau.MaMau, mau.TenMau FROM `sanpham` JOIN `sanpham_mau` ON sanpham.MaSP = sanpham_mau.MaSP JOIN `mau` ON sanpham_mau.MaMau = mau.MaMau WHERE sanpham.MaSP = ?;";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $masp);
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

    public function laySLTSPtheoMaSP(int $masp)
    {
        $query = "SELECT sanpham_mau.SoLuongTon FROM `sanpham` JOIN `sanpham_mau` ON sanpham.MaSP = sanpham_mau.MaSP WHERE sanpham.MaSP = ?";
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

    public function updateSoLuongTon1($mapn, $masp)
    {
        $query = "UPDATE sanpham_mau, mau, chitietphieunhap SET SoLuongTon = SoLuongTon + chitietphieunhap.SoLuongNhapMau1 WHERE sanpham_mau.MaMau = mau.MaMau AND mau.MaMau = chitietphieunhap.MaMau1 AND chitietphieunhap.MaPN = ? AND sanpham_mau.MaSP = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $mapn, $masp);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateSoLuongTon2($mapn, $masp)
    {
        $query = "UPDATE sanpham_mau, mau, chitietphieunhap SET SoLuongTon = SoLuongTon + chitietphieunhap.SoLuongNhapMau2 WHERE sanpham_mau.MaMau = mau.MaMau AND mau.MaMau = chitietphieunhap.MaMau2 AND chitietphieunhap.MaPN = ? AND sanpham_mau.MaSP = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $mapn, $masp);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
