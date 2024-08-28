<?php require_once('header.php'); ?>

<!-- Ürünler Add Section Start -->
<div class="row">
    <div class="col-md-6">
        <h4>Ürünler</h4>
    </div>
    <div class="col-md-6 text-end">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Ürün Ekle
        </button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Ürün Ekleme</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data" class="row gap-2 p-2" id="urunler">
                            <input type="text" name="urunAdi" placeholder="Ürün Adını Girin" class="form-control">
                            <textarea name="content" id="editor1" placeholder="Teknik Özellikler"></textarea>
                            <script>
                                ClassicEditor
                                    .create(document.querySelector('#editor1'))
                                    .then(editor => {
                                        editor.ui.view.editable.element.style.height = '200px';
                                    })
                                    .catch(error => {
                                        console.error(error);
                                    });
                            </script>
                            <textarea name="content" id="editor2" placeholder="Teknik Özellikler"></textarea>
                            <script>
                                ClassicEditor
                                    .create(document.querySelector('#editor2'))
                                    .catch(error => {
                                        console.error(error);
                                    });
                            </script>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Ürünler Add Section End -->

<?php require_once('footer.php'); ?>