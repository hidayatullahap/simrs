<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class HalamanUtama extends CI_Controller
{   
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('penggunaModel');
        $this->load->model('pengeluaranBarangModel');
        $this->load->model('pengadaanBarangModel');
        $this->load->model('permintaanBarangModel');
        $this->load->model('stokModel');
        $this->load->model('default_setting');
        $this->session->set_userdata('navbar_status', 'halamanutamafarmasi');
        if (!$this->penggunaModel->is_loggedin()){
            redirect('login');
        }
    }
    
    public function index()
    {   
        $title['title']="Dashboard";
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/farmasi/halamanutama');
        $this->load->view('footer');
    }

    public function ajaxPermintaanMasuk(){
        echo $this->permintaanBarangModel->ajaxPermintaanMasuk();
    }

    public function ajaxStokKeluar(){
        echo $this->pengeluaranBarangModel->ajaxStokKeluar(3);
    }

    public function ajaxStokMasuk(){
        echo $this->pengadaanBarangModel->ajaxStokMasuk(3);
    }

    public function ajaxNearExpired(){
        echo $this->stokModel->ajaxNearExpired(3);
    }

    public function ajaxRunningOutStock(){
        echo $this->stokModel->ajaxRunningOutStock(3);
    }

    public function test() {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');
        $namaUnit="Depo Rajal";
        $namaBarang="Parasetamol";
        //$date="2017-05-23 13:11:32";
        $md5Date=md5(strtotime($date));

        $unitKey=substr($namaUnit,0,3);
        $barangKey=substr($namaBarang,0,3);
        $yearKey=substr(date('Y', strtotime($date)),2,2);
        $md5Key=substr($md5Date,0,4);
        $key=$unitKey.$barangKey.$yearKey.$md5Key;
        echo strtoupper($key);
    }
}
