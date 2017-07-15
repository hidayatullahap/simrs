<?php
require_once CLASSES_DIR  . 'dbconnection.php';
require_once CLASSES_DIR  . 'satuan.php';
require_once CLASSES_DIR  . 'grupbarang.php';

class Barang{
    private $barang_id;
    private $nama_barang;
    private $merek_model_ukuran;
    private $harga_jual;
    private $tanggal_pencatatan;

    function setBarang_id($barang_id) { $this->barang_id = $barang_id; }
    function getBarang_id() { return $this->barang_id; }
    function setNama_barang($nama_barang) { $this->nama_barang = $nama_barang; }
    function getNama_barang() { return $this->nama_barang; }
    function setMerek_model_ukuran($merek_model_ukuran) { $this->merek_model_ukuran = $merek_model_ukuran; }
    function getMerek_model_ukuran() { return $this->merek_model_ukuran; }
    function setHarga_jual($harga_jual) { $this->harga_jual = $harga_jual; }
    function getHarga_jual() { return $this->harga_jual; }
    function setTanggal_pencatatan($tanggal_pencatatan) { $this->tanggal_pencatatan = $tanggal_pencatatan; }
    function getTanggal_pencatatan() { return $this->tanggal_pencatatan; }

    public function getData($sort, $page, $limitItemPage)
    {   
        $db = new DB();
        $conn = $db->connect();
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
        ASC LIMIT $page,$limitItemPage";
        $result = $conn->query($query);
        
        $sql = $conn->query("SELECT COUNT(*) FROM barang");
        $row = $sql->fetch_row();
        $count = $row[0];
        $totalData = $count;
        $totalPages = ceil($totalData/$limitItemPage);
        $data = array("data"=>$result, "currentPage"=>$page/$limitItemPage+1, "totalPages"=>$totalPages, "totalData"=>$totalData);
        $conn->close();
        
        return $data;
    }

    public function getStok($sort, $page, $limitItemPage)
    {   
        $db = new DB();
        $conn = $db->connect();
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
        unit.nama_unit != 'Gudang Farmasi' AND
        barang.nama_barang LIKE '%$barang_search%'
        AND unit.nama_unit LIKE '%$unit_search%' 
        ORDER BY `barang`.`nama_barang` 
        $sort LIMIT $page,$limitItemPage";
        $result = $conn->query($query);
        
        $sql = $conn->query("SELECT COUNT(*) FROM 
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
        $conn->close();

        return $data;
    }

    public function getAll($unit_id)
    {   
        $db = new DB();
        $conn = $db->connect();
        if($unit_id == 3){
            $sqlGrupBarang = " WHERE barang.grup_barang_id = 1 OR barang.grup_barang_id = 4";
        }else if($unit_id == 2){
            $sqlGrupBarang = " WHERE barang.grup_barang_id = 3 OR barang.grup_barang_id = 4 OR barang.grup_barang_id = 1";
        }else if($unit_id == 4){
            $sqlGrupBarang = " WHERE barang.grup_barang_id = 1  OR barang.grup_barang_id = 2";
        }else{
            $sqlGrupBarang = "";
        }
        
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
        LEFT JOIN stok ON stok.barang_id = barang.barang_id AND stok.unit_id = $unit_id
        $sqlGrupBarang";
        $result = $conn->query($query);

        $data = array("data"=>$result);
        $conn->close();

        return $data;
    }

    public function getOne($id)
    {   
        $db = new DB();
        $conn = $db->connect();
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
        $result = $conn->query($query);
        $data = array("data"=>$result);
        $conn->close();
        
        return $data;
    }

    public function postData()
    {   
        $db = new DB();
        $conn = $db->connect();
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
        $result = $conn->query($query);
        $conn->close();
        return $result;
    }

    public function editData($id)
    {   
        $db = new DB();
        $conn = $db->connect();
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
        $result = $conn->query($query);
        $conn->close();
        return $result;
    }

    public function deleteData($id)
    {   
        $db = new DB();
        $conn = $db->connect();
        $query ="DELETE FROM `barang` WHERE `barang`.`barang_id` = $id";
        $result = $conn->query($query);
        $conn->close();
        return $result;
        
    }

    public function searchData($search)
    {   
        $db = new DB();
        $conn = $db->connect();
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
        barang.nama_barang LIKE '%$search%'
        ORDER BY `barang`.`barang_id` ASC";

        $result = $conn->query($query);
        $data = array("data"=>$result);
        $conn->close();

        return $data;
    }
}
?>