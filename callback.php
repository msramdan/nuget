<?php
include_once("helper/koneksi.php");
include_once("helper/function.php");

header('content-type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
file_put_contents('whatsapp.txt', '[' . date('Y-m-d H:i:s') . "]\n" . json_encode($data) . "\n\n", FILE_APPEND);
$nomor = $data['sender'];
$pesan = $data['msg'];

// auto reply
$msg = strtolower($pesan);
$cekautoreply = $koneksi->query("SELECT * FROM autoreply WHERE keyword = '$pesan'");
if (mysqli_num_rows($cekautoreply) > 0) {
    $datareply = mysqli_fetch_assoc($cekautoreply);
    $res = $datareply['response'];
    $file = $datareply['media'];
    $filetype = substr($datareply['media'],-3);
    if($datareply['media']==NULL){
        $send = sendMSG($nomor, $res);
    }else{
        $send = sendMedia($nomor, $filetype, $res, $file);
    }
} 
