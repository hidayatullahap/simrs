<?php

require APPPATH . '/libraries/REST_Controller.php';

class Stok extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('default_setting');
        $this->load->model('api/m_stok');
    }
    
    function index_get($stok_id = null)
    {
        if (!isset($stok_id)) {
            $stok_id = $this->get('id');
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

        if ($stok_id == '') {
            $data = $this->m_stok->getData($stok_id, $sort, $page, $limitItemPage);
        } else {
            $data = $this->m_stok->getData($stok_id, $sort, $page, $limitItemPage);
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
            'barang_id' => $this->post('barang_id'),
            'unit_id'   => $this->post('unit_id'),
            'jumlah'    => $this->post('jumlah'));
        $insert = $this->m_stok->postData($data);
        $rows = $this->db->affected_rows();
        if (!empty($insert)) {
            $this->response(array('status' => 'Created'), 201);
        } else {
            $this->response(array('status' => 'Bad Gateway'), 502);
        }
    }

    function index_put($stok_id = null)
    {
        if (!isset($stok_id)) {
            $stok_id = $this->put('id');
            $data = array(
            'barang_id' => $this->put('barang_id'),
            'unit_id'   => $this->put('unit_id'),
            'jumlah'    => $this->put('jumlah'));
            $update = $this->m_stok->putData($stok_id, $data);
        } else {
            $data = array(
            'barang_id' => $this->put('barang_id'),
            'unit_id'   => $this->put('unit_id'),
            'jumlah'    => $this->put('jumlah'));
            $update = $this->m_stok->putData($stok_id, $data);
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

    function index_delete($stok_id = null)
    {
        if (!isset($stok_id)) {
            $stok_id = $this->delete('id');
        }
        $delete = $this->m_stok->deleteData($stok_id);
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
