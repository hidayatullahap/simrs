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

    public function prosesPengadaanStok($unit_id){
        $db=new DB;
        $conn=$db->connect();
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

    public function riwayatPengadaanStok($unit_id, $sort, $page, $limitItemPage)
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
        
        $sql = $conn->query("SELECT COUNT(*) FROM pengadaan_barang INNER JOIN barang ON pengadaan_barang.barang_id = barang.barang_id WHERE
        pengadaan_barang.untuk_unit_id = $unit_id $sqlRangeDate $sqlSearch ");

        $row = $sql->fetch_row();
        $count = $row[0];
        $totalData = $count;
        $totalPages = ceil($totalData/$limitItemPage);
        $data = array("data"=>$result, "currentPage"=>$page/$limitItemPage+1, "totalPages"=>$totalPages, "totalData"=>$totalData);
        return $data;
    }

    public function riwayatPermintaanStok($sort, $page, $limitItemPage)
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
        permintaan_stok.nomor_permintaan LIKE '%$sqlSearch%' $sqlRangeDate 
        GROUP BY
        permintaan_stok.nomor_permintaan
        ORDER BY
        permintaan_stok.tanggal_permintaan DESC
        LIMIT $page, $limitItemPage";
        $result = $conn->query($query);
        
        $sql = $conn->query("Select Count(*) From(SELECT COUNT(*) FROM permintaan_stok WHERE
        permintaan_stok.nomor_permintaan LIKE '%$sqlSearch%' $sqlRangeDate 
        GROUP BY permintaan_stok.nomor_permintaan ) As total ");

        $row = $sql->fetch_row();
        $count = $row[0];
        $totalData = $count;
        $totalPages = ceil($totalData/$limitItemPage);
        $data = array("data"=>$result, "currentPage"=>$page/$limitItemPage+1, "totalPages"=>$totalPages, "totalData"=>$totalData);
        return $data;
    }

    public function infoStok($unit_id, $sort, $page, $limitItemPage)
    {   
        $db=new DB;
        $conn=$db->connect();
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
            stok.unit_id AS unit_id,
            stok.jumlah AS jumlah_deporajal
            FROM
            stok
            WHERE
            stok.unit_id = 2
            ) AS lj_stok ON (lj_stok.unit_id= stok.unit_id) ";
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
        barang.nama_barang DESC
        LIMIT $page, $limitItemPage";
        $result = $conn->query($query);
        
        $sql = $conn->query("SELECT COUNT(*) FROM stok INNER JOIN barang ON barang.barang_id = stok.barang_id WHERE stok.unit_id = $unit_id  $sqlSearch");
        $row = $sql->fetch_row();
        $count = $row[0];
        $totalData = $count;
        $totalPages = ceil($totalData/$limitItemPage);
        $data = array("data"=>$result, "currentPage"=>$page/$limitItemPage+1, "totalPages"=>$totalPages, "totalData"=>$totalData);
        return $data;
    }

    public function getLaporanRange($range, $sort, $page, $limitItemPage)
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

        $db=new DB;
        $conn=$db->connect();
        $page=($page*$limitItemPage)-$limitItemPage;
        
        $data = array();
        
        $query =
        "SELECT
        pengeluaran_barang.tanggal_keluar AS range_waktu
        FROM
        pengeluaran_barang
        GROUP BY
        $sqlRangeWaktu 
        ORDER BY
        pengeluaran_barang.tanggal_keluar DESC
        LIMIT $page, $limitItemPage";
        $result = $conn->query($query);
        $sql = $conn->query("SELECT Count(*) From(SELECT pengeluaran_barang.tanggal_keluar AS range_waktu FROM pengeluaran_barang GROUP BY $sqlRangeWaktu) As total");
        $row = $sql->fetch_row();
        $count = $row[0];
        $totalData = $count;
        $totalPages = ceil($totalData/$limitItemPage);
        $data = array("data"=>$result, "currentPage"=>$page/$limitItemPage+1, "totalPages"=>$totalPages, "totalData"=>$totalData);
        return $data;
    }

    public function getLaporan($month, $year)
    {  
        $db=new DB;
        $conn=$db->connect();
        $data = array();
        
        $query =
        "SELECT
        barang.barang_id,
        barang.nama_barang,
        IFNULL(lj_pengeluaran.jumlah_barang_keluar,'0')  AS jumlah_barang_keluar,
        IFNULL(lj_pemasukan_barang.jumlah_barang_masuk,'0') AS jumlah_barang_masuk,
        IFNULL(lj_stok.jumlah,'0') as stok_sekarang
        FROM
        barang
        LEFT JOIN (
        SELECT
        pengeluaran_barang.barang_id,
        SUM(pengeluaran_barang.jumlah_pengeluaran) AS jumlah_barang_keluar
        FROM
        pengeluaran_barang
        WHERE
        pengeluaran_barang.dari_unit_id = 3
        AND MONTH(pengeluaran_barang.tanggal_keluar) = 6 AND YEAR(pengeluaran_barang.tanggal_keluar) = 2017
        GROUP BY
        pengeluaran_barang.barang_id
        ) lj_pengeluaran ON (lj_pengeluaran.barang_id = barang.barang_id)

        LEFT JOIN (
        SELECT
        pengadaan_barang.barang_id,
        SUM(pengadaan_barang.jumlah_barang) AS jumlah_barang_masuk
        FROM
        pengadaan_barang
        WHERE
        pengadaan_barang.untuk_unit_id = 3
        AND MONTH(pengadaan_barang.tanggal_masuk) = 6 AND YEAR(pengadaan_barang.tanggal_masuk) = 2017
        GROUP BY
        pengadaan_barang.barang_id
        ) lj_pemasukan_barang ON (lj_pemasukan_barang.barang_id = barang.barang_id)
        LEFT JOIN (
        SELECT
        stok.barang_id AS barang_id,
        stok.jumlah AS jumlah
        FROM
        stok
        WHERE
        stok.unit_id = 3
        )lj_stok ON (lj_stok.barang_id = barang.barang_id)
        GROUP BY
        barang.nama_barang
        ORDER BY
        barang.nama_barang ASC
        ";
        $result = $conn->query($query);
        $data = array("data"=>$result);
        return $data;
    }
}
?>