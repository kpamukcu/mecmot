<?php
require_once('header.php');

if (isset($_GET['updateId'])) {
    $id = $_GET['updateId'];

    $urun = $db->prepare('select * from urunler where id=?');
    $urun->execute(array($id));
    $urunSatir = $urun->fetch();
}

?>

<div class="row">
    <div class="col-md-6">
        <h4>Ürün Düzenle</h4>
    </div>
    <div class="col-md-6 text-end">
        <a href="urunler.php" class="btn btn-primary">Ürünler</a>
    </div>
</div>
<div class="row mt-5">
    <div class="col-12">
        <form action="" method="post" class="row" enctype="multipart/form-data">
            <div class="col-md-9 formFlex">
                <input type="text" name="urunAdi" value="<?php echo $urunSatir['urunAdi']; ?>" class="form-control">
                <textarea name="tenikOzellikler" id="tenikOzellikler"><?php echo $urunSatir['tenikOzellikler']; ?></textarea>
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
                <textarea name="aksesuarlar" id="aksesuarlar"><?php echo $urunSatir['aksesuarlar']; ?></textarea>
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
                    <label for="">Ana Görsel - <b><?php echo substr($urunSatir['anaGorsel'], 14); ?></b></label>
                    <input type="file" class="form-control" name="anaGorsel">
                </div>
                <div class="form-group">
                    <label for="">Yardımcı Görsel - <b><?php echo substr($urunSatir['yardimciGorsel'], 14); ?></b></label>
                    <input type="file" class="form-control" name="yardimciGorsel">
                </div>
                <div class="form-group">
                    <label for="">Katalog (Pdf) - <b><?php echo substr($urunSatir['katalog'], 15); ?></b></label>
                    <input type="file" class="form-control" name="katalog">
                </div>
                <div class="form-group">
                    <label for="">2D Dokuman - <b><?php echo substr($urunSatir['2dDokuman'], 15); ?></b></label>
                    <input type="file" class="form-control" name="2dDokuman">
                </div>
                <div class="form-group">
                    <label for="">3D Dokuman - <b><?php echo substr($urunSatir['3dDokuman'], 15); ?></b></label>
                    <input type="file" class="form-control" name="3dDokuman">
                </div>
                <div class="form-group">
                    <label for="">Ana Kategori</label>
                    <select name="anaKat" id="" class="form-control">
                        <option name="<?php echo $urunSatir['anaKat']; ?>"><?php echo $urunSatir['anaKat']; ?></option>
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
                    <select name="altKat" class="form-control">
                        <option name="<?php echo $urunSatir['altKat']; ?>"><?php echo $urunSatir['altKat']; ?></option>
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
                        <option value="<?php echo $urunSatir['dil']; ?>"><?php echo $urunSatir['dil']; ?></option>
                        <option value="Türkçe">Türkçe</option>
                        <option value="İngilizce">İngilizce</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="hidden" name="urunID" value="<?php echo $urunSatir['id']; ?>">
                    <button type="submit" class="btn btn-success w-100" name="urunGuncelle">Güncelle</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php



if (isset($_POST['urunGuncelle'])) {

    $UanaGorsel = '../assets/img/' . $_FILES['anaGorsel']['name'];
    $UyardimciGorsel = '../assets/img/' . $_FILES['yardimciGorsel']['name'];
    $Ukatalog = '../assets/docs/' . $_FILES['katalog']['name'];
    $U2dDokuman = '../assets/docs/' . $_FILES['2dDokuman']['name'];
    $U3dDokuman = '../assets/docs/' . $_FILES['3dDokuman']['name'];

    if (
        move_uploaded_file($_FILES['anaGorsel']['tmp_name'], $UanaGorsel) &&
        move_uploaded_file($_FILES['yardimciGorsel']['tmp_name'], $UyardimciGorsel) &&
        move_uploaded_file($_FILES['katalog']['tmp_name'], $Ukatalog) &&
        move_uploaded_file($_FILES['2dDokuman']['tmp_name'], $U2dDokuman) &&
        move_uploaded_file($_FILES['3dDokuman']['tmp_name'], $U3dDokuman)
    ) {
        $urunGuncelle = $db->prepare('update urunler set urunAdi=?, tenikOzellikler=?, aksesuarlar=?, anaGorsel=?, yardimciGorsel=?, katalog=?, 2dDokuman=?, 3dDokuman=?, anaKat=?, altKat=?, dil=? where id=? ');
        $urunGuncelle->execute(array($_POST['urunAdi'], $_POST['tenikOzellikler'], $_POST['aksesuarlar'], $UanaGorsel, $UyardimciGorsel, $Ukatalog, $U2dDokuman, $U3dDokuman, $_POST['anaKat'], $_POST['altKat'], $_POST['dil'], $_POST['urunID']));

        if ($urunGuncelle->rowCount()) {
            echo '
            <script>
            alert("Ürün Bilgileri Güncellendi")
            window.location.href = "urunler.php"
            </script>
            ';
        } else {
            echo '
            <script>
            alert("Hata Oluştu")
            window.location.href = "urunler.php"
            </script>
            ';
        }
    } else {
        $urunGuncelle = $db->prepare('update urunler set urunAdi=?, tenikOzellikler=?, aksesuarlar=?, anaKat=?, altKat=?, dil=? where id=? ');
        $urunGuncelle->execute(array($_POST['urunAdi'], $_POST['tenikOzellikler'], $_POST['aksesuarlar'], $_POST['anaKat'], $_POST['altKat'], $_POST['dil'], $_POST['urunID']));

        if ($urunGuncelle->rowCount()) {
            echo '
            <script>
            alert("Ürün Bilgileri Güncellendi")
            window.location.href = "urunler.php"
            </script>
            ';
        } else {
            echo '
            <script>
            alert("Hata Oluştu")
            window.location.href = "urunler.php"
            </script>
            ';
        }
    }
}
?>

<?php require_once('footer.php'); ?>