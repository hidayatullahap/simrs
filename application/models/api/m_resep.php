<?php
class m_resep extends CI_Model
{

    public function getData($nomor_transaksi, $sort, $page, $limitItemPage)
    {
        if ($nomor_transaksi == '') {
            $data = $this->db->query(
            "SELECT
            resep.resep_id AS resep_id,
            resep.nomor_transaksi AS nomor_transaksi,
            resep.barang_id AS barang_id,
            resep.aturan_pakai AS aturan_pakai,
            resep.jumlah AS jumlah,
            resep.tanggal_resep AS tanggal_resep,
            barang.nama_barang AS nama_barang,
            barang.grup_barang_id AS grup_barang_id,
            grup_barang.nama_grup_barang AS nama_grup_barang,
            barang.satuan_id AS satuan_id,
            satuan.nama_satuan AS nama_satuan,
            resep.transaksi_id AS transaksi_id,
            transaksi_obat.pasien_id AS pasien_id,
            pasien.nama AS nama_pasien,
            pasien.nomor_RM AS nomor_RM,
            pasien.jenis_pasien_id AS jenis_pasien_id,
            jenis_pasien.nama_jenis_pasien AS nama_jenis_pasien
            FROM
            resep
            INNER JOIN barang ON resep.barang_id = barang.barang_id
            INNER JOIN grup_barang ON barang.grup_barang_id = grup_barang.grup_barang_id
            INNER JOIN satuan ON barang.satuan_id = satuan.satuan_id
            INNER JOIN transaksi_obat ON resep.transaksi_id = transaksi_obat.transaksi_obat_id
            INNER JOIN pasien ON transaksi_obat.pasien_id = pasien.pasien_id
            INNER JOIN jenis_pasien ON pasien.jenis_pasien_id = jenis_pasien.jenis_pasien_id
            ORDER BY `resep`.`nomor_transaksi` 
            $sort LIMIT $page,$limitItemPage")->result();
        } else {
            $data = $this->db->query(
            "SELECT
            resep.resep_id AS resep_id,
            resep.nomor_transaksi AS nomor_transaksi,
            resep.barang_id AS barang_id,
            resep.aturan_pakai AS aturan_pakai,
            resep.jumlah AS jumlah,
            resep.tanggal_resep AS tanggal_resep,
            barang.nama_barang AS nama_barang,
            barang.grup_barang_id AS grup_barang_id,
            grup_barang.nama_grup_barang AS nama_grup_barang,
            barang.satuan_id AS satuan_id,
            satuan.nama_satuan AS nama_satuan,
            resep.transaksi_id AS transaksi_id,
            transaksi_obat.pasien_id AS pasien_id,
            pasien.nama AS nama_pasien,
            pasien.nomor_RM AS nomor_RM,
            pasien.jenis_pasien_id AS jenis_pasien_id,
            jenis_pasien.nama_jenis_pasien AS nama_jenis_pasien
            FROM
            resep
            INNER JOIN barang ON resep.barang_id = barang.barang_id
            INNER JOIN grup_barang ON barang.grup_barang_id = grup_barang.grup_barang_id
            INNER JOIN satuan ON barang.satuan_id = satuan.satuan_id
            INNER JOIN transaksi_obat ON resep.transaksi_id = transaksi_obat.transaksi_obat_id
            INNER JOIN pasien ON transaksi_obat.pasien_id = pasien.pasien_id
            INNER JOIN jenis_pasien ON pasien.jenis_pasien_id = jenis_pasien.jenis_pasien_id
            WHERE resep.nomor_transaksi = $nomor_transaksi")->result();
        }
        return $data;
    }

    public function postData($data)
    {
        $insert = $this->db->insert('resep', $data);
        return $insert;
    }
     
    public function putData($resep_id, $data)
    {
        $this->db->where('resep_id', $resep_id);
        $update = $this->db->update('resep', $data);
        return $update;
    }
    
    public function deleteData($resep_id)
    {
        $this->db->where('resep_id', $resep_id);
        $delete = $this->db->delete('resep');
        return $delete;
    }
    public function patchData($resep_id, $status)
    {
        $this->db->where('resep_id', $resep_id);
        $patch = $this->db->update('resep', $status);
        return $patch;
    }
}
