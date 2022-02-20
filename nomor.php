<?php
include_once("helper/koneksi.php");
include_once("helper/function.php");


$login = cekSession();
if ($login == 0) {
    redirect("login.php");
}
$menu = 3;
$u = $_SESSION['id_account'];
if (post("nama") && post('nomor') && post('id_kategori') && is_numeric(post('nomor'))) {
    $nama = post("nama");
    $nomor = post("nomor");
    $id_kategori = post("id_kategori");


    $count = mysqli_query($koneksi, "SELECT * FROM nomor WHERE make_by = '".$u."' AND nomor = '".$nomor."'");

    if (mysqli_num_rows($count) == 0) {
        $q = mysqli_query($koneksi, "INSERT INTO `nomor` (`id`, `nama`, `nomor`, `id_kategori`, `make_by`) VALUES (NULL, '".$nama."', '".$nomor."', '".$id_kategori."', '".$u."')");
        if ($q) {
            toastr_set("success", "Nomor $nomor berhasil disimpan");
        } else {
            toastr_set("error", "Nomor $nomor gagal disimpan");    
        }
    } else {
        toastr_set("error", "Nomor $nomor sudah ada sebelumnya");
    }

    redirect('nomor.php');
}

if (get("act") == "hapus") {
    $id = get("id");

    $q = mysqli_query($koneksi, "DELETE FROM nomor WHERE id='$id' AND make_by = '".$_SESSION['id_account']."'");
    toastr_set("success", "Nomor berhasil dihapus");
    redirect("nomor.php");
}

if (get("act") == "delete_all") {
    $q = mysqli_query($koneksi, "DELETE FROM nomor WHERE make_by = '".$_SESSION['id_account']."'");
    toastr_set("success", "Sukses hapus semua nomor");
    redirect("nomor.php");
}

?>
<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Nomor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <label> Nama </label>
                    <input type="text" name="nama" required class="form-control" placeholder="Anonim">
                    <br>
                    <label> Nomor Telepon </label>
                    <input type="text" name="nomor" required class="form-control" placeholder="081234567890" maxlength="14">
                    <br>
                    <label> Kategori </label>
                    <br>
                    <select class="form-control js-example-basic-multiple" name="id_kategori" style="width: 100%" required>
                        <option value="" selected>Pilih Kategori</option>
                        <?php
                        $q = mysqli_query($koneksi, "SELECT * FROM kategori WHERE is_public = 1 OR created_by = '".$u."'");
                    
                        while ($row = mysqli_fetch_assoc($q)) {
                            echo '<option value="' . $row['id_kategori'] . '">' . $row['kategori'] . ' </option>';
                        }
                        ?>
                    </select>
                    <br>
                    <br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Nomor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="import_excel.php" method="POST" enctype="multipart/form-data">
                    <label> File (.xlsx) </label>
                    <input type="file" name="file" required class="form-control">
                    <br>
                    <label> Mulai dari Baris ke </label>
                    <input type="text" name="a" required class="form-control" value="2">
                    <br>
                    <label> Kolom Nama ke </label>
                    <input type="text" name="b" required class="form-control" value="1">
                    <br>
                    <label> Kolom Nomor ke </label>
                    <input type="text" name="c" required class="form-control" value="2">
                    <p class="small-text mb-0 font-italic">*Download file contoh <a href="excel/contohuploadnomor.xlsx" target="_blank">disini</a> </p>     
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>


        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-search fa-fw"></i>
                </a>
            </li>


            <!-- Nav Item - Messages -->

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['username'] ?></span>
                    <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
            </li>

        </ul>

    </nav>
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal">
            Tambah Nomor
        </button>
        <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#import">
                    Import Excel
                </button>
        <br>
        <div class="card shadow">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" style="display: contents">Data Nomor</h6>
                <a class="btn btn-danger float-right" onclick="return confirm('Anda yakin menghapus seluruh data nomor kontak?')" href="nomor.php?act=delete_all" style="margin:5px">Hapus Semua</a>
                
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nama</th>
                                <th>Nomor</th>
                                <th>Kategori</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $q = mysqli_query($koneksi, "SELECT n.*, k.kategori FROM nomor n LEFT JOIN kategori k ON k.id_kategori = n.id_kategori WHERE make_by='$u'");
                            $no = 0;
                            while ($v = mysqli_fetch_assoc($q)) {
                                $no++;
                                ?>
                                <tr>
                                    <td class="text-center"><?=$no?></td>
                                    <td><?=$v['nama']?></td>
                                    <td><?=$v['nomor']?></td>
                                    <td><?=$v['kategori']?></td>
                                    <td>
                                        <center>
                                            <a href="nomor.php?act=hapus&id=<?=$v['id']?>" class="btn btn-danger">Hapus</a>
                                        </center>
                                    </td>
                                </tr>
                                <?php
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="js/demo/datatables-demo.js"></script>

<!-- Footer -->
<?php include 'footer.php';?>