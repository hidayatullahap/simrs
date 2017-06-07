<body class="skin-green">
    <div class="wrapper">

<header class="main-header">
    <a href="<?php base_url('c_dashboard');?>" class="logo"><b>SIMRS</b> Dr. Murjani</a>
    
    <nav class="navbar navbar-static-top" role="navigation">
        
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        
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
                                <?php echo $this->session->userdata('nama'); ?> / <?php echo $this->session->userdata('role'); ?>
                                <small>Member since Nov. 2012</small>
                            </p>
                        </li>
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
        
<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url('assets/img/avatar5.png'); ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?php echo $this->session->userdata('nama'); ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        
        <ul class="sidebar-menu">
            
            <li class="header">MENU NAVIGASI</li>
            
            <li class="treeview <?php echo (isset($navbar_dashboard) ? $navbar_dashboard : ""); ?>">
                <a href="<?php echo base_url('c_dashboard'); ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
                </a>
            </li>

            <li class="treeview <?php echo (strcmp($this->session->userdata('navbar_status'), "kelola") == 0 ? "active" : ""); ?>">
                <a href="#">
                    <i class="fa fa-cogs"></i> <span>Kelola Data</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('kelola/kelolapasien'); ?>"><i class="fa fa-table"></i>Data Pasien</a></li>
                </ul>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('kelola/kelolajenispasien'); ?>"><i class="fa fa-table"></i>Data Jenis Pasien</a></li>
                </ul>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('kelola/kelolaaturanpakaiobat'); ?>"><i class="fa fa-table"></i>Data Aturan Pakai</a></li>
                </ul>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('kelola/kelolajenispenerimaan'); ?>"><i class="fa fa-table"></i>Jenis Penerimaan</a></li>
                </ul>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('kelola/kelolasatuan'); ?>"><i class="fa fa-table"></i>Satuan</a></li>
                </ul>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('kelola/kelolaunit'); ?>"><i class="fa fa-table"></i>Unit</a></li>
                </ul>
            </li>

        </ul>
    </section>
</aside>