<?php

require APPPATH . '/libraries/REST_Controller.php';

class CariBarang extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('default_setting');
        $this->load->model('api/m_stok');
    }
    
    function index_get()
    {
        $searchNamaBarang = $this->get('search');
        $unit_id = $this->get('unit_id');
        if (!isset($searchNamaBarang)) {
            $searchNamaBarang = '';
        }
        if (!isset($unit_id)) {
            $unit_id = 3;
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
        $data = $this->m_stok->cariBarang($searchNamaBarang, $unit_id, $sort, $page, $limitItemPage);
        if (!empty($data)) {
                $this->response($data, 200);
        } else {
            $this->response(array('status' => 'Data Not Found'), 404);
        }
    }
}
