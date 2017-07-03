<?php
require_once CLASSES_DIR  . 'dbconnection.php';

class Antrian{
    private $db;
    private $conn;
    private $antrian_id;
    private $pasien_id;
    private $nama;
    private $tempat_lahir;
    private $tanggal_lahir;
    private $alamat;
    private $jenis_kelamin;
    private $golongan_darah;
    private $agama;
    private $nomor_RM;
    private $jenis_pasien_id;
    private $tanggal_daftar;
    private $jenis_pasien;
    private $is_dilayani;
    private $status;
    private $jenis_kunjungan;
    private $unit_id_tujuan;
    private $tanggal_antrian;
    private $nama_unit;

    public function __construct() {
        $this->db = new DB();
        $this->conn = $this->db->connect();
    }

    function setAntrian_id($antrian_id) { $this->antrian_id = $antrian_id; }
    function getAntrian_id() { return $this->antrian_id; }
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
    function setJenis_pasien_id($jenis_pasien_id) { $this->jenis_pasien_id = $jenis_pasien_id; }
    function getJenis_pasien_id() { return $this->jenis_pasien_id; }
    function setTanggal_daftar($tanggal_daftar) { $this->tanggal_daftar = $tanggal_daftar; }
    function getTanggal_daftar() { return $this->tanggal_daftar; }
    function setJenis_pasien($jenis_pasien) { $this->jenis_pasien = $jenis_pasien; }
    function getJenis_pasien() { return $this->jenis_pasien; }
    function setIs_dilayani($is_dilayani) { $this->is_dilayani = $is_dilayani; }
    function getIs_dilayani() { return $this->is_dilayani; }
    function setStatus($status) { $this->status = $status; }
    function getStatus() { return $this->status; }
    function setJenis_kunjungan($jenis_kunjungan) { $this->jenis_kunjungan = $jenis_kunjungan; }
    function getJenis_kunjungan() { return $this->jenis_kunjungan; }
    function setUnit_id_tujuan($unit_id_tujuan) { $this->unit_id_tujuan = $unit_id_tujuan; }
    function getUnit_id_tujuan() { return $this->unit_id_tujuan; }
    function setTanggal_antrian($tanggal_antrian) { $this->tanggal_antrian = $tanggal_antrian; }
    function getTanggal_antrian() { return $this->tanggal_antrian; }
    function setNama_unit($nama_unit) { $this->nama_unit = $nama_unit; }
    function getNama_unit() { return $this->nama_unit; }



    public function AntrianHariIni($sort, $page, $limitItemPage)
    {   
        $page=($page*$limitItemPage)-$limitItemPage;
        $query =
        "SELECT
        antrian.antrian_id,
        antrian.pasien_id,
        antrian.jenis_kunjungan,
        antrian.unit_id_tujuan,
        antrian.`status`,
        antrian.tanggal_antrian,
        pasien.nama,
        unit.nama_unit
        FROM
        antrian
        INNER JOIN pasien ON antrian.pasien_id = pasien.pasien_id
        INNER JOIN unit ON antrian.unit_id_tujuan = unit.unit_id
        WHERE
        antrian.tanggal_antrian BETWEEN DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 00:00:00') AND DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 23:59:59')
        ORDER BY `antrian`.`tanggal_antrian` 
        $sort LIMIT $page,$limitItemPage";
        $result = $this->conn->query($query);

