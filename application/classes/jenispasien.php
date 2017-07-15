<?php 
    class JenisPasien{
        private $jenis_pasien_id;
        private $nama_jenis_pasien;

        public function __construct(
        $jenis_pasien_id=null, 
        $nama_jenis_pasien=null) {
            $this->jenis_pasien_id = $jenis_pasien_id;
            $this->nama_jenis_pasien = $nama_jenis_pasien;
        }
        function setJenis_pasien_id($jenis_pasien_id) { $this->jenis_pasien_id = $jenis_pasien_id; }
        function getJenis_pasien_id() { return $this->jenis_pasien_id; }
        function setNama_jenis_pasien($nama_jenis_pasien) { $this->nama_jenis_pasien = $nama_jenis_pasien; }
        function getNama_jenis_pasien() { return $this->nama_jenis_pasien; }
    }
?>