<?php

require APPPATH . '/libraries/REST_Controller.php';

class PengadaanBarang extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('default_setting');
        $this->load->model('api/m_pengadaanbarang');
    }
    
    function index_get($pengadaan_barang_id = null)
    {
        if (!isset($pengadaan_barang_id)) {
            $pengadaan_barang_id = $this->get('id');
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

        if ($pengadaan_barang_id == '') {
            $data = $this->m_pengadaanbarang->getData($pengadaan_barang_id, $sort, $page, $limitItemPage);
        } else {
            $data = $this->m_pengadaanbarang->getData($pengadaan_barang_id, $sort, $page, $limitItemPage);
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
            'terima_dari'           => $this->post('terima_dari'),
            'jenis_penerimaan_id'   => $this->post('jenis_penerimaan_id'),
            'no_faktur'             => $this->post('no_faktur'),
            'tanggal_faktur'        => $this->post('tanggal_faktur'),
            'keterangan'            => $this->post('keterangan'),
            'untuk_unit_id'         => $this->post('untuk_unit_id'),
            'barang_id'             => $this->post('barang_id'),
            'no_batch'              => $this->post('no_batch'),
            'tanggal_kadaluarsa'    => $this->post('tanggal_kadaluarsa'),
            'harga_jual'            => $this->post('harga_jual'),
            'harga_beli'            => $this->post('harga_beli'),
            'jumlah_barang'         => $this->post('jumlah_barang'));
        $insert = $this->m_pengadaanbarang->postData($data);
        $rows = $this->db->affected_rows();
        if (!empty($insert)) {
            $this->response(array('status' => 'Created'), 201);
        } else {
            $this->response(array('status' => 'Bad Gateway'), 502);
        }
    }

    function index_put($pengadaan_barang_id = null)
    {
        if (!isset($pengadaan_barang_id)) {
            $pengadaan_barang_id = $this->put('id');
            $data = array(
            'terima_dari'           => $this->put('terima_dari'),
            'jenis_penerimaan_id'   => $this->put('jenis_penerimaan_id'),
            'no_faktur'             => $this->put('no_faktur'),
            'tanggal_faktur'        => $this->put('tanggal_faktur'),
            'keterangan'            => $this->put('keterangan'),
            'untuk_unit_id'         => $this->put('untuk_unit_id'),
            'barang_id'             => $this->put('barang_id'),
            'no_batch'              => $this->put('no_batch'),
            'tanggal_kadaluarsa'    => $this->put('tanggal_kadaluarsa'),
            'harga_jual'            => $this->put('harga_jual'),
            'harga_beli'            => $this->put('harga_beli'),
            'jumlah_barang'         => $this->put('jumlah_barang'));
            $update = $this->m_pengadaanbarang->putData($pengadaan_barang_id, $data);
        } else {
            $data = array(
            'terima_dari'           => $this->put('terima_dari'),
            'jenis_penerimaan_id'   => $this->put('jenis_penerimaan_id'),
            'no_faktur'             => $this->put('no_faktur'),
            'tanggal_faktur'        => $this->put('tanggal_faktur'),
            'keterangan'            => $this->put('keterangan'),
            'untuk_unit_id'         => $this->put('untuk_unit_id'),
            'barang_id'             => $this->put('barang_id'),
            'no_batch'              => $this->put('no_batch'),
            'tanggal_kadaluarsa'    => $this->put('tanggal_kadaluarsa'),
            'harga_jual'            => $this->put('harga_jual'),
            'harga_beli'            => $this->put('harga_beli'),
            'jumlah_barang'         => $this->put('jumlah_barang'));
            $update = $this->m_pengadaanbarang->putData($pengadaan_barang_id, $data);
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

    function index_delete($pengadaan_barang_id = null)
    {
        if (!isset($pengadaan_barang_id)) {
            $pengadaan_barang_id = $this->delete('id');
        }
        $delete = $this->m_pengadaanbarang->deleteData($pengadaan_barang_id);
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
