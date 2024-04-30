<?php

class LoaiThanhVien {
    private $maLoaiTV;
    private $tenLoai;
    private $uuDai;

    public function __construct($maLoaiTV = null, $tenLoai = null, $uuDai = null) {
        $this->maLoaiTV = $maLoaiTV;
        $this->tenLoai = $tenLoai;
        $this->uuDai = $uuDai;
    }

    public function getMaLoaiTV() {
        return $this->maLoaiTV;
    }

    public function setMaLoaiTV($maLoaiTV) {
        $this->maLoaiTV = $maLoaiTV;
    }

    public function getTenLoai() {
        return $this->tenLoai;
    }

    public function setTenLoai($tenLoai) {
        $this->tenLoai = $tenLoai;
    }

    public function getUuDai() {
        return $this->uuDai;
    }

    public function setUuDai($uuDai) {
        $this->uuDai = $uuDai;
    }
}

?>