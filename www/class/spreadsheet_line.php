<?php
class Spreadsheet_line{
   public $semester;
   public $kod;
   public $nazwa;
   public $status_zajec1;
    public $status_zajec2;
    public $liczba_godzin;
    public $ects;

    //konstruktor klasy
    public function __construct($semester, $kod, $nazwa, $status_zajec1, $status_zajec2, $liczba_godzin, $ects) {
        $this->semester = $semester;
        $this->kod = $kod;
        $this->nazwa = $nazwa;
        $this->status_zajec1 = $status_zajec1;
        $this->status_zajec2 = $status_zajec2;
        $this->liczba_godzin = $liczba_godzin;
        $this->ects = $ects;
    }
}
