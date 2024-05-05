<?php
class MaHoa
{
    public function ma_hoa_md5($chuoi)
    {
        return md5($chuoi);
    }
}

// $maHoa = new MaHoa(); // Tạo một đối tượng mới của lớp MaHoa
// $chuoi_can_ma_hoa = "taopro";
// $chuoi_da_ma_hoa = $maHoa->ma_hoa_md5($chuoi_can_ma_hoa);

// echo "Chuỗi gốc: $chuoi_can_ma_hoa <br>";
// echo "Chuỗi đã mã hóa MD5: $chuoi_da_ma_hoa";
