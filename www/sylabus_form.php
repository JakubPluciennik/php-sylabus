<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sylabus</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../composer_vendor/twbs/bootstrap/dist/css/bootstrap.cosmo.min.css" rel="stylesheet">
    <link rel="stylesheet" href="sylabus.css">
    <script type="text/javascript" src="../composer_vendor/tinymce/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script type="text/javascript" src="../composer_vendor/components/jquery/jquery.min.js" type="text/javascript"></script>
    <script>
        //Inicjalizacja TinyMCE
        tinymce.init({
            selector: 'textarea',
            menubar: false,
            statusbar: false,
            plugins: [
                'autoresize',
                'lists',
                'advlist',
            ],
            autoresize_bottom_margin: 0,
            toolbar: 'bold italic | alignleft aligncenter alignright alignjustify | numlist bullist  | outdent indent ',
        });

        // Dodanie wiersza dla danego typu (W,U,K)
        function addRow(obj, type, value, cell_name) {
            value++;

            //Szablon wiersza
            let row = `<tr><td>${type}${value}</td>
                        <td><textarea name="${type}[${value-1}][content]" class=""></textarea></td>
                        <td class="right-columns"><input class="input-text" name="${type}[${value-1}][relation]" type="text"></td>
                        <td class="right-columns">
                            <select class="input-list" name="${type}[${value-1}][impact]">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </td></tr>`;

            //Najbliższy wiersz przed obiektem z button
            $(obj).closest('tr').before(row);
            $("#" + cell_name).attr('rowspan', value + 1);
            $(obj).closest('button').next().removeClass('d-none');

            //aktualizacja tinymce
            tinymce.init({
                selector: 'textarea',
                menubar: false,
                statusbar: false,
                plugins: [
                    'autoresize',
                    'lists',
                    'advlist',
                ],
                autoresize_bottom_margin: 0,
                toolbar: 'bold italic | alignleft aligncenter alignright alignjustify | numlist bullist  | outdent indent ',
            });
        }

        //Usuwanie wiersza dla danego typu (W,U,K)
        function removeRow(obj, type, value, cell_name) {
            //Najbliższy wiersz przed obiektem z button
            $(obj).closest('tr').prev('tr').remove();
            $("#" + cell_name).attr('rowspan', value);

            //Jeśli nie ma już wierszy to ukryj button
            if (value == 2) {
                $(obj).addClass('d-none');
            }
        }

        let wValue = 1;
        let uValue = 1;
        let kValue = 1;

        //wywołania funkcji
        $(document).ready(function() {
            $("#add-w").click(function() {
                addRow(this, "W", wValue, "knowledge");
                wValue++;
            });

            $("#add-u").click(function() {
                addRow(this, "U", uValue, "skills");
                uValue++;
            });

            $("#add-k").click(function() {
                addRow(this, "K", kValue, "competences");
                kValue++;
            });
            $("#remove-w").click(function() {
                if (wValue > 1) {
                    removeRow(this, "W", wValue, "knowledge");
                    wValue--;
                }
            });
            $("#remove-u").click(function() {
                if (uValue > 1) {
                    removeRow(this, "U", uValue, "skills");
                    uValue--;
                }
            });
            $("#remove-k").click(function() {
                if (kValue > 1) {
                    removeRow(this, "K", kValue, "competences");
                    kValue--;
                }
            });
        });
    </script>
    <?php

    $previous = "javascript:history.go(-1)";
    if (isset($_SERVER['HTTP_REFERER'])) {
        $previous = $_SERVER['HTTP_REFERER'];
    }

    if (isset($_POST)) {
        require 'class/spreadsheet_line.php';

        if (strlen($_POST['serialized_data']) < 10) {
            echo '<script>window.location.href = " sylabus_clean.php";</script>';
        } else {
            $data = unserialize($_POST['serialized_data']);
            $semester = '';
            switch ($data->semester) {
                case 1:
                    $semester = 'I';
                    break;
                case 2:
                    $semester = 'II';
                    break;
                case 3:
                    $semester = 'III';
                    break;
                case 4:
                    $semester = 'IV';
                    break;
                case 5:
                    $semester = 'V';
                    break;
                case 6:
                    $semester = 'VI';
                    break;
                case 7:
                    $semester = 'VII';
                    break;
                case 8:
                    $semester = 'VIII';
                    break;
                case 9:
                    $semester = 'IX';
                    break;
                case 10:
                    $semester = 'X';
                    break;
                case 11:
                    $semester = 'XI';
                    break;
                case 12:
                    $semester = 'XII';
                    break;
            }
            $kod = ($data->kod == 'Brak kodu') ? '' : $data->kod;
            $nazwa = $data->nazwa;
            $status_zajec1 = $data->status_zajec1;
            $status_zajec2 = $data->status_zajec2;
            $liczba_godzin = $data->liczba_godzin;
            $ects = $data->ects;
        }
    } else {
        $kod;
        $nazwa;
        $semester = '';
        $status_zajec1;
        $status_zajec2;
        $liczba_godzin;
        $ects;
    }
    ?>
</head>

