<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once CLASSES_DIR  . 'barang.php';
require_once CLASSES_DIR  . 'mastertabel.php';
require_once CLASSES_DIR  . 'pengguna.php';

class MasterBarang extends CI_Controller
{   
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('default_setting');
        $this->session->set_userdata('navbar_status', 'kelola');
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
        $barang = new Barang();
        $master = new MasterTabel();

        if(!isset($page)){
            $page=1;
        }
        $title['title']="Kelola Barang";
        $limit = $_COOKIE["pageLimit"];
        $sort = $_COOKIE["pageSort"];
        if(!isset($page)){ $page = 1; }
        if(!isset($limit)){ 
            $limit = $this->default_setting->pagination('LIMIT'); 
        }
        if(!isset($sort)){ 
            $sort = $this->default_setting->pagination('SORT'); 
        }
        $data = $barang->getData($sort, $page, $limit);
        $data['daftarGrupBarang'] = $master->getData("grup_barang");
        $data['daftarSatuan']     = $master->getData("satuan");
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('kelola/masterbarang', $data);
        $this->load->view('footer');
    }

    public function detil($id=null)
    {   
        $barang = new Barang();
        $title['title']="Kelola Barang";
        
        $data = $barang->getOne($id);
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('kelola/masterbarang', $data);
        $this->load->view('footer');
    }


    public function search($search=null)
    {   
        $search = $_POST['search'];
        $barang = new Barang();
        $title['title']="Kelola Barang";
        
        $data = $barang->searchData($search);
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('kelola/masterbarang', $data);
        $this->load->view('footer');
    }
    
    public function insertData() {
        $barang = new Barang();
        $affectedRow = $barang->postData();
        $this->pesan("Tambah", $affectedRow);
        redirect('kelola/masterbarang', 'refresh');
    }

    public function editData($id) {
        $barang = new Barang();
        $affectedRow = $barang->editData($id);
        $this->pesan("Edit", $affectedRow);
        redirect('kelola/masterbarang', 'refresh');
    }

    public function deleteData($id) {
        $barang = new Barang();
        $affectedRow = $barang->deleteData($id);
        $this->pesan("Hapus", $affectedRow);
        redirect('kelola/masterbarang', 'refresh');
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
