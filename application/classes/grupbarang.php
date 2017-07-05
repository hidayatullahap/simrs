<?php 
    class GrupBarang{
        private $grup_barang_id;
        private $nama_grup_barang;

        function setGrup_barang_id($grup_barang_id) { $this->grup_barang_id = $grup_barang_id; }
        function getGrup_barang_id() { return $this->grup_barang_id; }
        function setNama_grup_barang($nama_grup_barang) { $this->nama_grup_barang = $nama_grup_barang; }
        function getNama_grup_barang() { return $this->nama_grup_barang; }
    }
?>