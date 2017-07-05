<?php
require_once CLASSES_DIR  . 'dbconnection.php';
require_once CLASSES_DIR  . 'barang.php';
require_once CLASSES_DIR  . 'satuan.php';
require_once CLASSES_DIR  . 'jenispenerimaan.php';

class PengadaanBarang{
    private $pengadaan_barang_id;
    private $terima_dari;
    private $no_faktur;
    private $tanggal_faktur;
    private $keterangan;
    private $no_batch;
    private $tanggal_kadaluarsa;
    private $harga_jual;
    private $harga_beli;
    private $jumlah_barang;
    private $tanggal_masuk;

    function setPengadaan_barang_id($pengadaan_barang_id) { $this->pengadaan_barang_id = $pengadaan_barang_id; }
    function getPengadaan_barang_id() { return $this->pengadaan_barang_id; }
    function setTerima_dari($terima_dari) { $this->terima_dari = $terima_dari; }
    function getTerima_dari() { return $this->terima_dari; }
    function setNo_faktur($no_faktur) { $this->no_faktur = $no_faktur; }
    function getNo_faktur() { return $this->no_faktur; }
    function setTanggal_faktur($tanggal_faktur) { $this->tanggal_faktur = $tanggal_faktur; }
    function getTanggal_faktur() { return $this->tanggal_faktur; }
    function setKeterangan($keterangan) { $this->keterangan = $keterangan; }
    function getKeterangan() { return $this->keterangan; }
    function setNo_batch($no_batch) { $this->no_batch = $no_batch; }
    function getNo_batch() { return $this->no_batch; }
    function setTanggal_kadaluarsa($tanggal_kadaluarsa) { $this->tanggal_kadaluarsa = $tanggal_kadaluarsa; }
    function getTanggal_kadaluarsa() { return $this->tanggal_kadaluarsa; }
    function setHarga_jual($harga_jual) { $this->harga_jual = $harga_jual; }
    function getHarga_jual() { return $this->harga_jual; }
    function setHarga_beli($harga_beli) { $this->harga_beli = $harga_beli; }
    function getHarga_beli() { return $this->harga_beli; }
    function setJumlah_barang($jumlah_barang) { $this->jumlah_barang = $jumlah_barang; }
    function getJumlah_barang() { return $this->jumlah_barang; }
    function setTanggal_masuk($tanggal_masuk) { $this->tanggal_masuk = $tanggal_masuk; }
    function getTanggal_masuk() { return $this->tanggal_masuk; }

    
    public function ajaxStokMasuk($unit_id)
    {   
        $db = new DB();
        $conn = $db->connect();
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
        
        $sql = $conn->query("SELECT COUNT(*) FROM pengadaan_barang WHERE
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

            $sql = $conn->query("SELECT COUNT(*) FROM pengadaan_barang 
            INNER JOIN barang ON pengadaan_barang.barang_id = barang.barang_id
            WHERE
            pengadaan_barang.tanggal_masuk BETWEEN DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 00:00:00') 
            AND DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 23:59:59')
            AND pengadaan_barang.untuk_unit_id = $unit_id
            AND barang.nama_barang LIKE '%".$requestData['search']['value']."%'");
        }
        
        $result = $conn->query($query);

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
        $conn->close();
        $datajson = array("draw" => intval( $requestData['draw'] ), "recordsTotal"=>$totalData, "recordsFiltered"=>$totalData, "data"=>$data);
        echo json_encode($datajson);
    }

    public function prosesPengadaanStok($unit_id){
        $totalTabel = $_POST['trTotal'];
        $i=1;
        $db = new DB();
        $conn = $db->connect();

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

                $sqlCheckTableExist = $conn->query("SELECT COUNT(*) FROM stok WHERE barang_id = '$barang_id' AND unit_id = '$untuk_unit_id'");
                $isExist = $sqlCheckTableExist->fetch_row();
                //$isExist[0]==0 artinya row tidak ada 

                if ($isExist[0]==0){ 
                        if($jumlah_barang>0){
                            $query1 =
                            "INSERT INTO `stok` (`barang_id`, `unit_id`, `jumlah`) VALUES ('$barang_id', '$untuk_unit_id', '$jumlah_barang');";
                            $result = $conn->query($query1);
                        }
                    }else{
                        $query2 =
                        "UPDATE `stok` SET `jumlah` = jumlah+$jumlah_barang WHERE `stok`.`barang_id` = $barang_id AND `stok`.`unit_id` = $untuk_unit_id; ";
                        $result = $conn->query($query2);
                }
                
                if($jumlah_barang>0){
                    $query =
                    "INSERT INTO `pengadaan_barang` (`terima_dari`, `jenis_penerimaan_id`, `no_faktur`, `tanggal_faktur`, `keterangan`, 
                    `untuk_unit_id`, `barang_id`, `no_batch`, `tanggal_kadaluarsa`, `harga_jual`, `harga_beli`, `jumlah_barang`) 
                    VALUES ('$terima_dari', '$jenis_penerimaan_id', '$no_faktur', '$tanggal_faktur', '$keterangan', '$untuk_unit_id', '$barang_id', 
                    '$nomor_batch', '$tanggal_kadaluarsa', '$harga_jual', '$harga_beli', '$jumlah_barang');";
                    
                    $result = $conn->query($query);
                }
                $i++;
            }
            $conn->close();

