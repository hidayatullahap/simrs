<style>
    html {
        background: url(<?php echo base_url("assets/images/background_login.jpg");?>) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
    body {
        background: transparent;
    }
    .login-box, .login-box .login-box-body{
        background-color: rgba(229, 229, 229, 1);
    }

    .colorter{
        -webkit-animation: color-change 2s infinite;
        -moz-animation: color-change 2s infinite;
        -o-animation: color-change 2s infinite;
        -ms-animation: color-change 2s infinite;
        animation: color-change 2s infinite;
    }

    @-webkit-keyframes color-change {
        0% { color: #e24329; }
        50% { color: #3C8DBC; }
        100% { color: #0dc143; }
    }
    @-moz-keyframes color-change {
        0% { color: #e24329; }
        50% { color: #3C8DBC; }
        100% { color: #0dc143; }
    }
    @-ms-keyframes color-change {
        0% { color: #e24329; }
        50% { color: #3C8DBC; }
        100% { color: #0dc143; }
    }
    @-o-keyframes color-change {
        0% { color: #e24329; }
        50% { color: #3C8DBC; }
        100% { color: #0dc143; }
    }
    @keyframes color-change {
        0% { color: #e24329; }
        50% { color: #3c8dbc; }
        100% { color: #0dc143; }
    }
</style>
<!--<body class="skin-green">-->
<body <?php if(!empty($navbar_collapse_menu)) { echo "class=\"skin-green sidebar-collapse sidebar-open sidebar-mini\""; } else { ?> class="skin-green sidebar-mini" <?php } ?>>
    <div class="wrapper">

<header class="main-header">
    <a href="<?php base_url('c_dashboard');?>" class="logo"><b>SIMRS</b> Dr. Murjani</a>
    
    <nav class="navbar navbar-static-top" role="navigation">
        
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!--
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo base_url('assets/img/avatar5.png'); ?>" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?php echo $this->session->userdata('nama'); ?></span>
                    </a>
                    
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="<?php echo base_url('assets/img/avatar5.png'); ?>" class="img-circle" alt="User Image" />
                            <p>
                                <?php echo $this->session->userdata('pengguna_nama'); ?> / <?php echo $this->session->userdata('pengguna_peran'); ?>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo base_url('login/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>-->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

            <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo base_url('assets/images/pkm/bareng/logo_whitebased.png'); ?>" class="user-image" alt="User Image"/>
                        <span class="hidden-xs">Hi, <?php echo $this->session->userdata('pengguna_nama'); ?>!</span>
                    </a>
                    
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?php echo base_url('assets/images/pkm/bareng/logo_whitebased.png'); ?>" class="img-circle" alt="User Image" />
                            <p>
                                <?php echo substr($this->session->userdata('pengguna_nama'), 0, 9); ?> / <?php echo $this->session->userdata('pengguna_peran'); ?>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="<?php echo base_url('login/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
        
<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url('assets/img/avatar5.png'); ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <i class="fa fa-circle text-success"></i><a class="colorter"> Online</a><br>
                <a><?php echo substr($this->session->userdata('pengguna_peran'),0,20); ?></a><br>
                <?php echo substr($this->session->userdata('pengguna_nama'),0,20); ?><br>
                <a href="<?php echo base_url('login/logout'); ?>" style="color:red;"><i class="fa fa-power-off"></i> Logout</a><br>
            </div>
        </div>
        
        <ul class="sidebar-menu">
            
            <li class="header">MENU NAVIGASI</li>
            
            <li class="treeview">
                <a href="<?php echo base_url('dashboard'); ?>">
                    <i class="fa fa-home"></i> <span>Dashboard</span> 
                </a>
            </li>

            <li class="treeview <?php echo (strcmp($this->session->userdata('navbar_status'), "daftarpasien") == 0 ? "active" : ""); ?>">
                <a href="<?php echo base_url('loket/layananpasien'); ?>">
                    <i class="fa fa-users"></i> <span>Layanan Pasien</span> 
                </a>
            </li>
            <li class="treeview <?php echo (strcmp($this->session->userdata('navbar_status'), "antrianberjalan") == 0 ? "active" : ""); ?>">
                <a href="<?php echo base_url('loket/antrianberjalan'); ?>">
                    <i class="fa fa-arrow-right"></i> <span>Antrian Berjalan</span> 
                </a>
            </li>

            <li class="header">MENU NAVIGASI FARMASI</li>
            
            <li class="treeview <?php echo (strcmp($this->session->userdata('navbar_status'), "halamanutamafarmasi") == 0 ? "active" : ""); ?> ">
                <a href="<?php echo base_url('farmasi/halamanutama'); ?>">
                    <i class="fa fa-home"></i> <span>Dashboard</span> 
                </a>
            </li>
            <li class="treeview <?php echo (strcmp($this->session->userdata('navbar_status'), "pengeluaranfarmasi") == 0 ? "active" : ""); ?>">
                <a href="<?php echo base_url('farmasi/pengeluaran'); ?>">
                    <i class="fa fa-arrow-up"></i> <span>Pengeluaraan</span> 
                </a>
            </li>
            <li class="treeview <?php echo (strcmp($this->session->userdata('navbar_status'), "pengadaanfarmasi") == 0 ? "active" : ""); ?>">
                <a href="<?php echo base_url('farmasi/pengadaan'); ?>">
                    <i class="fa fa-cart-plus"></i> <span>Pengadaan</span> 
                </a>
            </li>
            <li class="treeview <?php echo (strcmp($this->session->userdata('navbar_status'), "infostok") == 0 ? "active" : ""); ?>">
                <a href="<?php echo base_url('farmasi/infostok'); ?>">
                    <i class="fa fa-check"></i> <span>Stok</span> 
                </a>
            </li>
            <li class="treeview">
                <a href="<?php echo base_url('farmasi/halamanutama'); ?>">
                    <i class="fa fa-home"></i> <span>Laporan</span> 
                </a>
            </li>
            <li class="treeview">
                <a href="<?php echo base_url('farmasi/halamanutama'); ?>">
                    <i class="fa fa-home"></i> <span>Riwayat Permintaan stok</span> 
                </a>
            </li>

            <li class="header">Pengaturan</li>
            <li class="treeview <?php echo (strcmp($this->session->userdata('navbar_status'), "kelola") == 0 ? "active" : ""); ?>">
                <a href="#">
                    <i class="fa fa-cogs"></i> <span>Kelola</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('kelola/kelolabarang'); ?>"><i class="fa fa-table"></i>Master Barang</a></li>
                    <li><a href="<?php echo base_url('kelola/kelolajenispasien'); ?>"><i class="fa fa-table"></i>Jenis Pasien</a></li>
                    <li><a href="<?php echo base_url('kelola/kelolaaturanpakaiobat'); ?>"><i class="fa fa-table"></i>Aturan Pakai</a></li>
                    <li><a href="<?php echo base_url('kelola/kelolajenispenerimaan'); ?>"><i class="fa fa-table"></i>Jenis Penerimaan</a></li>
                    <li><a href="<?php echo base_url('kelola/kelolasatuan'); ?>"><i class="fa fa-table"></i>Satuan</a></li>
                    <li><a href="<?php echo base_url('kelola/kelolaunit'); ?>"><i class="fa fa-table"></i>Unit</a></li>
                    <li><a href="<?php echo base_url('kelola/kelolagrupbarang'); ?>"><i class="fa fa-table"></i>Grup Barang</a></li>
                </ul>

                <li class="header">Admin Area</li>
                
                <li class="treeview <?php echo (strcmp($this->session->userdata('navbar_status'), "adminarea") == 0 ? "active" : ""); ?>">
                <a href="#">
                    <i class="fa fa-cogs"></i> <span>Pengaturan</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('kelola/kelolapengguna'); ?>"><i class="fa fa-user"></i>Pengguna</a></li>
                    <li><a href="<?php echo base_url('kelola/kelolapasien'); ?>"><i class="fa fa-table"></i>Data Pasien</a></li>
                </ul>
            </li>
        </ul>
    </section>
</aside>