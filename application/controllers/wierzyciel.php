<?php
    if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Wierzyciel extends MY_Controller {
	protected $fields = array('sygn_akt','nr_sprawy','NIP','PESEL','nazwa_dluznika','ulica','nr_dom','nr_lokal',
	    'miasto','kod','nr_telefonu','data_postanowienia','data_wplywu','wierzyciele');
		
	function __construct() {
		parent::__construct();
		$this -> load -> model('wierzyciele');
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
				
				$this->_prepareData($data['sprawa'],$sprawa);
				if ($this -> input -> post('submit')) {
					if ($this -> form_validation -> run('edytuj_sprawe')) {
						$this -> sprawy -> edytuj($data['sprawa']);
						redirect('sprawa/zarzadzanie');
					}
				}
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
	function szczegoly($id_wierzyciela) {
		$this -> load -> model('wplaty');
		if ($id_wierzyciela) {
			$wierzyciel = $this -> wierzyciele -> getById($id_wierzyciela);
			if ($wierzyciel) {
				$data['wierzyciel'] = $wierzyciel;
				$data['wierzyciel']['id_wierzyciela'] = $id_wierzyciela;
				$data['wplaty'] = $this -> wplaty -> wplatyDlaWierzyciela(null,$wierzyciel['id_wierzyciela']);
				$data['content'] = $this -> load -> view('sprawa/wierzyciel', $data, true);
				$this -> load -> view('index', $data);
			} else {
				$this -> session -> set_flashdata('error', 'W bazie nie ma takiego wierzyciela!!!');
				redirect('sprawa/zarzadzanie');
			}
		} else {
			$this -> session -> set_flashdata('error', 'Musisz wybrać wierzyciela!!!');
			redirect('sprawa/zarzadzanie');
		}
	}	
}
?>