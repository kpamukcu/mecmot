<?php
require_once('header.php');


if (isset($_GET['deleteId'])) {
    $id = $_GET['deleteId'];
    $urunSil = $db->prepare('delete from urunler where id=?');
    $urunSil->execute(array($id));

    if ($urunSil->rowCount()) {
        echo '<script>
            alert("Ürün Silindi")
            window.location.href = "urunler.php"
            </script>';
    } else {
        echo '<script>
        alert("Hata Oluştu")
        window.location.href = "urunler.php"
        </script>';
    }
}


?>

<!-- Ürünler Add Section Start -->
<div class="row">
    <div class="col-md-6">
        <h4>Ürünler</h4>
    </div>
    <div class="col-md-6 text-end">
        <a href="urun-ekle.php" class="btn btn-primary">Ürün Ekle</a>
    </div>
</div>
<!-- Ürünler Add Section End -->

<!-- Ürün List Start -->
<div class="row mt-5">
    <div class="col-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Görsel</th>
                    <th>Ürün Adı</th>
                    <th>Ana Kategori</th>
                    <th>Alt Kategori</th>
                    <th>Yayın Dili</th>
                    <th class="text-end">Düzenle / Sil</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $urunList = $db->prepare('select * from urunler order by id desc');
                $urunList->execute();
                if ($urunList->rowCount()) {
                    foreach ($urunList as $urunListSatir) {
                ?>
                        <tr>
                            <td><img src="<?php echo $urunListSatir['anaGorsel']; ?>" width="100"></td>
                            <td><?php echo $urunListSatir['urunAdi']; ?></td>
                            <td><?php echo $urunListSatir['anaKat']; ?></td>
                            <td><?php echo $urunListSatir['altKat']; ?></td>
                            <td><?php echo $urunListSatir['dil']; ?></td>
                            <td class="text-end">
                                <a href="urun-duzenle.php?updateId=<?php echo $urunListSatir['id']; ?>" class="btn btn-warning">Düzenle</a>
                                <a href="urunler.php?deleteId=<?php echo $urunListSatir['id']; ?>" class="btn btn-danger">Sil</a>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Ürün List End -->

<?php require_once('footer.php'); ?>