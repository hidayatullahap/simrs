<?php
require_once CLASSES_DIR  . 'dbconnection.php';

class Barang{
    private $db;
    private $conn;

    public function __construct() {
        $this->db = new DB();
        $this->conn = $this->db->connect();
    }
    
    public function getData($sort, $page, $limitItemPage)
    {   
        $page=($page*$limitItemPage)-$limitItemPage;
        $query =
        "SELECT
        barang.barang_id AS barang_id,
        barang.nama_barang AS nama_barang,
        barang.grup_barang_id AS grup_barang_id,
        grup_barang.nama_grup_barang AS grup_barang,
        barang.satuan_id AS satuan_id,
        barang.harga_jual AS harga_jual,
        satuan.nama_satuan AS satuan,
        barang.tanggal_pencatatan AS tanggal_pencatatan,
        barang.merek_model_ukuran
        FROM
        barang
        INNER JOIN grup_barang ON barang.grup_barang_id = grup_barang.grup_barang_id
        INNER JOIN satuan ON barang.satuan_id = satuan.satuan_id
        ORDER BY `barang`.`barang_id` 
        $sort LIMIT $page,$limitItemPage";
        $result = $this->conn->query($query);
        
        $sql = $this->conn->query("SELECT COUNT(*) FROM barang");
        $row = $sql->fetch_row();
        $count = $row[0];
        $totalData = $count;
        $totalPages = ceil($totalData/$limitItemPage);
        $data = array("data"=>$result, "currentPage"=>$page/$limitItemPage+1, "totalPages"=>$totalPages, "totalData"=>$totalData);

        return $data;
    }

