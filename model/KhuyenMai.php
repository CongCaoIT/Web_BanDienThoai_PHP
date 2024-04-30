<?php

class KhuyenMai {
    private $maKhuyenMai;
    private $tenKhuyenMai;
    private $moTa;
    private $phanTramGiamGia;
    private $ngayBatDau;
    private $ngayKetThuc;

    public function getMaKhuyenMai() {
        return $this->maKhuyenMai;
    }

    public function setMaKhuyenMai($maKhuyenMai) {
        $this->maKhuyenMai = $maKhuyenMai;
    }

    public function getTenKhuyenMai() {
        return $this->tenKhuyenMai;
    }

    public function setTenKhuyenMai($tenKhuyenMai) {
        $this->tenKhuyenMai = $tenKhuyenMai;
    }

    public function getMoTa() {
        return $this->moTa;
    }

    public function setMoTa($moTa) {
        $this->moTa = $moTa;
    }

    public function getPhanTramGiamGia() {
        return $this->phanTramGiamGia;
    }

    public function setPhanTramGiamGia($phanTramGiamGia) {
        $this->phanTramGiamGia = $phanTramGiamGia;
    }

    public function getNgayBatDau() {
        return $this->ngayBatDau;
    }

    public function setNgayBatDau($ngayBatDau) {
        $this->ngayBatDau = $ngayBatDau;
    }

    public function getNgayKetThuc() {
        return $this->ngayKetThuc;
    }

    public function setNgayKetThuc($ngayKetThuc) {
        $this->ngayKetThuc = $ngayKetThuc;
    }
}

?>
