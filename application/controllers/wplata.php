<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Wplata extends MY_Controller {
	protected $fields = array('dluznik','data_wplaty','kwota_wplaty');
	
	function __construct() {
		parent::__construct();
		$this -> load -> model('wplaty');
	}

	function zarzadzanie() {
		$where = array();
		if ($this -> input -> post('szukaj')) {
			$fraza = $this -> input -> post('szukany');
			$kryterium = $this -> input -> post('kryterium');
			if (!$this -> form_validation -> run('wyszukiwanie')) {
				$this -> session -> set_flashdata('error', 'Musisz podać fraze i kryterium!!!');
				redirect('wplaty/zarzadzanie');
			} else {
				$where[$kryterium] = $fraza;
			}
		} 
		
		$data['wplaty'] = $this -> wplaty -> lista($where);
		$data['content'] = $this -> load -> view('wplata/zarzadzanie', $data, true);
		$this -> load -> view('index', $data);
	}
	
	function dodaj() {
		$typ_usera = $this -> session -> userdata('nazwa_typ');
		$this->_prepareData($data['wplata']);
		if ($this -> input -> post('submit') && $this -> form_validation -> run('dodaj_wplata')) {
			$this -> wplaty -> dodaj($data['wplata']);
			redirect('wplata/zarzadzanie');
		}
		$data['dluznicy'] = $this -> users -> listaDluznikow();
		$data['content'] = $this -> load -> view('wplata/dodaj', $data, true);
		$this -> load -> view('index', $data);
	}
	function edytuj($id_wplaty) {
		if ($id_wplaty) {
			$wplata = $this -> wplaty -> getById($id_wplaty);
			if ($wplata) {
				$typ_usera = $this -> session -> userdata('nazwa_typ');
				$data['wplata']['id_wplaty'] = $id_wplaty;
				$this->_prepareData($data['wplata'],$wplata);
				if ($this -> input -> post('submit') && $this -> form_validation -> run('dodaj_wplata')) {
					$this -> wplaty -> edytuj($data['wplata']);
					redirect('wplata/zarzadzanie');
				}
				$data['dluznicy'] = $this -> users -> listaDluznikow();
				$data['content'] = $this -> load -> view('wplata/edytuj', $data, true);
				$this -> load -> view('index', $data);
			} else {
				$this -> session -> set_flashdata('error', 'W bazie nie ma takiej wpłaty!!!');
				redirect('wplata/zarzadzanie');
			}
		} else {
			$this -> session -> set_flashdata('error', 'Musisz wybrać wpłatę!!!');
			redirect('wplata/zarzadzanie');
		}
	}
	function szczegoly($id_wplaty) {
		if ($id_wplaty) {
			$wplata = $this -> wplaty -> getPodzialWplaty($id_wplaty);
			if ($wplata) {
				$data['wplata'] = $wplata;
				$data['content'] = $this -> load -> view('wplata/szczegoly', $data, true);
				$this -> load -> view('index', $data);
			} else {
				$this -> session -> set_flashdata('error', 'W bazie nie ma takiej wplaty!!!');
				redirect('wplata/zarzadzanie');
			}
		} else {
			$this -> session -> set_flashdata('error', 'Musisz wybrać wplate!!!');
			redirect('wplata/zarzadzanie');
		}
	}
	
}
?>