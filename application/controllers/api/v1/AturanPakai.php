<?php

require APPPATH . '/libraries/REST_Controller.php';

class AturanPakai extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('default_setting');
        $this->load->model('api/m_aturanpakai');
    }
    
    function index_get($aturan_pakai_id = null)
    {
        if (!isset($aturan_pakai_id)) {
            $aturan_pakai_id = $this->get('id');
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

        if ($aturan_pakai_id == '') {
            $data = $this->m_aturanpakai->getData($aturan_pakai_id, $sort, $page, $limitItemPage);
        } else {
            $data = $this->m_aturanpakai->getData($aturan_pakai_id, $sort, $page, $limitItemPage);
        }
        if (!empty($data)) {
                $this->response($data, 200);
        } else {
            $this->response(array('status' => 'Data Not Found'), 404);
        }
    }

    function index_post()
    {
        $data = array('nama_aturan_pakai'=> $this->post('nama_aturan_pakai'));
        $insert = $this->m_aturanpakai->postData($data);
        if (!empty($insert)) {
            $this->response(array('status' => 'Created'), 201);
        } else {
            $this->response(array('status' => 'Bad Gateway'), 502);
        }
    }

    function index_put($aturan_pakai_id = null)
    {
        if (!isset($aturan_pakai_id)) {
            $aturan_pakai_id = $this->put('id');
            $data = array('nama_aturan_pakai'=> $this->put('nama_aturan_pakai'));
            $update = $this->m_aturanpakai->putData($aturan_pakai_id, $data);
        } else {
            $data = array('nama_aturan_pakai'=> $this->put('nama_aturan_pakai'));
            $update = $this->m_aturanpakai->putData($aturan_pakai_id, $data);
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

    function index_delete($aturan_pakai_id = null)
    {
        if (!isset($aturan_pakai_id)) {
            $aturan_pakai_id = $this->delete('id');
        }
        $delete = $this->m_aturanpakai->deleteData($aturan_pakai_id);
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
