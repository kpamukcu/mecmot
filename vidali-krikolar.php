<?php require_once('header.php'); ?>

<?php require_once('products-menu.php') ?>

<div id="productsBody" class="py-5">
    <div class="container">

        <div class="row">
            <?php require_once('kategori-urun-side-bar.php') ?>
            <div class="col-md-8">
                <div class="row justify-content-center">

                    <?php

                    $vkList = $db->prepare('select * from urunler where anaKat="Vidalı Krikolar" order by altKat asc');
                    $vkList->execute();

                    if ($vkList->rowCount()) {
                        foreach ($vkList as $vkListSatir) {
                    ?>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <img src="<?php echo substr($vkListSatir['anaGorsel'], 1); ?>" alt="<?php echo $vkListSatir['altKat']; ?>" class="w-100">
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }

                    ?>



                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>