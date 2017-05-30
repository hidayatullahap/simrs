<?php
class m_jenispasien extends CI_Model
{

    public function getData($jenis_pasien_id, $sort, $page, $limitItemPage)
    {
        if ($jenis_pasien_id == '') {
            $data = $this->db->query(
            "SELECT * FROM jenis_pasien 
            ORDER BY `jenis_pasien`.`jenis_pasien_id` 
            $sort LIMIT $page,$limitItemPage")->result();
        } else {
            $this->db->where('jenis_pasien_id', $jenis_pasien_id);
            $data = $this->db->get('jenis_pasien')->result();
        }
        return $data;
    }

    public function postData($data)
    {
        $insert = $this->db->insert('jenis_pasien', $data);
        return $insert;
    }
     
    public function putData($jenis_pasien_id, $data)
    {
        $this->db->where('jenis_pasien_id', $jenis_pasien_id);
        $update = $this->db->update('jenis_pasien', $data);
        return $update;
    }
    
    public function deleteData($jenis_pasien_id)
    {
        $this->db->where('jenis_pasien_id', $jenis_pasien_id);
        $delete = $this->db->delete('jenis_pasien');
        return $delete;
    }
}
