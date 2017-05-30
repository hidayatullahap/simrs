<?php
class m_satuan extends CI_Model
{

    public function getData($satuan_id, $sort, $page, $limitItemPage)
    {
        if ($satuan_id == '') {
            $data = $this->db->query(
            "SELECT
            satuan.satuan_id,
            satuan.nama_satuan
            FROM
            satuan
            ORDER BY `satuan`.`satuan_id` 
            $sort LIMIT $page,$limitItemPage")->result();
        } else {
            $data = $this->db->query(
            "SELECT
            satuan.satuan_id,
            satuan.nama_satuan
            FROM
            satuan
            WHERE satuan.satuan_id = $satuan_id")->result();
        }
        return $data;
    }

    public function postData($data)
    {
        $insert = $this->db->insert('satuan', $data);
        return $insert;
    }
     
    public function putData($satuan_id, $data)
    {
        $this->db->where('satuan_id', $satuan_id);
        $update = $this->db->update('satuan', $data);
        return $update;
    }
    
    public function deleteData($satuan_id)
    {
        $this->db->where('satuan_id', $satuan_id);
        $delete = $this->db->delete('satuan');
        return $delete;
    }
    public function patchData($satuan_id, $status)
    {
        $this->db->where('satuan_id', $satuan_id);
        $patch = $this->db->update('satuan', $status);
        return $patch;
    }
}