        $rows = [];
        $i=0;
        $object;
        $nestedData = array();
        $arrayData = new ArrayObject();
        while($row = mysqli_fetch_array($result))
        {   
            $object{$i} = new Antrian();
            $object{$i}->setAntrian_id($row['antrian_id']);
            $object{$i}->setPasien_id($row['pasien_id']);
            $object{$i}->setJenis_kunjungan($row['jenis_kunjungan']);
            $object{$i}->setUnit_id_tujuan($row['unit_id_tujuan']);
            $object{$i}->setStatus($row['status']);
            $object{$i}->setTanggal_antrian($row['tanggal_antrian']);
            $object{$i}->setNama($row['nama']);
            $object{$i}->setNama_unit($row['nama_unit']);

            $nestedData['antrian_id'] = $object{$i}->getAntrian_id();
            $nestedData['pasien_id'] = $object{$i}->getPasien_id();
            $nestedData['jenis_kunjungan'] = $object{$i}->getJenis_kunjungan();
            $nestedData['unit_id_tujuan'] = $object{$i}->getUnit_id_tujuan();
            $nestedData['status'] = $object{$i}->getStatus();
            $nestedData['tanggal_antrian'] = $object{$i}->getTanggal_antrian();
            $nestedData['nama'] = $object{$i}->getNama();
            $nestedData['nama_unit'] = $object{$i}->getNama_unit();
            $arrayData[] = $nestedData;
            $object{$i}->conn->close();

            $i++;
        } 
        $arrayData->num_rows = $i;
        
        $sql = $this->conn->query("SELECT COUNT(*) FROM antrian WHERE
        antrian.tanggal_antrian BETWEEN DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 00:00:00') AND DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 23:59:59')");
        $row = $sql->fetch_row();
        $count = $row[0];
        $totalData = $count;
        $totalPages = ceil($totalData/$limitItemPage);
        $data = array("data"=>$arrayData, "currentPage"=>$page/$limitItemPage+1, "totalPages"=>$totalPages, "totalData"=>$totalData);

