<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $parametre_biri = $_POST["parametre_biri"];
    $parametre_iki = $_POST["parametre_iki"];
    $mail = $_POST["mail"];

    // Parametreleri birleştirip sha256 çevirin
    $sha256 = hash('sha256', $parametre_biri . $parametre_iki);

    // Veritabanına kaydedin
    $database = new SQLite3('veritabani.db');
    if (!$database) {
        die("Veritabanı bağlantısı başarısız: " . $database->lastErrorMsg());
    }

    $query = "INSERT INTO kullanicilar (mail, sha256) VALUES ('$mail', '$sha256')";
    $result = $database->exec($query);
    if (!$result) {
        die("Kullanıcı kaydı ekleme hatası: " . $database->lastErrorMsg());
    }

    // Hoş geldiniz mesajı gösterin ve giriş yap sayfasına yönlendirin
    echo "Hoş geldiniz, kayıt başarılı!";
    header("Location: giris_yap.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kullanıcı Kayıt</title>
</head>
<body>
    <h1>Kullanıcı Kayıt</h1>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label>Parametre Bir:</label>
        <input type="text" name="parametre_biri" required><br>

        <label>Parametre İki:</label>
        <input type="text" name="parametre_iki" required><br>

        <label>Mail:</label>
        <input type="email" name="mail" required><br>

        <input type="submit" value="Kayıt Ol">
    </form>
</body>
</html>
