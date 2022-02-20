<?php
include_once("helper/koneksi.php");
include_once("helper/function.php");


$login = cekSession();
if (!$login) {
    redirect("login.php");
}
$menu = 9;
if ($_SESSION['level'] != 1) {
    toastr_set("error", "Anda tidak memiliki akses ke halaman ini!");
    redirect('index.php');
    exit;
}
$img = "profile.jpg";
if (post("username")) {
    $u = post("username");
    $p = sha1(post("password"));
    $l = post("level");

    $count = countDB("account", "username", $u);

    if ($count == 0) {
        $q = mysqli_query($koneksi, "INSERT INTO account(`username`, `password`, `id_level`)
        VALUES('$u', '$p', '$l')");
        toastr_set("success", "Sukses membuat user");
    } else {
        toastr_set("error", "Username telah terpakai");
    }
    redirect('pengaturan.php');
}

if (get("act") == "hapus") {
    $id = get("id");

    $cek = mysqli_query($koneksi, 'SELECT id FROM account WHERE id = '.$id.'');
    if (mysqli_num_rows($cek) > 0) {
        while ($v = mysqli_fetch_assoc($cek)) {
            if ($v['id_level'] != 1) {
                mysqli_query($koneksi, "DELETE FROM account WHERE id='$id'");
                mysqli_query($koneksi, "DELETE FROM pengaturan WHERE id_account='$id'");
                toastr_set("success", "Sukses hapus user");
            } else {
                toastr_set("error", "Tidak dapat menghapus user");
            }
        }
    } else {
        toastr_set("error", "User tidak ditemukan!");
    }
    redirect('pengaturan.php');
}

if (post("chunk")) {
    $chunk = post("chunk");
    $wa = post("wa");
    $api_key = post("api_key");
    $nomor = post("nomor");
    mysqli_query($koneksi, "UPDATE pengaturan SET chunk = '$chunk', wa_gateway_url = '$wa', api_key='$api_key', nomor='$nomor' WHERE id_account='".$_SESSION['id_account']."'");
    toastr_set("success", "Sukses edit pengaturan");
    redirect('pengaturan.php');
}

if (get("act") == "gapi") {
    $api_key = rand(100000, 999999);
    mysqli_query($koneksi, "UPDATE pengaturan SET api_key='$api_key' WHERE id_account='".$_SESSION['id_account']."'");
    toastr_set("success", "API Key update");
    redirect("pengaturan.php");
}

// Cek data API
$data_api = mysqli_query($koneksi, "SELECT * FROM pengaturan WHERE id_account = '".mysqli_escape_string($_SESSION['id_account'])."'");
if (mysqli_fetch_row($data_api) == 0) {
    // Generate pengaturan baru sesuai API
    $api_key = rand(100000, 999999);
    mysqli_query($koneksi, "INSERT INTO pengaturan(`chunk`, `wa_gateway_url`, `nomor`, `api_key`, `callback`, `id_account`)
        VALUES('30', '".$base_url."', NULL, '".$api_key."', '".$base_url."', '".$_SESSION['id_account']."')");
}

?>
<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <label> Username </label>
                    <input type="text" name="username" required class="form-control">
                    <br>
                    <label> Password </label>
                    <input type="password" name="password" required class="form-control">
                    <br>
                    <label for="exampleFormControlSelect1">Level</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="level">
                        <?php 
                            $res = mysqli_query($koneksi, "SELECT * FROM level");
                            while ($x = mysqli_fetch_assoc($res)) {
                                ?>
                                <option value="<?=$x['id_level']?>"><?=$x['level']?></option>
                                <?php
                            }
                        ?>
                    </select>
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
        <div class="row">
            <div class="col-md-6">
                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal">
                    Tambah User
                </button>
                <br>
                <div class="card shadow mb-4">

                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Level</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $q = mysqli_query($koneksi, "SELECT * FROM account a JOIN level l ON l.id_level = a.id_level");
                                    while ($row = mysqli_fetch_assoc($q)) {
                                        echo '<tr>';
                                        echo '<td>' . $row['id'] . '</td>';
                                        echo '<td>' . $row['username'] . '</td>';
                                        echo '<td>'.$row['level'].'</td>';
                                        
                                        ?>
                                        <?php if ($row['id_level'] != 1): ?>
                                        <td>
                                            <center>
                                                <a class="btn btn-danger" onclick="return confirm('Anda yakin menghapus akun : <?=$row['username']?>')" href="pengaturan.php?act=hapus&id=<?=$row['id']?>">Hapus</a>
                                            </center>
                                        </td>
                                        <?php else: ?>
                                            <td><center>-</center></td>
                                        <?php endif ?>
                                        <?php
                                        echo '</tr>';
                                    }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-6">
                <div class="card shadow mb-4">

                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Pengaturan</h6>
                    </div>
                    <div class="row">
                        <div class="card shadow offset-1 col-10" style="width: 18rem;">
                            <div id="cardimg" style="text-align-last: center;">
                            </div>
                            <div class="card-body">
                                <div id="cardimg" class="text-center p-3">

                                </div>
                                <h5 class="card-title"><span class="text-dark">Status :</span>
                                    <p class="log"></p>
                                </h5>
                                <div class="text-center">

                                    <button id="logout" href="#" class="btn btn-danger mt-6">logout</button>
                                    <button id="scanqrr" href="#" class="btn btn-primary mt-6">Scan qr</button>
                                    <button id="cekstatus" href="#" class="btn btn-success mt-6">Cek Koneksi</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <hr>
                        <?php 
                            while ($x = mysqli_fetch_assoc($data_api)) {
                                ?>
                                <form action="" method="post">
                                    <label> URL Whatsapp Gateway </label>
                                    <input type="text" class="form-control" name="wa" value="<?= $x['wa_gateway_url'] ?>">
                                    <p class="text-muted">*isi domain anda , contoh : <?=$base_url?></p>
                                    <br>
                                    <label> Batas Pengiriman per menit (Default=30) </label>
                                    <input type="text" class="form-control" name="chunk" value="<?=$x['chunk']?>">
                                    <br>
                                    <label> API Key </label>
                                    <input type="text" class="form-control" name="api_key" readonly value="<?=$x['api_key']?>">
                                    <br>
                                    <button class="btn btn-success"> Simpan </button>
                                    <a class="btn btn-primary" href="pengaturan.php?act=gapi"> Generate New API Key </a> 
                                </form>
                                <?php
                            }
                        ?>
                    </div>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/3.1.0/socket.io.js" integrity="sha512-+l9L4lMTFNy3dEglQpprf7jQBhQsQ3/WvOnjaN/+/L4i0jOstgScV0q2TjfvRF4V+ZePMDuZYIQtg5T4MKr+MQ==" crossorigin="anonymous"></script>
<script>
    var socket = io();

    socket.emit('ready', 'sdf');
    socket.on('loader', function() {
        $('#cardimg').html(`<img src="loading.gif" class="card-img-top center" alt="cardimg" id="qrcode"  style="height:250px; width:250px;">`);
    })
    socket.on('message', function(msg) {
        $('.log').html(`<li>` + msg + `</li>`);
    })
    socket.on('qr', function(src) {
        $('#cardimg').html(` <img src="` + src + `" class="card-img-top" alt="cardimg" id="qrcode" style="height:250px; width:250px;">`);
    });

    socket.on('authenticated', function(src) {
        $('#cardimg').html(`<img src="<? echo $img ?> " class="card-img-top center" alt="cardimg" id="qrcode" style="height:200px; width:200px; border-radius: 50%;margin-top: 20px;"> <h4 class="text-center text-success mt-4">Whatsapp Terhubung<br>` + src + `<h4>`);
        $('.log').html(`<li>Terhubung</li>`);
    });

    $('#logout').click(function() {
        $('#cardimg').html(`<h2 class="text-center text-dark mt-4">Please wait..<h2>`);
        $('.log').html(`<li>Connecting..</li>`);
        socket.emit('logout', 'delete');
    })

    $('#scanqrr').click(function() {
        socket.emit('scanqr', 'scanqr');
    })
    $('#cekstatus').click(function() {
        socket.emit('cekstatus', 'cekstatus');
    })

    socket.on('isdelete', function(msg) {
        $('#cardimg').html(msg);
    })
</script>

<!-- Footer -->
<?php include 'footer.php';?>