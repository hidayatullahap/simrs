
<?php
$tempArray = array();
$myArray = array();
while($row = $data->fetch_object()) {
        $tempArray = $row;
        array_push($myArray, $tempArray);
    }
$json = json_encode($myArray);
$arrayMu=json_decode($json,true);

$filename = 'daftarpasien.csv';
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=$filename");
$output = fopen("php://output", "w");
$header = array_keys($arrayMu[0]);
fputcsv($output, $header);
foreach ($arrayMu as $row) {
    fputcsv($output, $row);
}

fclose($output);
?>