<style rel="stylesheet">
    .header-row_sim {
        background: #4a4a4c;
        color: #fff;

    }
    .full-width{
        width: 100%;
    }
    .row_sim {
        display: table-row;
    }

    .cell_sim {
        display: table-cell;

        padding: 6px;
        text-align: center;
    }
    .rata_tengah {
        text-align: center;
    }
    .table-remove {
        color: #700;
        cursor: pointer;

    &:hover {
         color: #f00;
     }
    }

    .kolomAksi {
        width: 5%;
    }
    .kolomKodeObat {
        width: 7%;
    }
    .kolomObat {
        width: 29%;
    }
    .kolomBatch {
        width: 18%;
    }
    .kolomKadaluarsa {
        width: 10%;
    }
    .kolomHarga {
        width: 10.5%;
    }
    .kolomJumlah {
        width: 8.5%;
    }
    .kolomDiskon {
        width: 8.5%;
    }
    .kolomPPN {
        width: 10%;
    }
</style>
<!-- Right side column. Contains the navbar and content of the page -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <b> PERMINTAAN OBAT </b><br>

        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <form method="post" id="formModal" action="<?php echo base_url('/loket/antrianberjalan/editunit') ?>">
                            <div>
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
                        </form>

                        <form method="post" action="<?php echo base_url('/farmasi/pengeluaran/tambahPengeluaranStok')?>">
                            <h2>Data Obat</h2><br>
                            <input id="obat_nama" name="obat_nama" value="" style="display: none;" readonly>
                            <div class="item form-group">
                                <?php
                                $attributes = array(
                                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12',
                                );
                                echo form_label('Cari Obat', 'obat', $attributes);
                                ?>

                                <div class="col-md-3 col-sm-3 col-xs-6">
                                    <?php
                                    $data = array(
                                        'name'        => 'obat',
                                        'id'          => 'obat',
                                        'type'        => 'text',
                                        'class'       => 'form-control col-md-7 col-xs-12',
                                        'data-validate-length-range'   => '6',
                                        'data-validate-words'        => '1',
                                        'placeholder'       => 'Isikan Cari obat',
                                    );
                                    echo form_input($data);
                                    ?>
                                </div>
                                <div class="item form-group">
                                    <?php
                                    $attributes = array(
                                        'class' => 'control-label col-md-1 col-sm-1 col-xs-1',
                                    );
                                    echo form_label('ID Obat', 'obat_id', $attributes);
                                    ?>

                                    <div class="col-md-1 col-sm-1 col-xs-1">
                                        <?php
                                        $data = array(
                                            'name'        => 'obat_id',
                                            'id'          => 'obat_id',
                                            'readonly'    => 'readonly',
                                            'type'        => 'text',
                                            'class'       => 'form-control col-md-7 col-xs-12',
                                            'data-validate-length-range'   => '6',
                                            'data-validate-words'        => '1',
                                            'placeholder'       => 'ID Obat',
                                        );
                                        echo form_input($data);
                                        ?>

                                    </div>
                                </div><br><br><br>

                                <div class="item form-group">
                                    <?php
                                    $attributes = array(
                                        'class' => 'control-label col-md-3 col-sm-3 col-xs-12',
                                    );
                                    echo form_label('Qty (Quantity)', 'qty', $attributes);
                                    ?>

                                    <div class="col-md-3 col-sm-3 col-xs-6">
                                        <?php
                                        $data = array(
                                            'name'        => 'qty',
                                            'id'          => 'qty',
                                            'type'        => 'text',
                                            'class'       => 'form-control col-md-7 col-xs-12',
                                            'data-validate-length-range'   => '6',
                                            'data-validate-words'        => '1',
                                            'placeholder'       => 'Isikan Jumlah Permintaan',
                                        );
                                        echo form_input($data);
                                        ?>

                                        <?php
                                        $data = array(
                                            'readonly'      => 'readonly',
                                            'name'        => 'stok_di_gudang',
                                            'id'          => 'stok_di_gudang',
                                            'type'        => 'text',
                                            'style'     => 'display: none'
                                        );
                                        echo form_input($data);
                                        ?>
                                    </div>
                                </div><br>
                                <div class="item form-group">
                                    <div class="item form-group">
                                        <div class="item form-group">
                                            <div class="form-group" style="margin-bottom: 30px; margin-top: 20px;">
                                                <div class="col-md-3 col-md-offset-3">
                                                    <p onclick="tambahDataKeTabel('dataObat')" class="btn btn-warning" id="tambahObat_keTabel">Tambah</p>
                                                    <p onclick="clearAllField()" class="btn btn-primary pull-right">Clear</p>
                                                </div>
                                            </div><br>
                                            <!-- TABLE DEFAULT -->
                                            <div class="form-group" style="display: none;" id="tampilkanTabel">
                                                <table style="margin-left: 10px; margin-top: 20px; text-align: center;" border="1" class="" id="dataObat"  width="99%" >
                                                    <thead>
                                                    <tr class="header-row_sim row_sim">
                                                        <th class="cell_sim">Aksi</th>
                                                        <th class="cell_sim">Untuk Unit</th>
                                                        <th class="cell_sim">Grup Barang</th>
                                                        <th class="cell_sim">Nama Barang</th>
                                                        <th class="cell_sim">Kode Barang</th>
                                                        <th class="cell_sim">Nomor Batch</th>
                                                        <th class="cell_sim">Kadaluarsa</th>
                                                        <th class="cell_sim">Jumlah</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>

                                                </table>
                                                <input id="trTotal" name="trTotal" style="display: none;" readonly>
                                            </div>
                                            <br><br>
                                            <button formnovalidate class="btn btn-default" name="batal" value="batal" type="submit"><i class="glyphicon glyphicon-remove"> Batal</i></button>
                                            <button class="btn btn-default" type="submit" name="simpan" value="simpan"><i class="fa fa-arrow-right"> Proses</i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- jQuery 2.1.3 -->
