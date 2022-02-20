<?php
include "helper/koneksi.php";
include_once("helper/function.php");


$login = cekSession();
if ($login == 0) {
    redirect("login.php");
}
$menu = 1;
$img = "profile.jpg";
//$total=23;
    $bulan = date('m');
      for($bulan=1;$bulan<=12;$bulan++){
        $thn_ini = date('Y');
        $pemasukan = mysqli_query($koneksi,"select count(pesan) as total_pesan from pesan where month(time)='$bulan' and year(time)='$thn_ini'");
        $pem = mysqli_fetch_assoc($pemasukan);

        $jumlah = $pem['total_pesan'];
        $total .= "'$jumlah'". ", ";
      }
      
      for($bulan=1;$bulan<=12;$bulan++){
        $thn_ini = date('Y');
        $pemasukan = mysqli_query($koneksi,"select count(pesan) as total_pesan from pesan where month(time)='$bulan' and year(time)='$thn_ini' and status='GAGAL'");
        $pem = mysqli_fetch_assoc($pemasukan);

        $jumlah = $pem['total_pesan'];
        $totalgagal .= "'$jumlah'". ", ";
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
                        <img class="img-profile rounded-circle" src="<?=$base_url.'/img/undraw_profile.svg'?>">
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

            <!-- Content Row -->
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-2 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Nomor </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= countDB("nomor") ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-2 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Terkirim</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= countDB("pesan", "status", "TERKIRIM") ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-2 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Presentase 
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= round(countPresentase()) ?>%</div>
                                        </div>
                                        <div class="col">
                                            <div class="progress progress-sm mr-2">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: <?= round(countPresentase()) ?>%" aria-valuenow="<?= round(countPresentase()) ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-xl-2 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Terjadwal</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= countDB("pesan", "status", "MENUNGGU JADWAL") ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Pending Requests Card Example -->
                <div class="col-xl-2 col-md-6 mb-4">
                    <div class="card border-left-secondary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                        Template </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= countDB("template") ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Pending Requests Card Example -->
                <div class="col-xl-2 col-md-6 mb-4">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        Kategori </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= countDB("kategori") ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <!-- Area Chart -->
                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Statistik Pesan </h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body" >
                            <div class="chart-area" style="height: 100%;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Device Info</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div id="cardimg" style="text-align-last: center;">
                                Checking connection...
                                </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

<script src="lib/chart.min.js"></script>
<script type="text/javascript">
    var delayed;
    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels : ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des"],
            datasets: [{
                label: 'Pesan Terkirim',
                data: [<?php echo $total; ?>],
                backgroundColor: 'rgba(75, 192, 192)',
                borderColor: 'rgb(75, 192, 192)',
                borderWidth: 2,
                borderRadius: 4
            },
            {
                label: 'Pesan Gagal',
                data: [<?php echo $totalgagal; ?>],
                backgroundColor: 'rgba(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                borderWidth: 2,
                borderRadius: 4
            }
            ]
        },
        options: {
            animation: {
              onComplete: () => {
                delayed = true;
              },
              delay: (context) => {
                let delay = 0;
                if (context.type === 'data' && context.mode === 'default' && !delayed) {
                  delay = context.dataIndex * 300 + context.datasetIndex * 100;
                }
                return delay;
              },
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function(value) {if (value % 1 === 0) {return value;}}
                    }
                }]
            }
        }
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/3.1.0/socket.io.js" integrity="sha512-+l9L4lMTFNy3dEglQpprf7jQBhQsQ3/WvOnjaN/+/L4i0jOstgScV0q2TjfvRF4V+ZePMDuZYIQtg5T4MKr+MQ==" crossorigin="anonymous"></script>
<script>
    var socket = io();

    socket.emit('ready', 'sdf');
    
    socket.on('authenticated', function(src) {
        $('#cardimg').html(`<img src="<? echo $img ?> " class="card-img-top center" alt="cardimg" id="qrcode" style="height:200px; width:200px; border-radius: 50%;margin-top: 20px;"> <h4 class="text-center text-success mt-4">Whatsapp Terhubung<br>` + src + `<h4>`);
    });

</script>

<?php include 'footer.php'; ?>