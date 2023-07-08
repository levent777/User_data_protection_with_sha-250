<?php
//design : leventk@protonmail.com
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $parametre_biri = $_POST["parametre_biri"];
    $parametre_iki = $_POST["parametre_iki"];
    $mail = $_POST["mail"];

    // Parametreleri birleştirip sha256 çevirin
    $sha256 = hash('sha256', $parametre_biri . $parametre_iki);

    // Veritabanında eşleşme kontrolü yapın
    $database = new SQLite3('veritabani.db');
    $result = $database->query("SELECT * FROM kullanicilar WHERE mail = '$mail' AND sha256 = '$sha256'");

    if ($result->fetchArray()) {
        // Giriş başarılı, hoş geldiniz!
        header("Location: home.php");
        exit();
    } else {
        echo "Login failed, please check your information.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label>Parameter One:</label>
        <input type="text" name="parametre_biri" required><br>

        <label>Parameter Two:</label>
        <input type="text" name="parametre_iki" required><br>

        <label>Mail:</label>
        <input type="email" name="mail" required><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>
