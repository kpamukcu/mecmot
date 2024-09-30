<div class="col-md-4">
    <div>
        <h2>Vidalı Krikolar (VK)</h2>
        <?php
        $vk = $db->prepare('select * from kategoriler where ustKat="Vidalı Krikolar" order by katAdi asc');
        $vk->execute();
        if ($vk->rowCount()) {
            foreach ($vk as $vkSatir) {
        ?>
                <li class="list-group-item">
                    <a href="vidali-krikolar.php?katAdi=<?php echo $vkSatir['katAdi']; ?>"><?php echo $vkSatir['katAdi']; ?></a>
                </li>
        <?php
            }
        }
        ?>
    </div>
    <div>
        <h2>Yön Değiştiriciler (YD)</h2>
    </div>
    <div>
        <h2>Linear Aktuatörler (EP)</h2>
    </div>
</div>