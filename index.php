<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sylabus PHP</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link href="composer_vendor/twbs/bootstrap/dist/css/bootstrap.cosmo.min.css" rel="stylesheet">
</head>

<body>
    <h1 class="mb-3 text-center">Strona główna</h1>
    <main class="d-flex align-items-center justify-content-center">
        <form id="form" action="" method="POST" enctype="multipart/form-data" class="row row-cols-lg-auto g-3 align-items-center">
            <div class="form-group m-3">
                <input type="file" class="form-control" name="file" id="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel, .xml">
            </div>
            <div class="form-group m-3">
                <button type="submit" form="form" class="btn btn-primary" name="submit" value="upload">Wyślij plik</button>
            </div>
            <div class="form-group m-3">
                <button type="submit" form="form" class="btn btn-secondary" name="submit" value="local">Próbny plik lokalny</button>
            </div>
        </form>
    </main>
    <div class="d-flex align-items-center justify-content-center "><a class="btn btn-warning w-75 mb-2" style="min-width:100px; max-width:640px;" href="www/sylabus_clean.php">Czysty plik</a></div>
    <?php
    require 'composer_vendor/autoload.php';
    require 'www/class/spreadsheet_line.php';
    if(isset($_POST['submit'])){
        require 'www/class/file_handle.php';
    }
    
    ?>
</body>

</html>