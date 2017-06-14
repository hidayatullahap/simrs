<style rel="stylesheet">
    
    .paddingForm {
        padding-top: 1.5%;
        text-align: right;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <a href="<?php echo base_url('/kelola/kelolabarang'); ?>"><font color='black'><strong>Cari Barang</strong></font></a>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <div class="form-group row">
                            <form id="formSubmit" method="post" action="<?php echo base_url('inventaris/caribarang') ?>">
                            <div class="input-group col-xs-4" style="float: left;padding-left:15px;">
                                <input placeholder="cari nama unit" type="text" class="input-group form-control" id="search_nama_unit" name="search_nama_unit" 
                                value="<?php if(isset($_SESSION['search_nama_unit'])){echo $_SESSION['search_nama_unit'];} ?>">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i> dan/atau</i></button>
                                </div>
                                <input placeholder="cari nama barang" type="text" class="input-group form-control" id="search_nama_barang" name="search_nama_barang" 
                                value="<?php if(isset($_SESSION['search_nama_barang'])){echo $_SESSION['search_nama_barang'];} ?>">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                </div>
                            </div>
                            </form>
                        </div>
                        
                        <table class="table table-bordered table-hover" id="tabel" cellspacing="0" width="100%">
                            <thead bgcolor="#4a4a4c">
                            <tr>
                                <th><font color="white">Unit</th>
                                <th><font color="white">Nama Barang</th>
                                <th><font color="white">Satuan</th>
                                <th><font color="white">Grup Barang</th>
                                <th><font color="white">Merek/Model/Ukuran</th>
                                <th><font color="white">Jumlah Item</th>
                                
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($data->num_rows>0) {
                                $i=1;
                                foreach ($data as $field => $values) {
                                    echo "<tr>";
                                    echo "<td>".$values['nama_unit']."</td>";
                                    echo "<td>".$values['nama_barang']."</td>";
                                    echo "<td>".$values['nama_satuan']."</td>";
                                    echo "<td>".$values['nama_grup_barang']."</td>";
                                    echo "<td>".$values['merek_model_ukuran']."</td>";
                                    if($values['jumlah']<1){
                                        echo "<td width='15%'> Barang kosong / tidak ada</td>";
                                    }else{
                                        echo "<td width='15%'>".number_format($values['jumlah'],0,",",".")."</td>";
                                    }
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

                    <div class="box-footer clearfix">
                        <?php
                            require_once(CLASSES_DIR  . "pagination.php");
                            $entity = new Pagination();
                        if (isset($totalPages)) {
                            $entity->tampilkan('inventaris/caribarang',$currentPage, $totalPages);
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
<script src="<?php echo base_url('tAutocomplete/tautocomplete.js'); ?>" type="text/javascript"></script>

</body>
</html>
