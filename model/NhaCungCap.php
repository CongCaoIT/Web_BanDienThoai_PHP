<?php

class NhaCungCap {
    private $maNCC;
    private $tenNCC;
    private $diaChi;
    private $email;
    private $soDienThoai;

    public function __construct($maNCC = null, $tenNCC = null, $diaChi = null, $email = null, $soDienThoai = null) {
        $this->maNCC = $maNCC;
        $this->tenNCC = $tenNCC;
        $this->diaChi = $diaChi;
        $this->email = $email;
        $this->soDienThoai = $soDienThoai;
    }

    public function getMaNCC() {
        return $this->maNCC;
    }

    public function setMaNCC($maNCC) {
        $this->maNCC = $maNCC;
    }

    public function getTenNCC() {
        return $this->tenNCC;
    }

    public function setTenNCC($tenNCC) {
        $this->tenNCC = $tenNCC;
    }

    public function getDiaChi() {
        return $this->diaChi;
    }

    public function setDiaChi($diaChi) {
        $this->diaChi = $diaChi;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getSoDienThoai() {
        return $this->soDienThoai;
    }

    public function setSoDienThoai($soDienThoai) {
        $this->soDienThoai = $soDienThoai;
    }
}

?>