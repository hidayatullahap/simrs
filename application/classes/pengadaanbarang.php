<?php
require_once CLASSES_DIR  . 'barang.php';
require_once CLASSES_DIR  . 'satuan.php';
require_once CLASSES_DIR  . 'jenispenerimaan.php';

class PengadaanBarang extends Barang{
    private $pengadaan_barang_id;
    private $terima_dari;
    private $no_faktur;
    private $tanggal_faktur;
    private $keterangan;
    private $no_batch;
    private $tanggal_kadaluarsa;
    private $harga_jual;
    private $harga_beli;
    private $jumlah_barang;
    private $untuk_unit_id;
    private $tanggal_masuk;

    public function __construct(
    $pengadaan_barang_id=null,
    $terima_dari=null,
    $no_faktur=null,
    $tanggal_faktur=null,
    $keterangan=null,
    $no_batch=null,
    $tanggal_kadaluarsa=null,
    $harga_jual=null,
    $harga_beli=null,
    $jumlah_barang=null,
    $untuk_unit_id=null,
    $tanggal_masuk=null) {
        $this->pengadaan_barang_id = $pengadaan_barang_id;
        $this->terima_dari = $terima_dari;
        $this->no_faktur = $no_faktur;
        $this->tanggal_faktur = $tanggal_faktur;
        $this->keterangan = $keterangan;
        $this->no_batch = $no_batch;
        $this->tanggal_kadaluarsa = $tanggal_kadaluarsa;
        $this->harga_jual = $harga_jual;
        $this->harga_beli = $harga_beli;
        $this->jumlah_barang = $jumlah_barang;
        $this->untuk_unit_id = $untuk_unit_id;
        $this->tanggal_masuk = $tanggal_masuk;
    }

    function setPengadaan_barang_id($pengadaan_barang_id) { $this->pengadaan_barang_id = $pengadaan_barang_id; }
    function getPengadaan_barang_id() { return $this->pengadaan_barang_id; }
    function setTerima_dari($terima_dari) { $this->terima_dari = $terima_dari; }
    function getTerima_dari() { return $this->terima_dari; }
    function setNo_faktur($no_faktur) { $this->no_faktur = $no_faktur; }
    function getNo_faktur() { return $this->no_faktur; }
    function setTanggal_faktur($tanggal_faktur) { $this->tanggal_faktur = $tanggal_faktur; }
    function getTanggal_faktur() { return $this->tanggal_faktur; }
    function setKeterangan($keterangan) { $this->keterangan = $keterangan; }
    function getKeterangan() { return $this->keterangan; }
    function setNo_batch($no_batch) { $this->no_batch = $no_batch; }
    function getNo_batch() { return $this->no_batch; }
    function setTanggal_kadaluarsa($tanggal_kadaluarsa) { $this->tanggal_kadaluarsa = $tanggal_kadaluarsa; }
    function getTanggal_kadaluarsa() { return $this->tanggal_kadaluarsa; }
    function setHarga_jual($harga_jual) { $this->harga_jual = $harga_jual; }
    function getHarga_jual() { return $this->harga_jual; }
    function setHarga_beli($harga_beli) { $this->harga_beli = $harga_beli; }
    function getHarga_beli() { return $this->harga_beli; }
    function setJumlah_barang($jumlah_barang) { $this->jumlah_barang = $jumlah_barang; }
    function getJumlah_barang() { return $this->jumlah_barang; }
    function setTanggal_masuk($tanggal_masuk) { $this->tanggal_masuk = $tanggal_masuk; }
    function getTanggal_masuk() { return $this->tanggal_masuk; }
    function setUntuk_unit_id($untuk_unit_id) { $this->untuk_unit_id = $untuk_unit_id; }
    function getUntuk_unit_id() { return $this->untuk_unit_id; }
    function jenispenerimaan($id, $nama) { 
        $jenispenerimaan = new JenisPenerimaan($id, $nama);
        return $jenispenerimaan;
    }
}
?>