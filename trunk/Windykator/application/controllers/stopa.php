<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Stopa extends MY_Controller {
	protected $fields = array('data_od', 'referencyjna', 'lombardowa', 'podatkowa');
	
	function __construct() {
		parent::__construct();
		$this -> load -> model('stopy');
	}

	function zarzadzanie() {
		$data['stopy'] = $this -> stopy -> lista();
		$data['content'] = $this -> load -> view('stopa/zarzadzanie', $data, true);
		$this -> load -> view('index', $data);
	}
	
	function dodaj() {
		$this->_prepareData($data['stopa']);
		if ($this -> input -> post('submit') && $this -> form_validation -> run('dodaj_stopa')) {
			$this -> stopy -> dodaj($data['stopa']);
			redirect('stopa/zarzadzanie');
		}
		$data['content'] = $this -> load -> view('stopa/dodaj', $data, true);
		$this -> load -> view('index', $data);
	}
	
	function edytuj($id_stopy_procentowej) {
		if ($id_stopy_procentowej) {
			$stopa = $this -> stopy -> getById($id_stopy_procentowej);
			if ($stopa) {
				$data['stopa']['id_stopy_procentowej'] = $id_stopy_procentowej;
				$this->_prepareData($data['stopa'],$stopa);
				if ($this -> input -> post('submit') && $this -> form_validation -> run('dodaj_stopa')) {
					$this -> stopy -> edytuj($data['stopa']);
					redirect('stopa/zarzadzanie');
				}
				$data['content'] = $this -> load -> view('stopa/edytuj', $data, true);
				$this -> load -> view('index', $data);
			} else {
				$this -> session -> set_flashdata('error', 'W bazie nie ma takiej stopy procentowej!!!');
				redirect('stopa/zarzadzanie');
			}
		} else {
			$this -> session -> set_flashdata('error', 'Musisz wybrać stopę procentową!!!');
			redirect('stopa/zarzadzanie');
		}
	}
	function _sprawdz_stopy($login) {
		if (!$this -> input -> post('referencyjna') && !$this -> input -> post('lombardowa') && !$this -> input -> post('podatkowa')) {
			$this -> form_validation -> set_message('_sprawdz_stopy', 'Musisz podać przynajmniej jedną stopę procentową!');
			return false;
		} else {
			return true;
		}
	}
}
?>