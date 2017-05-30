<?php
class m_grupbarang extends CI_Model
{

    public function getData($grup_barang_id, $sort, $page, $limitItemPage)
    {
        if ($grup_barang_id == '') {
            $data = $this->db->query(
            "SELECT * FROM grup_barang 
            ORDER BY `grup_barang`.`grup_barang_id` 
            $sort LIMIT $page,$limitItemPage")->result();
 
        } else {
            $this->db->where('grup_barang_id', $grup_barang_id);
            $data = $this->db->get('grup_barang')->result();
        }
        return $data;
    }

    public function postData($data)
    {
        $insert = $this->db->insert('grup_barang', $data);
        return $insert;
    }
     
    public function putData($grup_barang_id, $data)
    {
        $this->db->where('grup_barang_id', $grup_barang_id);
        $update = $this->db->update('grup_barang', $data);
        return $update;
    }
    
    public function deleteData($grup_barang_id)
    {
        $this->db->where('grup_barang_id', $grup_barang_id);
        $delete = $this->db->delete('grup_barang');
        return $delete;
    }
}
