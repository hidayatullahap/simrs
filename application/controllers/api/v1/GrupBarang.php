<?php

require APPPATH . '/libraries/REST_Controller.php';

class GrupBarang extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('default_setting');
        $this->load->model('api/m_grupbarang');
    }
    
    function index_get($grup_barang_id = null)
    {
        if (!isset($grup_barang_id)) {
            $grup_barang_id = $this->get('id');
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

        if ($grup_barang_id == '') {
            $data = $this->m_grupbarang->getData($grup_barang_id, $sort, $page, $limitItemPage);
        } else {
            $data = $this->m_grupbarang->getData($grup_barang_id, $sort, $page, $limitItemPage);
        }
        if (!empty($data)) {
                $this->response($data, 200);
        } else {
            $this->response(array('status' => 'Data Not Found'), 404);
        }
    }

    function index_post()
    {
        $data = array('nama_grup_barang'=> $this->post('nama_grup_barang'));
        $insert = $this->m_grupbarang->postData($data);
        $rows = $this->db->affected_rows();
        if (!empty($insert)) {
            $this->response(array('status' => 'Created'), 201);
        } else {
            $this->response(array('status' => 'Bad Gateway'), 502);
        }
    }

    function index_put($grup_barang_id = null)
    {
        if (!isset($grup_barang_id)) {
            $grup_barang_id = $this->put('id');
            $data = array('nama_grup_barang'=> $this->put('nama_grup_barang'));
            $update = $this->m_grupbarang->putData($grup_barang_id, $data);
        } else {
            $data = array('nama_grup_barang'=> $this->put('nama_grup_barang'));
            $update = $this->m_grupbarang->putData($grup_barang_id, $data);
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

    function index_delete($grup_barang_id = null)
    {
        if (!isset($grup_barang_id)) {
            $grup_barang_id = $this->delete('id');
        }
        $delete = $this->m_grupbarang->deleteData($grup_barang_id);
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
