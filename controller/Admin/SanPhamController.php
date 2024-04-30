<?php
include_once '../model/config/config.php';
include_once '../model/lib/database.php';
include '../model/SanPham.php';

class SanPhamAdmin
{
    private $fm;
    private $db;
    public $completedOrders = array();
    public $updateResult;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function showSanPham(int $maloaisp)
    {
        $query = "SELECT * FROM `sanpham` WHERE `MaLoaiSP` = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $maloaisp);
        $stmt->execute();
        $result = $stmt->get_result();
        $dsSanPham = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sp = new SanPham();
                $sp->setMaSP($row['MaSP']);
                $sp->setMaNCC($row['MaNCC']);
                $sp->setMaLoaiSP($row['MaLoaiSP']);
                $sp->setMaKhuyenMai($row['MaKhuyenMai']);
                $sp->setTenSP($row['TenSP']);
                $sp->setDonGia($row['DonGia']);
                $sp->setNgayCapNhat($row['NgayCapNhat']);
                $sp->setMoTa($row['MoTa']);
                $sp->setHinhAnh($row['HinhAnh']);
                $sp->setHinhAnh2($row['HinhAnh2']);
                $sp->setHinhAnh3($row['HinhAnh3']);
                $sp->setLuotXem($row['LuotXem']);
                $sp->setLuotBinhChon($row['LuotBinhChon']);
                $sp->setLuotBinhLuan($row['LuotBinhLuan']);
                $sp->setSoLanMua($row['SoLanMua']);
                $sp->setMoi($row['Moi']);
                $sp->setDaXoa($row['DaXoa']);
                $dsSanPham[] = $sp;
            }
        } else {
            echo "Chưa có sản phẩm";
        }
        return $dsSanPham;
    }

    public function layTenSPtheoMaSP(int $masp)
    {
        $query = "SELECT `TenSP` FROM `sanpham` WHERE `MaSP` = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $masp);
        $stmt->execute();
        $result = $stmt->get_result();
        $dsSanPham = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sp = new SanPham();
                $sp->setTenSP($row['TenSP']);
                $dsSanPham[] = $sp;
            }
        } else {
            echo "Chưa có tên sản phẩm";
        }
        return $dsSanPham;
    }

    public function layKhuyenMaitheoMaSP(int $masp)
    {
        $query = "SELECT km.PhanTramGiamGia 
              FROM khuyenmai km 
              JOIN sanpham sp ON km.MaKhuyenMai = sp.MaKhuyenMai 
              WHERE sp.MaSP = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $masp);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['PhanTramGiamGia'];
        } else {
            return null; 
        }
    }

    public function themKhuyenMai(int $makm, int $masp)
    {
        $query = "UPDATE sanpham SET MaKhuyenMai = ? WHERE MaSP = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $makm, $masp);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function layThongTinKhuyenMaiTheoMa($maKhuyenMai)
    {
        $query = "SELECT NgayBatDau, NgayKetThuc FROM khuyenmai WHERE MaKhuyenMai = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $maKhuyenMai);
        $stmt->execute();
        $result = $stmt->get_result();
        $promotionInfo = $result->fetch_assoc();

        return $promotionInfo;
    }
}
