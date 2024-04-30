<?php

class ChiTietDonDatHang {
    private $maChiTietDDH;
    private $maDDH;
    private $maSP;
    private $tenSP;
    private $soLuong;
    private $donGia;

    public function __construct($maChiTietDDH = null, $maDDH = null, $maSP = null, $tenSP = null, $soLuong = null, $donGia = null) {
        $this->maChiTietDDH = $maChiTietDDH;
        $this->maDDH = $maDDH;
        $this->maSP = $maSP;
        $this->tenSP = $tenSP;
        $this->soLuong = $soLuong;
        $this->donGia = $donGia;
    }
    

    public function getMaChiTietDDH() {
        return $this->maChiTietDDH;
    }
    
    public function setMaChiTietDDH($maChiTietDDH) {
        $this->maChiTietDDH = $maChiTietDDH;
    }
    
    public function getMaDDH() {
        return $this->maDDH;
    }
    
    public function setMaDDH($maDDH) {
        $this->maDDH = $maDDH;
    }
    
    public function getMaSP() {
        return $this->maSP;
    }
    
    public function setMaSP($maSP) {
        $this->maSP = $maSP;
    }
    
    public function getTenSP() {
        return $this->tenSP;
    }
    
    public function setTenSP($tenSP) {
        $this->tenSP = $tenSP;
    }
    
    public function getSoLuong() {
        return $this->soLuong;
    }
    
    public function setSoLuong($soLuong) {
        $this->soLuong = $soLuong;
    }
    
    public function getDonGia() {
        return $this->donGia;
    }
    
    public function setDonGia($donGia) {
        $this->donGia = $donGia;
    }
    
}

?>
