<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Formularz extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this -> load -> model('sprawy');
        $this -> load -> model('wplaty');
        $this -> load -> model('wierzyciele');
    }

    function wk1() {
        $data['content'] = $this -> load -> view('formularz/wk1', null, true);
        $this -> load -> view('formularz/layoutZewnetrzny', $data);
    }

    function wk2() {
        $data['content'] = $this -> load -> view('formularz/wk2', null, true);
        $this -> load -> view('formularz/layoutZewnetrzny', $data);
    }

    function wk3() {
        $data['content'] = $this -> load -> view('formularz/wk3', null, true);
        $this -> load -> view('formularz/layoutZewnetrzny', $data);
    }

    function dk3() {
        $data['content'] = $this -> load -> view('formularz/dk3', null, true);
        $this -> load -> view('formularz/layoutWewnetrzny', $data);
    }

    function zawiad1() {
        $data['content'] = $this -> load -> view('formularz/zawiad1', null, true);
        $this -> load -> view('formularz/layoutWewnetrzny', $data);
    }

    function zawiad2() {
        $data['content'] = $this -> load -> view('formularz/zawiad2', null, true);
        $this -> load -> view('formularz/layoutWewnetrzny', $data);
    }

    function zajecie() {
        $data['content'] = $this -> load -> view('formularz/zajecie', null, true);
        $this -> load -> view('formularz/layoutZewnetrzny', $data);
    }

    function planPodzialu($id_wplaty) {
        if ($id_wplaty) {
            $wplata = $this -> wplaty -> getPlanPodzialu($id_wplaty);
            if ($wplata) {
                $this->wplaty->policzUdzial($wplata['wplaty_wierzycieli']);
                $data['wplata'] = $wplata;
                $data['content'] = $this -> load -> view('formularz/planPodzialu', $data, true);
                $this -> load -> view('formularz/layoutWewnetrzny', $data);
            } else {
                echo('W bazie nie ma takiej wplaty!!!');
            }
        } else {
            echo('Musisz wybrać wplate!!!');
        }
    }

    function kartaWierzyciela($id_wierzyciele_sprawy) {
        if ($id_wierzyciele_sprawy) {
            $wierzyciel = $this -> wierzyciele -> getWierzycielWSprawie($id_wierzyciele_sprawy);
            if ($wierzyciel) {
                $data['wierzyciel'] = $wierzyciel;
                $data['content'] = $this -> load -> view('formularz/kartaWierzyciela', $data, true);
                $this -> load -> view('formularz/layoutWewnetrzny', $data);
            } else {
                echo('W bazie nie ma takiego wierzyciela w sprawie!!!');
            }
        } else {
            echo('Musisz wybrać wierzyciela w sprawie!!!');
        }
    }

    function generuj($nazwaFormularza, $pozioma = false, $id = 0) {
        include ("MPDF57/mpdf.php");
        $mpdf = new mPDF('utf-8', 'A4');
        // $mpdf -> SetDisplayMode('fullpage');
        // $mpdf -> list_indent_first_level = 0;
        $orientacja = $pozioma ? 'L' : 'P';
        $mpdf -> AddPage($orientacja, '', '', '', '', 10, 10, 10, 10);
        $url = 'formularz/' . $nazwaFormularza . '/' . ($id ? $id : '');
        $text = file_get_contents(url($url));
        $mpdf -> WriteHTML($text);
        $mpdf -> Output();
    }

}
?>