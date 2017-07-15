<?php
require_once CLASSES_DIR  . 'dbconnection.php';
require_once CLASSES_DIR  . 'barang.php';
require_once CLASSES_DIR  . 'pengeluaranbarang.php';

class PengeluaranBarangModel extends CI_Model{
    public function __construct() {
        parent::__construct();
    }

    public function ajaxStokKeluar($unit_id)
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
        
        $sql = $conn->query("SELECT COUNT(*) FROM pengeluaran_barang WHERE
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

            $sql = $conn->query("SELECT COUNT(*) FROM pengeluaran_barang 
            INNER JOIN barang ON pengeluaran_barang.barang_id = barang.barang_id
            WHERE
            pengeluaran_barang.tanggal_keluar BETWEEN DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 00:00:00') 
            AND DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 0 DAY), '%Y-%m-%d 23:59:59')
            AND pengeluaran_barang.dari_unit_id = $unit_id
            AND barang.nama_barang LIKE '%".$requestData['search']['value']."%'");
            }
        
        $result = $conn->query($query);

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
        $conn->close();
        $datajson = array("draw" => intval( $requestData['draw'] ), "recordsTotal"=>$totalData, "recordsFiltered"=>$totalData, "data"=>$data);
        echo json_encode($datajson);
    }

    public function prosesPengeluaranStok($unit_id)
    {   
        $db = new DB();
        $conn = $db->connect();
        $totalTabel = $_POST['trTotal'];
        
        $i=1;
        if($totalTabel>0){
            $tabel_barang_id        = $_POST['tabel_barang_id'];
            $tabel_nomor_batch      = $_POST['tabel_nomor_batch'];
            $tabel_jumlah           = $_POST['tabel_jumlah'];
            $tabel_untuk_unit_id    = $_POST['tabel_untuk_unit_id'];
            $tabel_nama_penerima    = $_POST['tabel_nama_penerima'];

            foreach($tabel_barang_id as $a => $b){
                $pengeluaran = new PengeluaranBarang(
                    null,
                    $tabel_nomor_batch[$a],
                    $tabel_jumlah[$a],
                    $tabel_nama_penerima[$a],
                    $tabel_untuk_unit_id[$a]
                );
                $pengeluaran->setBarang_id($tabel_barang_id[$a]);

                $barang_id      = $pengeluaran->getBarang_id();
                $nomor_batch    = $pengeluaran->getNo_batch();
                $jumlah         = $pengeluaran->getJumlah_pengeluaran();
                $untuk_unit_id  = $pengeluaran->getUntuk_unit_id();
                $nama_penerima  = $pengeluaran->getNama_penerima();
                
                $sqlCheckTableExist = $conn->query("SELECT COUNT(*) FROM stok WHERE barang_id = '$barang_id' AND unit_id = '$untuk_unit_id'");
                $isExist = $sqlCheckTableExist->fetch_row();

                if ($isExist[0]==0){
                    if($jumlah>0){
                        $query2 =
                        "INSERT INTO `stok` (`barang_id`, `unit_id`, `jumlah`) VALUES ('$barang_id', '$untuk_unit_id', '$jumlah');";
                        $result = $conn->query($query2);
                    }
                        $query1 =
                        "UPDATE `stok` SET `jumlah` = jumlah-$jumlah WHERE `stok`.`barang_id` = $barang_id AND `stok`.`unit_id` = $unit_id;";
                        $result = $conn->query($query1);

                    }else{
                        $query1 =
                        "UPDATE `stok` SET `jumlah` = jumlah-$jumlah WHERE `stok`.`barang_id` = $barang_id AND `stok`.`unit_id` = $unit_id; ";
                        $result = $conn->query($query1);

                        $query2 =
                        "UPDATE `stok` SET `jumlah` = jumlah+$jumlah WHERE `stok`.`barang_id` = $barang_id AND `stok`.`unit_id` = $untuk_unit_id; ";
                        $result = $conn->query($query2);
                }
                if($jumlah>0){
                    $query =
                    "INSERT INTO `pengeluaran_barang` (`untuk_unit_id`, `dari_unit_id`, `barang_id`, `no_batch` ,`jumlah_pengeluaran`, `nama_penerima`) VALUES 
                    ('$untuk_unit_id', '$unit_id', '$barang_id', '$nomor_batch', '$jumlah','$nama_penerima')";
                    
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

    public function riwayatPengeluaranStok($unit_id, $sort, $page, $limitItemPage)
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
        $result = $conn->query($query);

        $rows = [];
        $i=0;
        $object; 
        $nestedData = array();
        $arrayData = new ArrayObject();
        while($row = mysqli_fetch_array($result))
        {   
            $object{$i} = new PengeluaranBarang();
            $object{$i}->setNama_barang($row['nama_barang']);
            $object{$i}->setJumlah_pengeluaran($row['jumlah_pengeluaran']);
            $object{$i}->setTanggal_keluar($row['tanggal_keluar']);
            $object{$i}->setNo_batch($row['no_batch']);
            $object{$i}->setNama_penerima($row['nama_penerima']);
            $grupbarang = $object{$i}->grupBarang(null, $row['nama_grup_barang']);
            
            $nestedData['nama_barang'] = $object{$i}->getNama_barang();
            $nestedData['jumlah_pengeluaran'] = $object{$i}->getJumlah_pengeluaran();
            $nestedData['tanggal_keluar'] = $object{$i}->getTanggal_keluar();
            $nestedData['nama_unit'] = $object{$i}->unit(null, $row['nama_unit']);
            $nestedData['nama_grup_barang'] = $grupbarang->getNama_grup_barang();
            $nestedData['no_batch'] = $object{$i}->getNo_batch();
            $nestedData['nama_penerima'] = $object{$i}->getNama_penerima();
            $arrayData[] = $nestedData;

            $i++;
        } 
        $arrayData->num_rows = $i;
        
        $sql = $conn->query("SELECT COUNT(*) FROM pengeluaran_barang INNER JOIN barang ON pengeluaran_barang.barang_id = barang.barang_id WHERE
        pengeluaran_barang.dari_unit_id = $unit_id $sqlRangeDate $sqlSearch ");

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