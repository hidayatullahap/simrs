<?php 
require_once CLASSES_DIR  . 'dbconnection.php';
require_once CLASSES_DIR  . 'satuan.php';
require_once CLASSES_DIR  . 'barang.php';
require_once CLASSES_DIR  . 'aturanpakai.php';

class DetilTransaksi{
    private $detil_id;
    private $nomor_transaksi;
    private $aturan_pakai;
    private $jumlah;
    private $tanggal_resep;

    function setDetil_id($detil_id) { $this->detil_id = $detil_id; }
    function getDetil_id() { return $this->detil_id; }
    function setNomor_transaksi($nomor_transaksi) { $this->nomor_transaksi = $nomor_transaksi; }
    function getNomor_transaksi() { return $this->nomor_transaksi; }
    function setAturan_pakai($aturan_pakai) { $this->aturan_pakai = $aturan_pakai; }
    function getAturan_pakai() { return $this->aturan_pakai; }
    function setJumlah($jumlah) { $this->jumlah = $jumlah; }
    function getJumlah() { return $this->jumlah; }
    function setTanggal_resep($tanggal_resep) { $this->tanggal_resep = $tanggal_resep; }
    function getTanggal_resep() { return $this->tanggal_resep; }
    
    public function detilResep($nomorTransaksi)
    {   
        $db = new DB();
        $conn = $db->connect();
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
        $result = $conn->query($query);

        $rows = [];
        $i=0;
        $detil;
        $nestedData = array();
        $arrayData = new ArrayObject();
        while($row = mysqli_fetch_array($result))
        {   
            $detil{$i} = new DetilTransaksi();
            $satuan{$i} = new Satuan();
            $barang{$i} = new Barang();
            $aturanPakai{$i} = new AturanPakai();
            $satuan{$i}->setNama_satuan($row['nama_satuan']);
            $barang{$i}->setNama_barang($row['nama_barang']);
            $detil{$i}->setTanggal_resep($row['tanggal_resep']);
            $detil{$i}->setJumlah($row['jumlah']);
            $aturanPakai{$i}->setNama_aturan_pakai($row['aturan_pakai']);
            $detil{$i}->setNomor_transaksi($row['nomor_transaksi']);
            $detil{$i}->setDetil_id($row['resep_id']);
            
            $nestedData['resep_id'] = $detil{$i}->getDetil_id();
            $nestedData['nomor_transaksi'] = $detil{$i}->getNomor_transaksi();
            $nestedData['aturan_pakai'] = $aturanPakai{$i}->getNama_aturan_pakai();
            $nestedData['jumlah'] = $detil{$i}->getJumlah();
            $nestedData['tanggal_resep'] = $detil{$i}->getTanggal_resep();
            $nestedData['nama_barang'] = $barang{$i}->getNama_barang();
            $nestedData['nama_satuan'] = $satuan{$i}->getNama_satuan();
            $arrayData[] = $nestedData;

            $i++;
        } 
        $arrayData->num_rows = $i;
        $conn->close();
        $data = array("data"=>$arrayData);
        return $data;
    }

    public function printResep($nomorTransaksi)
    {   
        $db = new DB();
        $conn = $db->connect();
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
        $result = $conn->query($query);
        $conn->close();
        $data = array("data"=>$result);
        return $data;
    }

    /*
    public function addGroup(TransaksiObat $group) {
        $this->groups[] = $group;
        $group->setTotal_tagihan($this);
    }

    public function addNomorTransaksi(TransaksiObat $nomor) {
        $this->nomor = $nomor;
        $nomor->setNomor_transaksi($this);
    }*/
}
?>