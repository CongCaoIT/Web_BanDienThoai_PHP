<?php
include_once '../model/config/config.php';
include_once '../model/lib/database.php';
include '../model/ChiTietSanPham.php';

class ChiTietSanPhamAdmin{
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
}