<script src="<?php echo base_url('assets/js/plugins/jQuery/jQuery-2.1.3.min.js'); ?>"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/js/plugins/fastclick/fastclick.min.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/js/AdminLTE/app.min.js'); ?>" type="text/javascript"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('assets/js/plugins/sparkline/jquery.sparkline.min.js'); ?>" type="text/javascript"></script>
<!-- jvectormap -->
<script src="<?php echo base_url('assets/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'); ?>" type="text/javascript"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url('assets/js/plugins/daterangepicker/daterangepicker.js'); ?>" type="text/javascript"></script>
<!-- datepicker -->
<script src="<?php  echo base_url('assets/js/plugins/datepicker/bootstrap-datepicker.js'); ?>" type="text/javascript"></script>
<!-- iCheck -->
<script src="<?php echo base_url('assets/js/plugins/iCheck/icheck.min.js'); ?>" type="text/javascript"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo base_url('assets/js/plugins/slimScroll/jquery.slimscroll.min.js'); ?>" type="text/javascript"></script>
<!-- ChartJS 1.0.1 -->
<script src="<?php echo base_url('assets/js/plugins/chartjs/Chart.min.js'); ?>" type="text/javascript"></script>

<!-- tautocomplete -->
<script src="<?php echo base_url('tAutocomplete/tautocomplete.js'); ?>" type="text/javascript"></script>

