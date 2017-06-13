<style rel="stylesheet">
    
    .paddingForm {
        padding-top: 1.5%;
        text-align: right;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <a href="<?php echo base_url('/kelola/kelolabarang'); ?>"><font color='black'><strong>Kelola - Barang</strong></font></a>
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
                                <button type="button" class="btn btn-info btn-md" id="buttonTambah" data-toggle="modal" data-target="#addForm">Tambah Barang</button>
                            </div>
                            <form method="post" action="<?php echo base_url('/kelola/kelolabarang/search') ?>">
                            <div class="input-group col-xs-2" style="float: right;padding-right:15px;">
                            <input  type="text" class="form-control" placeholder="Cari nama Barang" name="search" id="search">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                </div>
                            </div>
                            </form>
                        </div>
                        
                        <table class="table table-bordered table-hover" id="tabel" cellspacing="0" width="100%">
                            <thead bgcolor="#4a4a4c">
                            <tr>
                                <th><font color="white">Barang ID</th>
                                <th><font color="white">Nama Barang</th>
                                <th><font color="white">Grup Barang</th>
                                <th><font color="white">Merek/Model/Ukuran</th>
                                <th><font color="white">Satuan</th>
                                <th><font color="white">Harga Jual</th>
                                <th><font color="white">Tanggal Pencatatan</th>
                                <th><font color="white">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($data->num_rows>0) {
                                $i=1;
                                foreach ($data as $field => $values) {
                                    echo "<tr>";
                                    echo "<td width='5%'>".$values['barang_id']."</td>";
                                    echo "<td>".$values['nama_barang']."</td>";
                                    echo "<td>".$values['grup_barang']."</td>";
                                    echo "<td>".$values['merek_model_ukuran']."</td>";
                                    echo "<td>".$values['satuan']."</td>";
                                    echo "<td>".$values['harga_jual']."</td>";

                                    $date=strtotime($values['tanggal_pencatatan']);
                                    echo "<td>".date('d M Y H:i:s', $date)."</td>";

                                    echo "<td><a data-toggle='tooltip' onclick='editModal($i);' title='edit'><i class='fa fa-fw fa-edit'></i></a>
                                    <a data-toggle='tooltip' title='hapus'><i class='fa fa-fw fa-remove' data-toggle='modal' data-target='.bs-example-modal-sm' data-id='".$values['barang_id']."' 
                                    data-nama='".$values['nama_barang']."'></i></a></td>";
                                    echo "</tr>";
                                    $i++;
                                }
                            } else {
                                echo "<tr><td colspan='6' align='center'><font size='3' color='red'>Tidak ada data</font></td></tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    <?php  if (isset($totalPages)) {
                        echo "<p style='font-family:Calibri; font-size:85%;'>Showing page: ".$currentPage." with total data: ".$totalData."</p>";
                        }
                    ?>

                    <form method="post" id="formModal" action="<?php echo base_url('/kelola/kelolabarang/insertdata') ?>">
                    <div class="modal fade" id="addForm" role="dialog">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" id="headerModal">Tambah Barang</h4>
                                </div>

                                <div class="modal-body" style="text-align: right; ">
                                    <div class="item form-group">
                                        <label class="col-md-3 control-label paddingForm" for="nama_barang">Nama Barang</label>
                                        <div class="col-md-6">
                                            <?php
                                            $data = array(
                                                'name' => 'nama_barang',
                                                'autocomplete' => 'off',
                                                'required' => 'required',
                                                'id' => 'nama_barang',
                                                'type' => 'text',
                                                'class' => 'form-control col-md-7 col-xs-12',
                                                'placeholder' => 'Isikan nama barang',
                                            );
                                            echo form_input($data);
                                            ?>
                                        </div><br><br>

                                        <label class="col-md-3 control-label paddingForm" for="jenis_pasien">Jenis grup barang</label>
                                        <div class="col-md-6">
                                        <select class="select2_single form-control" tabindex="-1" name="grup_barang_id" required>
                                            <option id= "grup_barang_id" hidden="" value="">Pilih grup barang</option>
                                                <?php 
                                                foreach ($daftarGrupBarang['data'] as $field => $values) {
                                                    echo "<option value=";
                                                    echo $values['grup_barang_id'];
                                                    echo ">";
                                                    echo $values['nama_grup_barang']; 
                                                    echo "</option>";
                                                }
                                                ?>
                                        </select>
                                        </div><br><br>

                                        <label class="col-md-3 control-label paddingForm" for="jenis_pasien">Jenis satuan</label>
                                        <div class="col-md-6">
                                        <select class="select2_single form-control" tabindex="-1" name="satuan_id" required>
                                            <option id= "satuan_id" hidden="" value="">Pilih satuan</option>
                                                <?php 
                                                foreach ($daftarSatuan['data'] as $field => $values) {
                                                    echo "<option value=";
                                                    echo $values['satuan_id'];
                                                    echo ">";
                                                    echo $values['nama_satuan']; 
                                                    echo "</option>";
                                                }
                                                ?>
                                        </select>
                                        </div><br><br>

                                        <label class="col-md-3 control-label paddingForm" for="harga_jual">Harga Jual</label>
                                        <div class="col-md-6">
                                            <?php
                                            $data = array(
                                                'name' => 'harga_jual',
                                                'autocomplete' => 'off',
                                                'required' => 'required',
                                                'id' => 'harga_jual',
                                                'type' => 'text',
                                                'class' => 'form-control col-md-7 col-xs-12',
                                                'placeholder' => 'Isikan harga barang',
                                            );
                                            echo form_input($data);
                                            ?>
                                        </div><br><br>

                                        <label class="col-md-3 control-label paddingForm" for="merek_model_ukuran">Merek/model/ukuran</label>
                                        <div class="col-md-6">
                                            <?php
                                            $data = array(
                                                'name' => 'merek_model_ukuran',
                                                'autocomplete' => 'off',
                                                'required' => 'required',
                                                'id' => 'merek_model_ukuran',
                                                'type' => 'text',
                                                'class' => 'form-control col-md-7 col-xs-12',
                                                'placeholder' => 'Isikan merek/model/ukuran',
                                            );
                                            echo form_input($data);
                                            ?>
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
                    <div id="delete" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Hapus Data Barang</h4>
                            </div>
                            <div class="modal-body">
                                Anda yakin ingin menghapus data Barang <br>
                                Nama : <strong class="modal-Nama">Nama Barang</strong>
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
                            $entity->tampilkan('kelola/kelolabarang',$currentPage, $totalPages);
                        }
                        ?>
                    </div>
                    <?php if($this->session->flashdata('pesan')) {?>
                        <div class="alert alert-success alert-dismissible" id="success-alert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-info"></i> Data Barang</h4>
                            <?php echo $this->session->flashdata('metode')." data Barang ".$this->session->flashdata('pesan'); ?>
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
        document.getElementById("deletelink").href="<?php echo base_url('kelola/kelolabarang/deletedata/'); ?>"+"/"+dataID;
    });
