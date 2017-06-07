<?php
require_once CLASSES_DIR  . 'dbconnection.php';

class JenisPasien{

    public function getData($sort, $page, $limitItemPage)
    {   
        $db=new DB;
        $conn=$db->connect();
        $page=($page*$limitItemPage)-$limitItemPage;
        $query =
        "SELECT * FROM jenis_pasien ORDER BY `jenis_pasien`.`jenis_pasien_id` $sort LIMIT $page,$limitItemPage";
        $result = $conn->query($query);
        
        $sql = $conn->query("SELECT COUNT(*) FROM jenis_pasien");
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
        "SELECT * FROM jenis_pasien WHERE jenis_pasien.jenis_pasien_id = $id";
        $result = $conn->query($query);
        $data = array("data"=>$result);
        
        return $data;
    }

    public function postData()
    {   
        $db=new DB;
        $conn=$db->connect();
        $nama_jenis_pasien = $_POST['nama_jenis_pasien'];

        $query =
        "INSERT INTO jenis_pasien(nama_jenis_pasien) VALUES ('$nama_jenis_pasien')";
        $result = $conn->query($query);
        return $result;
    }

    public function editData($id)
    {   
        $db=new DB;
        $conn=$db->connect();
        $nama_jenis_pasien = $_POST['nama_jenis_pasien'];

        $query =
        "UPDATE `jenis_pasien` SET `nama_jenis_pasien` = '$nama_jenis_pasien' WHERE `jenis_pasien`.`jenis_pasien_id` = $id";
        $result = $conn->query($query);
        return $result;
    }

    public function deleteData($id)
    {
        $db=new DB;
        $conn=$db->connect();
        $query ="DELETE FROM `jenis_pasien` WHERE `jenis_pasien`.`jenis_pasien_id` = $id";
        $result = $conn->query($query);
        return $result;
        
    }

    public function searchData($search)
    {   
        $db=new DB;
        $conn=$db->connect();

        $query = 
        "SELECT * FROM jenis_pasien WHERE jenis_pasien.nama_jenis_pasien LIKE '%$search%'";

        $result = $conn->query($query);
        $data = array("data"=>$result);
        
        return $data;
    }
}
?>