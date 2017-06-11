<style rel="stylesheet">
    
    .paddingForm {
        padding-top: 1.5%;
        text-align: right;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <a href="<?php echo base_url('/farmasi/halamanutama'); ?>"><font color='black'><strong>Halaman Utama Farmasi</strong></font></a>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="well">
                        <h4 class="text-primary">Permintaan Masuk</h4>
                        <br>
                        <table class="display responsive no-wrap" id="permintaanMasuk" cellspacing="0" width="100%" style="text-align: left;">
                                <thead>
                                <tr>
                                    <th>Nomor Permintaan</th>
                                    <th>Dari Unit</th>
                                    <th>Tanggal Permintaan</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="well">
                        <h4 class="text-danger">Stok Keluar Hari Ini</h4>
                        <br>
                        <table class="display responsive no-wrap" id="stokKeluar" cellspacing="0" width="100%" style="text-align: left;">
                                <thead>
                                <tr>
                                    <th>Nama barang</th>
                                    <th>Jumlah</th>
                                    <th>Untuk</th>
                                    <th>Jam</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="well">
                        <h4 class="text-success">Stok Masuk Hari Ini</h4>
                        <br>
                        <table class="display responsive no-wrap" id="stokMasuk" cellspacing="0" width="100%" style="text-align: left;">
                                <thead>
                                <tr>
                                    <th>Nama barang</th>
                                    <th>Jumlah</th>
                                    <th>Dari</th>
                                    <th>Jam</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div><!--/row-->    
            </div><!--/col-12-->
            </div><!--/row-->
        <?php if($this->session->flashdata('pesan')) {?>
            <div class="alert alert-success alert-dismissible" id="success-alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-info"></i> Notifikasi</h4>
                <?php echo $this->session->flashdata('metode')." pasien ".$this->session->flashdata('pesan'); ?>
            </div>
        <?php } ?>
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
    $.fn.dataTable.Buttons.swfPath = '<?php echo base_url();?>datatables/extensions/Buttons/swf/flashExport.swf';
    $(document).ready(function () {
        var table_antrianUtama = $('#permintaanMasuk').DataTable( {
            "bSort": false,
            "serverSide": true,
            "info": false,
            "ajax":{
                url :"<?php Print( base_url('farmasi/halamanutama/ajaxpermintaanmasuk') ); ?>",
                type: "post",
                error: function(){
                }
            },
            "language": {
                "emptyTable": "Tidak ada data untuk permintaan masuk"
            }
        } );
        setInterval( function () {
            table_antrianUtama.ajax.reload(null, false);
        }, 10000 );
    });

    $(document).ready(function () {
        var table_antrianUtama = $('#stokKeluar').DataTable( {
            "bSort": false,
            "serverSide": true,
            "info": false,
            "ajax":{
                url :"<?php Print( base_url('farmasi/halamanutama/ajaxstokkeluar') ); ?>",
                type: "post",
                error: function(){
                }
            },
            "language": {
                "emptyTable": "Tidak ada data untuk stok keluar"
            }
        } );
        setInterval( function () {
            table_antrianUtama.ajax.reload(null, false);
        }, 10000 );
    });

    $(document).ready(function () {
        var table_antrianUtama = $('#stokMasuk').DataTable( {
            "bSort": false,
            "serverSide": true,
            "info": false,
            "ajax":{
                url :"<?php Print( base_url('farmasi/halamanutama/ajaxstokmasuk') ); ?>",
                type: "post",
                error: function(){
                }
            },
            "language": {
                "emptyTable": "Tidak ada data untuk stok masuk"
            }
        } );
        setInterval( function () {
            table_antrianUtama.ajax.reload(null, false);
        }, 10000 );
    });
</script>

</body>
</html>
