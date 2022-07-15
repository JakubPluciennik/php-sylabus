<?php
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;

    $filedir = '';
    $type =  $_POST['submit'];

    //delete files older than 1 hour
    $dir = "files\uploaded";
    $timeold = time() - (60 * 60);
    if(file_exists($dir)){
    $di = new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS);
    $ri = new RecursiveIteratorIterator($di, RecursiveIteratorIterator::CHILD_FIRST);
    foreach ( $ri as $file ) {
        if(filemtime($file) < $timeold)
        {
            $file->isDir() ?  rmdir($file) : unlink($file);
        }
    }
}


    if ($type == 'upload') {
        if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
            $file = $_FILES['file'];
            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];
            $fileType = $file['type'];
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));
            $allowed = array('xlsx', 'xls', 'xml');
            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if ($fileSize < 1000000) {
                        $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                        $fileDestination = $dir . '/' . $fileNameNew;
                        if (move_uploaded_file($fileTmpName, $fileDestination)) {
                            echo '<div class="alert alert-success">Plik został wysłany</div>';
                            $filedir = $fileDestination;
                        } else {
                            echo '<div class="alert alert-danger">Wystąpił błąd podczas wysyłania pliku. <a href="index.php" class="alert-link"> Spróbuj ponownie</a></div>';
                        }
                    } else {
                        echo '<div class="alert alert-danger">Plik jest za duży. <a href="index.php" class="alert-link"> Spróbuj ponownie</a></div>';
                    }
                } else {
                    echo '<div class="alert alert-danger">Wystąpił błąd podczas wysyłania pliku. <a href="index.php" class="alert-link"> Spróbuj ponownie</a></div>';
                }
            } else {
                echo '<div class="alert alert-danger">Nieprawidłowy format pliku. <a href="index.php" class="alert-link"> Spróbuj ponownie</a></div>';
            }
        } else {
            echo '<div class="alert alert-danger">Brak pliku. <a href="index.php" class="alert-link"> Spróbuj ponownie</a></div>';
        }
    } else if ($type == 'local') {
        echo '<div class="alert alert-success">Wybrano plik lokalny</div>';
        $filedir = 'files/' . 'Informatyka-plan-studiow-2019_20-1.xlsx';
    }
    if ($filedir != '') {
        if (file_exists($filedir)) {
            $spreadsheet = IOFactory::load($filedir);
            echo '<h1 class="text-center" >Wybierz odpowiednią opcję</h1><div class="border d-flex flex-row"> ';
            $i = 1;
            $size = $spreadsheet->getSheetCount();
            $width = 100/$size;
            foreach ($spreadsheet->getAllSheets() as $sheet) {
                $sheetName = $sheet->getTitle();
                echo "<div class=\"col\" id=\"col${i}\" style=\"width: ${width}% !important;\"> <h3 class=\"text-center\">$sheetName</h3>";
                $sheetData = $sheet->toArray();
                //Wyszukiwanie indeksu dla kolumny "ECTS"
                $ectsIndex = 31;
                foreach ($sheetData as $row) {
                    foreach ($row as $key => $value) {
                        if (strtolower($value) == 'ects') {
                            $ectsIndex = $key;
                            break 2;
                        }
                    }
                }
                foreach ($sheetData as $row) {
                    $semestr = htmlspecialchars($row[1]);
                    $kod = htmlspecialchars($row[2]);
                    $nazwa = htmlspecialchars($row[3]);
                    $status_zajec1 = htmlspecialchars($row[4]);
                    $status_zajec2 = htmlspecialchars($row[5]);
                    $liczba_godzin = htmlspecialchars($row[13]);
                    $ects = htmlspecialchars($row[$ectsIndex]);

                    if ($semestr != '' && $nazwa != '') {
                        if (strlen($kod) > 5 || $kod == null) {
                            strlen($kod) > 5 ?: $kod = 'Brak kodu';
                            $spreadsheetLine = new Spreadsheet_Line($semestr, $kod, $nazwa, $status_zajec1, $status_zajec2, $liczba_godzin, $ects);
                            $serialized = serialize($spreadsheetLine);
                            $rowhtml = <<<EOT
                            <div class="border pb-1 ">
                            <form action="www/sylabus_form.php" method="POST">
                            <div class="form-group p-2" >
                            <div class="text-truncate">${kod} - ${nazwa}</div>
                                <input type="hidden" name="serialized_data" value='${serialized}'>
                            </div>
                            <div class="form-group p-2">
                                <input type="submit" class="btn btn-success" name="submit" value="Wybierz">
                            </div>
                            </form>
                            </div>
                            EOT;
                            echo $rowhtml;
                        }
                    }
                }
                echo '</div>';
                $i++;
            }
            echo '</div>';
        }
    }