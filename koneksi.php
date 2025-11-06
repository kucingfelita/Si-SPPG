<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "db_si_sppg";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

function check_and_reconnect($koneksi) {
    if (!mysqli_ping($koneksi)) {
        $koneksi = mysqli_connect($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['pass'], $GLOBALS['db']);
        if (!$koneksi) {
            die("Koneksi gagal: " . mysqli_connect_error());
        }
    }
    return $koneksi;
}
?>