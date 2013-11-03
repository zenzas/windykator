<?php
class Wplaty extends CI_Model {
	function __construct() {
		// wywołanie constructor z Model
		parent::__construct();
	}
	
	function getById($id_wplaty) {
		$this -> db -> select('w.*, d.nazwa as dluznik')
	 	-> from('wplaty w') 
		-> join('users d','w.id_dluznika = d.id_users')
		-> where('w.id_wplaty',$id_wplaty);
		$wplata = $this -> db -> get() -> row_array();
		return $wplata;
	}
	
	function getPodzialWplaty($id_wplaty) {
		$this -> db -> select('w.*, ok.kwota_oplaty, z.kwota_zwrotu')
		 	-> from('wplaty w') 
			-> join('oplaty_komornicze ok','w.id_wplaty = ok.id_wplaty')
			-> join('zwroty z','w.id_wplaty = z.id_wplaty','left')
			-> where('w.id_wplaty',$id_wplaty);
		$wplata = $this -> db -> get() -> row_array();
		//var_dump($wplata);
		$this -> db -> select('ww.*, u.nazwa')
			-> from('wplaty_dla_wierzycieli ww') 
			-> join('wierzyciel w','ww.id_wierzyciela = w.id_wierzycieli')
			-> join('users u','w.id_user = u.id_users')
			-> where('ww.id_wplaty',$id_wplaty);
		$wplata['wplaty_wierzycieli'] = $this -> db -> get() -> result_array();
		//var_dump($wplata);
		return $wplata;
	}
	
	function lista($where = null) {
		$this -> db -> select('w.*, d.nazwa as dluznik')
	 	-> from('wplaty w') 
		-> join('users d','w.id_dluznika = d.id_users');
		$this -> ustawKryteria($where);
		$this -> db -> order_by("data_wplaty","desc");
		$wplaty = $this -> db -> get() -> result_array();
		return $wplaty;
	}
	
	function wplatyDlaWierzyciela($id_dluznika, $id_wierzyciela) {
		$this -> db -> select('w.*, ww.*, d.nazwa as dluznik')
	 	-> from('wplaty_dla_wierzycieli ww') 
		-> join('wplaty w','w.id_wplaty = ww.id_wplaty')
		-> join('users d','w.id_dluznika = d.id_users');
		if ($id_dluznika)
			$this->db->where('w.id_dluznika', $id_dluznika);
		if ($id_wierzyciela)
			$this->db->where('ww.id_wierzyciela', $id_wierzyciela);
		$this -> db -> order_by("data_wplaty","desc");
		$wplaty = $this -> db -> get() -> result_array();
		return $wplaty;
	}
	
	function ustawKryteria ($where) {
		if ($where) {
			if (isset($where['dluznik'])) {
				$this->db->like('d.nazwa', $where['dluznik']);
			}
			if (isset($where['id_dluznika'])) {
				$this->db->like('w.id_dluznika', $where['id_dluznika']);
			}
		}
	}
	function dodaj($wplata){
		$dane = array(
		   'id_dluznika' => $wplata['dluznik'],
		   'data_wplaty' => $wplata['data_wplaty'],
		   'kwota_wplaty' => $wplata['kwota_wplaty']
		);
		$this->db->insert('wplaty', $dane); 
		$dane['id_wplaty'] = $this->db->insert_id();
		$this->rozliczWplate($dane);
		
		$this -> session -> set_flashdata('message', 'Dodano nowa wpłatę');			
	}
	
	function zaplac($co, &$kwota, &$zadluzenie, &$wplata) {
		$zaplacono = min($kwota, $zadluzenie[$co]);
		$wplata[$co] = $zaplacono;
		$zadluzenie[$co] -= $zaplacono;
		$kwota -= $zaplacono;
	}
	function wyczyscRozliczenieWplaty($wplata) {
		
	}
	
