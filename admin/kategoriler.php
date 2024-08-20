<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('header.php');

if (isset($_GET['deleteID'])) {
    $id = $_GET['deleteID'];
    $delCat = $db->prepare('delete from kategoriler where id=?');
    $delCat->execute(array($id));

    if ($delCat->rowCount()) {
        echo '<script>alert("Kategori Silindi")</script>';
        header('location: kategoriler.php');
        exit();
    } else {
        echo '<script>alert("Hata Oluştu")</script>';
    }
} elseif (isset($_GET['updateID'])) {
    $id = $_GET['updateID'];
    $upCat = $db->prepare('select * from kategoriler where id=?');
    $upCat->execute(array($id));
    $upCatSatir = $upCat->fetch();

    echo "
    <script>
            document.addEventListener('DOMContentLoaded', function () {
            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
            myModal.show();
            });
    </script>
    ";
}
?>

<div class="row">
    <div class="col-md-6">
        <h4>Kategoriler</h4>
    </div>
    <div class="col-md-6 text-end">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Kategori Ekle
        </button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Ürün Kategorisi Ekle</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" class="form text-start" enctype="multipart/form-data">
                            <input type="text" name="katAdi" placeholder="Kategori Adını Girin (Türkçe)" class="form-control mb-2">
                            <label for="katTuru"><small>Kategori Türü</small></label>
                            <select name="katTuru" id="katTuru" class="form-control mb-2">
                                <option value="">Seçiniz</option>
                                <option value="Alt Kategori">Alt Kategori</option>
                                <option value="Üst Kategori">Üst Kategori</option>
                            </select>
                            <label for="ustKat"><small>Üst Kategori</small></label>
                            <select name="ustKat" id="ustKat" class="form-control mb-2">
                                <option value="">Seçiniz</option>
                                <?php

                                $ustKatList = $db->prepare('select DISTINCT katAdi from kategoriler order by katAdi asc');
                                $ustKatList->execute();

                                if ($ustKatList->rowCount()) {
                                    foreach ($ustKatList as $ustKatListSatir) {
                                ?>
                                        <option value="<?php echo $ustKatListSatir['katAdi']; ?>"><?php echo $ustKatListSatir['katAdi']; ?></option>
                                <?php
                                    }
                                }

                                ?>
                            </select>
                            <textarea name="aciklama" placeholder="Açıklama (Max.160 Karakter Girin)" class="form-control mb-2" rows="5"></textarea>
                            <label for="gorsel"><small>Kategori Görseli</small></label>
                            <input type="file" name="gorsel" id="gorsel" class="form-control mb-2">
                            <label>Kategori Dili</label><br>
                            <input type="radio" name="katDili" value="Türkçe"> <small>Türkçe</small>
                            <input type="radio" name="katDili" value="İngilizce"> <small>İngilizce</small>
                            <input type="submit" value="Kaydet" class="btn btn-success w-100 mt-4" name="katEkle">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Category Add Module Start -->
    <?php
    if (isset($_POST['katEkle'])) {
        $gorsel = '../assets/img/' . $_FILES['gorsel']['name'];

        echo $gorsel;
        if (move_uploaded_file($_FILES['gorsel']['tmp_name'], $gorsel)) {
            $katKaydet = $db->prepare('insert into kategoriler(katAdi,katTuru,ustKat,aciklama,gorsel,katDili) values(?,?,?,?,?,?)');
            $katKaydet->execute(array($_POST['katAdi'], $_POST['katTuru'], $_POST['ustKat'], $_POST['aciklama'], $gorsel, $_POST['katDili']));

            if ($katKaydet->rowCount()) {
                echo '<script>alert("Kategori Kaydedildi")</script><meta http-equiv="refresh" content="0; url=kategoriler.php">';
            } else {
                echo '<script>alert("Hata Oluştu")</script><meta http-equiv="refresh" content="0; url=kategoriler.php">';
            }
        } else {
            echo '<script>alert("Görsel Yüklenemedi")</script>';
        }
    }
    ?>
    <!-- Category Add Module End -->

    <!-- Category List Section Start -->
    <div class="row">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Görsel</th>
                        <th>Kategori Adı</th>
                        <th>Kategori Türü</th>
                        <th>Üst Kategorisi</th>
                        <th>Açıklama</th>
                        <th>Dil</th>
                        <th class="text-center">Düzenle / Sil</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $katList = $db->prepare('select * from kategoriler order by katAdi asc');
                    $katList->execute();

                    if ($katList->rowCount()) {
                        foreach ($katList as $katListSatir) {
                    ?>
                            <tr>
                                <td><img src="<?php echo $katListSatir['gorsel']; ?>" style="width: 48px;"></td>
                                <td><?php echo $katListSatir['katAdi']; ?></td>
                                <td><?php echo $katListSatir['katTuru']; ?></td>
                                <td><?php echo $katListSatir['ustKat']; ?></td>
                                <td><?php echo substr($katListSatir['aciklama'], 0, 99); ?> ...</td>
                                <td><?php echo $katListSatir['katDili'] ?></td>
                                <td class="text-center">
                                    <a href="kategoriler.php?updateID=<?php echo $katListSatir['id']; ?>" class="btn btn-warning">Düzenle</a>
                                    <a href="kategoriler.php?deleteID=<?php echo $katListSatir['id']; ?>" class="btn btn-danger">Sil</a>
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
    <!-- Category List Section End -->

    <!-- Category Update Modal Start -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sayfa Yüklendiğinde Gösterilen Modal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" class="form text-start" enctype="multipart/form-data">
                        <input type="text" name="upkatAdi" value="<?php echo $upCatSatir['katAdi']; ?>" class="form-control mb-2">
                        <label for="upkatTuru"><small>Kategori Türü</small></label>
                        <select name="upkatTuru" id="upkatTuru" class="form-control mb-2">
                            <option value="<?php echo $upCatSatir['katTuru']; ?>"><?php echo $upCatSatir['katTuru']; ?></option>
                            <option value="Alt Kategori">Alt Kategori</option>
                            <option value="Üst Kategori">Üst Kategori</option>
                        </select>
                        <label for="upustKat"><small>Üst Kategori</small></label>
                        <select name="upustKat" id="upustKat" class="form-control mb-2">
                            <option value="<?php echo $upCatSatir['ustKat']; ?>"><?php echo $upCatSatir['ustKat']; ?></option>
                            <?php

                            $ustKatList = $db->prepare('select DISTINCT katAdi from kategoriler order by katAdi asc');
                            $ustKatList->execute();

                            if ($ustKatList->rowCount()) {
                                foreach ($ustKatList as $ustKatListSatir) {
                            ?>
                                    <option value="<?php echo $ustKatListSatir['katAdi']; ?>"><?php echo $ustKatListSatir['katAdi']; ?></option>
                            <?php
                                }
                            }

                            ?>
                        </select>
                        <textarea name="upaciklama" class="form-control mb-2" rows="5"><?php echo $upCatSatir['aciklama']; ?></textarea>
                        <label for="gorsel"><small>Kategori Görseli</small></label>
                        <input type="file" name="upgorsel" id="upgorsel" class="form-control mb-2">
                        <label>Kategori Dili</label><br>
                        <input type="radio" name="upkatDili" value="Türkçe"> <small>Türkçe</small>
                        <input type="radio" name="upkatDili" value="İngilizce"> <small>İngilizce</small>
                        <input type="hidden" name="upID" value="<?php echo $upCatSatir['id']; ?>">
                        <input type="submit" value="Kaydet" class="btn btn-success w-100 mt-4" name="katUpdate">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Category Update Modal End -->

    <!-- Category Update Module Start -->
    <?php
    if (isset($_POST['katUpdate'])) {
        $upgorsel = '../assets/img/' . $_FILES['upgorsel']['name'];

        if (move_uploaded_file($_FILES['upgorsel']['tmp_name'], $upgorsel)) {
            $updateCat = $db->prepare('update kategoriler set katAdi=?, katTuru=?, ustKat=?, aciklama=?, gorsel=?, katDili=? where id=?');
            $updateCat->execute(array($_POST['upkatAdi'], $_POST['upkatTuru'], $_POST['upustKat'], $_POST['upaciklama'], $upgorsel, $_POST['upkatDili'], $_POST['upID']));

            if ($updateCat->rowCount()) {
                echo '<script>alert("Kategori Güncellendi")</script><meta http-equiv="refresh" content="0; url=kategoriler.php">';
            } else {
                echo '<script>alert("Hata Oluştu")</script><meta http-equiv="refresh" content="0; url=kategoriler.php">';
            }
        } else {
            $updateCat = $db->prepare('update kategoriler set katAdi=?, katTuru=?, ustKat=?, aciklama=?, katDili=? where id=?');
            $updateCat->execute(array($_POST['upkatAdi'], $_POST['upkatTuru'], $_POST['upustKat'], $_POST['upaciklama'], $_POST['upkatDili'], $_POST['upID']));

            if ($updateCat->rowCount()) {
                echo '<script>alert("Kategori Güncellendi")</script><meta http-equiv="refresh" content="0; url=kategoriler.php">';
            } else {
                echo '<script>alert("Hata Oluştu")</script><meta http-equiv="refresh" content="0; url=kategoriler.php">';
            }
        }
    }
    ?>
    <!-- Category Update Module End -->


</div>

<?php require_once('footer.php'); ?>