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
<body>
    <h2 style="text-align: center">Stok Gudang Inventaris Tanggal <?php echo date("d-m-Y");?></h2><br>
    <table class="table">
    <thead>
        <tr>
            <th>Nama Barang</th>
            <th>Satuan</th>
            <th>Harga Barang</th>
            <th>Stok Sekarang</th>
            <th>Total Stok Sekarang</th>
        </tr>
    </thead>
    <tbody>
      <?php
        foreach ($data as $field => $value) {
            echo "<tr>";
            echo "<td>".$value['nama_barang']."</td>";
            echo "<td>".$value['nama_satuan']."</td>";
            echo "<td>Rp. ".number_format($value['harga_jual'],0,',','.')."</td>";
            echo "<td>".$value['jumlah']."</td>";
            echo "<td>Rp. ".number_format($value['jumlah_stok_rp'],0,',','.')."</td>";
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