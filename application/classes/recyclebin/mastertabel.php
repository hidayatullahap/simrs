<?php
require_once CLASSES_DIR  . 'dbconnection.php';


class MasterTabel{

    public function getData($namatabel, $sort=null, $page=null, $limitItemPage=null)
    {   
        $db=new DB;
        $conn=$db->connect();

        if(!isset($page)){$page=1;}
        if(!isset($limitItemPage)){$limitItemPage=50;}
        if(!isset($sort)){$sort="ASC";}

        $page=($page*$limitItemPage)-$limitItemPage;
        $query =
        "SELECT * FROM $namatabel ORDER BY `$namatabel`.`{$namatabel}_id` $sort LIMIT $page,$limitItemPage";
        $result = $conn->query($query);
        
        $sql = $conn->query("SELECT COUNT(*) FROM $namatabel");
        $row = $sql->fetch_row();
        $count = $row[0];
        $totalData = $count;
        $totalPages = ceil($totalData/$limitItemPage);
        $data = array("data"=>$result, "currentPage"=>$page/$limitItemPage+1, "totalPages"=>$totalPages, "totalData"=>$totalData);

        return $data;
    }

    public function getOne($namatabel, $id)
    {   
        $db=new DB;
        $conn=$db->connect();
        $query =
        "SELECT * FROM $namatabel WHERE $namatabel.{$namatabel}_id = $id";
        $result = $conn->query($query);
        $data = array("data"=>$result);
        
        return $data;
    }

    public function postData($namatabel)
    {   
        $db=new DB;
        $conn=$db->connect();
        $value = $_POST['nama_'.$namatabel.''];

        $query =
        "INSERT INTO $namatabel(nama_{$namatabel}) VALUES ('$value')";
        $result = $conn->query($query);
        return $result;
    }

    public function editData($namatabel, $id)
    {   
        $db=new DB;
        $conn=$db->connect();
        $value = $_POST['nama_'.$namatabel.''];

        $query =
        "UPDATE `$namatabel` SET `nama_{$namatabel}` = '$value' WHERE `$namatabel`.`{$namatabel}_id` = $id";
        $result = $conn->query($query);
        return $result;
    }

    public function deleteData($namatabel, $id)
    {
        $db=new DB;
        $conn=$db->connect();
        $query ="DELETE FROM `$namatabel` WHERE `$namatabel`.`{$namatabel}_id` = $id";
        $result = $conn->query($query);
        return $result;
        
    }

    public function searchData($namatabel, $search)
    {   
        $db=new DB;
        $conn=$db->connect();

        $query = 
        "SELECT * FROM `$namatabel` WHERE `{$namatabel}`.`nama_{$namatabel}` LIKE '%$search%'";

        $result = $conn->query($query);
        $data = array("data"=>$result);
        
        return $data;
    }
}
?>