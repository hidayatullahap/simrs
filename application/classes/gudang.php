<?php
require_once CLASSES_DIR  . 'dbconnection.php';

class Gudang{
    private $db;
    private $conn;
    private $nomor_permintaan;
    private $dari_unit_id;
    private $nama_unit;
    private $tanggal_permintaan;
    private $nama_barang;
    private $jumlah_pengeluaran;
    private $tanggal_keluar;
    private $terima_dari;
    private $tanggal_masuk;
    private $jumlah_barang;
    private $permintaan_stok_id;
    private $barang_id;
    private $jumlah_permintaan;
    private $jumlah_disetujui;
    private $status;
    private $stok_tersedia;
    private $nama_satuan;
    private $nama_grup_barang;
    private $no_batch;
    private $nama_penerima;
    private $nama_jenis_penerimaan;
    private $harga_jual;
    private $harga_beli;
    private $tanggal_kadaluarsa;
    private $no_faktur;
    private $jumlah_barang_keluar;
    private $jumlah_pengeluaran_in_rp;
    private $jumlah_barang_masuk;
    private $jumlah_pengadaan_in_rp;
    private $stok_sekarang;
    private $jumlah_stok_in_rp;


    public function __construct() {
        $this->db = new DB();
        $this->conn = $this->db->connect();
    }
    
    function setNomor_permintaan($nomor_permintaan) { $this->nomor_permintaan = $nomor_permintaan; }
    function getNomor_permintaan() { return $this->nomor_permintaan; }
    function setDari_unit_id($dari_unit_id) { $this->dari_unit_id = $dari_unit_id; }
    function getDari_unit_id() { return $this->dari_unit_id; }
    function setNama_unit($nama_unit) { $this->nama_unit = $nama_unit; }
    function getNama_unit() { return $this->nama_unit; }
    function setTanggal_permintaan($tanggal_permintaan) { $this->tanggal_permintaan = $tanggal_permintaan; }
    function getTanggal_permintaan() { return $this->tanggal_permintaan; }
    function setNama_barang($nama_barang) { $this->nama_barang = $nama_barang; }
    function getNama_barang() { return $this->nama_barang; }
    function setJumlah_pengeluaran($jumlah_pengeluaran) { $this->jumlah_pengeluaran = $jumlah_pengeluaran; }
    function getJumlah_pengeluaran() { return $this->jumlah_pengeluaran; }
    function setTanggal_keluar($tanggal_keluar) { $this->tanggal_keluar = $tanggal_keluar; }
    function getTanggal_keluar() { return $this->tanggal_keluar; }
    function setTerima_dari($terima_dari) { $this->terima_dari = $terima_dari; }
    function getTerima_dari() { return $this->terima_dari; }
    function setTanggal_masuk($tanggal_masuk) { $this->tanggal_masuk = $tanggal_masuk; }
    function getTanggal_masuk() { return $this->tanggal_masuk; }
    function setJumlah_barang($jumlah_barang) { $this->jumlah_barang = $jumlah_barang; }
    function getJumlah_barang() { return $this->jumlah_barang; }
    function setPermintaan_stok_id($permintaan_stok_id) { $this->permintaan_stok_id = $permintaan_stok_id; }
    function getPermintaan_stok_id() { return $this->permintaan_stok_id; }
    function setBarang_id($barang_id) { $this->barang_id = $barang_id; }
    function getBarang_id() { return $this->barang_id; }
    function setJumlah_permintaan($jumlah_permintaan) { $this->jumlah_permintaan = $jumlah_permintaan; }
    function getJumlah_permintaan() { return $this->jumlah_permintaan; }
    function setJumlah_disetujui($jumlah_disetujui) { $this->jumlah_disetujui = $jumlah_disetujui; }
    function getJumlah_disetujui() { return $this->jumlah_disetujui; }
    function setStatus($status) { $this->status = $status; }
    function getStatus() { return $this->status; }
    function setStok_tersedia($stok_tersedia) { $this->stok_tersedia = $stok_tersedia; }
    function getStok_tersedia() { return $this->stok_tersedia; }
    function setNama_satuan($nama_satuan) { $this->nama_satuan = $nama_satuan; }
    function getNama_satuan() { return $this->nama_satuan; }
    function setNama_grup_barang($nama_grup_barang) { $this->nama_grup_barang = $nama_grup_barang; }
    function getNama_grup_barang() { return $this->nama_grup_barang; }
    function setNo_batch($no_batch) { $this->no_batch = $no_batch; }
    function getNo_batch() { return $this->no_batch; }
    function setNama_penerima($nama_penerima) { $this->nama_penerima = $nama_penerima; }
    function getNama_penerima() { return $this->nama_penerima; }
    function setNama_jenis_penerimaan($nama_jenis_penerimaan) { $this->nama_jenis_penerimaan = $nama_jenis_penerimaan; }
    function getNama_jenis_penerimaan() { return $this->nama_jenis_penerimaan; }
    function setHarga_jual($harga_jual) { $this->harga_jual = $harga_jual; }
    function getHarga_jual() { return $this->harga_jual; }
    function setHarga_beli($harga_beli) { $this->harga_beli = $harga_beli; }
    function getHarga_beli() { return $this->harga_beli; }
    function setTanggal_kadaluarsa($tanggal_kadaluarsa) { $this->tanggal_kadaluarsa = $tanggal_kadaluarsa; }
    function getTanggal_kadaluarsa() { return $this->tanggal_kadaluarsa; }
    function setNo_faktur($no_faktur) { $this->no_faktur = $no_faktur; }
    function getNo_faktur() { return $this->no_faktur; }
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


