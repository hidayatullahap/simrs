<?php
require_once CLASSES_DIR  . 'pengeluaranbarang.php';
require_once CLASSES_DIR  . 'pasien.php';

class TransaksiObatModel extends CI_Model{
    private $db;
    private $conn;
    public function __construct() {
        parent::__construct();
        $this->db = new DB();
        $this->conn = $this->db->connect();
    }

    public function generateNomor($kode, $paramater){
        $md5sec=date("hi");
        $intvar=intval($md5sec);
        $md5var=md5($intvar+$paramater);
        $this->generatedNomorTransaksi = strtoupper($kode.date("dmy").substr($md5var,0,6));
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
                 $pengeluaran = new PengeluaranBarang(
                    null,
                    $tabel_nomor_batch[$a],
                    $tabel_jumlah[$a]
                );
                $pengeluaran->setBarang_id($tabel_barang_id[$a]);
                $pengeluaran->setHarga_jual($tabel_harga_barang[$a]);
                $aturan_pakai = $pengeluaran->aturanpakai(null, $tabel_aturan_pakai[$a]);
                $pasien = new Pasien(
                    null, $tabel_nama_pasien[$a]
                );

                $barang_id      = $pengeluaran->getBarang_id();
                $jumlah         = $pengeluaran->getJumlah_pengeluaran();
                $aturan_pakai   = $aturan_pakai->getNama_aturan_pakai();
                $nama_penerima  = $pengeluaran->getNama_penerima();
                $nomor_batch    = $pengeluaran->getNo_batch();
                $nama_pasien    = $pasien->getNama();
                $harga_barang   = $pengeluaran->getHarga_jual();

                $query1 =
                "UPDATE `stok` SET `jumlah` = jumlah-$jumlah WHERE `stok`.`barang_id` = $barang_id AND `stok`.`unit_id` = $unit_id;";
                $result1 = $this->conn->query($query1);

                $query2 =
                "INSERT INTO `pengeluaran_barang` (`untuk_unit_id`, `dari_unit_id`, `barang_id`, `no_batch` ,`jumlah_pengeluaran`, `nama_penerima`) VALUES 
                ('9', '$unit_id', '$barang_id', '$nomor_batch', '$jumlah','$nama_pasien')";
                $result2 = $this->conn->query($query2);

                $query3 =
                "INSERT INTO `resep` (`nomor_transaksi`, `barang_id`, `aturan_pakai`, `jumlah`) VALUES ('$this->generatedNomorTransaksi', '$barang_id', '$aturan_pakai', '$jumlah')";
                $result3 = $this->conn->query($query3);

                $i++;
            }
            $query4 =
            "INSERT INTO `transaksi_obat` (`pasien_id`, `nomor_transaksi`, `total_tagihan`) VALUES ('$pasien_id', '$this->generatedNomorTransaksi', '$totalTagihanPasien');";
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

        $rows = [];
        $i=0;
        $transaksi;
        $nestedData = array();
        $arrayData = new ArrayObject();
        while($row = mysqli_fetch_array($result))
        {   
            $transaksi{$i} = new TransaksiObat(
                null,
                $row['total_tagihan'],
                $row['nomor_transaksi'],
                $row['tanggal_transaksi'],
                $row['transaksi_obat_id']
            );
            $pasien{$i} = new Pasien(null,$row['nama']);
            
            $nestedData['nama'] = $pasien{$i}->getNama();
            $nestedData['total_tagihan'] = $transaksi{$i}->getTotal_tagihan();
            $nestedData['nomor_transaksi'] = $transaksi{$i}->getNomor_transaksi();
            $nestedData['tanggal_transaksi'] = $transaksi{$i}->getTanggal_transaksi();
            $nestedData['transaksi_obat_id'] = $transaksi{$i}->getTransaksi_obat_id();
            $arrayData[] = $nestedData;

            $i++;
        } 
        $arrayData->num_rows = $i;
        
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
        $data = array("data"=>$arrayData, "currentPage"=>$page/$limitItemPage+1, "totalPages"=>$totalPages, "totalData"=>$totalData);
        return $data;
    }
}