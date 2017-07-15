<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class CariBarang extends CI_Controller
{   
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('default_setting');
        $this->load->model('penggunaModel');
        $this->load->model('barangModel');
        if (!$this->penggunaModel->is_loggedin()){
            redirect('login');
        }
    }
    
    public function index()
    {   
        $this->page(1);
    }

    public function page($page)
    {       
        $this->session->set_userdata('navbar_status', 'caribarang');
        $unit_id=null; 
        $barang_id=null;
        
        $title['title']="Cari Barang";

        $limit = $_COOKIE["pageLimit"];
        $sort = $_COOKIE["pageSort"];

        if(!isset($page)){ $page = 1; }
        if(!isset($limit)){ $limit = $this->default_setting->pagination('LIMIT'); }
        if(!isset($sort)){ $sort = $this->default_setting->pagination('SORT');  }
        
        $data = $this->barangModel->getStok($sort, $page, $limit);
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/inventaris/caribarang', $data);
        $this->load->view('footer');
    }
}