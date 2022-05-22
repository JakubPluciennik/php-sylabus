<?php
require_once('../../composer_vendor/autoload.php');
use Mpdf\Mpdf;

if (isset($_POST["submit"])) {

    $header = <<<EOD
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Sylabus</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../sylabus.css">
        <style>
    EOD;
    $style = <<<EOD
    @page{
        size: 'A4';
        margin: 0;
    }
    *{
        font-size:9px;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
    html{
        width: 210mm;
    }
    body {
        margin-left:10mm;
        margin-top:10mm;
        width: 195mm;
        min-width: 0mm;
        font-family: DejaVu Sans, sans-serif;
    }
    #year{
        min-width:50px;
    }
    .font-size-12 {
        font-size: 12px;
    }
    .font-size-11 {
        font-size: 10px;
    }
    .bold {
        font-weight: bold;
    }
    .hide {
        display: none !important;
    }
    </style>
    </head>
    <body>
    EOD;
    $main = $_POST["html"];
    $footer = '</body></html>';
    $page_content = $header . $style . $main . $footer;
    ob_flush();
    $mpdf = new Mpdf();
    $mpdf->WriteHTML($page_content);
    $mpdf->Output('sylabus.pdf', 'D');
}
