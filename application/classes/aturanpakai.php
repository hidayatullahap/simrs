<?php 
    class AturanPakai{
        private $aturan_pakai_id;
        private $nama_aturan_pakai;
        
        public function __construct(
        $aturan_pakai_id=null, 
        $nama_aturan_pakai=null) {
            $this->aturan_pakai_id = $aturan_pakai_id;
            $this->nama_aturan_pakai = $nama_aturan_pakai;
        }

        function setAturan_pakai_id($aturan_pakai_id) { $this->aturan_pakai_id = $aturan_pakai_id; }
        function getAturan_pakai_id() { return $this->aturan_pakai_id; }
        function setNama_aturan_pakai($nama_aturan_pakai) { $this->nama_aturan_pakai = $nama_aturan_pakai; }
        function getNama_aturan_pakai() { return $this->nama_aturan_pakai; }
    }
?>