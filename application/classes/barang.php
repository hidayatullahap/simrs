<?php
require_once CLASSES_DIR  . 'satuan.php';
require_once CLASSES_DIR  . 'grupbarang.php';

class Barang{
    private $barang_id;
    private $nama_barang;
    private $merek_model_ukuran;
    private $harga_jual;
    private $tanggal_pencatatan;

    public function __construct(
    $barang_id=null, 
    $nama_barang=null,
    $merek_model_ukuran=null,
    $harga_jual=null,
    $tanggal_pencatatan=null) {
        $this->barang_id = $barang_id;
        $this->nama_barang = $nama_barang;
        $this->merek_model_ukuran = $merek_model_ukuran;
        $this->harga_jual = $harga_jual;
        $this->tanggal_pencatatan = $tanggal_pencatatan;
    }

    function setBarang_id($barang_id) { $this->barang_id = $barang_id; }
    function getBarang_id() { return $this->barang_id; }
    function setNama_barang($nama_barang) { $this->nama_barang = $nama_barang; }
    function getNama_barang() { return $this->nama_barang; }
    function setMerek_model_ukuran($merek_model_ukuran) { $this->merek_model_ukuran = $merek_model_ukuran; }
    function getMerek_model_ukuran() { return $this->merek_model_ukuran; }
    function setHarga_jual($harga_jual) { $this->harga_jual = $harga_jual; }
    function getHarga_jual() { return $this->harga_jual; }
    function setTanggal_pencatatan($tanggal_pencatatan) { $this->tanggal_pencatatan = $tanggal_pencatatan; }
    function getTanggal_pencatatan() { return $this->tanggal_pencatatan; }
    function grupBarang($id, $nama) { 
        $grupbarang = new GrupBarang($id, $nama);
        return $grupbarang;
    }
    function satuan($id, $nama) { 
        $satuan = new Satuan($id, $nama);
        return $satuan;
    }
}
?>