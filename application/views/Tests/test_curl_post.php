<?php
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
?>