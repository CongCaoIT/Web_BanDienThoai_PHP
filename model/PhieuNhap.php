<?php

class PhieuNhap {
    private $maPN;
    private $maNCC;
    private $ngayNhap;
    private $daXoa;

    public function __construct($maPN = null, $maNCC = null, $ngayNhap = null, $daXoa = null ) {
        $this->maPN = $maPN;
        $this->maNCC = $maNCC;
        $this->ngayNhap = $ngayNhap;
        $this->daXoa = $daXoa;
    }

    public function getMaPN() {
        return $this->maPN;
    }

    public function setMaPN($maPN) {
        $this->maPN = $maPN;
    }

    public function getMaNCC() {
        return $this->maNCC;
    }

    public function setMaNCC($maNCC) {
        $this->maNCC = $maNCC;
    }

    public function getNgayNhap() {
        return $this->ngayNhap;
    }

    public function setNgayNhap($ngayNhap) {
        $this->ngayNhap = $ngayNhap;
    }

    public function getDaXoa() {
        return $this->daXoa;
    }

    public function setDaXoa($daXoa) {
        $this->daXoa = $daXoa;
    }
}

?>
