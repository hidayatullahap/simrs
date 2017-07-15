<?php 
    class JenisPenerimaan{
        private $jenis_penerimaan_id;
        private $nama_jenis_penerimaan;

        public function __construct(
        $jenis_penerimaan_id=null, 
        $nama_jenis_penerimaan=null) {
            $this->jenis_penerimaan_id = $jenis_penerimaan_id;
            $this->nama_jenis_penerimaan = $nama_jenis_penerimaan;
        }
        function setJenis_penerimaan_id($jenis_penerimaan_id) { $this->jenis_penerimaan_id = $jenis_penerimaan_id; }
        function getJenis_penerimaan_id() { return $this->jenis_penerimaan_id; }
        function setNama_jenis_penerimaan($nama_jenis_penerimaan) { $this->nama_jenis_penerimaan = $nama_jenis_penerimaan; }
        function getNama_jenis_penerimaan() { return $this->nama_jenis_penerimaan; }

    }
?>