<?php
$database = new SQLite3('veritabani.db');
if (!$database) {
    die("Veritabanı oluşturma hatası: " . $database->lastErrorMsg());
}

$query = "CREATE TABLE IF NOT EXISTS kullanicilar (mail TEXT, sha256 TEXT)";
$result = $database->exec($query);
if (!$result) {
    die("Tablo oluşturma hatası: " . $database->lastErrorMsg());
}
?>
