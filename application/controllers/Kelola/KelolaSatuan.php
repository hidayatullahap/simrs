<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once CLASSES_DIR  . 'satuan.php';

class KelolaSatuan extends CI_Controller
{   
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('default_setting');
        $this->session->set_userdata('navbar_status', 'kelola');
    }
    
    public function index()
    {   
        $this->page(1);
    }

    public function page($page=null)
    {   
        $pasien = new Satuan();
        if(!isset($page)){
            $page=1;
        }
        $title['title']="Kelola Satuan";
        $limit = $_COOKIE["pageLimit"];
        $sort = $_COOKIE["pageSort"];
        if(!isset($page)){ $page = 1; }
        if(!isset($limit)){ 
            $limit = $this->default_setting->pagination('LIMIT'); 
        }
        if(!isset($sort)){ 
            $sort = $this->default_setting->pagination('SORT'); 
        }
        
        $data = $pasien->getData($sort, $page, $limit);
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/kelola/kelolasatuan', $data);
        $this->load->view('footer');
    }

    public function detil($id=null)
    {   
        $pasien = new Satuan();
        //$url="pasien";
        $title['title']="Kelola Satuan";
        
        $data = $pasien->getOne($id);
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/kelola/kelolasatuan', $data);
        $this->load->view('footer');
    }


    public function search($search=null)
    {   
        $search = $this->input->post('search');
        $pasien = new Satuan();
        $title['title']="Kelola Satuan";
        
        $data = $pasien->searchData($search);
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/kelola/kelolasatuan', $data);
        $this->load->view('footer');
    }
    
    public function insertData() {
        $pasien = new Satuan();
        $affectedRow = $pasien->postData();
        $this->pesan("Tambah", $affectedRow);
        redirect('/kelola/kelolasatuan', 'refresh');
    }

    public function editData($id) {
        $pasien = new Satuan();
        $affectedRow = $pasien->editData($id);
        $this->pesan("Edit", $affectedRow);
        redirect('/kelola/kelolasatuan', 'refresh');
    }

    public function deleteData($id) {
        $pasien = new Satuan();
        $affectedRow = $pasien->deleteData($id);
        $this->pesan("Hapus", $affectedRow);
        redirect('/kelola/kelolasatuan', 'refresh');
    }

    public function pesan($metode, $affectedRow) {
        $this->session->set_flashdata('metode', $metode);
        if ($affectedRow == 1) {

            $this->session->set_flashdata('pesan', 'berhasil');
        } elseif ($affectedRow == 0 and $metode == "ubah") {
            $this->session->set_flashdata('pesan', 'berhasil');
        } else {
            $this->session->set_flashdata('pesan', 'gagal');
        }
    }
}
