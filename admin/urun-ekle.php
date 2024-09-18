<?php require_once('header.php'); ?>

<div class="row">
    <div class="col-md-6">
        <h4>Ürün Ekle</h4>
    </div>
    <div class="col-md-6 text-end">
        <a href="urunler.php" class="btn btn-primary">Ürünler</a>
    </div>
</div>
<div class="row mt-5">
    <div class="col-12">
        <form action="" method="post" class="row" enctype="multipart/form-data">
            <div class="col-md-9 formFlex">
                <input type="text" name="urunAdi" placeholder="Ürün Adını Girin" class="form-control">
                <textarea name="tenikOzellikler" id="tenikOzellikler" placeholder="Teknik Özellikler"></textarea>
                <script>
                    ClassicEditor
                        .create(document.querySelector('#tenikOzellikler'))
                        .then(editor => {
                            editor.ui.view.editable.element.style.height = '250px';
                            editor.ui.view.element.style.width = '100%';
                        })
                        .catch(error => {
                            console.error(error);
                        });
                </script>
                <textarea name="aksesuarlar" id="aksesuarlar" placeholder="Aksesuarlar"></textarea>
                <script>
                    ClassicEditor
                        .create(document.querySelector('#aksesuarlar'))
                        .then(editor => {
                            editor.ui.view.editable.element.style.height = '250px';
                            editor.ui.view.element.style.width = '100%';
                        })
                        .catch(error => {
                            console.error(error);
                        });
                </script>
            </div>
            <div class="col-md-3 formFlex">
                <div class="form-group">
                    <label for="">Ana Görsel</label>
                    <input type="file" class="form-control" name="anaGorsel">
                </div>
                <div class="form-group">
                    <label for="">Yardımcı Görsel</label>
                    <input type="file" class="form-control" name="yardimciGorsel">
                </div>
                <div class="form-group">
                    <label for="">Katalog (Pdf)</label>
                    <input type="file" class="form-control" name="katalog">
                </div>
                <div class="form-group">
                    <label for="">2D Dokuman</label>
                    <input type="file" class="form-control" name="2dDokuman">
                </div>
                <div class="form-group">
                    <label for="">3D Dokuman</label>
                    <input type="file" class="form-control" name="3dDokuman">
                </div>
                <div class="form-group">
                    <label for="">Ana Kategori</label>
                    <select name="anaKat" id="" class="form-control">
                        <option name="" id="">Seçiniz</option>

                        <?php
                        $mainCat = $db->prepare('select * from kategoriler where katTuru="Üst Kategori" order by katAdi asc');
                        $mainCat->execute();

                        if ($mainCat->rowCount()) {
                            foreach ($mainCat as $mainCatSatir) {
                        ?>
                                <option name="<?php echo $mainCatSatir['katAdi']; ?>" id=""><?php echo $mainCatSatir['katAdi']; ?></option>
                        <?php
                            }
                        }
                        ?>

                    </select>
                </div>
                <div class="form-group">
                    <label for="">Alt Kategori</label>
                    <select name="altKat" id="" class="form-control">
                        <option name="" id="">Seçiniz</option>
                        <?php
                        $subCat = $db->prepare('select * from kategoriler where katTuru = "Alt Kategori" order by katAdi asc');
                        $subCat->execute();

                        if ($subCat->rowCount()) {
                            foreach ($subCat as $subCatSatir) {
                        ?>
                                <option name="<?php echo $subCatSatir['katAdi']; ?>" id=""><?php echo $subCatSatir['katAdi']; ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">İçerik Yayın Dili</label>
                    <select name="dil" class="form-control">
                        <option value="">Seçiniz</option>
                        <option value="Türkçe">Türkçe</option>
                        <option value="İngilizce">İngilizce</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success w-100" name="urunKaydet">Kaydet</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php

if (isset($_POST['urunKaydet'])) {
    $anaGorsel = '../assets/img/' . $_FILES['anaGorsel']['name'];
    $yardimciGorsel = '../assets/img/' . $_FILES['yardimciGorsel']['name'];
    $katalog = '../assets/docs/' . $_FILES['katalog']['name'];
    $Dokuman2d = '../assets/docs/' . $_FILES['2dDokuman']['name'];
    $Dokuman3d = '../assets/docs/' . $_FILES['3dDokuman']['name'];

    if (
        move_uploaded_file($_FILES['anaGorsel']['tmp_name'], $anaGorsel) &&
        move_uploaded_file($_FILES['yardimciGorsel']['tmp_name'], $yardimciGorsel) &&
        move_uploaded_file($_FILES['katalog']['tmp_name'], $katalog) &&
        move_uploaded_file($_FILES['2dDokuman']['tmp_name'], $Dokuman2d) &&
        move_uploaded_file($_FILES['3dDokuman']['tmp_name'], $Dokuman3d)
    ) {
        $urunKaydet = $db->prepare('insert into urunler(urunAdi,tenikOzellikler,aksesuarlar,anaGorsel,yardimciGorsel,katalog,2dDokuman,3dDokuman,anaKat,altKat,dil) values(?,?,?,?,?,?,?,?,?,?,?)');
        $urunKaydet->execute(array($_POST['urunAdi'], $_POST['tenikOzellikler'], $_POST['aksesuarlar'], $anaGorsel, $yardimciGorsel, $katalog, $Dokuman2d, $Dokuman3d, $_POST['anaKat'], $_POST['altKat'], $_POST['dil']));

        if ($urunKaydet->rowCount()) {
            echo '<script>
            alert("Yeni Ürün Eklendi")
            window.location.href = "urunler.php"
            </script>';
        } else {
            echo '<script>alert("Ürün Eklenemedi")</script>';
        }
    } else {
        echo '<script>alert("Eksik Dosya!!! Ürün Eklenemedi")</script>';
    }
}
?>

<?php require_once('footer.php'); ?>