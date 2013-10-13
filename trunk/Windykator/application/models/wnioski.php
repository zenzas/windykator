<?php
class Wnioski extends CI_Model {

	function __construct() {
		// wywołanie constructor z Model
		parent::__construct();
	}
	
	function getById($id_wniosku) {
		$this -> db -> select('w.*, u.nazwa as wnioskodawca, o.nazwa as operator, s.sygn_akt, s.nr_sprawy, d.nazwa as dluznik')
	 	-> from('wnioski w') 
	 	-> join('users u', 'u.id_users = w.id_wnioskodawcy') 
	 	-> join('users_dane ud', 'ud.id_users = u.id_users') 
	 	-> join('users o', 'o.id_users = w.id_operatora')
		-> join('sprawy s','s.id_sprawy = w.id_sprawy')
		-> join('users d','s.id_dluznika = d.id_users')
		-> where('w.id_wniosku',$id_wniosku);
		$wniosek = $this -> db -> get() -> row_array();
		return $wniosek;
	}
	
	function lista($where = null) {
		$this -> db -> select('w.*, u.nazwa as wnioskodawca, o.nazwa as operator, s.sygn_akt, s.nr_sprawy, d.nazwa as dluznik, '.
			ILE_DNI_NA_ODPOWIEDZ.' - DATEDIFF(CURDATE(),w.data_wplywu) as pozostalo',false)
	 	-> from('wnioski w') 
	 	-> join('users u', 'u.id_users = w.id_wnioskodawcy') 
	 	-> join('users_dane ud', 'ud.id_users = u.id_users') 
	 	-> join('users o', 'o.id_users = w.id_operatora')
		-> join('sprawy s','s.id_sprawy = w.id_sprawy')
		-> join('users d','s.id_dluznika = d.id_users');
		$this -> ustawKryteria($where);
		$this -> db -> order_by("data_wplywu","desc");
		$wnioski = $this -> db -> get() -> result_array();
		return $wnioski;
	}
	
	function dodaj($wniosek){
		$dane = array(
		   'id_wnioskodawcy' => $wniosek['wnioskodawca'],
		   'id_operatora' => $wniosek['operator'],
		   'id_sprawy' => $wniosek['sprawa'],
		   'opis_wniosku' => $wniosek['opis_wniosku'],
		   'data_wplywu' => $wniosek['data_wplywu'],
		   'data_odpowiedzi' => $wniosek['data_odpowiedzi'] ? $wniosek['data_odpowiedzi'] : null
		);
		$this->db->insert('wnioski', $dane); 
		
		$this -> session -> set_flashdata('message', 'Dodano nowy wniosek');			
	}

	function edytuj($wniosek){
		$dane = array(
		   'id_wnioskodawcy' => $wniosek['wnioskodawca'],
		   'id_operatora' => $wniosek['operator'],
		   'id_sprawy' => $wniosek['sprawa'],
		   'opis_wniosku' => $wniosek['opis_wniosku'],
		   'data_wplywu' => $wniosek['data_wplywu'],
		   'data_odpowiedzi' => $wniosek['data_odpowiedzi'] ? $wniosek['data_odpowiedzi'] : null
		);
		
		$this->db->where('id_wniosku',  $wniosek['id_wniosku'])
			->update('wnioski', $dane); 
		
		$this -> session -> set_flashdata('message', 'Zmieniono wniosek');			
	}
	function ustawKryteria ($where) {
		if ($where) {
			if (array_key_exists('data_odpowiedzi', $where)){
				if ($where['data_odpowiedzi'] != null)
					$this->db->where('w.data_odpowiedzi', $where['data_odpowiedzi']);
				else
					$this->db->where('w.data_odpowiedzi IS NULL', null, false);
				if (isset($where['data_wplywu']))
					$this->db->where('w.data_wplywu <= ', $where['data_wplywu']);
				$this -> db -> order_by("pozostalo","asc",false);
			}
			if (isset($where['all'])){
				$this->db->like('u.nazwa', $where['all']);
				$this->db->or_like('d.nazwa', $where['all']);
				$this->db->or_like('s.sygn_akt', $where['all'],'after');
				$this->db->or_like('s.nr_sprawy', $where['all'],'after');
			}
			if (isset($where['wnioskodawca'])) {
				$this->db->like('u.nazwa', $where['wnioskodawca']);
			}
			if (isset($where['dluznik'])) {
				$this->db->like('d.nazwa', $where['dluznik']);
			}
			if (isset($where['sygn_akt'])) {
				$this->db->like('s.sygn_akt', $where['sygn_akt'],'after');
			}
			if (isset($where['nr_sprawy'])) {
				$this->db->like('s.nr_sprawy', $where['nr_sprawy'],'after');
			}
		}
	}
}
?>