<?php
require_once CLASSES_DIR  . 'dbconnection.php';

class Gudang{

    public function ajaxPermintaanMasuk()
    {   
        $requestData = $_REQUEST;
        $db=new DB;
        $conn=$db->connect();
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
        $conn->close();
        $totalData = $count;
        $datajson = array("draw" => intval( $requestData['draw'] ), "recordsTotal"=>$totalData, "recordsFiltered"=>$totalData, "data"=>$data);
        echo json_encode($datajson);
    }

    public function ajaxStokKeluar($unit_id)
    {   
        $requestData = $_REQUEST;
        $db=new DB;
        $conn=$db->connect();
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
        $datajson = array("draw" => intval( $requestData['draw'] ), "recordsTotal"=>$totalData, "recordsFiltered"=>$totalData, "data"=>$data);
        echo json_encode($datajson);
    }

    public function ajaxStokMasuk($unit_id)
    {   
        $requestData = $_REQUEST;
        $db=new DB;
        $conn=$db->connect();
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
        $datajson = array("draw" => intval( $requestData['draw'] ), "recordsTotal"=>$totalData, "recordsFiltered"=>$totalData, "data"=>$data);
        echo json_encode($datajson);
    }

    public function getDetil($unit_id, $nomorPermintaan)
    {   
        $db=new DB;
        $conn=$db->connect();
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
        $data = array("data"=>$result);
        
        return $data;
    }

    public function prosesPermintaan($id, $idbarang, $unit_id, $untuk_unit_id, $jumlah)
    { 
        $db=new DB;
        $conn=$db->connect();
        $query =
        "UPDATE `permintaan_stok` SET `jumlah_disetujui` = '$jumlah', `status` = 'belum_dilayani' WHERE `permintaan_stok`.`permintaan_stok_id` = $id;";
        $result = $conn->query($query);
        
        $sqlCheckTableExist = $conn->query("SELECT COUNT(*) FROM stok WHERE barang_id = '$idbarang' AND unit_id = '$untuk_unit_id'");
        $isExist = $sqlCheckTableExist->fetch_row();

        if ($isExist[0]==0){
             if($jumlah>0){
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

    public function prosesPengeluaranStok($unit_id){
        $db=new DB;
        $conn=$db->connect();
        $totalTabel = $_POST['trTotal'];
        $i=1;

        if($totalTabel>0){
            $tabel_barang_id        = $_POST['tabel_barang_id'];
            $tabel_nomor_batch      = $_POST['tabel_nomor_batch'];
            $tabel_kadaluarsa       = $_POST['tabel_kadaluarsa'];
            $tabel_jumlah           = $_POST['tabel_jumlah'];
            $tabel_untuk_unit_id    = $_POST['tabel_untuk_unit_id'];

            foreach($tabel_barang_id as $a => $b){
                $barang_id      = $tabel_barang_id[$a];
                $nomor_batch    = $tabel_nomor_batch[$a];
                $kadaluarsa     = $tabel_kadaluarsa[$a];
                $jumlah         = $tabel_jumlah[$a];
                $untuk_unit_id  = $tabel_untuk_unit_id[$a];
                /*
                echo "Data ke: ".$i.": <br>";
                echo "Idbarang: ". $barang_id.", ";
                echo "nomor batch: ". $nomor_batch.", ";
                echo "tgl kadaluarasa: ". $kadaluarsa.", ";
                echo "jumlah: ". $jumlah.", ";
                echo "untuk unit id: ". $untuk_unit_id.", <br>";
                */
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
                "INSERT INTO `pengeluaran_barang` (`untuk_unit_id`, `dari_unit_id`, `barang_id`, `no_batch`, `jumlah_pengeluaran`) VALUES 
                ('$untuk_unit_id', '$unit_id', '$barang_id', '$nomor_batch', '$jumlah')";
                
                $result = $conn->query($query);
                }
                $i++;
            }
            $conn->close();
            return $query;
        }else{
            return false;
        }
    }

    public function riwayatPengeluaranStok($unit_id, $sort, $page, $limitItemPage)
    {   
        $db=new DB;
        $conn=$db->connect();
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
        pengeluaran_barang.no_batch
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
        
        $sql = $conn->query("SELECT COUNT(*) FROM pengeluaran_barang INNER JOIN barang ON pengeluaran_barang.barang_id = barang.barang_id WHERE
        pengeluaran_barang.dari_unit_id = $unit_id $sqlRangeDate $sqlSearch ");

        $row = $sql->fetch_row();
        $count = $row[0];
        $totalData = $count;
        $totalPages = ceil($totalData/$limitItemPage);
        $data = array("data"=>$result, "currentPage"=>$page/$limitItemPage+1, "totalPages"=>$totalPages, "totalData"=>$totalData);
        return $data;
    }
}
?>