        return $data;
    }

    public function ajaxAntrianHariIni($unit_id=null)
    {   
        $requestData = $_REQUEST;
        $page = $requestData['start'];
        $limitItemPage = $requestData['length'];

        if(isset($unit_id)){
            $unitSQL="AND antrian.unit_id_tujuan = $unit_id ";
        }else{
            $unitSQL="";
        }

        $data = array();
        $query =
        "SELECT
        antrian.pasien_id,
        antrian.antrian_id,
        pasien.nama,
        antrian.jenis_kunjungan,
        unit.nama_unit,
        antrian.tanggal_antrian
        FROM
        antrian
        INNER JOIN pasien ON antrian.pasien_id = pasien.pasien_id
        INNER JOIN unit ON antrian.unit_id_tujuan = unit.unit_id
        WHERE
        antrian.tanggal_antrian BETWEEN DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 00:00:00') 
        AND DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 23:59:59') 
        AND antrian.`status` = 'belum_dilayani' 
        $unitSQL
        ORDER BY `antrian`.`tanggal_antrian` ASC
        LIMIT $page, $limitItemPage";
        
        $sql = $this->conn->query("SELECT COUNT(*) FROM antrian WHERE
        antrian.tanggal_antrian BETWEEN DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 00:00:00') 
        AND DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 23:59:59') 
        AND antrian.`status` = 'belum_dilayani'");

        if( !empty($requestData['search']['value']) ) {
            $query =
            "SELECT
            antrian.pasien_id,
            antrian.antrian_id,
            pasien.nama,
            antrian.jenis_kunjungan,
            unit.nama_unit,
            antrian.`status` AS status,
            antrian.tanggal_antrian
            FROM
            antrian
            INNER JOIN pasien ON antrian.pasien_id = pasien.pasien_id
            INNER JOIN unit ON antrian.unit_id_tujuan = unit.unit_id
            WHERE
            antrian.tanggal_antrian BETWEEN DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 00:00:00') 
            AND DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 23:59:59')
            AND antrian.`status` = 'belum_dilayani' 
            AND pasien.nama LIKE '%".$requestData['search']['value']."%'
            ORDER BY `antrian`.`tanggal_antrian` ASC
            LIMIT $page, $limitItemPage";

            $sql = $this->conn->query("SELECT COUNT(*) FROM antrian 
            INNER JOIN pasien ON antrian.pasien_id = pasien.pasien_id
            WHERE antrian.tanggal_antrian BETWEEN DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 00:00:00') 
            AND DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 23:59:59') 
            AND antrian.`status` = 'belum_dilayani' 
            AND pasien.nama LIKE '%".$requestData['search']['value']."%'
            LIMIT $page, $limitItemPage");
        }
        
        $result = $this->conn->query($query);

        while ($row = mysqli_fetch_assoc($result)) {
            $nestedData = array();
            $id = $row['pasien_id'];
            $id_antrian = $row['antrian_id'];
            $nama = $row['nama'];
            $unit = $row['nama_unit'];
            
            //$nestedData[] = $id;
            $nestedData[] = $row['tanggal_antrian'];
            $nestedData[] = $row['nama'];
            $nestedData[] = $row['jenis_kunjungan'];
            $nestedData[] = $row['nama_unit'];
            //if (isset($row['status'])){$nestedData[] = $row['status'];}
            if(isset($unit_id)){
                $nestedData[] = "<td><a href='".base_url("depo/antrianberjalandepo/layananobatkeluar/".$row['pasien_id'])."' ><button type='button' class='btn btn-primary btn-sm'>Layani</button></a></td>";
            }else{
                $nestedData[] = "<td><button type='button' class='btn btn-primary btn-md' id='buttonPindahUnit' onclick=\"editModal($id_antrian,'$nama','$unit');\">Pindah Unit</button></td>";
            }
            
            $data[] = $nestedData;
        }
        
        
        $row = $sql->fetch_row();
        $count = $row[0];
        $totalData = $count;
        $datajson = array("draw" => intval( $requestData['draw'] ), "recordsTotal"=>$totalData, "recordsFiltered"=>$totalData, "data"=>$data);
        //var_dump(json_encode($data));
        echo json_encode($datajson);
    }

    public function getPasienWithStatus($sort, $page, $limitItemPage)
    {   
        $page=($page*$limitItemPage)-$limitItemPage;
        $query =
        "SELECT
        pasien.pasien_id,
        pasien.nama,
        pasien.tempat_lahir,
        pasien.tanggal_lahir,
        pasien.alamat,
        pasien.jenis_kelamin,
        pasien.golongan_darah,
        pasien.agama,
        pasien.nomor_RM,
        pasien.jenis_pasien_id,
        pasien.tanggal_daftar,
        jenis_pasien.nama_jenis_pasien AS jenis_pasien,
        lj_antrian.layanan AS is_dilayani,
        lj_antrian.`status`
        FROM
        pasien
        INNER JOIN jenis_pasien ON pasien.jenis_pasien_id = jenis_pasien.jenis_pasien_id
        LEFT JOIN (
        SELECT 
        antrian.pasien_id,
        antrian.`status` AS status,
        COUNT(*) AS layanan 
        FROM antrian WHERE antrian.tanggal_antrian BETWEEN DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 00:00:00') AND DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 23:59:59')
        AND antrian.`status` = 'belum_dilayani'
        GROUP BY
        antrian.pasien_id
        ) AS lj_antrian ON (lj_antrian.pasien_id= pasien.pasien_id)
        ORDER BY `pasien`.`pasien_id` 
        $sort LIMIT $page,$limitItemPage";
        $result = $this->conn->query($query);

        $rows = [];
        $i=0;
        $object;
        $nestedData = array();
        $arrayData = new ArrayObject();
        while($row = mysqli_fetch_array($result))
        {   
            $object{$i} = new Antrian();
            $object{$i}->setPasien_id($row['pasien_id']);
            $object{$i}->setNama($row['nama']);
            $object{$i}->setTempat_lahir($row['tempat_lahir']);
            $object{$i}->setTanggal_lahir($row['tanggal_lahir']);
            $object{$i}->setAlamat($row['alamat']);
            $object{$i}->setJenis_kelamin($row['jenis_kelamin']);
            $object{$i}->setGolongan_darah($row['golongan_darah']);
            $object{$i}->setAgama($row['agama']);
            $object{$i}->setNomor_RM($row['nomor_RM']);
            $object{$i}->setJenis_pasien_id($row['jenis_pasien_id']);
            $object{$i}->setTanggal_daftar($row['tanggal_daftar']);
            $object{$i}->setJenis_pasien($row['jenis_pasien']);
            $object{$i}->setIs_dilayani($row['is_dilayani']);
            $object{$i}->setStatus($row['status']);

            $nestedData['pasien_id'] = $object{$i}->getPasien_id();
            $nestedData['nama'] = $object{$i}->getNama();
            $nestedData['tempat_lahir'] = $object{$i}->getTempat_lahir();
            $nestedData['tanggal_lahir'] = $object{$i}->getTanggal_lahir();
            $nestedData['alamat'] = $object{$i}->getAlamat();
            $nestedData['jenis_kelamin'] = $object{$i}->getJenis_kelamin();
            $nestedData['golongan_darah'] = $object{$i}->getGolongan_darah();
            $nestedData['agama'] = $object{$i}->getAgama();
            $nestedData['nomor_RM'] = $object{$i}->getNomor_RM();
            $nestedData['jenis_pasien_id'] = $object{$i}->getJenis_pasien_id();
            $nestedData['tanggal_daftar'] = $object{$i}->getTanggal_daftar();
            $nestedData['jenis_pasien'] = $object{$i}->getJenis_pasien();
            $nestedData['is_dilayani'] = $object{$i}->getIs_dilayani();
            $nestedData['status'] = $object{$i}->getStatus();
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

    public function searchPasienWithStatus($search)
    {   
        $data = array();
        
        $query = 
        "SELECT
        pasien.pasien_id,
        pasien.nama,
        pasien.tempat_lahir,
        pasien.tanggal_lahir,
        pasien.alamat,
        pasien.jenis_kelamin,
        pasien.golongan_darah,
        pasien.agama,
        pasien.nomor_RM,
        pasien.jenis_pasien_id,
        pasien.tanggal_daftar,
        jenis_pasien.nama_jenis_pasien AS jenis_pasien,
        lj_antrian.layanan AS is_dilayani,
        lj_antrian.`status`
        FROM
        pasien
        INNER JOIN jenis_pasien ON pasien.jenis_pasien_id = jenis_pasien.jenis_pasien_id
        LEFT JOIN (
        SELECT 
        antrian.pasien_id,
        antrian.`status` AS status,
        COUNT(*) AS layanan 
        FROM antrian WHERE antrian.tanggal_antrian BETWEEN DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 00:00:00') AND DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 23:59:59')
        AND antrian.`status` = 'belum_dilayani'
        GROUP BY
        antrian.pasien_id
        ) AS lj_antrian ON (lj_antrian.pasien_id= pasien.pasien_id)
        WHERE
        pasien.nama LIKE '%$search%'
        ORDER BY `pasien`.`pasien_id` ASC";

        $result = $this->conn->query($query);
        $data = array("data"=>$result);
        
        return $data;
    }

    public function editUnitTujuan()
    {   
        $id = $_POST['idPasien'];
        $unit = $_POST['unitsesudah'];
        $query ="UPDATE `antrian` SET `unit_id_tujuan` = '$unit', `status` = 'belum_dilayani' WHERE `antrian`.`antrian_id` = $id;";
        $result = $this->conn->query($query);
        return $result;
    }

    public function statusSudahDilayani()
    {   
        $id = $_POST['id'];
        $query ="UPDATE `antrian` SET `status` = 'sudah_dilayani' WHERE `antrian`.`antrian_id` = $id;";
        $result = $this->conn->query($query);
        return $result;
    }

    public function kunjungan()
    {   
        $id = $_POST['idPasien'];
        $jenis_kunjungan = $_POST['jenis_kunjungan'];
        $unit = $_POST['unitsesudah'];
        $status = "belum_dilayani";
        
        $query =
        "INSERT
        INTO antrian(pasien_id, jenis_kunjungan, unit_id_tujuan, status)
        VALUES ('$id', '$jenis_kunjungan', '$unit', '$status')
        ";
        $result = $this->conn->query($query);
        return $result;
    }
}
?>