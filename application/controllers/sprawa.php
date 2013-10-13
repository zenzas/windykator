<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Sprawa extends MY_Controller {
	protected $fields = array('sygn_akt','nr_sprawy','NIP','PESEL','nazwa_dluznika','ulica','nr_dom','nr_lokal',
		'miasto','kod', 'nr_telefonu','data_postanowienia','data_wplywu','wierzyciele');
	
	function __construct() {
		parent::__construct();
		$this -> load -> model('sprawy');
	}

	function zarzadzanie($archiwalna = false) {
		$archiwalna = $archiwalna != false;
		$where = array('archiwalna' => $archiwalna);
		if ($this -> input -> post('szukaj')) {
			$fraza = $this -> input -> post('szukany');
			$kryterium = $this -> input -> post('kryterium');
			if (!$this -> form_validation -> run('wyszukiwanie')) {
				$this -> session -> set_flashdata('error', 'Musisz podać fraze i kryterium!!!');
				redirect('sprawa/zarzadzanie');
			} else {
				$where[$kryterium] = $fraza;
			}
		}
		$data['sprawy'] = $this -> sprawy -> lista($where);
		$data['archiwalna'] = $archiwalna;
		$data['content'] = $this -> load -> view('sprawa/zarzadzanie', $data, true);
		$this -> load -> view('index', $data);
	}

	function dodaj() {
		$this->_prepareData($data['sprawa']);
		if ($this -> input -> post('submit')) {
			if ($this -> form_validation -> run('dodaj_sprawe')) {
				$this -> sprawy -> dodaj($data['sprawa']);
				redirect('sprawa/zarzadzanie');
			}
		}
		$data['content'] = $this -> load -> view('sprawa/dodaj', $data, true);
		$this -> load -> view('index', $data);
	}

	function edytuj($id_sprawy) {
		if ($id_sprawy) {
			$sprawa = $this -> sprawy -> getById($id_sprawy);
			if ($sprawa) {
				$data['sprawa']['id_sprawy'] = $id_sprawy;
				$data['sprawa']['id_dluznika'] = $sprawa['id_dluznika'];
				$this->_prepareData($data['sprawa'], $sprawa);
				if ($this -> input -> post('submit')) {
					if ($this -> form_validation -> run('edytuj_sprawe')) {
						$this -> sprawy -> edytuj($data['sprawa']);
						redirect('sprawa/zarzadzanie');
					}
				}
				$data['typyWierzycieli'] = $this -> users -> listaTypowWierzycieli();
				$data['content'] = $this -> load -> view('sprawa/edytuj', $data, true);
				$this -> load -> view('index', $data);
			} else {
				$this -> session -> set_flashdata('error', 'W bazie nie ma takiej sprawy!!!');
				redirect('sprawa/zarzadzanie');
			}
		} else {
			$this -> session -> set_flashdata('error', 'Musisz wybrać sprawę!!!');
			redirect('sprawa/zarzadzanie');
		}
	}

	function szczegoly($id_sprawy) {
		if ($id_sprawy) {
			$sprawa = $this -> sprawy -> getById($id_sprawy);
			if ($sprawa) {
				$data['sprawa']['id_sprawy'] = $id_sprawy;
				$data['sprawa']['id_dluznika'] = $sprawa['id_dluznika'];
				$data['sprawa']['nr_sprawy'] = $sprawa['nr_sprawy'];
				$data['sprawa']['sygn_akt'] = $sprawa['sygn_akt'];
				$data['sprawa']['NIP'] = $sprawa['NIP'];
				$data['sprawa']['PESEL'] = $sprawa['PESEL'];
				$data['sprawa']['nazwa_dluznika'] = $sprawa['nazwa_dluznika'];
				$data['sprawa']['ulica'] = $sprawa['ulica'];
				$data['sprawa']['nr_dom'] = $sprawa['nr_dom'];
				$data['sprawa']['nr_lokal'] = $sprawa['nr_lokal'];
				$data['sprawa']['miasto'] = $sprawa['miasto'];
				$data['sprawa']['kod'] = $sprawa['kod'];
				$data['sprawa']['nr_telefonu'] = $sprawa['nr_telefonu'];
				$data['sprawa']['data_postanowienia'] = $sprawa['data_postanowienia'];
				$data['sprawa']['data_wplywu'] = $sprawa['data_wplywu'];
				$data['sprawa']['wierzyciele'] = $sprawa['wierzyciele'];

				$data['content'] = $this -> load -> view('sprawa/szczegoly', $data, true);
				$this -> load -> view('index', $data);
			} else {
				$this -> session -> set_flashdata('error', 'W bazie nie ma takiej sprawy!!!');
				redirect('sprawa/zarzadzanie');
			}
		} else {
			$this -> session -> set_flashdata('error', 'Musisz wybrać sprawę!!!');
			redirect('sprawa/zarzadzanie');
		}
	}

	function usun($id_sprawy) {
		if ($id_sprawy) {
			$this -> sprawy -> usun($id_sprawy);
		} else {
			$this -> session -> set_flashdata('error', 'Musisz wybrać sprawę!!!');
		}
		redirect('sprawa/zarzadzanie');
	}

	function archiwum() {
		// $data['sprawy'] = $this -> sprawy -> lista(array('archiwalna' => true));
		// $data['content'] = $this -> load -> view('sprawa/zarzadzanie', $data, true);
		// $this -> load -> view('index', $data);
		$this -> zarzadzanie(true);
	}

	function przywroc($id_sprawy) {
		if ($id_sprawy) {
			$this -> sprawy -> przywroc($id_sprawy);
			redirect('sprawa/zarzadzanie');
		} else {
			$this -> session -> set_flashdata('error', 'Musisz wybrać sprawę!!!');
			redirect('sprawa/archiwum');
		}
	}

	function _sprawdz_identyfikator($identyfikator) {
		if (!$this -> input -> post('NIP') && !$this -> input -> post('PESEL')) {
			$this -> form_validation -> set_message('_sprawdz_identyfikator', 'Musisz podać NIP lub PESEL!!');
			return false;
		} else {
			return true;
		}
	}
}
?>