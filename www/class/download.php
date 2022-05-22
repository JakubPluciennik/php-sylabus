<?php
require_once('../../composer_vendor/autoload.php');

use Mpdf\Mpdf;

if (isset($_POST["submit"])) {

    $page_css = file_get_contents('page.css');
    $main = $_POST["html"];
    $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
    $mpdf->keep_table_proportions = true;
    $mpdf->shrink_tables_to_fit = 1;
    $mpdf->WriteHTML($page_css, 1, true, false);
    $mpdf->WriteHTML($main, 2, false, true);
    // var_dump($main);
    // var_dump($style);
    $mpdf->Output('sylabus.pdf', 'D');
}
