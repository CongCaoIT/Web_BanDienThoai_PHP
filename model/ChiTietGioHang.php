<?php

class ChiTietGioHang {
    private $maChiTietGH;
    private $maGioHang;
    private $maSP;
    private $soLuong;
    private $donGia;
    private $maMau;

    public function __construct($maChiTietGH, $maGioHang, $maSP, $soLuong, $donGia, $maMau) {
        $this->maChiTietGH = $maChiTietGH;
        $this->maGioHang = $maGioHang;
        $this->maSP = $maSP;
        $this->soLuong = $soLuong;
        $this->donGia = $donGia;
        $this->maMau = $maMau;
    }

    // Getter và setter cho maChiTietGH
    public function getMaChiTietGH() {
        return $this->maChiTietGH;
    }

    public function setMaChiTietGH($maChiTietGH) {
        $this->maChiTietGH = $maChiTietGH;
    }

    // Getter và setter cho maGioHang
    public function getMaGioHang() {
        return $this->maGioHang;
    }

    public function setMaGioHang($maGioHang) {
        $this->maGioHang = $maGioHang;
    }

    // Getter và setter cho maSP
    public function getMaSP() {
        return $this->maSP;
    }

    public function setMaSP($maSP) {
        $this->maSP = $maSP;
    }

    // Getter và setter cho soLuong
    public function getSoLuong() {
        return $this->soLuong;
    }

    public function setSoLuong($soLuong) {
        $this->soLuong = $soLuong;
    }

    // Getter và setter cho donGia
    public function getDonGia() {
        return $this->donGia;
    }

    public function setDonGia($donGia) {
        $this->donGia = $donGia;
    }

    // Getter và setter cho maMau
    public function getMaMau() {
        return $this->maMau;
    }

    public function setMaMau($maMau) {
        $this->maMau = $maMau;
    }
}

?>
