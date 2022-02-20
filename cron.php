<?php
include_once("helper/koneksi.php");
include_once("helper/function.php");



$count = 0;
$now = strtotime(date("Y-m-d H:i:s"));
$chunk = getSingleValDB("pengaturan", 'id', '1', 'chunk');
$q = mysqli_query($koneksi, "SELECT * FROM pesan WHERE UNIX_TIMESTAMP(jadwal) <= '$now' AND status='MENUNGGU JADWAL' AND tiap_bulan='0' ORDER BY id ASC LIMIT $chunk");
while ($row = mysqli_fetch_assoc($q)) {
    if ($row['media'] == null) {
        $send = sendMSG($row['nomor'], $row['pesan']);
        if ($send['status'] == "true") {
            updateStatusMSG($row['id'], "TERKIRIM");
        } else {
            updateStatusMSG($row['id'], "GAGAL");
        }
    } else {
        $file = $row['media'];
        $filetype = substr($file,-3);
        $send = sendMedia($row['nomor'],$filetype, $row['pesan'],$file);
        if ($send['status'] == "true") {
            updateStatusMSG($row['id'], "TERKIRIM");
        } else {
            updateStatusMSG($row['id'], "GAGAL");
        }
    }
    $count++;
}

$m = date("m");
$lm = date("m", strtotime("-1 month"));
$q2 = mysqli_query($koneksi, "SELECT * FROM pesan WHERE MONTH(jadwal) = '$m' AND tiap_bulan='1' AND last_month='$lm' ORDER BY id ASC LIMIT $chunk");
while ($row2 = mysqli_fetch_assoc($q2)) {
    if ($row2['media'] == null) {
        $send = sendMSG($row2['nomor'], $row2['pesan']);
        if ($send['status'] == "true") {
            $s = true;
        } else {
            $s = false;
        }
    } else {
        $file = $row2['media'];
        $filetype = substr($file,-3);
        $send = sendMedia($row2['nomor'],$filetype, $row2['pesan'],$file);
        if ($send['status'] == "true") {
            $s = true;
        } else {
            $s = false;
        }
    }
    if ($s == true) {
        $this_id = $row2['id'];
        $q3 = mysqli_query($koneksi, "UPDATE pesan SET last_month='$m' WHERE id='$this_id'");
    }
    $count++;
}


echo "sukses kirim " . $count . " pesan";
