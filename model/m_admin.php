<?php 
   include_once 'm_pdo.php';
    function admin_ShowanhUser(){
    return pdo_query("SELECT * FROM taikhoan ");
    }
    function admin_getUser(){
        return pdo_query("SELECT * FROM taikhoan ORDER BY MaTK DESC LIMIT 4");
    }
    function admin_getById($MaDM){
        return pdo_query_one("SELECT * FROM  danhmuc WHERE MaDM=$MaDM");
    }
    function admin_getALLDM(){
        return pdo_query("SELECT *FROM danhmuc ");
    }     
    // function admin_checkGiaGiam() {
    //     return pdo_query_one("SELECT * FROM sanpham WHERE GiaGiam > 0");
    // }
    function danhmuc_add($MaDM,$TenDM,$MaDMC){
      pdo_execute("INSERT INTO danhmuc(`MaDM`,`TenDM`,`MaDMC`) VALUES(?,?,?)", $MaDM,$TenDM,$MaDMC);
    }
    function admin_update_DM($MaDM,$TenDM,$MaDMC){
        return pdo_execute("UPDATE danhmuc SET TenDM=?, MaDMC=? WHERE MaDM=?",$TenDM,$MaDMC,$MaDM);
    }
    function admin_delete($MaDM){
        pdo_execute("DELETE FROM danhmuc WHERE MaDM=?", $MaDM);
    } 
  
    function admin_ShowProduct(){
        return pdo_query("SELECT sp.*, dm.TenDM, dm.MaDMC FROM sanpham sp INNER JOIN danhmuc dm ON sp.MaDM=dm.MaDM WHERE GiaGiam > 0 ORDER BY sp.MaSP ASC");
    }
  
    function admin_AddProduct($MaSP, $TenSP, $anh, $SoLuong, $Gia, $GiaGiam, $MaDM, $MoTa){
    $conn = pdo_get_connection(); //gọi hàm kết nối database
    $sql = "INSERT INTO sanpham(MaSP, TenSP, AnhSP, SoLuong, Gia, GiaGiam, MaDM, MoTa)
            VALUES ('$MaSP', '$TenSP', '$anh', '$SoLuong', '$Gia', '$GiaGiam', '$MaDM', '$MoTa')";
    $conn->exec($sql); // exec the query
    $conn = null; // đóng kết nối database
    } 
    function admin_addkhuyenmai( $TenKM, $codeKhuyenMai, $soTienGiam, $ngayBatDau, $ngayKetThuc, $SoLuong) {
    return pdo_execute("INSERT INTO khuyenmai ( TenKM, CodeKM, GiaKM, NgayBatDau, NgayKetThuc, SoLuong) 
                        VALUES ( ?, ?, ?, ?, ?, ?)", 
                         $TenKM, $codeKhuyenMai, $soTienGiam, $ngayBatDau, $ngayKetThuc, $SoLuong);
    }
    function getallkm(){
        return pdo_query("SELECT * FROM khuyenmai");
    }
    function admin_getKMById($MaKM){
        return pdo_query_one("SELECT * FROM  khuyenmai WHERE MaKM=$MaKM");
    }
    function updatekm($tenKhuyenMai, $giaKhuyenMai, $ngayBatDau, $ngayKetThuc, $SoLuong, $maKhuyenMai){
         pdo_execute("UPDATE khuyenmai SET TenKM = '$tenKhuyenMai', GiaKM = '$giaKhuyenMai', NgayBatDau = '$ngayBatDau', NgayKetThuc = '$ngayKetThuc', SoLuong = '$SoLuong' WHERE MaKM = '$maKhuyenMai'");
    }
    function is_codeKM($codeKhuyenMai){
        return pdo_query_value("SELECT COUNT(*) FROM khuyenmai WHERE CodeKM = '$codeKhuyenMai'");
    }
    function xoakm($MaKM){
         pdo_execute("DELETE FROM khuyenmai WHERE MaKM = $MaKM");
    }
   
    // function history_getDM($MaDM) {
    //   return pdo_query("SELECT * FROM danhmuc dm INNER JOIN danhmuccon dmc ON dm.MaDM = dmc.MaDM INNER JOIN da s ON ct.MaSach = s.MaSach WHERE ls.MaTK=? AND ls.TrangThai=?",$MaTK, 'gio-sach');
    // }
    function admin_donhang(){
        return pdo_query("SELECT
                            hd.`MaHD`,
                            hd.`TrangThai`,
                            tk.`SoDienThoai`,
                            tk.`HoTen`
                        FROM
                            `hoadon` hd
                        JOIN
                            `taikhoan` tk ON hd.`MaTK` = tk.`MaTK`
                        WHERE 
                            hd.TrangThai!='gio-hang'
                            ");
                        }
    function suaTT($MaHD, $TrangThai){
        return pdo_execute("INSERT INTO hoadon(TrangThai) VALUE(?) WHERE MaHD = ?", $MaHD, $TrangThai);
    }
?>