<script>
    var obat = document.getElementById('obat');
    var obat_nama = document.getElementById('obat_nama');
    var obat_id = document.getElementById('obat_id');
    var qty = document.getElementById('qty');

    var stok_di_gudang = document.getElementById('stok_di_gudang');

    var trTot = document.getElementById("trTotal");
    var tampilkanTabel = document.getElementById('tampilkanTabel');

    function clearAllField(){

        obat_nama.value = "";
        obat.value = obat.defaultValue;
        obat_id.value = "";
        qty.value = "";
        stok_di_gudang.value = "";
    }

    var tr = 1;
    var td = 1;
    function tambahDataKeTabel(idTabel) {
        if(obat_nama.value == ""){
            alert("Kolom Cari Obat tidak boleh kosong!");
            return;
        }
        if(obat_id.value == ""){
            alert("Obat belum dipilih, silahkan cari obat terlebih dahulu");
            return;
        }
        if(qty.value == ""){
            alert("Kolom Qty (Quantity) tidak boleh kosong!");
            return;
        }

        tampilkanTabel.style.display = "block";
        var table = document.getElementById(idTabel);
        //var rowCount = table.rows.length;
        var row = table.insertRow(1);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var cell5 = row.insertCell(4);
        var cell6 = row.insertCell(5);
        var cell7 = row.insertCell(6);
        var cell8 = row.insertCell(7);

        cell1.innerHTML = "<span class=\"table-remove glyphicon glyphicon-remove\" onclick=\"hapusBaris(this)\"></span>";
        cell2.innerHTML = "<input hidden name=\"table_obat_id[]\" value=\"" + obat_id.value + "\" class=\"full-width rata_tengah\" readonly>ASD";
        td++;
        cell3.innerHTML = "<input name=\"table_qty[]\" value=\"" + qty.value + "\" class=\"full-width rata_tengah\" readonly>";
        td++;
        cell4.innerHTML = "<input name=\"table_obat_nama[]\" value=\"" + obat_nama.value + "\" class=\"full-width\" readonly>";
        td++;
        cell5.innerHTML = "<input name=\"table_obat_nama[]\" value=\"" + obat_nama.value + "\" class=\"full-width\" readonly>";
        td++;
        cell6.innerHTML = "<input name=\"table_obat_nama[]\" value=\"" + obat_nama.value + "\" class=\"full-width\" readonly>";
        td++;
        cell7.innerHTML = "<input name=\"table_obat_nama[]\" value=\"" + obat_nama.value + "\" class=\"full-width\" readonly>";
        td++;
        cell8.innerHTML = "<input name=\"table_obat_nama[]\" value=\"" + obat_nama.value + "\" class=\"full-width\" readonly>";

        trTot.value = tr;

        tr++;
        td = 1;
        clearAllField();
    }

    function hapusBaris(r) {
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById("dataObat").deleteRow(i);
        //alert("Index: " + i);
    }
</script>
<?php
    $myArray=[]; 
    foreach ($daftarPasien['data'] as $field => $values) {
        $myArray[]=$values;
    }
?>
<script>
    $(document).ready(function() {
        var daftarObat = <?php echo json_encode($myArray);?>;

        var obat = document.getElementById('obat');
        var obat_nama = document.getElementById('obat_nama');
        var obat_id = document.getElementById('obat_id');
        var qty = document.getElementById('qty');

        var stok_di_gudang = document.getElementById('stok_di_gudang');

        var daftarSearchData = $("#obat").tautocomplete({
            hide: [true,true],
            placeholder: "Ketik kata kunci. . .",
            norecord: "data tidak ditemukan",
            highlight: "",
            columns: ['ID Obat', 'Nama Obat', 'Stok Obat', 'Harga Obat'],
            data: function () {
                try {
                    var data = daftarObat;
                }
                catch (e) {
                    alert(e)
                }
                var filterData = [];
                var searchData = eval("/" + daftarSearchData.searchdata() + "/gi");

                $.each(data, function (i, v) {
                    if ((v.pasien_id    .search(new RegExp(searchData)) != -1) || (v.nama.search(new RegExp(searchData)) != -1)  || (v.tempat_lahir.search(new RegExp(searchData)) != -1)  || (v.tanggal_lahir.search(new RegExp(searchData)) != -1)) {
                        filterData.push(v);
                    }
                });
                return filterData;

            },
            onchange: function () {
                obat_id.value = daftarSearchData.all()['ID Obat'];
                obat_nama.value = daftarSearchData.all()['Nama Obat'];
                stok_di_gudang.value = daftarSearchData.all()['Stok Obat'];
            }
        });
    });
</script>

</body>
</html>



