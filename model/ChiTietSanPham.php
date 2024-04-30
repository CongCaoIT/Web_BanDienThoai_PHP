<?php

class ChiTietSanPham {
    private $maChiTietSP;
    private $maSP;
    private $kichThuocManHinh;
    private $congNgheManHinh;
    private $doPhanGiai;
    private $tinhNangManHinh;
    private $tanSoQuet;
    private $cameraSau;
    private $quayPhim;
    private $cameraTruoc;
    private $tinhNangCamera;
    private $heDieuHanh;
    private $chip;
    private $tocDoCPU;
    private $chipDoHoa;
    private $ram;
    private $dungLuong;
    private $mangDiDong;
    private $sim;
    private $wifi;
    private $congKetNoi;
    private $dungLuongPin;
    private $loaiPin;
    private $hoTroSac;
    private $baoMat;
    private $tinhNangDacBiet;
    private $khangNuoc;
    private $thietKe;
    private $chatLieu;
    private $kichThuoc;
    private $baoHanh;
    private $ramAt;

    public function __construct($maChiTietSP = null, $maSP = null, $kichThuocManHinh = null, $congNgheManHinh = null, $doPhanGiai = null, $tinhNangManHinh = null, $tanSoQuet= null, $cameraSau= null, $quayPhim= null, $cameraTruoc = null,
     $tinhNangCamera = null, $heDieuHanh = null, $chip = null, $tocDoCPU = null, $chipDoHoa = null, $ram = null, $dungLuong = null, $mangDiDong = null, 
     $sim= null, $wifi= null, $congKetNoi= null, $dungLuongPin= null, $loaiPin= null, $hoTroSac= null, $baoMat= null, $tinhNangDacBiet= null, 
     $khangNuoc= null, $thietKe= null, $chatLieu= null, $kichThuoc= null, $baoHanh= null, $ramAt= null) {
        $this->maChiTietSP = $maChiTietSP;
        $this->maSP = $maSP;
        $this->kichThuocManHinh = $kichThuocManHinh;
        $this->congNgheManHinh = $congNgheManHinh;
        $this->doPhanGiai = $doPhanGiai;
        $this->tinhNangManHinh = $tinhNangManHinh;
        $this->tanSoQuet = $tanSoQuet;
        $this->cameraSau = $cameraSau;
        $this->quayPhim = $quayPhim;
        $this->cameraTruoc = $cameraTruoc;
        $this->tinhNangCamera = $tinhNangCamera;
        $this->heDieuHanh = $heDieuHanh;
        $this->chip = $chip;
        $this->tocDoCPU = $tocDoCPU;
        $this->chipDoHoa = $chipDoHoa;
        $this->ram = $ram;
        $this->dungLuong = $dungLuong;
        $this->mangDiDong = $mangDiDong;
        $this->sim = $sim;
        $this->wifi = $wifi;
        $this->congKetNoi = $congKetNoi;
        $this->dungLuongPin = $dungLuongPin;
        $this->loaiPin = $loaiPin;
        $this->hoTroSac = $hoTroSac;
        $this->baoMat = $baoMat;
        $this->tinhNangDacBiet = $tinhNangDacBiet;
        $this->khangNuoc = $khangNuoc;
        $this->thietKe = $thietKe;
        $this->chatLieu = $chatLieu;
        $this->kichThuoc = $kichThuoc;
        $this->baoHanh = $baoHanh;
        $this->ramAt = $ramAt;
    }

    public function getMaChiTietSP() {
        return $this->maChiTietSP;
    }
    
    public function setMaChiTietSP($maChiTietSP) {
        $this->maChiTietSP = $maChiTietSP;
    }
    
    public function getMaSP() {
        return $this->maSP;
    }
    
    public function setMaSP($maSP) {
        $this->maSP = $maSP;
    }
    
    public function getKichThuocManHinh() {
        return $this->kichThuocManHinh;
    }
    
    public function setKichThuocManHinh($kichThuocManHinh) {
        $this->kichThuocManHinh = $kichThuocManHinh;
    }
    
    public function getCongNgheManHinh() {
        return $this->congNgheManHinh;
    }
    
    public function setCongNgheManHinh($congNgheManHinh) {
        $this->congNgheManHinh = $congNgheManHinh;
    }
    
    public function getDoPhanGiai() {
        return $this->doPhanGiai;
    }
    
    public function setDoPhanGiai($doPhanGiai) {
        $this->doPhanGiai = $doPhanGiai;
    }
    
    public function getTinhNangManHinh() {
        return $this->tinhNangManHinh;
    }
    
    public function setTinhNangManHinh($tinhNangManHinh) {
        $this->tinhNangManHinh = $tinhNangManHinh;
    }
    
    public function getTanSoQuet() {
        return $this->tanSoQuet;
    }
    
