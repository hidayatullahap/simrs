<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class TestCurl extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
    }
    
    public function index()
    {
        $this->test_curl_get();
    }

    public function test_curl_post()
    {
        $nama="Agung";
        $tempat_lahir="Surakarta";
        $tanggal_lahir="1995-09-22";
        $alamat="Malang";
        $jenis_kelamin="L";
        $agama="Islam";
        $jenis_pasien_id="1";
        $nomor_RM="1111555545";
        $golongan_darah="O";

        $insert_data = array(
        'nama' => $nama,
        'tempat_lahir' => $tempat_lahir,
        'tanggal_lahir' => $tanggal_lahir,
        'alamat' => $alamat,
        'jenis_kelamin' => $jenis_kelamin,
        'golongan_darah' => $golongan_darah,
        'agama' => $agama,
        'jenis_pasien_id' => $jenis_pasien_id,
        'nomor_RM' => $nomor_RM
        );
     
    // Set up and execute the curl process
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, 'http://localhost/simrs/api/v1/pasien');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $insert_data);
        $buffer = curl_exec($curl_handle);
        $http_code = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);
        curl_close($curl_handle);
     
        $result = json_decode($buffer);
        echo "HTTP CODE: ".$http_code;
        echo "<br>Server response: ".$result->status;
    }

    public function test_curl_put($id)
    {
        $nama="Agung";
        $tempat_lahir="Kalimantan Tengah";
        $tanggal_lahir="1995-09-22";
        $alamat="Malang";
        $jenis_kelamin="L";
        $agama="Islam";
        $jenis_pasien_id="1";
        $nomor_RM="1111555545";
        $golongan_darah="O";

        $update_data = array(
        'nama' => $nama,
        'tempat_lahir' => $tempat_lahir,
        'tanggal_lahir' => $tanggal_lahir,
        'alamat' => $alamat,
        'jenis_kelamin' => $jenis_kelamin,
        'golongan_darah' => $golongan_darah,
        'agama' => $agama,
        'jenis_pasien_id' => $jenis_pasien_id,
        'nomor_RM' => $nomor_RM
        );
     
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, 'http://localhost/simrs/api/v1/pasien/'.$id);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl_handle, CURLOPT_HEADER, false);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, http_build_query($update_data));
        $buffer = curl_exec($curl_handle);
        $http_code = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);
        curl_close($curl_handle);
     
        $result = json_decode($buffer);
        echo "HTTP CODE: ".$http_code;
        echo "<br>Server response: ".$result->status;
    }

    public function test_curl_patch($id, $method)
    {
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, 'http://localhost/simrs/api/v1/antrianberjalan/'.$id."/".$method);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, 'PATCH');
        $buffer = curl_exec($curl_handle);
        $http_code = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);
        curl_close($curl_handle);
        echo "HTTP CODE: ".$http_code;

        if ($buffer) {
            $result=json_decode($buffer);
            echo "<br>Server response: ".$result->status;
        }
        if ($http_code==204) {
            echo "<br>Server response: No change or existing rows";
        }
    }

    public function test_curl_delete($id)
    {
        $url = 'http://localhost/simrs/api/v1/pasien/'.$id;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $buffer = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        echo "HTTP CODE: ".$http_code;
        if ($buffer) {
            $result=json_decode($buffer);
            echo "<br>Server response: ".$result->status;
        }
        if ($http_code==204) {
            echo "<br>Server response: No existing rows ";
        }
    }
    public function test_curl_get()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://localhost/simrs/api/v1/pasien');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $output = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($output===false) {
            echo "cURL Error: ". curl_error($ch);
        }
        curl_close($ch);
        //echo ("<br>========HASIL CURL==============================================================<br><br>");
        //echo ($output);
        //echo ("<br>========HASIL VAR DUMP===============================================================================<br><br>");
        //$dump=json_decode($output,true);
        //var_dump($dump);
        $arrayMu=json_decode($output, true);
        //echo ("<br>========ARRAY JSON===========================================================================<br><br>");
        //print_r($arrayMu);
        echo ("<br>========Isi Vardump===========================================================================<br><br>");
        var_dump($arrayMu);
        echo " <br>HTTP CODE: ".$http_code;
        echo "<br>";

        echo ("<br>========Coba Print 1===========================================================================<br><br>");
        echo "Isi array 0: ".$arrayMu['data'][0]['nama'];
        echo " <br>HTTP CODE: ".$http_code;
        echo "<br>";

        echo ("<br>========Coba Print Semua===========================================================================<br><br>");
        foreach ($arrayMu['data'] as $key => $value) {
            echo "Array ke: ". $key;
            echo "<br> ";
            foreach ($arrayMu['data'][$key] as $field => $values) {
            //if($arrayMu['data'][$key]['pasien_id']!=21){       Test filter array
                echo $field.": ". $values;
                echo "<br> ";
            //}
            }
            echo "<br> ";
        }
    }

    public function test_excel()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://localhost/simrs/api/v1/pasien?sort=asc');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $output = curl_exec($ch);
        if ($output===false) {
            echo "cURL Error: ". curl_error($ch);
        }
        curl_close($ch);
        $arrayMu=json_decode($output, true);
        $filename = 'daftarpasien.csv';
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=$filename");
        $output = fopen("php://output", "w");
        $header = array_keys($arrayMu['data'][0]);
        fputcsv($output, $header);
        foreach ($arrayMu['data'] as $row) {
            fputcsv($output, $row);
        }
        fclose($output);
    }
}
