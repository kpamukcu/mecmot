<?php require_once('header.php'); ?>

<div class="row">
    <div class="col-12">
        <h4>Uygulamalar</h4>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <form action="" method="post" class="formFlex border border-secondary-subtl rounded p-3" enctype="multipart/form-data">
            <div class="formItem">
                <input type="text" name="adi" placeholder="Uygulama Adını Girin" class="form-control">
            </div>
            <div class="formItem">
                <textarea name="aciklama" placeholder="Açıklama" class="form-control" rows="5"></textarea>
            </div>
            <div class="formItem">
                <label for="">İçerik Dili</label>
                <select name="dil" class="form-control">
                    <option value="">Seçiniz</option>
                    <option value="Türkçe">Türkçe</option>
                    <option value="İngilizce">İngilizce</option>
                </select>
            </div>
            <div class="formItem">
                <label for="">Görsel Yükleyin (1000 x 1000px)</label>
                <input type="file" name="gorsel" class="form-control">
            </div>
            <div class="formItem">
                <input type="submit" value="Kaydet" class="btn btn-success w-100" name="uygulamaKaydet">
            </div>
        </form>
    </div>
    <div class="col-md-8">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Görsel</th>
                    <th>Adı</th>
                    <th>Açıklama</th>
                    <th>Dil</th>
                    <th>Düzenle / Sil</th>
                </tr>
            </thead>
            <tbody>

                <?php

                $uygulamaList = $db->prepare('select * from uygulamalar order by adi asc');
                $uygulamaList->execute();

                if ($uygulamaList->rowCount()) {
                    foreach ($uygulamaList as $uygulamaListSatir) {
                ?>
                        <tr>
                            <td>
                                <img src="<?php echo $uygulamaListSatir['gorsel']; ?>" width="100">
                            </td>
                            <td><?php echo $uygulamaListSatir['adi']; ?></td>
                            <td><?php echo $uygulamaListSatir['aciklama']; ?></td>
                            <td><?php echo $uygulamaListSatir['dil']; ?></td>
                            <td>
                                <a href="uygulamalar.php?updateID=<?php echo $uygulamaListSatir['id']; ?>" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                                <a href="uygulamalar.php?deleteID=<?php echo $uygulamaListSatir['id']; ?>" class="btn btn-danger"><i class="bi bi-trash3"></i></a>
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

<!-- Uygulama Add Module Start -->
<?php
if (isset($_POST['uygulamaKaydet'])) {
    $gorsel = '../assets/img/' . $_FILES['gorsel']['name'];

    if (move_uploaded_file($_FILES['gorsel']['tmp_name'], $gorsel)) {
        $uygulamaKaydet = $db->prepare('insert into uygulamalar(adi,aciklama,dil,gorsel) values(?,?,?,?)');
        $uygulamaKaydet->execute(array($_POST['adi'], $_POST['aciklama'], $_POST['dil'], $gorsel));

        if ($uygulamaKaydet->rowCount()) {
            echo '
            <script>
            alert("Kayıt Başarılı")
            window.location.href="uygulamalar.php"
            </script>
            ';
        } else {
            echo '
            <script>
            alert("Hata Oluştu")
            window.location.href="uygulamalar.php"
            </script>
            ';
        }
    } else {
        echo '<script>alert("Görsel Yüklenemedi")</script>';
    }
}
?>
<!-- Uygulama Add Module End -->

<?php require_once('footer.php'); ?>