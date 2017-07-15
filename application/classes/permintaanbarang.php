<?php
require_once CLASSES_DIR  . 'barang.php';
require_once CLASSES_DIR  . 'unit.php';
require_once CLASSES_DIR  . 'satuan.php';
require_once CLASSES_DIR  . 'grupbarang.php';

class PermintaanBarang extends Barang{
    private $permintaan_stok_id;
    private $nomor_permintaan;
    private $jumlah_permintaan;
    private $jumlah_disetujui;
    private $status;
    private $tanggal_permintaan;
    private $jumlah_stok;

    public function __construct(
    $permintaan_stok_id=null,
    $nomor_permintaan=null,
    $jumlah_permintaan=null,
    $jumlah_disetujui=null,
    $status=null,
    $tanggal_permintaan=null,
    $jumlah_stok=null) {
        $this->permintaan_stok_id = $permintaan_stok_id;
        $this->nomor_permintaan = $nomor_permintaan;
        $this->jumlah_permintaan = $jumlah_permintaan;
        $this->jumlah_disetujui = $jumlah_disetujui;
        $this->status = $status;
        $this->tanggal_permintaan = $tanggal_permintaan;
        $this->jumlah_stok = $jumlah_stok;
    }
    function setPermintaan_stok_id($permintaan_stok_id) { $this->permintaan_stok_id = $permintaan_stok_id; }
    function getPermintaan_stok_id() { return $this->permintaan_stok_id; }
    function setNomor_permintaan($nomor_permintaan) { $this->nomor_permintaan = $nomor_permintaan; }
    function getNomor_permintaan() { return $this->nomor_permintaan; }
    function setJumlah_permintaan($jumlah_permintaan) { $this->jumlah_permintaan = $jumlah_permintaan; }
    function getJumlah_permintaan() { return $this->jumlah_permintaan; }
    function setJumlah_disetujui($jumlah_disetujui) { $this->jumlah_disetujui = $jumlah_disetujui; }
    function getJumlah_disetujui() { return $this->jumlah_disetujui; }
    function setStatus($status) { $this->status = $status; }
    function getStatus() { return $this->status; }
    function setTanggal_permintaan($tanggal_permintaan) { $this->tanggal_permintaan = $tanggal_permintaan; }
    function getTanggal_permintaan() { return $this->tanggal_permintaan; }
    function setJumlah_stok($jumlah_stok) { $this->jumlah_stok = $jumlah_stok; }
    function getJumlah_stok() { return $this->jumlah_stok; }
    function unit($id, $nama) { 
        $unit = new Unit($id, $nama);
        return $unit->getNama_unit();
    }
}
?>