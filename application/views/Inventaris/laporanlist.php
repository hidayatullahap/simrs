<style rel="stylesheet">
    
    .paddingForm {
        padding-top: 1.5%;
        padding-left: 5%;
        text-align: left;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <a href="<?php echo base_url('/inventaris/laporan'); ?>"><font color='black'><strong>Laporan</strong></font></a>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <div class="form-group row">
                            <form id="formSubmit" method="post" action="<?php echo base_url('/inventaris/laporan/page/1') ?>">
                            <div class="input-group col-md-4">
                            <label class="col-md-2 paddingForm" for="golongan_darah">Range</label>
                                <div class="col-md-3">
                                    <select class="select2_single form-control" tabindex="-1" name="pilihanrange" id="pilihanrange" 
                                    onchange="this.form.submit()">
                                        <option hidden value="<?php echo $_SESSION['pilihanrange'];?>"><?php echo $_SESSION['pilihanrange'];?></option>
                                        <option value="Bulanan">Bulanan</option>
                                        <option value="Triwulan">Triwulan</option>
                                        <option value="Semester">Semester</option>
                                        <option value="Tahunan">Tahunan</option>
                                    </select>
                                </div>
                            </div>
                            </form>

                        </div>
                        
                        <table class="table table-bordered table-hover" id="tabel" cellspacing="0" width="100%">
                            <thead bgcolor="#4a4a4c">
                            <tr>
                                <th><font color="white">Laporan</th>
                                <th><font color="white">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $url=base_url('/inventaris/laporan');
                            $choice=$_SESSION['pilihanrange'];
                            if ($data->num_rows>0) {
                                foreach ($data as $field => $values) {
                                    echo "<tr>";
                                    setlocale(LC_ALL,'id_ID');
                                    $date=strtotime($values['range_waktu']);
                                    $yearDate=date('Y', $date);
                                    $rangemonth=intval(date('m', $date));

                                    switch ($choice) {
                                        case "Bulanan":
                                            echo "<td>".date('F-Y', $date)."</td>";
                                            break;
                                        case "Triwulan":
                                            if($rangemonth>=1 && $rangemonth<=3){
                                                echo "<td>Kuarter 1 tahun ".$yearDate."</td>";
                                            }else if($rangemonth>3 && $rangemonth<=6){
                                                echo "<td>Kuarter 2 tahun ".$yearDate."</td>";
                                            }else if($rangemonth>6 && $rangemonth<=9){
                                                echo "<td>Kuarter 3 tahun ".$yearDate."</td>";
                                            }else{
                                                echo "<td>Kuarter 4 tahun ".$yearDate."</td>";
                                            }
                                            break;
                                        case "Semester":
                                            if($rangemonth>=1 && $rangemonth<=6 ){
                                                echo "<td>Semester 1 tahun ".$yearDate."</td>";
                                            }else{
                                                echo "<td>Semester 2 tahun ".$yearDate."</td>";
                                            }
                                            break;
                                        case "Tahunan":
                                            echo "<td>".$yearDate."</td>";
                                            break;
                                        default:
                                            echo "<td>".date('F-Y', $date)."</td>";
                                    }
                                    echo "<td width='30%'><button type='button' class='btn btn-default btn-sm' 
                                    onclick=window.open('$url/printlaporan/$rangemonth/$yearDate','_blank')>Print <i class='fa fa-print'></i></button>
                                    <button type='button' class='btn btn-default btn-sm' 
                                    onclick=window.open('$url/excel/$rangemonth/$yearDate','_blank')>Excel <i class='fa fa-file-excel-o'></i></button></td>";
                                    echo "</tr>";
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
                    <div class="box-footer clearfix">
                        <?php
                            require_once(CLASSES_DIR  . "pagination.php");
                            $entity = new Pagination();
                        if (isset($totalPages)) {
                            $entity->tampilkan('inventaris/laporan',$currentPage, $totalPages);
                        }
                        ?>
                    </div>

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
$("#success-alert").fadeTo(3000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});
</script>

<script>
$('#formSubmit').submit(function() {
    var tanggalAwal = document.getElementById('tanggalAwal').value;
    var tanggalAkhir = document.getElementById('tanggalAkhir').value;

    if (tanggalAwal=="" || tanggalTanggal==""){
        alert("Isi terlebih dahulu tanggal sebelum search");
    }
    document.getElementById('search').value="";
    return false; // return false to cancel form action
});
</script>

</body>
</html>
