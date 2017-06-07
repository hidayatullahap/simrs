<?php
require_once CLASSES_DIR  . 'dbconnection.php';

class Pengguna{

    public function getData($sort, $page, $limitItemPage)
    {   
        $db=new DB;
        $conn=$db->connect();
        $page=($page*$limitItemPage)-$limitItemPage;
        $query =
        "SELECT
        pengguna.pengguna_id,
        pengguna.nama,
        pengguna.nip,
        pengguna.username,
        pengguna.role
        FROM
        pengguna
        ORDER BY `pengguna`.`pengguna_id` 
        $sort LIMIT $page,$limitItemPage";
        $result = $conn->query($query);
        
        $sql = $conn->query("SELECT COUNT(*) FROM barang");
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
        "SELECT
        pengguna.pengguna_id,
        pengguna.nama,
        pengguna.nip,
        pengguna.username,
        pengguna.role
        FROM
        pengguna
        WHERE
        pengguna.pengguna_id = $id";
        $result = $conn->query($query);
        $data = array("data"=>$result);
        
        return $data;
    }

    public function checkCredential($username, $password)
    {   
        $db=new DB;
        $conn=$db->connect();
        $query =
        "SELECT
        pengguna.nama,
        pengguna.username,
        pengguna.role
        FROM
        pengguna
        WHERE
        pengguna.username = '$username' AND
        pengguna.password ='$password'
        ";
        $result = $conn->query($query);
        $data = array("data"=>$result);
        
        return $data;
    }

    function is_loggedin(){
        $checksession = isset($_SESSION['pengguna_username']);
        return $checksession;
    }

    function logout(){
        session_destroy();
    }

    public function postData()
    {   
        $db=new DB;
        $conn=$db->connect();

        $nama           = $_POST['nama'];
        $nip            = $_POST['nip'];
        $username       = $_POST['username'];
        $password       = md5($_POST['password']);
        $role           = $_POST['role'];

        $query =
        "INSERT
        INTO pengguna(nama, nip, username, password, role)
        VALUES ('$nama', '$nip', '$username', '$password', '$role')
        ";
        $result = $conn->query($query);
        return $result;
    }

    public function editData($id)
    {   
        $db=new DB;
        $conn=$db->connect();

        $nama           = $_POST['nama'];
        $nip            = $_POST['nip'];
        $username       = $_POST['username'];
        $role           = $_POST['role'];

        $query =
        "UPDATE `pengguna` SET `nama` = '$nama', `nip` = '$nip', `username` = '$username', `role` = '$role' WHERE `pengguna`.`pengguna_id` = $id
        ";
        $result = $conn->query($query);
        return $result;
    }

    public function deleteData($id)
    {
        $db=new DB;
        $conn=$db->connect();
        $query ="DELETE FROM `pengguna` WHERE `pengguna`.`pengguna_id` = $id";
        $result = $conn->query($query);
        return $result;
        
    }

    public function searchData($search)
    {   
        $db=new DB;
        $conn=$db->connect();

        $query = 
        "SELECT
        pengguna.pengguna_id,
        pengguna.nama,
        pengguna.nip,
        pengguna.username,
        pengguna.role
        FROM
        pengguna
        WHERE
        pengguna.nama LIKE '%$search%'
        ORDER BY `pengguna`.`pengguna_id` ASC";

        $result = $conn->query($query);
        $data = array("data"=>$result);
        
        return $data;
    }
}
?>