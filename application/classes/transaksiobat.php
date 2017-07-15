<?php
require_once CLASSES_DIR  . 'pasien.php';

class TransaksiObat{
    private $generatedNomorTransaksi;
    private $total_tagihan;
    private $nomor_transaksi;
    private $tanggal_transaksi;
    private $transaksi_obat_id;

    public function __construct(
    $generatedNomorTransaksi=null,
    $total_tagihan=null,
    $nomor_transaksi=null,
    $tanggal_transaksi=null,
    $transaksi_obat_id=null) {
        $this->generatedNomorTransaksi = $generatedNomorTransaksi;
        $this->total_tagihan = $total_tagihan;
        $this->nomor_transaksi = $nomor_transaksi;
        $this->tanggal_transaksi = $tanggal_transaksi;
        $this->transaksi_obat_id = $transaksi_obat_id;
    }

    function setTotal_tagihan($total_tagihan) { $this->total_tagihan = $total_tagihan; }
    function getTotal_tagihan() { return $this->total_tagihan; }
    function setNomor_transaksi($nomor_transaksi) { $this->nomor_transaksi = $nomor_transaksi; }
    function getNomor_transaksi() { return $this->nomor_transaksi; }
    function setTanggal_transaksi($tanggal_transaksi) { $this->tanggal_transaksi = $tanggal_transaksi; }
    function getTanggal_transaksi() { return $this->tanggal_transaksi; }
    function setTransaksi_obat_id($transaksi_obat_id) { $this->transaksi_obat_id = $transaksi_obat_id; }
    function getTransaksi_obat_id() { return $this->transaksi_obat_id; }

    function pasien(
    $pasien_id,
    $nama,
    $tempat_lahir,
    $tanggal_lahir,
    $alamat,
    $jenis_kelamin,
    $golongan_darah,
    $agama,
    $nomor_RM,
    $tanggal_daftar) { 
        $pasien = new Pasien(
            $pasien_id,
            $nama,
            $tempat_lahir,
            $tanggal_lahir,
            $alamat,
            $jenis_kelamin,
            $golongan_darah,
            $agama,
            $nomor_RM,
            $tanggal_daftar
            );
        return $pasien;
    }
}