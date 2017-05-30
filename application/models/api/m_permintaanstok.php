<?php
class m_permintaanstok extends CI_Model
{

    public function getData($permintaan_stok_id, $sort, $page, $limitItemPage)
    {
        if ($permintaan_stok_id == '') {
            $data = $this->db->query(
            "SELECT
            permintaan_stok.permintaan_stok_id AS permintaan_stok_id,
            permintaan_stok.barang_id AS barang_id,
            barang.nama_barang AS nama_barang,
            permintaan_stok.dari_unit_id AS dari_unit_id,
            unit.nama_unit AS nama_unit,
            permintaan_stok.jumlah AS jumlah,
            permintaan_stok.`status` AS `status`,
            permintaan_stok.keterangan_tambahan AS keterangan_tambahan,
            permintaan_stok.tanggal_permintaan AS tanggal_permintaan,
            barang.grup_barang_id AS grup_barang_id,
            grup_barang.nama_grup_barang AS nama_grup_barang
            FROM
            permintaan_stok
            INNER JOIN barang ON permintaan_stok.barang_id = barang.barang_id
            INNER JOIN grup_barang ON barang.grup_barang_id = grup_barang.grup_barang_id
            INNER JOIN unit ON permintaan_stok.dari_unit_id = unit.unit_id
            ORDER BY `permintaan_stok`.`permintaan_stok_id` 
            $sort LIMIT $page,$limitItemPage")->result();
        } else {
            $data = $this->db->query(
            "SELECT
            permintaan_stok.permintaan_stok_id AS permintaan_stok_id,
            permintaan_stok.barang_id AS barang_id,
            barang.nama_barang AS nama_barang,
            permintaan_stok.dari_unit_id AS dari_unit_id,
            unit.nama_unit AS nama_unit,
            permintaan_stok.jumlah AS jumlah,
            permintaan_stok.`status` AS `status`,
            permintaan_stok.keterangan_tambahan AS keterangan_tambahan,
            permintaan_stok.tanggal_permintaan AS tanggal_permintaan,
            barang.grup_barang_id AS grup_barang_id,
            grup_barang.nama_grup_barang AS nama_grup_barang
            FROM
            permintaan_stok
            INNER JOIN barang ON permintaan_stok.barang_id = barang.barang_id
            INNER JOIN grup_barang ON barang.grup_barang_id = grup_barang.grup_barang_id
            INNER JOIN unit ON permintaan_stok.dari_unit_id = unit.unit_id
            WHERE permintaan_stok.permintaan_stok_id = $permintaan_stok_id")->result();
        }
        return $data;
    }

    public function postData($data)
    {
        $insert = $this->db->insert('permintaan_stok', $data);
        return $insert;
    }
     
    public function putData($permintaan_stok_id, $data)
    {
        $this->db->where('permintaan_stok_id', $permintaan_stok_id);
        $update = $this->db->update('permintaan_stok', $data);
        return $update;
    }
    
    public function deleteData($permintaan_stok_id)
    {
        $this->db->where('permintaan_stok_id', $permintaan_stok_id);
        $delete = $this->db->delete('permintaan_stok');
        return $delete;
    }
    public function patchData($permintaan_stok_id, $status)
    {
        $this->db->where('permintaan_stok_id', $permintaan_stok_id);
        $patch = $this->db->update('permintaan_stok', $status);
        return $patch;
    }
}
