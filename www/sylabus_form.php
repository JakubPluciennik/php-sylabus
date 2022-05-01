<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sylabus</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="sylabus.css">
    <script src="..\composer_vendor\tinymce\tinymce\tinymce.min.js" referrerpolicy="origin"></script>
    <script type="text/javascript" src="..\composer_vendor\tinymce\tinymce\jquery.tinymce.min.js"></script>
    <script src="..\composer_vendor\components\jquery\jquery.min.js" type="text/javascript"></script>   
    <script>

        //Inicjalizacja TinyMCE
        tinymce.init({
            selector: 'textarea',
            menubar: false,
            statusbar: false,
            mode: 'textareas',
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
                mode: 'textareas',
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
</head>

<body>
    <header>
        <div class="title">Formularz sylabusu</div>
    </header>
    <main>
        <form action="sylabus_print.php" method="post">
            <div id="pt1" class="table-div">
                <table>
                    <tr>
                        <td class="left-column">Nazwa zajęć/
                            Course title: </td>
                        <td><input class="input-text" type="text" name="course-title"></td>
                        <td class="ects">ECTS</td>
                        <td id="ects-value" class="ects"><input class="input-text" type="text" name="ects-val"></td>
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
                        <td colspan="2">Język kursu/
                            Course language:</td>
                        <td colspan="3"><input class="input-text" type="text" name="course-lang"></td>
                        <td colspan="2">Poziom studiów/
                            Study level:</td>
                        <td><input class="input-text" type="text" name="study-lvl"></td>
                    </tr>
                    <tr>
                        <td rowspan="2">Typ studiów/
                            Form of studies: </td>
                        <td><input type="radio" name="studies-form" id="stacjonarne" value="stacjonarne"> stacjonarne/
                            intramural</td>
                        <td rowspan="2">Status zajęć/
                            Course status</td>
                        <td><input type="radio" name="course-status1" id="basic" value="basic">podstawowe/
                            basic</td>
                        <td><input type="radio" name="course-status2" id="mandatory" value="mandatory">obowiązkowe/
                            mandatory</td>
                        <td colspan="2" rowspan="2">Semestr/
                            Semester: <input type="text" name="semester-value" style="width:auto"></td>
                        <td><input type="radio" name="semester" id="winter" value="winter">semestr zimowy/
                            winter semester</td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="studies-form" id="niestacjonarne" value="niestacjonarne">niestacjonarne/
                            extramural</td>
                        <td><input type="radio" name="course-status1" id="major" value="major">kierunkowe/
                            major</td>
                        <td><input type="radio" name="course-status2" id="elective" value="elective">do wyboru/
                            elective</td>
                        <td><input type="radio" name="semester" id="summer" value="summer">semestr letni/
                            summer semester</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="align-right">Rok akademicki/
                            Academic year:</td>
                        <td id="year"><input class="input-text" type="text" name="a-year"></td>
                        <td class="align-right">Numer katalogowy/
                            Catalogue number:</td>
                        <td><input class="input-text" type="text" name="catalogue-num"></td>
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
                        <td>W1</td>
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
                        <td>U1</td>
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
                        <td>K1</td>
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
                        <td id="hours"><input type="number" name="hours"> h</td>
                    </tr>
                    <tr>
                        <td>Łączna liczba punktów ECTS, którą student uzyskuje na zajęciach wymagających bezpośredniego
                            udziału nauczycieli akademickich lub innych osób prowadzących zajęcia/
                            Total number of ECTS credits accumulated by the student during contact learning:</td>
                        <td><input type="text" name="ects-val2"> ECTS</td>
                    </tr>
                </table>
            </div>
            <div id="submit"><input type="submit" class="btn btn-success" value="Zatwierdź zmiany"><input class="btn btn-danger" type="reset"></div>
        </form>
    </main>
</body>

</html>