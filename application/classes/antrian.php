<?php
require_once CLASSES_DIR  . 'dbconnection.php';
require_once CLASSES_DIR  . 'pasien.php';
require_once CLASSES_DIR  . 'jenispasien.php';

class Antrian{
    private $db;
    private $conn;
    private $antrian_id;
    private $status;
    private $jenis_kunjungan;
    private $unit_id_tujuan;
    private $tanggal_antrian;
    private $nama_unit;
    private $is_dilayani;

    public function __construct() {
        $this->db = new DB();
        $this->conn = $this->db->connect();
    }

    function setAntrian_id($antrian_id) { $this->antrian_id = $antrian_id; }
    function getAntrian_id() { return $this->antrian_id; }
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
    function setIs_dilayani($is_dilayani) { $this->is_dilayani = $is_dilayani; }
    function getIs_dilayani() { return $this->is_dilayani; }


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
        $antrian;
        $pasien;
        $nestedData = array();
        $arrayData = new ArrayObject();
        while($row = mysqli_fetch_array($result))
        {   
            $antrian{$i} = new Antrian();
            $pasien{$i} = new Pasien();
            $antrian{$i}->setAntrian_id($row['antrian_id']);
            $pasien{$i}->setPasien_id($row['pasien_id']);
            $antrian{$i}->setJenis_kunjungan($row['jenis_kunjungan']);
            $antrian{$i}->setUnit_id_tujuan($row['unit_id_tujuan']);
            $antrian{$i}->setStatus($row['status']);
            $antrian{$i}->setTanggal_antrian($row['tanggal_antrian']);
            $pasien{$i}->setNama($row['nama']);
            $antrian{$i}->setNama_unit($row['nama_unit']);

            $nestedData['antrian_id'] = $antrian{$i}->getAntrian_id();
            $nestedData['pasien_id'] = $pasien{$i}->getPasien_id();
            $nestedData['jenis_kunjungan'] = $antrian{$i}->getJenis_kunjungan();
            $nestedData['unit_id_tujuan'] = $antrian{$i}->getUnit_id_tujuan();
            $nestedData['status'] = $antrian{$i}->getStatus();
            $nestedData['tanggal_antrian'] = $antrian{$i}->getTanggal_antrian();
            $nestedData['nama'] = $pasien{$i}->getNama();
            $nestedData['nama_unit'] = $antrian{$i}->getNama_unit();
            $arrayData[] = $nestedData;
            $antrian{$i}->conn->close();

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
        $antrian;$pasien;$jenisPasien;
        $nestedData = array();
        $arrayData = new ArrayObject();
        while($row = mysqli_fetch_array($result))
        {   
            $antrian{$i} = new Antrian();
            $pasien{$i} = new Pasien();
            $jenisPasien{$i} = new JenisPasien();
            $pasien{$i}->setPasien_id($row['pasien_id']);
            $pasien{$i}->setNama($row['nama']);
            $pasien{$i}->setTempat_lahir($row['tempat_lahir']);
            $pasien{$i}->setTanggal_lahir($row['tanggal_lahir']);
            $pasien{$i}->setAlamat($row['alamat']);
            $pasien{$i}->setJenis_kelamin($row['jenis_kelamin']);
            $pasien{$i}->setGolongan_darah($row['golongan_darah']);
            $pasien{$i}->setAgama($row['agama']);
            $pasien{$i}->setNomor_RM($row['nomor_RM']);
            $jenisPasien{$i}->setJenis_pasien_id($row['jenis_pasien_id']);
            $pasien{$i}->setTanggal_daftar($row['tanggal_daftar']);
            $jenisPasien{$i}->setNama_jenis_pasien($row['jenis_pasien']);
            $antrian{$i}->setIs_dilayani($row['is_dilayani']);
            $antrian{$i}->setStatus($row['status']);

            $nestedData['pasien_id'] = $pasien{$i}->getPasien_id();
            $nestedData['nama'] = $pasien{$i}->getNama();
            $nestedData['tempat_lahir'] = $pasien{$i}->getTempat_lahir();
            $nestedData['tanggal_lahir'] = $pasien{$i}->getTanggal_lahir();
            $nestedData['alamat'] = $pasien{$i}->getAlamat();
            $nestedData['jenis_kelamin'] = $pasien{$i}->getJenis_kelamin();
            $nestedData['golongan_darah'] = $pasien{$i}->getGolongan_darah();
            $nestedData['agama'] = $pasien{$i}->getAgama();
            $nestedData['nomor_RM'] = $pasien{$i}->getNomor_RM();
            $nestedData['jenis_pasien_id'] = $jenisPasien{$i}->getJenis_pasien_id();
            $nestedData['tanggal_daftar'] = $pasien{$i}->getTanggal_daftar();
            $nestedData['jenis_pasien'] = $jenisPasien{$i}->getNama_jenis_pasien();
            $nestedData['is_dilayani'] = $antrian{$i}->getIs_dilayani();
            $nestedData['status'] = $antrian{$i}->getStatus();
            $arrayData[] = $nestedData;
            $antrian{$i}->conn->close();

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