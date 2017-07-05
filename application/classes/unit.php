<?php 
    class Unit{
        private $unit_id;
        private $nama_unit;

        function setUnit_id($unit_id) { $this->unit_id = $unit_id; }
        function getUnit_id() { return $this->unit_id; }
        function setNama_unit($nama_unit) { $this->nama_unit = $nama_unit; }
        function getNama_unit() { return $this->nama_unit; }

    }
?>