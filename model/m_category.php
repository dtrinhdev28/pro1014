<?php 
    include_once 'm_pdo.php';
    function category_getALLDM(){
        return pdo_query("SELECT danhmuc.TenDM, danhmuccon.TenDMC,danhmuc.MaDM as MaDM,danhmuccon.MaDMC as MaDMC FROM danhmuc INNER JOIN danhmuccon ON danhmuc.MaDM = danhmuccon.MaDM ORDER BY danhmuc.MaDM ASC;");
    }
    function category_getbyDMandDMC($MaDM, $MaDMC) {
        return pdo_query("SELECT * FROM sanpham sp INNER JOIN danhmuc dm ON sp.MaDM = dm.MaDM INNER JOIN danhmuccon dmc ON dm.MaDM = dmc.MaDM WHERE dm.MaDM = ? AND dmc.MaDMC = ?",$MaDM, $MaDMC);
    }
    function category_getbyDM($MaDM) {
        return pdo_query("SELECT * FROM sanpham sp INNER JOIN danhmuc dm ON sp.MaDM = dm.MaDM WHERE dm.MaDM = ? ",$MaDM);
    }
    function get_id($id){
        return pdo_query_one("SELECT * FROM danhmuc WHERE MaDM = $id");
    }
    function get_categorybyid($id, $start, $limit) {
        return pdo_query("SELECT * FROM sanpham WHERE MaDM = ? ORDER BY sanpham.MaSP DESC LIMIT $start, $limit", $id);
    }
    
    function count_productsbydm($MaDM){
        return pdo_query_value("SELECT COUNT(MaSP) FROM sanpham sp INNER JOIN danhmuc dm ON sp.MaDM = dm.MaDM WHERE dm.MaDM = ?", $MaDM);
    }
    function count_productsbydm_anddmc($MaDM, $MaDMC){
        return pdo_query_value("SELECT COUNT(MaSP) FROM sanpham sp INNER JOIN danhmuc dm ON sp.MaDM = dm.MaDM INNER JOIN danhmuccon dmc ON dm.MaDM = dmc.MaDM WHERE dm.MaDM = ? AND dmc.MaDMC = ?", $MaDM, $MaDMC);
    }
?>
