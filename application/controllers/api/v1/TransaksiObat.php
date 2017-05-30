<?php

require APPPATH . '/libraries/REST_Controller.php';

class TransaksiObat extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('default_setting');
        $this->load->model('api/m_transaksiobat');
    }
    
    function index_get($transaksi_obat_id = null)
    {
        if (!isset($transaksi_obat_id)) {
            $transaksi_obat_id = $this->get('id');
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

        if ($transaksi_obat_id == '') {
            $data = $this->m_transaksiobat->getData($transaksi_obat_id, $sort, $page, $limitItemPage);
        } else {
            $data = $this->m_transaksiobat->getData($transaksi_obat_id, $sort, $page, $limitItemPage);
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
            'status'            => $this->post('status'),
            'nomor_transaksi'   => $this->post('nomor_transaksi'),
            'total_tagihan'     => $this->post('total_tagihan'));
        $insert = $this->m_transaksiobat->postData($data);
        $rows = $this->db->affected_rows();
        if (!empty($insert)) {
            $this->response(array('status' => 'Created'), 201);
        } else {
            $this->response(array('status' => 'Bad Gateway'), 502);
        }
    }

    function index_put($transaksi_obat_id = null)
    {
        if (!isset($transaksi_obat_id)) {
            $transaksi_obat_id = $this->put('id');
            $data = array(
            'pasien_id'         => $this->put('pasien_id'),
            'status'            => $this->put('status'),
            'nomor_transaksi'   => $this->put('nomor_transaksi'),
            'total_tagihan'     => $this->put('total_tagihan'));
            $update = $this->m_transaksiobat->putData($transaksi_obat_id, $data);
        } else {
            $data = array(
            'pasien_id'         => $this->put('pasien_id'),
            'status'            => $this->put('status'),
            'nomor_transaksi'   => $this->put('nomor_transaksi'),
            'total_tagihan'     => $this->put('total_tagihan'));
            $update = $this->m_transaksiobat->putData($transaksi_obat_id, $data);
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

    function index_delete($transaksi_obat_id = null)
    {
        if (!isset($transaksi_obat_id)) {
            $transaksi_obat_id = $this->delete('id');
        }
        $delete = $this->m_transaksiobat->deleteData($transaksi_obat_id);
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
