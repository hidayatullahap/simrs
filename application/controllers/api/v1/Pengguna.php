<?php

require APPPATH . '/libraries/REST_Controller.php';

class Pengguna extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('default_setting');
        $this->load->model('api/m_pengguna');
    }
    
    function index_get($pengguna_id = null)
    {
        if (!isset($pengguna_id)) {
            $pengguna_id = $this->get('id');
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

        if ($pengguna_id == '') {
            $data = $this->m_pengguna->getData($pengguna_id, $sort, $page, $limitItemPage);
        } else {
            $data = $this->m_pengguna->getData($pengguna_id, $sort, $page, $limitItemPage);
        }
        if (!empty($data)) {
                $this->response($data, 200);
        } else {
            $this->response(array('status' => 'Data Not Found'), 404);
        }
    }

    function index_post()
    {   
        $hashmd5 = md5($this->post('password'));
        $data = array(
            'nama'         => $this->post('nama'),
            'nip'          => $this->post('nip'),
            'username'     => $this->post('username'),
            'password'     => $hashmd5,
            'role'         => $this->post('role'));
        $insert = $this->m_pengguna->postData($data);
        $rows = $this->db->affected_rows();
        if (!empty($insert)) {
            $this->response(array('status' => 'Created'), 201);
        } else {
            $this->response(array('status' => 'Bad Gateway'), 502);
        }
    }

    function index_put($pengguna_id = null)
    {
        if (!isset($pengguna_id)) {
            $pengguna_id = $this->put('id');
            $hashmd5 = md5($this->put('password'));

            $data = array(
            'nama'         => $this->put('nama'),
            'nip'          => $this->put('nip'),
            'username'     => $this->put('username'),
            'password'     => $hashmd5,
            'role'         => $this->put('role'));
            $update = $this->m_pengguna->putData($pengguna_id, $data);
        } else {
            $hashmd5 = md5($this->put('password'));
            
            $data = array(
            'nama'         => $this->put('nama'),
            'nip'          => $this->put('nip'),
            'username'     => $this->put('username'),
            'password'     => $hashmd5,
            'role'         => $this->put('role'));
            $update = $this->m_pengguna->putData($pengguna_id, $data);
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

    function index_delete($pengguna_id = null)
    {
        if (!isset($pengguna_id)) {
            $pengguna_id = $this->delete('id');
        }
        $delete = $this->m_pengguna->deleteData($pengguna_id);
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
