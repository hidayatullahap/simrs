<style rel="stylesheet">
    
    .paddingForm {
        padding-top: 1.5%;
        text-align: right;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <a href="<?php echo base_url('/kelola/kelolajenispasien'); ?>"><font color='black'><strong>Kelola - Jenis Pasien</strong></font></a>
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
                                <button type="button" class="btn btn-info btn-md" id="buttonTambah" data-toggle="modal" data-target="#addForm">Tambah Jenis Pasien</button>
                            </div>
                            <form method="post" action="<?php echo base_url('/kelola/kelolajenispasien/search') ?>">
                            <div class="input-group col-xs-2" style="float: right;padding-right:15px;">
                            <input  type="text" class="form-control" autocomplete="off" placeholder="Cari nama Jenis Pasien" name="search" id="search">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                </div>
                            </div>
                            </form>
                        </div>
                        
                        <table class="table table-bordered table-hover" id="tabel" cellspacing="0" width="100%">
                            <thead bgcolor="#4a4a4c">
                            <tr>
                                <th><font color="white">Jenis Pasien ID</th>
                                <th><font color="white">Nama Jenis Pasien</th>
                                <th><font color="white">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($data->num_rows>0) {
                                $i=1;
                                foreach ($data as $field => $values) {
                                    echo "<tr>";
                                    echo "<td width='8%'>".$values['jenis_pasien_id']."</td>";
                                    echo "<td>".$values['nama_jenis_pasien']."</td>";

                                    echo "<td><a data-toggle='tooltip' onclick='editModal($i);' title='edit'><i class='fa fa-fw fa-edit'></i></a>
                                    <a data-toggle='tooltip' title='hapus'><i class='fa fa-fw fa-remove' data-toggle='modal' data-target='.bs-example-modal-sm' data-id='".$values['jenis_pasien_id']."' 
                                    data-nama='".$values['nama_jenis_pasien']."'></i></a></td>";
                                    echo "</tr>";
                                    $i++;
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

                    <form method="post" id="formModal" action="<?php echo base_url('/kelola/kelolajenispasien/insertdata') ?>">
                    <div class="modal fade" id="addForm" role="dialog">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" id="headerModal">Tambah Jenis Pasien</h4>
                                </div>

                                <div class="modal-body" style="text-align: right; ">
                                    <div class="item form-group">
                                        <label class="col-md-4 control-label paddingForm" for="nama_jenis_pasien">Nama Jenis Pasien</label>
                                        <div class="col-md-6">
                                            <?php
                                            $data = array(
                                                'name' => 'nama_jenis_pasien',
                                                'autocomplete' => 'off',
                                                'required' => 'required',
                                                'id' => 'nama_jenis_pasien',
                                                'type' => 'text',
                                                'class' => 'form-control col-md-7 col-xs-12',
                                                'placeholder' => 'Isikan Jenis Pasien',
                                            );
                                            echo form_input($data);
                                            ?>
                                        </div>
                                    </div>
                                </div><br><br>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                <button class="btn btn-primary" id="submitModal" type="submit">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                    <div id="delete" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Hapus Data Jenis Pasien</h4>
                            </div>
                            <div class="modal-body">
                                Anda yakin ingin menghapus data Jenis Pasien <br>
                                Nama : <strong class="modal-Nama">Nama Jenis Pasien</strong>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal">Batal</button>
                                <a id="deletelink" href="#"><button type="button" class="btn btn-danger">Hapus</button></a>
                            </div>
                            </div>
                        </div>
                    </div>    
                    <div class="box-footer clearfix">
                        <?php
                            require_once(CLASSES_DIR  . "pagination.php");
                            $entity = new Pagination();
                        if (isset($totalPages)) {
                            $entity->tampilkan('kelolajenispasien',$currentPage, $totalPages);
                        }
                        ?>
                    </div>
                    <?php if($this->session->flashdata('pesan')) {?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-info"></i> Data Jenis Pasien</h4>
                            <?php echo $this->session->flashdata('metode')." data Jenis Pasien ".$this->session->flashdata('pesan'); ?>
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
        document.getElementById("deletelink").href="<?php echo base_url('kelola/kelolajenispasien/deletedata/'); ?>"+"/"+dataID;
    });
</script>

<script>
$(document).ready(function(){
    $("#buttonTambah").click(function(){
        document.getElementById("headerModal").innerHTML = "Tambah Jenis Pasien";
        document.getElementById("submitModal").innerHTML = "Simpan";
        document.getElementById("formModal").action ="<?php echo base_url('/kelola/kelolajenispasien/insertdata') ?>";
    });
});

function editModal(row) {
    var id= document.getElementById("tabel").rows[row].cells[0].innerHTML;
    
    document.getElementById("nama_jenis_pasien").value = document.getElementById("tabel").rows[row].cells[1].innerHTML;

    document.getElementById("headerModal").innerHTML = "Edit Jenis Pasien";
    document.getElementById("submitModal").innerHTML = "Simpan Perubahan";
    document.getElementById("formModal").action ="<?php echo base_url('/kelola/kelolajenispasien/editdata') ?>"+"/"+id;
    $("#addForm").modal();
}
</script>

</body>
</html>
