<div class="col-md-4">
    <div>
        <h2>Vidalı Krikolar (VK)</h2>

        <div class="accordion accordion-flush" id="accordionFlushExample">

            <?php
            $vk = $db->prepare('select * from kategoriler where ustKat="Vidalı Krikolar" order by katAdi asc');
            $vk->execute();

            if ($vk->rowCount()) {
                foreach ($vk as $vkSatir) {
            ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#acco<?php echo $vkSatir['id']; ?>" aria-expanded="false" aria-controls="flush-collapseOne">
                                <?php echo $vkSatir['katAdi']; ?>
                            </button>
                        </h2>
                        <div id="acco<?php echo $vkSatir['id']; ?>" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">


                                <?php
                                $vkUrunler = $db->prepare('select * from urunler where altKat=? order by urunAdi asc');
                                $vkUrunler->execute(array($vkSatir['katAdi']));

                                if ($vkUrunler->rowCount()) {
                                    foreach ($vkUrunler as $vkUrunlerSatir) {
                                ?>
                                        <a href="urun-page.php?id=<?php echo $vkUrunlerSatir['id']; ?>"><?php echo $vkUrunlerSatir['urunAdi']; ?></a>
                                <?php
                                    }
                                }
                                ?>


                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>

        </div>


    </div>
    <div>
        <h2>Yön Değiştiriciler (YD)</h2>


        <div class="accordion accordion-flush" id="accordionFlushExample">
            <?php
            $yd = $db->prepare('select * from kategoriler where ustKat="Yön Değiştiriciler" order by katAdi asc');
            $yd->execute();

            if ($yd->rowCount()) {
                foreach ($yd as $ydSatir) {
            ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#acco<?php echo $ydSatir['id']; ?>" aria-expanded="false" aria-controls="flush-collapseOne">
                                <?php echo $ydSatir['katAdi']; ?>
                            </button>
                        </h2>
                        <div id="acco<?php echo $ydSatir['id']; ?>" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <?php
                                $ydUrunler = $db->prepare('select * from urunler where altKat=? order by urunAdi asc');
                                $ydUrunler->execute(array($ydSatir['katAdi']));

                                if ($ydUrunler->rowCount()) {
                                    foreach ($ydUrunler as $ydUrunlerSatir) {
                                ?>
                                        <a href="urun-page.php?id=<?php echo $ydUrunlerSatir['id']; ?>"><?php echo $ydUrunlerSatir['urunAdi']; ?></a>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>


    </div>
    <div>
        <h2>Linear Aktuatörler (EP)</h2>

        <div class="accordion accordion-flush" id="accordionFlushExample">
            <?php
            $ep = $db->prepare('select * from kategoriler where ustKat="Linear Aktuator" order by katAdi asc');
            $ep->execute();

            if ($vk->rowCount()) {
                foreach ($ep as $epSatir) {
            ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#acco<?php echo $epSatir['id']; ?>" aria-expanded="false" aria-controls="flush-collapseOne">
                                <?php echo $epSatir['katAdi']; ?>
                            </button>
                        </h2>
                        <div id="acco<?php echo $epSatir['id']; ?>" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <?php
                                $epUrunler = $db->prepare('select * from urunler where altKat=? order by urunAdi asc');
                                $epUrunler->execute(array($epSatir['katAdi']));

                                if ($epUrunler->rowCount()) {
                                    foreach ($epUrunler as $epUrunlerSatir) {
                                ?>
                                        <a href="urun-page.php?id=<?php echo $epUrunlerSatir['id']; ?>"><?php echo $epUrunlerSatir['urunAdi']; ?></a>
                                <?php
                                    }
                                }
                                ?>
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