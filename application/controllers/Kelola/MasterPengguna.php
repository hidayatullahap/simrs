<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class MasterPengguna extends CI_Controller
{   
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('default_setting');
        $this->load->model('penggunaModel');
        $this->session->set_userdata('navbar_status', 'adminarea');
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
        

        if(!isset($page)){
            $page=1;
        }
        $title['title']="Kelola Pengguna";
        $limit = $_COOKIE["pageLimit"];
        $sort = $_COOKIE["pageSort"];
        if(!isset($page)){ $page = 1; }
        if(!isset($limit)){ 
            $limit = $this->default_setting->pagination('LIMIT'); 
        }
        if(!isset($sort)){ 
            $sort = $this->default_setting->pagination('SORT'); 
        }
        $data = $this->penggunaModel->getData($sort, $page, $limit);
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('kelola/masterpengguna', $data);
        $this->load->view('footer');
    }

    public function detil($id=null)
    {   
        
        $title['title']="Kelola Pengguna";
        
        $data = $this->penggunaModel->getOne($id);
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('kelola/masterpengguna', $data);
        $this->load->view('footer');
    }


    public function search($search=null)
    {   
        $search = $_POST['search'];
        
        $title['title']="Kelola Pengguna";
        
        $data = $this->penggunaModel->searchData($search);
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('kelola/masterpengguna', $data);
        $this->load->view('footer');
    }
    
    public function insertData() {
        
        $affectedRow = $this->penggunaModel->postData();
        $this->pesan("Tambah", $affectedRow);
        redirect('kelola/masterpengguna', 'refresh');
    }

    public function editData($id) {
        
        $affectedRow = $this->penggunaModel->editData($id);
        $this->pesan("Edit", $affectedRow);
        redirect('kelola/masterpengguna', 'refresh');
    }

    public function deleteData($id) {
        
        $affectedRow = $this->penggunaModel->deleteData($id);
        $this->pesan("Hapus", $affectedRow);
        redirect('kelola/masterpengguna', 'refresh');
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