    public function getStok($sort, $page, $limitItemPage)
    {   
        $page=($page*$limitItemPage)-$limitItemPage;

        if(isset($_POST['search_nama_unit'])){
            $unit_search = $_POST['search_nama_unit']; $_SESSION['search_nama_unit'] = $unit_search;
            } else if(isset($_SESSION['search_nama_unit'])){
                $unit_search = $_SESSION['search_nama_unit'];
            }else{
                $unit_search="";
        }

        if(isset($_POST['search_nama_barang'])){
            $barang_search = $_POST['search_nama_barang']; $_SESSION['search_nama_barang'] = $barang_search;
            } else if(isset($_SESSION['search_nama_barang'])){
                $barang_search = $_SESSION['search_nama_barang'];
            }else{
                $barang_search="";
        }

        $query =
        "SELECT
        satuan.nama_satuan,
        grup_barang.nama_grup_barang,
        stok.stok_id,
        stok.jumlah,
        stok.tanggal_pencatatan,
        unit.nama_unit,
        barang.nama_barang,
        barang.merek_model_ukuran
        FROM
        stok
        INNER JOIN barang ON stok.barang_id = barang.barang_id
        INNER JOIN grup_barang ON barang.grup_barang_id = grup_barang.grup_barang_id
        INNER JOIN satuan ON barang.satuan_id = satuan.satuan_id
        INNER JOIN unit ON stok.unit_id = unit.unit_id
        WHERE
        barang.nama_barang LIKE '%$barang_search%'
        AND unit.nama_unit LIKE '%$unit_search%' 
        ORDER BY `barang`.`nama_barang` 
        $sort LIMIT $page,$limitItemPage";
        $result = $this->conn->query($query);
        
        $sql = $this->conn->query("SELECT COUNT(*) FROM 
        (SELECT
        satuan.nama_satuan,
        grup_barang.nama_grup_barang,
        stok.stok_id,
        stok.jumlah,
        stok.tanggal_pencatatan,
        unit.nama_unit,
        barang.nama_barang
        FROM
        stok
        INNER JOIN barang ON stok.barang_id = barang.barang_id
        INNER JOIN grup_barang ON barang.grup_barang_id = grup_barang.grup_barang_id
        INNER JOIN satuan ON barang.satuan_id = satuan.satuan_id
        INNER JOIN unit ON stok.unit_id = unit.unit_id
        WHERE
        barang.nama_barang LIKE '%$barang_search%'
        AND unit.nama_unit LIKE '%$unit_search%' ) AS totaldata");
        $row = $sql->fetch_row();
        $count = $row[0];
        $totalData = $count;
        $totalPages = ceil($totalData/$limitItemPage);
        $data = array("data"=>$result, "currentPage"=>$page/$limitItemPage+1, "totalPages"=>$totalPages, "totalData"=>$totalData);

        return $data;
    }

    public function getAll($unit_id)
    {   
        $query =
        "SELECT
        barang.barang_id AS barang_id,
        barang.nama_barang AS nama_barang,
        IFNULL(stok.jumlah, 0) AS jumlah_stok,
        grup_barang.nama_grup_barang AS grup_barang,
        satuan.nama_satuan AS satuan,
        barang.harga_jual
        FROM
        barang
        INNER JOIN grup_barang ON barang.grup_barang_id = grup_barang.grup_barang_id
        INNER JOIN satuan ON barang.satuan_id = satuan.satuan_id
        LEFT JOIN stok ON stok.barang_id = barang.barang_id AND stok.unit_id = $unit_id";
        $result = $this->conn->query($query);

        $data = array("data"=>$result);

        return $data;
    }

    public function getOne($id)
    {   
        $query =
        "SELECT
        barang.barang_id AS barang_id,
        barang.nama_barang AS nama_barang,
        barang.grup_barang_id AS grup_barang_id,
        grup_barang.nama_grup_barang AS grup_barang,
        barang.satuan_id AS satuan_id,
        satuan.nama_satuan AS satuan,
        barang.harga_jual AS harga_jual,
        barang.tanggal_pencatatan AS tanggal_pencatatan,
        barang.merek_model_ukuran
        FROM
        barang
        INNER JOIN grup_barang ON barang.grup_barang_id = grup_barang.grup_barang_id
        INNER JOIN satuan ON barang.satuan_id = satuan.satuan_id
        WHERE
        barang.barang_id = $id";
        $result = $this->conn->query($query);
        $data = array("data"=>$result);
        
        return $data;
    }

    public function postData()
    {   
        $nama_barang    = $_POST['nama_barang'];
        $grup_barang_id = $_POST['grup_barang_id'];
        $satuan_id      = $_POST['satuan_id'];
        $harga_jual     = $_POST['harga_jual'];
        $merek_model_ukuran     = $_POST['merek_model_ukuran'];

        $query =
        "INSERT
        INTO barang(nama_barang, grup_barang_id, satuan_id , merek_model_ukuran, harga_jual)
        VALUES ('$nama_barang', '$grup_barang_id', '$satuan_id', '$merek_model_ukuran','$harga_jual')
        ";
        $result = $this->conn->query($query);
        return $result;
    }

    public function editData($id)
    {   
        $nama_barang    = $_POST['nama_barang'];
        $grup_barang_id = $_POST['grup_barang_id'];
        $satuan_id      = $_POST['satuan_id'];
        $harga_jual     = $_POST['harga_jual'];
        $merek_model_ukuran     = $_POST['merek_model_ukuran'];

        $query =
        "UPDATE `barang` SET `nama_barang` = '$nama_barang', `grup_barang_id` = '$grup_barang_id', `harga_jual` = '$harga_jual', `satuan_id` = '$satuan_id',
        `merek_model_ukuran` = '$merek_model_ukuran'
         WHERE `barang`.`barang_id` = $id
        ";
        $result = $this->conn->query($query);
        return $result;
    }

    public function deleteData($id)
    {
        $query ="DELETE FROM `barang` WHERE `barang`.`barang_id` = $id";
        $result = $this->conn->query($query);
        return $result;
        
    }

    public function searchData($search)
    {   
        $query = 
        "SELECT
        barang.barang_id AS barang_id,
        barang.nama_barang AS nama_barang,
        barang.grup_barang_id AS grup_barang_id,
        grup_barang.nama_grup_barang AS grup_barang,
        barang.satuan_id AS satuan_id,
        satuan.nama_satuan AS satuan,
        barang.harga_jual AS harga_jual,
        barang.tanggal_pencatatan AS tanggal_pencatatan
        FROM
        barang
        INNER JOIN grup_barang ON barang.grup_barang_id = grup_barang.grup_barang_id
        INNER JOIN satuan ON barang.satuan_id = satuan.satuan_id
        WHERE
        barang.nama_barang LIKE '%$search%'
        ORDER BY `barang`.`barang_id` ASC";

        $result = $this->conn->query($query);
        $data = array("data"=>$result);
        
        return $data;
    }
}
?>