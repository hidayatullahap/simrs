<?php
require_once CLASSES_DIR  . 'dbconnection.php';

class Unit{

    public function getData($sort, $page, $limitItemPage)
    {   
        $db=new DB;
        $conn=$db->connect();
        $page=($page*$limitItemPage)-$limitItemPage;
        $query =
        "SELECT * FROM unit ORDER BY `unit`.`unit_id` $sort LIMIT $page,$limitItemPage";
        $result = $conn->query($query);
        
        $sql = $conn->query("SELECT COUNT(*) FROM unit");
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
        "SELECT * FROM unit WHERE unit.unit_id = $id";
        $result = $conn->query($query);
        $data = array("data"=>$result);
        
        return $data;
    }

    public function postData()
    {   
        $db=new DB;
        $conn=$db->connect();
        $nama_unit = $_POST['nama_unit'];

        $query =
        "INSERT INTO unit(nama_unit) VALUES ('$nama_unit')";
        $result = $conn->query($query);
        return $result;
    }

    public function editData($id)
    {   
        $db=new DB;
        $conn=$db->connect();
        $nama_unit = $_POST['nama_unit'];

        $query =
        "UPDATE `unit` SET `nama_unit` = '$nama_unit' WHERE `unit`.`unit_id` = $id";
        $result = $conn->query($query);
        return $result;
    }

    public function deleteData($id)
    {
        $db=new DB;
        $conn=$db->connect();
        $query ="DELETE FROM `unit` WHERE `unit`.`unit_id` = $id";
        $result = $conn->query($query);
        return $result;
        
    }

    public function searchData($search)
    {   
        $db=new DB;
        $conn=$db->connect();

        $query = 
        "SELECT * FROM unit WHERE unit.nama_unit LIKE '%$search%'";

        $result = $conn->query($query);
        $data = array("data"=>$result);
        
        return $data;
    }
}
?>