<body class="skin-green">
    <div class="wrapper">

<!-- navbar top -->
<header class="main-header">
    <!-- Logo -->
    <a href="<?php base_url('c_dashboard');?>" class="logo"><b>SIMRS</b> Dr. Murjani</a>
    
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

            <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo base_url('assets/img/avatar5.png'); ?>" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?php echo $this->session->userdata('nama'); ?></span>
                    </a>
                    
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?php echo base_url('assets/img/avatar5.png'); ?>" class="img-circle" alt="User Image" />
                            <p>
                                <?php echo $this->session->userdata('nama'); ?> / <?php echo $this->session->userdata('role'); ?>
                                <small>Member since Nov. 2012</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#">Followers</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Sales</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Friends</a>
                            </div>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo base_url('c_dashboard/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
        
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url('assets/img/avatar5.png'); ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?php echo $this->session->userdata('nama'); ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            
            <li class="header">MENU NAVIGASI</li>
            
            <li class="treeview <?php echo (isset($navbar_dashboard) ? $navbar_dashboard : ""); ?>">
                <a href="<?php echo base_url('c_dashboard'); ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
                </a>
            </li>
            
            <li class="treeview <?php echo (isset($navbar_loket) ? $navbar_loket : ""); ?>"><!-- class="treeview active" -->
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Loket</span>
<!-- ------------------------------ EDIT GERRY 19/05/2016 ---------------------- --><i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php echo (isset($navbar_pendaftaranPasien) ? $navbar_pendaftaranPasien : ""); ?> > <!-- class="active" -->
                        <a href="<?php echo base_url('loket/c_daftarbaru/lihatpasien'); ?>">
                            <i class="fa fa-circle-o"></i> Pendaftaran Pasien
                        </a>
                    </li>
                    <li <?php echo (isset($navbar_antrianBerjalan) ? $navbar_antrianBerjalan : ""); ?>>
                        <a href="<?php echo base_url('antrian/c_antrian'); ?>">
                            <i class="fa fa-circle-o"></i> Antrian Berjalan
                        </a>
                    </li>
                    <li <?php echo (isset($navbar_rekapAntrian) ? $navbar_rekapAntrian : ""); ?>>
                        <a href="<?php echo base_url('antrian/c_antrian/rekapkunjungan'); ?>">
                            <i class="fa fa-circle-o"></i> Rekap Antrian
                        </a>
                    </li>
                </ul>
            </li>
            
            <li class="treeview">
    <!-- ------------------------------ EDIT GERRY 18/05/2016 ---------------------- --><a href="#"> 
                    <i class="fa fa-sign-in"></i>
                    <span>UGD / IGD </span>
    <!-- ------------------------------ EDIT GERRY 21/08/2016 ---------------------- --><i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="<?php echo base_url('ugd/c_ugd'); ?>">
                            <i class="fa fa-circle-o"></i> Pelayanan UGD
                        </a>
                    </li>
                    <!-- <li>
                        <a href="<?php echo base_url('ugd/c_ugd'); ?>">
                            <i class="fa fa-circle-o"></i> Permintaan Obat UGD (Gudang Obat)
                        </a>
                    </li> -->
                </ul>
            </li>
            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-university"></i>
                    <span>Poli</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="<?php echo base_url('poli/c_poliumum'); ?>">
                            <i class="fa fa-circle-o"></i> Poli Umum
                        </a>
                    </li>
                    <li>
                         <a href="<?php echo base_url('poli/c_polikia'); ?>">
                            <i class="fa fa-circle-o"></i> Poli KIA
                        </a>
                    </li>
                    <li>
                            <a href="<?php echo base_url('poli/c_poligigi'); ?>">
                            <i class="fa fa-circle-o"></i> Poli Gigi
                        </a>
                    </li>
                </ul>
            </li>
            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>Laboratorium</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="<?php echo base_url('lab/c_lab'); ?>">
                            <i class="fa fa-circle-o"></i>Pemeriksaan Lab
                        </a>
                    </li>
                    <li>
                        <!-- ------------------------------ EDIT GERRY 31/05/2016 ---------------------- --> <a href="<?php echo base_url('lab/c_lab/rekap'); ?>"><i class="fa fa-circle-o"></i> Rekap Hasil Lab</a>
                    </li>
                </ul>
            </li>
            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-glass"></i> 
                    <span>Apotek</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="<?php echo base_url('apotek/c_apotek'); ?>">
                            <i class="fa fa-circle-o"></i> Layanan Apotek
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-circle-o"></i> Data Obat
                        </a>
                    </li>
                </ul>
            </li>
            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-calculator"></i> 
                    <span>Kasir</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="<?php echo base_url('kasir/c_kasir'); ?>">
                            <i class="fa fa-circle-o"></i> Layanan Kasir
                        </a>
                    </li>
                </ul>
            </li>

           <!-- GERRY 22/06/2012-->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-briefcase"></i> 
                    <span>Gudang Obat</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="<?php echo base_url('gudangObat/c_gudangObat/index'); ?>">
                            <i class="fa fa-circle-o"></i> Daftar Obat
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('gudangObat/c_gudangObat/obatMasuk'); ?>">
                            <i class="fa fa-circle-o"></i> Obat Masuk
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('gudangObat/c_gudangObat/obatKeluar'); ?>">
                            <i class="fa fa-circle-o"></i> Obat Keluar
                        </a>
                    </li>
    <!-- ------------------------------ EDIT GERRY 10/08/2016 ---------------------- -->  
                    <li>
                        <a href="<?php echo base_url('gudangObat/c_gudangObat/rekap_LPLPO_masuk'); ?>">
                            <i class="fa fa-circle-o"></i> Rekap LPLPO Masuk
                        </a>
                    </li>   
                    <li>
                        <a href="<?php echo base_url('gudangObat/c_gudangObat/rekap_LPLPO_keluar'); ?>">
                            <i class="fa fa-circle-o"></i> Rekap LPLPO Keluar
                        </a>
                    </li>           
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>Kelola</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('kelola/c_tindakan'); ?>"><i class="fa fa-circle-o"></i> Data Tindakan</a></li>
                    <li><a href="<?php echo base_url('kelola/c_obat'); ?>"><i class="fa fa-circle-o"></i> Data Obat</a></li>
                    <li><a href="<?php echo base_url('kelola/c_diagnosa'); ?>"><i class="fa fa-circle-o"></i> Data ICD / Diagnosa</a></li>
                    
                </ul>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>