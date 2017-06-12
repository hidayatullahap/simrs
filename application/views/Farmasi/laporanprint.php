<style>
@page {
    size: A4;
    margin: 27mm 16mm 27mm 16mm;
}
body {
    height: 842px;
    width: 595px;
    margin-left: auto;
    margin-right: auto;
}
</style>
<?php
    $choice=$_SESSION['pilihanrange'];
    $yearDate=$this->uri->segment(5);
    $rangemonth=$this->uri->segment(4);

    switch ($choice) {
        case "Bulanan":
            $outputPilihan = "Bulan: ".$rangemonth."Tahun ".$yearDate;
            break;
        case "Triwulan":
            if($rangemonth>=1 && $rangemonth<=3){
                $outputPilihan = "Kuarter 1 tahun ".$yearDate;
            }else if($rangemonth>3 && $rangemonth<=6){
                $outputPilihan = "Kuarter 2 tahun ".$yearDate;
            }else if($rangemonth>6 && $rangemonth<=9){
                $outputPilihan = "Kuarter 3 tahun ".$yearDate;
            }else{
                $outputPilihan = "Kuarter 4 tahun ".$yearDate;
            }
            break;
        case "Semester":
            if($rangemonth>=1 && $rangemonth<=6 ){
                $outputPilihan = "Semester 1 tahun ".$yearDate;
            }else{
                $outputPilihan = "Semester 2 tahun ".$yearDate;
            }
            break;
        case "Tahunan":
            $outputPilihan = "Tahun: ".$yearDate;
            break;
        default:
            $outputPilihan = "Tahun: ".$yearDate;
    }
    
?>
<body>
    <h2 style="text-align: center">Laporan <?php echo $outputPilihan?></h2><br>
    <table class="table">
    <thead>
        <tr>
            <th>Nama Barang</th>
            <th>Jumlah Barang Keluar</th>
            <th>Jumlah Barang Masuk</th>
            <th>Stok Sekarang</th>
        </tr>
    </thead>
    <tbody>
      <?php
        foreach ($data as $field => $value) {
            echo "<tr>";
            echo "<td>".$value['nama_barang']."</td>";
            echo "<td>".$value['jumlah_barang_keluar']."</td>";
            echo "<td>".$value['jumlah_barang_masuk']."</td>";
            echo "<td>".$value['stok_sekarang']."</td>";
            echo "</tr>";
        }
      ?>
    </tbody>
    </table>
</body>