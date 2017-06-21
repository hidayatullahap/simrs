<style rel="stylesheet">
    
    .paddingForm {
        padding-top: 1.5%;
        text-align: right;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <a href="<?php echo base_url('/loket/layananpasien'); ?>"><font color='black'><strong>Layanan - Pasien</strong></font></a>
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
                                <button type="button" class="btn btn-info btn-md" id="buttonTambah" data-toggle="modal" data-target="#addForm">Tambah Pasien</button>
                            </div>
                            <form method="post" action="<?php echo base_url('/loket/layananpasien/search') ?>">
                            <div class="input-group col-xs-2" style="float: right;padding-right:15px;">
                            <input  type="text" class="form-control" placeholder="Cari nama pasien" name="search" id="search">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                </div>
                            </div>
                            </form>
                        </div>
                        
                        <table class="table table-bordered table-hover responsive" id="tabel" cellspacing="0" width="100%">
                            <thead bgcolor="#4a4a4c">
                            <tr>
                                <th><font color="white">Pasien ID</th>
                                <th><font color="white">Nama</th>
                                <th><font color="white">Tempat Lahir</th>
                                <th><font color="white">Tanggal Lahir</th>
                                <th><font color="white">Alamat</th>
                                <th><font color="white">Jenis Kelamin</th>
                                <th><font color="white">Nomor RM</th>
                                <th><font color="white">Agama</th>
                                <th><font color="white">Golongan Darah</th>
                                <th><font color="white">Jenis Pasien</th>
                                <th><font color="white">Tanggal Daftar</th>
                                <th><font color="white">Aksi</th>
                                <th><font color="white">Layanan</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($data->num_rows>0) {
                                $i=1;
                                foreach ($data as $field => $values) {
                                    echo "<tr>";
                                    echo "<td width='4%'>".$values['pasien_id']."</td>";
                                    echo "<td>".$values['nama']."</td>";
                                    echo "<td>".$values['tempat_lahir']."</td>";
                                    echo "<td>".$values['tanggal_lahir']."</td>";
                                    echo "<td>".$values['alamat']."</td>";
                                    echo "<td>".$values['jenis_kelamin']."</td>";
                                    echo "<td>".$values['nomor_RM']."</td>";
                                    echo "<td>".$values['agama']."</td>";
                                    echo "<td>".$values['golongan_darah']."</td>";
                                    echo "<td>".$values['jenis_pasien']."</td>";
                                    $date=strtotime($values['tanggal_daftar']);
                                    echo "<td>".date('d M Y H:i:s', $date)."</td>";

                                    echo "<td width='4%' align='center'><span data-toggle='tooltip' style='cursor: pointer;' onclick='editModal($i);' title='Edit data pasien'><i class='fa fa-sm fa-edit'>Edit</i></span></td>";
                                    if($values['is_dilayani']){
                                        $is_disabled="disabled";
                                    }else{
                                        $is_disabled="";
                                    }
                                    echo "<td width='5%' align='center'><button type='button' class='btn btn-primary btn-sm $is_disabled' id='buttonTambahLayanan'  onclick='kunjungan($i);'>Kunjungan</button></td>";
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

                    <form method="post" id="formModal" action="<?php echo base_url('/loket/layananpasien/insertdata') ?>">
                    <div class="modal fade" id="addForm" role="dialog">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" id="headerModal">Tambah Pasien</h4>
                                </div>

                                <div class="modal-body" style="text-align: right; ">
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
                                                'placeholder' => 'Isikan nama pasien',
                                            );
                                            echo form_input($data);
                                            ?>
                                        </div><br><br>

                                        <label class="col-md-3 control-label paddingForm" for="tanggal_lahir">Tanggal Lahir</label>
                                        <div class="col-md-4">
                                            <?php
                                            $data = array(
                                                'name' => 'tanggal_lahir',
                                                'autocomplete' => 'off',
                                                'required' => 'required',
                                                'id' => 'tanggal_lahir',
                                                'type' => 'date',
                                                'class' => 'form-control col-md-7 col-xs-12',
                                                'placeholder' => 'Isikan tanggal lahir',
                                            );
                                            echo form_input($data);
                                            ?>
                                        </div><br><br>

                                        <label class="col-md-3 control-label paddingForm" for="tempat_lahir">Tempat Lahir</label>
                                        <div class="col-md-4">
                                            <?php
                                            $data = array(
                                                'name' => 'tempat_lahir',
                                                'autocomplete' => 'off',
                                                'required' => 'required',
                                                'id' => 'tempat_lahir',
                                                'type' => 'text',
                                                'class' => 'form-control col-md-7 col-xs-12',
                                                'placeholder' => 'Isikan tempat lahir',
                                            );
                                            echo form_input($data);
                                            ?>
                                        </div><br><br>

                                       <label class="col-md-3 control-label paddingForm" for="alamat">Alamat</label>
                                        <div class="col-md-8">
                                            <?php
                                            $data = array(
                                                'name' => 'alamat',
                                                'autocomplete' => 'off',
                                                'required' => 'required',
                                                'id' => 'alamat',
                                                'type' => 'text',
                                                'class' => 'form-control col-md-7 col-xs-12',
                                                'placeholder' => 'Isikan alamat',
                                            );
                                            echo form_input($data);
                                            ?>
                                        </div><br><br>

                                        <label class="col-md-3 control-label paddingForm" for="golongan_darah">Jenis Kelamin</label>
                                        <div class="col-md-6">
                                        <select class="select2_single form-control" tabindex="-1" name="jenis_kelamin" required>
                                            <option id= "jenis_kelamin" hidden="" value="">Pilih jenis kelamin</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                        </div><br><br>

                                        <label class="col-md-3 control-label paddingForm" for="nomor_rm">Nomor Rekam Medis</label>
                                        <div class="col-md-4">
                                            <?php
                                            $data = array(
                                                'name' => 'nomor_rm',
                                                'autocomplete' => 'off',
                                                'required' => 'required',
                                                'id' => 'nomor_rm',
                                                'type' => 'text',
                                                'class' => 'form-control col-md-7 col-xs-12',
                                                'placeholder' => 'Isikan nomor rm',
                                            );
                                            echo form_input($data);
                                            ?>
                                        </div><br><br><br>

                                        <label class="col-md-3 control-label paddingForm" for="agama">Agama</label>
                                        <div class="col-md-4">
                                            <?php
                                            $data = array(
                                                'name' => 'agama',
                                                'autocomplete' => 'off',
                                                'required' => 'required',
                                                'id' => 'agama',
                                                'type' => 'text',
                                                'class' => 'form-control col-md-7 col-xs-12',
                                                'placeholder' => 'Isikan agama',
                                            );
                                            echo form_input($data);
                                            ?>
                                        </div><br><br>

                                        <label class="col-md-3 control-label paddingForm" for="golongan_darah">Golongan Darah</label>
                                        <div class="col-md-6">
                                        <select class="select2_single form-control" tabindex="-1" name="golongan_darah" required>
                                            <option id= "golongan_darah" hidden="" value="">Pilih golongan darah</option>
                                            <option value="O">O</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="AB">AB</option>
                                        </select>
                                        </div><br><br>

                                        <label class="col-md-3 control-label paddingForm" for="jenis_pasien">Jenis Pasien</label>
                                        <div class="col-md-6">
                                        <select class="select2_single form-control" tabindex="-1" name="optionJenisPasien" required>
                                            <option id= "optionJenisPasien" hidden="" value="">Pilih jenis pasien</option>
                                                <?php 
                                                foreach ($daftarJenisPasien['data'] as $field => $values) {
                                                    echo "<option value=";
                                                    echo $values['jenis_pasien_id'];
                                                    echo ">";
                                                    echo $values['nama_jenis_pasien']; 
                                                    echo "</option>";
                                                }
                                                ?>
                                        </select>
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
                    <form method="post" id="formModal" action="<?php echo base_url('/loket/layananpasien/kunjungan') ?>">
                    <div class="modal fade" id="kunjungan" role="dialog">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" id="headerModal">Kunjungan</h4>
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
                                                'id' => 'namapasien',
                                                'type' => 'text',
                                                'class' => 'form-control col-md-7 col-xs-12',
                                                'readonly' =>'readonly'
                                            );
                                            echo form_input($data);
                                            ?>
                                        </div><br><br>
                                        
                                        <label class="col-md-3 control-label paddingForm" for="jenis_kunjungan">Jenis Kunjungan</label>
                                        <div class="col-md-6">
                                        <select class="select2_single form-control" tabindex="-1" name="jenis_kunjungan" required>
                                            <option id= "jenis_kunjungan" hidden="" value="">Pilih jenis kunjungan</option>
                                                <option value="rawat_jalan">Rawat Jalan</option>
                                        </select>
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
                    <div id="delete" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Hapus Data Pasien</h4>
                            </div>
                            <div class="modal-body">
                                Anda yakin ingin menghapus data pasien <br>
                                Nama : <strong class="modal-Nama">Nama Pasien</strong>
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
                            $entity->tampilkan('loket/layananpasien',$currentPage, $totalPages);
                        }
                        ?>
                    </div>
                    <?php if($this->session->flashdata('pesan')) {?>
                        <div class="alert alert-success alert-dismissible" id="success-alert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-info"></i> Notifikasi</h4>
                            <?php echo $this->session->flashdata('metode')." pasien ".$this->session->flashdata('pesan'); ?>
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
        document.getElementById("formModal").action ="<?php echo base_url('/loket/layananpasien/insertdata') ?>";
    });
});

