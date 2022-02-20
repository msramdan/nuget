<?php
include_once("helper/koneksi.php");
include_once("helper/function.php");

$login = cekSession();
if ($login == 0) {
    redirect("login.php");
}
$menu = 7;
if (post("pesan")) {
    $nomor = post("nomor");
    $pesan = post("pesan");

    //toastr_set("error", "fitur dimatikan sementara"); 

    $res = sendMSG($nomor, $pesan);
    if ($res['status'] == "true") {
        $id_blast = getLastID("blast");
        $q = mysqli_query($koneksi, "INSERT INTO pesan(`id_blast`, `nomor`, `pesan`, `status`)
            VALUES('$id_blast', '$nomor', '$pesan', 'TERKIRIM')");
        toastr_set("success", "Pesan terkirim ke nomor $nomor");
    } else {
        $id_blast = getLastID("blast");
        $q = mysqli_query($koneksi, "INSERT INTO pesan(`id_blast`, `nomor`, `pesan`, `status`)
            VALUES('$id_blast', '$nomor', '$pesan', 'GAGAL')");
        toastr_set("error", "Pesan tidak terkirim");
    }
}

if (post("nomorbutton")) {
    $nomor = post("nomorbutton");
    $pesan = post("pesanbutton");
    $btn1= post("btn1");
    $btn2= post("btn2");

    //toastr_set("error", "fitur dimatikan sementara"); 

    $res = sendMSGbtn($nomor, $pesan, $btn1, $btn2);
    if ($res['status'] == "true") {
        $id_blast = getLastID("blast");
        $q = mysqli_query($koneksi, "INSERT INTO pesan(`id_blast`, `nomor`, `pesan`, `status`)
            VALUES('$id_blast', '$nomor', '$pesan', 'TERKIRIM')");
        toastr_set("success", "Pesan terkirim ke nomor $nomor");
    } else {
        $id_blast = getLastID("blast");
        $q = mysqli_query($koneksi, "INSERT INTO pesan(`id_blast`, `nomor`, `pesan`, `status`)
            VALUES('$id_blast', '$nomor', '$pesan', 'GAGAL')");
        toastr_set("error", "Pesan tidak terkirim");
    }
}

if(post("nomormedia")){

    $nomor = post("nomormedia");
    $pesan = post("pesanmedia");
    
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["media"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["media"]["tmp_name"]);
      if($check !== false) {
        $uploadOk = 1;
      } else {
        $msg = "File is not an image.";
        $uploadOk = 0;
      }
    }
    
    // Check file size
    if ($_FILES["media"]["size"] > 500000) {
      $msg = "Sorry, your file is too large.";
      $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" && $imageFileType != "pdf") {
      $msg = "Sorry, only JPG, JPEG, PNG, PDF & GIF files are allowed.";
      $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      toastr_set("error", $msg);
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["media"]["tmp_name"], $target_file)) {
          $url_file = $base_url . $target_file;
        $res = sendMedia($nomor,$imageFileType, $pesan,$url_file);
          if ($res['status'] == "true") {
            toastr_set("success", "Pesan terkirim ke nomor $nomor");
            redirect("kirimmanual.php");
         } else {
            toastr_set("error", "Pesan tidak terkirim");
            redirect("kirimmanual.php");
          }
      } else {
        toastr_set("error", $msg);
        redirect("kirimmanual.php");
      }
    }
}
?>
<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

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
    
    <div class="container-fluid">
        <h5 id="cardimg" class="text-lg font-medium truncate" style="color:red;">Checking connection...</h5> 
    <div class="row">
        <div class="col-md-4">
        <!-- Begin Page Content -->

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tes Kirim Pesan</h6>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <label> Nomor </label>
                        <input class="form-control" type="text" name="nomor" placeholder="08xxxxxxxx" required>
                        <br>
                        <label> Pesan </label>
                        <input class="form-control" type="text" name="pesan" placeholder="Isi Pesan" required>
                        <br>
                        <button class="btn btn-success" type="submit">Kirim</button>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-md-4">
        <!-- Begin Page Content -->

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tes Kirim Pesan Button</h6>
                </div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <label> Nomor </label>
                        <input class="form-control" type="text" name="nomorbutton" placeholder="08xxxxxxxx" required>
                        <br>
                        <label> Pesan </label>
                        <input class="form-control" type="text" name="pesanbutton" placeholder="Isi Pesan"  required>
                        <br>
                        <label> Button 1 </label>
                        <select class="form-control js-example-basic-multiple" name="btn1" style="width: 100%" required>
                            <option value="" selected>Pilih Respon</option>
                            <?php
                            $q = mysqli_query($koneksi, "SELECT * FROM autoreply");
                        
                            while ($row = mysqli_fetch_assoc($q)) {
                                echo '<option value="' . $row['keyword'] . '">' . $row['keyword'] . ' </option>';
                            }
                            ?>
                        </select>
                        <p class="small-text font-italic">*Respon berdasarkan data Autoreply</p>
                        <label> Button 2 </label>
                        <select class="form-control js-example-basic-multiple" name="btn2" style="width: 100%" required>
                            <option value="" selected>Pilih Respon</option>
                            <?php
                            $q = mysqli_query($koneksi, "SELECT * FROM autoreply");
                        
                            while ($row = mysqli_fetch_assoc($q)) {
                                echo '<option value="' . $row['keyword'] . '">' . $row['keyword'] . ' </option>';
                            }
                            ?>
                        </select>
                        <p class="small-text font-italic">*Respon berdasarkan data Autoreply</p>
                        <br>
                        <button class="btn btn-success" type="submit">Kirim</button>
                    </form>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
        <div class="col-md-4">
        <!-- Begin Page Content -->

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tes Kirim Pesan Media</h6>
                </div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <label> Nomor </label>
                        <input class="form-control" type="text" name="nomormedia" placeholder="08xxxxxxxx" required>
                        <br>
                        <label> Caption </label>
                        <input class="form-control" type="text" name="pesanmedia" placeholder="Isi Pesan" required>
                        <br>
                        <label> File </label>
                        <input class="form-control" type="file" name="media" style="height: auto;" required>
                        <p class="small-text font-italic">*jpg, png, jpeg, pdf</p>
                        <br>
                        <button class="btn btn-success" type="submit">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    </div>
</div>
<!-- End of Main Content -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/3.1.0/socket.io.js" integrity="sha512-+l9L4lMTFNy3dEglQpprf7jQBhQsQ3/WvOnjaN/+/L4i0jOstgScV0q2TjfvRF4V+ZePMDuZYIQtg5T4MKr+MQ==" crossorigin="anonymous"></script>
<script>
    var socket = io();

    socket.emit('ready', 'sdf');

    socket.on('authenticated', function(src) {
        $('#cardimg').html(`<h2 class="text-lg font-medium truncate" style="color:green;">Ready to send<h2>` );
    });
</script>
<!-- Footer -->
<?php include 'footer.php';?>