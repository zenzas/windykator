<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Zadluzenie extends MY_Controller {
	protected $fields = array(/*'dluznik','wierzyciel',*/'data','kwota_zadluzenia','odsetki','koszty_egzekucyjne');

	function __construct() {
		parent::__construct();
		$this -> load -> model('zadluzenia');
		$this -> load -> model('sprawy');
		$this -> load -> model('wplaty');
	}

	function zarzadzanie() {
		$where = array();
		if ($this -> input -> post('szukaj')) {
			$fraza = $this -> input -> post('szukany');
			$kryterium = $this -> input -> post('kryterium');
			if (!$this -> form_validation -> run('wyszukiwanie')) {
				$this -> session -> set_flashdata('error', 'Musisz podać fraze i kryterium!!!');
				redirect('zadluzenie/zarzadzanie');
			} else {
				$where[$kryterium] = $fraza;
			}
		}

		$data['zadluzenia'] = $this -> zadluzenia -> lista($where);
		$data['content'] = $this -> load -> view('zadluzenie/zarzadzanie', $data, true);
		$this -> load -> view('index', $data);
	}

	function dodaj() {
		$typ_usera = $this -> session -> userdata('nazwa_typ');
		
		$data['zadluzenie']['dluznik'] = $this -> input -> post('dluznik') ? $this -> input -> post('dluznik') : '';
		$data['zadluzenie']['wierzyciel'] = $this -> input -> post('wierzyciel') ? $this -> input -> post('wierzyciel') : '';
		/* 
		$data['zadluzenie']['data'] = $this -> input -> post('data') ? $this -> input -> post('data') : '';
		$data['zadluzenie']['kwota_zadluzenia'] = $this -> input -> post('kwota_zadluzenia') ? przygotujKwote($this -> input -> post('kwota_zadluzenia')) : '';
		$data['zadluzenie']['odsetki'] = $this -> input -> post('odsetki') ? przygotujKwote($this -> input -> post('odsetki')) : '';
		$data['zadluzenie']['koszty_egzekucyjne'] = $this -> input -> post('koszty_egzekucyjne') ? przygotujKwote($this -> input -> post('koszty_egzekucyjne')) : '';
		*/
		$this->_prepareData($data['zadluzenie']);
		if ($this -> input -> post('submit') && $this -> form_validation -> run('dodaj_zadluzenie')) {
			$ws = $this -> zadluzenia -> getWierzycieleSprawy($data['zadluzenie']['dluznik'], $data['zadluzenie']['wierzyciel']);
			$data['zadluzenie']['id_wierzyciele_sprawy'] = $ws['id_wierzyciele_sprawy'];
			$this -> zadluzenia -> dodaj($data['zadluzenie']);
			redirect('zadluzenie/zarzadzanie');
		}
		$data['sprawy'] = $this -> sprawy -> lista();
		$data['dluznicy'] = $this -> users -> listaDluznicySprawy($data['sprawy']);
		$data['wierzyciele'] = $this -> users -> listaWierzycieleSprawy($data['sprawy']);
		$data['content'] = $this -> load -> view('zadluzenie/dodaj', $data, true);
		$this -> load -> view('index', $data);
	}

	function edytuj($id_zadluzenia) {
		if ($id_zadluzenia) {
			$zadluzenie = $this -> zadluzenia -> getById($id_zadluzenia);
			if ($zadluzenie) {
				$typ_usera = $this -> session -> userdata('nazwa_typ');
				$data['zadluzenie']['id_zadluzenia'] = $id_zadluzenia; 
				
				$data['zadluzenie']['dluznik'] = $this -> input -> post('dluznik') ? $this -> input -> post('dluznik') : $zadluzenie['id_sprawy'];
				$data['zadluzenie']['wierzyciel'] = $this -> input -> post('wierzyciel') ? $this -> input -> post('wierzyciel') : $zadluzenie['id_wierzyciela'];
				/*$data['zadluzenie']['data'] = $this -> input -> post('data') ? $this -> input -> post('data') : $zadluzenie['data'];
				$data['zadluzenie']['kwota_zadluzenia'] = $this -> input -> post('kwota_zadluzenia') ? przygotujKwote($this -> input -> post('kwota_zadluzenia')) : $zadluzenie['kwota_zadluzenia'];
				$data['zadluzenie']['odsetki'] = $this -> input -> post('odsetki') ? przygotujKwote($this -> input -> post('odsetki')) : $zadluzenie['odsetki'];
				$data['zadluzenie']['koszty_egzekucyjne'] = $this -> input -> post('koszty_egzekucyjne') ? przygotujKwote($this -> input -> post('koszty_egzekucyjne')) : $zadluzenie['koszty_egzekucyjne'];
				*/
				$this->_prepareData($data['zadluzenie'],$zadluzenie);
				if ($this -> input -> post('submit') && $this -> form_validation -> run('dodaj_zadluzenie')) {
					$ws = $this -> zadluzenia -> getWierzycieleSprawy($data['zadluzenie']['dluznik'], $data['zadluzenie']['wierzyciel']);	
					$data['zadluzenie']['id_wierzyciele_sprawy'] = $ws['id_wierzyciele_sprawy'];
					$this -> zadluzenia -> edytuj($data['zadluzenie']);
					redirect('zadluzenie/zarzadzanie');
				}
				$data['sprawy'] = $this -> sprawy -> lista();
				$data['dluznicy'] = $this -> users -> listaDluznicySprawy($data['sprawy']);
				$data['wierzyciele'] = $this -> users -> listaWierzycieleSprawy($data['sprawy']);
				$data['content'] = $this -> load -> view('zadluzenie/edytuj', $data, true);
				$this -> load -> view('index', $data);
			} else {
				$this -> session -> set_flashdata('error', 'W bazie nie ma takiego zadłużenia!!!');
				redirect('zadluzenie/zarzadzanie');
			}
		} else {
			$this -> session -> set_flashdata('error', 'Musisz wybrać zadłużenie!!!');
			redirect('zadluzenie/zarzadzanie');
		}
	}

	function stan($id_sprawy, $id_wierzyciela) {
		$data['stan'] = $this -> zadluzenia -> stan($id_sprawy, $id_wierzyciela);
		$data['content'] = $this -> load -> view('zadluzenie/dluznicy', $data, true);
		$this -> load -> view('index', $data);
	}

}
?>
