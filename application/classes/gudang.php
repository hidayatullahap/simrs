<?php
require_once CLASSES_DIR  . 'dbconnection.php';

class Gudang{

    public function ajaxPermintaanMasuk()
    {   
        $db=new DB;
        $conn=$db->connect();
        $requestData = $_REQUEST;
        $page = $requestData['start'];
        $limitItemPage = $requestData['length'];
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
        antrian.tanggal_antrian BETWEEN DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 00:00:00') AND DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 23:59:59') AND
        antrian.`status` = 'belum_dilayani' 
        ORDER BY `antrian`.`tanggal_antrian` DESC
        LIMIT $page, $limitItemPage";
        
        $sql = $conn->query("SELECT COUNT(*) FROM antrian WHERE
        antrian.tanggal_antrian BETWEEN DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 00:00:00') AND DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 23:59:59') AND
        antrian.`status` = 'belum_dilayani' ");

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
            antrian.tanggal_antrian BETWEEN DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 00:00:00') AND DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 23:59:59')
            AND antrian.`status` = 'belum_dilayani' 
            AND pasien.nama LIKE '%".$requestData['search']['value']."%'
            ORDER BY `antrian`.`tanggal_antrian` DESC
            LIMIT $page, $limitItemPage";
        }
        
        $result = $conn->query($query);

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
            $nestedData[] = "<td><button type='button' class='btn btn-primary btn-md' id='buttonPindahUnit' onclick=\"editModal($id_antrian,'$nama','$unit');\">Pindah Unit</button></td>";
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
        $db=new DB;
        $conn=$db->connect();
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
        $result = $conn->query($query);
        
        $sql = $conn->query("SELECT COUNT(*) FROM pasien");
        $row = $sql->fetch_row();
        $count = $row[0];
        $totalData = $count;
        $totalPages = ceil($totalData/$limitItemPage);
        $data = array("data"=>$result, "currentPage"=>$page/$limitItemPage+1, "totalPages"=>$totalPages, "totalData"=>$totalData);

        return $data;
    }

    public function searchPasienWithStatus($search)
    {   
        $db=new DB;
        $conn=$db->connect();

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
        ORDER BY `pasien`.`pasien_id` DESC";

        $result = $conn->query($query);
        $data = array("data"=>$result);
        
        return $data;
    }

    public function postData()
    {   
        $db=new DB;
        $conn=$db->connect();

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
        $result = $conn->query($query);
        return $result;
    }

    public function editData($id)
    {   
        $db=new DB;
        $conn=$db->connect();

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
        $result = $conn->query($query);
        return $result;
    }

    public function editUnitTujuan()
    {   
        $db=new DB;
        $conn=$db->connect();

        $id = $_POST['idPasien'];
        $unit = $_POST['unitsesudah'];
        $query ="UPDATE `antrian` SET `unit_id_tujuan` = '$unit', `status` = 'belum_dilayani' WHERE `antrian`.`antrian_id` = $id;";
        $result = $conn->query($query);
        return $result;
    }

    public function kunjungan()
    {   
        $db=new DB;
        $conn=$db->connect();

        $id = $_POST['idPasien'];
        $jenis_kunjungan = $_POST['jenis_kunjungan'];
        $unit = $_POST['unitsesudah'];
        $status = "belum_dilayani";
        
        $query =
        "INSERT
        INTO antrian(pasien_id, jenis_kunjungan, unit_id_tujuan, status)
        VALUES ('$id', '$jenis_kunjungan', '$unit', '$status')
        ";
        $result = $conn->query($query);
        return $result;
    }

    public function deleteData($id)
    {
        $db=new DB;
        $conn=$db->connect();
        $query ="DELETE FROM `pasien` WHERE `pasien`.`pasien_id` = $id";
        $result = $conn->query($query);
        return $result;
        
    }

    public function searchData($search)
    {   
        $db=new DB;
        $conn=$db->connect();

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
        antrian.tanggal_antrian BETWEEN DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 00:00:00') AND DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 23:59:59') AND
        pasien.nama LIKE '%$search%'
        ORDER BY `antrian`.`antrian_id` DESC";

        $result = $conn->query($query);
        $data = array("data"=>$result);
        
        return $data;
    }
}
?>