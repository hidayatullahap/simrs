<?php
require_once CLASSES_DIR  . 'dbconnection.php';

class Depo{
    private $db;
    private $conn;
    private $generateNomorTransaksi;

    public function __construct() {
        $this->db = new DB();
        $this->conn = $this->db->connect();
    }

    public function generateNomor($kode, $paramater){
        $md5sec=date("hi");
        $intvar=intval($md5sec);
        $md5var=md5($intvar+$paramater);
        $this->generateNomorTransaksi = strtoupper($kode.date("dmy").substr($md5var,0,6));
    }

    public function prosesPengeluaranObat($unit_id, $pasien_id)
    {   
        $i=1;
        $totalTabel = $_POST['trTotal'];
        $totalTagihanPasien = $_POST['totaltagihan'];

        $this->generateNomor("RJ", $pasien_id);

        if(intval($totalTabel)>0){
            $tabel_barang_id        = $_POST['tabel_barang_id'];
            $tabel_jumlah           = $_POST['tabel_jumlah'];
            $tabel_aturan_pakai     = $_POST['tabel_aturan_pakai'];
            $tabel_keterangan       = $_POST['tabel_keterangan'];
            $tabel_nomor_batch      = $_POST['tabel_nomor_batch'];
            $tabel_nama_pasien      = $_POST['tabel_nama_pasien'];
            $tabel_harga_barang     = $_POST['tabel_harga_barang'];
            
            foreach($tabel_barang_id as $a => $b){

                $barang_id      = $tabel_barang_id[$a];
                $jumlah         = $tabel_jumlah[$a];
                $aturan_pakai   = $tabel_aturan_pakai[$a];
                $nama_penerima  = $tabel_keterangan[$a];
                $nomor_batch    = $tabel_nomor_batch[$a];
                $nama_pasien    = $tabel_nama_pasien[$a];
                $harga_barang    = $tabel_harga_barang[$a];

                $query1 =
                "UPDATE `stok` SET `jumlah` = jumlah-$jumlah WHERE `stok`.`barang_id` = $barang_id AND `stok`.`unit_id` = $unit_id;";
                $result1 = $this->conn->query($query1);

                $query2 =
                "INSERT INTO `pengeluaran_barang` (`untuk_unit_id`, `dari_unit_id`, `barang_id`, `no_batch` ,`jumlah_pengeluaran`, `nama_penerima`) VALUES 
                ('9', '$unit_id', '$barang_id', '$nomor_batch', '$jumlah','$nama_pasien')";
                $result2 = $this->conn->query($query2);

                $query3 =
                "INSERT INTO `resep` (`nomor_transaksi`, `barang_id`, `aturan_pakai`, `jumlah`) VALUES ('$this->generateNomorTransaksi', '$barang_id', '$aturan_pakai', '$jumlah')";
                $result3 = $this->conn->query($query3);

                $i++;
            }
            $query4 =
            "INSERT INTO `transaksi_obat` (`pasien_id`, `nomor_transaksi`, `total_tagihan`) VALUES ('$pasien_id', '$this->generateNomorTransaksi', '$totalTagihanPasien');";
            $result4 = $this->conn->query($query4);

            $query5 =
            "UPDATE `antrian` SET `status` = 'sudah_dilayani' WHERE `antrian`.`status` = 'belum_dilayani' AND `antrian`.`pasien_id` = $pasien_id";
            $result4 = $this->conn->query($query5);

            $this->conn->close();
            if($result4){
                return true;
            }else{
                return 'error';
            }
        }else{
            return false;
        }
    }

    public function riwayatResepKeluar($sort, $page, $limitItemPage)
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
            $sqlRangeDate = "AND transaksi_obat.tanggal_transaksi BETWEEN '$tanggalAwal' AND '$tanggalAkhir' ";
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
        transaksi_obat.transaksi_obat_id,
        transaksi_obat.tanggal_transaksi,
        transaksi_obat.nomor_transaksi,
        transaksi_obat.total_tagihan,
        pasien.nama
        FROM
        transaksi_obat
        INNER JOIN pasien ON transaksi_obat.pasien_id = pasien.pasien_id
        WHERE
        pasien.nama LIKE '%$sqlSearch%' 
        $sqlRangeDate 
        ORDER BY
        transaksi_obat.tanggal_transaksi DESC
        LIMIT $page, $limitItemPage";
        $result = $this->conn->query($query);
        
        $sql = $this->conn->query("Select Count(*) From(SELECT
        transaksi_obat.transaksi_obat_id,
        transaksi_obat.tanggal_transaksi,
        transaksi_obat.nomor_transaksi,
        transaksi_obat.total_tagihan,
        pasien.nama
        FROM
        transaksi_obat
        INNER JOIN pasien ON transaksi_obat.pasien_id = pasien.pasien_id
        WHERE
        pasien.nama LIKE '%$sqlSearch%' 
        $sqlRangeDate) As total ");

        $row = $sql->fetch_row();
        $count = $row[0];
        $totalData = $count;
        $totalPages = ceil($totalData/$limitItemPage);
        $data = array("data"=>$result, "currentPage"=>$page/$limitItemPage+1, "totalPages"=>$totalPages, "totalData"=>$totalData);
        return $data;
    }

    public function detilResep($nomorTransaksi)
    {   
        $data = array();
        
        $query =
        "SELECT
        resep.resep_id,
        resep.nomor_transaksi,
        resep.aturan_pakai,
        resep.jumlah,
        resep.tanggal_resep,
        barang.nama_barang,
        satuan.nama_satuan
        FROM
        resep
        INNER JOIN barang ON resep.barang_id = barang.barang_id
        INNER JOIN satuan ON barang.satuan_id = satuan.satuan_id
        WHERE
        resep.nomor_transaksi = '$nomorTransaksi'
        ORDER BY
        barang.nama_barang";
        $result = $this->conn->query($query);

        $data = array("data"=>$result);
        return $data;
    }

    public function prosesPermintaanStok($unit_id)
    {   
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
                    VALUES ('$this->generateNomorTransaksi', '$barang_id', '$unit_id', '$jumlah', '0', 'belum_dilayani')";
                    
                    $result = $this->conn->query($query);
                }
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

    public function printResep($nomorTransaksi)
    {   
        $data = array();
        
        $query =
        "SELECT
        resep.jumlah,
        resep.tanggal_resep,
        barang.nama_barang,
        satuan.nama_satuan,
        barang.harga_jual,
        (barang.harga_jual*resep.jumlah) AS total,
        transaksi_obat.pasien_id,
        transaksi_obat.nomor_transaksi,
        pasien.nama,
        pasien.nomor_RM,
        jenis_pasien.nama_jenis_pasien
        FROM
        resep
        LEFT JOIN barang ON resep.barang_id = barang.barang_id
        LEFT JOIN satuan ON barang.satuan_id = satuan.satuan_id
        LEFT JOIN transaksi_obat ON transaksi_obat.nomor_transaksi = resep.nomor_transaksi
        INNER JOIN pasien ON transaksi_obat.pasien_id = pasien.pasien_id
        INNER JOIN jenis_pasien ON pasien.jenis_pasien_id = jenis_pasien.jenis_pasien_id
        WHERE
        resep.nomor_transaksi = '$nomorTransaksi'
        ORDER BY
        barang.nama_barang
        ";

        $result = $this->conn->query($query);

        $data = array("data"=>$result);
        return $data;
    }
}