<?php 
require_once CLASSES_DIR  . 'dbconnection.php';
require_once CLASSES_DIR  . 'satuan.php';
require_once CLASSES_DIR  . 'barang.php';
require_once CLASSES_DIR  . 'aturanpakai.php';

class DetilTransaksiModel extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }

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

        $rows = [];
        $i=0;
        $object; $unit;
        $nestedData = array();
        $arrayData = new ArrayObject();
        while($row = mysqli_fetch_array($result))
        {   
            $resep{$i} = new DetilTransaksi(
                null,null,null,
                $row['jumlah'],
                $row['tanggal_resep']
            );
            $barang{$i} = new Barang(
                null, 
                $row['nama_barang'],
                null,
                $row['harga_jual']
            );
            $satuan = $barang{$i}->satuan(null, $row['nama_satuan']);

            $transaksi{$i} = new TransaksiObat(
                null,null,
                $row['nomor_transaksi']
            );

            $pasien = $transaksi{$i}->pasien(
                null, 
                $row['pasien_id'],
                $row['nama'],null,null,null,null,null,null, 
                $row['nomor_RM']
            );
            $jenis_pasien = $pasien->jenisPasien(null, $row['nama_jenis_pasien']);
            
            $nestedData['jumlah'] = $resep{$i}->getJumlah();
            $nestedData['tanggal_resep'] = $resep{$i}->getTanggal_resep();
            $nestedData['nama_barang'] = $barang{$i}->getNama_barang();
            $nestedData['harga_jual'] = $barang{$i}->getHarga_jual();
            $nestedData['nama_satuan'] = $satuan->getNama_satuan();
            $nestedData['total'] = $row['total'];
            $nestedData['pasien_id'] = $pasien->getPasien_id();
            $nestedData['nomor_transaksi'] = $transaksi{$i}->getNomor_transaksi();
            $nestedData['nama'] = $pasien->getNama();
            $nestedData['nomor_RM'] = $pasien->getNomor_RM();
            $nestedData['nama_jenis_pasien'] = $jenis_pasien->getNama_jenis_pasien();
            $arrayData[] = $nestedData;

            $i++;
        } 
        $arrayData->num_rows = $i;

        $conn->close();
        $data = array("data"=>$arrayData);
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