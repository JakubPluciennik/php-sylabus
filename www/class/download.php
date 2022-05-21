<?php
require_once '../../composer_vendor/autoload.php';

use HeadlessChromium\BrowserFactory;

if (isset($_POST["submit"])) {
    $first_part = <<<EOD
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
            <style>
    EOD;
    $css = file_get_contents('../sylabus.css');

    $css = $css . '*{
        font-size:10px;
    }
    html{
        width: 210mm;
    }
    body {
        padding-left:10mm;
        width: 210mm;
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
        font-size: 11px;
    }
    .bold {
        font-weight: bold;
    }
    .value-cell{
        width:1mm;
        text-align:center;
    }
    #pt3 .left-column{
        width:-1mm !important;
    }';
    $second_part = '</style></head><body>';
    $end_part = '</body></html>';
    $main_body = $_POST["main_body"];
    $page_content =  $first_part . $css . $second_part . $main_body . $end_part;


    $browserFactory = new BrowserFactory();

    // starts headless chrome
    $browser = $browserFactory->createBrowser();

    try {
        // creates a new page and navigate to an URL
        $page = $browser->createPage();
        $page->setHTML($page_content);
        $filename = 'sylabus.pdf';
        // pdf
        $page->pdf(['printBackground' => true])->saveToFile($filename);
        clearstatcache();
        if (file_exists($filename)) {

            //Define header information
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header('Content-Length: ' . filesize($filename));
            header('Pragma: public');

            //Clear system output buffer
            flush();

            //Read the size of the file
            readfile($filename, true);

            //Terminate from the script
            die();
        }
    } finally {
        // bye
        $browser->close();
    }
} else {
    Header("Location: ../../index.php");
}
