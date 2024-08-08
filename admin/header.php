<?php
require_once('../assets/baglan.php');
session_start();
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Css Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>
        <?php
        $dosyaAdi = basename($_SERVER['SCRIPT_NAME']);
        $dosyaAdi = pathinfo($dosyaAdi, PATHINFO_FILENAME);
        echo $dosyaAdi;
        ?>
    </title>
</head>

<body>

<?php require_once('./session.php'); ?>





    <!-- Js Files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>