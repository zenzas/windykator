<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Wniosek extends MY_Controller {
	protected $fields = array('wnioskodawca','sprawa','opis_wniosku','data_wplywu','data_odpowiedzi' );
	

	function __construct() {
		parent::__construct();
		$this -> load -> model('wnioski');
		$this -> load -> model('sprawy');
	}

	function zarzadzanie($pilne = false) {
		$where = array();
		if ($this -> input -> post('szukaj')) {
			$fraza = $this -> input -> post('szukany');
			$kryterium = $this -> input -> post('kryterium');
			if (!$this -> form_validation -> run('wyszukiwanie')) {
				$this -> session -> set_flashdata('error', 'Musisz podać fraze i kryterium!!!');
				redirect('wniosek/zarzadzanie');
			} else {
				$where[$kryterium] = $fraza;
			}
		} 
		if ($pilne)
			$where['data_odpowiedzi'] = null;
		$data['pilne'] = $pilne != false;
		$data['wnioski'] = $this -> wnioski -> lista($where);
		$data['content'] = $this -> load -> view('wniosek/zarzadzanie', $data, true);
		$this -> load -> view('index', $data);
	}

	function dodaj() {
		$typ_usera = $this -> session -> userdata('nazwa_typ');
		/*
		$data['wniosek']['wnioskodawca'] = $this -> input -> post('wnioskodawca') ? $this -> input -> post('wnioskodawca') : '';
		$data['wniosek']['sprawa'] = $this -> input -> post('sprawa') ? $this -> input -> post('sprawa') : '';
		$data['wniosek']['opis_wniosku'] = $this -> input -> post('opis_wniosku') ? $this -> input -> post('opis_wniosku') : '';
		$data['wniosek']['data_wplywu'] = $this -> input -> post('data_wplywu') ? $this -> input -> post('data_wplywu') : '';
		$data['wniosek']['data_odpowiedzi'] = $this -> input -> post('data_odpowiedzi') ? $this -> input -> post('data_odpowiedzi') : '';
		*/
		$this->_prepareData($data['wniosek']);
		if ($this -> input -> post('submit') && $this -> form_validation -> run('dodaj_wniosek')) {
			$data['wniosek']['operator'] = $this -> session -> userdata('id');
			$this -> wnioski -> dodaj($data['wniosek']);
			redirect('wniosek/zarzadzanie');
		}
		$data['sprawy'] = $this -> sprawy -> listaSpraw();
		$data['wnioskodawcy'] = $this -> users -> listaWnioskodawcow();
		$data['content'] = $this -> load -> view('wniosek/dodaj', $data, true);
		$this -> load -> view('index', $data);
	}

	function edytuj($id_wniosku) {
		if ($id_wniosku) {
			$wniosek = $this -> wnioski -> getById($id_wniosku);
			if ($wniosek) {
				$typ_usera = $this -> session -> userdata('nazwa_typ');
				$data['wniosek']['id_wniosku'] = $id_wniosku;
				/*
				$data['wniosek']['wnioskodawca'] = $this -> input -> post('wnioskodawca') ? $this -> input -> post('wnioskodawca') : $wniosek['id_wnioskodawcy'];
				$data['wniosek']['sprawa'] = $this -> input -> post('sprawa') ? $this -> input -> post('sprawa') : $wniosek['id_sprawy'];
				$data['wniosek']['opis_wniosku'] = $this -> input -> post('opis_wniosku') ? $this -> input -> post('opis_wniosku') : $wniosek['opis_wniosku'];
				$data['wniosek']['data_wplywu'] = $this -> input -> post('data_wplywu') ? $this -> input -> post('data_wplywu') : $wniosek['data_wplywu'];
				$data['wniosek']['data_odpowiedzi'] = $this -> input -> post('data_odpowiedzi') ? $this -> input -> post('data_odpowiedzi') : $wniosek['data_odpowiedzi'];
		       */
		
		$this->_prepareData($data['wniosek'],$wniosek);
				if ($this -> input -> post('submit') && $this -> form_validation -> run('dodaj_wniosek')) {
					$data['wniosek']['operator'] = $this -> session -> userdata('id');
					$this -> wnioski -> edytuj($data['wniosek']);
					redirect('wniosek/zarzadzanie');
				}
				$data['sprawy'] = $this -> sprawy -> listaSpraw();
				$data['wnioskodawcy'] = $this -> users -> listaWnioskodawcow();
				$data['content'] = $this -> load -> view('wniosek/edytuj', $data, true);
				$this -> load -> view('index', $data);
			} else {
				$this -> session -> set_flashdata('error', 'W bazie nie ma takiego wniosku!!!');
				redirect('wniosek/zarzadzanie');
			}
		} else {
			$this -> session -> set_flashdata('error', 'Musisz wybrać wniosek!!!');
			redirect('wniosek/zarzadzanie');
		}
	}

}
?>