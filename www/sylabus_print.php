<?php
if (!isset($_POST['submit'])) {
    header('Location: sylabus_form.php');
}
?>

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
    <link rel="stylesheet" href="sylabus.css">
    <script src="../composer_vendor/components/jquery/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#print_form").submit(function() {
                var main = $("#printable").html();
                // add value from main to hidden input
                $("#html").val(main);
                // submit form
            });
        });
    </script>
</head>
<body>
    <div id="printable">
        <main>
            <div id="pt1" class="table-div">
                <table>
                    <tr>
                        <td class="left-column font-size-xl">Nazwa zajęć/
                            Course title: </td>
                        <td class="font-size-xl"><?php echo isset($_POST["course-title"]) ? $_POST["course-title"] : ''; ?></td>
                        <td class="ects font-size-xl">ECTS</td>
                        <td id="ects-value" class="ects font-size-xl"><?php echo $_POST["ects-val"] ?? ''; ?></td>
                    </tr>
                    <tr>
                        <td class="left-column">Nazwa zajęć w j. angielskim/
                            Course title in English: </td>
                        <td colspan="3"><?php echo $_POST["course-title-eng"] ?? ''; ?></td>
                    </tr>
                    <tr>
                        <td class="left-column">Zajęcia dla kierunku studiów/
                            Degree program name: </td>
                        <td colspan="3"><?php echo $_POST["degree"] ?? ''; ?></td>
                    </tr>
                </table>
            </div>
            <div id="pt2" class="table-div">
                <table>
                    <tr>
                        <td class="border-nr left-column" colspan="2">Język kursu/
                            Course language:</td>
                        <td class="border-nl" colspan="3"><?php echo $_POST["course-lang"] ?? ''; ?></td>
                        <td class="border-nr" colspan="2">Poziom studiów/
                            Study level:</td>
                        <td class="border-nl"><?php echo $_POST["study-lvl"] ?? ''; ?></td>
                    </tr>
                    <tr>
                        <td class="border-nr" rowspan="2">Typ studiów/<br>
                            Form of studies: </td>
                        <td class="st-form"><?php echo (isset($_POST["studies-form"]) && $_POST["studies-form"] == "stacjonarne") ? '&#9724;' : '&#9723;'; ?> stacjonarne</td>
                        <td class="border-nr" rowspan="2">Status zajęć/
                            Course status</td>
                        <td><?php echo (isset($_POST["course-status1"]) && $_POST["course-status1"] == "basic") ? '&#9724;' : '&#9723;'; ?> podstawowe/
                            basic</td>
                        <td><?php echo (isset($_POST["course-status2"]) && $_POST["course-status2"] == "mandatory") ? '&#9724;' : '&#9723;'; ?> obowiązkowe/
                            mandatory</td>
                        <td class="border-nr" colspan="2" rowspan="2">Semestr/
                            Semester: <?php echo isset($_POST["semester-value"]) ? $_POST["semester-value"] : ''; ?></td>
                        <td><?php echo (isset($_POST["semester"]) && $_POST["semester"] == "winter") ? '&#9724;' : '&#9723;'; ?> semestr zimowy/
                            winter semester</td>
                    </tr>
                    <tr>
                        <td class="st-form"><?php echo (isset($_POST["studies-form"]) && $_POST["studies-form"] == "niestacjonarne") ? '&#9724;' : '&#9723;'; ?> niestacjonarne</td>
                        <td><?php echo (isset($_POST["course-status1"]) && $_POST["course-status1"] == "major") ? '&#9724;' : '&#9723;'; ?> kierunkowe/
                            major</td>
                        <td><?php echo (isset($_POST["course-status2"]) && $_POST["course-status2"] == "elective") ? '&#9724;' : '&#9723;'; ?> do wyboru/
                            elective</td>
                        <td><?php echo (isset($_POST["semester"]) && $_POST["semester"] == "summer") ? '&#9724;' : '&#9723;'; ?> semestr letni/
                            summer semester</td>
                    </tr>
                    <tr>
                        <td class="border-a" colspan="5" class="align-right">Rok akademicki/
                            Academic year:</td>
                        <td class="border-ac" id="year"><?php echo $_POST["a-year"] ?? ''; ?></td>
                        <td class="border-a" class="align-right">Numer katalogowy/
                            Catalogue number:</td>
                        <td class="border-ac"><?php echo $_POST["catalogue-num"] ?? ''; ?></td>
                    </tr>
                </table>
            </div>
            <div id="pt3" class="table-div">
                <table>
                    <tr>
                        <td colspan="2" class="left-column">Koordynator zajęć/
                            Course coordinator:</td>
                        <td colspan="3"><?php echo $_POST["coordinator"] ?? ''; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="left-column">Prowadzący zajęcia/
                            Teachers responsible for the course:</td>
                        <td colspan="3"><?php echo $_POST["responsible-teachers"] ?? ''; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="left-column">Założenia, cele i opis zajęć/
                            Aims, objectives and description of the course:</td>
                        <td colspan="3"><?php echo $_POST["aims"] ?? ''; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="left-column">Formy dydaktyczne, liczba godzin/
                            Teaching forms, number of hours:</td>
                        <td colspan="3"><?php echo $_POST["teaching-forms"] ?? ''; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="left-column">Metody dydaktyczne/
                            Teaching methods:</td>
                        <td colspan="3"><?php echo $_POST["teaching-methods"] ?? ''; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="left-column">Wymagania formalne i założenia wstępne/
                            Formal requirements and prerequisites</td>
                        <td colspan="3"><?php echo $_POST["formal-requirements"] ?? ''; ?></td>
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
                    <div class="avoid-break">
                        <tr>
                            <?php
                            $w_row = $_POST["W"];
                            $w_count =  count($w_row);
                            $w_content = $w_row[0]['content'] ?: '';
                            $w_relation = $w_row[0]['relation'] ?: '';
                            $w_impact = ($w_row[0]['content'] != '' || $w_row[0]['relation'] != '') ? $w_row[0]['impact'] : '';
                            $row = <<<ROW1
                        <td rowspan="$w_count" id="knowledge" class="left-column-outcomes">Wiedza (absolwent zna i rozumie)/
                        Knowledge: (the graduate knows and understands)</td>
                    <td class="value-cell">W1</td>
                    <td>$w_content</td>
                    <td class="right-columns">$w_relation</td>
                    <td class="right-columns">
                        $w_impact
                    </td>
                    ROW1;
                            echo $row;
                            ?>
                        </tr>
                        <?php
                        for ($i = 1; $i < $w_count; $i++) {
                            $w_content = $w_row[$i]['content'] ?: '';
                            $w_relation = $w_row[$i]['relation'] ?: '';
                            $w_impact = ($w_row[$i]['content'] != '' || $w_row[$i]['relation'] != '') ? $w_row[$i]['impact'] : '';
                            $w_val = $i + 1;
                            $row = <<<ROW
                            <tr>
                            <td class="value-cell">W$w_val</td>
                            <td>$w_content</td>
                            <td class="right-columns">$w_relation</td>
                            <td class="right-columns">
                                $w_impact
                            </td>
                            </tr>
                            ROW;
                            echo $row;
                        }
                        ?>
                    </div>
                    <div class="avoid-break">
                        <tr>
                            <?php
                            $u_row = $_POST["U"];
                            $u_count =  count($u_row);
                            $u_content = $u_row[0]['content'] ?: '';
                            $u_relation = $u_row[0]['relation'] ?: '';
                            $u_impact = ($u_row[0]['content'] != '' || $u_row[0]['relation'] != '') ? $u_row[0]['impact'] : '';
                            $row = <<<ROW1
                        <td rowspan="$u_count" id="skills"  class="left-column-outcomes">Umiejętności (absolwent potrafi)/
                        Skills: (the graduate is able to)</td>
                    <td class="value-cell">U1</td>
                    <td>$u_content</td>
                    <td class="right-columns">$u_relation</td>
                    <td class="right-columns">
                        $u_impact
                    </td>
                    ROW1;
                            echo $row;
                            ?>
                        </tr>
                        <?php
                        for ($i = 1; $i < $u_count; $i++) {
                            $u_content = $u_row[$i]['content'] ?: '';
                            $u_relation = $u_row[$i]['relation'] ?: '';
                            $u_impact = ($u_row[$i]['content'] != '' || $u_row[$i]['relation'] != '') ? $u_row[$i]['impact'] : '';
                            $u_val = $i + 1;
                            $row = <<<ROW
                        <tr>
                        <td class="value-cell">U$u_val</td>
                        <td>$u_content</td>
                        <td class="right-columns">$u_relation</td>
                        <td class="right-columns">
                            $u_impact
                        </td>
                        </tr>
                        ROW;
                            echo $row;
                        }
                        ?>
                    </div>
                    <div class="avoid-break">
                        <tr>
                            <?php
                            $k_row = $_POST["K"];
                            $k_count =  count($k_row);
                            $k_content = $k_row[0]['content'] ?: '';
                            $k_relation = $k_row[0]['relation'] ?: '';
                            $k_impact = ($k_row[0]['content'] != '' || $k_row[0]['relation'] != '') ? $k_row[0]['impact'] : '';
                            $row = <<<ROW1
                            <td rowspan="$k_count" id="competences"  class="left-column-outcomes">Kompetencje (absolwent jest gotów do)/
                            Competences: (The graduate is ready to)</td>
                            <td class="value-cell">K1</td>
                            <td>$k_content</td>
                            <td class="right-columns">$k_relation</td>
                            <td class="right-columns">
                                $k_impact
                            </td>
                    ROW1;
                            echo $row;
                            ?>
                        </tr>
                        <?php
                        for ($i = 1; $i < $k_count; $i++) {
                            $k_content = $k_row[$i]['content'] ?: '';
                            $k_relation = $k_row[$i]['relation'] ?: '';
                            $k_impact = ($k_row[$i]['content'] != '' || $k_row[$i]['relation'] != '') ? $k_row[$i]['impact'] : '';
                            $k_val = $i + 1;
                            $row = <<<ROW
                            <tr>
                            <td class="value-cell">K$k_val</td>
                            <td>$k_content</td>
                            <td class="right-columns">$k_relation</td>
                            <td class="right-columns">
                                $k_impact
                            </td>
                            </tr>
                            ROW;
                            echo $row;
                        }
                        ?>
                    </div>
                    <tr>
                        <td colspan="2" class="left-column">Treści programowe zapewniające uzyskanie efektów uczenia się
                            /
                            Program content ensuring the achievement of learning outcomes</td>
                        <td colspan="3"><?php echo $_POST["program-content"] ?? ''; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="left-column">Sposób weryfikacji efektów uczenia się/
                            Methods of the verification of the learning outcomes:</td>
                        <td colspan="3"><?php echo $_POST["methods-verification"] ?? ''; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="left-column">Szczegóły dotyczące sposobów weryfikacji i form dokumentacji
                            osiąganych efektów uczenia się/
                            Details on the verification methods and of the ways of documenting the learning outcomes:
                        </td>
                        <td colspan="3"><?php echo $_POST["details"] ?? ''; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="left-column">Elementy i wagi mające wpływ na ocenę końcową/Elements and
                            weights influencing the final grade:</td>
                        <td colspan="3"><?php echo $_POST["elements-weights"] ?? ''; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="left-column">Miejsce realizacji zajęć/
                            Teaching place:</td>
                        <td colspan="3"><?php echo $_POST["teaching-place"] ?? ''; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="left-column">Literatura/
                            Literature:</td>
                        <td colspan="3"><?php echo $_POST["literature"] ?? ''; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="left-column">UWAGI/
                            ANNOTATIONS </td>
                        <td colspan="3"><?php echo $_POST["annotations"] ?? ''; ?></td>
                    </tr>
                </table>
                <p class="text-below font-size-l">*) 3 – zaawansowany i szczegółowy, 2 – znaczący, 1 – podstawowy/
                    3 – significant and detailed, 2 – considerable, 1 – basic,</p>
            </div>
            <div id="pt4" class="table-div">
                <p>Wskaźniki ilościowe charakteryzujące moduł/przedmiot/
                    Quantitative summary of the course:</p>
                <table>
                    <tr>
                        <td class="font-size-l">Szacunkowa sumaryczna liczba godzin pracy studenta (kontaktowych i pracy własnej) niezbędna
                            dla osiągnięcia zakładanych dla zajęć efektów uczenia się - na tej podstawie należy wypełnić
                            pole ECTS /
                            Estimated number of work hours per student (contact and self-study) essential to achieve the
                            presumed learning outcomes - basis for the calculation of ECTS credits:</td>
                        <td class="right font-size-xl bold" id="hours"><?php echo $_POST["hours"] ?? ''; ?> h</td>
                    </tr>
                    <tr>
                        <td class="font-size-l">Łączna liczba punktów ECTS, którą student uzyskuje na zajęciach wymagających bezpośredniego
                            udziału nauczycieli akademickich lub innych osób prowadzących zajęcia/
                            Total number of ECTS credits accumulated by the student during contact learning:</td>
                        <td class="right font-size-xl bold"><?php echo $_POST["ects-val2"] ?? ''; ?> ECTS</td>
                    </tr>
                </table>
            </div>
        </main>
    </div>
    <form id="print_form" action="class/download.php" method="post" target="_blank">
        <input type="hidden" name="html" id="html" value="">
        <input type="submit" id="print" class="button button-primary" name="submit" value="Zapisz Dokument">
    </form>
</body>

</html>