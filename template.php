<?php
include_once("helper/koneksi.php");
include_once("helper/function.php");


$login = cekSession();
if ($login == 0) {
    redirect("login.php");
}
$menu = 5;
if (get("act") == 'tambah') {
    $namatemplate = post("namatemplate");
    $isitemplate = post("isitemplate");


    $count = mysqli_query($koneksi, "SELECT * FROM template WHERE nama_template = '".$namatemplate."' created_by = '".$_SESSION['id_account']."'");

    if (mysqli_num_rows($count) == 0) {
        $q = mysqli_query($koneksi, "INSERT INTO template(`nama_template`, `isi_template`, `created_at`, `created_by`)
            VALUES('$namatemplate', '$isitemplate', '".date('Y-m-d H:i:s')."', '".$_SESSION['id_account']."')");
        if ($q) {
            toastr_set("success", "Template berhasil ditambahkan");
        } else {
            toastr_set("error", "Template gagal ditambahkan");
        }
    } else {
        toastr_set("error", "Template sudah ada");
    }

    redirect('template.php');
} else if (get('act') == 'edit') {
    $idtemplate = post('id_template');
    $namatemplate = post("namatemplate");
    $isitemplate = post("isitemplate");


    $count = mysqli_query($koneksi, "SELECT * FROM template WHERE id_template = '".$idtemplate."' AND created_by = '".$_SESSION['id_account']."'");

    if (mysqli_num_rows($count) > 0) {
        $q = mysqli_query($koneksi, "UPDATE template SET nama_template = '".$namatemplate."', isi_template = '".$isitemplate."' WHERE id_template = '".$idtemplate."' AND created_by = '".$_SESSION['id_account']."'");
        if ($q) {
            toastr_set("success", "Template berhasil diperbarui");
        } else {
            toastr_set("error", "Template gagal diperbarui");
        }
    } else {
        toastr_set("error", "Template tidak ditemukan!");
    }

    redirect('template.php');
} else if (get("act") == "hapus") {
    $idtemplate = get("id_template");

    $q = mysqli_query($koneksi, "DELETE FROM template WHERE id_template='$idtemplate' AND created_by = '".$_SESSION['id_account']."'");
    if ($q) {
        toastr_set("success", "Template berhasil dihapus");
    } else {
        toastr_set("error", "Template gagal dihapus");
    }
    redirect("template.php");
}

?>

<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<!-- Modal -->
<div class="modal fade" id="tambahtemplate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Template</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="template.php?act=tambah" method="POST">
                    <div class="form-group">
                        <label> Nama Template</label>
                        <input type="text" name="namatemplate" value="" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label> Isi Template</label>
                        <textarea name="isitemplate" required="" class="form-control" spellcheck="false" style="margin-top: 0px; margin-bottom: 0px; height: 136px;"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="edit_modal" tabindex="-1"  role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Template</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="template.php?act=edit" method="POST">
                    <input type="hidden" name="id_template" id="id_template" readonly>
                    <div class="form-group">
                        <label> Nama Template</label>
                        <input type="text" name="namatemplate" id="namatemplate" value="" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label> Isi Template</label>
                        <textarea name="isitemplate" id="isitemplate" required="" class="form-control" spellcheck="false" style="margin-top: 0px; margin-bottom: 0px; height: 136px;"></textarea>
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
        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#tambahtemplate">
            Tambah Template
        </button>
        <br>
        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" style="display: contents">Data Template</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th><center>#</center></th>
                                <th>Nama Template</th>
                                <th>Isi Template</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $q = mysqli_query($koneksi, "SELECT * FROM template");
                            
                            $no = 0;
                            while ($v = mysqli_fetch_assoc($q)) {
                                $no++;
                                ?>
                                <tr>
                                    <td><center><?=$no?></center></td>
                                    <td><?=$v['nama_template']?></td>
                                    <td><?=$v['isi_template']?></td>
                                    <td>
                                        <center>
                                            <a href="#edit_modal" class="btn btn-info btn-sm" data-toggle="modal" onclick="edit(this)" data-id="<?=$v['id_template']?>" data-template="<?=$v['nama_template']?>" data-isi="<?=$v['isi_template']?>">Edit</a>
                                            <a onclick="return confirm('Anda yakin menghapus template tersebut?')" class="btn btn-danger btn-sm" href="template.php?act=hapus&id_template=<?=$v['id_template']?>">Hapus</a>
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
<!-- End of Main Content -->

<!-- Footer -->
<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="js/demo/datatables-demo.js"></script>

<script type="text/javascript">
    function edit(a) {
        $('#id_template').val($(a).data('id'));
        $('#namatemplate').val($(a).data('template'));
        $('#isitemplate').val($(a).data('isi'));
    }
</script>
<?php include 'footer.php';?>s