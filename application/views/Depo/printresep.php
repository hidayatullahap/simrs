<style>
@page {
    size: A4;
    margin: 5mm 16mm 24mm 5mm;
}
body {
    height: 297.5px;
    width: 320px;
    
    margin-right: auto;
}
</style>

<body>
    <span style="text-align: left">RSUD DR. MURJANI SAMPIT</span><br><br>
    <span>Kepada Yth.</span><br>
    <?php 
    foreach ($data as $field => $value) {}
        $dateLayanan=strtotime($value['tanggal_resep']);
        echo "Nama: ".$value['nama']."<br>";
        echo "No. RM: ".$value['nomor_RM']."<br>";
        echo "Tanggal Layanan: ".date("d-m-Y H:i:s", $dateLayanan)."<br>";
        echo "Cara bayar: ".$value['nama_jenis_pasien']."<br>";
    ?>
    <br>
    <div style="text-align: center"><strong>Pembayaran farmasi</strong></div>
    <div style="text-align: center">
    Nomor Transaksi: <?php echo $this->uri->segment(4, 0); ?> - <?php date_default_timezone_set("Asia/Jakarta"); echo date("d/m/Y H:i"); ?>
    </div>
    <table class="table">
    <thead>
        <tr>
            <th>Nama Jasa</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
      <?php
      $total=0;
        foreach ($data as $field => $value) {
            echo "<tr>";
            echo "<td width='30%'>".$value['nama_barang']."</td>";
            echo "<td>".$value['jumlah']."</td>";
            echo "<td>Rp. ".number_format($value['harga_jual'],0,',','.')."</td>";
            echo "<td>Rp. ".number_format($value['total'],0,',','.')."</td>";
            echo "</tr>";
            $total+=$value['total'];
        }
      ?>
      <tr>
      <td>Total yang harus dibayarkan:</td>
      <td colspan='6' align='right' style="padding-right:30px;">Rp. <?php echo number_format($total);?></td>
      </tr>
    </tbody>
    </table>
    <div style="text-align: center">-Terimakasih, semoga cepat sembuh-</div><br>

</body>
<script src="<?php echo base_url();?>datatables/media/js/jquery.js"></script>
<script>
    $(document).ready(function() {
        window.print();
    })
</script>