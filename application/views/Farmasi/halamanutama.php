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
                    <div class="col-md-6 flexbo">
                        <div class="well">
                        <h4 class="text-primary"><span class="label label-primary pull-right">Jumlah permintaannya</span> Permintaan Masuk</h4>
                        <br>
                        <table class="display responsive no-wrap" id="antrianUtama" cellspacing="0" width="100%" style="text-align: left;">
                                <thead>
                                <tr>
                                    <th>Nomor Permintaan</th>
                                    <th>Dari Unit</th>
                                    <th>Jenis Kunjungan</th>
                                    <th>Tanggal Permintaan</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="well">
                        <h4 class="text-danger">Stok Keluar </h4>
                        <br>
                        <table class="display responsive no-wrap" id="antrianUtama" cellspacing="0" width="100%" style="text-align: left;">
                                <thead>
                                <tr>
                                    <th>Nama barang</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal Keluar</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="well">
                        <h4 class="text-success">Stok Masuk </h4>
                        <br>
                        <table class="display responsive no-wrap" id="antrianUtama" cellspacing="0" width="100%" style="text-align: left;">
                                <thead>
                                <tr>
                                    <th>Nama barang</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal Masuk</th>
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
    $('#delete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var dataID = button.data('id')
        var dataNama = button.data('nama')
        
        var modal = $(this)
        modal.find('.modal-Nama').text(dataNama)
        document.getElementById("deletelink").href="<?php echo base_url('kelola/kelolapasien/deletedata/'); ?>"+"/"+dataID;
    });
</script>

<script>
$("#success-alert").fadeTo(3000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});

$(document).ready(function(){
    $("#buttonTambah").click(function(){
        document.getElementById("headerModal").innerHTML = "Tambah Pasien";
        document.getElementById("submitModal").innerHTML = "Simpan";
        document.getElementById("formModal").action ="<?php echo base_url('/farmasi/halamanutama/insertdata') ?>";
    });
});

function editModal(row) {
    var id= document.getElementById("tabel").rows[row].cells[0].innerHTML;
    
    document.getElementById("nama").value           = document.getElementById("tabel").rows[row].cells[1].innerHTML;
    document.getElementById("tempat_lahir").value  = document.getElementById("tabel").rows[row].cells[2].innerHTML;
    document.getElementById("tanggal_lahir").value   = document.getElementById("tabel").rows[row].cells[3].innerHTML;
    document.getElementById("alamat").value         = document.getElementById("tabel").rows[row].cells[4].innerHTML;
    document.getElementById("jenis_kelamin").innerHTML  = document.getElementById("tabel").rows[row].cells[5].innerHTML;
    document.getElementById("nomor_rm").value       = document.getElementById("tabel").rows[row].cells[6].innerHTML;
    document.getElementById("agama").value          = document.getElementById("tabel").rows[row].cells[7].innerHTML;
    document.getElementById("golongan_darah").innerHTML = document.getElementById("tabel").rows[row].cells[8].innerHTML;
    document.getElementById("optionJenisPasien").innerHTML   = document.getElementById("tabel").rows[row].cells[9].innerHTML;

    document.getElementById("headerModal").innerHTML = "Edit Pasien";
    document.getElementById("submitModal").innerHTML = "Simpan Perubahan";
    document.getElementById("formModal").action ="<?php echo base_url('/farmasi/halamanutama/editdata') ?>"+"/"+id;
    $("#addForm").modal();
}
function kunjungan(row) {
    document.getElementById("idPasien").value       = document.getElementById("tabel").rows[row].cells[0].innerHTML;
    document.getElementById("namapasien").value     = document.getElementById("tabel").rows[row].cells[1].innerHTML;
    $("#kunjungan").modal();
}

</script>



</body>
</html>
