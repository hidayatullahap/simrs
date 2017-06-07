<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once CLASSES_DIR  . 'antrian.php';
require_once CLASSES_DIR  . 'pengguna.php';
require_once CLASSES_DIR  . 'Antrian.php';
require_once CLASSES_DIR  . 'mastertabel.php';

class AntrianBerjalan extends CI_Controller
{   
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('default_setting');
        $this->session->set_userdata('navbar_status', 'antrianberjalan');
        $pengguna = new Pengguna();
        if (!$pengguna->is_loggedin()){
            redirect('login');
        }
    }
    
    public function index()
    {   
        $this->page(1);
    }

    public function page($page=null)
    {   
        $antrian = new Antrian();
        $master = new MasterTabel();

        if(!isset($page)){
            $page=1;
        }
        $title['title']="Kelola Antrian";
        $limit = $_COOKIE["pageLimit"];
        $sort = $_COOKIE["pageSort"];
        if(!isset($page)){ $page = 1; }
        if(!isset($limit)){ 
            $limit = $this->default_setting->pagination('LIMIT'); 
        }
        if(!isset($sort)){ 
            $sort = $this->default_setting->pagination('SORT'); 
        }
        $data = $antrian->AntrianHariIni($sort, $page, $limit);
        $data['daftarJenisPasien'] = $master->getData("jenis_pasien");
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/loket/antrianberjalan', $data);
        $this->load->view('footer');
    }

    public function search($search=null)
    {   
        $search = $_POST['search'];
        $antrian = new Antrian();
        $title['title']="Kelola Antrian";
        
        $data = $antrian->searchData($search);
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/loket/antrianberjalan', $data);
        $this->load->view('footer');
    }
    
    public function insertData() {
        $antrian = new Antrian();
        $affectedRow = $antrian->postData();
        $this->pesan("Tambah", $affectedRow);
        redirect('/loket/antrianberjalan', 'refresh');
    }

    public function editData($id) {
        $antrian = new Antrian();
        $affectedRow = $antrian->editData($id);
        $this->pesan("Edit", $affectedRow);
        redirect('/loket/antrianberjalan', 'refresh');
    }

    public function deleteData($id) {
        $antrian = new Antrian();
        $affectedRow = $antrian->deleteData($id);
        $this->pesan("Hapus", $affectedRow);
        redirect('/loket/antrianberjalan', 'refresh');
    }

    public function test()
    {   
        $data = $this->m_kelolapasien->getData();
        var_dump($data);
        echo "<br><br><br><br><br><br>";
        $this->load->view('/tests/testDumpKelolaPasien', $data);
    }

    public function testantrian()
    {   
        $limit = $_COOKIE["pageLimit"];
        $sort = $_COOKIE["pageSort"];
        if(!isset($page)){ $page = 1; }
        if(!isset($limit)){ 
            $limit = $this->default_setting->pagination('LIMIT'); 
        }
        if(!isset($sort)){ 
            $sort = $this->default_setting->pagination('SORT'); 
        }
        $antrian = new Antrian();
        $test=$antrian->AntrianHariIni($sort, $page, $limit);
        var_dump($test);
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
