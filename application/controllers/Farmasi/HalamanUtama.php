<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once CLASSES_DIR  . 'pengguna.php';
require_once CLASSES_DIR  . 'pengeluaranbarang.php';
require_once CLASSES_DIR  . 'pengadaanbarang.php';
require_once CLASSES_DIR  . 'permintaanbarang.php';
require_once CLASSES_DIR  . 'stok.php';

class HalamanUtama extends CI_Controller
{   
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('default_setting');
        $this->session->set_userdata('navbar_status', 'halamanutamafarmasi');
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
        $this->load->view('/farmasi/halamanutama');
        $this->load->view('footer');
    }

    public function ajaxPermintaanMasuk(){
        $permintaan = new PermintaanBarang();
        echo $permintaan->ajaxPermintaanMasuk();
    }

    public function ajaxStokKeluar(){
        $pengeluaran = new PengeluaranBarang();
        echo $pengeluaran->ajaxStokKeluar(3);
    }

    public function ajaxStokMasuk(){
        $pengadaan = new Pengadaanbarang();
        echo $pengadaan->ajaxStokMasuk(3);
    }

    public function ajaxNearExpired(){
        $stok = new Stok();
        echo $stok->ajaxNearExpired(3);
    }

    public function ajaxRunningOutStock(){
        $stok = new Stok();
        echo $stok->ajaxRunningOutStock(3);
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
