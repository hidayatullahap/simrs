<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require_once CLASSES_DIR  . 'dbconnection.php';
require_once CLASSES_DIR  . 'pengadaanbarang.php';
require_once CLASSES_DIR  . 'stok.php';

class UnitTest extends CI_Controller
{   
    function __construct()
    {
        parent::__construct();
        $this->load->library('unit_test');
        $this->load->model('penggunaModel');
        $this->load->model('default_setting');
    }
    
    public function index()
    {   
        //$test = 1 + 1;
        //echo $this->unit->report();

        /*#Test proses pengadaan stok 1 "pass"
        $test_name = 'Test proses pengadaan stok 1';
        $test = $this->prosesPengadaanStok(null,null,null,null,0);
        $expected_result = false;*/

        /*#Test proses pengadaan stok 2 "pass"
        $test_name = 'Test proses pengadaan stok 2';
        $test = $this->prosesPengadaanStok(3,1521,'test',10,1);
        $expected_result = 'berhasil';*/

        /*#Test proses pengadaan stok 3 "pass"
        $test_name = 'Test proses pengadaan stok 3';
        $test = $this->prosesPengadaanStok(3,1521,'test',1,1);
        $expected_result = 'berhasil';*/

        /*#Test proses pengadaan stok 4 "pass"
        $test_name = 'Test proses pengadaan stok 4';
        $test = $this->prosesPengadaanStok(3,6,'test',10,1);
        $expected_result = 'error';*/

        /*#Test proses pengadaan stok 5 "pass"
        $test_name = 'Test proses pengadaan stok 5';
        $test = $this->prosesPengadaanStok(3,6,'test',1,1);
        $expected_result = 'error';*/

        /*#Test get laporan 1 "pass"
        $test_name = 'Test get laporan 1';
        $laporan = $this->getLaporan('Bulanan',7,2017,3);
        var_dump($laporan['data'][0]);
        $test =  $laporan['data'][0];

        $expected_result = array(
            'barang_id' => '3',
            'nama_barang' => 'AB Vask 10 mg tab',
            'nama_satuan' => 'tablet',
            'harga_jual' => '1000',
            'jumlah_barang_keluar' => '1',
            'jumlah_pengeluaran_in_rp' => '1000',
            'jumlah_barang_masuk' => '1',
            'jumlah_pengadaan_in_rp' => '1000',
            'stok_sekarang' => '171',
            'jumlah_stok_in_rp' => '171000',
        );*/

        /*#Test get laporan 2 "pass"
        $test_name = 'Test get laporan 2';
        $laporan = $this->getLaporan('Triwulan',3,2017,3);
        var_dump($laporan['data'][0]);
        $test =  $laporan['data'][0];

        $expected_result = array(
            'barang_id' => '3',
            'nama_barang' => 'AB Vask 10 mg tab',
            'nama_satuan' => 'tablet',
            'harga_jual' => '1000',
            'jumlah_barang_keluar' => '-',
            'jumlah_pengeluaran_in_rp' => '0',
            'jumlah_barang_masuk' => '-',
            'jumlah_pengadaan_in_rp' => '0',
            'stok_sekarang' => '171',
            'jumlah_stok_in_rp' => '171000',
        );*/
        
        /*#Test get laporan 3 "pass"
        $test_name = 'Test get laporan 3';
        $laporan = $this->getLaporan('Triwulan',6,2017,3);
        var_dump($laporan['data'][0]);
        $test =  $laporan['data'][0];

        $expected_result = array(
            'barang_id' => '3',
            'nama_barang' => 'AB Vask 10 mg tab',
            'nama_satuan' => 'tablet',
            'harga_jual' => '1000',
            'jumlah_barang_keluar' => '14',
            'jumlah_pengeluaran_in_rp' => '14000',
            'jumlah_barang_masuk' => '12',
            'jumlah_pengadaan_in_rp' => '12000',
            'stok_sekarang' => '171',
            'jumlah_stok_in_rp' => '171000',
        );*/

        /*#Test get laporan 4 "pass"
        $test_name = 'Test get laporan 4';
        $laporan = $this->getLaporan('Triwulan',9,2017,3);
        var_dump($laporan['data'][0]);
        $test =  $laporan['data'][0];

        $expected_result = array(
            'barang_id' => '3',
            'nama_barang' => 'AB Vask 10 mg tab',
            'nama_satuan' => 'tablet',
            'harga_jual' => '1000',
            'jumlah_barang_keluar' => '1',
            'jumlah_pengeluaran_in_rp' => '1000',
            'jumlah_barang_masuk' => '1',
            'jumlah_pengadaan_in_rp' => '1000',
            'stok_sekarang' => '171',
            'jumlah_stok_in_rp' => '171000',
        );*/

        /*#Test get laporan 5 "pass"
        $test_name = 'Test get laporan 5';
        $laporan = $this->getLaporan('Triwulan',12,2017,3);
        var_dump($laporan['data'][0]);
        $test =  $laporan['data'][0];

        $expected_result = array(
            'barang_id' => '3',
            'nama_barang' => 'AB Vask 10 mg tab',
            'nama_satuan' => 'tablet',
            'harga_jual' => '1000',
            'jumlah_barang_keluar' => '-',
            'jumlah_pengeluaran_in_rp' => '0',
            'jumlah_barang_masuk' => '-',
            'jumlah_pengadaan_in_rp' => '0',
            'stok_sekarang' => '171',
            'jumlah_stok_in_rp' => '171000',
        );*/

        /*#Test get laporan 6 "pass"
        $test_name = 'Test get laporan 6';
        $laporan = $this->getLaporan('',7,2017,3);
        var_dump($laporan['data'][0]);
        $test =  $laporan['data'][0];

        $expected_result = NULL;*/
        
        /*#Test get laporan 7 "pass"
        $test_name = 'Test get laporan 7';
        $laporan = $this->getLaporan('Semester',3,2017,3);
        var_dump($laporan['data'][0]);
        $test =  $laporan['data'][0];

        $expected_result = array(
            'barang_id' => '3',
            'nama_barang' => 'AB Vask 10 mg tab',
            'nama_satuan' => 'tablet',
            'harga_jual' => '1000',
            'jumlah_barang_keluar' => '42',
            'jumlah_pengeluaran_in_rp' => '42000',
            'jumlah_barang_masuk' => '37',
            'jumlah_pengadaan_in_rp' => '37000',
            'stok_sekarang' => '171',
            'jumlah_stok_in_rp' => '171000',
        );*/

        /*#Test get laporan 8 "pass"
        $test_name = 'Test get laporan 8';
        $laporan = $this->getLaporan('Semester',7,2017,3);
        var_dump($laporan['data'][0]);
        $test =  $laporan['data'][0];

        $expected_result = array(
            'barang_id' => '3',
            'nama_barang' => 'AB Vask 10 mg tab',
            'nama_satuan' => 'tablet',
            'harga_jual' => '1000',
            'jumlah_barang_keluar' => '1',
            'jumlah_pengeluaran_in_rp' => '1000',
            'jumlah_barang_masuk' => '1',
            'jumlah_pengadaan_in_rp' => '1000',
            'stok_sekarang' => '171',
            'jumlah_stok_in_rp' => '171000',
        );*/

        /*#Test get laporan 9 "pass"
        $test_name = 'Test get laporan 9';
        $laporan = $this->getLaporan('Tahunan',7,2017,3);
        var_dump($laporan['data'][0]);
        $test =  $laporan['data'][0];

        $expected_result = array(
            'barang_id' => '3',
            'nama_barang' => 'AB Vask 10 mg tab',
            'nama_satuan' => 'tablet',
            'harga_jual' => '1000',
            'jumlah_barang_keluar' => '15',
            'jumlah_pengeluaran_in_rp' => '15000',
            'jumlah_barang_masuk' => '38',
            'jumlah_pengadaan_in_rp' => '38000',
            'stok_sekarang' => '171',
            'jumlah_stok_in_rp' => '171000',
        );*/

        /*#Test get laporan 10 "pass"
        $test_name = 'Test get laporan 10';
        $laporan = $this->getLaporan('',7,2017,3);
        var_dump($laporan['data'][0]);
        $test =  $laporan['data'][0];

        $expected_result = array(
            'barang_id' => '3',
            'nama_barang' => 'AB Vask 10 mg tab',
            'nama_satuan' => 'tablet',
            'harga_jual' => '1000',
            'jumlah_barang_keluar' => '1',
            'jumlah_pengeluaran_in_rp' => '1000',
            'jumlah_barang_masuk' => '1',
            'jumlah_pengadaan_in_rp' => '1000',
            'stok_sekarang' => '171',
            'jumlah_stok_in_rp' => '171000',
        );*/
        
        /*#Test riwayatPengadaanStok 1 "pass"
        $test_name = 'Test riwayatPengadaanStok 1';
        $laporan = $this->riwayatPengadaanStok(3, '2017-07-07', '2017-07-30', 'parasetamol');
        var_dump($laporan['data'][0]);
        $test =  $laporan['data'][0];

        $expected_result = array(
            'nama_barang' => 'Parasetamol',
            'nama_satuan' => 'tablet',
            'jumlah_barang' => '1',
            'terima_dari' => '',
            'nama_jenis_penerimaan' => 'APBN',
            'tanggal_masuk' => '2017-07-15 22:09:11',
            'harga_jual' => '0',
            'harga_beli' => '0',
            'tanggal_kadaluarsa' => '2017-07-21',
            'no_batch' => '',
            'no_faktur' => '',
            'barang_id' => '2',
        );*/
        /*#Test riwayatPengadaanStok 1 "pass"
        $test_name = 'Test riwayatPengadaanStok 1';
        $riwayat = $this->riwayatPengadaanStok(3, '2017-07-07', '2017-07-30', 'parasetamol');
        var_dump($riwayat['data'][0]);
        $test =  $riwayat['data'][0];

        $expected_result = array(
            'nama_barang' => 'Parasetamol',
            'nama_satuan' => 'tablet',
            'jumlah_barang' => '1',
            'terima_dari' => '',
            'nama_jenis_penerimaan' => 'APBN',
            'tanggal_masuk' => '2017-07-15 22:09:11',
            'harga_jual' => '0',
            'harga_beli' => '0',
            'tanggal_kadaluarsa' => '2017-07-21',
            'no_batch' => '',
            'no_faktur' => '',
            'barang_id' => '2',
        );*/
        
        /*#Test riwayatPengadaanStok 2 "pass"
        $test_name = 'Test riwayatPengadaanStok 2';
        $riwayat = $this->riwayatPengadaanStok(3, '2017-07-07', '2017-07-30', '');
        var_dump($riwayat['data'][0]);
        $test =  $riwayat['data'][0];

        $expected_result = array(
            'nama_barang' => 'Gelas',
            'nama_satuan' => 'pcs ',
            'jumlah_barang' => '1',
            'terima_dari' => '',
            'nama_jenis_penerimaan' => 'APBN',
            'tanggal_masuk' => '2017-07-29 11:20:46',
            'harga_jual' => '0',
            'harga_beli' => '0',
            'tanggal_kadaluarsa' => '0000-00-00',
            'no_batch' => 'test',
            'no_faktur' => '',
            'barang_id' => '1521',
        );*/

        /*#Test riwayatPengadaanStok 3 "pass"
        $test_name = 'Test riwayatPengadaanStok 3';
        $riwayat = $this->riwayatPengadaanStok(3, null, null, 'parasetamol');
        var_dump($riwayat['data'][0]);
        $test =  $riwayat['data'][0];

        $expected_result = array(
            'nama_barang' => 'Parasetamol',
            'nama_satuan' => 'tablet',
            'jumlah_barang' => '1',
            'terima_dari' => '',
            'nama_jenis_penerimaan' => 'APBN',
            'tanggal_masuk' => '2017-07-15 22:09:11',
            'harga_jual' => '0',
            'harga_beli' => '0',
            'tanggal_kadaluarsa' => '2017-07-21',
            'no_batch' => '',
            'no_faktur' => '',
            'barang_id' => '2',
        );*/

        /*#Test riwayatPengadaanStok 4 "pass"
        $test_name = 'Test riwayatPengadaanStok 4';
        $riwayat = $this->riwayatPengadaanStok(3, NULL, NULL, NULL);
        var_dump($riwayat['data'][0]);
        $test =  $riwayat['data'][0];

        $expected_result = array(
            'nama_barang' => 'Gelas',
            'nama_satuan' => 'pcs ',
            'jumlah_barang' => '1',
            'terima_dari' => '',
            'nama_jenis_penerimaan' => 'APBN',
            'tanggal_masuk' => '2017-07-29 11:20:46',
            'harga_jual' => '0',
            'harga_beli' => '0',
            'tanggal_kadaluarsa' => '0000-00-00',
            'no_batch' => 'test',
            'no_faktur' => '',
            'barang_id' => '1521',
        );*/

        #Test riwayatPengadaanStok 5 "pass"
        $test_name = 'Test riwayatPengadaanStok 5';
        $riwayat = $this->riwayatPengadaanStok(3, '', '2017-07-30', NULL);
        var_dump($riwayat['data'][0]);
        $test =  $riwayat['data'][0];

        $expected_result = array(
            'nama_barang' => 'Gelas',
            'nama_satuan' => 'pcs ',
            'jumlah_barang' => '1',
            'terima_dari' => '',
            'nama_jenis_penerimaan' => 'APBN',
            'tanggal_masuk' => '2017-07-29 11:20:46',
            'harga_jual' => '0',
            'harga_beli' => '0',
            'tanggal_kadaluarsa' => '0000-00-00',
            'no_batch' => 'test',
            'no_faktur' => '',
            'barang_id' => '1521',
        );

        echo $this->unit->run($test, $expected_result, $test_name);
    }

