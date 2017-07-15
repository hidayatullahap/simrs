<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once CLASSES_DIR  . 'pengguna.php';
require_once CLASSES_DIR  . 'pengeluaranbarang.php';
require_once CLASSES_DIR  . 'pengadaanbarang.php';

class HalamanUtama extends CI_Controller
{   
    private $unit_id=4;
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('default_setting');
        $this->load->model('pengeluaranBarangModel');
        $this->load->model('pengadaanBarangModel');
        $this->load->model('penggunaModel');
        $this->session->set_userdata('navbar_status', 'halamanutamainventaris');
        if (!$this->penggunaModel->is_loggedin()){
            redirect('login');
        }
    }
    
    public function index()
    {   
        $title['title']="Dashboard";
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/inventaris/halamanutama');
        $this->load->view('footer');
    }

   public function ajaxStokKeluar(){
        echo $this->pengeluaranBarangModel->ajaxStokKeluar($this->unit_id);
    }

    public function ajaxStokMasuk(){
        echo $this->pengadaanBarangModel->ajaxStokMasuk($this->unit_id);
    }
}
