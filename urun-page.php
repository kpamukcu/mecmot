<?php
require_once('header.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $urun = $db->prepare('select * from urunler where id=?');
    $urun->execute(array($id));
    $urunSatir = $urun->fetch();
}

?>
<?php require_once('products-menu.php') ?>

<div id="productsBody" class="py-5">
    <div class="container">
        <div class="row">
            <?php require_once('kategori-urun-side-bar.php') ?>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-12">
                        <h1><?php echo $urunSatir['urunAdi']; ?></h1>
                    </div>
                </div>
                <div class="row my-5">
                    <div class="col-md-5">
                        <img src="<?php echo substr($urunSatir['anaGorsel'], 1); ?>" alt="<?php echo $urunSatir['urunAdi']; ?>" style="width: 100%;">
                    </div>
                    <div class="col-md-6">
                        <h4>Teknik Özellikler</h4>
                        <?php echo $urunSatir['tenikOzellikler']; ?>

                    </div>
                    <div class="col-md-1">
                        <a href="<?php echo substr($urunSatir['katalog'], 1); ?>" target="_blank"><img src="./assets/img/pdf.png" alt=""></a>
                        <a href="<?php echo substr($urunSatir['2dDokuman'], 1); ?>" target="_blank"><img src="./assets/img/2d.png" alt=""></a>
                        <a href="<?php echo substr($urunSatir['3dDokuman'], 1); ?>" target="_blank"><img src="./assets/img/3d.png" alt=""></a>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-9 text-center">
                        <img src="<?php echo substr($urunSatir['yardimciGorsel'], 1); ?>" alt="" class="w-100">
                    </div>
                    <div class="col-12">
                        <h4>Aksesuarlar</h4>
                        <?php echo $urunSatir['aksesuarlar']; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>