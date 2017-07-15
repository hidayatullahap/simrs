<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class LayananPasien extends CI_Controller
{   
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('default_setting');
        $this->load->model('antrianModel');
        $this->load->model('penggunaModel');
        $this->load->model('pasienModel');
        $this->load->model('masterTabelModel');
        $this->session->set_userdata('navbar_status', 'daftarpasien');
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
        $title['title']="Layanan Pasien";
        $limit = $_COOKIE["pageLimit"];
        $sort = $_COOKIE["pageSort"];
        if(!isset($page)){ $page = 1; }
        if(!isset($limit)){ 
            $limit = $this->default_setting->pagination('LIMIT'); 
        }
        if(!isset($sort)){ 
            $sort = $this->default_setting->pagination('SORT'); 
        }
        $data = $this->antrianModel->getPasienWithStatus($sort, $page, $limit);
        $data['daftarUnit'] = $this->masterTabelModel->getData("unit");
        $data['daftarJenisPasien'] = $this->masterTabelModel->getData("jenis_pasien");
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/loket/layananpasien', $data);
        $this->load->view('footer');
    }

    public function detil($id=null)
    {   
        $title['title']="Layanan Pasien";
        
        $data = $this->pasienModel->getOne($id);
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/loket/layananpasien', $data);
        $this->load->view('footer');
    }


    public function search($search=null)
    {   
        $search = $_POST['search'];
        $title['title']="Layanan Pasien";
        
        $data = $this->antrianModel->searchPasienWithStatus($search);
        $data['daftarUnit'] = $this->masterTabelModel->getData("unit");
        $data['daftarJenisPasien'] = $this->masterTabelModel->getData("jenis_pasien");
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/loket/layananpasien', $data);
        $this->load->view('footer');
    }
    
    public function insertData() {
        $affectedRow = $this->pasienModel->postData();
        $this->pesan("Tambah", $affectedRow);
        redirect('/loket/layananpasien', 'refresh');
    }

    public function editData($id) {
        $affectedRow = $this->pasienModel->editData($id);
        $this->pesan("Edit", $affectedRow);
        redirect('/loket/layananpasien', 'refresh');
    }

    public function kunjungan() {
        $affectedRow = $this->antrianModel->kunjungan();
        $this->pesan("Layanan ", $affectedRow);
        redirect('/loket/layananpasien', 'refresh');
    }

    public function deleteData($id) {
        $affectedRow = $this->pasienModel->deleteData($id);
        $this->pesan("Hapus", $affectedRow);
        redirect('/loket/layananpasien', 'refresh');
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
