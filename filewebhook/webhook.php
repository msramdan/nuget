<?php
date_default_timezone_set('Asia/Jakarta');
// ------------------------------------------------------------------//
header('content-type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
file_put_contents('whatsapp.txt', '[' . date('Y-m-d H:i:s') . "]\n" . json_encode($data) . "\n\n", FILE_APPEND);
$message = $data['message']; // ini menangkap pesan masuk
$from = $data['from']; // ini menangkap nomor pengirim pesan

function KawalCorona() {
    $url = "https://api.kawalcorona.com/indonesia/";
    $client = curl_init($url);
    curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
    $response = curl_exec($client);
    
    $result = json_decode($response);
    
    return $result;
}

if (strtolower($message) == 'hai') {
    $result = [
        'mode' => 'chat', // mode chat = chat biasa
        'pesan' => 'Hai juga'
    ];
} else if(strtolower($message) == 'corona') {
    $total = KawalCorona();
    $tanggal = date("d/m/Y H:i:s");
    foreach ($total as $data){
        $nama = $data->name;
        $positif = $data->positif;
        $sembuh = $data->sembuh;
        $meninggal = $data->meninggal;
        $dirawat = $data->dirawat;
    }
    $pesantotal = "Informasi Pasien Corona di $nama tanggal $tanggal \r\nPositif: *$positif*\r\nSembuh: *$sembuh*\r\nMeninggal: *$meninggal*\r\nDirawat: *$dirawat*\r\n\r\n_*data dari https://api.kawalcorona.com_";
    $result = [
        'mode' => 'chat', // mode chat = chat biasa
        'pesan' => $pesantotal
    ];
}else if (strtolower($message) == 'gambar') {
    $result = [
        'mode' => 'picture', // type picture = kirim pesan gambar
        'data' => [
            'caption' => '*webhook picture*',
            'url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRZ2Ox4zgP799q86H56GbPMNWAdQQrfIWD-Mw&usqp=CAU'
        ]
    ];
} 
print json_encode($result);
