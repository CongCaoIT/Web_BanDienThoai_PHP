<?php

class Mau {
    private $maMau;
    private $tenMau;

    public function __construct($maMau, $tenMau) {
        $this->maMau = $maMau;
        $this->tenMau = $tenMau;
    }

    // Getter và setter cho maMau
    public function getMaMau() {
        return $this->maMau;
    }

    public function setMaMau($maMau) {
        $this->maMau = $maMau;
    }

    // Getter và setter cho tenMau
    public function getTenMau() {
        return $this->tenMau;
    }

    public function setTenMau($tenMau) {
        $this->tenMau = $tenMau;
    }
}

?>
