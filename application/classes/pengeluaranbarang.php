<?php
require_once CLASSES_DIR  . 'barang.php';
require_once CLASSES_DIR  . 'unit.php';
require_once CLASSES_DIR  . 'grupbarang.php';
require_once CLASSES_DIR  . 'aturanpakai.php';

class PengeluaranBarang extends Barang{
    private $pengeluaran_barang_id;
    private $no_batch;
    private $jumlah_pengeluaran;
    private $nama_penerima;
    private $tanggal_keluar;
    private $untuk_unit_id;

    public function __construct(
    $pengeluaran_barang_id=null,
    $no_batch=null,
    $jumlah_pengeluaran=null,
    $nama_penerima=null,
    $untuk_unit_id=null,
    $tanggal_keluar=null) {
        $this->pengeluaran_barang_id = $pengeluaran_barang_id;
        $this->no_batch = $no_batch;
        $this->jumlah_pengeluaran = $jumlah_pengeluaran;
        $this->nama_penerima = $nama_penerima;
        $this->tanggal_keluar = $tanggal_keluar;
        $this->untuk_unit_id = $untuk_unit_id;
    }

    function setPengeluaran_barang_id($pengeluaran_barang_id) { $this->pengeluaran_barang_id = $pengeluaran_barang_id; }
    function getPengeluaran_barang_id() { return $this->pengeluaran_barang_id; }
    function setNo_batch($no_batch) { $this->no_batch = $no_batch; }
    function getNo_batch() { return $this->no_batch; }
    function setJumlah_pengeluaran($jumlah_pengeluaran) { $this->jumlah_pengeluaran = $jumlah_pengeluaran; }
    function getJumlah_pengeluaran() { return $this->jumlah_pengeluaran; }
    function setNama_penerima($nama_penerima) { $this->nama_penerima = $nama_penerima; }
    function getNama_penerima() { return $this->nama_penerima; }
    function setTanggal_keluar($tanggal_keluar) { $this->tanggal_keluar = $tanggal_keluar; }
    function getTanggal_keluar() { return $this->tanggal_keluar; }
    function setUntuk_unit_id($untuk_unit_id) { $this->untuk_unit_id = $untuk_unit_id; }
    function getUntuk_unit_id() { return $this->untuk_unit_id; }
    function unit($id, $nama) { 
        $unit = new Unit($id, $nama);
        return $unit->getNama_unit();
    }
    function aturanpakai($id, $nama) { 
        $aturanpakai = new AturanPakai($id, $nama);
        return $aturanpakai;
    }
}
?>