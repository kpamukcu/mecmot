<div class="col-md-4">
    <div>
        <h2>Vidalı Krikolar (VK)</h2>

        <?php

        $vk = $db->prepare('select * from kategoriler where ustKat="Vidalı Krikolar" order by katAdi asc');
        $vk->execute();

        if ($vk->rowCount()) {
            foreach ($vk as $vkSatir) {
        ?>
                <div class="btn-group">
                    <a class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $vkSatir['katAdi']; ?>
                    </a>
                    <ul class="dropdown-menu">
                        ...
                    </ul>
                </div>
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