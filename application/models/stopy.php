<?php
class Stopy extends CI_Model {
	function __construct() {
		// wywołanie constructor z Model
		parent::__construct();
	}
	
	function getById($id_stopy_procentowej) {
		$this -> db -> from('stopy_procentowe') 
		-> where('id_stopy_procentowej',$id_stopy_procentowej);
		$stopa = $this -> db -> get() -> row_array();
		return $stopa;
	}
	
	function lista($where = null) {
		if (isset($where['data_do'])) {
			$this -> db -> select_max('data_od')
				-> from('stopy_procentowe')
				-> where("data_od <=",$where['data_od']);
			$stopa = $this -> db -> get() -> row_array();
			$this -> db -> where("data_od >=",$stopa['data_od']);
		}
		if (isset($where['data_do']))
			$this -> db -> where("data_od <",$where['data_do']);
		$this -> db -> from('stopy_procentowe')
			-> order_by("data_od","desc");
		$stopy = $this -> db -> get() -> result_array();
		$stopa_data_do = today();
		foreach ($stopy as &$stopa) {
			$stopa['data_do'] = $stopa_data_do;
			$stopa_data_do = $stopa['data_od'];
		}
		return $stopy;
	}
	
	function stopyWgDat($stopy, $data_od, $data_do) {
		$wynik = array();
		foreach ($stopy as $stopa) {
			if ($stopa['data_do'] > $data_od && $stopa['data_od'] < $data_do) {
				$wynik [] = $stopa;
			} else if ($stopa['data_do'] <= $data_od)
				return $wynik;
		}
		return $wynik;
	}
	
	
	function dodaj($stopa){
		$query = 'SELECT data_od, referencyjna, podatkowa, lombardowa '.
			'FROM stopy_procentowe '. 
			'WHERE data_od < \''.$stopa['data_od'].'\' '.
			'GROUP BY data_od '.
			'HAVING data_od = (SELECT MAX(data_od) '. 
                             'FROM stopy_procentowe '. 
                             'WHERE data_od < \''.$stopa['data_od'].'\')';
		$ostatniaStopa = $this -> db -> query($query) -> row_array();
		$dane = array(
		   'data_od' => $stopa['data_od'],
		   'referencyjna' => $stopa['referencyjna'] ? $stopa['referencyjna'] : $ostatniaStopa['referencyjna'],
		   'lombardowa' => $stopa['lombardowa'] ? $stopa['lombardowa'] : $ostatniaStopa['lombardowa'],
		   'podatkowa' => $stopa['podatkowa'] ? $stopa['podatkowa'] : $ostatniaStopa['podatkowa']
		);
		$this->db->insert('stopy_procentowe', $dane); 
		
		$this -> session -> set_flashdata('message', 'Dodano nowa stopę procentową');			
	}
	function edytuj($stopa){
		$query = 'SELECT data_od, referencyjna, podatkowa, lombardowa '.
			'FROM stopy_procentowe '. 
			'WHERE data_od < \''.$stopa['data_od'].'\' '.
			'GROUP BY data_od '.
			'HAVING data_od = (SELECT MAX(data_od) '. 
                             'FROM stopy_procentowe '. 
                             'WHERE data_od < \''.$stopa['data_od'].'\')';
		$ostatniaStopa = $this -> db -> query($query) -> row_array();
		$dane = array(
		   'data_od' => $stopa['data_od'],
		   'referencyjna' => $stopa['referencyjna'] ? $stopa['referencyjna'] : $ostatniaStopa['referencyjna'],
		   'lombardowa' => $stopa['lombardowa'] ? $stopa['lombardowa'] : $ostatniaStopa['lombardowa'],
		   'podatkowa' => $stopa['podatkowa'] ? $stopa['podatkowa'] : $ostatniaStopa['podatkowa']
		);
		$this->db->where('id_stopy_procentowej',  $stopa['id_stopy_procentowej'])
			->update('stopy_procentowe', $dane); 
		
		$this -> session -> set_flashdata('message', 'Zmodyfikowano stopę procentową');			
	}
	function getTypStopyProcentowej() {
		$typy = array(
		'referencyjna' => 'referencyjna',
		'podatkowa' => 'podatkowa',
		'lombardowa' => 'lombardowa',
		'stopa_z_wyroku' => 'stopa z wyroku'
		);
		return $typy;
			
	}
	
	
	
}
?>