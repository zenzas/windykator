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
			
			
			
		/*$data['sprawa']['sygn_akt'] = $this -> input -> post('sygn_akt') ? $this -> input -> post('sygn_akt') : '';
		$data['sprawa']['nr_sprawy'] = $this -> input -> post('nr_sprawy') ? $this -> input -> post('nr_sprawy') : '';
		$data['sprawa']['NIP'] = $this -> input -> post('NIP') ? $this -> input -> post('NIP') : '';
		$data['sprawa']['PESEL'] = $this -> input -> post('PESEL') ? $this -> input -> post('PESEL') : '';
		$data['sprawa']['nazwa_dluznika'] = $this -> input -> post('nazwa_dluznika') ? $this -> input -> post('nazwa_dluznika') : '';
		$data['sprawa']['ulica'] = $this -> input -> post('ulica') ? $this -> input -> post('ulica') : '';
		$data['sprawa']['nr_dom'] = $this -> input -> post('nr_dom') ? $this -> input -> post('nr_dom') : '';
		$data['sprawa']['nr_lokal'] = $this -> input -> post('nr_lokal') ? $this -> input -> post('nr_lokal') : '';
		$data['sprawa']['miasto'] = $this -> input -> post('miasto') ? $this -> input -> post('miasto') : '';
		$data['sprawa']['kod'] = $this -> input -> post('kod') ? $this -> input -> post('kod') : '';
		$data['sprawa']['nr_telefonu'] = $this -> input -> post('nr_telefonu') ? $this -> input -> post('nr_telefonu') : '';
		$data['sprawa']['data_postanowienia'] = $this -> input -> post('data_postanowienia') ? $this -> input -> post('data_postanowienia') : '';
		$data['sprawa']['data_wplywu'] = $this -> input -> post('data_wplywu') ? $this -> input -> post('data_wplywu') : '';
		*/
		
		
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
				
				
				/*
				$data['sprawa']['sygn_akt'] = $this -> input -> post('sygn_akt') ? $this -> input -> post('sygn_akt') : $sprawa['sygn_akt'];
				$data['sprawa']['nr_sprawy'] = $this -> input -> post('nr_sprawy') ? $this -> input -> post('nr_sprawy') : $sprawa['nr_sprawy'];
				$data['sprawa']['NIP'] = $this -> input -> post('NIP') ? $this -> input -> post('NIP') : $sprawa['NIP'];
				$data['sprawa']['PESEL'] = $this -> input -> post('PESEL') ? $this -> input -> post('PESEL') : $sprawa['PESEL'];
				$data['sprawa']['nazwa_dluznika'] = $this -> input -> post('nazwa_dluznika') ? $this -> input -> post('nazwa_dluznika') : $sprawa['nazwa_dluznika'];
				$data['sprawa']['ulica'] = $this -> input -> post('ulica') ? $this -> input -> post('ulica') : $sprawa['ulica'];
				$data['sprawa']['nr_dom'] = $this -> input -> post('nr_dom') ? $this -> input -> post('nr_dom') : $sprawa['nr_dom'];
				$data['sprawa']['nr_lokal'] = $this -> input -> post('nr_lokal') ? $this -> input -> post('nr_lokal') : $sprawa['nr_lokal'];
				$data['sprawa']['miasto'] = $this -> input -> post('miasto') ? $this -> input -> post('miasto') : $sprawa['miasto'];
				$data['sprawa']['kod'] = $this -> input -> post('kod') ? $this -> input -> post('kod') : $sprawa['kod'];
				$data['sprawa']['nr_telefonu'] = $this -> input -> post('nr_telefonu') ? $this -> input -> post('nr_telefonu') : $sprawa['nr_telefonu'];
				$data['sprawa']['data_postanowienia'] = $this -> input -> post('data_postanowienia') ? $this -> input -> post('data_postanowienia') : $sprawa['data_postanowienia'];
				$data['sprawa']['data_wplywu'] = $this -> input -> post('data_wplywu') ? $this -> input -> post('data_wplywu') : $sprawa['data_wplywu'];				
				$data['sprawa']['wierzyciele'] = $sprawa['wierzyciele'];
				*/
				
				
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
}
?>