	function rozliczWplate($wplata) {
		$this -> load -> model('zadluzenia');
		$this -> load -> model('stopy');
		$zadluzeniaWgPriorytetow = $this->zadluzenia->aktualizujZadluzenie($wplata);
		ksort($zadluzeniaWgPriorytetow);
		// echo"<pre>";print_r($zadluzeniaWgPriorytetow);
		
		$oplaty = round($wplata['kwota_wplaty']*OPLATA_KOMORNICZA,2);
		$this->db->insert('oplaty_komornicze', array('id_wplaty' => $wplata['id_wplaty'], 'kwota_oplaty' =>$oplaty));
		
		$pozostalo = $wplata['kwota_wplaty']-$oplaty;
		// echo "Wplata: $pozostalo <br/>";
		foreach ($zadluzeniaWgPriorytetow as $priorytet => $zadluzeniaPriorytet) {
			if ($pozostalo >= $zadluzeniaPriorytet['suma']) {
				// echo "Starczy na wszystkich z priorytetem $priorytet<br/>";
				foreach ($zadluzeniaPriorytet['zadluzenia'] as $zadluzenie) {
					$wplataDlaWierzyciela = array(
						'id_wplaty' => $wplata['id_wplaty'],
						'id_wierzyciela' => $zadluzenie['id_wierzyciela'],
						'kwota_zadluzenia' => $zadluzenie['kwota_zadluzenia'],
					   	'odsetki' => $zadluzenie['odsetki'],
					   	'koszty_egzekucyjne' => $zadluzenie['koszty_egzekucyjne'],
					   	'pozostala_kwota_zadluzenia' => 0,
					   	'pozostale_odsetki' => 0,
					   	'pozostale_koszty_egzekucyjne' => 0  
					);
					$this->db->insert('wplaty_dla_wierzycieli', $wplataDlaWierzyciela); 
					$this->db->delete('zadluzenie', array('id_zadluzenia' => $zadluzenie['id_zadluzenia']));
					$pozostalo -= $zadluzenie['suma'];
				}
				// echo "Pozostalo: +$pozostalo <br/>";
			} else {
				foreach ($zadluzeniaPriorytet['zadluzenia'] as $zadluzenie) {
					$procent = $zadluzenie['suma']/$zadluzeniaPriorytet['suma'];
					$kwota = round($pozostalo * $procent,2);
					// echo "Splata tylko czesci zadluzenia $procent, $kwota<br/>";
					$wplataDlaWierzyciela = array(
						'id_wplaty' => $wplata['id_wplaty'],
						'id_wierzyciela' => $zadluzenie['id_wierzyciela'],
						'kwota_zadluzenia' => 0,
					   	'odsetki' => 0,
					   	'koszty_egzekucyjne' => 0 
					);
					$this->zaplac('koszty_egzekucyjne', $kwota, $zadluzenie, $wplataDlaWierzyciela);
					if ($kwota > 0) {
						$this->zaplac('odsetki', $kwota, $zadluzenie, $wplataDlaWierzyciela);
						if ($kwota > 0) {
							$this->zaplac('kwota_zadluzenia', $kwota, $zadluzenie, $wplataDlaWierzyciela);
						}
					}
					$this->db->insert('wplaty_dla_wierzycieli', $wplataDlaWierzyciela);
					$aktualneZadluzenie = array(
						'kwota_zadluzenia' => $zadluzenie['kwota_zadluzenia'],
					   	'odsetki' => $zadluzenie['odsetki'],
					   	'koszty_egzekucyjne' => $zadluzenie['koszty_egzekucyjne'] 
					); 
					$this->db->update('zadluzenie', $aktualneZadluzenie, array('id_zadluzenia' => $zadluzenie['id_zadluzenia']));
					// var_dump($wplataDlaWierzyciela, $aktualneZadluzenie);
					$pozostalo -= $wplataDlaWierzyciela['kwota_zadluzenia'] + $wplataDlaWierzyciela['odsetki'] + $wplataDlaWierzyciela['koszty_egzekucyjne'];
					// echo "Pozostalo: +$pozostalo <br/>";
				}
				break;
			}
		}
		// echo $pozostalo;
		if ($pozostalo > 0)
			$this->db->insert('zwroty', array('id_wplaty' => $wplata['id_wplaty'], 'kwota_zwrotu' => $pozostalo));
		// exit;
	}
	
	function edytuj($wplata){
		$dane = array(
		   'id_dluznika' => $wplata['dluznik'],
		   'kwota_wplaty' => $wplata['kwota_wplaty'],
		   'data_wplaty' => $wplata['data_wplaty'],
		);
		
		$this->db->where('id_wplaty',  $wplata['id_wplaty'])
			->update('wplaty', $dane); 
		
		$this -> session -> set_flashdata('message', 'Zmodyfikowano wpłatę');			
	}
}
?>