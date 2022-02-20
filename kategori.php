<?php
include_once("helper/koneksi.php");
include_once("helper/function.php");


$login = cekSession();
if ($login == 0) {
    redirect("login.php");
}
$menu = 4;

if (get("act") == "hapus") {
    $idkategori = get("id");

    $q = mysqli_query($koneksi, "DELETE FROM kategori WHERE id_kategori='$idkategori' AND created_by = '".$_SESSION['id_account']."'");
    if ($q) {
        toastr_set("success", "Kategori berhasil dihapus");
    } else {
        toastr_set("error", "Kategori gagal dihapus");
    }
    redirect("kategori.php");
} else if (get('act') == 'ubah') {
    $id_kategori = post('id_kategori');
    $kategori = post('kategori');
    if ($id_kategori && $kategori) {
        $q = mysqli_query($koneksi, "UPDATE kategori SET kategori = '".$kategori."' WHERE id_kategori = '".$id_kategori."' AND created_by = '".$_SESSION['id_account']."'");
        if ($q) {
            toastr_set("success", "Kategori berhasil dirubah");
        } else {
            toastr_set("error", "Kategori gagal dirubah");
        }
    } else {
        toastr_set("error", "Inputan tidak valid!");
    }
    redirect("kategori.php");
} else if (get("act") == 'tambah') {
    $kategori = post("kategori");
    $is_public = (isset($_POST['is_public'])? $_POST['is_public'] : 0);
    $count = mysqli_query($koneksi, "SELECT * FROM kategori WHERE created_by = '".$u."'");

    if (mysqli_num_rows($count) == 0) {
        $q = mysqli_query($koneksi, "INSERT INTO kategori(`id_kategori`, `kategori`, `is_public`, `created_by`)
            VALUES(NULL, `".$kategori."`, `".$is_public."`, `".$_SESSION['id_account']."`)");
        if ($q) {
            toastr_set("success", "Kategori berhasil ditambahkan");
        } else {
            toastr_set("error", "Kategori gagal ditambahkan");    
        }
    } else {
        toastr_set("error", "Kategori sudah ada");
    }
    redirect('kategori.php');
}

?>

<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<div class="modal fade" id="tambahkategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="kategori.php?act=tambah" method="POST">
                    <div class="form-group">
                        <label> Nama Kategori</label>
                        <input type="text" name="kategori" required class="form-control">
                    </div>
                    <?php if ($_SESSION['level'] == 1): ?>
                    <div class="form-group">
                        <label>Is Public</label>
                        <label>
                            <input type="radio" name="is_public" id="is_public_1" value="1"> Public
                        </label>
                        <label>
                            <input checked type="radio" name="is_public" id="is_public_0" value="0"> Private
                        </label>
                    </div>
                    <?php endif ?>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editkategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="kategori.php?act=ubah" method="POST">
                    <input type="hidden" name="id_kategori" id="id_kategori" readonly>
                    <div class="form-group">
                        <label> Nama Kategori</label>
                        <input type="text" name="kategori" id="kategori" required class="form-control">
                    </div>
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
        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#tambahkategori">
            Tambah Kategori
        </button>
        <br>
        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" style="display: contents">Data Kategori</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nama Kategori</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $q = mysqli_query($koneksi, "SELECT * FROM kategori WHERE created_by = '".$_SESSION['id_account']."'");
                            
                            $no = 0;
                            while ($v = mysqli_fetch_assoc($q)) {
                                $no++;
                                ?>
                                <tr>
                                    <td class="text-center"><?=$no?></td>
                                    <td><?=$v['kategori']?></td>
                                    <td class="text-center">
                                        <a data-toggle="modal" data-target="#editkategori" href="javascript:void(0)" data-id="<?=$v['id_kategori']?>" data-kategori="<?=$v['kategori']?>" onclick="kategori(this)" class="btn btn-warning">Ubah</a>

                                        <a data-toggle="modal" data-target="#edit" href="kategori.php?act=hapus&id=<?=$v['id_kategori']?>" class="btn btn-danger">Hapus</a>
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
<!-- End of Main Content -->
<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="js/demo/datatables-demo.js"></script>

<script type="text/javascript">
    function kategori(a) {
        let id = $(a).data('id');
        let kategori = $(a).data('kategori');
        $('#id_kategori').val(id);
        $('#kategori').val(kategori);
    }
</script>

<?php include 'footer.php'; ?>