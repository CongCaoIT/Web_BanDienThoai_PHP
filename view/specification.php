<?php
$productDetail = ProductDetail::getProductDetailByProductId($productId);
if ($productDetail != null) {
?>
    <div class="collpse tabs">
        <h3 class="w3ls-title">THÔNG SỐ KỸ THUẬT</h3>
        <div class="panel-group collpse" id="accordion" role="tablist" aria-multiselectable="true">

            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a class="pa_italic" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <i class="fa fa-desktop fa-icon" aria-hidden="true"></i>Màn hình<span class="fa fa-angle-down fa-arrow" aria-hidden="true"></span> <i class="fa fa-angle-up fa-arrow" aria-hidden="true"></i>
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">

                        <div class="specification">
                            <div class="table-container">
                                <table class="table-specification">
                                    <tr class="group-header">
                                        <th colspan="2">Màn hình</th>
                                    </tr>
                                    <tr class="row-specification">
                                        <td class="col-md-4">Kích thước màn hình</td>
                                        <td class="col-md-8">
                                            <?php echo $productDetail->getKichThuocManHinh() ?>
                                        </td>
                                    </tr>
                                    <tr class="row-specification">
                                        <td class="col-md-4">Công nghệ màn hình</td>
                                        <td class="col-md-8">
                                            <?php echo $productDetail->getCongNgheManHinh() ?>
                                        </td>
                                    </tr>
                                    <tr class="row-specification">
                                        <td class="col-md-4">Độ phân giải</td>
                                        <td class="col-md-8">
                                            <?php echo $productDetail->getDoPhanGiai() ?>
                                        </td>
                                    </tr>
                                    <tr class="row-specification">
                                        <td class="col-md-4">Tính năng</td>
                                        <td class="col-md-8">
                                            <?php echo $productDetail->getTinhNangManHinh() ?>
                                        </td>
                                    </tr>
                                    <tr class="row-specification">
                                        <td class="col-md-4">Tần số quét</td>
                                        <td class="col-md-8">
                                            <?php echo $productDetail->getTanSoQuet() ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTwo">
                    <h4 class="panel-title">
                        <a class="collapsed pa_italic" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <i class="fa fa-camera fa-icon" aria-hidden="true"></i>Camera<span class="fa fa-angle-down fa-arrow" aria-hidden="true"></span> <i class="fa fa-angle-up fa-arrow" aria-hidden="true"></i>
                        </a>
                    </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="panel-body">

                        <div class="specification">
                            <div class="table-container">
                                <table class="table-specification">
                                    <tr class="group-header">
                                        <th colspan="2">Camera</th>
                                    </tr>
                                    <tr class="row-specification">
                                        <td class="col-md-4">Camera sau</td>
                                        <td class="col-md-8">
                                            <?php echo $productDetail->getCameraSau() ?>
                                        </td>
                                    </tr>
                                    <tr class="row-specification">
                                        <td class="col-md-4">Camera trước</td>
                                        <td class="col-md-8">
                                            <?php echo $productDetail->getCameraTruoc() ?>
                                        </td>
                                    </tr>
                                    <tr class="row-specification">
                                        <td class="col-md-4">Quay phim</td>
                                        <td class="col-md-8">
                                            <?php echo $productDetail->getQuayPhim() ?>
                                        </td>
                                    </tr>
                                    <tr class="row-specification">
                                        <td class="col-md-4">Tính năng</td>
                                        <td class="col-md-8">
                                            <?php echo $productDetail->getTinhNangCamera() ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingThree">
                    <h4 class="panel-title">
                        <a class="collapsed pa_italic" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <i class="fa fa-android fa-icon" aria-hidden="true"></i>Hệ điều hành & CPU<span class="fa fa-angle-down fa-arrow" aria-hidden="true"></span> <i class="fa fa-angle-up fa-arrow" aria-hidden="true"></i>
                        </a>
                    </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="panel-body">

                        <div class="specification">
                            <div class="table-container">
                                <table class="table-specification">
                                    <tr class="group-header">
                                        <th colspan="2">Hệ điều hành & CPU</th>
                                    </tr>
                                    <tr class="row-specification">
                                        <td class="col-md-4">Hệ điều hành</td>
                                        <td class="col-md-8">
                                            <?php echo $productDetail->getHeDieuHanh() ?>
                                        </td>
                                    </tr>
                                    <tr class="row-specification">
                                        <td class="col-md-4">Chip xử lý (CPU)</td>
                                        <td class="col-md-8">
                                            <?php echo $productDetail->getChip() ?>
                                        </td>
                                    </tr>
                                    <tr class="row-specification">
                                        <td class="col-md-4">Tốc độ CPU</td>
                                        <td class="col-md-8">
                                            <?php echo $productDetail->getTocDoCPU() ?>
                                        </td>
                                    </tr>
                                    <tr class="row-specification">
                                        <td class="col-md-4">Chip đồ họa (GPU)</td>
                                        <td class="col-md-8">
                                            <?php echo $productDetail->getChipDoHoa() ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingFour">
                    <h4 class="panel-title">
                        <a class="collapsed pa_italic" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            <i class="fa fa-hdd-o fa-icon" aria-hidden="true"></i>Bộ nhớ & Lưu trữ<span class="fa fa-angle-down fa-arrow" aria-hidden="true"></span> <i class="fa fa-angle-up fa-arrow" aria-hidden="true"></i>
                        </a>
                    </h4>
                </div>
                <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                    <div class="panel-body">

                        <div class="specification">
                            <div class="table-container">
                                <table class="table-specification">
                                    <tr class="group-header">
                                        <th colspan="2">Bộ nhớ & Lưu trữ</th>
                                    </tr>
                                    <tr class="row-specification">
                                        <td class="col-md-4">Ram</td>
                                        <td class="col-md-8">
                                            <?php echo $productDetail->getRam() ?>
                                        </td>
                                    </tr>
                                    <tr class="row-specification">
                                        <td class="col-md-4">Dung lượng</td>
                                        <td class="col-md-8">
                                            <?php echo $productDetail->getDungLuong() ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingFive">
                    <h4 class="panel-title">
                        <a class="collapsed pa_italic" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            <i class="fa fa-wifi fa-icon" aria-hidden="true"></i>Kết nối<span class="fa fa-angle-down fa-arrow" aria-hidden="true"></span> <i class="fa fa-angle-up fa-arrow" aria-hidden="true"></i>
                        </a>
                    </h4>
                </div>
                <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                    <div class="panel-body">

                        <div class="specification">
                            <div class="table-container">
                                <table class="table-specification">
                                    <tr class="group-header">
                                        <th colspan="2">Kết nối</th>
                                    </tr>
                                    <tr class="row-specification">
                                        <td class="col-md-4">Mạng di động</td>
                                        <td class="col-md-8">
                                            <?php echo $productDetail->getMangDiDong() ?>
                                        </td>
                                    </tr>
                                    <tr class="row-specification">
                                        <td class="col-md-4">Sim</td>
                                        <td class="col-md-8">
                                            <?php echo $productDetail->getSim() ?>
                                        </td>
                                    </tr>
                                    <tr class="row-specification">
                                        <td class="col-md-4">Wifi</td>
                                        <td class="col-md-8">
                                            <?php echo $productDetail->getWifi() ?>
                                        </td>
                                    </tr>
                                    <tr class="row-specification">
                                        <td class="col-md-4">Cổng kết nối/sạc</td>
                                        <td class="col-md-8">
                                            <?php echo $productDetail->getCongKetNoi() ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingSix">
                    <h4 class="panel-title">
                        <a class="collapsed pa_italic" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                            <i class="fa fa-battery-full fa-icon" aria-hidden="true"></i>Pin & Sạc<span class="fa fa-angle-down fa-arrow" aria-hidden="true"></span> <i class="fa fa-angle-up fa-arrow" aria-hidden="true"></i>
                        </a>
                    </h4>
                </div>
                <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
                    <div class="panel-body">

                        <div class="specification">
                            <div class="table-container">
                                <table class="table-specification">
                                    <tr class="group-header">
                                        <th colspan="2">Pin & Sạc</th>
                                    </tr>
                                    <tr class="row-specification">
                                        <td class="col-md-4">Dung lượng pin</td>
                                        <td class="col-md-8">
                                            <?php echo $productDetail->getDungLuongPin() ?>
                                        </td>
                                    </tr>
                                    <tr class="row-specification">
                                        <td class="col-md-4">Loại pin</td>
                                        <td class="col-md-8">
                                            <?php echo $productDetail->getLoaiPin() ?>
                                        </td>
                                    </tr>
                                    <tr class="row-specification">
                                        <td class="col-md-4">Hỗ trợ sạc tối đa</td>
                                        <td class="col-md-8">
                                            <?php echo $productDetail->getHoTroSac() ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingSeven">
                    <h4 class="panel-title">
                        <a class="collapsed pa_italic" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                            <i class="fa fa-thumbs-up fa-icon" aria-hidden="true"></i>Tiện ích<span class="fa fa-angle-down fa-arrow" aria-hidden="true"></span> <i class="fa fa-angle-up fa-arrow" aria-hidden="true"></i>
                        </a>
                    </h4>
                </div>
                <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
                    <div class="panel-body">

                        <div class="specification">
                            <div class="table-container">
                                <table class="table-specification">
                                    <tr class="group-header">
                                        <th colspan="2">Tiện ích</th>
                                    </tr>
                                    <tr class="row-specification">
                                        <td class="col-md-4">Bảo mật nâng cao</td>
                                        <td class="col-md-8">
                                            <?php echo $productDetail->getBaoMat() ?>
                                        </td>
                                    </tr>
                                    <tr class="row-specification">
                                        <td class="col-md-4">Tính năng đặc biệt</td>
                                        <td class="col-md-8">
                                            <?php echo $productDetail->getTinhNangDacBiet() ?>
                                        </td>
                                    </tr>
                                    <tr class="row-specification">
                                        <td class="col-md-4">Kháng nước, bụi</td>
                                        <td class="col-md-8">
                                            <?php echo $productDetail->getKhangNuoc() ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingEight">
                    <h4 class="panel-title">
                        <a class="collapsed pa_italic" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                            <i class="fa fa-info-circle fa-icon" aria-hidden="true"></i>Thông tin chung<span class="fa fa-angle-down fa-arrow" aria-hidden="true"></span> <i class="fa fa-angle-up fa-arrow" aria-hidden="true"></i>
                        </a>
                    </h4>
                </div>
                <div id="collapseEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEight">
                    <div class="panel-body">

                        <div class="specification">
                            <div class="table-container">
                                <table class="table-specification">
                                    <tr class="group-header">
                                        <th colspan="2">Thông tin chung</th>
                                    </tr>
                                    <tr class="row-specification">
                                        <td class="col-md-4">Thiết kế</td>
                                        <td class="col-md-8">
                                            <?php echo $productDetail->getThietKe() ?>
                                        </td>
                                    </tr>
                                    <tr class="row-specification">
                                        <td class="col-md-4">Chất liệu</td>
                                        <td class="col-md-8">
                                            <?php echo $productDetail->getChatLieu() ?>
                                        </td>
                                    </tr>
                                    <tr class="row-specification">
                                        <td class="col-md-4">Kích thước, khối lượng</td>
                                        <td class="col-md-8">
                                            <?php echo $productDetail->getKichThuoc() ?>
                                        </td>
                                    </tr>
                                    <tr class="row-specification">
                                        <td class="col-md-4">Bảo hành</td>
                                        <td class="col-md-8">
                                            <?php echo $productDetail->getBaoHanh() ?> tháng
                                        </td>
                                    </tr>
                                    <tr class="row-specification">
                                        <td class="col-md-4">Thời điểm ra mắt</td>
                                        <td class="col-md-8">
                                            <?php echo date('d/m/Y', strtotime($productDetail->getRaMat())) ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
<?php
}
?>