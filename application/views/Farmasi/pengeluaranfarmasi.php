<style rel="stylesheet">
    
    .paddingForm {
        padding-top: 1.5%;
        text-align: right;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <a href="<?php echo base_url('/farmasi/pengeluaran'); ?>"><font color='black'><strong>Riwayat barang keluar</strong></font></a>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <div class="form-group row">
                            <div class="col-xs-2">
                                <button onclick="window.location.href='<?php echo base_url('/farmasi/pengeluaran/layanan') ?>'" type="button" class="btn btn-info btn-md" id="buttonTambah" data-toggle="modal" data-target="#addForm">Tambah Barang Keluar</button>
                            </div>

                            <form method="post" action="<?php echo base_url('/farmasi/pengeluaran') ?>">
                            <div class="input-group col-xs-2" style="float: right;padding-right:15px;">
                            <input  type="text" class="form-control" placeholder="Cari nama barang" name="search" id="search" 
                            value="<?php if(isset($_SESSION['searchFarmasi'])){echo $_SESSION['searchFarmasi'];} ?>">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                </div>
                            </div>

                            <div class="input-group col-xs-4" style="float: right;padding-right:15px;">
                                <div class="input-group-btn">
                                        <button class="btn btn-default"><i>Filter mulai tgl</i></button>
                                </div>
                                <input  type="date" class="input-group form-control" name="tanggalAwal" 
                                value="<?php if(isset($_SESSION['tanggalAwal'])){echo date('Y-m-d', strtotime($_SESSION['tanggalAwal']));} ?>">
                                <div class="input-group-btn">
                                    <button class="btn btn-default"><i> hingga</i></button>
                                </div>
                                <input  type="date" class="input-group form-control" name="tanggalAkhir" 
                                value="<?php if(isset($_SESSION['tanggalAkhir'])){echo date('Y-m-d', strtotime($_SESSION['tanggalAkhir']));} ?>">
                            </div>
                            </form>

                        </div>
                        
                        <table class="table table-bordered table-hover" id="tabel" cellspacing="0" width="100%">
                            <thead bgcolor="#4a4a4c">
                            <tr>
                                <th><font color="white">Tanggal Keluar</th>
                                <th><font color="white">Nama Barang</th>
                                <th><font color="white">Jumlah</th>
                                <th><font color="white">Untuk Unit</th>
                                <th><font color="white">Grup Barang</th>
                                <th><font color="white">Nomor Batch</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($data->num_rows>0) {
                                foreach ($data as $field => $values) {
                                    echo "<tr>";
                                    $date=strtotime($values['tanggal_keluar']);
                                    echo "<td width='10%'>".date('d M Y H:i:s', $date)."</td>";
                                    echo "<td>".$values['nama_barang']."</td>";
                                    echo "<td>".$values['jumlah_pengeluaran']."</td>";
                                    echo "<td>".$values['nama_unit']."</td>";
                                    echo "<td>".$values['nama_grup_barang']."</td>";
                                    echo "<td>".$values['no_batch']."</td>";
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
                    <span><i>*Hapus 'filter mulai tanggal' untuk mendapatkan semua hasil</i></span>
                        <?php
                            require_once(CLASSES_DIR  . "pagination.php");
                            $entity = new Pagination();
                        if (isset($totalPages)) {
                            $entity->tampilkan('farmasi/pengeluaran',$currentPage, $totalPages);
                        }
                        ?>
                    </div>

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

</body>
</html>
