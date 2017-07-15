<?php
require_once CLASSES_DIR  . 'dbconnection.php';
require_once CLASSES_DIR  . 'unit.php';
require_once CLASSES_DIR  . 'permintaanbarang.php';

class PermintaanBarangModel extends CI_Model{
    public function __construct() {
        parent::__construct();
    }

    public function ajaxPermintaanMasuk()
    {   
        $db = new DB();
        $conn = $db->connect();
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
        
        $sql = $conn->query("SELECT COUNT(*) FROM (SELECT
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

            $sql = $conn->query("SELECT COUNT(*) FROM (SELECT
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
        
        $result = $conn->query($query);

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
        $totalData = $count;
        $conn->close();
        $datajson = array("draw" => intval( $requestData['draw'] ), "recordsTotal"=>$totalData, "recordsFiltered"=>$totalData, "data"=>$data);
        echo json_encode($datajson);
    }

    public function getDetil($unit_id, $nomorPermintaan)
    {   
        $db = new DB();
        $conn = $db->connect();
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
        $result = $conn->query($query);

        $rows = [];
        $i=0;
        $object; $barang; $unit; $grupbarang; $satuan;
        $nestedData = array();
        $arrayData = new ArrayObject();
        while($row = mysqli_fetch_array($result))
        {   
            $object{$i} = new PermintaanBarang();

            $object{$i}->setPermintaan_stok_id($row['permintaan_stok_id']);
            $object{$i}->setNomor_permintaan($row['nomor_permintaan']);
            $object{$i}->setBarang_id($row['barang_id']);
            $object{$i}->setJumlah_permintaan($row['jumlah_permintaan']);
            $object{$i}->setJumlah_disetujui($row['jumlah_disetujui']);
            $object{$i}->setStatus($row['status']);
            $object{$i}->setTanggal_permintaan($row['tanggal_permintaan']);
            $object{$i}->setJumlah_stok($row['stok_tersedia']);
            $object{$i}->setNama_barang($row['nama_barang']);
            $satuan = $object{$i}->satuan(null, $row['nama_satuan']);
            $grupbarang = $object{$i}->grupBarang(null, $row['nama_grup_barang']);
            $unit{$i} = new Unit($row['dari_unit_id'], $row['nama_unit']);

            $nestedData['permintaan_stok_id'] = $object{$i}->getPermintaan_stok_id();
            $nestedData['nomor_permintaan'] = $object{$i}->getNomor_permintaan();
            $nestedData['barang_id'] = $object{$i}->getBarang_id();
            $nestedData['dari_unit_id'] = $unit{$i}->getUnit_id();
            $nestedData['jumlah_permintaan'] = $object{$i}->getJumlah_permintaan();
            $nestedData['jumlah_disetujui'] = $object{$i}->getJumlah_disetujui();
            $nestedData['status'] = $object{$i}->getStatus();
            $nestedData['tanggal_permintaan'] = $object{$i}->getTanggal_permintaan();
            $nestedData['stok_tersedia'] = $object{$i}->getJumlah_stok();
            $nestedData['nama_barang'] = $object{$i}->getNama_barang();
            $nestedData['nama_satuan'] = $satuan->getNama_satuan();
            $nestedData['nama_grup_barang'] = $grupbarang->getNama_grup_barang();
            $nestedData['nama_unit'] = $unit{$i}->getNama_unit();
            $arrayData[] = $nestedData;

            $i++;
        } 
        $arrayData->num_rows = $i;

        $data = array("data"=>$arrayData);
        $conn->close();
        return $data;
    }

    public function prosesPermintaan($id, $idbarang, $unit_id, $untuk_unit_id, $jumlah)
    {   
        $permintaan = new PermintaanBarang(
            null,null,null,null,null,null,
            $jumlah
        );
        $permintaan->setBarang_id($idbarang);
        $unit_id = $permintaan->unit($unit_id,null);

        $idbarang->getBarang_id(); 
        $jumlah->getJumlah_stok();

        $db = new DB();
        $conn = $db->connect();
        $query =
        "UPDATE `permintaan_stok` SET `jumlah_disetujui` = '$jumlah', `status` = 'sudah_dilayani' WHERE `permintaan_stok`.`permintaan_stok_id` = $id;";
        $result = $conn->query($query);
        
        $sqlCheckTableExist = $conn->query("SELECT COUNT(*) FROM stok WHERE barang_id = '$idbarang' AND unit_id = '$untuk_unit_id'");
        $isExist = $sqlCheckTableExist->fetch_row();
        if ($isExist[0]==0){
             if($jumlah>=0){
                $query2 =
                "INSERT INTO `stok` (`barang_id`, `unit_id`, `jumlah`) VALUES ('$idbarang', '$untuk_unit_id', '$jumlah');";
                $result = $conn->query($query2);
             }
                $query1 =
                "UPDATE `stok` SET `jumlah` = jumlah-$jumlah WHERE `stok`.`barang_id` = $idbarang AND `stok`.`unit_id` = $unit_id;";
                $result = $conn->query($query1);
            }else{
                $query1 =
                "UPDATE `stok` SET `jumlah` = jumlah-$jumlah WHERE `stok`.`barang_id` = $idbarang AND `stok`.`unit_id` = $unit_id; ";
                $result = $conn->query($query1);
                $query2 =
                "UPDATE `stok` SET `jumlah` = jumlah+$jumlah WHERE `stok`.`barang_id` = $idbarang AND `stok`.`unit_id` = $untuk_unit_id; ";
                $result = $conn->query($query2);
        }
        if($jumlah>0){
            $query3 =
            "INSERT INTO `pengeluaran_barang` (`untuk_unit_id`, `dari_unit_id`, `barang_id`, `jumlah_pengeluaran`) VALUES 
            ('$untuk_unit_id', '$unit_id', '$idbarang', '$jumlah')";
            $result = $conn->query($query3);
        }
        $conn->close();
        return $result;
    }
    public function prosesPermintaanStok($unit_id)
    {   
        $db = new DB();
        $conn = $db->connect();
        $this->generateNomor("RQ", $unit_id);
        $totalTabel = $_POST['trTotal'];
        
        if($totalTabel>0){
            $tabel_barang_id        = $_POST['tabel_barang_id'];
            $tabel_jumlah           = $_POST['tabel_jumlah'];

            foreach($tabel_barang_id as $a => $b){

                $barang_id      = $tabel_barang_id[$a];
                $jumlah         = $tabel_jumlah[$a];
                
                if($jumlah>0){
                    $query =
                    "INSERT INTO `permintaan_stok` (`nomor_permintaan`, `barang_id`, 
                    `dari_unit_id`, `jumlah_permintaan`, `jumlah_disetujui`, `status`) 
                    VALUES ('$this->generatedNomorTransaksi', '$barang_id', '$unit_id', '$jumlah', '0', 'belum_dilayani')";
                    
                    $result = $conn->query($query);
                }
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

    public function riwayatPermintaanStok($sort, $page, $limitItemPage, $status)
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
        $result = $conn->query($query);

        $rows = [];
        $i=0;
        $object; $unit;
        $nestedData = array();
        $arrayData = new ArrayObject();
        while($row = mysqli_fetch_array($result))
        {   
            $object{$i} = new PermintaanBarang();
            $unit{$i} = new Unit();
            $object{$i}->setNomor_permintaan($row['nomor_permintaan']);
            $object{$i}->setStatus($row['status']);
            $object{$i}->setTanggal_permintaan($row['tanggal_permintaan']);
            $unit{$i}->setNama_unit($row['nama_unit']);
            
            $nestedData['nomor_permintaan'] = $object{$i}->getNomor_permintaan();
            $nestedData['status'] = $object{$i}->getStatus();
            $nestedData['tanggal_permintaan'] = $object{$i}->getTanggal_permintaan();
            $nestedData['nama_unit'] = $unit{$i}->getNama_unit();
            $arrayData[] = $nestedData;

            $i++;
        } 
        $arrayData->num_rows = $i;
        
        $sql = $conn->query("Select Count(*) From(SELECT COUNT(*) FROM permintaan_stok WHERE
        permintaan_stok.nomor_permintaan LIKE '%$sqlSearch%' AND permintaan_stok.status LIKE '%$status%' $sqlRangeDate 
        GROUP BY permintaan_stok.nomor_permintaan ) As total ");

        $row = $sql->fetch_row();
        $count = $row[0];
        $totalData = $count;
        $totalPages = ceil($totalData/$limitItemPage);
        $conn->close();
        $data = array("data"=>$arrayData, "currentPage"=>$page/$limitItemPage+1, "totalPages"=>$totalPages, "totalData"=>$totalData);
        return $data;
    }
    public function generateNomor($kode, $paramater){
        $md5sec=date("hi");
        $intvar=intval($md5sec);
        $md5var=md5($intvar+$paramater);
        $this->generatedNomorTransaksi = strtoupper($kode.date("dmy").substr($md5var,0,6));
    }

}
?>