<?php
include_once("helper/koneksi.php");
include_once("helper/function.php");
$login = cekSession();
if ($login == 0) {
    redirect("login.php");
}

$menu = 6;

if (post("pesan")) {
    $username = $_SESSION['username'];
    $pesan = post("pesan");
    $jadwal = date("Y-m-d H:i:s", strtotime(post("tgl") . " " . post("jam")));
    if (!empty($_FILES['media']) && $_FILES['media']['error'] == UPLOAD_ERR_OK) {
        // Be sure we're dealing with an upload
        if (is_uploaded_file($_FILES['media']['tmp_name']) === false) {
            throw new \Exception('Error on upload: Invalid file definition');
        }

        // Rename the uploaded file
        $uploadName = $_FILES['media']['name'];
        $ext = strtolower(substr($uploadName, strripos($uploadName, '.') + 1));

        $allow = ['png', 'jpeg', 'pdf', 'jpg'];
        if (in_array($ext, $allow)) {
            if ($ext == "png") {
                $filename = round(microtime(true)) . mt_rand() . '.png';
            }

            if ($ext == "pdf") {
                $filename = round(microtime(true)) . mt_rand() . '.pdf';
            }

            if ($ext == "jpg") {
                $filename = round(microtime(true)) . mt_rand() . '.jpg';
            }

            if ($ext == "jpeg") {
                $filename = round(microtime(true)) . mt_rand() . '.jpeg';
            }
        } else {
            toastr_set("error", "Format png, jpg, pdf only");
            redirect("kirim.php");
            exit;
        }

        move_uploaded_file($_FILES['media']['tmp_name'], 'uploads/' . $filename);
        // Insert it into our tracking along with the original name
        $media = $base_url . "uploads/" . $filename;
    } else {
        $media = null;
    }

    if ($media == null) {
        $nomor = serialize(getAllNumber());
        $q = mysqli_query($koneksi, "INSERT INTO blast(`nomor`, `pesan`, `jadwal`, `make_by`)
        VALUES('$nomor', '$pesan', '$jadwal', '$username')");
    } else {
        $nomor = serialize(getAllNumber());
        $q = mysqli_query($koneksi, "INSERT INTO blast(`nomor`, `pesan`, `media`, `jadwal`, `make_by`)
        VALUES('$nomor', '$pesan', '$media', '$jadwal', '$username')");
    }

    if (isset($_POST['target'])) {
        $namakategori = $_POST['target'];
        $n = getAllNumberKategori($namakategori);
    } else {
        $n = getAllNumber();
    }

    $id_blast = getLastID("blast");
    if (post("tiap_bulan") == "on") {
        $tiap_bulan = "1";
        $last_month = date("m", strtotime("-1 month"));
    } else {
        $tiap_bulan = "0";
        $last_month = date("m", strtotime("-1 month"));
    }

    foreach ($n as $nn) {
        if ($media == null) {
            $q = mysqli_query($koneksi, "INSERT INTO pesan(`id_blast`, `nomor`, `pesan`, `jadwal`, `tiap_bulan`, `last_month`, `make_by`)
            VALUES('$id_blast', '$nn', '$pesan', '$jadwal', '$tiap_bulan', '$last_month', '$username')");
        } else {
            $q = mysqli_query($koneksi, "INSERT INTO pesan(`id_blast`, `nomor`, `pesan`, `media`, `jadwal`,`tiap_bulan`, `last_month`, `make_by`)
            VALUES('$id_blast', '$nn', '$pesan', '$media', '$jadwal', '$tiap_bulan', '$last_month', '$username')");
        }
    }

    if ($q) {
        toastr_set("success", "Sukses kirim pesan terjadwal");
    } else {
        toastr_set("error", "Gagal kirim pesan terjadwal");
    }
}

if (post("pesan2")) {

    $username = $_SESSION['username'];
    $pesan = post("pesantemplate");
    $jadwal = date("Y-m-d H:i:s", strtotime(post("tgl") . " " . post("jam")));
    if (!empty($_FILES['media']) && $_FILES['media']['error'] == UPLOAD_ERR_OK) {
        // Be sure we're dealing with an upload
        if (is_uploaded_file($_FILES['media']['tmp_name']) === false) {
            throw new \Exception('Error on upload: Invalid file definition');
        }

        // Rename the uploaded file
        $uploadName = $_FILES['media']['name'];
        $ext = strtolower(substr($uploadName, strripos($uploadName, '.') + 1));

        $allow = ['png', 'jpeg', 'pdf', 'jpg'];
        if (in_array($ext, $allow)) {
            if ($ext == "png") {
                $filename = round(microtime(true)) . mt_rand() . '.png';
            }

            if ($ext == "pdf") {
                $filename = round(microtime(true)) . mt_rand() . '.pdf';
            }

            if ($ext == "jpg") {
                $filename = round(microtime(true)) . mt_rand() . '.jpg';
            }

            if ($ext == "jpeg") {
                $filename = round(microtime(true)) . mt_rand() . '.jpeg';
            }
        } else {
            toastr_set("error", "Format png, jpg, pdf only");
            redirect("kirim.php");
            exit;
        }

        move_uploaded_file($_FILES['media']['tmp_name'], 'uploads/' . $filename);
        // Insert it into our tracking along with the original name
        $media = $base_url . "uploads/" . $filename;
    } else {
        $media = null;
    }

    if ($media == null) {
        $nomor = serialize(getAllNumber());
        $q = mysqli_query($koneksi, "INSERT INTO blast(`nomor`, `pesan`, `jadwal`, `make_by`)
        VALUES('$nomor', '$pesan', '$jadwal', '$username')");
    } else {
        $nomor = serialize(getAllNumber());
        $q = mysqli_query($koneksi, "INSERT INTO blast(`nomor`, `pesan`, `media`, `jadwal`, `make_by`)
        VALUES('$nomor', '$pesan', '$media', '$jadwal', '$username')");
    }

    if (isset($_POST['target'])) {
        $namakategori = $_POST['target'];
        $n = getAllNumberKategori($namakategori);
    } else {
        $n = getAllNumber();
    }

    $id_blast = getLastID("blast");
    if (post("tiap_bulan") == "on") {
        $tiap_bulan = "1";
        $last_month = date("m", strtotime("-1 month"));
    } else {
        $tiap_bulan = "0";
        $last_month = date("m", strtotime("-1 month"));
    }

    foreach ($n as $nn) {
        if ($media == null) {
            $q = mysqli_query($koneksi, "INSERT INTO pesan(`id_blast`, `nomor`, `pesan`, `jadwal`, `tiap_bulan`, `last_month`, `make_by`)
            VALUES('$id_blast', '$nn', '$pesan', '$jadwal', '$tiap_bulan', '$last_month', '$username')");
        } else {
            $q = mysqli_query($koneksi, "INSERT INTO pesan(`id_blast`, `nomor`, `pesan`, `media`, `jadwal`,`tiap_bulan`, `last_month`, `make_by`)
            VALUES('$id_blast', '$nn', '$pesan', '$media', '$jadwal', '$tiap_bulan', '$last_month', '$username')");
        }
    }

    if ($q) {
        toastr_set("success", "Sukses kirim pesan terjadwal");
    } else {
        toastr_set("error", "Gagal kirim pesan terjadwal");
    }
}

if (get("act") == "ku") {
    $id_blast = get("id");
    $q = mysqli_query($koneksi, "UPDATE `pesan` SET `status`='MENUNGGU JADWAL' WHERE `id_blast`='$id_blast' AND `status`='GAGAL' AND make_by = '".$_SESSION['id_account']."'");
    if ($q) {
        toastr_set("success", "Sukses mengirim ulang blast");
    } else {
        toastr_set("error", "Gagal mengirim ulang blast");
    }
    redirect("kirim.php");
}

if (get("act") == "hd") {
    $q = mysqli_query($koneksi, "DELETE FROM pesan WHERE `status`='TERKIRIM' AND `tiap_bulan`='0' AND make_by = '".$_SESSION['id_account']."'");
    if ($q) {
        toastr_set("success", "Sukses menghapus pesan");
    } else {
        toastr_set("error", "Gagal menghapus pesan");
    }
    redirect("kirim.php");
}

if (get("act") == "hapus" && is_numeric(get('id'))) {
    $q = mysqli_query($koneksi, "DELETE FROM pesan WHERE id = '".get('id')."' AND make_by = '".$_SESSION['id_account']."'");
    if ($q) {
        toastr_set("success", "Sukses menghapus pesan");
    } else {
        toastr_set("error", "Gagal menghapus pesan");
    }
    redirect("kirim.php");
}

?>
<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="css/select2.min.css" rel="stylesheet">
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kirim Pesan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <label> Pesan * </label>
                    <textarea name="pesan" required class="form-control"></textarea>
                    <br>
                    <label> Media </label>
                    <input type="file" name="media" class="form-control">
                    <br>
                    <label> Tanggal Pengiriman * </label>
                    <input type="date" name="tgl" required class="form-control">
                    <br>
                    <label> Waktu Pengiriman * </label>
                    <input type="time" name="jam" required class="form-control">
                    <br>
                    <label>Kategori Target</label>
                    <br>
                    <select class="form-control select2" name="target"style="width: 100%" required>
                        <option value="" selected>Pilih Kategori</option>
                        <?php
                        $q = mysqli_query($koneksi, "SELECT * FROM kategori WHERE created_by = '".$_SESSION['id_account']."'");
                    
                        while ($row = mysqli_fetch_assoc($q)) {
                            echo '<option value="' . $row['kategori'] . '">' . $row['kategori'] . ' </option>';
                        }
                        ?>
                    </select>
                    
                    <br>
                    <div class="form-check">
                        <input type="checkbox" name="tiap_bulan" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Kirim tiap bulan</label>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="pesan1" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="kirimpesan2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kirim Pesan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="pesan2" value="yo">
                    <label>Template Pesan</label>
                    <br>
                    <select class="form-control select2" name="pesantemplate" style="width: 100%" required>
                        <option value="" selected>Pilih Template</option>
                        <?php
                        $q = mysqli_query($koneksi, "SELECT * FROM template WHERE created_by = '".$_SESSION['id_account']."'");
                    
                        while ($row = mysqli_fetch_assoc($q)) {
                            echo '<option value="' . $row['isi_template'] . '">' . $row['template'] . ' </option>';
                        }
                        ?>
                    </select>
                    <label> Media </label>
                    <input type="file" name="media" class="form-control">
                    <br>
                    <label> Tanggal Pengiriman * </label>
                    <input type="date" name="tgl" required class="form-control">
                    <br>
                    <label> Waktu Pengiriman * </label>
                    <input type="time" name="jam" required class="form-control">
                    <br>
                    <label>Kategori Target</label>
                    <br>
                    <select class="form-control select2" name="target"style="width: 100%" required>
                        <option value="" selected>Pilih Kategori</option>
                        <?php
                        $q = mysqli_query($koneksi, "SELECT * FROM kategori WHERE created_by = '".$_SESSION['id_account']."'");
                    
                        while ($row = mysqli_fetch_assoc($q)) {
                            echo '<option value="' . $row['kategori'] . '">' . $row['kategori'] . ' </option>';
                        }
                        ?>
                    </select>
                    <br>
                    <div class="form-check">
                        <input type="checkbox" name="tiap_bulan" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Kirim tiap bulan</label>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="kirimpesan2" class="btn btn-info">Simpan</button>
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
        <h5 id="cardimg" class="text-lg font-medium truncate" style="color:red;">Checking connection...</h5>
        
        <!-- DataTales Example -->
        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal">
            Kirim Pesan
        </button>
        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#kirimpesan2">
            Kirim Pesan (Template)
        </button>
        <br>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" style="display:contents">Data Pesan</h6>
                <a class="btn btn-danger float-right" onclick="return confirm('Anda yakin menghapus seluruh pesan terkirim?')" href="kirim.php?act=hd">Hapus data (terkirim)</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nomor</th>
                                <th>Pesan</th>
                                <th>Media</th>
                                <th>Jadwal</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $q = mysqli_query($koneksi, "SELECT * FROM pesan WHERE make_by='".$_SESSION['id_account']."' ORDER BY id DESC");
                            while ($v = mysqli_fetch_assoc($q)) {
                                ?>
                                <tr>
                                    <td><?=$v['id']?></td>
                                    <td><?=$v['nomor']?></td>
                                    <td><?=$v['pesan']?></td>
                                    <td>
                                        <center>
                                            <?=(!empty($v['media'])? '<a class="btn btn-info" href="'.$v['media'].'" target="_blank"><i class="fa fa-eye"></i></a>': '-')?>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <?=(!empty($v['last_month']) ? '<span class="badge badge-info">Manual</span>': '-')?>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <?php 
                                                if ($v['status'] == 'TERKIRIM') {
                                                    ?>
                                                    <span class="badge badge-success status-container-<?=$v['id']?>">Terkirim</span>
                                                    <?php
                                                } else if ($v['status'] == 'GAGAL') {
                                                    ?>
                                                    <span class="badge badge-danger status-container-<?=$v['id']?>">Gagal Terkirim</span>
                                                    <?php
                                                } else if ($v['tiap_bulan'] == '1') {
                                                    ?>
                                                    <span class="badge badge-primary status-container-<?=$v['id']?>">Bulanan</span>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <span class="badge badge-warning status-container-<?=$v['id']?>">Pending</span>
                                                    <?php
                                                }
                                            ?>
                                        </center>   
                                    </td>
                                    <td>
                                        <a onclick="return confirm('Anda yakin menghapus pesan <?=$v['pesan']?>?')" class="btn btn-danger btn-sm" href="kirim.php?act=hapus&id=<?=$v['id']?>">Hapus</a>
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

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>
<script src="lib/select2.full.min.js"></script>
<script src="lib/moment.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/3.1.0/socket.io.js" integrity="sha512-+l9L4lMTFNy3dEglQpprf7jQBhQsQ3/WvOnjaN/+/L4i0jOstgScV0q2TjfvRF4V+ZePMDuZYIQtg5T4MKr+MQ==" crossorigin="anonymous"></script>
    
<script>
    $(document).ready(function() {
        $('.select2').select2({
            dropdownAutoWidth: true
        });
    });
</script>
<script>
    var socket = io();

    socket.emit('ready', 'sdf');

    socket.on('authenticated', function(src) {
        $('#cardimg').html(`<h2 class="text-lg font-medium truncate" style="color:green;">Ready to send<h2>` );
    });
</script>
<!-- Footer -->
<?php include 'footer.php';?>