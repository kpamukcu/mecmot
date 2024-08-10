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
    <title>Mecmot - Admin Giriş</title>
</head>

<body class="bg-secondary-subtle">

    <!-- Login Section Start -->
    <section id="login">
        <div class="container">
            <div class="row" style="height: 70vh;">
                <div class="col-4 m-auto bg-dark py-4 px-3 shadow rounded">
                    <div class="text-center mb-4"><img src="../assets/img/mecmot-beyaz-logo.webp" class="w-50"></div>
                    <form action="" method="post">
                        <input type="text" name="kadi" placeholder="Kullanıcı Adı" class="form-control">
                        <input type="password" name="sifre" placeholder="Şifreniz" class="form-control my-3">
                        <input type="submit" value="Giriş Yap" class="btn btn-success w-100" name="loginBtn">
                    </form>

                    <?php
                    if (isset($_POST['loginBtn'])) {

                        $admin = $db->prepare('select * from admin where kadi=?');
                        $admin->execute(array($_POST['kadi']));
                        $adminSatir = $admin->fetch();

                        if ($_POST['kadi'] == $adminSatir['kadi'] && $_POST['sifre'] == $adminSatir['sifre']) {
                            $_SESSION['user'] = $_POST['kadi'];
                            echo '<div class="alert alert-success mt-3 text-center">Kullanıcı Doğrulandı. Lütfen Bekleyin.</div><meta http-equiv="refresh" content="1; url=dashboard.php">';
                        } else {
                            echo '<div class="alert alert-danger mt-3 text-center">Kullanıcı Adı ve/veya Şifreniz Hatalı</div>';
                        }
                    }
                    ?>

                </div>
            </div>
        </div>
    </section>
    <!-- Login Section End -->

    



    <!-- Js Files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>