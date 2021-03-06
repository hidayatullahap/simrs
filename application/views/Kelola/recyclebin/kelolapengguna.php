<style rel="stylesheet">
    
    .paddingForm {
        padding-top: 1.5%;
        text-align: right;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <a href="<?php echo base_url('/kelola/kelolapengguna'); ?>"><font color='black'><strong>Kelola - Pengguna</strong></font></a>
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
                                <button type="button" class="btn btn-info btn-md" id="buttonTambah" data-toggle="modal" data-target="#addForm">Tambah Pengguna</button>
                            </div>
                            <form method="post" action="<?php echo base_url('/kelola/kelolapengguna/search') ?>">
                            <div class="input-group col-xs-2" style="float: right;padding-right:15px;">
                            <input  type="text" class="form-control" placeholder="Cari nama Pengguna" name="search" id="search">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                </div>
                            </div>
                            </form>
                        </div>
                        
                        <table class="table table-bordered table-hover" id="tabel" cellspacing="0" width="100%">
                            <thead bgcolor="#4a4a4c">
                            <tr>
                                <th><font color="white">Pengguna ID</th>
                                <th><font color="white">Nama Pengguna</th>
                                <th><font color="white">NIP</th>
                                <th><font color="white">Username</th>
                                <th><font color="white">Role</th>
                                <th><font color="white">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($data->num_rows>0) {
                                $i=1;
                                foreach ($data as $field => $values) {
                                    echo "<tr>";
                                    echo "<td width='5%'>".$values['pengguna_id']."</td>";
                                    echo "<td>".$values['nama']."</td>";
                                    echo "<td>".$values['nip']."</td>";
                                    echo "<td>".$values['username']."</td>";
                                    echo "<td>".$values['role']."</td>";

                                    echo "<td><a data-toggle='tooltip' onclick='editModal($i);' title='edit'><i class='fa fa-fw fa-edit'></i></a>
                                    <a data-toggle='tooltip' title='hapus'><i class='fa fa-fw fa-remove' data-toggle='modal' data-target='.bs-example-modal-sm' data-id='".$values['pengguna_id']."' 
                                    data-nama='".$values['nama']."'></i></a></td>";
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

                    <form method="post" id="formModal" action="<?php echo base_url('/kelola/kelolapengguna/insertdata') ?>">
                    <div class="modal fade" id="addForm" role="dialog">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" id="headerModal">Tambah Pengguna</h4>
                                </div>

                                <div class="modal-body" style="text-align: right; ">
                                    <div class="item form-group">
                                        <label class="col-md-3 control-label paddingForm" for="nama">Nama Pengguna</label>
                                        <div class="col-md-6">
                                            <?php
                                            $data = array(
                                                'name' => 'nama',
                                                'autocomplete' => 'off',
                                                'required' => 'required',
                                                'id' => 'nama',
                                                'type' => 'text',
                                                'class' => 'form-control col-md-7 col-xs-12',
                                                'placeholder' => 'Isikan nama Pengguna',
                                            );
                                            echo form_input($data);
                                            ?>
                                        </div><br><br>
                                        <label class="col-md-3 control-label paddingForm" for="nip">NIP</label>
                                        <div class="col-md-6">
                                            <?php
                                            $data = array(
                                                'name' => 'nip',
                                                'autocomplete' => 'off',
                                                'required' => 'required',
                                                'id' => 'nip',
                                                'type' => 'text',
                                                'class' => 'form-control col-md-7 col-xs-12',
                                                'placeholder' => 'Isikan NIP Pengguna',
                                            );
                                            echo form_input($data);
                                            ?>
                                        </div><br><br>
                                        <label class="col-md-3 control-label paddingForm" for="role">Role</label>
                                        <div class="col-md-6">
                                            <?php
                                            $data = array(
                                                'name' => 'role',
                                                'autocomplete' => 'off',
                                                'required' => 'required',
                                                'id' => 'role',
                                                'type' => 'text',
                                                'class' => 'form-control col-md-7 col-xs-12',
                                                'placeholder' => 'Isikan role pengguna',
                                            );
                                            echo form_input($data);
                                            ?>
                                        </div><br><br>

                                        <label class="col-md-3 control-label paddingForm" for="username">Username</label>
                                        <div class="col-md-6">
                                            <?php
                                            $data = array(
                                                'name' => 'username',
                                                'autocomplete' => 'off',
                                                'required' => 'required',
                                                'id' => 'username',
                                                'type' => 'text',
                                                'class' => 'form-control col-md-7 col-xs-12',
                                                'placeholder' => 'Isikan username Pengguna',
                                            );
                                            echo form_input($data);
                                            ?>
                                        </div><br><br>
                                        <div id="formGroupPassword">
                                        <label class="col-md-3 control-label paddingForm" for="password">Password</label>
                                        <div class="col-md-6">
                                            <?php
                                            $data = array(
                                                'name' => 'password',
                                                'autocomplete' => 'off',
                                                'id' => 'password',
                                                'type' => 'password',
                                                'class' => 'form-control col-md-7 col-xs-12',
                                                'placeholder' => 'Isikan password Pengguna',
                                            );
                                            echo form_input($data);
                                            ?>
                                        </div></div>
                                        <div id="showpass"><input type="checkbox" onclick="showPasswordInput()">Ganti password</div>
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
                                <h4 class="modal-title" id="myModalLabel">Hapus Data Pengguna</h4>
                            </div>
                            <div class="modal-body">
                                Anda yakin ingin menghapus data Pengguna <br>
                                Nama : <strong class="modal-Nama">Nama Pengguna</strong>
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
                            $entity->tampilkan('kelola/kelolapengguna',$currentPage, $totalPages);
                        }
                        ?>
                    </div>
                    <?php if($this->session->flashdata('pesan')) {?>
                        <div class="alert alert-success alert-dismissible" id="success-alert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-info"></i> Data Pengguna</h4>
                            <?php echo $this->session->flashdata('metode')." data Pengguna ".$this->session->flashdata('pesan'); ?>
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
        document.getElementById("deletelink").href="<?php echo base_url('kelola/kelolapengguna/deletedata/'); ?>"+"/"+dataID;
    });
</script>

<script>
$("#success-alert").fadeTo(3000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});

