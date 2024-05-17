<?php
class QuangCao
{
    public $maQuangCao;
    public $tieuDe;
    public $noiDung;
    public $hinhAnh;

    public function __construct($quangCao)
    {
        $this->maQuangCao = $quangCao['MaQuangCao'];
        $this->tieuDe = $quangCao['TieuDe'];
        $this->noiDung = $quangCao['NoiDung'];
        $this->hinhAnh = $quangCao['HinhAnh'];
    }
}
