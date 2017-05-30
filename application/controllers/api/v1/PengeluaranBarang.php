<?php

require APPPATH . '/libraries/REST_Controller.php';

class PengeluaranBarang extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('default_setting');
        $this->load->model('api/m_pengeluaranbarang');
    }
    
    function index_get($pengeluaran_barang_id = null)
    {
        if (!isset($pengeluaran_barang_id)) {
            $pengeluaran_barang_id = $this->get('id');
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

        if ($pengeluaran_barang_id == '') {
            $data = $this->m_pengeluaranbarang->getData($pengeluaran_barang_id, $sort, $page, $limitItemPage);
        } else {
            $data = $this->m_pengeluaranbarang->getData($pengeluaran_barang_id, $sort, $page, $limitItemPage);
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
            'untuk_unit_id'         => $this->post('untuk_unit_id'),
            'dari_unit_id'          => $this->post('dari_unit_id'),
            'barang_id'             => $this->post('barang_id'),
            'no_batch'              => $this->post('no_batch'),
            'jumlah_pengeluaran'    => $this->post('jumlah_pengeluaran'));
        $insert = $this->m_pengeluaranbarang->postData($data);
        $rows = $this->db->affected_rows();
        if (!empty($insert)) {
            $this->response(array('status' => 'Created'), 201);
        } else {
            $this->response(array('status' => 'Bad Gateway'), 502);
        }
    }

    function index_put($pengeluaran_barang_id = null)
    {
        if (!isset($pengeluaran_barang_id)) {
            $pengeluaran_barang_id = $this->put('id');
            $data = array(
            'untuk_unit_id'         => $this->put('untuk_unit_id'),
            'dari_unit_id'          => $this->put('dari_unit_id'),
            'barang_id'             => $this->put('barang_id'),
            'no_batch'              => $this->put('no_batch'),
            'jumlah_pengeluaran'    => $this->put('jumlah_pengeluaran'));
            $update = $this->m_pengeluaranbarang->putData($pengeluaran_barang_id, $data);
        } else {
            $data = array(
            'untuk_unit_id'         => $this->put('untuk_unit_id'),
            'dari_unit_id'          => $this->put('dari_unit_id'),
            'barang_id'             => $this->put('barang_id'),
            'no_batch'              => $this->put('no_batch'),
            'jumlah_pengeluaran'    => $this->put('jumlah_pengeluaran'));
            $update = $this->m_pengeluaranbarang->putData($pengeluaran_barang_id, $data);
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

    function index_delete($pengeluaran_barang_id = null)
    {
        if (!isset($pengeluaran_barang_id)) {
            $pengeluaran_barang_id = $this->delete('id');
        }
        $delete = $this->m_pengeluaranbarang->deleteData($pengeluaran_barang_id);
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
