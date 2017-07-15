<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class AntrianBerjalan extends CI_Controller
{   
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('default_setting');
        $this->load->model('penggunaModel');
        $this->load->model('masterTabelModel');
        $this->load->model('antrianModel');
        $this->session->set_userdata('navbar_status', 'antrianberjalan');
        if (!$this->penggunaModel->is_loggedin()){
            redirect('login');
        }
    }
    
    public function index()
    {   
        $this->page(1);
    }

    public function page($page=null)
    {   
        $title['title']="Antrian Berjalan";
        $limit = $_COOKIE["pageLimit"];
        $sort = $_COOKIE["pageSort"];
        if(!isset($page)){ $page = 1; }
        if(!isset($limit)){ 
            $limit = $this->default_setting->pagination('LIMIT'); 
        }
        if(!isset($sort)){ 
            $sort = $this->default_setting->pagination('SORT'); 
        }
        $data['daftarUnit'] = $this->masterTabelModel->getData("unit");
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/loket/antrianberjalan', $data);
        $this->load->view('footer');
    }

    public function search($search=null)
    {   
        $search = $_POST['search'];
        $title['title']="Antrian Berjalan";
        
        $data = $antrian->searchData($search);
        $data['daftarUnit'] = $this->masterTabelModel->getData("unit");
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/loket/antrianberjalan', $data);
        $this->load->view('footer');
    }
    
    public function insertData() {
        $affectedRow = $this->antrianModel->postData();
        $this->pesan("Tambah", $affectedRow);
        redirect('/loket/antrianberjalan', 'refresh');
    }

    public function editData($id) {
        $affectedRow = $this->antrianModel->editData($id);
        $this->pesan("Edit", $affectedRow);
        redirect('/loket/antrianberjalan', 'refresh');
    }

    public function editUnit() {
        $affectedRow = $this->antrianModel->editUnitTujuan();
        $this->pesan("Pindah unit ", $affectedRow);
        redirect('/loket/antrianberjalan', 'refresh');
    }

    public function deleteData($id) {
        $affectedRow = $this->antrianModel->deleteData($id);
        $this->pesan("Hapus", $affectedRow);
        redirect('/loket/antrianberjalan', 'refresh');
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
    
    public function ajaxAntrianBerjalan(){
        echo $this->antrianModel->ajaxAntrianHariIni();
    }
}
