<?php

class SanPham_Mau {
    private $maSP_Mau;
    private $maSP;
    private $soLuongTon;
    private $maMau;

    public function __construct($maSP_Mau=null, $maSP=null, $soLuongTon=null, $maMau=null) {
        $this->maSP_Mau = $maSP_Mau;
        $this->maSP = $maSP;
        $this->soLuongTon = $soLuongTon;
        $this->maMau = $maMau;
    }

    // Getter và setter cho maSP_Mau
    public function getMaSP_Mau() {
        return $this->maSP_Mau;
    }

    public function setMaSP_Mau($maSP_Mau) {
        $this->maSP_Mau = $maSP_Mau;
    }

    // Getter và setter cho maSP
    public function getMaSP() {
        return $this->maSP;
    }

    public function setMaSP($maSP) {
        $this->maSP = $maSP;
    }

    // Getter và setter cho soLuongTon
    public function getSoLuongTon() {
        return $this->soLuongTon;
    }

    public function setSoLuongTon($soLuongTon) {
        $this->soLuongTon = $soLuongTon;
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
