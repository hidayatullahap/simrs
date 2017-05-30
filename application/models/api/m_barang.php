<?php
class m_barang extends CI_Model
{

    public function getData($barang_id, $sort, $page, $limitItemPage)
    {
        if ($barang_id == '') {
            $data = $this->db->query(
            "SELECT
            barang.barang_id AS barang_id,
            barang.nama_barang AS nama_barang,
            barang.grup_barang_id AS grup_barang_id,
            grup_barang.nama_grup_barang AS grup_barang,
            barang.satuan_id AS satuan_id,
            satuan.nama_satuan AS satuan,
            barang.tanggal_pencatatan AS tanggal_pencatatan
            FROM
            barang
            INNER JOIN grup_barang ON barang.grup_barang_id = grup_barang.grup_barang_id
            INNER JOIN satuan ON barang.satuan_id = satuan.satuan_id
            ORDER BY `barang`.`barang_id` $sort LIMIT $page, $limitItemPage")
            ->result();
        } else {
            $this->db->where('barang_id', $barang_id);
            $data = $this->db->get('barang')->result();
        }
          return $data;
    }

    public function postData($data)
    {
        $insert = $this->db->insert('barang', $data);
        return $insert;
    }
     
    public function putData($barang_id, $data)
    {
        $this->db->where('barang_id', $barang_id);
        $update = $this->db->update('barang', $data);
        return $update;
    }
    
    public function deleteData($barang_id)
    {
        $this->db->where('barang_id', $barang_id);
        $delete = $this->db->delete('barang');
        return $delete;
    }
}
