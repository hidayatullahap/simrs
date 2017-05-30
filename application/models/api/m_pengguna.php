<?php
class m_pengguna extends CI_Model
{

    public function getData($pengguna_id, $sort, $page, $limitItemPage)
    {
        if ($pengguna_id == '') {
            $data = $this->db->query(
            "SELECT
            pengguna.pengguna_id,
            pengguna.nama,
            pengguna.nip,
            pengguna.username,
            pengguna.`password`,
            pengguna.role
            FROM
            pengguna
            ORDER BY `pengguna`.`pengguna_id` 
            $sort LIMIT $page,$limitItemPage")->result();
        } else {
            $data = $this->db->query(
            "SELECT
            pengguna.pengguna_id,
            pengguna.nama,
            pengguna.nip,
            pengguna.username,
            pengguna.`password`,
            pengguna.role
            FROM
            pengguna
            WHERE pengguna.pengguna_id = $pengguna_id")->result();
        }
        return $data;
    }

    public function postData($data)
    {
        $insert = $this->db->insert('pengguna', $data);
        return $insert;
    }
     
    public function putData($pengguna_id, $data)
    {
        $this->db->where('pengguna_id', $pengguna_id);
        $update = $this->db->update('pengguna', $data);
        return $update;
    }
    
    public function deleteData($pengguna_id)
    {
        $this->db->where('pengguna_id', $pengguna_id);
        $delete = $this->db->delete('pengguna');
        return $delete;
    }
}
