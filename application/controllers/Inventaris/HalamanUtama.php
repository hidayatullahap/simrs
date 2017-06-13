<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once CLASSES_DIR  . 'pengguna.php';
require_once CLASSES_DIR  . 'gudang.php';

class HalamanUtama extends CI_Controller
{   
    private $unit_id=4;
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('default_setting');
        $this->session->set_userdata('navbar_status', 'halamanutamainventaris');
        $pengguna = new Pengguna();
        if (!$pengguna->is_loggedin()){
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

    public function ajaxPermintaanMasuk(){
        $gudang = new Gudang();
        echo $gudang->ajaxPermintaanMasuk();
    }

    public function ajaxStokKeluar(){
        $gudang = new Gudang();
        echo $gudang->ajaxStokKeluar($this->unit_id);
    }

    public function ajaxStokMasuk(){
        $gudang = new Gudang();
        echo $gudang->ajaxStokMasuk($this->unit_id);
    }
}
