<?php
require_once CLASSES_DIR  . 'dbconnection.php';
require_once CLASSES_DIR  . 'jenispasien.php';

class Pasien{
    private $db;
    private $conn;
    private $pasien_id;#
    private $nama;#
    private $tempat_lahir;#
    private $tanggal_lahir;#
    private $alamat;#
    private $jenis_kelamin;#
    private $golongan_darah;#
    private $agama;#
    private $nomor_RM;#
    private $jenis_pasien_id;
    private $jenis_pasien;
    private $tanggal_daftar;#

    public function __construct() {
        $this->db = new DB();
        $this->conn = $this->db->connect();
    }
    
    function setPasien_id($pasien_id) { $this->pasien_id = $pasien_id; }
    function getPasien_id() { return $this->pasien_id; }
    function setNama($nama) { $this->nama = $nama; }
    function getNama() { return $this->nama; }
    function setTempat_lahir($tempat_lahir) { $this->tempat_lahir = $tempat_lahir; }
    function getTempat_lahir() { return $this->tempat_lahir; }
    function setTanggal_lahir($tanggal_lahir) { $this->tanggal_lahir = $tanggal_lahir; }
    function getTanggal_lahir() { return $this->tanggal_lahir; }
    function setAlamat($alamat) { $this->alamat = $alamat; }
    function getAlamat() { return $this->alamat; }
    function setJenis_kelamin($jenis_kelamin) { $this->jenis_kelamin = $jenis_kelamin; }
    function getJenis_kelamin() { return $this->jenis_kelamin; }
    function setGolongan_darah($golongan_darah) { $this->golongan_darah = $golongan_darah; }
    function getGolongan_darah() { return $this->golongan_darah; }
    function setAgama($agama) { $this->agama = $agama; }
    function getAgama() { return $this->agama; }
    function setNomor_RM($nomor_RM) { $this->nomor_RM = $nomor_RM; }
    function getNomor_RM() { return $this->nomor_RM; }
    function setTanggal_daftar($tanggal_daftar) { $this->tanggal_daftar = $tanggal_daftar; }
    function getTanggal_daftar() { return $this->tanggal_daftar; }

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

        $rows = [];
        $i=0;
        $object;
        $jenisPasien;
        $nestedData = array();
        $arrayData = new ArrayObject();
        while($row = mysqli_fetch_array($result))
        {   
            $object{$i} = new Pasien();
            $jenisPasien{$i} = new JenisPasien();
            $object{$i}->setPasien_id($row['pasien_id']);
            $object{$i}->setNama($row['nama']);
            $object{$i}->setTempat_lahir($row['tempat_lahir']);
            $object{$i}->setTanggal_lahir($row['tanggal_lahir']);
            $object{$i}->setAlamat($row['alamat']);
            $object{$i}->setJenis_kelamin($row['jenis_kelamin']);
            $object{$i}->setGolongan_darah($row['golongan_darah']);
            $object{$i}->setAgama($row['agama']);
            $object{$i}->setNomor_RM($row['nomor_RM']);
            $jenisPasien{$i}->setJenis_pasien_id($row['jenis_pasien_id']);
            $jenisPasien{$i}->setNama_jenis_pasien($row['jenis_pasien']);
            $object{$i}->setTanggal_daftar($row['tanggal_daftar']);

            $nestedData['pasien_id'] = $object{$i}->getPasien_id();
            $nestedData['nama'] = $object{$i}->getNama();
            $nestedData['tempat_lahir'] = $object{$i}->getTempat_lahir();
            $nestedData['tanggal_lahir'] = $object{$i}->getTanggal_lahir();
            $nestedData['alamat'] = $object{$i}->getAlamat();
            $nestedData['jenis_kelamin'] = $object{$i}->getJenis_kelamin();
            $nestedData['golongan_darah'] = $object{$i}->getGolongan_darah();
            $nestedData['agama'] = $object{$i}->getAgama();
            $nestedData['nomor_RM'] = $object{$i}->getNomor_RM();
            $nestedData['jenis_pasien_id'] = $jenisPasien{$i}->getJenis_pasien_id();
            $nestedData['jenis_pasien'] = $jenisPasien{$i}->getNama_jenis_pasien();
            $nestedData['tanggal_daftar'] = $object{$i}->getTanggal_daftar();
            $arrayData[] = $nestedData;
            $object{$i}->conn->close();

            $i++;
        } 
        $arrayData->num_rows = $i;
        
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