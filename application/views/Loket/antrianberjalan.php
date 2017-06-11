<style rel="stylesheet">
    .paddingForm {
        padding-top: 1.5%;
        text-align: right;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <a href="<?php echo base_url('/loket/antrianberjalan'); ?>"><font color='black'><strong>Antrian berjalan</strong></font></a>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <!--
                        <form action="<?php echo base_url('/loket/layananpasien') ?>">
                            <div class="col-xs-2">
                                <button type="submit" class="btn btn-info btn-md" >Daftar Pasien</button>
                            </div><br>
                        </form>
                        -->
                        <!-- /.box-header -->
                        <div class="box-body" >
                            <table class="display responsive no-wrap" id="antrianUtama" cellspacing="0" width="100%" style="text-align: left;">
                                <thead>
                                <tr>
                                    <th>Tanggal Antri</th>
                                    <th>Nama</th>
                                    <th>Jenis Kunjungan</th>
                                    <th>Tujuan</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                            </table>
                        </div><!-- ./wrapper -->

                    <form method="post" id="formModal" action="<?php echo base_url('/loket/antrianberjalan/editunit') ?>">
                    <div class="modal fade" id="pindahunit" role="dialog">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" id="headerModal">Alihkan Layanan Unit</h4>
                                </div>

                                <div class="modal-body" style="text-align: right; ">
                                    <input hidden name="idPasien" id="idPasien"></input>
                                    <div class="item form-group">
                                        <label class="col-md-3 control-label paddingForm" for="nama">Nama</label>
                                        <div class="col-md-6">
                                            <?php
                                            $data = array(
                                                'name' => 'nama',
                                                'autocomplete' => 'off',
                                                'required' => 'required',
                                                'id' => 'nama',
                                                'type' => 'text',
                                                'class' => 'form-control col-md-7 col-xs-12',
                                                'readonly' =>'readonly'
                                            );
                                            echo form_input($data);
                                            ?>
                                        </div><br><br>

                                        <label class="col-md-3 control-label paddingForm" for="unitsebelum">Unit Sebelumnya</label>
                                        <div class="col-md-6">
                                            <?php
                                            $data = array(
                                                'name' => 'unitsebelum',
                                                'autocomplete' => 'off',
                                                'required' => 'required',
                                                'id' => 'unitsebelum',
                                                'type' => 'text',
                                                'class' => 'form-control col-md-7 col-xs-12',
                                                'readonly' =>'readonly'
                                            );
                                            echo form_input($data);
                                            ?>
                                        </div><br><br>

                                        <label class="col-md-3 control-label paddingForm" for="unitsesudah">Unit Tujuan</label>
                                        <div class="col-md-6">
                                        <select class="select2_single form-control" tabindex="-1" name="unitsesudah" required>
                                            <option id= "unitsesudah" hidden="" value="">Pilih jenis pasien</option>
                                                <?php 
                                                foreach ($daftarUnit['data'] as $field => $values) {
                                                    echo "<option value=";
                                                    echo $values['unit_id'];
                                                    echo ">";
                                                    echo $values['nama_unit']; 
                                                    echo "</option>";
                                                }
                                                ?>
                                        </select>
                                        </div><br><br>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                <button class="btn btn-primary" id="submitModal" type="submit">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                    <?php if($this->session->flashdata('pesan')) {?>
                        <div class="alert alert-success alert-dismissible" id="success-alert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-info"></i> Notifikasi</h4>
                            <?php echo $this->session->flashdata('metode').$this->session->flashdata('pesan'); ?>
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
        document.getElementById("formModal").action ="<?php echo base_url('/loket/antrianberjalan/insertdata') ?>";
    });
});

</script>
<script>
function editModal(id,nama,unit) {
    document.getElementById("idPasien").value = id;
    document.getElementById("nama").value = nama;
    document.getElementById("unitsebelum").value = unit;
    $("#pindahunit").modal();
}
</script>
<script>
    $.fn.dataTable.Buttons.swfPath = '<?php echo base_url();?>datatables/extensions/Buttons/swf/flashExport.swf';
    $(document).ready(function () {
        var table_antrianUtama = $('#antrianUtama').DataTable( {
            //"dom": '<"top">lt<"bottom"if><"clear">',
            "bSort": false,
            "serverSide": true,
            "info": false,
            "ajax":{
                url :"<?php Print( base_url('/loket/antrianberjalan/ajaxantrianberjalan/') ); ?>",
                type: "post",
                error: function(){
                }
            },
            "language": {
                "emptyTable": "Tidak ada data untuk Antrian Utama"
            }
        } );
        setInterval( function () {
            table_antrianUtama.ajax.reload(null, false);
        }, 10000 );
    });
    
</script>
</body>
</html>
