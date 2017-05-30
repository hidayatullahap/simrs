<?php

require APPPATH . '/libraries/REST_Controller.php';

class AntrianBerjalan extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('default_setting');
        $this->load->model('api/m_antrianberjalan');
    }
    
    function index_get($antrian_id = null)
    {
        if (!isset($antrian_id)) {
            $antrian_id = $this->get('id');
        }
            
        $jenis_kunjungan = $this->get('jenis_kunjungan');
        $sort = $this->get('sort');
        $page = $this->get('page');
        $limitItemPage = $this->get('limit');
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

        if ($antrian_id == '') {
            $data = $this->m_antrianberjalan->getData($antrian_id, $jenis_kunjungan, $sort, $page, $limitItemPage);
        } else if($jenis_kunjungan){
            $data = $this->m_antrianberjalan->getData($antrian_id, $jenis_kunjungan, $sort, $page, $limitItemPage);
        } else {
            $data = $this->m_antrianberjalan->getData($antrian_id, $jenis_kunjungan, $sort, $page, $limitItemPage);
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
            'pasien_id'         => $this->post('pasien_id'),
            'jenis_kunjungan'   => $this->post('jenis_kunjungan'),
            'unit_id_tujuan'    => $this->post('unit_id_tujuan'),
            'status'            => $this->post('status'));
        $insert = $this->m_antrianberjalan->postData($data);
        if (!empty($insert)) {
            $this->response(array('status' => 'Created'), 201);
        } else {
            $this->response(array('status' => 'Bad Gateway'), 502);
        }
    }

    function index_put($antrian_id = null)
    {
        if (!isset($antrian_id)) {
            $antrian_id = $this->put('id');
            $data = array(
            'pasien_id'         => $this->put('pasien_id'),
            'jenis_kunjungan'   => $this->put('jenis_kunjungan'),
            'unit_id_tujuan'    => $this->put('unit_id_tujuan'),
            'status'            => $this->put('status'));
            $update = $this->m_antrianberjalan->putData($antrian_id, $data);
        } else {
            $data = array(
            'pasien_id'         => $this->put('pasien_id'),
            'jenis_kunjungan'   => $this->put('jenis_kunjungan'),
            'unit_id_tujuan'    => $this->put('unit_id_tujuan'),
            'status'            => $this->put('status'));
            $update = $this->m_antrianberjalan->putData($antrian_id, $data);
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

    function index_delete($antrian_id = null)
    {
        if (!isset($antrian_id)) {
            $antrian_id = $this->delete('antrian_id');
        }
        $delete = $this->m_antrianberjalan->deleteData($antrian_id);
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

    function index_patch($antrian_id = null, $method)
    {
        if (!isset($antrian_id)) {
            $antrian_id = $this->patch('id');
        }
        switch (strtolower($method)) {
            case 'done':
                $status = array('status'=> 'sudah_dilayani');
                break;
            case 'pending':
                $status = array('status'=> 'belum_dilayani');
                break;
            default:
                 $status = array('status'=> 'belum_dilayani');
                break;
        }
        $patch = $this->m_antrianberjalan->patchData($antrian_id, $status);
        $rows = $this->db->affected_rows();
        
        if ($patch) {
            if ($rows>0) {
                $this->response(array('status' => 'Patch Success'), 200);
            } else {
                $this->response(array('status' => 'No change or existing rows'), 204);
            }
        } else {
            $this->response(array('status' => 'Bad Gateway'), 502);
        }
    }
}
