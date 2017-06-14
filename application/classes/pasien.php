<?php
require_once CLASSES_DIR  . 'dbconnection.php';

class Pasien{
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
        pasien.pasien_id AS pasien_id,
        pasien.nama AS nama,
        pasien.tempat_lahir AS tempat_lahir,
        pasien.tanggal_lahir AS tanggal_lahir,
        pasien.alamat AS alamat,
        pasien.jenis_kelamin AS jenis_kelamin,
        pasien.golongan_darah AS golongan_darah,
        pasien.agama AS agama,
        pasien.nomor_RM AS nomor_RM,
        pasien.jenis_pasien_id AS jenis_pasien_id,
        jenis_pasien.nama_jenis_pasien AS `jenis_pasien`,
        pasien.tanggal_daftar AS tanggal_daftar
        FROM
        pasien
        INNER JOIN jenis_pasien ON pasien.jenis_pasien_id = jenis_pasien.jenis_pasien_id
        ORDER BY `pasien`.`pasien_id` 
        $sort LIMIT $page,$limitItemPage";
        $result = $this->conn->query($query);
        
        $sql = $this->conn->query("SELECT COUNT(*) FROM pasien");
        $row = $sql->fetch_row();
        $count = $row[0];
        $totalData = $count;
        $totalPages = ceil($totalData/$limitItemPage);
        $data = array("data"=>$result, "currentPage"=>$page/$limitItemPage+1, "totalPages"=>$totalPages, "totalData"=>$totalData);

        return $data;
    }

    public function getOne($id)
    {   
        $query =
        "SELECT
        pasien.pasien_id AS pasien_id,
        pasien.nama AS nama,
        pasien.tempat_lahir AS tempat_lahir,
        pasien.tanggal_lahir AS tanggal_lahir,
        pasien.alamat AS alamat,
        pasien.jenis_kelamin AS jenis_kelamin,
        pasien.golongan_darah AS golongan_darah,
        pasien.agama AS agama,
        pasien.nomor_RM AS nomor_RM,
        pasien.jenis_pasien_id AS jenis_pasien_id,
        jenis_pasien.nama_jenis_pasien AS `jenis_pasien`,
        pasien.tanggal_daftar AS tanggal_daftar
        FROM
        pasien
        INNER JOIN jenis_pasien ON pasien.jenis_pasien_id = jenis_pasien.jenis_pasien_id
        WHERE
        pasien.pasien_id = $id";
        $result = $this->conn->query($query);
        $data = array("data"=>$result);
        
        return $data;
    }

    public function postData()
    {   
        $nama           = $_POST['nama'];
        $tanggal_lahir  = $_POST['tanggal_lahir'];
        $tempat_lahir   = $_POST['tempat_lahir'];
        $alamat         = $_POST['alamat'];
        $jenis_kelamin  = $_POST['jenis_kelamin'];
        $golongan_darah = $_POST['golongan_darah'];
        $agama          = $_POST['agama'];
        $nomor_RM       = $_POST['nomor_rm'];
        $jenis_pasien_id= $_POST['optionJenisPasien'];

        $query =
        "INSERT
        INTO pasien(nama,tempat_lahir, tanggal_lahir, alamat,jenis_kelamin,golongan_darah, agama,nomor_RM, jenis_pasien_id)
        VALUES ('$nama', '$tempat_lahir', '$tanggal_lahir', '$alamat', '$jenis_kelamin', '$golongan_darah', '$agama', '$nomor_RM', '$jenis_pasien_id')
        ";
        $result = $this->conn->query($query);
        return $result;
    }

    public function editData($id)
    {   
        $nama           = $_POST['nama'];
        $tanggal_lahir  = $_POST['tanggal_lahir'];
        $tempat_lahir   = $_POST['tempat_lahir'];
        $alamat         = $_POST['alamat'];
        $jenis_kelamin  = $_POST['jenis_kelamin'];
        $golongan_darah = $_POST['golongan_darah'];
        $agama          = $_POST['agama'];
        $nomor_RM       = $_POST['nomor_rm'];
        $jenis_pasien_id= $_POST['optionJenisPasien'];

        /*
        UPDATE Customers
        SET ContactName='Juan'
        WHERE Country='Mexico';

        $query =
        "UPDATE `pasien` SET `nomor_RM` = '131312223300'
        SET pasien(nama,tempat_lahir, tanggal_lahir, alamat,jenis_kelamin,golongan_darah, agama,nomor_RM, jenis_pasien_id)
        VALUES ('$nama', '$tempat_lahir', '$tanggal_lahir', '$alamat', '$jenis_kelamin', '$golongan_darah', '$agama', '$nomor_RM', '$jenis_pasien_id')
        WHERE `pasien`.`pasien_id` = $id;
        ";
        UPDATE `pasien` SET `nama` = 'Belaa', `tempat_lahir` = 'Lombokk', `tanggal_lahir` = '1995-04-23', `alamat` = 'Malangg', `jenis_kelamin` = 'PA', 
        `golongan_darah` = 'AA', `agama` = 'HinduA', `nomor_RM` = '13322244555A', `jenis_pasien_id` = '2' WHERE `pasien`.`pasien_id` = 4;*/

        $query =
        "UPDATE `pasien` SET `nama` = '$nama', `tempat_lahir` = '$tempat_lahir', `tanggal_lahir` = '$tanggal_lahir', `alamat` = '$alamat', `jenis_kelamin` = '$jenis_kelamin', 
        `golongan_darah` = '$golongan_darah', `agama` = '$agama', `nomor_RM` = '$nomor_RM', `jenis_pasien_id` = $jenis_pasien_id WHERE `pasien`.`pasien_id` = $id
        ";
        $result = $this->conn->query($query);
        return $result;
    }

    public function deleteData($id)
    {
        $query ="DELETE FROM `pasien` WHERE `pasien`.`pasien_id` = $id";
        $result = $this->conn->query($query);
        return $result;
        
    }

    public function searchData($search)
    {   
        $query = 
        "SELECT
        pasien.pasien_id AS pasien_id,
        pasien.nama AS nama,
        pasien.tempat_lahir AS tempat_lahir,
        pasien.tanggal_lahir AS tanggal_lahir,
        pasien.alamat AS alamat,
        pasien.jenis_kelamin AS jenis_kelamin,
        pasien.golongan_darah AS golongan_darah,
        pasien.agama AS agama,
        pasien.nomor_RM AS nomor_RM,
        pasien.jenis_pasien_id AS jenis_pasien_id,
        jenis_pasien.nama_jenis_pasien AS `jenis_pasien`,
        pasien.tanggal_daftar AS tanggal_daftar
        FROM
        pasien
        INNER JOIN jenis_pasien ON pasien.jenis_pasien_id = jenis_pasien.jenis_pasien_id
        WHERE
        pasien.nama LIKE '%$search%'
        ORDER BY `pasien`.`pasien_id` ASC";

        $result = $this->conn->query($query);
        $data = array("data"=>$result);
        
        return $data;
    }
}
?>