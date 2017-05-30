<?php
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
?>