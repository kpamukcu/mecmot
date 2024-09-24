<?php require_once('header.php'); ?>

<!-- Product Section Start -->
<section id="products" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 box text-center">
                <a href="vidali-krikolar.php" class="card-product">
                    <img src="../assets/img/vidali-kriko.png" alt="Vidalı Krikolar" class="w-75 mb-5">
                    <h2 class="fs-4">Screw Jacks</h2>
                </a>
                Explore the Product Range
            </div>
            <div class="col-md-4 box text-center">
                <a href="bevel-gearbox.php" class="card-product">
                    <img src="../assets/img/bevel-gearbox.png" alt="Bevel Gearbox" class="w-75 mb-5">
                    <h2 class="fs-4">Bevel Gearbox</h2>
                </a>
                Explore the Product Range
            </div>
            <div class="col-md-4 box text-center">
                <a href="lineer-aktuator.php" class="card-product">
                    <img src="../assets/img/lineer-aktuator.png" alt="Lineer Aktuator" class="w-75 mb-5">
                    <h2 class="fs-4">Lineer Aktuator</h2>
                </a>
                Explore the Product Range
            </div>
        </div>
    </div>
</section>
<!-- Product Section Start -->

<!-- Applications Section Start -->
<section id="uygulamalar" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h3 class="text-primary fs-1">APPLICATIONS</h3>
            </div>
        </div>
        <div class="row justify-content-center">
            <?php
            $uygulamaList = $db->prepare('select * from uygulamalar where dil="İngilizce" order by adi asc');
            $uygulamaList->execute();

            if ($uygulamaList->rowCount()) {
                foreach ($uygulamaList as $uygulamaListSatir) {
            ?>
                    <div class="apps">
                        <img src="<?php echo $uygulamaListSatir['gorsel']; ?>" alt="">
                        <div class="fotoMeta">
                            <h2 class="text"><?php echo $uygulamaListSatir['adi']; ?></h2><br>
                            <p class="text"><?php echo $uygulamaListSatir['aciklama']; ?></p>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</section>
<!-- Applications Section End -->

<!-- News Section Start -->
<section id="news" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h3 class="text-primary fs-1">NEWS</h3>
            </div>
        </div>
    </div>
</section>
<!-- News Section End -->


<?php require_once('footer.php'); ?>