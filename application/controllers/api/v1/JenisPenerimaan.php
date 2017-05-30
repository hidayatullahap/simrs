<?php

require APPPATH . '/libraries/REST_Controller.php';

class JenisPenerimaan extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('default_setting');
        $this->load->model('api/m_jenispenerimaan');
    }
    
    function index_get($jenis_penerimaan_id = null)
    {
        if (!isset($jenis_penerimaan_id)) {
            $jenis_penerimaan_id = $this->get('id');
        }
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

        if ($jenis_penerimaan_id == '') {
            $data = $this->m_jenispenerimaan->getData($jenis_penerimaan_id, $sort, $page, $limitItemPage);
        } else {
            $data = $this->m_jenispenerimaan->getData($jenis_penerimaan_id, $sort, $page, $limitItemPage);
        }
        if (!empty($data)) {
                $this->response($data, 200);
        } else {
            $this->response(array('status' => 'Data Not Found'), 404);
        }
    }

    function index_post()
    {
        $data = array('nama_jenis_penerimaan'=> $this->post('nama_jenis_penerimaan'));
        $insert = $this->m_jenispenerimaan->postData($data);
        $rows = $this->db->affected_rows();
        if (!empty($insert)) {
            $this->response(array('status' => 'Created'), 201);
        } else {
            $this->response(array('status' => 'Bad Gateway'), 502);
        }
    }

    function index_put($jenis_penerimaan_id = null)
    {
        if (!isset($jenis_penerimaan_id)) {
            $jenis_penerimaan_id = $this->put('id');
            $data = array('nama_jenis_penerimaan'=> $this->put('nama_jenis_penerimaan'));
            $update = $this->m_jenispenerimaan->putData($jenis_penerimaan_id, $data);
        } else {
            $data = array('nama_jenis_penerimaan'=> $this->put('nama_jenis_penerimaan'));
            $update = $this->m_jenispenerimaan->putData($jenis_penerimaan_id, $data);
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

    function index_delete($jenis_penerimaan_id = null)
    {
        if (!isset($jenis_penerimaan_id)) {
            $jenis_penerimaan_id = $this->delete('id');
        }
        $delete = $this->m_jenispenerimaan->deleteData($jenis_penerimaan_id);
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
