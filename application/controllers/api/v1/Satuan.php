<?php

require APPPATH . '/libraries/REST_Controller.php';

class Satuan extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('default_setting');
        $this->load->model('api/m_satuan');
    }
    
    function index_get($satuan_id = null)
    {
        if (!isset($satuan_id)) {
            $satuan_id = $this->get('id');
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

        if ($satuan_id == '') {
            $data = $this->m_satuan->getData($satuan_id, $sort, $page, $limitItemPage);
        } else {
            $data = $this->m_satuan->getData($satuan_id, $sort, $page, $limitItemPage);
        }
        if (!empty($data)) {
                $this->response($data, 200);
        } else {
            $this->response(array('status' => 'Data Not Found'), 404);
        }
    }

    function index_post()
    {   
        $data = array('nama_satuan'=> $this->post('nama_satuan'));
        $insert = $this->m_satuan->postData($data);
        $rows = $this->db->affected_rows();
        if (!empty($insert)) {
            $this->response(array('status' => 'Created'), 201);
        } else {
            $this->response(array('status' => 'Bad Gateway'), 502);
        }
    }

    function index_put($satuan_id = null)
    {
        if (!isset($satuan_id)) {
            $satuan_id = $this->put('id');
            $data = array('nama_satuan'=> $this->put('nama_satuan'));
            $update = $this->m_satuan->putData($satuan_id, $data);
        } else {
            $data = array('nama_satuan'=> $this->put('nama_satuan'));
            $update = $this->m_satuan->putData($satuan_id, $data);
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

    function index_delete($satuan_id = null)
    {
        if (!isset($satuan_id)) {
            $satuan_id = $this->delete('id');
        }
        $delete = $this->m_satuan->deleteData($satuan_id);
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
