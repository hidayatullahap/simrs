<?php
require_once CLASSES_DIR  . 'dbconnection.php';

class JenisPenerimaan{

    public function getData($sort, $page, $limitItemPage)
    {   
        $db=new DB;
        $conn=$db->connect();
        $page=($page*$limitItemPage)-$limitItemPage;
        $query =
        "SELECT * FROM jenis_penerimaan ORDER BY `jenis_penerimaan`.`jenis_penerimaan_id` $sort LIMIT $page,$limitItemPage";
        $result = $conn->query($query);
        
        $sql = $conn->query("SELECT COUNT(*) FROM jenis_penerimaan");
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
        "SELECT * FROM jenis_penerimaan WHERE jenis_penerimaan.jenis_penerimaan_id = $id";
        $result = $conn->query($query);
        $data = array("data"=>$result);
        
        return $data;
    }

    public function postData()
    {   
        $db=new DB;
        $conn=$db->connect();
        $nama_jenis_penerimaan = $_POST['nama_jenis_penerimaan'];

        $query =
        "INSERT INTO jenis_penerimaan(nama_jenis_penerimaan) VALUES ('$nama_jenis_penerimaan')";
        $result = $conn->query($query);
        return $result;
    }

    public function editData($id)
    {   
        $db=new DB;
        $conn=$db->connect();
        $nama_jenis_penerimaan = $_POST['nama_jenis_penerimaan'];

        $query =
        "UPDATE `jenis_penerimaan` SET `nama_jenis_penerimaan` = '$nama_jenis_penerimaan' WHERE `jenis_penerimaan`.`jenis_penerimaan_id` = $id";
        $result = $conn->query($query);
        return $result;
    }

    public function deleteData($id)
    {
        $db=new DB;
        $conn=$db->connect();
        $query ="DELETE FROM `jenis_penerimaan` WHERE `jenis_penerimaan`.`jenis_penerimaan_id` = $id";
        $result = $conn->query($query);
        return $result;
        
    }

    public function searchData($search)
    {   
        $db=new DB;
        $conn=$db->connect();

        $query = 
        "SELECT * FROM jenis_penerimaan WHERE jenis_penerimaan.nama_jenis_penerimaan LIKE '%$search%'";

        $result = $conn->query($query);
        $data = array("data"=>$result);
        
        return $data;
    }
}
?>