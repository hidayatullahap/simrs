<style rel="stylesheet">
    
    .paddingForm {
        padding-top: 1.5%;
        text-align: right;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <a href="<?php echo base_url('/farmasi/halamanutama'); ?>"><font color='black'><strong>Detil Permintaan Masuk</strong></font></a>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <?php
                        $i=0;
                        foreach ($data as $field => $values) {
                            $i++;
                        }
                        echo "<form method='post' action='";
                        echo base_url('/farmasi/permintaan/proses/')."/".$i;
                        echo "'>";
                        ?>
                        <h4>Permintaan dari unit: <?php echo $values['nama_unit']; ?></h4>
                        <table class="table table-bordered" id="tabel" cellspacing="0" width="100%">
                        <thead bgcolor="#4a4a4c">
                            <tr>
                                <th><font color="white">ID Barang</font></th>
                                <th><font color="white">Nama Barang</font></th>
                                <th><font color="white">Satuan</font></th>
                                <th><font color="white">Grup Barang</font></th>
                                <th><font color="white">Tanggal Pesan</font></th>
                                <th><font color="white">Jumlah Permintaan</font></th>
                                <th><font color="white">Jumlah disetujui</font></th>
                                <th><font color="white">Stok Tersedia</font></th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($data->num_rows>0) {
                                    $j=1;
                                    foreach ($data as $field => $values) {
                                        if ($values['stok_tersedia']>0){
                                            $label="success";
                                        }else{
                                            $label="danger";
                                        }

                                        echo "<tr>";
                                        $permintaan_stok_id = $values['permintaan_stok_id'];
                                        $barang_id = $values['barang_id'];
                                        $dari_unit_id = $values['dari_unit_id'];
                                        echo "<input hidden name='idbarang$j' value='".$barang_id."'></input>";
                                        echo "<input hidden name='dariunitid$j' value='".$dari_unit_id."'></input>";
                                        echo "<td><input hidden name='idpermintaan$j' value='".$permintaan_stok_id."'>".$values['barang_id']."</input></td>";
                                        echo "<td><input hidden name='nomorpermintaan$j' value='".$values['nomor_permintaan']."'>".$values['nama_barang']."</input></td>";
                                        echo "<td>".$values['nama_satuan']."</td>";
                                        echo "<td>".$values['nama_grup_barang']."</td>";
                                        echo "<td>".date('m-M-Y H:i:s',strtotime($values['tanggal_permintaan']))."</td>";
                                        echo "<td>".$values['jumlah_permintaan']."</td>";

                                        if($values['stok_tersedia']>0){
                                            echo "<td><input class='form-control' placeholder='masukan jumlah . . . ' name='jumlah$j' min='0' max='".$values['stok_tersedia']."' 
                                            type='number' autocomplete='off' required></input></td>";
                                        }else{
                                            echo "<td><input class='form-control' placeholder='masukan jumlah . . . ' name='jumlah$j' min='0' max='".$values['stok_tersedia']."' 
                                            type='number' value='".$values['stok_tersedia']."' autocomplete='off' required></input></td>";
                                        }
                                        
                                        echo "<td align='center'><h4><span class='label label-$label' id='stok$permintaan_stok_id'>".$values['stok_tersedia']."</span></h4></td>";
                                        echo "</tr>";
                                        $j++;
                                        }
                                    }else{
                                        echo "<tr><td colspan='8' align='center'><font size='3' color='red'>Tidak ada data</font></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>

                        <button class="hidden-print btn btn-default" type="button" onclick="printHalaman()"><i class="glyphicon glyphicon-print"> Print</i></button>
                        <button class="hidden-print btn btn-default" type="submit"><i class="fa fa-arrow-right"> Proses</i></button>
                        <span><i>*Isi jumlah disetujui 0 bila tidak ada stok</i></span>
                        </form>  
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