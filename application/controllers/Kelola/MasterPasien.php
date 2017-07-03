<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once CLASSES_DIR  . 'pasien.php';
require_once CLASSES_DIR  . 'mastertabel.php';
require_once CLASSES_DIR  . 'pengguna.php';
require_once CLASSES_DIR  . 'antrian.php';

class MasterPasien extends CI_Controller
{   
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('default_setting');
        $this->session->set_userdata('navbar_status', 'adminarea');
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
        $pasien = new Pasien();
        $master = new MasterTabel();

        if(!isset($page)){
            $page=1;
        }
        $title['title']="Kelola Pasien";
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
        $data['daftarJenisPasien'] = $master->getData("jenis_pasien");
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('kelola/masterpasien', $data);
        $this->load->view('footer');
    }

    public function detil($id=null)
    {   
        $pasien = new Pasien();
        //$url="pasien";
        $title['title']="Kelola Pasien";
        
        $data = $pasien->getOne($id);
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('kelola/masterpasien', $data);
        $this->load->view('footer');
    }


    public function search($search=null)
    {   
        $search = $_POST['search'];
        $pasien = new Pasien();
        $master = new MasterTabel();
        $title['title']="Kelola Pasien";
        
        $data = $pasien->searchData($search);
        $data['daftarJenisPasien'] = $master->getData("jenis_pasien");
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('kelola/masterpasien', $data);
        $this->load->view('footer');
    }
    
    public function insertData() {
        $pasien = new Pasien();
        $affectedRow = $pasien->postData();
        $this->pesan("Tambah", $affectedRow);
        redirect('kelola/masterpasien', 'refresh');
    }

    public function editData($id) {
        $pasien = new Pasien();
        $affectedRow = $pasien->editData($id);
        $this->pesan("Edit", $affectedRow);
        redirect('kelola/masterpasien', 'refresh');
    }

    public function deleteData($id) {
        $pasien = new Pasien();
        $affectedRow = $pasien->deleteData($id);
        $this->pesan("Hapus", $affectedRow);
        redirect('kelola/masterpasien', 'refresh');
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