$(document).ready(function(){
    $("#buttonTambah").click(function(){
        document.getElementById("headerModal").innerHTML = "Tambah Pengguna";
        document.getElementById("submitModal").innerHTML = "Simpan";
        document.getElementById("formGroupPassword").style.display = 'block';
        document.getElementById("formModal").action ="<?php echo base_url('/kelola/kelolapengguna/insertdata') ?>";
        document.getElementById("nama").value       = "";
        document.getElementById("nip").value        = "";
        document.getElementById("username").value   = "";
        document.getElementById("role").value       = "";
        document.getElementById("showpass").style.display = 'none';
    });
});

function editModal(row) {
    var id= document.getElementById("tabel").rows[row].cells[0].innerHTML;
    document.getElementById("password").value       = "";
    document.getElementById("nama").value       = document.getElementById("tabel").rows[row].cells[1].innerHTML;
    document.getElementById("nip").value        = document.getElementById("tabel").rows[row].cells[2].innerHTML;
    document.getElementById("username").value   = document.getElementById("tabel").rows[row].cells[3].innerHTML;
    document.getElementById("role").value       = document.getElementById("tabel").rows[row].cells[4].innerHTML;
    document.getElementById("formGroupPassword").style.display = 'none';
    document.getElementById("showpass").style.display = 'block';
    document.getElementById("headerModal").innerHTML = "Edit Pengguna";
    document.getElementById("submitModal").innerHTML = "Simpan Perubahan";
    document.getElementById("formModal").action ="<?php echo base_url('/kelola/kelolapengguna/editdata') ?>"+"/"+id;
    $("#addForm").modal();
}

function showPasswordInput() {
    var ib = document.getElementById("formGroupPassword").style.display;
    if (ib=='none'){
        document.getElementById("formGroupPassword").style.display = 'block';
    }else{
        document.getElementById("formGroupPassword").style.display = 'none';
    }
}
</script>

</body>
</html>
