<?php

     include "helper/koneksi.php";
include "helper/function.php";

    $id = $_POST['idtemplate'];

    $nama = $_POST['namatemplate'];
    
    $isi = $_POST['isitemplate'];
    





    $sql = mysqli_query($koneksi, "UPDATE template SET nama_template = '$nama', isi_template = '$isi' WHERE id_template=$id");



    if ($sql) {

        //jika  berhasil tampil ini
        toastr_set("success", "Template berhasil diubah");
        redirect("template.php");

    } else {

        // jika gagal tampil ini
        toastr_set("error", "Template gagal diubah");
        redirect("template.php");

    }

?>