<style rel="stylesheet">
    
    .paddingForm {
        padding-top: 1.5%;
        text-align: right;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <a href="<?php echo base_url('/depo/resepkeluar'); ?>"><font color='black'><strong>Detil Item <?php $this->uri->segment(3, 0); ?></strong></font></a>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="well">
                        <h4>Detil item dengan nomor: <strong><?php echo $this->uri->segment(4, 0); ?></strong></h4>
                        <table class="table table-bordered table-hover" id="tabel" cellspacing="0" width="100%">
                        <thead bgcolor="#4a4a4c">
                            <tr>
                                <th><font color="white">Nama Barang</th>
                                <th><font color="white">Jumlah</th>
                                <th><font color="white">Aturan Pakai</th>
                                <th><font color="white">Satuan</th>
                                <th><font color="white">Tanggal Resep</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($data->num_rows>0) {
                                    foreach ($data as $field => $values) {
                                        echo "<tr>";
                                        echo "<td>".$values['nama_barang']."</td>";
                                        echo "<td>".$values['jumlah']."</td>";
                                        echo "<td>".$values['aturan_pakai']."</td>";
                                        echo "<td>".$values['nama_satuan']."</td>";
                                        echo "<td>".$values['tanggal_resep']."</td>";
                                        echo "</tr>";
                                        }
                                    }else{
                                        echo "<tr><td colspan='8' align='center'><font size='3' color='red'>Tidak ada data</font></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>

                        <?php 
                        $url=base_url('/depo/resepkeluar/printresep');
                        $nomorTransaksi = $this->uri->segment(4, 0);
                        ?>
                        <button class='btn btn-default' onclick= onclick=window.open('<?php echo $url."/".$nomorTransaksi ?>','_blank')><i class="glyphicon glyphicon-print"></i> Print Resep</button>
                        </form>
                </div><!--/row-->    
            </div><!--/col-12-->
            </div><!--/row-->
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

<script>
function printHalaman() {
    window.print();
}
</script>