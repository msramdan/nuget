<?php

include_once("../helper/koneksi.php");
include_once("../helper/function.php");


// Takes raw data from the request
$data = json_decode(file_get_contents('php://input'), true);
$nomor = get("nomor");
$pesan = get("msg");
$api_key = get("key");
header('Content-Type: application/json');
if($api_key != api_key()){
    $ret['status'] = false;
    $ret['msg'] = "Api key salah";
    echo json_encode($ret, true);
    exit;
}

if(!isset($nomor)){
    $ret['status'] = false;
    $ret['msg'] = "Nomor tidak boleh kosong";
    echo json_encode($ret, true);
    exit;
}


if( !isset($pesan)){
    $ret['status'] = false;
    $ret['msg'] = "Pesan tidak boleh kosong";
    echo json_encode($ret, true);
    exit;
}



$res = sendMSG($nomor, $pesan);
if($res['status'] == "true"){
    $ret['status'] = true;
    $ret['msg'] = "Pesan berhasil dikirim";
    echo json_encode($ret, true);
    exit;
}else{
    $ret['status'] = 0;
    $ret['msg'] = $res['message'];
    echo json_encode($ret, true);
    exit;
}