</script>

<script>
$("#success-alert").fadeTo(3000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});

$(document).ready(function(){
    $("#buttonTambah").click(function(){
        document.getElementById("headerModal").innerHTML = "Tambah Barang";
        document.getElementById("submitModal").innerHTML = "Simpan";
        document.getElementById("formModal").action ="<?php echo base_url('/kelola/kelolabarang/insertdata') ?>";
    });
});

function editModal(row) {
    var id= document.getElementById("tabel").rows[row].cells[0].innerHTML;
    
    document.getElementById("nama_barang").value           = document.getElementById("tabel").rows[row].cells[1].innerHTML;
    document.getElementById("grup_barang_id").innerHTML = document.getElementById("tabel").rows[row].cells[2].innerHTML;
    document.getElementById("satuan_id").innerHTML   = document.getElementById("tabel").rows[row].cells[4].innerHTML;
    document.getElementById("merek_model_ukuran").value   = document.getElementById("tabel").rows[row].cells[3].innerHTML;
    document.getElementById("harga_jual").value   = document.getElementById("tabel").rows[row].cells[5].innerHTML;
    document.getElementById("headerModal").innerHTML = "Edit Barang";
    document.getElementById("submitModal").innerHTML = "Simpan Perubahan";
    document.getElementById("formModal").action ="<?php echo base_url('/kelola/kelolabarang/editdata') ?>"+"/"+id;
    $("#addForm").modal();
}
</script>


</body>
</html>
