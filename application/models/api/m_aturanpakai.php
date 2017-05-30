<?php
class m_aturanpakai extends CI_Model
{

    public function getData($aturan_pakai_id, $sort, $page, $limitItemPage)
    {
        if ($aturan_pakai_id == '') {
            $data = $this->db->query(
            "SELECT * FROM 
            aturan_pakai_obat 
            ORDER BY `aturan_pakai_obat`.`aturan_pakai_id` 
            $sort LIMIT $page,$limitItemPage")
            ->result();
        } else {
            $this->db->where('aturan_pakai_id', $aturan_pakai_id);
            $data = $this->db->get('aturan_pakai_obat')->result();
        }
        return $data;
    }

    public function postData($data)
    {
        $insert = $this->db->insert('aturan_pakai_obat', $data);
        return $insert;
    }
     
    public function putData($aturan_pakai_id, $data)
    {
        $this->db->where('aturan_pakai_id', $aturan_pakai_id);
        $update = $this->db->update('aturan_pakai_obat', $data);
        return $update;
    }
    
    public function deleteData($aturan_pakai_id)
    {
        $this->db->where('aturan_pakai_id', $aturan_pakai_id);
        $delete = $this->db->delete('aturan_pakai_obat');
        return $delete;
    }
}
