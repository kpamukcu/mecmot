<!-- Session Control Start -->
<?php
    if (!isset($_SESSION['user'])) {
        die('
        <div class="container">
        <div class="row" style="height:50vh;">
            <div class="col-5 m-auto text-center">
                <div class="alert alert-danger">Giriş Yetkiniz Yoktur</div>
            </div>
        </div>
        </div>
    ');
    }
    ?>
<!-- Session Control End -->