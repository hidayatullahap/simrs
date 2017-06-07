<?php
require_once CLASSES_DIR  . 'dbconnection.php';

class JenisPasien{

    public function getData($sort, $page, $limitItemPage)
    {   
        $db=new DB;
        $conn=$db->connect();
        $page=($page*$limitItemPage)-$limitItemPage;
        $query =
        "SELECT * FROM aturan_pakai_obat ORDER BY `aturan_pakai_obat`.`aturan_pakai_id` $sort LIMIT $page,$limitItemPage";
        $result = $conn->query($query);
        
        $sql = $conn->query("SELECT COUNT(*) FROM aturan_pakai_obat");
        $row = $sql->fetch_row();
        $count = $row[0];
        $totalData = $count;
        $totalPages = ceil($totalData/$limitItemPage);
        $data = array("data"=>$result, "currentPage"=>$page/$limitItemPage+1, "totalPages"=>$totalPages, "totalData"=>$totalData);

        return $data;
    }

    public function getOne($id)
    {   
        $db=new DB;
        $conn=$db->connect();
        $query =
        "SELECT * FROM aturan_pakai_obat WHERE aturan_pakai_obat.aturan_pakai_id = $id";
        $result = $conn->query($query);
        $data = array("data"=>$result);
        
        return $data;
    }

    public function postData()
    {   
        $db=new DB;
        $conn=$db->connect();
        $nama_aturan_pakai = $_POST['nama_aturan_pakai'];

        $query =
        "INSERT INTO aturan_pakai_obat(nama_aturan_pakai) VALUES ('$nama_aturan_pakai')";
        $result = $conn->query($query);
        return $result;
    }

    public function editData($id)
    {   
        $db=new DB;
        $conn=$db->connect();
        $nama_aturan_pakai = $_POST['nama_aturan_pakai'];

        $query =
        "UPDATE `aturan_pakai_obat` SET `nama_aturan_pakai` = '$nama_aturan_pakai' WHERE `aturan_pakai_obat`.`aturan_pakai_id` = $id";
        $result = $conn->query($query);
        return $result;
    }

    public function deleteData($id)
    {
        $db=new DB;
        $conn=$db->connect();
        $query ="DELETE FROM `aturan_pakai_obat` WHERE `aturan_pakai_obat`.`aturan_pakai_id` = $id";
        $result = $conn->query($query);
        return $result;
        
    }

    public function searchData($search)
    {   
        $db=new DB;
        $conn=$db->connect();

        $query = 
        "SELECT * FROM aturan_pakai_obat WHERE aturan_pakai_obat.nama_aturan_pakai LIKE '%$search%'";

        $result = $conn->query($query);
        $data = array("data"=>$result);
        
        return $data;
    }
}
?>