    public function setTanSoQuet($tanSoQuet) {
        $this->tanSoQuet = $tanSoQuet;
    }
    
    public function getCameraSau() {
        return $this->cameraSau;
    }
    
    public function setCameraSau($cameraSau) {
        $this->cameraSau = $cameraSau;
    }
    
    public function getQuayPhim() {
        return $this->quayPhim;
    }
    
    public function setQuayPhim($quayPhim) {
        $this->quayPhim = $quayPhim;
    }
    
    public function getCameraTruoc() {
        return $this->cameraTruoc;
    }
    
    public function setCameraTruoc($cameraTruoc) {
        $this->cameraTruoc = $cameraTruoc;
    }
    
    public function getTinhNangCamera() {
        return $this->tinhNangCamera;
    }
    
    public function setTinhNangCamera($tinhNangCamera) {
        $this->tinhNangCamera = $tinhNangCamera;
    }
    
    public function getHeDieuHanh() {
        return $this->heDieuHanh;
    }
    
    public function setHeDieuHanh($heDieuHanh) {
        $this->heDieuHanh = $heDieuHanh;
    }
    
    public function getChip() {
        return $this->chip;
    }
    
    public function setChip($chip) {
        $this->chip = $chip;
    }
    
    public function getTocDoCPU() {
        return $this->tocDoCPU;
    }
    
    public function setTocDoCPU($tocDoCPU) {
        $this->tocDoCPU = $tocDoCPU;
    }
    
    public function getChipDoHoa() {
        return $this->chipDoHoa;
    }
    
    public function setChipDoHoa($chipDoHoa) {
        $this->chipDoHoa = $chipDoHoa;
    }
    
    public function getRam() {
        return $this->ram;
    }
    
    public function setRam($ram) {
        $this->ram = $ram;
    }
    
    public function getDungLuong() {
        return $this->dungLuong;
    }
    
    public function setDungLuong($dungLuong) {
        $this->dungLuong = $dungLuong;
    }
    
    public function getMangDiDong() {
        return $this->mangDiDong;
    }
    
    public function setMangDiDong($mangDiDong) {
        $this->mangDiDong = $mangDiDong;
    }
    
    public function getSim() {
        return $this->sim;
    }
    
    public function setSim($sim) {
        $this->sim = $sim;
    }
    
    public function getWifi() {
        return $this->wifi;
    }
    
    public function setWifi($wifi) {
        $this->wifi = $wifi;
    }
    
    public function getCongKetNoi() {
        return $this->congKetNoi;
    }
    
    public function setCongKetNoi($congKetNoi) {
        $this->congKetNoi = $congKetNoi;
    }
    
    public function getDungLuongPin() {
        return $this->dungLuongPin;
    }
    
    public function setDungLuongPin($dungLuongPin) {
        $this->dungLuongPin = $dungLuongPin;
    }
    
    public function getLoaiPin() {
        return $this->loaiPin;
    }
    
    public function setLoaiPin($loaiPin) {
        $this->loaiPin = $loaiPin;
    }
    
    public function getHoTroSac() {
        return $this->hoTroSac;
    }
    
    public function setHoTroSac($hoTroSac) {
        $this->hoTroSac = $hoTroSac;
    }
    
    public function getBaoMat() {
        return $this->baoMat;
    }
    
    public function setBaoMat($baoMat) {
        $this->baoMat = $baoMat;
    }
    
    public function getTinhNangDacBiet() {
        return $this->tinhNangDacBiet;
    }
    
    public function setTinhNangDacBiet($tinhNangDacBiet) {
        $this->tinhNangDacBiet = $tinhNangDacBiet;
    }
    
    public function getKhangNuoc() {
        return $this->khangNuoc;
    }
    
    public function setKhangNuoc($khangNuoc) {
        $this->khangNuoc = $khangNuoc;
    }
    
    public function getThietKe() {
        return $this->thietKe;
    }
    
    public function setThietKe($thietKe) {
        $this->thietKe = $thietKe;
    }
    
    public function getChatLieu() {
        return $this->chatLieu;
    }
    
    public function setChatLieu($chatLieu) {
        $this->chatLieu = $chatLieu;
    }
    
    public function getKichThuoc() {
        return $this->kichThuoc;
    }
    
    public function setKichThuoc($kichThuoc) {
        $this->kichThuoc = $kichThuoc;
    }
    
    public function getBaoHanh() {
        return $this->baoHanh;
    }
    
    public function setBaoHanh($baoHanh) {
        $this->baoHanh = $baoHanh;
    }
    
    public function getRamAt() {
        return $this->ramAt;
    }
    
    public function setRamAt($ramAt) {
        $this->ramAt = $ramAt;
    } 
    
}

?>
