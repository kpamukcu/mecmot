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

<!-- Panel Section Start -->
<section id="panel">
    <div class="container-fluid">
        <div class="row bg-dark py-1">
            <div class="col-2 text-white">
                Mecmot Admin Paneli
            </div>
            <div class="col-10 text-end">
                <a href="logout.php" class="text-white">Güvenli Çıkış</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 bg-dark text-white py-3 menuAdmin" style="min-height: 96vh;">
                <a href="dashboard.php" class="menuItem">Başlangıç</a>
                <a href="kategoriler.php" class="menuItem">Kategoriler</a>
            </div>
            <div class="col-md-10 py-3">