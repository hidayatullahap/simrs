<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Pengeluaran extends CI_Controller
{   
    private $unit_id=4;
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('default_setting');
        $this->load->model('pengeluaranBarangModel');
        $this->load->model('penggunaModel');
        $this->load->model('barangModel');
        $this->load->model('masterTabelModel');
        
        $this->session->set_userdata('navbar_status', 'pengeluaraninventaris');
        if (!$this->penggunaModel->is_loggedin()){
            redirect('login');
        }
    }

    public function index()
    {   
        $_SESSION["tanggalAwal"]=null;
        $_SESSION["tanggalAkhir"]=null;
        $_SESSION["searchFarmasi"]=null;
        $this->page(1);
    }

    public function tambahPengeluaranStok(){
        if( $this->input->post('batal') )
        {
            redirect('/inventaris/pengeluaran', 'refresh');

        } else if( $this->input->post('simpan') ){
            $return = $this->pengeluaranBarangModel->prosesPengeluaranStok($this->unit_id);
            if($return==false){
                    $this->pesan("Tabel tidak boleh kosong", $return);
                    redirect('/inventaris/pengeluaran', 'refresh');
                }else if($return==true){
                    $this->pesan("Pengeluaran barang berhasil", $return);
                    redirect('/inventaris/pengeluaran', 'refresh');
                }else{
                    $this->pesan("Error server", $return);
                    redirect('/inventaris/pengeluaran', 'refresh');
            }
        }
    }
    public function page($page)
    {   
        $title['title']="Riwayat Barang Keluar";
        $limit = $_COOKIE["pageLimit"];
        $sort = $_COOKIE["pageSort"];

        if(!isset($page)){ $page = 1; }
        if(!isset($limit)){ 
            $limit = $this->default_setting->pagination('LIMIT'); 
        }
        if(!isset($sort)){ 
            $sort = $this->default_setting->pagination('SORT'); 
        }

        $data = $this->pengeluaranBarangModel->riwayatPengeluaranStok($this->unit_id, $sort,$page,$limit);
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/inventaris/pengeluaranriwayat', $data);
        $this->load->view('footer');
    }

    public function pesan($metode, $return) {
        $this->session->set_flashdata('metode', $metode);
        $this->session->set_flashdata('pesan', 'berhasil');
    }

    public function layanan() {
        $title['title']="Riwayat Barang Keluar";
        $data['daftarBarang'] = $this->barangModel->getAll($this->unit_id);
        $data['daftarUnit'] = $this->masterTabelModel->getData('unit');
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/inventaris/barangkeluar', $data);
        $this->load->view('footer');
    }
}