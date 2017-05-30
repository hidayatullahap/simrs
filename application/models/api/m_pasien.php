<?php
class m_pasien extends CI_Model
{

    public function getData($pasien_id, $sort, $page, $limitItemPage)
    {
        if ($pasien_id == '') {
            $query = $this->db->query(
            "SELECT
            pasien.pasien_id AS pasien_id,
            pasien.nama AS nama,
            pasien.tempat_lahir AS tempat_lahir,
            pasien.tanggal_lahir AS tanggal_lahir,
            pasien.alamat AS alamat,
            pasien.jenis_kelamin AS jenis_kelamin,
            pasien.golongan_darah AS golongan_darah,
            pasien.agama AS agama,
            pasien.nomor_RM AS nomor_RM,
            pasien.jenis_pasien_id AS jenis_pasien_id,
            jenis_pasien.nama_jenis_pasien AS `jenis_pasien`,
            pasien.tanggal_daftar AS tanggal_daftar
            FROM
            pasien
            INNER JOIN jenis_pasien ON pasien.jenis_pasien_id = jenis_pasien.jenis_pasien_id
            ORDER BY `pasien`.`pasien_id` 
            $sort LIMIT $page,$limitItemPage")->result();

            $totalData = $this->db->count_all('pasien');
            $totalPages = ceil($totalData/$limitItemPage);
            $data = array("data"=>$query, "currentPage"=>$page/$limitItemPage+1, "totalPages"=>$totalPages, "totalData"=>$totalData);  
        } else {
            $this->db->where('pasien_id', $pasien_id);
            $data = $this->db->get('pasien')->result();
        }
        return $data;
    }

    public function searchData($search)
    {   
        if (!isset($search)) {
            $search ="";
        }

        $query = $this->db->query(
        "SELECT
        pasien.pasien_id AS pasien_id,
        pasien.nama AS nama,
        pasien.tempat_lahir AS tempat_lahir,
        pasien.tanggal_lahir AS tanggal_lahir,
        pasien.alamat AS alamat,
        pasien.jenis_kelamin AS jenis_kelamin,
        pasien.golongan_darah AS golongan_darah,
        pasien.agama AS agama,
        pasien.nomor_RM AS nomor_RM,
        pasien.jenis_pasien_id AS jenis_pasien_id,
        jenis_pasien.nama_jenis_pasien AS `jenis_pasien`,
        pasien.tanggal_daftar AS tanggal_daftar
        FROM
        pasien
        INNER JOIN jenis_pasien ON pasien.jenis_pasien_id = jenis_pasien.jenis_pasien_id
        WHERE
        pasien.nama LIKE '%$search%'
        ORDER BY `pasien`.`pasien_id` ASC")->result();
        $data = array("data"=>$query);  
        return $data;
    }

    public function postData($data)
    {
        $insert = $this->db->insert('pasien', $data);
        return $insert;
    }
     
    public function putData($pasien_id, $data)
    {
        $this->db->where('pasien_id', $pasien_id);
        $update = $this->db->update('pasien', $data);
        return $update;
    }
    
    public function deleteData($pasien_id)
    {
        $this->db->where('pasien_id', $pasien_id);
        $delete = $this->db->delete('pasien');
        return $delete;
    }
}
