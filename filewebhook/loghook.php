<?php
date_default_timezone_set('Asia/Jakarta');
include_once("../helper/function.php");
include_once("../helper/koneksi.php");
// ------------------------------------------------------------------//
header('content-type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
$message = $data['details']['message']['buttonsResponseMessage']['selectedDisplayText']; 

$cekautoreply = $koneksi->query("SELECT * FROM autoreply WHERE keyword = '$message'");
if (mysqli_num_rows($cekautoreply) > 0) {
    $datareply = mysqli_fetch_assoc($cekautoreply);
    $res = $datareply['response'];
    $file = $datareply['media'];
    $filetype = substr($datareply['media'],-3);
    if($datareply['media']==NULL){
        sendMSG($nomor, $res);
    }else{
        sendMedia($nomor, $filetype, $res, $file);
    }
} 