    public function ajaxPermintaanMasuk()
    {   
        $requestData = $_REQUEST;
        
        $page = $requestData['start'];
        $limitItemPage = $requestData['length'];
        $data = array();
        
        $query =
        "SELECT
        permintaan_stok.nomor_permintaan,
        permintaan_stok.dari_unit_id,
        unit.nama_unit,
        permintaan_stok.tanggal_permintaan
        FROM
        permintaan_stok
        INNER JOIN unit ON permintaan_stok.dari_unit_id = unit.unit_id
        WHERE
        permintaan_stok.`status` = 'belum_dilayani'
        GROUP BY
        permintaan_stok.nomor_permintaan
        ORDER BY
        permintaan_stok.tanggal_permintaan ASC
        LIMIT $page, $limitItemPage";
        
        $sql = $this->conn->query("SELECT COUNT(*) FROM (SELECT
        permintaan_stok.nomor_permintaan,
        permintaan_stok.dari_unit_id,
        unit.nama_unit,
        permintaan_stok.tanggal_permintaan
        FROM
        permintaan_stok
        INNER JOIN unit ON permintaan_stok.dari_unit_id = unit.unit_id
        WHERE
        permintaan_stok.`status` = 'belum_dilayani'
        GROUP BY
        permintaan_stok.nomor_permintaan
        ORDER BY
        permintaan_stok.tanggal_permintaan ASC) AS notifikasi");

        if( !empty($requestData['search']['value']) ) {
            $query =
            "SELECT
            permintaan_stok.nomor_permintaan,
            permintaan_stok.dari_unit_id,
            unit.nama_unit,
            permintaan_stok.tanggal_permintaan
            FROM
            permintaan_stok
            INNER JOIN unit ON permintaan_stok.dari_unit_id = unit.unit_id
            WHERE
            permintaan_stok.`status` = 'belum_dilayani'
		    AND permintaan_stok.nomor_permintaan LIKE '%".$requestData['search']['value']."%'
			GROUP BY
            permintaan_stok.nomor_permintaan
            ORDER BY
            permintaan_stok.tanggal_permintaan ASC
            LIMIT $page, $limitItemPage";

            $sql = $this->conn->query("SELECT COUNT(*) FROM (SELECT
            permintaan_stok.nomor_permintaan,
            permintaan_stok.dari_unit_id,
            unit.nama_unit,
            permintaan_stok.tanggal_permintaan
            FROM
            permintaan_stok
            INNER JOIN unit ON permintaan_stok.dari_unit_id = unit.unit_id
            WHERE
            permintaan_stok.`status` = 'belum_dilayani'
            AND permintaan_stok.nomor_permintaan LIKE '%".$requestData['search']['value']."%'
            GROUP BY
            permintaan_stok.nomor_permintaan
            ORDER BY
            permintaan_stok.tanggal_permintaan ASC) AS notifikasi");
            }
        
        $result = $this->conn->query($query);

        while ($row = mysqli_fetch_assoc($result)) {
            $nestedData = array();
            $nomorPermintaan = $row['nomor_permintaan'];

            $nestedData[] = $nomorPermintaan;
            $nestedData[] = $row['nama_unit'];
            $nestedData[] = $row['tanggal_permintaan'];
            $nestedData[] = "<td><a href='".base_url("farmasi/permintaan/detil/3/$nomorPermintaan")."' ><button type='button' class='btn btn-primary btn-md' id='buttonPindahUnit'>Layani</button></td>";
            $data[] = $nestedData;
        }
        
        
        $row = $sql->fetch_row();
        $count = $row[0];
        $this->conn->close();
        $totalData = $count;
        $datajson = array("draw" => intval( $requestData['draw'] ), "recordsTotal"=>$totalData, "recordsFiltered"=>$totalData, "data"=>$data);
        echo json_encode($datajson);
    }

