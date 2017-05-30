<?php
class m_stok extends CI_Model
{

    public function cariBarang($searchQuery, $unit_id, $sort, $page, $limitItemPage)
    {
        $data = $this->db->query(
        "SELECT
        stok.stok_id AS stok_id,
        stok.barang_id AS barang_id,
        stok.unit_id AS unit_id,
        stok.jumlah AS jumlah,
        barang.nama_barang AS nama_barang,
        unit.nama_unit AS nama_unit,
        barang.grup_barang_id AS grup_barang_id,
        barang.satuan_id AS satuan_id,
        grup_barang.nama_grup_barang AS grup_barang,
        satuan.nama_satuan AS satuan,
        stok.tanggal_pencatatan AS tanggal_pencatatan
        FROM
        stok
        INNER JOIN barang ON stok.barang_id = barang.barang_id
        INNER JOIN unit ON stok.unit_id = unit.unit_id
        INNER JOIN grup_barang ON barang.grup_barang_id = grup_barang.grup_barang_id
        INNER JOIN satuan ON barang.satuan_id = satuan.satuan_id
        WHERE
        stok.unit_id = $unit_id AND
        barang.nama_barang LIKE '%$searchQuery%' AND
        stok.jumlah > 0
        ORDER BY `stok`.`stok_id` $sort LIMIT $page,$limitItemPage")
        ->result();
        return $data;
    }

    public function getData($stok_id, $sort, $page, $limitItemPage)
    {
        if ($stok_id == '') {
            $data = $this->db->query(
            "SELECT
            stok.stok_id AS stok_id,
            stok.barang_id AS barang_id,
            barang.nama_barang AS nama_barang,
            barang.grup_barang_id AS grup_barang_id,
            grup_barang.nama_grup_barang AS nama_grup_barang,
            barang.satuan_id AS satuan_id,
            satuan.nama_satuan AS nama_satuan,
            stok.unit_id AS unit_id,
            unit.nama_unit AS nama_unit,
            stok.jumlah AS jumlah,
            stok.tanggal_pencatatan AS tanggal_pencatatan
            FROM
            stok
            INNER JOIN barang ON stok.barang_id = barang.barang_id
            INNER JOIN grup_barang ON barang.grup_barang_id = grup_barang.grup_barang_id
            INNER JOIN satuan ON barang.satuan_id = satuan.satuan_id
            INNER JOIN unit ON stok.unit_id = unit.unit_id
            ORDER BY `stok`.`stok_id` 
            $sort LIMIT $page,$limitItemPage")->result();
        } else {
            $data = $this->db->query(
            "SELECT
            stok.stok_id AS stok_id,
            stok.barang_id AS barang_id,
            barang.nama_barang AS nama_barang,
            barang.grup_barang_id AS grup_barang_id,
            grup_barang.nama_grup_barang AS nama_grup_barang,
            barang.satuan_id AS satuan_id,
            satuan.nama_satuan AS nama_satuan,
            stok.unit_id AS unit_id,
            unit.nama_unit AS nama_unit,
            stok.jumlah AS jumlah,
            stok.tanggal_pencatatan AS tanggal_pencatatan
            FROM
            stok
            INNER JOIN barang ON stok.barang_id = barang.barang_id
            INNER JOIN grup_barang ON barang.grup_barang_id = grup_barang.grup_barang_id
            INNER JOIN satuan ON barang.satuan_id = satuan.satuan_id
            INNER JOIN unit ON stok.unit_id = unit.unit_id
            WHERE stok.stok_id = $stok_id")->result();
        }
        return $data;
    }

    public function postData($data)
    {
        $insert = $this->db->insert('stok', $data);
        return $insert;
    }
     
    public function putData($stok_id, $data)
    {
        $this->db->where('stok_id', $stok_id);
        $update = $this->db->update('stok', $data);
        return $update;
    }
    
    public function deleteData($stok_id)
    {
        $this->db->where('stok_id', $stok_id);
        $delete = $this->db->delete('stok');
        return $delete;
    }
}
