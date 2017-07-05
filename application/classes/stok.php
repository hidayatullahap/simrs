<?php
require_once CLASSES_DIR  . 'dbconnection.php';
require_once CLASSES_DIR  . 'barang.php';
require_once CLASSES_DIR  . 'satuan.php';

class Stok{
    private $stok_id;
    private $jumlah;
    private $tanggal_pencatatan;
    private $jumlah_barang_keluar;
    private $jumlah_pengeluaran_in_rp;
    private $jumlah_barang_masuk;
    private $jumlah_pengadaan_in_rp;
    private $stok_sekarang;
    private $jumlah_stok_in_rp;

    function setStok_id($stok_id) { $this->stok_id = $stok_id; }
    function getStok_id() { return $this->stok_id; }
    function setJumlah($jumlah) { $this->jumlah = $jumlah; }
    function getJumlah() { return $this->jumlah; }
    function setTanggal_pencatatan($tanggal_pencatatan) { $this->tanggal_pencatatan = $tanggal_pencatatan; }
    function getTanggal_pencatatan() { return $this->tanggal_pencatatan; }
    function setJumlah_barang_keluar($jumlah_barang_keluar) { $this->jumlah_barang_keluar = $jumlah_barang_keluar; }
    function getJumlah_barang_keluar() { return $this->jumlah_barang_keluar; }
    function setJumlah_pengeluaran_in_rp($jumlah_pengeluaran_in_rp) { $this->jumlah_pengeluaran_in_rp = $jumlah_pengeluaran_in_rp; }
    function getJumlah_pengeluaran_in_rp() { return $this->jumlah_pengeluaran_in_rp; }
    function setJumlah_barang_masuk($jumlah_barang_masuk) { $this->jumlah_barang_masuk = $jumlah_barang_masuk; }
    function getJumlah_barang_masuk() { return $this->jumlah_barang_masuk; }
    function setJumlah_pengadaan_in_rp($jumlah_pengadaan_in_rp) { $this->jumlah_pengadaan_in_rp = $jumlah_pengadaan_in_rp; }
    function getJumlah_pengadaan_in_rp() { return $this->jumlah_pengadaan_in_rp; }
    function setStok_sekarang($stok_sekarang) { $this->stok_sekarang = $stok_sekarang; }
    function getStok_sekarang() { return $this->stok_sekarang; }
    function setJumlah_stok_in_rp($jumlah_stok_in_rp) { $this->jumlah_stok_in_rp = $jumlah_stok_in_rp; }
    function getJumlah_stok_in_rp() { return $this->jumlah_stok_in_rp; }

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
        (pengeluaran_barang.jumlah_pengeluaran*barang.harga_jual) AS jumlah_pengeluaran_rp
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
        (pengadaan_barang.jumlah_barang*barang.harga_jual) AS jumlah_pengadaan_rp
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
            $barang{$i} = new Barang();
            $satuan{$i} = new Satuan();
            $barang{$i}->setBarang_id($row['barang_id']);
            $barang{$i}->setNama_barang($row['nama_barang']);
            $satuan{$i}->setNama_satuan($row['nama_satuan']);
            $barang{$i}->setHarga_jual($row['harga_jual']);
            $object{$i}->setJumlah_barang_keluar($row['jumlah_barang_keluar']);
            $object{$i}->setJumlah_pengeluaran_in_rp($row['jumlah_pengeluaran_in_rp']);
            $object{$i}->setJumlah_barang_masuk($row['jumlah_barang_masuk']);
            $object{$i}->setJumlah_pengadaan_in_rp($row['jumlah_pengadaan_in_rp']);
            $object{$i}->setStok_sekarang($row['stok_sekarang']);
            $object{$i}->setJumlah_stok_in_rp($row['jumlah_stok_in_rp']);
            
            $nestedData['barang_id'] = $barang{$i}->getBarang_id();
            $nestedData['nama_barang'] = $barang{$i}->getNama_barang();
            $nestedData['nama_satuan'] = $satuan{$i}->getNama_satuan();
            $nestedData['harga_jual'] = $barang{$i}->getHarga_jual();
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
    
}
?>