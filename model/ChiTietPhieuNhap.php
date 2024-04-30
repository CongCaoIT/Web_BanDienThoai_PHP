<?php
require_once 'SanPham.php';
require_once 'PhieuNhap.php';
require_once 'NhaCungCap.php';

class ChiTietPhieuNhap {
    private $maCTPN;
    private $maPN;
    private $maSP;
    private $donGiaNhap;
    private $soLuongNhap;
    public $sp;
    public $pn;
    public $ncc;

    public function __construct($maCTPN = null, $maPN = null, $maSP = null, $donGiaNhap = null, $soLuongNhap = null) {
        $this->maCTPN = $maCTPN;
        $this->maPN = $maPN;
        $this->maSP = $maSP;
        $this->donGiaNhap = $donGiaNhap;
        $this->soLuongNhap = $soLuongNhap;
        $this->sp = new SanPham();
        $this->pn = new PhieuNhap();
        $this->ncc = new NhaCungCap();
    }

    public function getMaCTPN() {
        return $this->maCTPN;
    }
    
    public function setMaCTPN($maCTPN) {
        $this->maCTPN = $maCTPN;
    }
    
    public function getMaPN() {
        return $this->maPN;
    }
    
    public function setMaPN($maPN) {
        $this->maPN = $maPN;
    }
    
    public function getMaSP() {
        return $this->maSP;
    }
    
    public function setMaSP($maSP) {
        $this->maSP = $maSP;
    }
    
    public function getDonGiaNhap() {
        return $this->donGiaNhap;
    }
    
    public function setDonGiaNhap($donGiaNhap) {
        $this->donGiaNhap = $donGiaNhap;
    }
    
    public function getSoLuongNhap() {
        return $this->soLuongNhap;
    }
    
    public function setSoLuongNhap($soLuongNhap) {
        $this->soLuongNhap = $soLuongNhap;
    }
    
}

?>
