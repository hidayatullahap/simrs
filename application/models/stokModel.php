<?php
require_once CLASSES_DIR  . 'dbconnection.php';
require_once CLASSES_DIR  . 'stok.php';

class StokModel extends CI_Model{
    public function __construct() {
        parent::__construct();
    }

    public function infoStok($unit_id, $sort, $page, $limitItemPage)
    {   
        $db = new DB();
        $conn = $db->connect();
        $page=($page*$limitItemPage)-$limitItemPage;
        $sqlSearch = "";
        $sqlTambahan1 = "";
        $sqlTambahan2 = "";
        if (isset($_POST["search"])){ $search =  $_POST["search"];}

        if(isset($search)){
            $sqlSearch = "AND barang.nama_barang LIKE '%$search%' ";
        }

        if($unit_id==3){
            $sqlTambahan1 = ", IFNULL(lj_stok.jumlah_deporajal,'0') AS jumlah_deporajal";
            $sqlTambahan2 = "LEFT JOIN (SELECT
			stok.barang_id,
            stok.unit_id AS unit_id,
            stok.jumlah AS jumlah_deporajal
            FROM
            stok
            WHERE
            stok.unit_id = 2
            ) AS lj_stok ON (lj_stok.barang_id = stok.barang_id) ";
        }

        $data = array();
        
        $query =
        "SELECT
        stok.stok_id,
        stok.barang_id,
        barang.nama_barang,
        stok.jumlah,
        stok.tanggal_pencatatan,
        stok.jumlah AS jumlah_farmasi,
        grup_barang.nama_grup_barang,
        satuan.nama_satuan $sqlTambahan1
        FROM
        stok $sqlTambahan2
        INNER JOIN barang ON barang.barang_id = stok.barang_id
        INNER JOIN grup_barang ON barang.grup_barang_id = grup_barang.grup_barang_id
        INNER JOIN satuan ON barang.satuan_id = satuan.satuan_id
        WHERE
        stok.unit_id = $unit_id $sqlSearch
        ORDER BY
        barang.nama_barang ASC
        LIMIT $page, $limitItemPage";
        $result = $conn->query($query);

        $rows = [];
        $i=0;
        $object; $barang; $satuan;
        $nestedData = array();
        $arrayData = new ArrayObject();
        while($row = mysqli_fetch_array($result))
        {   
            $object{$i} = new Stok();
            $object{$i}->setBarang_id($row['barang_id']);
            $object{$i}->setNama_barang($row['nama_barang']);
            $satuan = $object{$i}->satuan(null, $row['nama_satuan']);
            $object{$i}->setJumlah($row['jumlah']);
            $object{$i}->setTanggal_pencatatan($row['tanggal_pencatatan']);
            
            $nestedData['barang_id'] = $object{$i}->getBarang_id();
            $nestedData['nama_barang'] = $object{$i}->getNama_barang();
            $nestedData['nama_satuan'] = $satuan->getNama_satuan();
            $nestedData['jumlah'] =  $object{$i}->getJumlah();
            $nestedData['tanggal_pencatatan'] =  $object{$i}->getTanggal_pencatatan();
            $arrayData[] = $nestedData;

            $i++;
        } 
        $arrayData->num_rows = $i;

