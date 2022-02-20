<?php
include_once("helper/koneksi.php");
include_once("helper/function.php");


$login = cekSession();
if($login == 1){
    redirect("index.php");
}

if(post("username")){
    $username = post("username");
    $password = post("password");

    $login = login($username, $password);
    if($login == true){
        
        redirect("index.php");
    }else{
        toastr_set("error", "Username / password salah");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="logo.svg" rel="shortcut icon">
    <meta name="description" content="Nugasin WhatsApp Gateway merupakan layanan berbayar untuk pengguna umum">
    <meta name="keywords" content="whatsapp api, whatsapp api sender, api whatsapp, whatsapp, whatsapp api free, provider api whatsapp, whatsapp api provider, gateway wa, whatsapp api gateway indonesia">
  
    <title>NUget | NUGASIN - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" />
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center-login">

            <div class="col-xl-4 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-12">
                                <div class="p-4">
                                    <div class="card-body text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                    </div>
                                    <form class="user" method="POST">
                                        <div class="form-group">
                                            <input autofocus type="text" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Username..." name="username" value="" autocomplete="new-password">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password" name="password" value="">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                        
                                    </form>
                                    <div class="card-body text-center">
                                        <a  href="https://bermainapi.com" target="_blank">bermainapi.com</a>
                                    </div>
                                </div>
                                <!--<div class="card shadow mb-4">-->
                                <!--    <div class="card-header py-3 text-center">-->
                                <!--        <h6 class="m-0 font-weight-bold text-danger">UPDATE!!!</h6>-->
                                <!--    </div>-->
                                <!--    <div class="card-body text-center">-->
                                <!--        Untuk multiple devices silakan klik link berikut: <a  href="https://bermainapi.com/daftar.php" target="_blank">bermainapi.com</a>-->
                                <!--    </div>-->
                                <!--</div>-->
                            </div>
                        </div>
                    </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
    <script>
        <?php

        toastr_show();

        ?>
    </script>
</body>

</html>