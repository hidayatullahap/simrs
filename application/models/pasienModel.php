<?php
require_once CLASSES_DIR  . 'dbconnection.php';
class PasienModel extends CI_Model{
    private $db;
    private $conn;
    public function __construct() {
        parent::__construct();
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

            $i++;
        } 
        $arrayData->num_rows = $i;
        
        $sql = $this->conn->query("SELECT COUNT(*) FROM pasien");
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
        $pasien = new Pasien(
        $pasien_id=null,
        $_POST['nama'],
        $_POST['tempat_lahir'],
        $_POST['tanggal_lahir'],
        $_POST['alamat'],
        $_POST['jenis_kelamin'],
        $_POST['golongan_darah'],
        $_POST['alamat'],
        $_POST['nomor_rm']);
        $jenis_pasien = $pasien->jenisPasien(null, $_POST['optionJenisPasien']);

        $nama           = $pasien->getNama();
        $tanggal_lahir  = $pasien->getTanggal_lahir();
        $tempat_lahir   = $pasien->getTempat_lahir();
        $alamat         = $pasien->getAlamat();
        $jenis_kelamin  = $pasien->getJenis_kelamin();
        $golongan_darah = $pasien->getGolongan_darah();
        $agama          = $pasien->getAgama();
        $nomor_RM       = $pasien->getNomor_RM();
        $jenis_pasien_id= $jenis_pasien->getNama_jenis_pasien();

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
        $pasien = new Pasien(
        $pasien_id=null,
        $_POST['nama'],
        $_POST['tempat_lahir'],
        $_POST['tanggal_lahir'],
        $_POST['alamat'],
        $_POST['jenis_kelamin'],
        $_POST['golongan_darah'],
        $_POST['alamat'],
        $_POST['nomor_rm']);
        $jenis_pasien = $pasien->jenisPasien(null, $_POST['optionJenisPasien']);

        $nama           = $pasien->getNama();
        $tanggal_lahir  = $pasien->getTanggal_lahir();
        $tempat_lahir   = $pasien->getTempat_lahir();
        $alamat         = $pasien->getAlamat();
        $jenis_kelamin  = $pasien->getJenis_kelamin();
        $golongan_darah = $pasien->getGolongan_darah();
        $agama          = $pasien->getAgama();
        $nomor_RM       = $pasien->getNomor_RM();
        $jenis_pasien_id= $jenis_pasien->getNama_jenis_pasien();

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