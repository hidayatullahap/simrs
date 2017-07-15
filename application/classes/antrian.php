<?php
require_once CLASSES_DIR  . 'dbconnection.php';
require_once CLASSES_DIR  . 'pasien.php';
require_once CLASSES_DIR  . 'jenispasien.php';

class Antrian{
    private $antrian_id;
    private $status;
    private $jenis_kunjungan;
    private $unit_id_tujuan;
    private $tanggal_antrian;
    private $nama_unit;
    private $is_dilayani;
    private $pasien;
    private $jenisPasien;

    public function __construct(
    $antrian_id=null, 
    $status=null,
    $jenis_kunjungan=null,
    $unit_id_tujuan=null,
    $tanggal_antrian=null,
    $nama_unit=null,
    $is_dilayani=null) {
        $this->db = new DB();
        $this->conn = $this->db->connect();
        $this->antrian_id = $antrian_id;
        $this->status = $status;
        $this->jenis_kunjungan = $jenis_kunjungan;
        $this->unit_id_tujuan = $unit_id_tujuan;
        $this->tanggal_antrian = $tanggal_antrian;
        $this->nama_unit = $nama_unit;
        $this->is_dilayani = $is_dilayani;
    }
    function setAntrian_id($antrian_id) { $this->antrian_id = $antrian_id; }
    function getAntrian_id() { return $this->antrian_id; }
    function setStatus($status) { $this->status = $status; }
    function getStatus() { return $this->status; }
    function setJenis_kunjungan($jenis_kunjungan) { $this->jenis_kunjungan = $jenis_kunjungan; }
    function getJenis_kunjungan() { return $this->jenis_kunjungan; }
    function setUnit_id_tujuan($unit_id_tujuan) { $this->unit_id_tujuan = $unit_id_tujuan; }
    function getUnit_id_tujuan() { return $this->unit_id_tujuan; }
    function setTanggal_antrian($tanggal_antrian) { $this->tanggal_antrian = $tanggal_antrian; }
    function getTanggal_antrian() { return $this->tanggal_antrian; }
    function setNama_unit($nama_unit) { $this->nama_unit = $nama_unit; }
    function getNama_unit() { return $this->nama_unit; }
    function setIs_dilayani($is_dilayani) { $this->is_dilayani = $is_dilayani; }
    function getIs_dilayani() { return $this->is_dilayani; }
}
?>