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
    .paddingForm {
        padding-top: 0.3%;
        text-align: right;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <a href="<?php echo base_url('/farmasi/pengeluaran'); ?>"><b> Pencatatan Resep </b></a><br>

        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                            <div class="modal-body" style="text-align: right; ">
                                <div style="text-align: center;">
                                        <h2><i>Informasi Pasien</i></h2>
                                        <br>
                                    </div>
                                    

                                    <?php
                                    if ($data->num_rows>0) {
                                        foreach ($data as $field => $values) {?>

                                    <label class="col-md-5 control-label paddingForm">Nomor Rekam Medis</label>
                                    <div class="col-md-3">
                                        <?php
                                        $value=$values['nomor_RM'];
                                        $data = array(
                                            'readonly'=> 'readonly',
                                            'type' => 'text',
                                            'class' => 'form-control',
                                            'value' => $value
                                        );
                                        echo form_input($data);
                                        ?>
                                    </div><br><br>
                                    
                                    <label class="col-md-5 control-label paddingForm">Nama Pasien</label>
                                    <div class="col-md-3">
                                        <?php
                                        $value=$values['nama'];
                                        $data = array(
                                            'name'=> 'nama_pasien',
                                            'id'=> 'nama_pasien',
                                            'readonly'=> 'readonly',
                                            'type' => 'text',
                                            'class' => 'form-control',
                                            'value' => $value
                                        );
                                        echo form_input($data);
                                        ?>
                                    </div><br><br>

                                    <label class="col-md-5 control-label paddingForm">Jenis Pasien</label>
                                    <div class="col-md-3">
                                        <?php
                                        $value=$values['nomor_RM'];
                                        $data = array(
                                            'readonly'=> 'readonly',
                                            'type' => 'text',
                                            'class' => 'form-control',
                                            'value' => $value
                                        );
                                        echo form_input($data);
                                        ?>
                                    </div><br><br>

                                    <div></div>
                                    <label class="col-md-5 control-label paddingForm">Tanggal Lahir</label>
                                    <div class="col-md-1">
                                        <?php
                                        $value=$values['tanggal_lahir'];
                                        $data = array(
                                            'readonly'=> 'readonly',
                                            'type' => 'text',
                                            'class' => 'form-control',
                                            'value' => $value
                                        );
                                        echo form_input($data);
                                        ?>
                                    </div>
                                    <div class="col-md-2">
                                        <?php
                                        $time1 = strtotime($values['tanggal_lahir']);

                                        $month1 = date("m", $time1);
                                        $year1 = date("Y", $time1);

                                        $time2 = strtotime(date('Y-m-d'));
                                        $month2 = date("m", $time2);
                                        $year2 = date("Y", $time2);

                                        $diffMonth = $month2 - $month1;
                                        $diffYear = $year2 - $year1;

                                        if ($diffMonth < 0) {
                                            $diffYear -= 1;
                                            $diffMonth += 12;
                                        }

                                        $usia = "Usia: $diffYear tahun $diffMonth bulan";

                                        $data = array(
                                            'readonly'=> 'readonly',
                                            'type' => 'text',
                                            'class' => 'form-control',
                                            'value' => $usia
                                        );
                                        echo form_input($data);
                                        ?>
                                    </div><br><br>

                                    <label class="col-md-5 control-label paddingForm">Alamat</label>
                                    <div class="col-md-3">
                                        <?php
                                        $value=$values['alamat'];
                                        $data = array(
                                            'readonly'=> 'readonly',
                                            'type' => 'text',
                                            'class' => 'form-control',
                                            'value' => $value
                                        );
                                        echo form_input($data);
                                        ?>
                                    </div><br><br>

                                    <label class="col-md-5 control-label paddingForm">Jenis Kelamin</label>
                                    <div class="col-md-3">
                                        <?php
                                        $value=$values['jenis_kelamin'];
                                        $data = array(
                                            'readonly'=> 'readonly',
                                            'type' => 'text',
                                            'class' => 'form-control',
                                            'value' => $value
                                        );
                                        echo form_input($data);
                                        ?>
                                    </div><br><br>

                                    <label class="col-md-5 control-label paddingForm">Golongan darah</label>
                                    <div class="col-md-3">
                                        <?php
                                        $value=$values['golongan_darah'];
                                        $data = array(
                                            'readonly'=> 'readonly',
                                            'type' => 'text',
                                            'class' => 'form-control',
                                            'value' => $value
                                        );
                                        echo form_input($data);
                                        ?>
                                    </div><br><br>

                                    <?php    
                                        }
                                    }
                                    ?>

                                    <hr class="style4">

                                    <div style="text-align: center;">
                                        <h2><i>Informasi Resep</i></h2>
                                        <br>
                                    </div>

                                    
                                    <label class="col-md-5 control-label paddingForm" for="barang_id">Nama Barang</label>
                                    <div class="col-md-3">
                                        <?php
                                        $data = array(
                                            'name' => 'barang_id',
                                            'autocomplete' => 'off',
                                            'required' => 'required',
                                            'id' => 'barang_id',
                                            'type' => 'text',
                                            'class' => 'form-control'
                                        );
                                        echo form_input($data);
                                        ?>
                                    </div><br><br>

                                    <label class="col-md-5 control-label paddingForm">Aturan Pakai</label>
                                    <div class="col-md-3">
                                        <?php
                                        $data = array(
                                            'name' => 'aturan_pakai',
                                            'autocomplete' => 'off',
                                            'placeholder' => 'misal 3 x 1 . . . ',
                                            'id' => 'aturan_pakai',
                                            'type' => 'text',
                                            'class' => 'form-control'
                                        );
                                        echo form_input($data);
                                        ?>
                                    </div><br><br>

                                    <label class="col-md-5 control-label paddingForm">Keterangan Tambahan</label>
                                    <div class="col-md-3">
                                        <?php
                                        $data = array(
                                            'name' => 'keterangan',
                                            'autocomplete' => 'off',
                                            'placeholder' => 'isi bila perlu . . . ',
                                            'id' => 'keterangan',
                                            'type' => 'text',
                                            'class' => 'form-control'
                                        );
                                        echo form_input($data);
                                        ?>
                                    </div><br><br>

                                    <label class="col-md-5 control-label paddingForm">Nomor Batch</label>
                                    <div class="col-md-3">
                                        <?php
                                        $data = array(
                                            'name' => 'nomor_batch',
                                            'autocomplete' => 'off',
                                            'placeholder' => 'isi nomor batch . . . ',
                                            'id' => 'nomor_batch',
                                            'type' => 'text',
                                            'class' => 'form-control'
                                        );
                                        echo form_input($data);
                                        ?>
                                    </div><br><br>
                                    
                                    <label class="col-md-5 control-label paddingForm">Jumlah</label>
                                    <div class="col-md-3">
                                        <?php
                                        $data = array(
                                            'name' => 'jumlah',
                                            'autocomplete' => 'off',
                                            'placeholder' => 'Jumlah',
                                            'id' => 'jumlah',
                                            'type' => 'number',
                                            'class' => 'form-control'
                                        );
                                        echo form_input($data);
                                        ?>
                                        <i>*masukan nama barang di menu kelola bila tidak ada</i>
                                    </div><br><br>
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-offset-5">
                                <button class="btn btn-default btn-md" onclick="tambahDataKeTabel('dataObat')"><i class="fa fa-plus"> Tambah item</i></button>
                            </div><br><br>
                            <form method="post" action="<?php echo base_url('depo/antrianberjalandepo/prosesobatkeluar')."/".$this->uri->segment(4)?>">
                            <div class="form-group" style="display: none;" id="tampilkanTabel">
                                <table style="margin-left: 10px; margin-top: 20px; text-align: center;" border="1" class="" id="dataObat"  width="99%" >
                                    <thead>
                                    <tr class="header-row_sim row_sim">
                                        <th class="cell_sim">Aksi</th>
                                        <th class="cell_sim">ID Barang</th>
                                        <th class="cell_sim">Nama Barang</th>
                                        <th class="cell_sim">Jumlah</th>
                                        <th class="cell_sim">Aturan Pakai</th>
                                        <th class="cell_sim">Keterangan Tambahan</th>
                                        <th class="cell_sim">Nomor Batch</th>
                                        <th class="cell_sim">Untuk Pasien</th>
                                        <th class="cell_sim">Harga Barang</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>

                                </table>
                                
                            </div>
                            <br><br>
                            <div style="text-align: center;">
                            <button formnovalidate class="btn btn-danger" name="batal" value="batal" type="submit"><i class="glyphicon glyphicon-remove"> Batal</i></button>
                            <button class="btn btn-success" type="submit" name="simpan" value="simpan"><i class="fa fa-arrow-right"> Proses</i></button>
                            <input id="trTotal" name="trTotal" hidden readonly>
                            
                                <h3><i>Total Tagihan: </i><input readonly value="0" name="totaltagihan" id="totalTagihan"></input></h3>
                                <br>
                            </div>
                        </form>

                    <?php if ($this->session->flashdata('pesan')) {?>
                        <div class="alert alert-success alert-dismissible" id="success-alert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-info"></i> Notifikasi</h4>
                            <?php echo $this->session->flashdata('metode') ?>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </section>
</div>

<script src="<?php echo base_url('assets/js/plugins/jQuery/jQuery-2.1.3.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/plugins/fastclick/fastclick.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/AdminLTE/app.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/plugins/sparkline/jquery.sparkline.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/plugins/daterangepicker/daterangepicker.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/plugins/datepicker/bootstrap-datepicker.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/plugins/iCheck/icheck.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/plugins/slimScroll/jquery.slimscroll.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/plugins/chartjs/Chart.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('tAutocomplete/tautocomplete.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/jquery-ui-1.12.1.custom/jquery-ui.min.js'); ?>" type="text/javascript"></script>

<script>
$("#success-alert").fadeTo(3000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});
</script>

<script>
    var jumlah = document.getElementById('jumlah');
    var kolom_barang_id = document.getElementById('barang_id');
    var aturan_pakai = document.getElementById('aturan_pakai');
    var keterangan = document.getElementById('keterangan');
    var nomor_batch = document.getElementById('nomor_batch');
    var nama_pasien = document.getElementById('nama_pasien');
    var totalShow = document.getElementById('totalTagihan');
    var temp=0;
    var tempValue=0;

    var trTot = document.getElementById("trTotal");

    var nama_barang_temp;
    var barang_id_temp;
    var harga_barang_temp;
    var stok_temp;
    

    function clearFields(){
        aturan_pakai.value = "";
        keterangan.value = "";
        jumlah.value = "";
        nomor_batch.value = "";
    }

    var tr = 1;
    var td = 1;
    function tambahDataKeTabel(idTabel) {
        if(jumlah.value == ""){ alert("Kolom jumlah tidak boleh kosong!"); }else if(jumlah.value <0){ alert("Angka tidak boleh negatif!"); }
        if(kolom_barang_id.value == ""){ alert("Nama barang tidak boleh kosong!"); }
        if(parseInt(jumlah.value) > parseInt(stok_temp)){ alert("Stok " + nama_barang_temp + " yang tersedia hanya "+stok_temp); return false;}

        if(jumlah.value>0 && kolom_barang_id.value){
        tampilkanTabel.style.display = "block";
        var table = document.getElementById(idTabel);
        var row = table.insertRow(1);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var cell5 = row.insertCell(4);
        var cell6 = row.insertCell(5);
        var cell7 = row.insertCell(6);
        var cell8 = row.insertCell(7);
        var cell9 = row.insertCell(8);
        
        cell1.innerHTML = "<span class=\"table-remove glyphicon glyphicon-remove\" onclick=\"hapusBaris(this)\"></span>";
        cell2.innerHTML = "<input hidden name=\"tabel_barang_id[]\" value=\"" + barang_id_temp + "\" class=\"full-width rata_tengah\" readonly>"+ barang_id_temp;
        td++;
        cell3.innerHTML = "<input hidden value=\"" + nama_barang_temp + "\" class=\"full-width rata_tengah\" readonly>"+ nama_barang_temp;
        td++;
        cell4.innerHTML = "<input hidden name=\"tabel_jumlah[]\" value=\"" + jumlah.value + "\" class=\"full-width\" readonly>"+ jumlah.value;
        td++;
        cell5.innerHTML = "<input hidden name=\"tabel_aturan_pakai[]\" value=\"" + aturan_pakai.value + "\" class=\"full-width\" readonly>"+ aturan_pakai.value;
        td++;
        cell6.innerHTML = "<input hidden name=\"tabel_keterangan[]\" value=\"" + keterangan.value + "\" class=\"full-width\" readonly>"+ keterangan.value;
        td++;
        cell7.innerHTML = "<input hidden name=\"tabel_nomor_batch[]\" value=\"" + nomor_batch.value + "\" class=\"full-width\" readonly>"+ nomor_batch.value;
        td++;
        cell8.innerHTML = "<input hidden name=\"tabel_nama_pasien[]\" value=\"" + nama_pasien.value + "\" class=\"full-width\" readonly>"+ nama_pasien.value;
        td++;
        cell9.innerHTML = "<input hidden name=\"tabel_harga_barang[]\" value=\"" + harga_barang_temp + "\" class=\"full-width\" readonly>"+ harga_barang_temp;
        tempValue = parseInt(harga_barang_temp)*parseInt(jumlah.value);
        temp=temp+tempValue;
        totalShow.value = temp;

        trTot.value = tr;
        tr++;
        td = 1;
        clearFields();
        }
        
        
    }

    function hapusBaris(r) {
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById("dataObat").deleteRow(i);
    }
</script>

<?php
    $arrayDaftarBarang=[];
    $arrayDaftarAturanPakai=[];

    foreach ($daftarBarang['data'] as $field => $values) {
        $arrayDaftarBarang[]=$values;
    }
    foreach ($daftarAturanPakai['data'] as $field => $values) {
        $arrayDaftarAturanPakai[]=$values['nama_aturan_pakai'];
    }
    
?>
<script>
$( function() {
    var aturan_pakai = <?php echo json_encode($arrayDaftarAturanPakai);?>;
    $( "#aturan_pakai" ).autocomplete({
      source: aturan_pakai
    });
  });
</script>

<script>
    $(document).ready(function() {
        var daftarObat = <?php echo json_encode($arrayDaftarBarang);?>;

        var daftarSearchData = $("#barang_id").tautocomplete({
            hide: [true,true],
            placeholder: "Ketik kata kunci. . .",
            norecord: "data tidak ditemukan",
            highlight: "",
            columns: ['id Barang', 'Nama', 'Stok', 'Grup', 'satuan','Harga'],
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
                    if ((v.barang_id.search(new RegExp(searchData)) != -1) 
                    || (v.nama_barang.search(new RegExp(searchData)) != -1)
                    || (v.jumlah_stok.search(new RegExp(searchData)) != -1)   
                    || (v.grup_barang.search(new RegExp(searchData)) != -1)  
                    || (v.satuan.search(new RegExp(searchData)) != -1)) {
                        filterData.push(v);
                    }
                });
                return filterData;

            },
            onchange: function () {
                stok = daftarSearchData.all()['Stok'];
                if(stok<1){
                    alert("Stok tidak tersedia");
                    return false;
                }else{
                    barang_id_temp = daftarSearchData.all()['id Barang'];
                    nama_barang_temp = daftarSearchData.all()['Nama'];
                    harga_barang_temp = daftarSearchData.all()['Harga'];
                    stok_temp = daftarSearchData.all()['Stok'];
                }
            }
        });
    });
</script>

</body>
</html>