            if($result){
                return true;
            }else{
                return 'error';
            }
        }else{
            return false;
        }
    }

    public function riwayatPengadaanStok($unit_id, $sort, $page, $limitItemPage)
    {   
        $db = new DB();
        $conn = $db->connect();
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
        $result = $conn->query($query);

        $rows = [];
        $i=0;
        $object; $barang; $satuan;$jenispenerimaan;
        $nestedData = array();
        $arrayData = new ArrayObject();
        while($row = mysqli_fetch_array($result))
        {   
            $object{$i} = new PengadaanBarang();
            $barang{$i} = new Barang();
            $satuan{$i} = new Satuan();
            $jenispenerimaan{$i} = new JenisPenerimaan();
            $barang{$i}->setNama_barang($row['nama_barang']);
            $satuan{$i}->setNama_satuan($row['nama_satuan']);
            $object{$i}->setJumlah_barang($row['jumlah_barang']);
            $object{$i}->setTerima_dari($row['terima_dari']);
            $jenispenerimaan{$i}->setNama_jenis_penerimaan($row['nama_jenis_penerimaan']);
            $object{$i}->setTanggal_masuk($row['tanggal_masuk']);
            $object{$i}->setHarga_jual($row['harga_jual']);
            $object{$i}->setHarga_beli($row['harga_beli']);
            $object{$i}->setTanggal_kadaluarsa($row['tanggal_kadaluarsa']);
            $object{$i}->setNo_batch($row['no_batch']);
            $object{$i}->setNo_faktur($row['no_faktur']);
            $barang{$i}->setBarang_id($row['barang_id']);
            
            $nestedData['nama_barang'] = $barang{$i}->getNama_barang();
            $nestedData['nama_satuan'] = $satuan{$i}->getNama_satuan();
            $nestedData['jumlah_barang'] = $object{$i}->getJumlah_barang();
            $nestedData['terima_dari'] = $object{$i}->getTerima_dari();
            $nestedData['nama_jenis_penerimaan'] = $jenispenerimaan{$i}->getNama_jenis_penerimaan();
            $nestedData['tanggal_masuk'] = $object{$i}->getTanggal_masuk();
            $nestedData['harga_jual'] = $object{$i}->getHarga_jual();
            $nestedData['harga_beli'] = $object{$i}->getHarga_beli();
            $nestedData['tanggal_kadaluarsa'] = $object{$i}->getTanggal_kadaluarsa();
            $nestedData['no_batch'] = $object{$i}->getNo_batch();
            $nestedData['no_faktur'] = $object{$i}->getNo_faktur();
            $nestedData['barang_id'] = $barang{$i}->getBarang_id();
            $arrayData[] = $nestedData;

            $i++;
        } 
        $arrayData->num_rows = $i;
        
        $sql = $conn->query("SELECT COUNT(*) FROM pengadaan_barang INNER JOIN barang ON pengadaan_barang.barang_id = barang.barang_id WHERE
        pengadaan_barang.untuk_unit_id = $unit_id $sqlRangeDate $sqlSearch ");

        $row = $sql->fetch_row();
        $count = $row[0];
        $totalData = $count;
        $totalPages = ceil($totalData/$limitItemPage);
        $conn->close();
        $data = array("data"=>$arrayData, "currentPage"=>$page/$limitItemPage+1, "totalPages"=>$totalPages, "totalData"=>$totalData);
        return $data;
    }
    
}
?>