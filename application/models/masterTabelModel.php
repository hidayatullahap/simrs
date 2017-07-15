<?php
require_once CLASSES_DIR  . 'dbconnection.php';


class MasterTabelModel extends CI_MODEL{
    private $db;
    private $conn;
    private $namatabel;

    public function __construct() {
        $this->db = new DB();
        $this->conn = $this->db->connect();
    }

    public function getData($namatabel, $sort=null, $page=null, $limitItemPage=null)
    {   
        if(!isset($page)){$page=1;}
        if(!isset($limitItemPage)){$limitItemPage=50;}
        if(!isset($sort)){$sort="ASC";}

        $page=($page*$limitItemPage)-$limitItemPage;
        $query =
        "SELECT * FROM $namatabel ORDER BY `$namatabel`.`nama_{$namatabel}` $sort LIMIT $page,$limitItemPage";
        $result = $this->conn->query($query);
        
        $sql = $this->conn->query("SELECT COUNT(*) FROM $namatabel");
        $row = $sql->fetch_row();
        $count = $row[0];
        $totalData = $count;
        $totalPages = ceil($totalData/$limitItemPage);
        $data = array("data"=>$result, "currentPage"=>$page/$limitItemPage+1, "totalPages"=>$totalPages, "totalData"=>$totalData);

        return $data;
    }

    public function getOne($namatabel, $id)
    {   
        $query =
        "SELECT * FROM $namatabel WHERE $namatabel.{$namatabel}_id = $id";
        $result = $this->conn->query($query);
        $data = array("data"=>$result);
        return $data;
    }

    public function postData($namatabel)
    {   
        $value = $_POST['nama_'.$namatabel.''];
        $query =
        "INSERT INTO $namatabel(nama_{$namatabel}) VALUES ('$value')";
        $result = $this->conn->query($query);
        return $result;
    }

    public function editData($namatabel, $id)
    {   
        $value = $_POST['nama_'.$namatabel.''];
        $query =
        "UPDATE `$namatabel` SET `nama_{$namatabel}` = '$value' WHERE `$namatabel`.`{$namatabel}_id` = $id";
        $result = $this->conn->query($query);
        return $result;
    }

    public function deleteData($namatabel, $id)
    {
        $query ="DELETE FROM `$namatabel` WHERE `$namatabel`.`{$namatabel}_id` = $id";
        $result = $this->conn->query($query);
        return $result;
    }

    public function searchData($namatabel, $search)
    {   
        $query = "SELECT * FROM `$namatabel` WHERE `{$namatabel}`.`nama_{$namatabel}` LIKE '%$search%'";
        $result = $this->conn->query($query);
        $data = array("data"=>$result);
        return $data;
    }
}
?>