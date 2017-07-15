<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class PermintaanDepo extends CI_Controller
{   
    private $unit_id=2;
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('permintaanBarangModel');
        $this->load->model('stokModel');
        $this->load->model('penggunaModel');
        $this->load->model('barangModel');
        $this->load->model('masterTabelModel');
        $this->session->set_userdata('navbar_status', 'permintaanstok');
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
    public function tambahPermintaanDepo(){
        if( $this->input->post('batal') )
        {
            redirect('/depo/permintaandepo', 'refresh');

        } else if( $this->input->post('simpan') ){
            $return = $this->permintaanBarangModel->prosesPermintaanStok($this->unit_id);
            //var_dump($return);
            if($return==false){
                    $this->pesan("Tabel tidak boleh kosong", $return);
                    redirect('/depo/permintaandepo', 'refresh');
                }else if($return==true){
                    $this->pesan("Pengadaan barang berhasil", $return);
                    redirect('/depo/permintaandepo', 'refresh');
                }else{
                    $this->pesan("Error server", $return);
                    redirect('/depo/permintaandepo', 'refresh');
            }
        }
    }

    public function page($page)
    {   
        $title['title']="Riwayat Barang Masuk";
        $limit = $_COOKIE["pageLimit"];
        $sort = $_COOKIE["pageSort"];

        if(!isset($page)){ $page = 1; }
        if(!isset($limit)){ 
            $limit = $this->default_setting->pagination('LIMIT'); 
        }
        if(!isset($sort)){ 
            $sort = $this->default_setting->pagination('SORT'); 
        }

        $data = $this->stokModel->infoStok($this->unit_id, $sort,$page,$limit);
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/depo/stokdepo', $data);
        $this->load->view('footer');
    }

    public function pesan($metode, $return) {
        $this->session->set_flashdata('metode', $metode);
        $this->session->set_flashdata('pesan', '');
    }

    public function layanan() {
        $title['title']="Riwayat Barang Keluar";
        $data['daftarBarang'] = $this->barangModel->getAll($this->unit_id);
        $data['daftarUnit'] = $this->masterTabelModel->getData('unit');
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/depo/permintaanbarang', $data);
        $this->load->view('footer');
    }
}
