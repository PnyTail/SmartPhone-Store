<?php
    require_once('../BackEnd/ConnectionDB/DB_classes.php');

    if(!isset($_POST['request']) && !isset($_GET['request'])) die(null);

    switch ($_POST['request']) {
        case 'getall':
            $donhang = (new HoaDonBUS())->select_all();
            foreach ($donhang as &$dh) {
                $dh['sanpham'] = (new ChiTietHoaDonBUS())->select_all_in_hoadon($dh['MaHD']);
                foreach ($dh['sanpham'] as &$sp) {
                    $sp['TenSP'] = (new SanPhamBUS())->select_by_id('TenSP', $sp['MaSP'])['TenSP'];
                }
            }
            die (json_encode($donhang));
            break;

        default:
            # code...
            break;
    }
?>