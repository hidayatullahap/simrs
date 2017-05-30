<?php
class m_pengadaanbarang extends CI_Model
{

    public function getData($pengadaan_barang_id, $sort, $page, $limitItemPage)
    {
        if ($pengadaan_barang_id) {
            $data = $this->db->query(
            "SELECT
            pengadaan_barang.pengadaan_barang_id AS pengadaan_barang_id,
            pengadaan_barang.terima_dari AS terima_dari,
            pengadaan_barang.jenis_penerimaan_id AS jenis_penerimaan_id,
            jenis_penerimaan.nama_jenis_penerimaan AS nama_jenis_penerimaan,
            pengadaan_barang.no_faktur AS no_faktur,
            pengadaan_barang.tanggal_faktur AS tanggal_faktur,
            pengadaan_barang.keterangan AS keterangan,
            pengadaan_barang.untuk_unit_id AS untuk_unit_id,
            unit.nama_unit AS nama_unit,
            pengadaan_barang.barang_id AS barang_id,
            barang.nama_barang AS nama_barang,
            pengadaan_barang.no_batch AS no_batch,
            pengadaan_barang.tanggal_kadaluarsa AS tanggal_kadaluarasa,
            pengadaan_barang.harga_jual AS harga_jual,
            pengadaan_barang.harga_beli AS harga_beli,
            pengadaan_barang.jumlah_barang AS jumlah_barang,
            pengadaan_barang.tanggal_masuk AS tanggal_masuk,
            barang.grup_barang_id AS grup_barang_id,
            grup_barang.nama_grup_barang AS nama_grup_barang,
            satuan.nama_satuan AS nama_satuan
            FROM
            pengadaan_barang
            INNER JOIN unit ON pengadaan_barang.untuk_unit_id = unit.unit_id
            INNER JOIN barang ON pengadaan_barang.barang_id = barang.barang_id
            INNER JOIN jenis_penerimaan ON pengadaan_barang.jenis_penerimaan_id = jenis_penerimaan.jenis_penerimaan_id
            INNER JOIN grup_barang ON barang.grup_barang_id = grup_barang.grup_barang_id
            INNER JOIN satuan ON barang.satuan_id = satuan.satuan_id
            WHERE pengadaan_barang_id = $pengadaan_barang_id")->result();
        } else {
             $data = $this->db->query(
            "SELECT
            pengadaan_barang.pengadaan_barang_id AS pengadaan_barang_id,
            pengadaan_barang.terima_dari AS terima_dari,
            pengadaan_barang.jenis_penerimaan_id AS jenis_penerimaan_id,
            jenis_penerimaan.nama_jenis_penerimaan AS nama_jenis_penerimaan,
            pengadaan_barang.no_faktur AS no_faktur,
            pengadaan_barang.tanggal_faktur AS tanggal_faktur,
            pengadaan_barang.keterangan AS keterangan,
            pengadaan_barang.untuk_unit_id AS untuk_unit_id,
            unit.nama_unit AS nama_unit,
            pengadaan_barang.barang_id AS barang_id,
            barang.nama_barang AS nama_barang,
            pengadaan_barang.no_batch AS no_batch,
            pengadaan_barang.tanggal_kadaluarsa AS tanggal_kadaluarasa,
            pengadaan_barang.harga_jual AS harga_jual,
            pengadaan_barang.harga_beli AS harga_beli,
            pengadaan_barang.jumlah_barang AS jumlah_barang,
            pengadaan_barang.tanggal_masuk AS tanggal_masuk,
            barang.grup_barang_id AS grup_barang_id,
            grup_barang.nama_grup_barang AS nama_grup_barang,
            satuan.nama_satuan AS nama_satuan
            FROM
            pengadaan_barang
            INNER JOIN unit ON pengadaan_barang.untuk_unit_id = unit.unit_id
            INNER JOIN barang ON pengadaan_barang.barang_id = barang.barang_id
            INNER JOIN jenis_penerimaan ON pengadaan_barang.jenis_penerimaan_id = jenis_penerimaan.jenis_penerimaan_id
            INNER JOIN grup_barang ON barang.grup_barang_id = grup_barang.grup_barang_id
            INNER JOIN satuan ON barang.satuan_id = satuan.satuan_id
            ORDER BY `pengadaan_barang`.`pengadaan_barang_id` 
            $sort LIMIT $page,$limitItemPage")->result();
        }
        return $data;
    }

    public function postData($data)
    {
        $insert = $this->db->insert('pengadaan_barang', $data);
        return $insert;
    }
     
    public function putData($pengadaan_barang_id, $data)
    {
        $this->db->where('pengadaan_barang_id', $pengadaan_barang_id);
        $update = $this->db->update('pengadaan_barang', $data);
        return $update;
    }
    
    public function deleteData($pengadaan_barang_id)
    {
        $this->db->where('pengadaan_barang_id', $pengadaan_barang_id);
        $delete = $this->db->delete('pengadaan_barang');
        return $delete;
    }
}
