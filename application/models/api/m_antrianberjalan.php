<?php
class m_antrianberjalan extends CI_Model
{

    public function getData($antrian_id, $jenis_kunjungan, $sort, $page, $limitItemPage)
    {
        if ($antrian_id) {
            $data = $this->db->query(
            "SELECT
            antrian.antrian_id AS antrian_id,
            antrian.pasien_id AS pasien_id,
            pasien.nama AS nama_pasien,
            antrian.unit_id_tujuan AS unit_id_tujuan,
            unit.nama_unit AS nama_unit,
            antrian.jenis_kunjungan AS jenis_kunjungan,
            antrian.`status` AS `status`,
            antrian.tanggal_antrian AS tanggal_antrian
            FROM
            antrian
            INNER JOIN unit ON antrian.unit_id_tujuan = unit.unit_id
            INNER JOIN pasien ON antrian.pasien_id = pasien.pasien_id
            WHERE
            antrian.antrian_id =  $antrian_id")->result();
        }
         else if($jenis_kunjungan){
            $data = $this->db->query(
            "SELECT
            antrian.antrian_id AS antrian_id,
            antrian.pasien_id AS pasien_id,
            pasien.nama AS nama_pasien,
            antrian.jenis_kunjungan AS jenis_kunjungan,
            antrian.unit_id_tujuan AS unit_id_tujuan,
            unit.nama_unit AS nama_unit,
            antrian.`status` AS `status`,
            antrian.tanggal_antrian as tanggal_antrian
            FROM
            antrian
            INNER JOIN unit ON antrian.unit_id_tujuan = unit.unit_id
            INNER JOIN pasien ON antrian.pasien_id = pasien.pasien_id
            WHEREzx
            antrian.jenis_kunjungan = '$jenis_kunjungan'
            ORDER BY `antrian`.`antrian_id` $sort LIMIT $page,$limitItemPage")
            ->result();
        } else {
            $data = $this->db->query(
            "SELECT
            antrian.antrian_id AS antrian_id,
            antrian.pasien_id AS pasien_id,
            pasien.nama AS nama_pasien,
            antrian.unit_id_tujuan AS unit_id_tujuan,
            unit.nama_unit AS nama_unit,
            antrian.jenis_kunjungan AS jenis_kunjungan,
            antrian.`status` AS `status`,
            antrian.tanggal_antrian AS tanggal_antrian
            FROM
            antrian
            INNER JOIN unit ON antrian.unit_id_tujuan = unit.unit_id
            INNER JOIN pasien ON antrian.pasien_id = pasien.pasien_id 
            ORDER BY `antrian`.`antrian_id` $sort LIMIT $page,$limitItemPage")
            ->result();
        }
        return $data;
    }

    public function postData($data)
    {
        $insert = $this->db->insert('antrian', $data);
        return $insert;
    }
     
    public function putData($antrian_id, $data)
    {
        $this->db->where('antrian_id', $antrian_id);
        $update = $this->db->update('antrian', $data);
        return $update;
    }
    
    public function deleteData($antrian_id)
    {
        $this->db->where('antrian_id', $antrian_id);
        $delete = $this->db->delete('antrian');
        return $delete;
    }
    public function patchData($antrian_id, $status)
    {
        $this->db->where('antrian_id', $antrian_id);
        $patch = $this->db->update('antrian', $status);
        return $patch;
    }
}
