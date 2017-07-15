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
    
    public function __construct(
    $detil_id=null, 
    $nomor_transaksi=null,
    $aturan_pakai=null,
    $jumlah=null,
    $tanggal_resep=null) {
        $this->detil_id = $detil_id;
        $this->nomor_transaksi = $nomor_transaksi;
        $this->aturan_pakai = $aturan_pakai;
        $this->jumlah = $jumlah;
        $this->tanggal_resep = $tanggal_resep;
    }

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