<body>
    <header>
        <div class="title">Formularz sylabusu</div>
    </header>
    <main>
        <form action="sylabus_print.php" method="post" target="_blank">
            <div id="pt1" class="table-div">
                <table>
                    <tr>
                        <td class="left-column">Nazwa zajęć/
                            Course title: </td>
                        <td><input class="input-text" type="text" name="course-title" <?php echo "value=\"$nazwa\""; ?>></td>
                        <td class="ects">ECTS</td>
                        <td id="ects-value" class="ects"><input class="input-text" type="text" name="ects-val" <?php echo isset($ects) ? "value=\"$ects\" readonly" : ''; ?>></td>
                    </tr>
                    <tr>
                        <td class="left-column">Nazwa zajęć w j. angielskim/
                            Course title in English: </td>
                        <td colspan="3"><input class="input-text" type="text" name="course-title-eng"></td>
                    </tr>
                    <tr>
                        <td class="left-column">Zajęcia dla kierunku studiów/
                            Degree program name: </td>
                        <td colspan="3"><input class="input-text" type="text" name="degree"></td>
                    </tr>
                </table>
            </div>
            <div id="pt2" class="table-div">
                <table>
                    <tr>
                        <td colspan="2" class="border-nr">Język kursu/
                            Course language:</td>
                        <td colspan="3" class="border-nl"><input class="input-text" type="text" name="course-lang"></td>
                        <td colspan="2" class="border-nr">Poziom studiów/
                            Study level:</td>
                        <td class="border-nl"><input class="input-text" type="text" name="study-lvl"></td>
                    </tr>
                    <tr>
                        <td rowspan="2">Typ studiów/
                            Form of studies: </td>
                        <td><input type="radio" name="studies-form" id="stacjonarne" value="stacjonarne"> stacjonarne/
                            intramural</td>
                        <td rowspan="2" class="border-nr">Status zajęć/
                            Course status</td>
                        <td><input type="radio" name="course-status1" id="basic" value="basic" <?php echo isset($status_zajec1) && $status_zajec1 == "P" ? 'checked' : ''; ?>>podstawowe/
                            basic</td>
                        <td><input type="radio" name="course-status2" id="mandatory" value="mandatory" <?php echo isset($status_zajec2) && $status_zajec2 == "O" ? 'checked' : ''; ?>>obowiązkowe/
                            mandatory</td>
                        <td colspan="2" rowspan="2" class="border-nr">Semestr/
                            Semester: <input type="text" name="semester-value" style="width:auto" <?php echo $semester != '' ? "value=\"$semester\"  readonly" : ''; ?>></td>
                        <td><input type="radio" name="semester" id="winter" value="winter">semestr zimowy/
                            winter semester</td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="studies-form" id="niestacjonarne" value="niestacjonarne">niestacjonarne/
                            extramural</td>
                        <td><input type="radio" name="course-status1" id="major" value="major" <?php echo isset($status_zajec1) && $status_zajec1 == "K" ? 'checked' : ''; ?>>kierunkowe/
                            major</td>
                        <td><input type="radio" name="course-status2" id="elective" value="elective" <?php echo isset($status_zajec2) && $status_zajec2 == "F" ? 'checked' : ''; ?>>do wyboru/
                            elective</td>
                        <td><input type="radio" name="semester" id="summer" value="summer">semestr letni/
                            summer semester</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="align-right border-a">Rok akademicki/
                            Academic year:</td>
                        <td id="year" class="border-ac"><input class="input-text" type="text" name="a-year"></td>
                        <td class="align-right border-a">Numer katalogowy/
                            Catalogue number:</td>
                        <td class="border-ac" id="catalogue-num"><input class="input-text" type="text" name="catalogue-num" <?php echo "value=\"$kod\" readonly"; ?>></td>
                    </tr>
                </table>
            </div>
            <div id="pt3" class="table-div">
                <table>
                    <tr>
                        <td colspan="2" class="left-column">Koordynator zajęć/
                            Course coordinator:</td>
                        <td colspan="3"><input class="input-text" type="text" name="coordinator"></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="left-column">Prowadzący zajęcia/
                            Teachers responsible for the course:</td>
                        <td colspan="3"><input class="input-text" type="text" name="responsible-teachers"></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="left-column">Założenia, cele i opis zajęć/
                            Aims, objectives and description of the course:</td>
                        <td colspan="3"><textarea name="aims"></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="left-column">Formy dydaktyczne, liczba godzin/
                            Teaching forms, number of hours:</td>
                        <td colspan="3"><textarea name="teaching-forms"></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="left-column">Metody dydaktyczne/
                            Teaching methods:</td>
                        <td colspan="3"><input class="input-text" type="text" name="teaching-methods"></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="left-column">Wymagania formalne i założenia wstępne/
                            Formal requirements and prerequisites</td>
                        <td colspan="3"><input class="input-text" type="text" name="formal-requirements"></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="left-column">Efekty uczenia się/
                            Learning outcomes:</td>
                        <td>treść efektu przypisanego do zajęć/
                            the content of the effect assigned to the course:</td>
                        <td class="right-columns">Odniesienie do efektu kierunkowego/
                            Relation to the course outcomes</td>
                        <td class="right-columns">Siła dla ef. kier*/
                            Impact on the course outcomes*</td>
                    </tr>
                    <tr>
                        <td rowspan="2" id="knowledge">Wiedza (absolwent zna i rozumie)/
                            Knowledge: (the graduate knows and understands)</td>
                        <td class="value-cell">W1</td>
                        <td><textarea name="W[0][content]" class=""></textarea></td>
                        <td class="right-columns"><input class="input-text" name="W[0][relation]" type="text"></td>
                        <td class="right-columns">
                            <select class="input-list" name="W[0][impact]">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="buttons"><button type="button" class="btn btn-primary" id="add-w">Dodaj wiersz</button>
                            <button type="button" class="btn btn-danger float-end d-none" id="remove-w">Usuń wiersz</button>
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="2" id="skills">Umiejętności (absolwent potrafi)/
                            Skills: (the graduate is able to)</td>
                        <td class="value-cell">U1</td>
                        <td><textarea name="U[0][content]" class=""></textarea></td>
                        <td class="right-columns"><input class="input-text" name="U[0][relation]" type="text"></td>
                        <td class="right-columns">
                            <select class="input-list" name="U[0][impact]">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="buttons"><button type="button" class="btn btn-primary" id="add-u">Dodaj wiersz</button>
                            <button type="button" class="btn btn-danger float-end d-none" id="remove-u">Usuń wiersz</button>
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="2" id="competences">Kompetencje (absolwent jest gotów do)/
                            Competences: (The graduate is ready to)</td>
                        <td class="value-cell">K1</td>
                        <td><textarea name="K[0][content]" class=""></textarea></td>
                        <td class="right-columns"><input class="input-text" name="K[0][relation]" type="text"></td>
                        <td class="right-columns"><select class="input-list" name="K[0][impact]">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="buttons"><button type="button" class="btn btn-primary" id="add-k">Dodaj wiersz</button>
                            <button type="button" class="btn btn-danger float-end d-none" id="remove-k">Usuń wiersz</button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="left-column">Treści programowe zapewniające uzyskanie efektów uczenia się
                            /
                            Program content ensuring the achievement of learning outcomes</td>
                        <td colspan="3"><textarea name="program-content"></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="left-column">Sposób weryfikacji efektów uczenia się/
                            Methods of the verification of the learning outcomes:</td>
                        <td colspan="3"><textarea name="methods-verification"></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="left-column">Szczegóły dotyczące sposobów weryfikacji i form dokumentacji
                            osiąganych efektów uczenia się/
                            Details on the verification methods and of the ways of documenting the learning outcomes:
                        </td>
                        <td colspan="3"><textarea name="details"></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="left-column">Elementy i wagi mające wpływ na ocenę końcową/Elements and
                            weights influencing the final grade:</td>
                        <td colspan="3"><textarea name="elements-weights"></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="left-column">Miejsce realizacji zajęć/
                            Teaching place:</td>
                        <td colspan="3"><input class="input-text" type="text" name="teaching-place"></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="left-column">Literatura/
                            Literature:</td>
                        <td colspan="3"><textarea name="literature"></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="left-column">UWAGI/
                            ANNOTATIONS </td>
                        <td colspan="3"><input type="text" name="annotations"></td>
                    </tr>
                </table>
                <p class="text-below">*) 3 – zaawansowany i szczegółowy, 2 – znaczący, 1 – podstawowy/
                    3 – significant and detailed, 2 – considerable, 1 – basic,</p>
            </div>
            <div id="pt4" class="table-div">
                <p>Wskaźniki ilościowe charakteryzujące moduł/przedmiot/
                    Quantitative summary of the course:</p>
                <table>
                    <tr>
                        <td>Szacunkowa sumaryczna liczba godzin pracy studenta (kontaktowych i pracy własnej) niezbędna
                            dla osiągnięcia zakładanych dla zajęć efektów uczenia się - na tej podstawie należy wypełnić
                            pole ECTS /
                            Estimated number of work hours per student (contact and self-study) essential to achieve the
                            presumed learning outcomes - basis for the calculation of ECTS credits:</td>
                        <td id="hours"><input type="number" name="hours" <?php echo isset($liczba_godzin) ? "value=\"$liczba_godzin\"" : ''; ?>> h</td>
                    </tr>
                    <tr>
                        <td>Łączna liczba punktów ECTS, którą student uzyskuje na zajęciach wymagających bezpośredniego
                            udziału nauczycieli akademickich lub innych osób prowadzących zajęcia/
                            Total number of ECTS credits accumulated by the student during contact learning:</td>
                        <td><input type="text" name="ects-val2" <?php echo isset($ects) ? "value=\"$ects\"" : ''; ?>> ECTS</td>
                    </tr>
                </table>
            </div>
            <div id="submit">
                <input type="submit" name="submit" class="btn btn-success" value="Zatwierdź zmiany">
                <input class="btn btn-danger" type="reset">
            </div>
            <div id="back">
                <INPUT type="button" class="btn btn-primary" value="Powrót" onClick="history.go(-1);">
            </div>
        </form>
    </main>
</body>

</html>