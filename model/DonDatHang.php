<?php
require_once 'SanPham.php';
require_once 'thanhvien.php';

class DonDatHang {
    private $maDDH;
    private $maTV;
    private $ngayDatHang;
    private $ngayGiao;
    private $daThanhToan;
    private $quaTang;
    private $tinhTrang;
    private $daXoa;
    private $thanhTien;
    public $chitietDH; 
    public $sp;
    public $tv;

    public function __construct($maDDH = null, $maTV = null, $ngayDatHang = null, $ngayGiao = null, $daThanhToan = null, $quaTang = null, $tinhTrang = null, $daXoa = null, $thanhTien = null) {
        $this->maDDH = $maDDH;
        $this->maTV = $maTV;
        $this->ngayDatHang = $ngayDatHang;
        $this->ngayGiao = $ngayGiao;
        $this->daThanhToan = $daThanhToan;
        $this->quaTang = $quaTang;
        $this->tinhTrang = $tinhTrang;
        $this->daXoa = $daXoa;
        $this->thanhTien = $thanhTien;
        $this->chitietDH = new ChiTietDonDatHang(); 
        $this->sp = new SanPham();
        $this->tv = new ThanhVien();
    }
    

    public function getMaDDH() {
        return $this->maDDH;
    }
    
    public function setMaDDH($maDDH) {
        $this->maDDH = $maDDH;
    }
    
    public function getMaTV() {
        return $this->maTV;
    }
    
    public function setMaTV($maTV) {
        $this->maTV = $maTV;
    }
    
    public function getNgayDatHang() {
        return $this->ngayDatHang;
    }
    
    public function setNgayDatHang($ngayDatHang) {
        $this->ngayDatHang = $ngayDatHang;
    }
    
    public function getNgayGiao() {
        return $this->ngayGiao;
    }
    
    public function setNgayGiao($ngayGiao) {
        $this->ngayGiao = $ngayGiao;
    }
    
    public function getDaThanhToan() {
        return $this->daThanhToan;
    }
    
    public function setDaThanhToan($daThanhToan) {
        $this->daThanhToan = $daThanhToan;
    }
    
    public function getQuaTang() {
        return $this->quaTang;
    }
    
    public function setQuaTang($quaTang) {
        $this->quaTang = $quaTang;
    }
    
    public function getTinhTrang() {
        return $this->tinhTrang;
    }
    
    public function setTinhTrang($tinhTrang) {
        $this->tinhTrang = $tinhTrang;
    }
    
    public function getDaXoa() {
        return $this->daXoa;
    }
    
    public function setDaXoa($daXoa) {
        $this->daXoa = $daXoa;
    }

    public function getThanhTien() {
        return $this->thanhTien;
    }
    
    public function setThanhTien($thanhTien) {
        $this->thanhTien = $thanhTien;
    }

    public function getTenSP() {
        return $this->sp->getTenSP();
    }

    public function getSoLuongNhap() {
        return $this->chitietDH->getSoLuong();
    }
    
    public function getDonGia() {
        return $this->sp->getDonGia();
    }
    
}

?>
