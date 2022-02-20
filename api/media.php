<?php

include_once("../helper/koneksi.php");
include_once("../helper/function.php");


// Takes raw data from the request
$data = json_decode(file_get_contents('php://input'), true);

$nomor = $data['number'];
$filetype = $data['filetype'];
$pesan = $data['caption'];
$file = $data['url'];
header('Content-Type: application/json');

$api_key = get("key");
if($api_key != api_key()){
    $ret['status'] = false;
    $ret['msg'] = "Api key salah";
    echo json_encode($ret, true);
    exit;
}

if($nomor ==NULL){
    $ret['status'] = false;
    $ret['msg'] = "Nomor tidak boleh kosong";
    echo json_encode($ret, true);
    exit;
}


$res = sendMedia($nomor, $filetype, $pesan, $file);
if($res['status'] == "true"){
    $ret['status'] = true;
    $ret['msg'] = "Pesan media berhasil dikirim";
    echo json_encode($ret, true);
    exit;
}else{
    $ret['status'] = false;
    $ret['msg'] = "Pesan media gagal dikirim";
    echo json_encode($ret, true);
    exit;
}
