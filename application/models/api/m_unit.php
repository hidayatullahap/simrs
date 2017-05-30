<?php
class m_unit extends CI_Model
{

    public function getData($unit_id, $sort, $page, $limitItemPage)
    {
        if ($unit_id == '') {
            $data = $this->db->query(
            "SELECT
            unit.unit_id,
            unit.nama_unit
            FROM
            unit
            ORDER BY `unit`.`unit_id` 
            $sort LIMIT $page,$limitItemPage")->result();
        } else {
            $data = $this->db->query(
            "SELECT
            unit.unit_id,
            unit.nama_unit
            FROM
            unit
            WHERE unit.unit_id = $unit_id")->result();
        }
        return $data;
    }

    public function postData($data)
    {
        $insert = $this->db->insert('unit', $data);
        return $insert;
    }
     
    public function putData($unit_id, $data)
    {
        $this->db->where('unit_id', $unit_id);
        $update = $this->db->update('unit', $data);
        return $update;
    }
    
    public function deleteData($unit_id)
    {
        $this->db->where('unit_id', $unit_id);
        $delete = $this->db->delete('unit');
        return $delete;
    }
    public function patchData($unit_id, $status)
    {
        $this->db->where('unit_id', $unit_id);
        $patch = $this->db->update('unit', $status);
        return $patch;
    }
}
