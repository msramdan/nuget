<?php 
$aktif = "nav-item active";
$nonaktif = "nav-item";
?>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon ">
            <img alt="Midone Tailwind HTML Admin Template" style="width: 1.5rem;" src="logo.svg">
        </div>
        <div class="sidebar-brand-text" style="margin-top: 0.25rem;font-size: 1.2rem;">NU<strong>get</strong></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="<?php echo $menu == 1 ? $aktif : $nonaktif  ?>">
        <a class="nav-link" href="index.php">
            <i class="fa fa-bars"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Data
    </div>
    

    <li class="<?php echo $menu == 3 ? $aktif : $nonaktif  ?>">
        <a class="nav-link" href="nomor.php">
            <i class="fa fa-users"></i>
            <span>Data Nomor</span></a>
    </li>
    
    <li class="<?php echo $menu == 4 ? $aktif : $nonaktif  ?>">
        <a class="nav-link" href="kategori.php">
            <i class="fa fa-list"></i>
            <span>Data Kategori</span></a>
    </li>
    
    <li class="<?php echo $menu == 5 ? $aktif : $nonaktif  ?>">
        <a class="nav-link" href="template.php">
            <i class="fa fa-file"></i>
            <span>Data Template</span></a>
    </li>
    
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Fungsional
    </div>
    
    <li class="<?php echo $menu == 2 ? $aktif : $nonaktif  ?>">
        <a class="nav-link" href="autoreply.php">
            <i class="fa fa-reply-all"></i>
            <span>Auto Reply</span></a>
    </li>

    <li class="<?php echo $menu == 6 ? $aktif : $nonaktif  ?>">
        <a class="nav-link" href="kirim.php">
            <i class="fa fa-paper-plane"></i>
            <span>Kirim Masal</span></a>
    </li>

    <li class="<?php echo $menu == 7 ? $aktif : $nonaktif  ?>">
        <a class="nav-link" href="kirimmanual.php">
            <i class="fa fa-comment"></i>
            <span>Kirim Manual</span></a>
    </li>
    
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Konfigurasi
    </div>

    <li class="<?php echo $menu == 8 ? $aktif : $nonaktif  ?>">
        <a class="nav-link" href="rest_api.php">
            <i class="fa fa-fw fa-code"></i>
            <span>Rest API</span></a>
    </li>

    <li class="<?php echo $menu == 9 ? $aktif : $nonaktif  ?>">
        <a class="nav-link" href="pengaturan.php">
            <i class="fa fa-fw fa-cogs"></i>
            <span>Pengaturan</span></a>
    </li>
</ul>

<div id="content-wrapper" class="d-flex flex-column">