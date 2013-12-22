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
		$this -> db -> select('w.*, z.kwota_zwrotu, u.nazwa as nazwa_dluznika, ud.*')
		 	-> from('wplaty w') 
            -> join('users u','w.id_dluznika = u.id_users')
            -> join('users_dane ud','u.id_users = ud.id_users')
			-> join('zwroty z','w.id_wplaty = z.id_wplaty','left')
			-> where('w.id_wplaty',$id_wplaty);
		$wplata = $this -> db -> get() -> row_array();
		//var_dump($wplata);
		$this -> db -> select('ww.*, u.nazwa')
			-> from('wplaty_dla_wierzycieli ww') 
			-> join('wierzyciel w','ww.id_wierzyciela = w.id_wierzyciela')
			-> join('users u','w.id_users = u.id_users')
			-> where('ww.id_wplaty',$id_wplaty);
		$wplata['wplaty_wierzycieli'] = $this -> db -> get() -> result_array();
		//var_dump($wplata);exit;
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
		   'kwota_wplaty' => przygotujKwote($wplata['kwota_wplaty'])
		);
		$this->db->insert('wplaty', $dane); 
		$dane['id_wplaty'] = $this->db->insert_id();
		$this->rozliczWplate($dane);
		
		$this -> session -> set_flashdata('message', 'Dodano nowa wpłatę');			
	}
	
	function zaplac($co, $pozostalo, &$kwota, &$zadluzenie, &$wplata) {
		$zaplacono = min($kwota, $zadluzenie[$pozostalo]);
		$wplata[$co] = $zaplacono;
		$zadluzenie[$pozostalo] -= $zaplacono;
		$wplata[$pozostalo] = $zadluzenie[$pozostalo];
		$kwota -= $zaplacono;
	}
	function wyczyscRozliczenieWplaty($wplata) {
		
	}
	
	function czyOplata($wierzyciel) {
		return strpos($wierzyciel,ZUS) === FALSE && strpos($wierzyciel,US) === FALSE;
	}
    
    function odejmijOplate(&$zadluzenie, $oplata) {
        $co = array('pozostala_kwota_zadluzenia', 'pozostale_odsetki', 'pozostale_koszty_egzekucyjne');
        $i = 0;
        while ($oplata > 0 && $i < count($co)) {
            $zaplacono = min($zadluzenie[$co[$i]], $oplata);
            $zadluzenie[$co[$i]] -= $zaplacono;
            $oplata -= $zaplacono;
            ++$i;
        }
    }
	
	function rozliczWplate($wplata) {
		$this -> load -> model('zadluzenia');
		$this -> load -> model('stopy');
		$zadluzeniaWgPriorytetow = $this->zadluzenia->aktualizujZadluzenie($wplata);
		ksort($zadluzeniaWgPriorytetow);
		//echo"<pre>";print_r($zadluzeniaWgPriorytetow);
		
		$pozostalo = $wplata['kwota_wplaty'];
		//echo "Wplata: $pozostalo <br/>";
		foreach ($zadluzeniaWgPriorytetow as $priorytet => $zadluzeniaPriorytet) {
			if ($pozostalo >= $zadluzeniaPriorytet['suma']) {
				//echo "Starczy na wszystkich z priorytetem $priorytet<br/>";
				foreach ($zadluzeniaPriorytet['zadluzenia'] as $zadluzenie) {
					$oplata = $this->czyOplata($zadluzenie['wierzyciel']) ? round($zadluzenie['suma']*OPLATA_KOMORNICZA,2) : 0;
					$this->odejmijOplate($zadluzenie, $oplata);
					$wplataDlaWierzyciela = array(
						'id_wplaty' => $wplata['id_wplaty'],
						'id_wierzyciela' => $zadluzenie['id_wierzyciela'],
						'kwota_zadluzenia' => $zadluzenie['pozostala_kwota_zadluzenia'],
					   	'odsetki' => $zadluzenie['pozostale_odsetki'],
					   	'koszty_egzekucyjne' => $zadluzenie['pozostale_koszty_egzekucyjne'],
					   	'oplata_komornicza' => $oplata,
					   	'pozostala_kwota_zadluzenia' => 0,
					   	'pozostale_odsetki' => 0,
					   	'pozostale_koszty_egzekucyjne' => 0  
					);
					$this->db->insert('wplaty_dla_wierzycieli', $wplataDlaWierzyciela); 
					$this->db->delete('zadluzenie', array('id_zadluzenia' => $zadluzenie['id_zadluzenia']));
					$pozostalo -= $zadluzenie['suma'];
				}
				//echo "Pozostalo: +$pozostalo <br/>";
			} else {
				$pozostaloNaPriorytet = $pozostalo;
				foreach ($zadluzeniaPriorytet['zadluzenia'] as $zadluzenie) {
					//var_dump($zadluzeniaPriorytet);
					$procent = $zadluzenie['suma']/$zadluzeniaPriorytet['suma'];
					$kwota = round($pozostaloNaPriorytet * $procent,2);
					//echo "Splata tylko czesci zadluzenia $procent, $kwota<br/>";
					
					$oplata = $this->czyOplata($zadluzenie['wierzyciel']) ? round($kwota*OPLATA_KOMORNICZA,2) : 0;
                    $this->odejmijOplate($zadluzenie, $oplata);
					$kwota -= $oplata;
					$wplataDlaWierzyciela = array(
						'id_wplaty' => $wplata['id_wplaty'],
						'id_wierzyciela' => $zadluzenie['id_wierzyciela'],
						'kwota_zadluzenia' => 0,
					   	'odsetki' => 0,
					   	'koszty_egzekucyjne' => 0 ,
					   	'oplata_komornicza' => $oplata,
					   	'pozostala_kwota_zadluzenia' => $zadluzenie['pozostala_kwota_zadluzenia'],
					   	'pozostale_odsetki' => $zadluzenie['pozostale_odsetki'],
					   	'pozostale_koszty_egzekucyjne' => $zadluzenie['pozostale_koszty_egzekucyjne']
					);
					$this->zaplac('koszty_egzekucyjne', 'pozostale_koszty_egzekucyjne', $kwota, $zadluzenie, $wplataDlaWierzyciela);
					if ($kwota > 0) {
						$wspolczynnik = ($zadluzenie['pozostala_kwota_zadluzenia']+$zadluzenie['pozostale_odsetki'])/$zadluzenie['pozostala_kwota_zadluzenia'];
						$wplata_naleznosc_glowna = $kwota/$wspolczynnik;
						$wplata_odsetki = $kwota-$wplata_naleznosc_glowna;
						//var_dump($zadluzenie,$kwota,$wspolczynnik,$wplata_naleznosc_glowna,$wplata_odsetki);
						$this->zaplac('kwota_zadluzenia', 'pozostala_kwota_zadluzenia', $wplata_naleznosc_glowna, $zadluzenie, $wplataDlaWierzyciela);
						$this->zaplac('odsetki', 'pozostale_odsetki', $wplata_odsetki, $zadluzenie, $wplataDlaWierzyciela);
						//var_dump($zadluzenie,$wplataDlaWierzyciela);
						
					}
					$this->db->insert('wplaty_dla_wierzycieli', $wplataDlaWierzyciela);
					$aktualneZadluzenie = array(
						'pozostala_kwota_zadluzenia' => $zadluzenie['pozostala_kwota_zadluzenia'],
					   	'pozostale_odsetki' => $zadluzenie['pozostale_odsetki'],
					   	'pozostale_koszty_egzekucyjne' => $zadluzenie['pozostale_koszty_egzekucyjne'] 
					); 
					$this->db->update('zadluzenie', $aktualneZadluzenie, array('id_zadluzenia' => $zadluzenie['id_zadluzenia']));
					//var_dump($wplataDlaWierzyciela, $aktualneZadluzenie);
					$pozostalo -= $wplataDlaWierzyciela['kwota_zadluzenia'] + $wplataDlaWierzyciela['odsetki'] + $wplataDlaWierzyciela['koszty_egzekucyjne'] + $oplata;
					//echo "Pozostalo: +$pozostalo <br/>";
				}
				break;
			}
		}
		//echo $pozostalo;
		if ($pozostalo > 0)
			$this->db->insert('zwroty', array('id_wplaty' => $wplata['id_wplaty'], 'kwota_zwrotu' => $pozostalo));
		//exit;
	}
	
	function policzUdzial(&$wplaty) {
		$sumaKwotaOdsetki = 0;
		$sumaKosztyEgzekucyjne = 0;
		$sumaOplatyKomornicze = 0;
		foreach ($wplaty as $wplata) {
			$sumaKwotaOdsetki += $wplata['kwota_zadluzenia'] + $wplata['odsetki'];
			$sumaKosztyEgzekucyjne += $wplata['koszty_egzekucyjne'];
			$sumaOplatyKomornicze += $wplata['oplata_komornicza'];
		}
		foreach ($wplaty as &$wplata) {
			$wplata['procentKwotaOdsetki'] = $sumaKwotaOdsetki > 0 ? ($wplata['kwota_zadluzenia'] + $wplata['odsetki'])/$sumaKwotaOdsetki : 0;
			$wplata['procentKosztyEgzekucyjne'] = $sumaKosztyEgzekucyjne > 0 ? $wplata['koszty_egzekucyjne']/$sumaKosztyEgzekucyjne : 0;
			$wplata['procentOplataKomornicza'] = $sumaOplatyKomornicze > 0 ? $wplata['oplata_komornicza']/$sumaOplatyKomornicze : 0;
		}
	}
	
	function edytuj($wplata){
		$dane = array(
		   'id_dluznika' => $wplata['dluznik'],
		   'kwota_wplaty' => przygotujKwote($wplata['kwota_wplaty']),
		   'data_wplaty' => $wplata['data_wplaty'],
		);
		
		$this->db->where('id_wplaty',  $wplata['id_wplaty'])
			->update('wplaty', $dane); 
		
		$this -> session -> set_flashdata('message', 'Zmodyfikowano wpłatę');			
	}
}
?>