    public function prosesPengadaanStok($unit_id, $barang_id, $nomor_batch, $jumlah,$totalTabel){
        $i=1;
        $db = new DB();
        $conn = $db->connect();
        $barang_id_tabel[0] = $barang_id;
        $nomor_batch_tabel[0] = $nomor_batch;
        $jumlah_tabel[0] = $jumlah;

        if($totalTabel>0){
            $tabel_barang_id            = $barang_id_tabel;
            $tabel_nomor_batch          = $nomor_batch_tabel;
            $tabel_jumlah               = $jumlah_tabel;

            foreach($tabel_barang_id as $a => $b){
                $pengadaan = new PengadaanBarang(
                    $pengadaan_barang_id = $tabel_barang_id[$a],
                    null,
                    null,
                    null,
                    null,
                    $no_batch = $tabel_nomor_batch[$a],
                    null,
                    null,
                    null,
                    $jumlah_barang = $tabel_jumlah[$a]
                );

                $barang_id              = $pengadaan->getPengadaan_barang_id();
                $nomor_batch            = $pengadaan->getNo_batch();
                $jumlah_barang          = $pengadaan->getJumlah_barang();

                $sqlCheckTableExist = $conn->query("SELECT COUNT(*) FROM stok WHERE barang_id = '$barang_id' AND unit_id = '$unit_id'");
                $isExist = $sqlCheckTableExist->fetch_row();

                if ($isExist[0]==0){ 
                        if($jumlah_barang>0){
                            $query1 =
                            "INSERT INTO `stok` (`barang_id`, `unit_id`, `jumlah`) VALUES ('$barang_id', '$unit_id', '$jumlah_barang');";
                            $result = $conn->query($query1);
                        }
                }else{
                        $query2 =
                        "UPDATE `stok` SET `jumlah` = jumlah+$jumlah_barang WHERE `stok`.`barang_id` = $barang_id AND `stok`.`unit_id` = $unit_id; ";
                        $result = $conn->query($query2);
                }

                if($jumlah_barang>0){
                    $query =
                    "INSERT INTO `pengadaan_arang` (`jenis_penerimaan_id`, 
                    `untuk_unit_id`, `barang_id`, `no_batch`, `jumlah_barang`) 
                    VALUES ('1', '$unit_id', '$barang_id', 
                    '$nomor_batch', '$jumlah_barang');";
                    
                    $result = $conn->query($query);
                }
                $i++;
            }
            $conn->close();

            if($result){
                return 'berhasil';
            }else{
                return 'error';
            }
        }else{
            return false;
        }
    }

    public function getLaporan($range, $month, $year, $unit_id)
    {  
        $db = new DB();
        $conn = $db->connect();
        switch ($range) {
            case "Bulanan":
                $sqlRangeWaktuKeluar="AND YEAR(pengeluaran_barang.tanggal_keluar)=$year AND MONTH(pengeluaran_barang.tanggal_keluar)=$month ";
                $sqlRangeWaktuMasuk="AND YEAR(pengadaan_barang.tanggal_masuk)=$year AND MONTH(pengadaan_barang.tanggal_masuk)=$month ";
                break;
            case "Triwulan":
                if($month>=1 && $month<=3){
                    $sqlRangeWaktuKeluar="AND YEAR(pengeluaran_barang.tanggal_keluar)=$year AND QUARTER(pengeluaran_barang.tanggal_keluar)=1 ";
                    $sqlRangeWaktuMasuk="AND YEAR(pengadaan_barang.tanggal_masuk)    =$year AND QUARTER(pengadaan_barang.tanggal_masuk)=1 ";
                }else if($month>3 && $month<=6){
                    $sqlRangeWaktuKeluar="AND YEAR(pengeluaran_barang.tanggal_keluar)=$year AND QUARTER(pengeluaran_barang.tanggal_keluar)=2 ";
                    $sqlRangeWaktuMasuk="AND YEAR(pengadaan_barang.tanggal_masuk)    =$year AND QUARTER(pengadaan_barang.tanggal_masuk)=2 ";
                }else if($month>6 && $month<=9){
                    $sqlRangeWaktuKeluar="AND YEAR(pengeluaran_barang.tanggal_keluar)=$year AND QUARTER(pengeluaran_barang.tanggal_keluar)=3 ";
                    $sqlRangeWaktuMasuk="AND YEAR(pengadaan_barang.tanggal_masuk)    =$year AND QUARTER(pengadaan_barang.tanggal_masuk)=3 ";
                }else{
                    $sqlRangeWaktuKeluar="AND YEAR(pengeluaran_barang.tanggal_keluar)=$year AND QUARTER(pengeluaran_barang.tanggal_keluar)=4 ";
                    $sqlRangeWaktuMasuk="AND YEAR(pengadaan_barang.tanggal_masuk)    =$year AND QUARTER(pengadaan_barang.tanggal_masuk)=4 ";
                }
                break;
            case "Semester":
                if($month>=1 && $month<=6 ){
                    $sqlRangeWaktuKeluar="AND YEAR(pengeluaran_barang.tanggal_keluar)=$year AND QUARTER(pengeluaran_barang.tanggal_keluar)=1 OR QUARTER(pengeluaran_barang.tanggal_keluar)=2 ";
                    $sqlRangeWaktuMasuk="AND YEAR(pengadaan_barang.tanggal_masuk)    =$year AND QUARTER(pengadaan_barang.tanggal_masuk)=1 OR QUARTER(pengadaan_barang.tanggal_masuk)=2 ";
                }else{
                    $sqlRangeWaktuKeluar="AND YEAR(pengeluaran_barang.tanggal_keluar)=$year AND QUARTER(pengeluaran_barang.tanggal_keluar)=3 OR QUARTER(pengeluaran_barang.tanggal_keluar)=4 ";
                    $sqlRangeWaktuMasuk="AND YEAR(pengadaan_barang.tanggal_masuk)    =$year AND QUARTER(pengadaan_barang.tanggal_masuk)=3 OR QUARTER(pengadaan_barang.tanggal_masuk)=4 ";
                }
                break;
            case "Tahunan":
                $sqlRangeWaktuKeluar="AND YEAR(pengeluaran_barang.tanggal_keluar)=$year ";
                $sqlRangeWaktuMasuk="AND YEAR(pengadaan_barang.tanggal_masuk)=$year ";
                break;
            default:
                $sqlRangeWaktuKeluar="AND YEAR(pengeluaran_barang.tanggal_keluar)=$year AND MONTH(pengeluaran_barang.tanggal_keluar)=$month ";
                $sqlRangeWaktuMasuk="AND YEAR(pengadaan_barang.tanggal_masuk)=$year AND MONTH(pengadaan_barang.tanggal_masuk)=$month ";
        }
        
        $data = array();
        
        $query =
        "SELECT
        barang.barang_id,
        barang.nama_barang,
        satuan.nama_satuan,
        barang.harga_jual AS harga_jual,
        IFNULL(lj_pengeluaran.jumlah_barang_keluar,'-')  AS jumlah_barang_keluar,
        IFNULL(lj_pengeluaran.jumlah_pengeluaran_rp,'0') as jumlah_pengeluaran_in_rp,
        IFNULL(lj_pemasukan_barang.jumlah_barang_masuk,'-') AS jumlah_barang_masuk,
        IFNULL(lj_pemasukan_barang.jumlah_pengadaan_rp,'0') as jumlah_pengadaan_in_rp,
        IFNULL(lj_stok.jumlah,'-') as stok_sekarang,
        IFNULL(lj_stok.jumlah_stok_rp,'0') as jumlah_stok_in_rp
        FROM
        barang
        LEFT JOIN (
        SELECT
        pengeluaran_barang.barang_id,
        SUM(pengeluaran_barang.jumlah_pengeluaran) AS jumlah_barang_keluar,
        (SUM(pengeluaran_barang.jumlah_pengeluaran)*barang.harga_jual) AS jumlah_pengeluaran_rp
        FROM
        pengeluaran_barang
        INNER JOIN barang ON pengeluaran_barang.barang_id = barang.barang_id
        WHERE
        pengeluaran_barang.dari_unit_id = $unit_id
        $sqlRangeWaktuKeluar 
        GROUP BY
        pengeluaran_barang.barang_id
        ) lj_pengeluaran ON (lj_pengeluaran.barang_id = barang.barang_id)

        LEFT JOIN (
        SELECT
        pengadaan_barang.barang_id,
        SUM(pengadaan_barang.jumlah_barang) AS jumlah_barang_masuk,
        (SUM(pengadaan_barang.jumlah_barang)*barang.harga_jual) AS jumlah_pengadaan_rp
        FROM
        pengadaan_barang
        INNER JOIN barang ON pengadaan_barang.barang_id = barang.barang_id
        WHERE
        pengadaan_barang.untuk_unit_id = $unit_id
        $sqlRangeWaktuMasuk  
        GROUP BY
        pengadaan_barang.barang_id) lj_pemasukan_barang ON (lj_pemasukan_barang.barang_id = barang.barang_id)
        LEFT JOIN (
        SELECT
        stok.barang_id AS barang_id,
        stok.jumlah AS jumlah,
        (barang.harga_jual*stok.jumlah) AS jumlah_stok_rp
        FROM
        stok
        INNER JOIN barang ON stok.barang_id = barang.barang_id
        WHERE
        stok.unit_id = $unit_id
        )lj_stok ON (lj_stok.barang_id = barang.barang_id)
        INNER JOIN satuan ON barang.satuan_id = satuan.satuan_id
        GROUP BY
        barang.nama_barang
        ";
        $result = $conn->query($query);
        
        $rows = [];
        $i=0;
        $object; $barang; $satuan;
        $nestedData = array();
        $arrayData = new ArrayObject();
        while($row = mysqli_fetch_array($result))
        {   
            $object{$i} = new Stok();
            $object{$i}->setBarang_id($row['barang_id']);
            $object{$i}->setNama_barang($row['nama_barang']);
            $satuan = $object{$i}->satuan(null, $row['nama_satuan']);
            $object{$i}->setHarga_jual($row['harga_jual']);
            $object{$i}->setJumlah_barang_keluar($row['jumlah_barang_keluar']);
            $object{$i}->setJumlah_pengeluaran_in_rp($row['jumlah_pengeluaran_in_rp']);
            $object{$i}->setJumlah_barang_masuk($row['jumlah_barang_masuk']);
            $object{$i}->setJumlah_pengadaan_in_rp($row['jumlah_pengadaan_in_rp']);
            $object{$i}->setStok_sekarang($row['stok_sekarang']);
            $object{$i}->setJumlah_stok_in_rp($row['jumlah_stok_in_rp']);
            
            $nestedData['barang_id'] = $object{$i}->getBarang_id();
            $nestedData['nama_barang'] = $object{$i}->getNama_barang();
            $nestedData['nama_satuan'] = $satuan->getNama_satuan();
            $nestedData['harga_jual'] = $object{$i}->getHarga_jual();
            $nestedData['jumlah_barang_keluar'] = $object{$i}->getJumlah_barang_keluar();
            $nestedData['jumlah_pengeluaran_in_rp'] = $object{$i}->getJumlah_pengeluaran_in_rp();
            $nestedData['jumlah_barang_masuk'] = $object{$i}->getJumlah_barang_masuk();
            $nestedData['jumlah_pengadaan_in_rp'] = $object{$i}->getJumlah_pengadaan_in_rp();
            $nestedData['stok_sekarang'] = $object{$i}->getStok_sekarang();
            $nestedData['jumlah_stok_in_rp'] = $object{$i}->getJumlah_stok_in_rp();
            $arrayData[] = $nestedData;

            $i++;
        } 
        $arrayData->num_rows = $i;
        $conn->close();
        $data = array("data"=>$arrayData);
        return $data;
    }

    public function riwayatPengadaanStok($unit_id, $tgl_awal, $tgl_akhir, $srch)
    {   
        $sort = 'DESC';
        $page = 1;
        $limitItemPage = 10;

        $db = new DB();
        $conn = $db->connect();
        $page=($page*$limitItemPage)-$limitItemPage;
        
        if (isset($srch)&&isset($tgl_awal)&&isset($tgl_akhir)){ 
            $_SESSION["searchFarmasi"] = $srch;
            $tanggalAwal = $tgl_awal; $tanggalAwal = $tanggalAwal." 00:00:00"; $_SESSION["tanggalAwal"] = $tanggalAwal;
            $tanggalAkhir = $tgl_akhir; $tanggalAkhir = $tanggalAkhir." 23:59:59"; $_SESSION["tanggalAkhir"] = $tanggalAkhir; 
        }else if (isset($tgl_awal)&&isset($tgl_akhir)){ 
            $tanggalAwal = $tgl_awal; $tanggalAwal = $tanggalAwal." 00:00:00"; $_SESSION["tanggalAwal"] = $tanggalAwal;
            $tanggalAkhir = $tgl_akhir; $tanggalAkhir = $tanggalAkhir." 23:59:59"; $_SESSION["tanggalAkhir"] = $tanggalAkhir;
        } 
        
        if(!isset($tanggalAwal) || !isset($tanggalAkhir)){
            $sqlRangeDate = "";
        }else if(isset($tanggalAwal) && isset($tanggalAkhir)){
            $sqlRangeDate = "AND pengadaan_barang.tanggal_masuk BETWEEN '$tanggalAwal' AND '$tanggalAkhir' ";
        }

        if(isset($srch)){
            $sqlSearch = "AND barang.nama_barang LIKE '%$srch%' ";
        }else{
            $sqlSearch = "";
        }
        

        $data = array();
        
        $query =
        "SELECT
        barang.nama_barang,
        satuan.nama_satuan,
        pengadaan_barang.jumlah_barang,
        pengadaan_barang.terima_dari,
        jenis_penerimaan.nama_jenis_penerimaan,
        pengadaan_barang.tanggal_masuk,
        pengadaan_barang.harga_jual,
        pengadaan_barang.harga_beli,
        pengadaan_barang.tanggal_kadaluarsa,
        pengadaan_barang.no_batch,
        pengadaan_barang.no_faktur,
        pengadaan_barang.barang_id
        FROM
        pengadaan_barang
        INNER JOIN barang ON pengadaan_barang.barang_id = barang.barang_id
        INNER JOIN satuan ON barang.satuan_id = satuan.satuan_id
        INNER JOIN jenis_penerimaan ON pengadaan_barang.jenis_penerimaan_id = jenis_penerimaan.jenis_penerimaan_id
        WHERE
        pengadaan_barang.untuk_unit_id = $unit_id $sqlRangeDate $sqlSearch
        ORDER BY
        pengadaan_barang.tanggal_masuk DESC
        LIMIT $page, $limitItemPage";
        $result = $conn->query($query);

        $rows = [];
        $i=0;
        $object; $barang;$jenispenerimaan;
        $nestedData = array();
        $arrayData = new ArrayObject();
        while($row = mysqli_fetch_array($result))
        {   
            $object{$i} = new PengadaanBarang();
            $jenispenerimaan{$i} = new JenisPenerimaan();
            
            $object{$i}->setJumlah_barang($row['jumlah_barang']);
            $object{$i}->setTerima_dari($row['terima_dari']);
            $jenispenerimaan{$i}->setNama_jenis_penerimaan($row['nama_jenis_penerimaan']);
            $object{$i}->setTanggal_masuk($row['tanggal_masuk']);
            $object{$i}->setHarga_jual($row['harga_jual']);
            $object{$i}->setHarga_beli($row['harga_beli']);
            $object{$i}->setTanggal_kadaluarsa($row['tanggal_kadaluarsa']);
            $object{$i}->setNo_batch($row['no_batch']);
            $object{$i}->setNo_faktur($row['no_faktur']);
            $object{$i}->setNama_barang($row['nama_barang']);
            $object{$i}->setBarang_id($row['barang_id']);
            $satuan = $object{$i}->satuan(null, $row['nama_satuan']);
            
            $nestedData['nama_barang'] = $object{$i}->getNama_barang();
            $nestedData['nama_satuan'] = $satuan->getNama_satuan();
            $nestedData['jumlah_barang'] = $object{$i}->getJumlah_barang();
            $nestedData['terima_dari'] = $object{$i}->getTerima_dari();
            $nestedData['nama_jenis_penerimaan'] = $jenispenerimaan{$i}->getNama_jenis_penerimaan();
            $nestedData['tanggal_masuk'] = $object{$i}->getTanggal_masuk();
            $nestedData['harga_jual'] = $object{$i}->getHarga_jual();
            $nestedData['harga_beli'] = $object{$i}->getHarga_beli();
            $nestedData['tanggal_kadaluarsa'] = $object{$i}->getTanggal_kadaluarsa();
            $nestedData['no_batch'] = $object{$i}->getNo_batch();
            $nestedData['no_faktur'] = $object{$i}->getNo_faktur();
            $nestedData['barang_id'] = $object{$i}->getBarang_id();
            $arrayData[] = $nestedData;

            $i++;
        } 
        $arrayData->num_rows = $i;
        
        $sql = $conn->query("SELECT COUNT(*) FROM pengadaan_barang INNER JOIN barang ON pengadaan_barang.barang_id = barang.barang_id WHERE
        pengadaan_barang.untuk_unit_id = $unit_id $sqlRangeDate $sqlSearch ");

        $row = $sql->fetch_row();
        $count = $row[0];
        $totalData = $count;
        $totalPages = ceil($totalData/$limitItemPage);
        $conn->close();
        $data = array("data"=>$arrayData, "currentPage"=>$page/$limitItemPage+1, "totalPages"=>$totalPages, "totalData"=>$totalData);
        return $data;
    }
}
