<?php
class m_transaksiobat extends CI_Model
{
    public function getData($transaksi_obat_id, $sort, $page, $limitItemPage)
    {
        if ($transaksi_obat_id == '') {
            $data = $this->db->query(
            "SELECT
            transaksi_obat.transaksi_obat_id AS transaksi_obat_id,
            transaksi_obat.pasien_id AS pasien_id,
            pasien.nama AS nama_pasien,
            pasien.nomor_RM AS nomor_RM,
            transaksi_obat.`status` AS `status`,
            transaksi_obat.tanggal_transaksi AS tanggal_transaksi,
            transaksi_obat.nomor_transaksi AS nomor_transaksi,
            transaksi_obat.total_tagihan AS total_tagihan
            FROM
            transaksi_obat
            INNER JOIN pasien ON transaksi_obat.pasien_id = pasien.pasien_id
            ORDER BY `transaksi_obat`.`transaksi_obat_id` 
            $sort LIMIT $page,$limitItemPage")->result();
        } else {
            $data = $this->db->query(
            "SELECT
            transaksi_obat.transaksi_obat_id AS transaksi_obat_id,
            transaksi_obat.pasien_id AS pasien_id,
            pasien.nama AS nama_pasien,
            pasien.nomor_RM AS nomor_RM,
            transaksi_obat.`status` AS `status`,
            transaksi_obat.tanggal_transaksi AS tanggal_transaksi,
            transaksi_obat.nomor_transaksi AS nomor_transaksi,
            transaksi_obat.total_tagihan AS total_tagihan
            FROM
            transaksi_obat
            WHERE transaksi_obat.transaksi_obat_id = $transaksi_obat_id")->result();
        }
        return $data;
    }

    public function postData($data)
    {
        $insert = $this->db->insert('transaksi_obat', $data);
        return $insert;
    }
     
    public function putData($transaksi_obat_id, $data)
    {
        $this->db->where('transaksi_obat_id', $transaksi_obat_id);
        $update = $this->db->update('transaksi_obat', $data);
        return $update;
    }
    
    public function deleteData($transaksi_obat_id)
    {
        $this->db->where('transaksi_obat_id', $transaksi_obat_id);
        $delete = $this->db->delete('transaksi_obat');
        return $delete;
    }
}
