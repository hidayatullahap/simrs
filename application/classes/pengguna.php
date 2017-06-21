<?php
require_once CLASSES_DIR  . 'dbconnection.php';

class Pengguna{
    private $db;
    private $conn;
    private $pengguna_id;
    private $nama;
    private $nip;
    private $username;
    private $role;

    public function __construct() {
        $this->db = new DB();
        $this->conn = $this->db->connect();
    }

    function setPengguna_id($pengguna_id) { $this->pengguna_id = $pengguna_id; }
    function getPengguna_id() { return $this->pengguna_id; }
    function setNama($nama) { $this->nama = $nama; }
    function getNama() { return $this->nama; }
    function setNip($nip) { $this->nip = $nip; }
    function getNip() { return $this->nip; }
    function setUsername($username) { $this->username = $username; }
    function getUsername() { return $this->username; }
    function setRole($role) { $this->role = $role; }
    function getRole() { return $this->role; }

    public function getData($sort, $page, $limitItemPage)
    {   
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
        $result = $this->conn->query($query);

        $rows = [];
        $i=0;
        $object;
        $nestedData = array();
        $arrayData = new ArrayObject();
        while($row = mysqli_fetch_array($result))
        {   
            $object{$i} = new Pengguna();
            $object{$i}->setPengguna_id($row['pengguna_id']);
            $object{$i}->setNama($row['nama']);
            $object{$i}->setNip($row['nip']);
            $object{$i}->setUsername($row['username']);
            $object{$i}->setRole($row['role']);

            $nestedData['pengguna_id'] = $object{$i}->getPengguna_id();
            $nestedData['nama'] = $object{$i}->getNama();
            $nestedData['nip'] = $object{$i}->getNip();
            $nestedData['username'] = $object{$i}->getUsername();
            $nestedData['role'] = $object{$i}->getRole();
            $arrayData[] = $nestedData;

            $i++;
        } 
        $arrayData->num_rows = $i;
        
        $sql = $this->conn->query("SELECT COUNT(*) FROM pengguna");
        $row = $sql->fetch_row();
        $count = $row[0];
        $totalData = $count;
        $totalPages = ceil($totalData/$limitItemPage);

        $data = array("data"=>$arrayData, "currentPage"=>$page/$limitItemPage+1, "totalPages"=>$totalPages, "totalData"=>$totalData);

        return $data;
    }

    public function getOne($id)
    {   
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
        $result = $this->conn->query($query);
        $data = array("data"=>$result);
        
        return $data;
    }

    public function checkCredential($username, $password)
    {   
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
        $result = $this->conn->query($query);
        $data = array("data"=>$result);
        
        return $data;
    }

    function is_loggedin(){
        $checksession = isset($_SESSION['pengguna_username']);
        return $checksession;
    }

    function checkRole($role){
        $checkRole = isset($_SESSION['pengguna_peran']);
        return $checkRole;
    }

    function logout(){
        session_destroy();
    }

    public function postData()
    {   
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
        $result = $this->conn->query($query);
        return $result;
    }

    public function editData($id)
    {   
        if(isset($_POST['password'])){
            $pass = md5($_POST['password']);
            $sqlPassword=", `password` = '$pass' ";
        }else{
            $sqlPassword=" ";
        }
        $nama           = $_POST['nama'];
        $nip            = $_POST['nip'];
        $username       = $_POST['username'];
        $role           = $_POST['role'];

        $query =
        "UPDATE `pengguna` SET `nama` = '$nama', `nip` = '$nip', `username` = '$username', `role` = '$role' $sqlPassword WHERE `pengguna`.`pengguna_id` = $id
        ";
        $result = $this->conn->query($query);
        return $result;
    }

    public function deleteData($id)
    {
        $query ="DELETE FROM `pengguna` WHERE `pengguna`.`pengguna_id` = $id";
        $result = $this->conn->query($query);
        return $result;
        
    }

    public function searchData($search)
    {   
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

        $result = $this->conn->query($query);
        $data = array("data"=>$result);
        
        return $data;
    }
}
?>