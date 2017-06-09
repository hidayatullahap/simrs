<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once CLASSES_DIR  . 'antrian.php';
require_once CLASSES_DIR  . 'pengguna.php';
require_once CLASSES_DIR  . 'pasien.php';
require_once CLASSES_DIR  . 'mastertabel.php';

class HalamanUtama extends CI_Controller
{   
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('default_setting');
        $this->session->set_userdata('navbar_status', 'daftarpasien');
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
        $data = $antrian->getPasienWithStatus($sort, $page, $limit);
        $data['daftarUnit'] = $master->getData("unit");
        $data['daftarJenisPasien'] = $master->getData("jenis_pasien");
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/farmasi/halamanutama', $data);
        $this->load->view('footer');
    }

    public function detil($id=null)
    {   
        $pasien = new Pasien();
        $title['title']="Layanan Pasien";
        
        $data = $pasien->getOne($id);
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/farmasi/halamanutama', $data);
        $this->load->view('footer');
    }


    public function search($search=null)
    {   
        $search = $_POST['search'];
        $antrian = new Antrian();
        $master = new MasterTabel();
        $title['title']="Layanan Pasien";
        
        $data = $antrian->searchPasienWithStatus($search);
        $data['daftarUnit'] = $master->getData("unit");
        $data['daftarJenisPasien'] = $master->getData("jenis_pasien");
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/farmasi/halamanutama', $data);
        $this->load->view('footer');
    }
    
    public function insertData() {
        $pasien = new Pasien();
        $affectedRow = $pasien->postData();
        $this->pesan("Tambah", $affectedRow);
        redirect('/farmasi/halamanutama', 'refresh');
    }

    public function editData($id) {
        $pasien = new Pasien();
        $affectedRow = $pasien->editData($id);
        $this->pesan("Edit", $affectedRow);
        redirect('/farmasi/halamanutama', 'refresh');
    }

    public function kunjungan() {
        $antrian = new Antrian();
        $affectedRow = $antrian->kunjungan();
        $this->pesan("Layanan ", $affectedRow);
        redirect('/farmasi/halamanutama', 'refresh');
    }

    public function deleteData($id) {
        $pasien = new Pasien();
        $affectedRow = $pasien->deleteData($id);
        $this->pesan("Hapus", $affectedRow);
        redirect('/farmasi/halamanutama', 'refresh');
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
