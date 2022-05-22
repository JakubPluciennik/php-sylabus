<?php
require_once('../../composer_vendor/autoload.php');

use HeadlessChromium\BrowserFactory;

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
        <style>
    EOD;
    $style = file_get_contents("../sylabus.css") . '</style> </head> <body>';
    $main = $_POST["html"];
    $footer = '</body></html>';

    $page_content = $header . $style . $main . $footer;

    $browserFactory = new BrowserFactory();
    // starts headless chrome
    $browser = $browserFactory->createBrowser();

    try {
        // creates a new page and navigate to an URL
        $page = $browser->createPage();
        $page->setHtml($page_content);
        // pdf
        $page->pdf()->saveToFile('sylabus.pdf');
        //download pdf file
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="sylabus.pdf"');
        readfile('sylabus.pdf');
        unlink('sylabus.pdf');
    } finally {
        // bye
        $browser->close();
    }
}
