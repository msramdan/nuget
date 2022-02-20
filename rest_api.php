<?php
include_once("helper/koneksi.php");
include_once("helper/function.php");
$login = cekSession();
if ($login == 0) {
    redirect("login.php");
}
$menu = 8;
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <link href="logo.svg" rel="shortcut icon">
    <meta name="author" content="">

    <title>NUget - Rest Api</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" />
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'sidebar.php';?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

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
                    <div class="row">

                        

                        <div class="col-md-6">
                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">REST API</h6>
                                </div>
                                <div class="card-body">
                                    <h5 class="font-weight-bold text-primary">Kirim Pesan Text</h5>
                                    <label> <b>Endpoint Method</b> <span class="badge badge-primary">POST</span> </label>
                                    <input type="text" class="form-control" value="<?= $base_url ?>api/send.php?key=APIKEY" readonly>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label> <b>Parameter (JSON)</b> </label>
                                            <br>
                                            <div class="bg-dark border-start border-lg rounded border-primary p-3 mb-3 text-white" style="font-family: monospace;font-size: 12px;">{<br>
                                            	<text class="text-hijau ml-3">"nomor"</text>:<text class="text-kuning">"082246698567"</text>,<br>
                                            	<text class="text-hijau ml-3">"msg"</text>:<text class="text-kuning">"isi pesan anda"</text><br>
                                            }</div>
                                        </div>
                                        <div class="col-md-12">
                                            <label> <b>Response (JSON)</b> </label>
                                            <br>
                                            <div class="bg-dark border-start border-lg rounded border-primary p-3 mb-3 text-white" style="font-family: monospace;font-size: 12px;">{<br>
                                            	<text class="text-hijau ml-3">"status"</text>:<text class="text-ungu"> true</text>,<br>
                                            	<text class="text-hijau ml-3">"msg"</text>:<text class="text-kuning">"Pesan berhasil dikirim"</text><br>
                                            }</div>
                                        </div>
                                    </div>
                                    
                                    <br>

                                    <h5 class="font-weight-bold text-primary">Kirim Pesan Media</h5>
                                    <label> <b>Endpoint Method</b> <span class="badge badge-primary">POST</span> </label>
                                    <input type="text" class="form-control" value="<?= $base_url ?>api/media.php?key=APIKEY" readonly>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label> <b>Parameter (JSON)</b> </label>
                                            <br>
                                            <div class="bg-dark border-start border-lg rounded border-primary p-3 mb-3 text-white" style="font-family: monospace;font-size: 12px;">{<br>
                                            	<text class="text-hijau ml-3">"nomor"</text>:<text class="text-kuning">"082246698567"</text>,<br>
                                            	<text class="text-hijau ml-3">"filetype"</text>:<text class="text-kuning">"png"</text>,<br>
                                            	<text class="text-hijau ml-3">"caption"</text>:<text class="text-kuning">"Isi caption"</text>,<br>
                                            	<text class="text-hijau ml-3">"url"</text>:<text class="text-kuning">"https://path.to/url.png"</text><br>
                                            }</div>
                                        </div>
                                        <div class="col-md-12">
                                            <label> <b>Response (JSON)</b> </label>
                                            <br>
                                            <div class="bg-dark border-start border-lg rounded border-primary p-3 mb-3 text-white" style="font-family: monospace;font-size: 12px;">{<br>
                                            	<text class="text-hijau ml-3">"status"</text>:<text class="text-ungu"> true</text>,<br>
                                            	<text class="text-hijau ml-3">"msg"</text>:<text class="text-kuning">"Pesan berhasil dikirim"</text><br>
                                            }<br></div>
                                        </div>
                                    </div>

                                    <br>
                                    <p class="text-muted text-red">*REST API bisa dikonfigurasikan sesuai dengan kebutuhan anda.</p>

                                   



                                    <br>

                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">WEBHOOK</h6>
                                </div>
                                <div class="card-body">
                                    <h5 class="font-weight-bold text-primary">Menggunakan Fungsi Webhook</h5>
                                    <label> <b>Endpoint Method</b> <span class="badge badge-primary">POST</span> </label>
                                    <input type="text" class="form-control" value="<?= $base_url ?>filewebhook/webhook.php" readonly>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label> <b>Parameter (JSON)</b> </label>
                                            <br>
                                            <p class="text-muted">*Contoh webhook panggil api corona</p>
                                            <div class="bg-dark border-start border-lg rounded border-primary p-3 mb-3 text-white" style="font-family: monospace;font-size: 12px;"><<text>?</text><text class="text-ungu">php</text><br>
                                            	<text class="text-hijau ml-3">header</text>(<text class="text-ungu">'content-type: application/json'</text>);<br>
                                            	<text class="text-kuning ml-3">$data </text>=<text class="text-hijau"> json_decode</text>(<text class="text-hijau">file_get_contents</text>(<text class="text-ungu">'php://input'</text>), <text class="text-red">true</text>);<br>
                                            	<text class="text-kuning ml-3">$message </text>=<text class="text-hijau"> $data</text>[<text class="text-hijau">'message'</text>];</text><br>
                                            	<text class="text-kuning ml-3">$from </text>=<text class="text-hijau"> $data</text>[<text class="text-hijau">'from'</text>];</text><br><br>
                                            	<text class="text-red ml-3">function</text> KawalCorona() { <text class="text-muted">//membuat fungsi api corona</text><br>
                                            	<text class="text-kuning ml-5">$url </text>=<text class="text-ungu">"https://api.kawalcorona.com/indonesia/"</text>;</text><br>
                                            	<text class="text-kuning ml-5">$client </text>= <text class="text-hijau">curl_init</text>(<text class="text-kuning">$url</text>);</text><br>
                                            	<text class="text-hijau ml-5">curl_setopt</text>(<text class="text-kuning">$client</text>, CURLOPT_RETURNTRANSFER, <text class="text-red">true</text>);<br>
                                            	<text class="text-kuning ml-5">$response </text>= <text class="text-hijau">curl_exec</text>(<text class="text-kuning">$client</text>);</text><br><br>
                                            	<text class="text-kuning ml-5">$result </text>= <text class="text-hijau">json_decode</text>(<text class="text-kuning">$response</text>);</text><br>
                                            	<text class="text-hijau ml-5">return</text> <text class="text-kuning">$result</text>;<br><text class="ml-3">}</text><br><br>
                                            	<text class="text-red ml-3">if </text>(<text class="text-hijau">strtolower</text>(<text class="text-kuning">$message</text>) ==<text class="text-ungu">'corona'</text>) {<br>
                                            	<text class="text-kuning ml-5">$total </text>= KawalCorona(); <text class="text-muted">//memanggil fungsi api corona</text><br>
                                            	<text class="text-red ml-5">foreach </text>(<text class="text-kuning">$total </text><text class="text-red">as </text><text class="text-kuning">$data</text>){<br>
                                            	<text class="text-kuning ml-7">$positif </text>= <text class="text-kuning">$result</text>->positif; <br><text class="ml-3">}</text><br>
                                            	<text class="text-kuning ml-3">$totalpositif </text>= <text class="text-ungu">"Informasi Pasien Positif Corona: <text class="text-kuning">$positif</text>"</text>; <br>
                                            	<text class="text-kuning ml-3">$result </text>= [ <br>
                                            	<text class="text-ungu ml-5">'mode'</text>=> <text class="text-ungu">'chat'</text><br>
                                            	<text class="text-ungu ml-5">'pesan'</text>=> <text class="text-kuning">$totalpositif </text><br>
                                            	<text class="ml-3">];</text><br>
                                            	<text class="text-hijau ml-3">print json_encode</text>(<text class="text-kuning">$result</text>);
                                            <br>?></div>
                                        </div> 
                                    </div>
                                    
                                    <br>
                                    <p class="text-muted text-red">*WEBHOOK bisa dikonfigurasikan sesuai dengan kebutuhan anda.</p>

                                   



                                    <br>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include 'footer.php';?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
    <script>
        <?php

        toastr_show();

        ?>
    </script>
</body>

</html>