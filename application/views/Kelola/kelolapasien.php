<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <b>Kelola - Pasien</b>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <div class="form-group row">
                            <div class="col-xs-2">
                                <a href="<?php echo base_url('/apotek/c_apotek/permintaanObat'); ?>"><button  id="send" type="submit" class="btn btn-primary pull-left">Tambah Permintaan Obat</button></a>
                            </div>

                            <div class="input-group col-xs-2" style="float: right;padding-right:15px;">
                            <input  type="text" class="form-control" placeholder="Search" name="search" id="search">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                </div>
                            </div>
                        </div>
                        
                        <table class="table table-bordered table-hover" id="tabel" cellspacing="0" width="100%">
                            <thead bgcolor="#4a4a4c">
                            <tr>
                                <th><font color="white">Pasien ID</th>
                                <th><font color="white">Nama</th>
                                <th><font color="white">Tempat Lahir</th>
                                <th><font color="white">Tanggal Lahir</th>
                                <th><font color="white">Alamt</th>
                                <th><font color="white">Jenis Kelamin</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($data as $field => $values) {
                                echo "<tr>";
                                echo "<td width='5%'>".$values['pasien_id']."</td>";
                                echo "<td>".$values['nama']."</td>";
                                echo "<td>".$values['tanggal_lahir']."</td>";
                                echo "<td>".$values['tempat_lahir']."</td>";
                                echo "<td>".$values['alamat']."</td>";
                                echo "<td>".$values['alamat']."</td>";
                                echo "</tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                        <?php echo "<p style='font-family:Calibri; font-size:85%;'>Showing page: ".$currentPage." with total data: ".$totalData."</p>"; ?>
                    <div class="box-footer clearfix">
                    <ul class="pagination pagination-lg no-margin pull-right">
                        <?php
                        if($currentPage>1){
                            echo "<li><a href='".base_url('/kelola/kelolapasien/page/'.($currentPage-1))."'>&laquo;</a></li>";
                        }else{
                            echo "<li><a href='".base_url('/kelola/kelolapasien/page/'.($currentPage))."'>&laquo;</a></li>";
                        }
                        for ($i=1; $i-1 < $totalPages; $i++) {
                            if ($i==$currentPage) {
                                echo "<li class='active'><a href='".base_url('/kelola/kelolapasien/page/'.$i)."'>$i</a></li>";
                            } else {
                                echo "<li><a href='".base_url('/kelola/kelolapasien/page/'.$i)."'>$i</a></li>";
                            }
                        }
                        if($currentPage<$totalPages){
                            echo "<li><a href='".base_url('/kelola/kelolapasien/page/'.($currentPage+1))."'>&raquo;</a></li>";
                        }else{
                            echo "<li><a href='".base_url('/kelola/kelolapasien/page/'.($currentPage))."'>&raquo;</a></li>";
                        }
                        ?>
                    </ul>
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
