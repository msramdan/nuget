<?php

$host = "localhost";
$username = "root";
$password = "";
$db = "nuget";

$koneksi = mysqli_connect($host, $username, $password, $db) or die("GAGAL");

$base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$base_url .= "://".$_SERVER['HTTP_HOST'];
$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
date_default_timezone_set('Asia/Jakarta');
