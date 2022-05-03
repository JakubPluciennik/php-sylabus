<link href="..\composer_vendor\twbs\bootstrap\dist\css\bootstrap.cosmo.min.css" rel="stylesheet">
<?php

$type =  $_POST['submit'] ?? '';
if($type == ''){
    header('Location: index.php');
}
?>

<?php
//delete files older than 1 day
$dir = '../files/';
$files = scandir($dir);
foreach ($files as $file) {
    if (is_file($dir . '/' . $file)) {
        if ($file != 'Informatyka-plan-studiow-2019_20-1.xlsx') {   //plik lokalny - nie usuwamy
            if (filemtime($dir . '/' . $file) < time() - (60 * 60 * 24)) {
                unlink($dir . '/' . $file);
            }
        }
    }
}
if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('xlsx', 'xls', 'xlsm');
    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                $fileDestination = '../files/' . $fileNameNew;
                if (move_uploaded_file($fileTmpName, $fileDestination)) {
                    echo '<div class="alert alert-success">Plik został wysłany</div>';
                } else {
                    echo '<div class="alert alert-danger">Wystąpił błąd podczas wysyłania pliku</div>';
                }
            } else {
                echo '<div class="alert alert-danger">Plik jest za duży.</div>';
            }
        } else {
            echo '<div class="alert alert-danger">Wystąpił błąd podczas wysyłania pliku.</div>';
        }
    } else {
        echo '<div class="alert alert-danger">Nieprawidłowy format pliku.</div>';
    }
}
?>