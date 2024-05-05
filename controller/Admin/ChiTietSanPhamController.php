<?php
include_once '../model/config/config.php';
include_once '../model/lib/database.php';
include '../model/ChiTietSanPham.php';

class ChiTietSanPhamAdmin
{
    private $fm;
    private $db;
    public $completedOrders = array();
    public $updateResult;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function layCTSPtheoMaSP(int $masp)
    {
        $query = "SELECT * FROM `chitietsanpham` WHERE `MaSP` = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $masp);
        $stmt->execute();
        $result = $stmt->get_result();
        $dsCTSP = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ctsp = new ChiTietSanPham();
                $ctsp->setMaChiTietSP($row['MaChiTietSP']);
                $ctsp->setMaSP($row['MaSP']);
                $ctsp->setKichThuocManHinh($row['KICHTHUOCMANHINH']);
                $ctsp->setCongNgheManHinh($row['CONGNGHEMANHINH']);
                $ctsp->setDoPhanGiai($row['DOPHANGIAI']);
                $ctsp->setTinhNangManHinh($row['TINHNANGMANGHINH']);
                $ctsp->setTanSoQuet($row['TANSOQUET']);
                $ctsp->setCameraSau($row['CAMERASAU']);
                $ctsp->setQuayPhim($row['QUAYPHIM']);
                $ctsp->setCameraTruoc($row['CAMERATRUOC']);
                $ctsp->setTinhNangCamera($row['TINHNANGCAMERA']);
                $ctsp->setHeDieuHanh($row['HEDIEUHANH']);
                $ctsp->setChip($row['CHIP']);
                $ctsp->setTocDoCPU($row['TOCDOCPU']);
                $ctsp->setChipDoHoa($row['CHIPDOHOA']);
                $ctsp->setRam($row['RAM']);
                $ctsp->setDungLuong($row['DUNGLUONG']);
                $ctsp->setMangDiDong($row['MANGDIDONG']);
                $ctsp->setSim($row['SIM']);
                $ctsp->setWifi($row['WIFI']);
                $ctsp->setCongKetNoi($row['CONGKETNOI']);
                $ctsp->setDungLuongPin($row['DUNGLUONGPIN']);
                $ctsp->setLoaiPin($row['LOAIPIN']);
                $ctsp->setHoTroSac($row['HOTROSAC']);
                $ctsp->setBaoMat($row['BAOMAT']);
                $ctsp->setTinhNangDacBiet($row['TINHNANGDACBIET']);
                $ctsp->setKhangNuoc($row['KHANGNUOC']);
                $ctsp->setThietKe($row['THIETKE']);
                $ctsp->setChatLieu($row['CHATLIEU']);
                $ctsp->setKichThuoc($row['KICHTHUOC']);
                $ctsp->setBaoHanh($row['BAOHANH']);
                $ctsp->setRaMat($row['RAMAT']);
                $dsCTSP[] = $ctsp;
            }
        } else {
            return null;
        }
        return $dsCTSP;
    }

    public function layCTSPtheoMaLoaiSP(int $maloaisp)
    {
        $query = "SELECT * FROM `chitietsanpham`, `sanpham` WHERE chitietsanpham.MaSP = sanpham.MaSP AND sanpham.MaLoaiSP = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $maloaisp);
        $stmt->execute();
        $result = $stmt->get_result();
        $dsCTSP = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ctsp = new ChiTietSanPham();
                $ctsp->setMaChiTietSP($row['MaChiTietSP']);
                $ctsp->setMaSP($row['MaSP']);
                $ctsp->setKichThuocManHinh($row['KICHTHUOCMANHINH']);
                $ctsp->setCongNgheManHinh($row['CONGNGHEMANHINH']);
                $ctsp->setDoPhanGiai($row['DOPHANGIAI']);
                $ctsp->setTinhNangManHinh($row['TINHNANGMANGHINH']);
                $ctsp->setTanSoQuet($row['TANSOQUET']);
                $ctsp->setCameraSau($row['CAMERASAU']);
                $ctsp->setQuayPhim($row['QUAYPHIM']);
                $ctsp->setCameraTruoc($row['CAMERATRUOC']);
                $ctsp->setTinhNangCamera($row['TINHNANGCAMERA']);
                $ctsp->setHeDieuHanh($row['HEDIEUHANH']);
                $ctsp->setChip($row['CHIP']);
                $ctsp->setTocDoCPU($row['TOCDOCPU']);
                $ctsp->setChipDoHoa($row['CHIPDOHOA']);
                $ctsp->setRam($row['RAM']);
                $ctsp->setDungLuong($row['DUNGLUONG']);
                $ctsp->setMangDiDong($row['MANGDIDONG']);
                $ctsp->setSim($row['SIM']);
                $ctsp->setWifi($row['WIFI']);
                $ctsp->setCongKetNoi($row['CONGKETNOI']);
                $ctsp->setDungLuongPin($row['DUNGLUONGPIN']);
                $ctsp->setLoaiPin($row['LOAIPIN']);
                $ctsp->setHoTroSac($row['HOTROSAC']);
                $ctsp->setBaoMat($row['BAOMAT']);
                $ctsp->setTinhNangDacBiet($row['TINHNANGDACBIET']);
                $ctsp->setKhangNuoc($row['KHANGNUOC']);
                $ctsp->setThietKe($row['THIETKE']);
                $ctsp->setChatLieu($row['CHATLIEU']);
                $ctsp->setKichThuoc($row['KICHTHUOC']);
                $ctsp->setBaoHanh($row['BAOHANH']);
                $ctsp->setRaMat($row['RAMAT']);
                $dsCTSP[] = $ctsp;
            }
        } else {
            return null;
        }
        return $dsCTSP;
    }

    public function themChiTietSanPham(int $masp, $kichthuocmanhinh, $congnghemanhinh, $dophangiai, $tinhnangmanhinh, $tansoquet, $camerasau, $quayphim, $cameratruoc, $tinhnangcamera, $hedieuhanh, $chip, $tocdocpu, $chipdohoa, $ram, $dungluong, $mangdidong, $sim, $wifi, $congketnoi, $dungluongpin, $loaipin, $hotrosac, $baomat, $tinhnangdacbiet, $khangnuoc, $thietke, $chatlieu, $kichthuoc, $baohanh, $ramat)
    {
        $ramat = date('Y-m-d', strtotime($ramat));
        $query = "INSERT INTO `chitietsanpham`(`MaSP`, `KICHTHUOCMANHINH`, `CONGNGHEMANHINH`, `DOPHANGIAI`, `TINHNANGMANGHINH`, `TANSOQUET`, `CAMERASAU`, `QUAYPHIM`, `CAMERATRUOC`, `TINHNANGCAMERA`, `HEDIEUHANH`, `CHIP`, `TOCDOCPU`, `CHIPDOHOA`, `RAM`, `DUNGLUONG`, `MANGDIDONG`, `SIM`, `WIFI`, `CONGKETNOI`, `DUNGLUONGPIN`, `LOAIPIN`, `HOTROSAC`, `BAOMAT`, `TINHNANGDACBIET`, `KHANGNUOC`, `THIETKE`, `CHATLIEU`, `KICHTHUOC`, `BAOHANH`, `RAMAT`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param(
            "issssssssssssssssssssssssssssss",
            $masp,
            $kichthuocmanhinh,
            $congnghemanhinh,
            $dophangiai,
            $tinhnangmanhinh,
            $tansoquet,
            $camerasau,
            $quayphim,
            $cameratruoc,
            $tinhnangcamera,
            $hedieuhanh,
            $chip,
            $tocdocpu,
            $chipdohoa,
            $ram,
            $dungluong,
            $mangdidong,
            $sim,
            $wifi,
            $congketnoi,
            $dungluongpin,
            $loaipin,
            $hotrosac,
            $baomat,
            $tinhnangdacbiet,
            $khangnuoc,
            $thietke,
            $chatlieu,
            $kichthuoc,
            $baohanh,
            $ramat
        );

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function kiemtraCTSP($masp)
    {
        $query = "SELECT * FROM `chitietsanpham` WHERE `MaSP` = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $masp);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return false;
        } else {
            return true;
        }
    }
}
