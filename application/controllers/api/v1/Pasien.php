<?php

require APPPATH . '/libraries/REST_Controller.php';

class Pasien extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('default_setting');
        $this->load->model('api/m_pasien');
    }
    
    function index_get($pasien_id = null)
    {
        if (!isset($pasien_id)) {
            $pasien_id = $this->get('id');
        }
        $sort = $this->get('sort');
        $page = $this->get('page');
        $limitItemPage = $this->get('limit');
        $search = $this->get('search');

        if (!isset($limitItemPage)) {
            $limitItemPage = $this->default_setting->pagination('LIMIT');
        }
        if (!isset($page)) {
            $page = $this->default_setting->pagination('PAGE');
        }
        if (!isset($sort)) {
            $sort = $this->default_setting->pagination('SORT');
        }
        $page=($page*$limitItemPage)-$limitItemPage;
        if (isset($pasien_id)) {
            $data = $this->m_pasien->getData($pasien_id, $sort, $page, $limitItemPage);
        }else if(isset($search)){
            $data = $this->m_pasien->searchData($search);
        }else{
            $data = $this->m_pasien->getData($pasien_id, $sort, $page, $limitItemPage);
        }
        if (!empty($data)) {
                $this->response($data, 200);
        } else {
            $this->response(array('status' => 'Data Not Found'), 404);
        }
    }

    function index_post()
    {
        $data = array(
            'nama'                  => $this->post('nama'),
            'tempat_lahir'          => $this->post('tempat_lahir'),
            'tanggal_lahir'         => $this->post('tanggal_lahir'),
            'alamat'                => $this->post('alamat'),
            'jenis_kelamin'         => $this->post('jenis_kelamin'),
            'golongan_darah'        => $this->post('golongan_darah'),
            'agama'                 => $this->post('agama'),
            'nomor_RM'              => $this->post('nomor_RM'),
            'jenis_pasien_id'       => $this->post('jenis_pasien_id'));
        $insert = $this->m_pasien->postData($data);
        $rows = $this->db->affected_rows();
        if (!empty($insert)) {
            $this->response(array('status' => 'Created'), 201);
        } else {
            $this->response(array('status' => 'Bad Gateway'), 502);
        }
    }

    function index_put($pasien_id = null)
    {
        if (!isset($pasien_id)) {
            $pasien_id = $this->put('id');
            $data = array(
            'nama'                  => $this->put('nama'),
            'tempat_lahir'          => $this->put('tempat_lahir'),
            'tanggal_lahir'         => $this->put('tanggal_lahir'),
            'alamat'                => $this->put('alamat'),
            'jenis_kelamin'         => $this->put('jenis_kelamin'),
            'golongan_darah'        => $this->put('golongan_darah'),
            'agama'                 => $this->put('agama'),
            'nomor_RM'              => $this->put('nomor_RM'),
            'jenis_pasien_id'       => $this->put('jenis_pasien_id'));
            $update = $this->m_pasien->putData($pasien_id, $data);
        } else {
            $data = array(
            'nama'                  => $this->put('nama'),
            'tempat_lahir'          => $this->put('tempat_lahir'),
            'tanggal_lahir'         => $this->put('tanggal_lahir'),
            'alamat'                => $this->put('alamat'),
            'jenis_kelamin'         => $this->put('jenis_kelamin'),
            'golongan_darah'        => $this->post('golongan_darah'),
            'agama'                 => $this->put('agama'),
            'nomor_RM'              => $this->put('nomor_RM'),
            'jenis_pasien_id'       => $this->put('jenis_pasien_id'));
            $update = $this->m_pasien->putData($pasien_id, $data);
        }
        $rows = $this->db->affected_rows();
        if ($update) {
            if ($rows>0) {
                $this->response(array('status' => 'Data Updated'), 200);
            } else {
                $this->response(array('status' => 'No change or existing rows'), 204);
            }
        } else {
            $this->response(array('status' => 'Bad Gateway'), 502);
        }
    }

    function index_delete($pasien_id = null)
    {
        if (!isset($pasien_id)) {
            $pasien_id = $this->delete('id');
        }
        $delete = $this->m_pasien->deleteData($pasien_id);
        $rows = $this->db->affected_rows();

        if ($delete) {
            if ($rows>0) {
                $this->response(array('status' => 'Delete Success'), 200);
            } else {
                $this->response(array('status' => 'No existing rows'), 204);
            }
        } else {
            $this->response(array('status' => 'Bad Gateway'), 502);
        }
    }
}
