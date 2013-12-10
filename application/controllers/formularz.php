<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Formularz extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> model('sprawy');
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
	
	function dk7() {
		$data['content'] = $this -> load -> view('formularz/dk7', null, true);
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

function planPodzialu() {
		$data['content'] = $this -> load -> view('formularz/planPodzialu', null, true);
		$this -> load -> view('formularz/layoutWewnetrzny', $data);
	}
		
function kartaWierzyciela() {
		$data['content'] = $this -> load -> view('formularz/kartaWierzyciela', null, true);
		$this -> load -> view('formularz/layoutWewnetrzny', $data);
	}		
	function generuj($nazwaFormularza, $pozioma = false) {
		include ("MPDF57/mpdf.php");
		$mpdf = new mPDF('utf-8', 'A4');
		// $mpdf -> SetDisplayMode('fullpage');
		// $mpdf -> list_indent_first_level = 0;
		$orientacja = $pozioma ? 'L' : 'P';
		$mpdf->AddPage($orientacja, '', '', '', '', 10, 10, 10, 10);
		$text = file_get_contents(url('formularz/'.$nazwaFormularza));
		$mpdf -> WriteHTML($text);
		$mpdf -> Output();
	}


}
?>