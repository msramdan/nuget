<?php
include_once("helper/koneksi.php");
include_once("helper/function.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="favicon.png">
    <title>Nodejs Checking</title>

    <!-- Custom fonts for this template-->

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="row">
                        

                        <div class="col-md-6">
                            <div class="card shadow mb-4">

                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Pengaturan</h6>
                                </div>
                                <div class="row mb-5">
                                    <div class="card shadow offset-1 col-10" style="width: 18rem;">
                                        <div id="cardimg">
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
                               
                            </div>

                        </div>
                    </div>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->



    

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Core plugin JavaScript-->


    
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
            $('#cardimg').html(`<h2 class="text-center text-success mt-4">Whatsapp Connected.<br>` + src + `<h2>`);
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
</body>

</html>