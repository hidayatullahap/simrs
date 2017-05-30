<?php

require APPPATH . '/libraries/REST_Controller.php';

class PermintaanStok extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('default_setting');
        $this->load->model('api/m_permintaanstok');
    }
    
    function index_get($permintaan_stok_id = null)
    {
        if (!isset($permintaan_stok_id)) {
            $permintaan_stok_id = $this->get('id');
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

        if ($permintaan_stok_id == '') {
            $data = $this->m_permintaanstok->getData($permintaan_stok_id, $sort, $page, $limitItemPage);
        } else {
            $data = $this->m_permintaanstok->getData($permintaan_stok_id, $sort, $page, $limitItemPage);
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
            'barang_id'             => $this->post('barang_id'),
            'dari_unit_id'          => $this->post('dari_unit_id'),
            'jumlah'                => $this->post('jumlah'),
            'status'                => $this->post('status'),
            'keterangan_tambahan'   => $this->post('keterangan_tambahan'));
        $insert = $this->m_permintaanstok->postData($data);
        $rows = $this->db->affected_rows();
        if (!empty($insert)) {
            $this->response(array('status' => 'Created'), 201);
        } else {
            $this->response(array('status' => 'Bad Gateway'), 502);
        }
    }

    function index_put($permintaan_stok_id = null)
    {
        if (!isset($permintaan_stok_id)) {
            $permintaan_stok_id = $this->put('id');
            $data = array(
            'barang_id'             => $this->put('barang_id'),
            'dari_unit_id'          => $this->put('dari_unit_id'),
            'jumlah'                => $this->put('jumlah'),
            'status'                => $this->put('status'),
            'keterangan_tambahan'   => $this->put('keterangan_tambahan'));
            $update = $this->m_permintaanstok->putData($permintaan_stok_id, $data);
        } else {
            $data = array(
            'barang_id'             => $this->put('barang_id'),
            'dari_unit_id'          => $this->put('dari_unit_id'),
            'jumlah'                => $this->put('jumlah'),
            'status'                => $this->put('status'),
            'keterangan_tambahan'   => $this->put('keterangan_tambahan'));
            $update = $this->m_permintaanstok->putData($permintaan_stok_id, $data);
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

    function index_delete($permintaan_stok_id = null)
    {
        if (!isset($permintaan_stok_id)) {
            $permintaan_stok_id = $this->delete('id');
        }
        $delete = $this->m_permintaanstok->deleteData($permintaan_stok_id);
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
    function index_patch($permintaan_stok_id = null, $method)
    {
        if (!isset($permintaan_stok_id)) {
            $permintaan_stok_id = $this->patch('id');
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
        $patch = $this->m_permintaanstok->patchData($permintaan_stok_id, $status);
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