function editModal(row) {
    var id= document.getElementById("tabel").rows[row].cells[0].innerHTML;
    
    document.getElementById("nama").value           = document.getElementById("tabel").rows[row].cells[1].innerHTML;
    document.getElementById("tempat_lahir").value  = document.getElementById("tabel").rows[row].cells[2].innerHTML;
    document.getElementById("tanggal_lahir").value   = document.getElementById("tabel").rows[row].cells[3].innerHTML;
    document.getElementById("alamat").value         = document.getElementById("tabel").rows[row].cells[4].innerHTML;
    //document.getElementById("jenis_kelamin").value  = document.getElementById("tabel").rows[row].cells[5].innerHTML;
    document.getElementById("jenis_kelamin").innerHTML  = document.getElementById("tabel").rows[row].cells[5].innerHTML;
    document.getElementById("nomor_rm").value       = document.getElementById("tabel").rows[row].cells[6].innerHTML;
    document.getElementById("agama").value          = document.getElementById("tabel").rows[row].cells[7].innerHTML;
    //document.getElementById("golongan_darah").value = document.getElementById("tabel").rows[row].cells[8].innerHTML;
    document.getElementById("golongan_darah").innerHTML = document.getElementById("tabel").rows[row].cells[8].innerHTML;
    //document.getElementById("optionJenisPasien").value   = document.getElementById("tabel").rows[row].cells[9].innerHTML;
    document.getElementById("optionJenisPasien").innerHTML   = document.getElementById("tabel").rows[row].cells[9].innerHTML;

    document.getElementById("headerModal").innerHTML = "Edit Pasien";
    document.getElementById("submitModal").innerHTML = "Simpan Perubahan";
    document.getElementById("formModal").action ="<?php echo base_url('/loket/layananpasien/editdata') ?>"+"/"+id;
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
