<?php
require_once CLASSES_DIR  . 'barang.php';

class Stok extends Barang{
    private $stok_id;
    private $jumlah;
    private $tanggal_pencatatan;
    private $jumlah_barang_keluar;
    private $jumlah_pengeluaran_in_rp;
    private $jumlah_barang_masuk;
    private $jumlah_pengadaan_in_rp;
    private $stok_sekarang;
    private $jumlah_stok_in_rp;
    private $harga_beli;

    public function __construct(
    $stok_id=null,
    $jumlah=null,
    $tanggal_pencatatan=null,
    $jumlah_barang_keluar=null,
    $jumlah_pengeluaran_in_rp=null,
    $jumlah_barang_masuk=null,
    $jumlah_pengadaan_in_rp=null,
    $stok_sekarang=null,
    $jumlah_stok_in_rp=null,
    $jumlah_barang=null,
    $harga_beli=null) {
        $this->stok_id = $stok_id;
        $this->jumlah = $jumlah;
        $this->tanggal_pencatatan = $tanggal_pencatatan;
        $this->jumlah_barang_keluar = $jumlah_barang_keluar;
        $this->jumlah_pengeluaran_in_rp = $jumlah_pengeluaran_in_rp;
        $this->jumlah_barang_masuk = $jumlah_barang_masuk;
        $this->jumlah_pengadaan_in_rp = $jumlah_pengadaan_in_rp;
        $this->stok_sekarang = $stok_sekarang;
        $this->harga_beli = $harga_beli;
        $this->jumlah_stok_in_rp = $jumlah_stok_in_rp;
    }

    function setStok_id($stok_id) { $this->stok_id = $stok_id; }
    function getStok_id() { return $this->stok_id; }
    function setJumlah($jumlah) { $this->jumlah = $jumlah; }
    function getJumlah() { return $this->jumlah; }
    function setTanggal_pencatatan($tanggal_pencatatan) { $this->tanggal_pencatatan = $tanggal_pencatatan; }
    function getTanggal_pencatatan() { return $this->tanggal_pencatatan; }
    function setJumlah_barang_keluar($jumlah_barang_keluar) { $this->jumlah_barang_keluar = $jumlah_barang_keluar; }
    function getJumlah_barang_keluar() { return $this->jumlah_barang_keluar; }
    function setJumlah_pengeluaran_in_rp($jumlah_pengeluaran_in_rp) { $this->jumlah_pengeluaran_in_rp = $jumlah_pengeluaran_in_rp; }
    function getJumlah_pengeluaran_in_rp() { return $this->jumlah_pengeluaran_in_rp; }
    function setJumlah_barang_masuk($jumlah_barang_masuk) { $this->jumlah_barang_masuk = $jumlah_barang_masuk; }
    function getJumlah_barang_masuk() { return $this->jumlah_barang_masuk; }
    function setJumlah_pengadaan_in_rp($jumlah_pengadaan_in_rp) { $this->jumlah_pengadaan_in_rp = $jumlah_pengadaan_in_rp; }
    function getJumlah_pengadaan_in_rp() { return $this->jumlah_pengadaan_in_rp; }
    function setStok_sekarang($stok_sekarang) { $this->stok_sekarang = $stok_sekarang; }
    function getStok_sekarang() { return $this->stok_sekarang; }
    function setJumlah_stok_in_rp($jumlah_stok_in_rp) { $this->jumlah_stok_in_rp = $jumlah_stok_in_rp; }
    function getJumlah_stok_in_rp() { return $this->jumlah_stok_in_rp; }

}
?>