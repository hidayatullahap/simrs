<style>
@page {
    size: A4;
    margin: 15mm 16mm 24mm 16mm;
}
body {
    height: 1000px;
    width: 900px;
    margin-left: auto;
    margin-right: auto;
}
</style>
<?php
    $choice=$_SESSION['pilihanrange'];
    $yearDate=$this->uri->segment(5);
    $rangemonth=$this->uri->segment(4);

    $strDate = "$yearDate-$rangemonth-01 00:00:00";
    $strDate=strtotime($strDate);

    switch ($choice) {
        case "Bulanan":
            $outputPilihan = "Bulan: ".date('F',$strDate)." Tahun ".$yearDate;
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
            <th>Satuan</th>
            <th>Harga Barang</th>
            <th>Jumlah Barang Keluar</th>
            <th>Total Barang Keluar</th>
            <th>Jumlah Barang Masuk</th>
            <th>Total Barang Masuk</th>
            <th>Stok Sekarang</th>
            <th>Total Stok Sekarang</th>
        </tr>
    </thead>
    <tbody>
      <?php
        foreach ($data as $field => $value) {
            echo "<tr>";
            echo "<td width='20%'>".$value['nama_barang']."</td>";
            echo "<td>".$value['nama_satuan']."</td>";
            echo "<td width='15%'>Rp. ".number_format($value['harga_jual'],0,',','.')."</td>";
            echo "<td>".$value['jumlah_barang_keluar']."</td>";
            echo "<td width='20%'>Rp. ".number_format($value['jumlah_pengeluaran_in_rp'],0,',','.')."</td>";
            echo "<td>".$value['jumlah_barang_masuk']."</td>";
            echo "<td width='20%'>Rp. ".number_format($value['jumlah_pengadaan_in_rp'],0,',','.')."</td>";
            echo "<td>".$value['stok_sekarang']."</td>";
            echo "<td width='25%'>Rp. ".number_format($value['jumlah_stok_in_rp'],0,',','.')."</td>";
            echo "</tr>";
        }
      ?>
    </tbody>
    </table>
</body>
<script src="<?php echo base_url();?>datatables/media/js/jquery.js"></script>
<script>
    $(document).ready(function() {
        window.print();
    })
</script>