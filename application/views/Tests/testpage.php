<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <b>Gudang Obat - Apotek</b>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <a href="<?php echo base_url('/apotek/c_apotek/permintaanObat'); ?>"><button  id="send" type="submit" class="btn btn-primary pull-left">Tambah Permintaan Obat</button></a><br><hr>

                        <table class="display responsive no-wrap" id="dataObat" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>ID Obat</th>
                                <th>Nama Obat</th>
                                <th>Bentuk</th>
                                <th>Stok</th>
                                <th>Keterangan</th>
                                <th>Harga</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>

                        </table>

                        <br>
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

<script>
    $.fn.dataTable.Buttons.swfPath = '<?php echo base_url();?>datatables/extensions/Buttons/swf/flashExport.swf';
    $(document).ready(function() {
        $('#dataObat').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'excel',
                {
                    extend: 'pdf',
                    orientation: 'landscape'
                },
                'print'
            ]
        } );
    } );
</script>


<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>" ></script>
<script src="<?php echo base_url('assets/js/plugins/fastclick/fastclick.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/AdminLTE/app.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/slimScroll/jquery.slimscroll.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/AdminLTE/demo.js'); ?>"></script>

<script>
    $('#delete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var dataID = button.data('id')
        var dataNIK = button.data('nik')
        var dataNama = button.data('nama')

        var modal = $(this)
        modal.find('.modal-NIK').text(dataNIK)
        modal.find('.modal-Nama').text(dataNama)
        document.getElementById("deletelink").href="<?php echo base_url('loket/c_daftarbaru/hapuspasien/'); ?>"+"/"+dataID;
    })
</script>

</body>
</html>
