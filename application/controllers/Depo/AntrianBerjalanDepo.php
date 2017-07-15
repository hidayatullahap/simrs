<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class AntrianBerjalanDepo extends CI_Controller
{   
    private $title;
    private $unit_id=2;

    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('antrianModel');
        $this->load->model('penggunaModel');
        $this->load->model('masterTabelModel');
        $this->load->model('barangModel');
        $this->load->model('pasienModel');
        $this->load->model('transaksiObatModel');
        $this->session->set_userdata('navbar_status', 'antrianberjalandepo');
        $this->title['title']="Antrian Berjalan";
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
        $limit = $_COOKIE["pageLimit"];
        $sort = $_COOKIE["pageSort"];
        
        $data['daftarUnit'] = $this->masterTabelModel->getData("unit");
        $this->load->view('header',$this->title);
        $this->load->view('navbar');
        $this->load->view('/depo/antrianberjalan',$data);
        $this->load->view('footer');
    }

    public function pesan($metode, $return) {
        $this->session->set_flashdata('metode', $metode);
        $this->session->set_flashdata('pesan', $return);
    }
    
    public function ajaxAntrianBerjalan($unit_id){
        echo $this->antrianModel->ajaxAntrianHariIni($unit_id);
    }

    public function layananObatKeluar($pasien_id)
    {   
        $title['title']="Antrian Berjalan";
        $limit = $_COOKIE["pageLimit"];
        $sort = $_COOKIE["pageSort"];
        
        $data = $this->pasienModel->getOne($pasien_id);
        $data['daftarAturanPakai'] = $this->masterTabelModel->getData("aturan_pakai");
        $data['daftarBarang'] = $this->barangModel->getAll($this->unit_id);
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/depo/obatkeluar',$data);
        $this->load->view('footer');
    }

    public function prosesObatKeluar($pasien_id){
        if( $this->input->post('batal') )
        {
            redirect('depo/antrianberjalandepo', 'refresh');

        } else if( $this->input->post('simpan') ){
            $return = $this->transaksiObatModel->prosesPengeluaranObat($this->unit_id, $pasien_id);
            if($return==false){
                    $this->pesan("Tabel tidak boleh kosong", "");
                    redirect('depo/antrianberjalandepo', 'refresh');
                }else if($return==true){
                    $this->pesan("Pengeluaran obat berhasil", "");
                    redirect('depo/antrianberjalandepo', 'refresh');
                }else{
                    $this->pesan("Error server", "");
                    redirect('depo/antrianberjalandepo', 'refresh');
            }
        }
    }
}
