<?php
include_once("helper/koneksi.php");
include_once("helper/function.php");


$login = cekSession();
if ($login == 0) {
    redirect("login.php");
}
$menu = 2;
function compress($source, $destination, $quality) {
    $info = getimagesize($source);
 
    if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source);
 
    elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($source);
 
    elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source);
    imagescale($image,1920);
    imagejpeg($image, $destination, $quality);
 
    return $destination;
}

if (get('act') == 'tambah') {
    if (isset($_POST['keyword']) && isset($_POST['response'])) {
        $keyword = post("keyword");
        $response = post("response");
        $case_sensitive = post("case_sensitive");

        if ($case_sensitive == "") {
            $case_sensitive = "0";
        } else {
            $case_sensitive = "0";
        }
        if (!empty($_FILES['media']) && $_FILES['media']['error'] == UPLOAD_ERR_OK) {
            // Be sure we're dealing with an upload
            if (is_uploaded_file($_FILES['media']['tmp_name']) === false) {
                throw new \Exception('Error on upload: Invalid file definition');
            }
            
            if ($_FILES["media"]["size"] > 100000) {
              toastr_set("error", "File terlalu besar, Max 100kb");
                redirect("autoreply.php");
                exit;
            }

            // Rename the uploaded file
            $uploadName = $_FILES['media']['name'];
            $ext = strtolower(substr($uploadName, strripos($uploadName, '.') + 1));

            $allow = ['png', 'jpeg', 'pdf', 'jpg', 'xlsx', 'xls', 'doc','docx'];
            if (in_array($ext, $allow)) {
                if ($ext == "png") {
                    $filename = round(microtime(true)) . mt_rand() . '.png';
                }

                if ($ext == "pdf") {
                    $filename = round(microtime(true)) . mt_rand() . '.pdf';
                }

                if ($ext == "jpg") {
                    $filename = round(date(true)) . mt_rand() . '.jpg';
                }

                if ($ext == "jpeg") {
                    $filename = round(microtime(true)) . mt_rand() . '.jpg';
                }
                if ($ext == "xlsx") {
                    $filename = round(microtime(true)) . mt_rand() . '.xls';
                }
                if ($ext == "xls") {
                    $filename = round(microtime(true)) . mt_rand() . '.xls';
                }
                if ($ext == "docx") {
                    $filename = round(microtime(true)) . mt_rand() . '.doc';
                }
                if ($ext == "doc") {
                    $filename = round(microtime(true)) . mt_rand() . '.doc';
                }
                
            } else {
                toastr_set("error", "Format png, jpg, pdf, xlsx, xls, docx, doc only");
                redirect("autoreply.php");
                exit;
            }

            move_uploaded_file($_FILES['media']['tmp_name'], 'uploads/' . $filename);
            // Insert it into our tracking along with the original name
            $media = $base_url . "uploads/" . $filename;
            $q = mysqli_query($koneksi, "INSERT INTO autoreply(`keyword`, `response`, `media`, `case_sensitive`)
                VALUES('$keyword', '$response', '$media', '$case_sensitive')");
            if ($q) {
                toastr_set("success", "Sukses menambahkan autoreply");
            } else {
                if (file_exists('uploads/'.$filename) && unlink('uploads/'.$filename)) {
                    // Hapus file
                }
                toastr_set("error", "Gagal menambahkan autoreply");
            }
        } else {
            $q = mysqli_query($koneksi, "INSERT INTO autoreply(`keyword`, `response`, `case_sensitive`, `created_at`, `created_by`)
                VALUES('$keyword', '$response', '$case_sensitive', '".date('Y-m-d H:i:s')."', '".$_SESSION['id_account']."')");
            if ($q) {
                toastr_set("success", "Sukses menambahkan autoreply");
            } else {
                toastr_set("error", "Gagal menambahkan autoreply");
            }
        }
    } else {
        toastr_set("error", "Inputan tidak sesuai!");
    }

    redirect('autoreply.php');
}

if (get("act") == "hapus" && get('id')) {
    $id = get("id");

    $q = mysqli_query($koneksi, "DELETE FROM autoreply WHERE id='".$id."' AND created_by = '".$_SESSION['id_account']."'");
    if ($q) {
        toastr_set("success", "Sukses menghapus autoreply");
    } else {
        toastr_set("error", "Gagal menghapus autoreply");
    }
    redirect("autoreply.php");
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Autoreply</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="autoreply.php?act=tambah" method="POST" enctype="multipart/form-data">
                    <label> Keyword </label>
                    <input type="text" name="keyword" required class="form-control">
                    <br>
                    <label> Response </label>
                    <textarea name="response" class="form-control" required></textarea>
                    <br>
                    <label> Media </label>
                    <input type="file" name="media" class="form-control">
                    <p class="small-text">*Kosongkan untuk autoreply tanpa media</p>
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
                <h5 class="modal-title" id="exampleModalLabel">Import Autoreply</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="import_excel_autoreply.php" method="POST" enctype="multipart/form-data">
                    <label> File (.xlsx) </label>
                    <input type="file" name="file" required class="form-control">
                    <p class="small-text mb-0 font-italic">*Pastikan nama kategori sudah dibuat sebelum input di excel </p>
                    <br>
                    <label> Mulai dari Baris ke </label>
                    <input type="text" name="a" required class="form-control" value="2">
                    <br>
                    <label> Kolom Keyword ke </label>
                    <input type="text" name="b" required class="form-control" value="1">
                    <br>
                    <label> Kolom Response ke </label>
                    <input type="text" name="c" required class="form-control" value="2">
                    <br>
                    <label> Kolom Media ke </label>
                    <input type="text" name="d" required class="form-control" value="3">
                    <p class="small-text mb-0 font-italic">*Download file contoh <a href="excel/contohuploadautoreply.xlsx" target="_blank">disini</a> </p>
                    
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
            Tambah Autoreply
        </button>
        <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#import">
                    Import Excel
                </button>
        <br>
        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Autoreply</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="autoreply" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th><center>#</center></th>
                                <th>Keyword</th>
                                <th>Response</th>
                                <th>Media</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $q = mysqli_query($koneksi, "SELECT * FROM autoreply WHERE created_by = '".$_SESSION['id_account']."'");

                            $no = 0;
                            while ($v = mysqli_fetch_assoc($q)) {
                                $no++;
                                ?>
                                <tr>
                                    <td><center><?=$no?></center></td>
                                    <td><?=$v['keyword']?></td>
                                    <td><?=$v['response']?></td>
                                    <td>
                                        <center>
                                            <?php if (!empty($v['media'])): ?>
                                            <a href="<?=$v['media']?>" target="_blank" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> Lihat</a>
                                            <?php else: ?>
                                                -
                                            <?php endif ?>
                                        </center>
                                    </td>
                                    <td>
                                        <a onclick="return confirm('Anda yakin menghapus autoreply ini ?')" href="autoreply.php?act=hapus&id=<?=$v['id']?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>
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
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="js/demo/datatables-demo.js"></script>
<script>
    $('#autoreply').dataTable( {
        "pageLength": 20
    } );
</script>

<?php include 'footer.php';?>
<!-- End of Footer -->