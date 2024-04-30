<?php

class GioHang {
    private $maGioHang;
    private $maTV;

    public function __construct($maGioHang, $maTV) {
        $this->maGioHang = $maGioHang;
        $this->maTV = $maTV;
    }

    // Getter và setter cho maGioHang
    public function getMaGioHang() {
        return $this->maGioHang;
    }

    public function setMaGioHang($maGioHang) {
        $this->maGioHang = $maGioHang;
    }

    // Getter và setter cho maTV
    public function getMaTV() {
        return $this->maTV;
    }

    public function setMaTV($maTV) {
        $this->maTV = $maTV;
    }
}

?>
