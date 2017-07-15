<?php
require_once CLASSES_DIR  . 'jenispasien.php';

class Pasien{
    private $pasien_id;
    private $nama;
    private $tempat_lahir;
    private $tanggal_lahir;
    private $alamat;
    private $jenis_kelamin;
    private $golongan_darah;
    private $agama;
    private $nomor_RM;
    private $tanggal_daftar;

    public function __construct(
    $pasien_id=null,
    $nama=null,
    $tempat_lahir=null,
    $tanggal_lahir=null,
    $alamat=null,
    $jenis_kelamin=null,
    $golongan_darah=null,
    $agama=null,
    $nomor_RM=null,
    $tanggal_daftar=null) {
        $this->pasien_id = $pasien_id;
        $this->nama = $nama;
        $this->tempat_lahir = $tempat_lahir;
        $this->tanggal_lahir = $tanggal_lahir;
        $this->alamat = $alamat;
        $this->jenis_kelamin = $jenis_kelamin;
        $this->golongan_darah = $golongan_darah;
        $this->agama = $agama;
        $this->nomor_RM = $nomor_RM;
        $this->tanggal_daftar = $tanggal_daftar;
    }
    
    function setPasien_id($pasien_id) { $this->pasien_id = $pasien_id; }
    function getPasien_id() { return $this->pasien_id; }
    function setNama($nama) { $this->nama = $nama; }
    function getNama() { return $this->nama; }
    function setTempat_lahir($tempat_lahir) { $this->tempat_lahir = $tempat_lahir; }
    function getTempat_lahir() { return $this->tempat_lahir; }
    function setTanggal_lahir($tanggal_lahir) { $this->tanggal_lahir = $tanggal_lahir; }
    function getTanggal_lahir() { return $this->tanggal_lahir; }
    function setAlamat($alamat) { $this->alamat = $alamat; }
    function getAlamat() { return $this->alamat; }
    function setJenis_kelamin($jenis_kelamin) { $this->jenis_kelamin = $jenis_kelamin; }
    function getJenis_kelamin() { return $this->jenis_kelamin; }
    function setGolongan_darah($golongan_darah) { $this->golongan_darah = $golongan_darah; }
    function getGolongan_darah() { return $this->golongan_darah; }
    function setAgama($agama) { $this->agama = $agama; }
    function getAgama() { return $this->agama; }
    function setNomor_RM($nomor_RM) { $this->nomor_RM = $nomor_RM; }
    function getNomor_RM() { return $this->nomor_RM; }
    function setTanggal_daftar($tanggal_daftar) { $this->tanggal_daftar = $tanggal_daftar; }
    function getTanggal_daftar() { return $this->tanggal_daftar; }

    function jenisPasien($id, $nama) { 
        $jenisPasien = new JenisPasien($id, $nama);
        return $jenisPasien;
    }
}
?>