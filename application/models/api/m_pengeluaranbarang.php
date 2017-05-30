<?php
class m_pengeluaranbarang extends CI_Model
{

    public function getData($pengeluaran_barang_id, $sort, $page, $limitItemPage)
    {
        if ($pengeluaran_barang_id == '') {
            $data = $this->db->query(
            "SELECT
            pengeluaran_barang.pengeluaran_barang_id AS pengeluaran_barang_id,
            pengeluaran_barang.untuk_unit_id AS untuk_unit_id,
            pengeluaran_barang.dari_unit_id AS dari_unit_id,
            pengeluaran_barang.barang_id AS barang_id,
            pengeluaran_barang.no_batch AS no_batch,
            pengeluaran_barang.jumlah_pengeluaran AS jumlah_pengeluaran,
            pengeluaran_barang.tanggal_keluar AS tanggal_keluar,
            satuan.nama_satuan AS nama_satuan,
            grup_barang.nama_grup_barang AS nama_grup_barang,
            barang.nama_barang AS nama_barang
            FROM
            pengeluaran_barang
            INNER JOIN barang ON pengeluaran_barang.barang_id = barang.barang_id
            INNER JOIN grup_barang ON barang.grup_barang_id = grup_barang.grup_barang_id
            INNER JOIN satuan ON barang.satuan_id = satuan.satuan_id
            ORDER BY `pengeluaran_barang`.`pengeluaran_barang_id` 
            $sort LIMIT $page,$limitItemPage")->result();
        } else {
            $data = $this->db->query(
            "SELECT
            pengeluaran_barang.pengeluaran_barang_id AS pengeluaran_barang_id,
            pengeluaran_barang.untuk_unit_id AS untuk_unit_id,
            pengeluaran_barang.dari_unit_id AS dari_unit_id,
            pengeluaran_barang.barang_id AS barang_id,
            pengeluaran_barang.no_batch AS no_batch,
            pengeluaran_barang.jumlah_pengeluaran AS jumlah_pengeluaran,
            pengeluaran_barang.tanggal_keluar AS tanggal_keluar,
            satuan.nama_satuan AS nama_satuan,
            grup_barang.nama_grup_barang AS nama_grup_barang,
            barang.nama_barang AS nama_barang
            FROM
            pengeluaran_barang
            INNER JOIN barang ON pengeluaran_barang.barang_id = barang.barang_id
            INNER JOIN grup_barang ON barang.grup_barang_id = grup_barang.grup_barang_id
            INNER JOIN satuan ON barang.satuan_id = satuan.satuan_id

            WHERE pengeluaran_barang.pengeluaran_barang_id = $pengeluaran_barang_id")->result();
        }
        return $data;
    }

    public function postData($data)
    {
        $insert = $this->db->insert('pengeluaran_barang', $data);
        return $insert;
    }
     
    public function putData($pengeluaran_barang_id, $data)
    {
        $this->db->where('pengeluaran_barang_id', $pengeluaran_barang_id);
        $update = $this->db->update('pengeluaran_barang', $data);
        return $update;
    }
    
    public function deleteData($pengeluaran_barang_id)
    {
        $this->db->where('pengeluaran_barang_id', $pengeluaran_barang_id);
        $delete = $this->db->delete('pengeluaran_barang');
        return $delete;
    }
}
