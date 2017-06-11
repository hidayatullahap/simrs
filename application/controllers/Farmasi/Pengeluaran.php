<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require_once CLASSES_DIR  . 'gudang.php';
require_once CLASSES_DIR  . 'pengguna.php';
require_once CLASSES_DIR  . 'barang.php';
require_once CLASSES_DIR  . 'mastertabel.php';
require_once CLASSES_DIR  . 'pasien.php';

class Pengeluaran extends CI_Controller
{   
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('default_setting');
        $this->session->set_userdata('navbar_status', 'pengeluaranfarmasi');
        $pengguna = new Pengguna();
        if (!$pengguna->is_loggedin()){
            redirect('login');
        }
    }

    public function index()
    {   
        $pasien = new Pasien();
        $master = new MasterTabel();

        if(!isset($page)){
            $page=1;
        }
        $title['title']="Kelola Pasien";
        $limit = $_COOKIE["pageLimit"];
        $sort = $_COOKIE["pageSort"];
        if(!isset($page)){ $page = 1; }
        if(!isset($limit)){ 
            $limit = $this->default_setting->pagination('LIMIT'); 
        }
        if(!isset($sort)){ 
            $sort = $this->default_setting->pagination('SORT'); 
        }
        $data = $pasien->getData($sort, $page, $limit);
        $data['daftarJenisPasien'] = $master->getData("jenis_pasien");
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/kelola/kelolapasien', $data);
        $this->load->view('footer');
    }
    public function tambahPengeluaranStok(){
        if( $this->input->post('batal') )
        {
            redirect('/farmasi/halamanutama', 'refresh');

        } else if( $this->input->post('simpan') ){
            $gudang=new Gudang();
            $return = $gudang->prosesPengeluaranStokFarmasi();
            if($return==false){
                    $this->pesan("Tabel tidak boleh kosong", $return);
                    redirect('/farmasi/pengeluaran', 'refresh');
                }else{
                    $this->pesan("Pengeluaran barang berhasil", $return);
                    redirect('/farmasi/pengeluaran', 'refresh');
            }
        }
    }
    public function layanan()
    {   
        $namatabel = "unit";
        $unit_id=3;
        $Barang=new Barang();
        $master = new MasterTabel();
        $data['daftarBarang']=$Barang->getAll($unit_id);
        $data['daftarUnit']= $master->getData($namatabel, "ASC", 1, 1000);
        $title['title']="Layanan Permintaan Masuk";
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/farmasi/barangkeluar',$data);
        $this->load->view('footer');
    }

    public function pesan($metode, $return) {
        $this->session->set_flashdata('metode', $metode);
        $this->session->set_flashdata('pesan', 'berhasil');
    }

    public function test() {
        $gudang=new Gudang();
        $return=$gudang->riwayatPengeluaranStok(3,"DESC",1,10);
        var_dump($return);
        
        foreach ($return['data'] as $field => $values) {
            echo $values['nama_barang'];
        }
    }
}