    public function ajaxStokKeluar($unit_id)
    {   
        $requestData = $_REQUEST;
        $page = $requestData['start'];
        $limitItemPage = $requestData['length'];
        $data = array();
        
        $query =
        "SELECT
        barang.nama_barang,
        pengeluaran_barang.jumlah_pengeluaran,
        pengeluaran_barang.tanggal_keluar,
        unit.nama_unit
        FROM
        pengeluaran_barang
        INNER JOIN barang ON pengeluaran_barang.barang_id = barang.barang_id
        INNER JOIN unit ON unit.unit_id = pengeluaran_barang.untuk_unit_id
        WHERE
        pengeluaran_barang.tanggal_keluar BETWEEN DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 00:00:00') 
        AND DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 23:59:59') 
        AND pengeluaran_barang.dari_unit_id = $unit_id
        ORDER BY
        pengeluaran_barang.tanggal_keluar DESC
        LIMIT $page, $limitItemPage";
        
        $sql = $this->conn->query("SELECT COUNT(*) FROM pengeluaran_barang WHERE
        pengeluaran_barang.tanggal_keluar BETWEEN DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 00:00:00') 
        AND DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 23:59:59')
        AND pengeluaran_barang.dari_unit_id = $unit_id");

        if( !empty($requestData['search']['value']) ) {
            $query =
            "SELECT
            barang.nama_barang,
            pengeluaran_barang.jumlah_pengeluaran,
            pengeluaran_barang.tanggal_keluar,
            unit.nama_unit
            FROM
            pengeluaran_barang
            INNER JOIN barang ON pengeluaran_barang.barang_id = barang.barang_id
            INNER JOIN unit ON unit.unit_id = pengeluaran_barang.untuk_unit_id
            WHERE
            pengeluaran_barang.tanggal_keluar BETWEEN DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 00:00:00') 
            AND DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 23:59:59') 
            AND pengeluaran_barang.dari_unit_id = $unit_id
            AND barang.nama_barang LIKE '%".$requestData['search']['value']."%'
            ORDER BY
            pengeluaran_barang.tanggal_keluar DESC
            LIMIT $page, $limitItemPage";

            $sql = $this->conn->query("SELECT COUNT(*) FROM pengeluaran_barang 
            INNER JOIN barang ON pengeluaran_barang.barang_id = barang.barang_id
            WHERE
            pengeluaran_barang.tanggal_keluar BETWEEN DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 00:00:00') 
            AND DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 23:59:59')
            AND pengeluaran_barang.dari_unit_id = $unit_id
            AND barang.nama_barang LIKE '%".$requestData['search']['value']."%'");
            }
        
        $result = $this->conn->query($query);

        while ($row = mysqli_fetch_assoc($result)) {
            $nestedData = array();
            $rowDate=strtotime($row['tanggal_keluar']);

            $nestedData[] = $row['nama_barang'];
            $nestedData[] = $row['jumlah_pengeluaran'];
            $nestedData[] = $row['nama_unit'];
            $nestedData[] = date("H:i:s", $rowDate);
            $data[] = $nestedData;
        }
        
        
        $row = $sql->fetch_row();
        $count = $row[0];
        $totalData = $count;
        $datajson = array("draw" => intval( $requestData['draw'] ), "recordsTotal"=>$totalData, "recordsFiltered"=>$totalData, "data"=>$data);
        echo json_encode($datajson);
    }

    public function ajaxStokMasuk($unit_id)
    {   
        $requestData = $_REQUEST;
        $page = $requestData['start'];
        $limitItemPage = $requestData['length'];
        $data = array();
        
        $query =
        "SELECT
        barang.nama_barang,
        pengadaan_barang.terima_dari,
        pengadaan_barang.tanggal_masuk,
        pengadaan_barang.jumlah_barang
        FROM
        pengadaan_barang
        INNER JOIN barang ON pengadaan_barang.barang_id = barang.barang_id
        WHERE
        pengadaan_barang.tanggal_masuk BETWEEN DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 00:00:00') 
        AND DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 23:59:59') 
        AND pengadaan_barang.untuk_unit_id = $unit_id
        ORDER BY
        pengadaan_barang.tanggal_masuk DESC
        LIMIT $page, $limitItemPage";
        
        $sql = $this->conn->query("SELECT COUNT(*) FROM pengadaan_barang WHERE
        pengadaan_barang.tanggal_masuk BETWEEN DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 00:00:00') 
        AND DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 23:59:59')");

        if( !empty($requestData['search']['value']) ) {
            $query =
            "SELECT
            barang.nama_barang,
            pengadaan_barang.terima_dari,
            pengadaan_barang.tanggal_masuk,
            pengadaan_barang.jumlah_barang
            FROM
            pengadaan_barang
            INNER JOIN barang ON pengadaan_barang.barang_id = barang.barang_id
            WHERE
            pengadaan_barang.tanggal_masuk BETWEEN DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 00:00:00') 
            AND DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 23:59:59')
            AND pengadaan_barang.untuk_unit_id = $unit_id
            AND barang.nama_barang LIKE '%".$requestData['search']['value']."%'
            ORDER BY
            pengadaan_barang.tanggal_masuk DESC
            LIMIT $page, $limitItemPage";

            $sql = $this->conn->query("SELECT COUNT(*) FROM pengadaan_barang 
            INNER JOIN barang ON pengadaan_barang.barang_id = barang.barang_id
            WHERE
            pengadaan_barang.tanggal_masuk BETWEEN DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 00:00:00') 
            AND DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 23:59:59')
            AND pengadaan_barang.untuk_unit_id = $unit_id
            AND barang.nama_barang LIKE '%".$requestData['search']['value']."%'");
        }
        
        $result = $this->conn->query($query);

        while ($row = mysqli_fetch_assoc($result)) {
            $nestedData = array();
            $rowDate=strtotime($row['tanggal_masuk']);

            $nestedData[] = $row['nama_barang'];
            $nestedData[] = $row['jumlah_barang'];
            $nestedData[] = $row['terima_dari'];
            $nestedData[] = date("H:i:s", $rowDate);
            $data[] = $nestedData;
        }
        
        
        $row = $sql->fetch_row();
        $count = $row[0];
        $totalData = $count;
        $datajson = array("draw" => intval( $requestData['draw'] ), "recordsTotal"=>$totalData, "recordsFiltered"=>$totalData, "data"=>$data);
        echo json_encode($datajson);
    }

    public function getDetil($unit_id, $nomorPermintaan)
    {   
        $query =
        "SELECT
        permintaan_stok.permintaan_stok_id,
        permintaan_stok.nomor_permintaan,
        permintaan_stok.barang_id,
        permintaan_stok.dari_unit_id,
        permintaan_stok.jumlah_permintaan,
        permintaan_stok.jumlah_disetujui,
        permintaan_stok.`status`,
        permintaan_stok.tanggal_permintaan,
        IFNULL(stok.jumlah,0) AS stok_tersedia,
        barang.nama_barang,
        satuan.nama_satuan,
        grup_barang.nama_grup_barang,
        unit.nama_unit
        FROM permintaan_stok 
        LEFT JOIN stok ON permintaan_stok.barang_id = stok.barang_id AND stok.unit_id = $unit_id
        LEFT JOIN barang ON permintaan_stok.barang_id = barang.barang_id
        INNER JOIN satuan ON barang.satuan_id = satuan.satuan_id
        INNER JOIN grup_barang ON barang.grup_barang_id = grup_barang.grup_barang_id
        INNER JOIN unit ON permintaan_stok.dari_unit_id = unit.unit_id 
        WHERE permintaan_stok.nomor_permintaan = '$nomorPermintaan'";
        $result = $this->conn->query($query);

        $rows = [];
        $i=0;
        $object;
        $nestedData = array();
        $arrayData = new ArrayObject();
        while($row = mysqli_fetch_array($result))
        {   
            $object{$i} = new Gudang();
            $object{$i}->setPermintaan_stok_id($row['permintaan_stok_id']);
            $object{$i}->setNomor_permintaan($row['nomor_permintaan']);
            $object{$i}->setBarang_id($row['barang_id']);
            $object{$i}->setDari_unit_id($row['dari_unit_id']);
            $object{$i}->setJumlah_permintaan($row['jumlah_permintaan']);
            $object{$i}->setJumlah_disetujui($row['jumlah_disetujui']);
            $object{$i}->setStatus($row['status']);
            $object{$i}->setTanggal_permintaan($row['tanggal_permintaan']);
            $object{$i}->setStok_tersedia($row['stok_tersedia']);
            $object{$i}->setNama_barang($row['nama_barang']);
            $object{$i}->setNama_satuan($row['nama_satuan']);
            $object{$i}->setNama_grup_barang($row['nama_grup_barang']);
            $object{$i}->setNama_unit($row['nama_unit']);
            

            $nestedData['permintaan_stok_id'] = $object{$i}->getPermintaan_stok_id();
            $nestedData['nomor_permintaan'] = $object{$i}->getNomor_permintaan();
            $nestedData['barang_id'] = $object{$i}->getBarang_id();
            $nestedData['dari_unit_id'] = $object{$i}->getDari_unit_id();
            $nestedData['jumlah_permintaan'] = $object{$i}->getJumlah_permintaan();
            $nestedData['jumlah_disetujui'] = $object{$i}->getJumlah_disetujui();
            $nestedData['status'] = $object{$i}->getStatus();
            $nestedData['tanggal_permintaan'] = $object{$i}->getTanggal_permintaan();
            $nestedData['stok_tersedia'] = $object{$i}->getStok_tersedia();
            $nestedData['nama_barang'] = $object{$i}->getNama_barang();
            $nestedData['nama_satuan'] = $object{$i}->getNama_satuan();
            $nestedData['nama_grup_barang'] = $object{$i}->getNama_grup_barang();
            $nestedData['nama_unit'] = $object{$i}->getNama_unit();
            $arrayData[] = $nestedData;
            $object{$i}->conn->close();

            $i++;
        } 
        $arrayData->num_rows = $i;

        $data = array("data"=>$arrayData);
        
        return $data;
    }

    public function prosesPermintaan($id, $idbarang, $unit_id, $untuk_unit_id, $jumlah)
    { 
        $query =
        "UPDATE `permintaan_stok` SET `jumlah_disetujui` = '$jumlah', `status` = 'sudah_dilayani' WHERE `permintaan_stok`.`permintaan_stok_id` = $id;";
        $result = $this->conn->query($query);
        
        $sqlCheckTableExist = $this->conn->query("SELECT COUNT(*) FROM stok WHERE barang_id = '$idbarang' AND unit_id = '$untuk_unit_id'");
        $isExist = $sqlCheckTableExist->fetch_row();
        if ($isExist[0]==0){
             if($jumlah>=0){
                $query2 =
                "INSERT INTO `stok` (`barang_id`, `unit_id`, `jumlah`) VALUES ('$idbarang', '$untuk_unit_id', '$jumlah');";
                $result = $this->conn->query($query2);
             }
                $query1 =
                "UPDATE `stok` SET `jumlah` = jumlah-$jumlah WHERE `stok`.`barang_id` = $idbarang AND `stok`.`unit_id` = $unit_id;";
                $result = $this->conn->query($query1);
            }else{
                $query1 =
                "UPDATE `stok` SET `jumlah` = jumlah-$jumlah WHERE `stok`.`barang_id` = $idbarang AND `stok`.`unit_id` = $unit_id; ";
                $result = $this->conn->query($query1);
                $query2 =
                "UPDATE `stok` SET `jumlah` = jumlah+$jumlah WHERE `stok`.`barang_id` = $idbarang AND `stok`.`unit_id` = $untuk_unit_id; ";
                $result = $this->conn->query($query2);
        }
        if($jumlah>0){
            $query3 =
            "INSERT INTO `pengeluaran_barang` (`untuk_unit_id`, `dari_unit_id`, `barang_id`, `jumlah_pengeluaran`) VALUES 
            ('$untuk_unit_id', '$unit_id', '$idbarang', '$jumlah')";
            $result = $this->conn->query($query3);
        }
        return $result;
    }

    public function prosesPengeluaranStok($unit_id)
    {
        $totalTabel = $_POST['trTotal'];
        
        $i=1;
        if($totalTabel>0){
            $tabel_barang_id        = $_POST['tabel_barang_id'];
            $tabel_nomor_batch      = $_POST['tabel_nomor_batch'];
            $tabel_jumlah           = $_POST['tabel_jumlah'];
            $tabel_untuk_unit_id    = $_POST['tabel_untuk_unit_id'];
            $tabel_nama_penerima    = $_POST['tabel_nama_penerima'];

            foreach($tabel_barang_id as $a => $b){

                $barang_id      = $tabel_barang_id[$a];
                $nomor_batch    = $tabel_nomor_batch[$a];
                $jumlah         = $tabel_jumlah[$a];
                $untuk_unit_id  = $tabel_untuk_unit_id[$a];
                $nama_penerima  = $tabel_nama_penerima[$a];
                
                /*
                echo "Data ke: ".$i.": <br>";
                echo "Idbarang: ". $barang_id.", ";
                echo "nomor batch: ". $nomor_batch.", ";
                echo "tgl kadaluarasa: ". $kadaluarsa.", ";
                echo "jumlah: ". $jumlah.", ";
                echo "untuk unit id: ". $untuk_unit_id.", <br>";
                */
                $sqlCheckTableExist = $this->conn->query("SELECT COUNT(*) FROM stok WHERE barang_id = '$barang_id' AND unit_id = '$untuk_unit_id'");
                $isExist = $sqlCheckTableExist->fetch_row();

                if ($isExist[0]==0){
                    if($jumlah>0){
                        $query2 =
                        "INSERT INTO `stok` (`barang_id`, `unit_id`, `jumlah`) VALUES ('$barang_id', '$untuk_unit_id', '$jumlah');";
                        $result = $this->conn->query($query2);
                    }
                        $query1 =
                        "UPDATE `stok` SET `jumlah` = jumlah-$jumlah WHERE `stok`.`barang_id` = $barang_id AND `stok`.`unit_id` = $unit_id;";
                        $result = $this->conn->query($query1);

                    }else{
                        $query1 =
                        "UPDATE `stok` SET `jumlah` = jumlah-$jumlah WHERE `stok`.`barang_id` = $barang_id AND `stok`.`unit_id` = $unit_id; ";
                        $result = $this->conn->query($query1);

                        $query2 =
                        "UPDATE `stok` SET `jumlah` = jumlah+$jumlah WHERE `stok`.`barang_id` = $barang_id AND `stok`.`unit_id` = $untuk_unit_id; ";
                        $result = $this->conn->query($query2);
                }
                if($jumlah>0){
                    $query =
                    "INSERT INTO `pengeluaran_barang` (`untuk_unit_id`, `dari_unit_id`, `barang_id`, `no_batch` ,`jumlah_pengeluaran`, `nama_penerima`) VALUES 
                    ('$untuk_unit_id', '$unit_id', '$barang_id', '$nomor_batch', '$jumlah','$nama_penerima')";
                    
                    $result = $this->conn->query($query);
                }
                $i++;
            }
            $this->conn->close();
            if($result){
                return true;
            }else{
                return 'error';
            }
        }else{
            return false;
        }
    }

    public function prosesPengadaanStok($unit_id){
        $totalTabel = $_POST['trTotal'];
        $i=1;

        if($totalTabel>0){
            $tabel_barang_id            = $_POST['tabel_barang_id'];
            $tabel_nomor_batch          = $_POST['tabel_nomor_batch'];
            $tabel_jumlah               = $_POST['tabel_jumlah'];
            $tabel_harga_beli           = $_POST['tabel_harga_beli'];
            $tabel_harga_jual           = $_POST['tabel_harga_jual'];
            $tabel_tanggal_kadaluarsa   = $_POST['tabel_tanggal_kadaluarsa'];
            $tabel_jenis_penerimaan_id  = $_POST['tabel_jenis_penerimaan_id'];
            $tabel_nomor_batch          = $_POST['tabel_nomor_batch'];
            $tabel_terima_dari          = $_POST['tabel_terima_dari'];
            $tabel_no_faktur            = $_POST['tabel_no_faktur'];
            $tabel_tanggal_faktur       = $_POST['tabel_tanggal_faktur'];
            $tabel_keterangan           = $_POST['tabel_keterangan'];
            
            foreach($tabel_barang_id as $a => $b){
                $terima_dari            = $tabel_terima_dari[$a];
                $jenis_penerimaan_id    = $tabel_jenis_penerimaan_id[$a];
                $no_faktur              = $tabel_no_faktur[$a];
                $tanggal_faktur         = $tabel_tanggal_faktur[$a];
                $keterangan             = $tabel_keterangan[$a];
                $untuk_unit_id          = $unit_id;
                $barang_id              = $tabel_barang_id[$a];
                $nomor_batch            = $tabel_nomor_batch[$a];
                $tanggal_kadaluarsa     = $tabel_tanggal_kadaluarsa[$a];
                $harga_jual             = $tabel_harga_jual[$a];
                $harga_beli             = $tabel_harga_beli[$a];
                $jumlah_barang          = $tabel_jumlah[$a];

                $sqlCheckTableExist = $this->conn->query("SELECT COUNT(*) FROM stok WHERE barang_id = '$barang_id' AND unit_id = '$untuk_unit_id'");
                $isExist = $sqlCheckTableExist->fetch_row();
                //$isExist[0]==0 artinya row tidak ada 

                if ($isExist[0]==0){ 
                        if($jumlah_barang>0){
                            $query1 =
                            "INSERT INTO `stok` (`barang_id`, `unit_id`, `jumlah`) VALUES ('$barang_id', '$untuk_unit_id', '$jumlah_barang');";
                            $result = $this->conn->query($query1);
                        }
                    }else{
                        $query2 =
                        "UPDATE `stok` SET `jumlah` = jumlah+$jumlah_barang WHERE `stok`.`barang_id` = $barang_id AND `stok`.`unit_id` = $untuk_unit_id; ";
                        $result = $this->conn->query($query2);
                }
                
                if($jumlah_barang>0){
                    $query =
                    "INSERT INTO `pengadaan_barang` (`terima_dari`, `jenis_penerimaan_id`, `no_faktur`, `tanggal_faktur`, `keterangan`, 
                    `untuk_unit_id`, `barang_id`, `no_batch`, `tanggal_kadaluarsa`, `harga_jual`, `harga_beli`, `jumlah_barang`) 
                    VALUES ('$terima_dari', '$jenis_penerimaan_id', '$no_faktur', '$tanggal_faktur', '$keterangan', '$untuk_unit_id', '$barang_id', 
                    '$nomor_batch', '$tanggal_kadaluarsa', '$harga_jual', '$harga_beli', '$jumlah_barang');";
                    
                    $result = $this->conn->query($query);
                }
                $i++;
            }
            $this->conn->close();

            if($result){
                return true;
            }else{
                return 'error';
            }
        }else{
            return false;
        }
    }

    public function riwayatPengeluaranStok($unit_id, $sort, $page, $limitItemPage)
    {   
        $page=($page*$limitItemPage)-$limitItemPage;
        
        if (isset($_POST['tanggalAwal'])){ $tanggalAwal = $_POST['tanggalAwal']; $tanggalAwal = $tanggalAwal." 00:00:00"; $_SESSION["tanggalAwal"] = $tanggalAwal;}
        if (isset($_POST['tanggalAkhir'])){ $tanggalAkhir = $_POST['tanggalAkhir']; $tanggalAkhir = $tanggalAkhir." 23:59:59"; $_SESSION["tanggalAkhir"] = $tanggalAkhir; }
        if (isset($_POST['search'])){ $search = $_POST['search'];  $_SESSION["searchFarmasi"] = $search;} 
        if (isset($_SESSION["tanggalAwal"])){ $tanggalAwal =  $_SESSION["tanggalAwal"];}
        if (isset($_SESSION["tanggalAkhir"])){ $tanggalAkhir =  $_SESSION["tanggalAkhir"];}
        if (isset($_SESSION["searchFarmasi"])){ $search =  $_SESSION["searchFarmasi"];}
        

        //$tanggalAwal = "2017-06-10 13:42:03";
        //$tanggalAkhir = "2017-06-11 13:42:03";

        if(!isset($tanggalAwal) && !isset($tanggalAkhir)){
            //$sqlRangeDate = "AND pengeluaran_barang.tanggal_keluar BETWEEN DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 00:00:00') 
            //AND DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 23:59:59')";
            //BETWEEN DATE_SUB(NOW(), INTERVAL 1 MONTH) AND   #contoh penggunaan bulanan
            //        DATE_SUB(NOW(), INTERVAL 2 MONTH)
            $sqlRangeDate = "";
        }else if(isset($tanggalAwal) && isset($tanggalAkhir)){
            $sqlRangeDate = "AND pengeluaran_barang.tanggal_keluar BETWEEN '$tanggalAwal' AND '$tanggalAkhir' ";
        }else{
            $sqlRangeDate = "";
        }

        if(isset($search)){
            $sqlSearch = "AND barang.nama_barang LIKE '%$search%' ";
        }else{
            $sqlSearch = "";
        }

        $data = array();
        
        $query =
        "SELECT
        barang.nama_barang,
        pengeluaran_barang.jumlah_pengeluaran,
        pengeluaran_barang.tanggal_keluar,
        unit.nama_unit,
        grup_barang.nama_grup_barang,
        pengeluaran_barang.no_batch,
        pengeluaran_barang.nama_penerima
        FROM
        pengeluaran_barang
        INNER JOIN barang ON pengeluaran_barang.barang_id = barang.barang_id
        INNER JOIN unit ON unit.unit_id = pengeluaran_barang.untuk_unit_id
        INNER JOIN grup_barang ON barang.grup_barang_id = grup_barang.grup_barang_id
        WHERE
        pengeluaran_barang.dari_unit_id = $unit_id $sqlRangeDate $sqlSearch
        ORDER BY
        pengeluaran_barang.tanggal_keluar DESC
        LIMIT $page, $limitItemPage";
        $result = $this->conn->query($query);

        $rows = [];
        $i=0;
        $object;
        $nestedData = array();
        $arrayData = new ArrayObject();
        while($row = mysqli_fetch_array($result))
        {   
            $object{$i} = new Gudang();
            $object{$i}->setNama_barang($row['nama_barang']);
            $object{$i}->setJumlah_pengeluaran($row['jumlah_pengeluaran']);
            $object{$i}->setTanggal_keluar($row['tanggal_keluar']);
            $object{$i}->setNama_unit($row['nama_unit']);
            $object{$i}->setNama_grup_barang($row['nama_grup_barang']);
            $object{$i}->setNo_batch($row['no_batch']);
            $object{$i}->setNama_penerima($row['nama_penerima']);
            
            $nestedData['nama_barang'] = $object{$i}->getNama_barang();
            $nestedData['jumlah_pengeluaran'] = $object{$i}->getJumlah_pengeluaran();
            $nestedData['tanggal_keluar'] = $object{$i}->getTanggal_keluar();
            $nestedData['nama_unit'] = $object{$i}->getNama_unit();
            $nestedData['nama_grup_barang'] = $object{$i}->getNama_grup_barang();
            $nestedData['no_batch'] = $object{$i}->getNo_batch();
            $nestedData['nama_penerima'] = $object{$i}->getNama_penerima();
            $arrayData[] = $nestedData;
            $object{$i}->conn->close();

            $i++;
        } 
        $arrayData->num_rows = $i;
        
        $sql = $this->conn->query("SELECT COUNT(*) FROM pengeluaran_barang INNER JOIN barang ON pengeluaran_barang.barang_id = barang.barang_id WHERE
        pengeluaran_barang.dari_unit_id = $unit_id $sqlRangeDate $sqlSearch ");

        $row = $sql->fetch_row();
        $count = $row[0];
        $totalData = $count;
        $totalPages = ceil($totalData/$limitItemPage);
        $data = array("data"=>$arrayData, "currentPage"=>$page/$limitItemPage+1, "totalPages"=>$totalPages, "totalData"=>$totalData);
        return $data;
    }

    public function riwayatPengadaanStok($unit_id, $sort, $page, $limitItemPage)
    {   
        $page=($page*$limitItemPage)-$limitItemPage;
        
        if (isset($_POST['tanggalAwal'])){ $tanggalAwal = $_POST['tanggalAwal']; $tanggalAwal = $tanggalAwal." 00:00:00"; $_SESSION["tanggalAwal"] = $tanggalAwal;}
        if (isset($_POST['tanggalAkhir'])){ $tanggalAkhir = $_POST['tanggalAkhir']; $tanggalAkhir = $tanggalAkhir." 23:59:59"; $_SESSION["tanggalAkhir"] = $tanggalAkhir; }
        if (isset($_POST['search'])){ $search = $_POST['search'];  $_SESSION["searchFarmasi"] = $search;} 
        if (isset($_SESSION["tanggalAwal"])){ $tanggalAwal =  $_SESSION["tanggalAwal"];}
        if (isset($_SESSION["tanggalAkhir"])){ $tanggalAkhir =  $_SESSION["tanggalAkhir"];}
        if (isset($_SESSION["searchFarmasi"])){ $search =  $_SESSION["searchFarmasi"];}
        
        if(!isset($tanggalAwal) && !isset($tanggalAkhir)){
            $sqlRangeDate = "";
        }else if(isset($tanggalAwal) && isset($tanggalAkhir)){
            $sqlRangeDate = "AND pengadaan_barang.tanggal_masuk BETWEEN '$tanggalAwal' AND '$tanggalAkhir' ";
        }
        else if(!isset($tanggalAwal) || !isset($tanggalAkhir)){
            $sqlRangeDate = "";
        }else{
            $sqlRangeDate = "";
        }

        if(isset($search)){
            $sqlSearch = "AND barang.nama_barang LIKE '%$search%' ";
        }else{
            $sqlSearch = "";
        }

        $data = array();
        
        $query =
        "SELECT
        barang.nama_barang,
        satuan.nama_satuan,
        pengadaan_barang.jumlah_barang,
        pengadaan_barang.terima_dari,
        jenis_penerimaan.nama_jenis_penerimaan,
        pengadaan_barang.tanggal_masuk,
        pengadaan_barang.harga_jual,
        pengadaan_barang.harga_beli,
        pengadaan_barang.tanggal_kadaluarsa,
        pengadaan_barang.no_batch,
        pengadaan_barang.no_faktur,
        pengadaan_barang.barang_id
        FROM
        pengadaan_barang
        INNER JOIN barang ON pengadaan_barang.barang_id = barang.barang_id
        INNER JOIN satuan ON barang.satuan_id = satuan.satuan_id
        INNER JOIN jenis_penerimaan ON pengadaan_barang.jenis_penerimaan_id = jenis_penerimaan.jenis_penerimaan_id
        WHERE
        pengadaan_barang.untuk_unit_id = $unit_id $sqlRangeDate $sqlSearch
        ORDER BY
        pengadaan_barang.tanggal_masuk DESC
        LIMIT $page, $limitItemPage";
        $result = $this->conn->query($query);

        $rows = [];
        $i=0;
        $object;
        $nestedData = array();
        $arrayData = new ArrayObject();
        while($row = mysqli_fetch_array($result))
        {   
            $object{$i} = new Gudang();
            $object{$i}->setNama_barang($row['nama_barang']);
            $object{$i}->setNama_satuan($row['nama_satuan']);
            $object{$i}->setJumlah_barang($row['jumlah_barang']);
            $object{$i}->setTerima_dari($row['terima_dari']);
            $object{$i}->setNama_jenis_penerimaan($row['nama_jenis_penerimaan']);
            $object{$i}->setTanggal_masuk($row['tanggal_masuk']);
            $object{$i}->setHarga_jual($row['harga_jual']);
            $object{$i}->setHarga_beli($row['harga_beli']);
            $object{$i}->setTanggal_kadaluarsa($row['tanggal_kadaluarsa']);
            $object{$i}->setNo_batch($row['no_batch']);
            $object{$i}->setNo_faktur($row['no_faktur']);
            $object{$i}->setBarang_id($row['barang_id']);
            
            $nestedData['nama_barang'] = $object{$i}->getNama_barang();
            $nestedData['nama_satuan'] = $object{$i}->getNama_satuan();
            $nestedData['jumlah_barang'] = $object{$i}->getJumlah_barang();
            $nestedData['terima_dari'] = $object{$i}->getTerima_dari();
            $nestedData['nama_jenis_penerimaan'] = $object{$i}->getNama_jenis_penerimaan();
            $nestedData['tanggal_masuk'] = $object{$i}->getTanggal_masuk();
            $nestedData['harga_jual'] = $object{$i}->getHarga_jual();
            $nestedData['harga_beli'] = $object{$i}->getHarga_beli();
            $nestedData['tanggal_kadaluarsa'] = $object{$i}->getTanggal_kadaluarsa();
            $nestedData['no_batch'] = $object{$i}->getNo_batch();
            $nestedData['no_faktur'] = $object{$i}->getNo_faktur();
            $nestedData['barang_id'] = $object{$i}->getBarang_id();
            $arrayData[] = $nestedData;
            $object{$i}->conn->close();

            $i++;
        } 
        $arrayData->num_rows = $i;
        
        $sql = $this->conn->query("SELECT COUNT(*) FROM pengadaan_barang INNER JOIN barang ON pengadaan_barang.barang_id = barang.barang_id WHERE
        pengadaan_barang.untuk_unit_id = $unit_id $sqlRangeDate $sqlSearch ");

        $row = $sql->fetch_row();
        $count = $row[0];
        $totalData = $count;
        $totalPages = ceil($totalData/$limitItemPage);
        $data = array("data"=>$arrayData, "currentPage"=>$page/$limitItemPage+1, "totalPages"=>$totalPages, "totalData"=>$totalData);
        return $data;
    }

    public function riwayatPermintaanStok($sort, $page, $limitItemPage, $status)
    {   
        $page=($page*$limitItemPage)-$limitItemPage;
        
        if (isset($_POST['tanggalAwal'])){ $tanggalAwal = $_POST['tanggalAwal']; $tanggalAwal = $tanggalAwal." 00:00:00"; $_SESSION["tanggalAwal"] = $tanggalAwal;}
        if (isset($_POST['tanggalAkhir'])){ $tanggalAkhir = $_POST['tanggalAkhir']; $tanggalAkhir = $tanggalAkhir." 23:59:59"; $_SESSION["tanggalAkhir"] = $tanggalAkhir; }
        if (isset($_POST['search'])){ $search = $_POST['search'];  $_SESSION["searchFarmasi"] = $search;} 
        if (isset($_SESSION["tanggalAwal"])){ $tanggalAwal =  $_SESSION["tanggalAwal"];}
        if (isset($_SESSION["tanggalAkhir"])){ $tanggalAkhir =  $_SESSION["tanggalAkhir"];}
        if (isset($_SESSION["searchFarmasi"])){ $search =  $_SESSION["searchFarmasi"];}
        
        if(!isset($tanggalAwal) && !isset($tanggalAkhir)){
            $sqlRangeDate = "";
        }else if(isset($tanggalAwal) && isset($tanggalAkhir)){
            $sqlRangeDate = "AND permintaan_stok.tanggal_permintaan BETWEEN '$tanggalAwal' AND '$tanggalAkhir' ";
        }
        else if(!isset($tanggalAwal) || !isset($tanggalAkhir)){
            $sqlRangeDate = "";
        }else{
            $sqlRangeDate = "";
        }

        if(isset($search)){
            $sqlSearch = $search;
        }else{
            $sqlSearch = "";
        }

        $data = array();

        $query =
        "SELECT
        permintaan_stok.nomor_permintaan,
        permintaan_stok.`status`,
        permintaan_stok.tanggal_permintaan,
        unit.nama_unit
        FROM
        permintaan_stok
        INNER JOIN unit ON permintaan_stok.dari_unit_id = unit.unit_id
        WHERE
        permintaan_stok.nomor_permintaan LIKE '%$sqlSearch%' 
        AND permintaan_stok.status LIKE '%$status%'
        $sqlRangeDate 
        GROUP BY
        permintaan_stok.nomor_permintaan
        ORDER BY
        permintaan_stok.tanggal_permintaan DESC
        LIMIT $page, $limitItemPage";
        $result = $this->conn->query($query);

        $rows = [];
        $i=0;
        $object;
        $nestedData = array();
        $arrayData = new ArrayObject();
        while($row = mysqli_fetch_array($result))
        {   
            $object{$i} = new Gudang();
            $object{$i}->setNomor_permintaan($row['nomor_permintaan']);
            $object{$i}->setStatus($row['status']);
            $object{$i}->setTanggal_permintaan($row['tanggal_permintaan']);
            $object{$i}->setNama_unit($row['nama_unit']);
            
            $nestedData['nomor_permintaan'] = $object{$i}->getNomor_permintaan();
            $nestedData['status'] = $object{$i}->getStatus();
            $nestedData['tanggal_permintaan'] = $object{$i}->getTanggal_permintaan();
            $nestedData['nama_unit'] = $object{$i}->getNama_unit();
            $arrayData[] = $nestedData;
            $object{$i}->conn->close();

            $i++;
        } 
        $arrayData->num_rows = $i;
        
        $sql = $this->conn->query("Select Count(*) From(SELECT COUNT(*) FROM permintaan_stok WHERE
        permintaan_stok.nomor_permintaan LIKE '%$sqlSearch%' AND permintaan_stok.status LIKE '%$status%' $sqlRangeDate 
        GROUP BY permintaan_stok.nomor_permintaan ) As total ");

        $row = $sql->fetch_row();
        $count = $row[0];
        $totalData = $count;
        $totalPages = ceil($totalData/$limitItemPage);
        $data = array("data"=>$arrayData, "currentPage"=>$page/$limitItemPage+1, "totalPages"=>$totalPages, "totalData"=>$totalData);
        return $data;
    }

    public function infoStok($unit_id, $sort, $page, $limitItemPage)
    {   
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
        $result = $this->conn->query($query);
        
        $sql = $this->conn->query("SELECT COUNT(*) FROM stok INNER JOIN barang ON barang.barang_id = stok.barang_id WHERE stok.unit_id = $unit_id  $sqlSearch");
        $row = $sql->fetch_row();
        $count = $row[0];
        $totalData = $count;
        $totalPages = ceil($totalData/$limitItemPage);
        $data = array("data"=>$result, "currentPage"=>$page/$limitItemPage+1, "totalPages"=>$totalPages, "totalData"=>$totalData);
        return $data;
    }

    public function printInfoStok($unit_id)
    {   
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
        $result = $this->conn->query($query);
        
        $data = array("data"=>$result);
        return $data;
    }

    public function getLaporanRange($range, $sort, $page, $limitItemPage, $unit_id)
    {   
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
        $result = $this->conn->query($query);
        $sql = $this->conn->query("SELECT Count(*) From(SELECT pengeluaran_barang.tanggal_keluar AS range_waktu FROM pengeluaran_barang WHERE pengeluaran_barang.dari_unit_id = $unit_id 
        GROUP BY $sqlRangeWaktu) As total");
        $row = $sql->fetch_row();
        $count = $row[0];
        $totalData = $count;
        $totalPages = ceil($totalData/$limitItemPage);
        $data = array("data"=>$result, "currentPage"=>$page/$limitItemPage+1, "totalPages"=>$totalPages, "totalData"=>$totalData);
        return $data;
    }

    public function getLaporan($range, $month, $year, $unit_id)
    {  
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
        $result = $this->conn->query($query);
        
        $rows = [];
        $i=0;
        $object;
        $nestedData = array();
        $arrayData = new ArrayObject();
        while($row = mysqli_fetch_array($result))
        {   
            $object{$i} = new Gudang();
            $object{$i}->setBarang_id($row['barang_id']);
            $object{$i}->setNama_barang($row['nama_barang']);
            $object{$i}->setNama_satuan($row['nama_satuan']);
            $object{$i}->setHarga_jual($row['harga_jual']);
            $object{$i}->setJumlah_barang_keluar($row['jumlah_barang_keluar']);
            $object{$i}->setJumlah_pengeluaran_in_rp($row['jumlah_pengeluaran_in_rp']);
            $object{$i}->setJumlah_barang_masuk($row['jumlah_barang_masuk']);
            $object{$i}->setJumlah_pengadaan_in_rp($row['jumlah_pengadaan_in_rp']);
            $object{$i}->setStok_sekarang($row['stok_sekarang']);
            $object{$i}->setJumlah_stok_in_rp($row['jumlah_stok_in_rp']);
            
            $nestedData['barang_id'] = $object{$i}->getBarang_id();
            $nestedData['nama_barang'] = $object{$i}->getNama_barang();
            $nestedData['nama_satuan'] = $object{$i}->getNama_satuan();
            $nestedData['harga_jual'] = $object{$i}->getHarga_jual();
            $nestedData['jumlah_barang_keluar'] = $object{$i}->getJumlah_barang_keluar();
            $nestedData['jumlah_pengeluaran_in_rp'] = $object{$i}->getJumlah_pengeluaran_in_rp();
            $nestedData['jumlah_barang_masuk'] = $object{$i}->getJumlah_barang_masuk();
            $nestedData['jumlah_pengadaan_in_rp'] = $object{$i}->getJumlah_pengadaan_in_rp();
            $nestedData['stok_sekarang'] = $object{$i}->getStok_sekarang();
            $nestedData['jumlah_stok_in_rp'] = $object{$i}->getJumlah_stok_in_rp();
            $arrayData[] = $nestedData;
            $object{$i}->conn->close();

            $i++;
        } 
        $arrayData->num_rows = $i;

        $data = array("data"=>$arrayData);
        return $data;
    }
    
}
?>