<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class RiwayatPermintaanFarmasi extends CI_Controller
{   
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('default_setting');
        $this->load->model('penggunaModel');
        $this->load->model('permintaanBarangModel');
        $this->session->set_userdata('navbar_status', 'riwayatpermintaan');
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
        $_SESSION["tanggalAwal"]=null;
        $_SESSION["tanggalAkhir"]=null;
        $_SESSION["searchFarmasi"]=null;
        $title['title']="Riwayat Permintaan barang";
        $status = '';

        $limit = $_COOKIE["pageLimit"];
        $sort = $_COOKIE["pageSort"];

        if(!isset($page)){ $page = 1; }
        if(!isset($limit)){ $limit = $this->default_setting->pagination('LIMIT'); }
        if(!isset($sort)){ $sort = $this->default_setting->pagination('SORT');  }

        $data = $this->permintaanBarangModel->riwayatPermintaanStok($sort, $page, $limit, $status);
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/farmasi/permintaanfarmasi', $data);
        $this->load->view('footer');
    }
}