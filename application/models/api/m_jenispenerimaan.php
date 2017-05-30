<?php
class m_jenispenerimaan extends CI_Model
{

    public function getData($jenis_penerimaan_id, $sort, $page, $limitItemPage)
    {
        if ($jenis_penerimaan_id == '') {
            $data = $this->db->query(
            "SELECT * FROM jenis_penerimaan 
            ORDER BY `jenis_penerimaan`.`jenis_penerimaan_id` 
            $sort LIMIT $page,$limitItemPage")->result();
        } else {
            $this->db->where('jenis_penerimaan_id', $jenis_penerimaan_id);
            $data = $this->db->get('jenis_penerimaan')->result();
        }
        return $data;
    }

    public function postData($data)
    {
        $insert = $this->db->insert('jenis_penerimaan', $data);
        return $insert;
    }
     
    public function putData($jenis_penerimaan_id, $data)
    {
        $this->db->where('jenis_penerimaan_id', $jenis_penerimaan_id);
        $update = $this->db->update('jenis_penerimaan', $data);
        return $update;
    }
    
    public function deleteData($jenis_penerimaan_id)
    {
        $this->db->where('jenis_penerimaan_id', $jenis_penerimaan_id);
        $delete = $this->db->delete('jenis_penerimaan');
        return $delete;
    }
}
