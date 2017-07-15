<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require_once CLASSES_DIR  . 'pengadaanbarang.php';
require_once CLASSES_DIR  . 'pengguna.php';
require_once CLASSES_DIR  . 'barang.php';
require_once CLASSES_DIR  . 'mastertabel.php';
require_once CLASSES_DIR  . 'pasien.php';

class Pengadaan extends CI_Controller
{   
    private $unit_id=4;
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('default_setting');
        $this->session->set_userdata('navbar_status', 'pengadaaninventaris');
        $pengguna = new Pengguna();
        if (!$pengguna->is_loggedin()){
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
    public function tambahPengadaanStok(){
        if( $this->input->post('batal') )
        {
            redirect('/inventaris/halamanutama', 'refresh');

        } else if( $this->input->post('simpan') ){
            $pengadaan = new PengadaanBarang();
            $return = $pengadaan->prosesPengadaanStok($this->unit_id);
            //var_dump($return);
            //if($return=='error'){ echo "error nih";}
            
            if($return==false){
                $this->pesan("Tabel tidak boleh kosong", $return);
                redirect('/inventaris/pengadaan', 'refresh');
            }else if($return=='berhasil'){
                $this->pesan("Pengadaan barang berhasil", $return);
                redirect('/inventaris/pengadaan', 'refresh');
            }else if($return=='error'){
                $this->pesan("Error server", $return);
                redirect('/inventaris/pengadaan', 'refresh');
            }

        }
    }
    public function page($page)
    {   
        $pengadaan = new PengadaanBarang();
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

        $data = $pengadaan->riwayatPengadaanStok($this->unit_id, $sort,$page,$limit);
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/inventaris/pengadaanriwayat', $data);
        $this->load->view('footer');
    }

    public function pesan($metode, $return) {
        $this->session->set_flashdata('metode', $metode);
        $this->session->set_flashdata('pesan', 'berhasil');
    }

    public function layanan() {
        $title['title']="Riwayat Barang Masuk";
        $barang = new Barang();
        $master = new MasterTabel();
        $data['daftarBarang'] = $barang->getAll($this->unit_id);
        $data['daftarJenisPenerimaan'] = $master->getData('jenis_penerimaan');
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/inventaris/barangmasuk', $data);
        $this->load->view('footer');
    }
}