        $sql = $conn->query("SELECT COUNT(*) FROM stok INNER JOIN barang ON barang.barang_id = stok.barang_id WHERE stok.unit_id = $unit_id  $sqlSearch");
        $row = $sql->fetch_row();
        $count = $row[0];
        $totalData = $count;
        $totalPages = ceil($totalData/$limitItemPage);
        $conn->close();
        $data = array("data"=>$result, "currentPage"=>$page/$limitItemPage+1, "totalPages"=>$totalPages, "totalData"=>$totalData);
        return $data;
    }

    public function printInfoStok($unit_id)
    {   
        $db = new DB();
        $conn = $db->connect();
        $sqlTambahan1 = "";
        $sqlTambahan2 = "";

        if($unit_id==3){
            $sqlTambahan1 = ", IFNULL(lj_stok.jumlah_deporajal,'0') AS jumlah_deporajal";
            $sqlTambahan2 = "LEFT JOIN (SELECT
			stok.barang_id,
            stok.unit_id AS unit_id,
            stok.jumlah AS jumlah_deporajal
            FROM
            stok
            WHERE
            stok.unit_id = 2
            ) AS lj_stok ON (lj_stok.barang_id = stok.barang_id) ";
        }

        $data = array();
        
        $query =
        "SELECT
        stok.stok_id,
        stok.barang_id,
        barang.nama_barang,
        stok.jumlah,
        barang.harga_jual,
        stok.tanggal_pencatatan,
        stok.jumlah AS jumlah_farmasi,
        (barang.harga_jual*stok.jumlah) AS jumlah_stok_rp,
        grup_barang.nama_grup_barang,
        satuan.nama_satuan $sqlTambahan1
        FROM
        stok $sqlTambahan2
        INNER JOIN barang ON barang.barang_id = stok.barang_id
        INNER JOIN grup_barang ON barang.grup_barang_id = grup_barang.grup_barang_id
        INNER JOIN satuan ON barang.satuan_id = satuan.satuan_id
        WHERE
        stok.unit_id = $unit_id 
        ORDER BY
        barang.nama_barang ASC";
        $result = $conn->query($query);
        $rows = [];
        $i=0;
        $object; $barang; $satuan;
        $nestedData = array();
        $arrayData = new ArrayObject();
        while($row = mysqli_fetch_array($result))
        {   
            $object{$i} = new Stok();
            $object{$i}->setBarang_id($row['barang_id']);
            $object{$i}->setNama_barang($row['nama_barang']);
            $satuan = $object{$i}->satuan(null, $row['nama_satuan']);
            $object{$i}->setJumlah($row['jumlah']);
            $object{$i}->setTanggal_pencatatan($row['tanggal_pencatatan']);
            
            $nestedData['barang_id'] = $object{$i}->getBarang_id();
            $nestedData['nama_barang'] = $object{$i}->getNama_barang();
            $nestedData['nama_satuan'] = $satuan->getNama_satuan();
            $nestedData['jumlah'] =  $object{$i}->getJumlah();
            $nestedData['tanggal_pencatatan'] =  $object{$i}->getTanggal_pencatatan();
            $arrayData[] = $nestedData;

            $i++;
        } 
        $arrayData->num_rows = $i;
        
        $data = array("data"=>$result);
        $conn->close();
        return $data;
    }

    public function getLaporanRange($range, $sort, $page, $limitItemPage, $unit_id)
    {   
        $db = new DB();
        $conn = $db->connect();
        switch ($range) {
            case "Bulanan":
                $sqlRangeWaktu="YEAR(pengeluaran_barang.tanggal_keluar), MONTH(pengeluaran_barang.tanggal_keluar) ";
                break;
            case "Triwulan":
                $sqlRangeWaktu="YEAR(pengeluaran_barang.tanggal_keluar), QUARTER(pengeluaran_barang.tanggal_keluar) ";
                break;
            case "Semester":
                $sqlRangeWaktu="YEAR(pengeluaran_barang.tanggal_keluar), QUARTER(pengeluaran_barang.tanggal_keluar)=1 OR QUARTER(pengeluaran_barang.tanggal_keluar)=2 ";
                break;
            case "Tahunan":
                $sqlRangeWaktu="YEAR(pengeluaran_barang.tanggal_keluar) ";
                break;
            default:
                $sqlRangeWaktu="YEAR(pengeluaran_barang.tanggal_keluar), MONTH(pengeluaran_barang.tanggal_keluar) ";
        }

        $page=($page*$limitItemPage)-$limitItemPage;
        
        $data = array();
        
        $query =
        "SELECT
        pengeluaran_barang.tanggal_keluar AS range_waktu
        FROM
        pengeluaran_barang
        WHERE pengeluaran_barang.dari_unit_id = $unit_id
        GROUP BY
        $sqlRangeWaktu 
        ORDER BY
        pengeluaran_barang.tanggal_keluar DESC
        LIMIT $page, $limitItemPage";
        $result = $conn->query($query);
        $sql = $conn->query("SELECT Count(*) From(SELECT pengeluaran_barang.tanggal_keluar AS range_waktu FROM pengeluaran_barang WHERE pengeluaran_barang.dari_unit_id = $unit_id 
        GROUP BY $sqlRangeWaktu) As total");
        $row = $sql->fetch_row();
        $count = $row[0];
        $totalData = $count;
        $totalPages = ceil($totalData/$limitItemPage);
        $data = array("data"=>$result, "currentPage"=>$page/$limitItemPage+1, "totalPages"=>$totalPages, "totalData"=>$totalData);
        $conn->close();
        return $data;
    }

    public function getLaporan($range, $month, $year, $unit_id)
    {  
        $db = new DB();
        $conn = $db->connect();
        switch ($range) {
            case "Bulanan":
                $sqlRangeWaktuKeluar="AND YEAR(pengeluaran_barang.tanggal_keluar)=$year AND MONTH(pengeluaran_barang.tanggal_keluar)=$month ";
                $sqlRangeWaktuMasuk="AND YEAR(pengadaan_barang.tanggal_masuk)=$year AND MONTH(pengadaan_barang.tanggal_masuk)=$month ";
                break;
            case "Triwulan":
                if($month>=1 && $month<=3){
                    $sqlRangeWaktuKeluar="AND YEAR(pengeluaran_barang.tanggal_keluar)=$year AND QUARTER(pengeluaran_barang.tanggal_keluar)=1 ";
                    $sqlRangeWaktuMasuk="AND YEAR(pengadaan_barang.tanggal_masuk)    =$year AND QUARTER(pengadaan_barang.tanggal_masuk)=1 ";
                }else if($month>3 && $month<=6){
                    $sqlRangeWaktuKeluar="AND YEAR(pengeluaran_barang.tanggal_keluar)=$year AND QUARTER(pengeluaran_barang.tanggal_keluar)=2 ";
                    $sqlRangeWaktuMasuk="AND YEAR(pengadaan_barang.tanggal_masuk)    =$year AND QUARTER(pengadaan_barang.tanggal_masuk)=2 ";
                }else if($month>6 && $month<=9){
                    $sqlRangeWaktuKeluar="AND YEAR(pengeluaran_barang.tanggal_keluar)=$year AND QUARTER(pengeluaran_barang.tanggal_keluar)=3 ";
                    $sqlRangeWaktuMasuk="AND YEAR(pengadaan_barang.tanggal_masuk)    =$year AND QUARTER(pengadaan_barang.tanggal_masuk)=3 ";
                }else{
                    $sqlRangeWaktuKeluar="AND YEAR(pengeluaran_barang.tanggal_keluar)=$year AND QUARTER(pengeluaran_barang.tanggal_keluar)=4 ";
                    $sqlRangeWaktuMasuk="AND YEAR(pengadaan_barang.tanggal_masuk)    =$year AND QUARTER(pengadaan_barang.tanggal_masuk)=4 ";
                }
                break;
            case "Semester":
                if($month>=1 && $month<=6 ){
                    $sqlRangeWaktuKeluar="AND YEAR(pengeluaran_barang.tanggal_keluar)=$year AND QUARTER(pengeluaran_barang.tanggal_keluar)=1 OR QUARTER(pengeluaran_barang.tanggal_keluar)=2 ";
                    $sqlRangeWaktuMasuk="AND YEAR(pengadaan_barang.tanggal_masuk)    =$year AND QUARTER(pengadaan_barang.tanggal_masuk)=1 OR QUARTER(pengadaan_barang.tanggal_masuk)=2 ";
                }else{
                    $sqlRangeWaktuKeluar="AND YEAR(pengeluaran_barang.tanggal_keluar)=$year AND QUARTER(pengeluaran_barang.tanggal_keluar)=3 OR QUARTER(pengeluaran_barang.tanggal_keluar)=4 ";
                    $sqlRangeWaktuMasuk="AND YEAR(pengadaan_barang.tanggal_masuk)    =$year AND QUARTER(pengadaan_barang.tanggal_masuk)=3 OR QUARTER(pengadaan_barang.tanggal_masuk)=4 ";
                }
                break;
            case "Tahunan":
                $sqlRangeWaktuKeluar="AND YEAR(pengeluaran_barang.tanggal_keluar)=$year ";
                $sqlRangeWaktuMasuk="AND YEAR(pengadaan_barang.tanggal_masuk)=$year ";
                break;
            default:
                $sqlRangeWaktuKeluar="AND YEAR(pengeluaran_barang.tanggal_keluar)=$year AND MONTH(pengeluaran_barang.tanggal_keluar)=$month ";
                $sqlRangeWaktuMasuk="AND YEAR(pengadaan_barang.tanggal_masuk)=$year AND MONTH(pengadaan_barang.tanggal_masuk)=$month ";
        }
        
        $data = array();
        
        $query =
        "SELECT
        barang.barang_id,
        barang.nama_barang,
        satuan.nama_satuan,
        barang.harga_jual AS harga_jual,
        IFNULL(lj_pengeluaran.jumlah_barang_keluar,'-')  AS jumlah_barang_keluar,
        IFNULL(lj_pengeluaran.jumlah_pengeluaran_rp,'0') as jumlah_pengeluaran_in_rp,
        IFNULL(lj_pemasukan_barang.jumlah_barang_masuk,'-') AS jumlah_barang_masuk,
        IFNULL(lj_pemasukan_barang.jumlah_pengadaan_rp,'0') as jumlah_pengadaan_in_rp,
        IFNULL(lj_stok.jumlah,'-') as stok_sekarang,
        IFNULL(lj_stok.jumlah_stok_rp,'0') as jumlah_stok_in_rp
        FROM
        barang
        LEFT JOIN (
        SELECT
        pengeluaran_barang.barang_id,
        SUM(pengeluaran_barang.jumlah_pengeluaran) AS jumlah_barang_keluar,
        (SUM(pengeluaran_barang.jumlah_pengeluaran)*barang.harga_jual) AS jumlah_pengeluaran_rp
        FROM
        pengeluaran_barang
        INNER JOIN barang ON pengeluaran_barang.barang_id = barang.barang_id
        WHERE
        pengeluaran_barang.dari_unit_id = $unit_id
        $sqlRangeWaktuKeluar 
        GROUP BY
        pengeluaran_barang.barang_id
        ) lj_pengeluaran ON (lj_pengeluaran.barang_id = barang.barang_id)

        LEFT JOIN (
        SELECT
        pengadaan_barang.barang_id,
        SUM(pengadaan_barang.jumlah_barang) AS jumlah_barang_masuk,
        (SUM(pengadaan_barang.jumlah_barang)*barang.harga_jual) AS jumlah_pengadaan_rp
        FROM
        pengadaan_barang
        INNER JOIN barang ON pengadaan_barang.barang_id = barang.barang_id
        WHERE
        pengadaan_barang.untuk_unit_id = $unit_id
        $sqlRangeWaktuMasuk  
        GROUP BY
        pengadaan_barang.barang_id) lj_pemasukan_barang ON (lj_pemasukan_barang.barang_id = barang.barang_id)
        LEFT JOIN (
        SELECT
        stok.barang_id AS barang_id,
        stok.jumlah AS jumlah,
        (barang.harga_jual*stok.jumlah) AS jumlah_stok_rp
        FROM
        stok
        INNER JOIN barang ON stok.barang_id = barang.barang_id
        WHERE
        stok.unit_id = $unit_id
        )lj_stok ON (lj_stok.barang_id = barang.barang_id)
        INNER JOIN satuan ON barang.satuan_id = satuan.satuan_id
        GROUP BY
        barang.nama_barang
        ";
        $result = $conn->query($query);
        
        $rows = [];
        $i=0;
        $object; $barang; $satuan;
        $nestedData = array();
        $arrayData = new ArrayObject();
        while($row = mysqli_fetch_array($result))
        {   
            $object{$i} = new Stok();
            $object{$i}->setBarang_id($row['barang_id']);
            $object{$i}->setNama_barang($row['nama_barang']);
            $satuan = $object{$i}->satuan(null, $row['nama_satuan']);
            $object{$i}->setHarga_jual($row['harga_jual']);
            $object{$i}->setJumlah_barang_keluar($row['jumlah_barang_keluar']);
            $object{$i}->setJumlah_pengeluaran_in_rp($row['jumlah_pengeluaran_in_rp']);
            $object{$i}->setJumlah_barang_masuk($row['jumlah_barang_masuk']);
            $object{$i}->setJumlah_pengadaan_in_rp($row['jumlah_pengadaan_in_rp']);
            $object{$i}->setStok_sekarang($row['stok_sekarang']);
            $object{$i}->setJumlah_stok_in_rp($row['jumlah_stok_in_rp']);
            
            $nestedData['barang_id'] = $object{$i}->getBarang_id();
            $nestedData['nama_barang'] = $object{$i}->getNama_barang();
            $nestedData['nama_satuan'] = $satuan->getNama_satuan();
            $nestedData['harga_jual'] = $object{$i}->getHarga_jual();
            $nestedData['jumlah_barang_keluar'] = $object{$i}->getJumlah_barang_keluar();
            $nestedData['jumlah_pengeluaran_in_rp'] = $object{$i}->getJumlah_pengeluaran_in_rp();
            $nestedData['jumlah_barang_masuk'] = $object{$i}->getJumlah_barang_masuk();
            $nestedData['jumlah_pengadaan_in_rp'] = $object{$i}->getJumlah_pengadaan_in_rp();
            $nestedData['stok_sekarang'] = $object{$i}->getStok_sekarang();
            $nestedData['jumlah_stok_in_rp'] = $object{$i}->getJumlah_stok_in_rp();
            $arrayData[] = $nestedData;

            $i++;
        } 
        $arrayData->num_rows = $i;
        $conn->close();
        $data = array("data"=>$arrayData);
        return $data;
    }
    
    public function ajaxNearExpired($unit_id)
    {   
        date_default_timezone_set('Asia/Jakarta');
        $db = new DB();
        $conn = $db->connect();
        $requestData = $_REQUEST;
        $page = $requestData['start'];
        $limitItemPage = $requestData['length'];
        $data = array();
        
        $query =
        "SELECT
        barang.nama_barang,
        pengadaan_barang.jumlah_barang,
        pengadaan_barang.tanggal_kadaluarsa,
        pengadaan_barang.tanggal_masuk,
        pengadaan_barang.no_batch
        FROM
        barang
        INNER JOIN pengadaan_barang ON pengadaan_barang.barang_id = barang.barang_id
        WHERE
        barang.grup_barang_id = 1
        #pengadaan_barang.tanggal_kadaluarsa > '1970-01-01'
        AND pengadaan_barang.tanggal_kadaluarsa >= NOW()
        AND pengadaan_barang.tanggal_kadaluarsa < DATE_SUB(NOW(), INTERVAL -3 MONTH)
        AND pengadaan_barang.untuk_unit_id = $unit_id
        OR (
        barang.grup_barang_id = 4
        AND pengadaan_barang.tanggal_kadaluarsa >= NOW()
        AND pengadaan_barang.tanggal_kadaluarsa < DATE_SUB(NOW(), INTERVAL -3 MONTH)
        AND pengadaan_barang.untuk_unit_id = 3
        )
        ORDER BY
        pengadaan_barang.tanggal_kadaluarsa ASC
        LIMIT $page, $limitItemPage";
        
        $sql = $conn->query("SELECT COUNT(*) FROM barang 
        INNER JOIN pengadaan_barang 
        ON pengadaan_barang.barang_id = barang.barang_id 
        WHERE barang.grup_barang_id = 1
        AND pengadaan_barang.tanggal_kadaluarsa >= NOW()
        AND pengadaan_barang.tanggal_kadaluarsa < DATE_SUB(NOW(), INTERVAL -3 MONTH)
        AND pengadaan_barang.untuk_unit_id = $unit_id
        OR (
        barang.grup_barang_id = 4
        AND pengadaan_barang.tanggal_kadaluarsa >= NOW()
        AND pengadaan_barang.tanggal_kadaluarsa < DATE_SUB(NOW(), INTERVAL -3 MONTH)
        AND pengadaan_barang.untuk_unit_id = $unit_id
        )");

        if( !empty($requestData['search']['value']) ) {
            $query =
            "SELECT
            barang.nama_barang,
            pengadaan_barang.jumlah_barang,
            pengadaan_barang.tanggal_kadaluarsa,
            pengadaan_barang.tanggal_masuk,
            pengadaan_barang.no_batch
            FROM
            barang
            INNER JOIN pengadaan_barang ON pengadaan_barang.barang_id = barang.barang_id
            WHERE
            barang.grup_barang_id = 1
            AND pengadaan_barang.untuk_unit_id = $unit_id
            AND pengadaan_barang.tanggal_kadaluarsa >= NOW()
            AND pengadaan_barang.tanggal_kadaluarsa < DATE_SUB(NOW(), INTERVAL -3 MONTH)
            AND barang.nama_barang LIKE '%".$requestData['search']['value']."%'
            OR (
            barang.grup_barang_id = 4
            AND pengadaan_barang.tanggal_kadaluarsa >= NOW()
            AND pengadaan_barang.tanggal_kadaluarsa < DATE_SUB(NOW(), INTERVAL -3 MONTH)
            AND pengadaan_barang.untuk_unit_id = $unit_id
            AND barang.nama_barang LIKE '%".$requestData['search']['value']."%'
            )
            ORDER BY
            pengadaan_barang.tanggal_kadaluarsa ASC
            LIMIT $page, $limitItemPage";

            $sql = $conn->query("SELECT COUNT(*) FROM pengadaan_barang 
            INNER JOIN barang ON pengadaan_barang.barang_id = barang.barang_id
            WHERE barang.grup_barang_id = 1
            AND pengadaan_barang.untuk_unit_id = $unit_id
            AND pengadaan_barang.tanggal_kadaluarsa >= NOW()
            AND pengadaan_barang.tanggal_kadaluarsa < DATE_SUB(NOW(), INTERVAL -3 MONTH)
            AND barang.nama_barang LIKE '%".$requestData['search']['value']."%'
            OR (
            barang.grup_barang_id = 4
            AND pengadaan_barang.tanggal_kadaluarsa >= NOW()
            AND pengadaan_barang.tanggal_kadaluarsa < DATE_SUB(NOW(), INTERVAL -3 MONTH)
            AND pengadaan_barang.untuk_unit_id = $unit_id
            AND barang.nama_barang LIKE '%".$requestData['search']['value']."%'
            )");
        }
        
        $result = $conn->query($query);

        while ($row = mysqli_fetch_assoc($result)) {
            $nestedData = array();
            $rowDate=strtotime($row['tanggal_masuk']);
            $rowKadaluarsa=strtotime($row['tanggal_kadaluarsa']);
            #hitung waktu kadaluarsa
            $exp = $this->hitungWaktuKadaluarsa($row['tanggal_kadaluarsa']);
            $dayExp = $exp[0];
            $monthExp = $exp[1];
            if($monthExp>1){
                $dayMonthExp = $monthExp." Bulan ". $dayExp." Hari";
                $spanDayMonthExp = "<td><h4><span class='label label-success'>".$dayMonthExp."</span></h4></td>";
            }else if($monthExp>0){
                $dayMonthExp = $monthExp." Bulan ". $dayExp." Hari";
                $spanDayMonthExp = "<td><h4><span class='label label-warning'>".$dayMonthExp."</span></h4></td>";
            }else{
                $dayMonthExp = $dayExp." Hari";
                $spanDayMonthExp = "<td><h4><span class='label label-danger'>".$dayMonthExp."</span></h4></td>";
            }

            $nestedData[] = $spanDayMonthExp;
            $nestedData[] = $row['nama_barang'];
            $nestedData[] = $row['no_batch'];
            $nestedData[] = $row['jumlah_barang'];
            $nestedData[] = date("d-M-Y ", $rowKadaluarsa);
            $nestedData[] = date("d-M-Y H:i:s", $rowDate);
            $data[] = $nestedData;
        }
        
        
        $row = $sql->fetch_row();
        $count = $row[0];
        $totalData = $count;
        $conn->close();
        $datajson = array("draw" => intval( $requestData['draw'] ), "recordsTotal"=>$totalData, "recordsFiltered"=>$totalData, "data"=>$data);
        echo json_encode($datajson);
    }

    public function hitungWaktuKadaluarsa($tanggalKadaluarsaBarang){
        $tanggalExp = strtotime($tanggalKadaluarsaBarang);
        $tanggalNow = strtotime(date('Y-m-d', time() + 86400));

        $dayExp = date("d", $tanggalExp);
        $monthExp = date("m", $tanggalExp);

        $dayNow = date("d", $tanggalNow);
        $monthNow = date("m", $tanggalNow);

        /*
        $diffDay = $dayExp - $dayNow;
        $diffMonth = $monthExp - $monthNow;
        */
        if($monthExp==$monthNow){
            $diff = $tanggalExp - $tanggalNow;
            $diffDay = date("d", $diff);
            $diffMonth = 0;
        }else{
            $diff = $tanggalExp - $tanggalNow;
            $diffDay = date("d", $diff);
            $diffMonth = date("m", $diff);
        }
        $arrayDateDiff[0] = $diffDay;
        $arrayDateDiff[1] = $diffMonth;
        return $arrayDateDiff;
    }
    
    public function ajaxRunningOutStock($unit_id)
    {   
        $db = new DB();
        $conn = $db->connect();
        $requestData = $_REQUEST;
        $page = $requestData['start'];
        $limitItemPage = $requestData['length'];
        $data = array();
        
        $query =
        "SELECT
        stok.jumlah,
        barang.nama_barang,
        satuan.nama_satuan
        FROM
        stok
        INNER JOIN barang ON stok.barang_id = barang.barang_id
        INNER JOIN unit ON stok.unit_id = unit.unit_id
        INNER JOIN grup_barang ON barang.grup_barang_id = grup_barang.grup_barang_id
        INNER JOIN satuan ON barang.satuan_id = satuan.satuan_id
        WHERE
        unit.unit_id = $unit_id AND
        barang.grup_barang_id = 4
        HAVING 
        stok.jumlah < 500
        ORDER BY
        stok.jumlah ASC
        LIMIT $page, $limitItemPage";
        
        $sql = $conn->query("SELECT count(*)
        FROM (
        SELECT
        stok.jumlah,
        barang.nama_barang,
        satuan.nama_satuan
        FROM
        stok
        INNER JOIN barang ON stok.barang_id = barang.barang_id
        INNER JOIN unit ON stok.unit_id = unit.unit_id
        INNER JOIN grup_barang ON barang.grup_barang_id = grup_barang.grup_barang_id
        INNER JOIN satuan ON barang.satuan_id = satuan.satuan_id
        WHERE
        unit.unit_id = $unit_id AND
        barang.grup_barang_id = 4
        HAVING 
        stok.jumlah < 500) AS x");

        if( !empty($requestData['search']['value']) ) {
            $query =
            "SELECT
            stok.jumlah,
            barang.nama_barang,
            satuan.nama_satuan
            FROM
            stok
            INNER JOIN barang ON stok.barang_id = barang.barang_id
            INNER JOIN unit ON stok.unit_id = unit.unit_id
            INNER JOIN grup_barang ON barang.grup_barang_id = grup_barang.grup_barang_id
            INNER JOIN satuan ON barang.satuan_id = satuan.satuan_id
            WHERE
            unit.unit_id = $unit_id AND
            barang.grup_barang_id = 4
            AND barang.nama_barang LIKE '%".$requestData['search']['value']."%'
            HAVING 
            stok.jumlah < 500
            ORDER BY
            stok.jumlah ASC
            LIMIT $page, $limitItemPage";

            $sql = $conn->query("SELECT count(*)
            FROM (
            SELECT
            stok.jumlah,
            barang.nama_barang,
            satuan.nama_satuan
            FROM
            stok
            INNER JOIN barang ON stok.barang_id = barang.barang_id
            INNER JOIN unit ON stok.unit_id = unit.unit_id
            INNER JOIN grup_barang ON barang.grup_barang_id = grup_barang.grup_barang_id
            INNER JOIN satuan ON barang.satuan_id = satuan.satuan_id
            WHERE
            unit.unit_id = $unit_id AND
            barang.grup_barang_id = 4
            AND barang.nama_barang LIKE '%".$requestData['search']['value']."%'
            HAVING 
            stok.jumlah < 500) AS x");
        }
        
        $result = $conn->query($query);

        while ($row = mysqli_fetch_assoc($result)) {
            $nestedData = array();
            $jumlah = $row['jumlah'];
            if($jumlah>0 && $jumlah <=200){
                $spanJumlah = "<td><h4><span class='label label-danger'>".$jumlah."</span></h4></td>";
            }else if($jumlah>200 && $jumlah <=300){
                $spanJumlah = "<td><h4><span class='label label-warning'>".$jumlah."</span></h4></td>";
            }else{
                $spanJumlah = "<td><h4><span class='label label-success'>".$jumlah."</span></h4></td>";
            }
            $nestedData[] = $spanJumlah;
            $nestedData[] = $row['nama_barang'];
            $nestedData[] = $row['nama_satuan'];
            $data[] = $nestedData;
        }
        
        $row = $sql->fetch_row();
        $count = $row[0];
        $totalData = $count;
        $conn->close();
        $datajson = array("draw" => intval( $requestData['draw'] ), "recordsTotal"=>$totalData, "recordsFiltered"=>$totalData, "data"=>$data);
        echo json_encode($datajson);
    }
}
?>