<?php

require APPPATH . '/libraries/REST_Controller.php';

class Resep extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('default_setting');
        $this->load->model('api/m_resep');
    }
    
    function index_get($resep_id = null)
    {
        if (!isset($resep_id)) {
            $resep_id = $this->get('id');
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

        if ($resep_id == '') {
            $data = $this->m_resep->getData($resep_id, $sort, $page, $limitItemPage);
        } else {
            $data = $this->m_resep->getData($resep_id, $sort, $page, $limitItemPage);
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
            'nomor_transaksi'   => $this->post('nomor_transaksi'),
            'barang_id'         => $this->post('barang_id'),
            'aturan_pakai'      => $this->post('aturan_pakai'),
            'jumlah'            => $this->post('jumlah'));
        $insert = $this->m_resep->postData($data);
        $rows = $this->db->affected_rows();
        if (!empty($insert)) {
            $this->response(array('status' => 'Created'), 201);
        } else {
            $this->response(array('status' => 'Bad Gateway'), 502);
        }
    }

    function index_put($resep_id = null)
    {
        if (!isset($resep_id)) {
            $resep_id = $this->put('id');
            $data = array(
            'nomor_transaksi'   => $this->put('nomor_transaksi'),
            'barang_id'         => $this->put('barang_id'),
            'aturan_pakai'      => $this->put('aturan_pakai'),
            'jumlah'            => $this->put('jumlah'));
            $update = $this->m_resep->putData($resep_id, $data);
        } else {
            $data = array(
            'nomor_transaksi'   => $this->put('nomor_transaksi'),
            'barang_id'         => $this->put('barang_id'),
            'aturan_pakai'      => $this->put('aturan_pakai'),
            'jumlah'            => $this->put('jumlah'));
            $update = $this->m_resep->putData($resep_id, $data);
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

    function index_delete($resep_id = null)
    {
        if (!isset($resep_id)) {
            $resep_id = $this->delete('id');
        }
        $delete = $this->m_resep->deleteData($resep_id);
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
    function index_patch($resep_id = null, $method)
    {
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
        $patch = $this->m_resep->patchData($resep_id, $status);
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
