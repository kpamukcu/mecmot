<?php require_once('header.php'); ?>

<!-- Banner Section Start -->
<section class="banner" id="uygulamarBanner">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1>Uygulamalar</h1>
            </div>
        </div>
    </div>
</section>
<!-- Banner Section End -->

<!-- Uygulamalar Content Section Start -->
<section id="uygulamalar" class="py-5">
    <div class="container">
        <div class="row">
            <?php
            $uygulamaList = $db->prepare('select * from uygulamalar order by adi asc');
            $uygulamaList->execute();

            if ($uygulamaList->rowCount()) {
                foreach ($uygulamaList as $uygulamaListSatir) {
            ?>
                    <div class="col-md-4">
                        <div class="foto">
                            <img src="<?php echo substr($uygulamaListSatir['gorsel'], 1); ?>" alt="" class="w-100">
                        </div>
                        <div class="fotoMeta">
                            <h2>Başlık</h2>
                        </div>
                    </div>
            <?php
                }
            }
            ?>

        </div>
    </div>
</section>
<!-- Uygulamalar Content Section End -->

<?php require_once('footer.php'); ?>