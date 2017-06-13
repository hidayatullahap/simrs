<style rel="stylesheet">
    
    .paddingForm {
        padding-top: 1.5%;
        text-align: right;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <a href="<?php echo base_url('/inventaris/pengadaan'); ?>"><font color='black'><strong>Riwayat barang Masuk</strong></font></a>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <div class="form-group row">
                            <div class="col-xs-2">
                                <button onclick="window.location.href='<?php echo base_url('/inventaris/pengadaan/layanan') ?>'" 
                                type="button" class="btn btn-info btn-md" id="buttonTambah" data-toggle="modal" data-target="#addForm">
                                Tambah Barang Masuk </button>
                            </div>

                            <form id="formSubmit" method="post" action="<?php echo base_url('/inventaris/pengadaan') ?>">
                            <div class="input-group col-xs-2" style="float: right;padding-right:15px;">
                            <input type="text" class="form-control" onChange="checkTanggal();" placeholder="Cari nama barang" name="search" id="search" autocomplete="off"
                            value="<?php if(isset($_SESSION['searchFarmasi'])){echo $_SESSION['searchFarmasi'];} ?>">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                </div>
                            </div>

                            <div class="input-group col-xs-4" style="float: right;padding-right:15px;">
                                <div class="input-group-btn">
                                        <button class="btn btn-default"><i>Filter mulai tgl</i></button>
                                </div>
                                <input  type="date" class="input-group form-control" name="tanggalAwal" id="tanggalAwal" 
                                value="<?php if(isset($_SESSION['tanggalAwal'])){echo date('Y-m-d', strtotime($_SESSION['tanggalAwal']));} ?>">
                                <div class="input-group-btn">
                                    <button class="btn btn-default"><i> hingga</i></button>
                                </div>
                                <input  type="date" class="input-group form-control" name="tanggalAkhir" id="tanggalAkhir" 
                                value="<?php if(isset($_SESSION['tanggalAkhir'])){echo date('Y-m-d', strtotime($_SESSION['tanggalAkhir']));} ?>">
                            </div>
                            </form>

                        </div>
                        
                        <table class="table table-bordered table-hover" id="tabel" cellspacing="0" width="100%">
                            <thead bgcolor="#4a4a4c">
                            <tr>
                                <th><font color="white">Tanggal Keluar</th>
                                <th><font color="white">Nama Barang</th>
                                <th><font color="white">Satuan</th>
                                <th><font color="white">Jumlah</th>
                                <th><font color="white">Dari</th>
                                <th><font color="white">Harga Jual</th>
                                <th><font color="white">Harga Beli</th>
                                <th><font color="white">Kadaluarsa</th>
                                <th><font color="white">No_batch</th>
                                <th><font color="white">No Faktur</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($data->num_rows>0) {
                                foreach ($data as $field => $values) {
                                    echo "<tr>";
                                    $date=strtotime($values['tanggal_masuk']);
                                    echo "<td width='10%'>".date('d M Y H:i:s', $date)."</td>";
                                    echo "<td>".$values['nama_barang']."</td>";
                                    echo "<td>".$values['nama_satuan']."</td>";
                                    echo "<td>".$values['jumlah_barang']."</td>";
                                    echo "<td>".$values['terima_dari']."</td>";
                                    echo "<td>".$values['harga_jual']."</td>";
                                    echo "<td>".$values['harga_beli']."</td>";
                                    $dateexp=strtotime($values['tanggal_kadaluarsa']);
                                    echo "<td>".date('d M Y', $dateexp)."</td>";
                                    echo "<td>".$values['no_batch']."</td>";
                                    echo "<td>".$values['no_faktur']."</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='11' align='center'><font size='3' color='red'>Tidak ada data</font></td></tr>";
                            }

                            ?>
                            </tbody>
                        </table>
                    <?php  if (isset($totalPages)) {
                        echo "<p style='font-family:Calibri; font-size:85%;'>Showing page: ".$currentPage." with total data: ".$totalData."</p>";
                        }
                    ?>
                    <div class="box-footer clearfix">
                    <span><i>*Search box boleh kosong</i></span>
                        <?php
                            require_once(CLASSES_DIR  . "pagination.php");
                            $entity = new Pagination();
                        if (isset($totalPages)) {
                            $entity->tampilkan('inventaris/pengadaan',$currentPage, $totalPages);
                        }
                        ?>
                    </div>

                    <?php if ($this->session->flashdata('pesan')) {?>
                        <div class="alert alert-success alert-dismissible" id="success-alert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-info"></i> Notifikasi</h4>
                            <?php echo $this->session->flashdata('metode') ?>
                        </div>
                    <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="<?php echo base_url();?>datatables/media/js/jquery.js"></script>
<script src="<?php echo base_url();?>datatables/media/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>datatables/extensions/Buttons/js/dataTables.buttons.min.js"></script>

<script src="<?php echo base_url();?>datatables/extensions/Buttons/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url();?>datatables/extensions/Buttons/js/jszip.min.js"></script>
<script src="<?php echo base_url();?>datatables/extensions/Buttons/js/pdfmake.min.js"></script>
<script src="<?php echo base_url();?>datatables/extensions/Buttons/js/vfs_fonts.js"></script>
<script src="<?php echo base_url();?>datatables/extensions/Buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>datatables/extensions/Buttons/js/buttons.print.min.js"></script>

<script src="<?php echo base_url('datatables/media/js/dataTables.bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('datatables/extensions/Responsive/js/dataTables.responsive.min.js');?>"></script>
<script src="<?php echo base_url('datatables/extensions/Responsive/js/responsive.bootstrap.min.js');?>"></script>

<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>" ></script>
<script src="<?php echo base_url('assets/js/plugins/fastclick/fastclick.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/AdminLTE/app.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/slimScroll/jquery.slimscroll.min.js'); ?>"></script>
<script src="<?php echo base_url("assets/js/plugins/Parsley.js-2.5.1/dist/parsley.js"); ?>"></script>

<script>
$("#success-alert").fadeTo(3000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});
</script>


<script>
$('#formSubmit').submit(function() {
    var tanggalAwal = document.getElementById('tanggalAwal').value;
    var tanggalAkhir = document.getElementById('tanggalAkhir').value;

    if (tanggalAwal=="" || tanggalTanggal==""){
        alert("Isi terlebih dahulu tanggal sebelum search");
    }
    document.getElementById('search').value="";
    return false; // return false to cancel form action
});
</script>

</body>
</html>
