<?php 
    class Satuan{
        private $satuan_id;
        private $nama_satuan;

        function setSatuan_id($satuan_id) { $this->satuan_id = $satuan_id; }
        function getSatuan_id() { return $this->satuan_id; }
        function setNama_satuan($nama_satuan) { $this->nama_satuan = $nama_satuan; }
        function getNama_satuan() { return $this->nama_satuan; }
    }
?>