<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sylabus PHP</title>
    <link href="..\composer_vendor\twbs\bootstrap\dist\css\bootstrap.cosmo.min.css" rel="stylesheet">
</head>

<body>
    <form id="form" action="sylabus_tmp.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="file">Wybierz plik:</label>
            <input type="file" class="form-control-file" name="file" id="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel, .xlsm">
        </div>
        <button type="submit" form="form" class="btn btn-primary" name="submit" value="upload">Wyślij plik</button>
    </form>
    <div class="form-group">
        <button type="submit" form="form" class="btn btn-secondary" name="submit" value="local">Próbny plik lokalny</button>
    </div>
</body>

</html>