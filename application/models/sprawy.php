<?php
class Sprawy extends CI_Model {
	function __construct() {
		// wywołanie constructor z Model
		parent::__construct();
	}
	
	function getById($id_sprawy,$czyArchiwalna = false) {
		if (!$czyArchiwalna) {
			$this -> db -> from('sprawy s');
		} else {
			$this -> db -> from('sprawy_archiwum s');
		}
		$select = 's.*, u.nazwa as nazwa_dluznika, ud.*, u1.nazwa as nazwa_w, u1.id_users as id_users_w, ud1.ulica as ulica_w,'.
			'ud1.nr_dom as nr_dom_w, ud1.nr_lokal as nr_lokal_w, ud1.miasto as miasto_w, ud1.kod as kod_w, '.
			'ud1.nr_telefonu as nr_telefonu_w, ud1.nr_rachunku as nr_rachunku_w, '.
			'w1.id_pelnomocnika as pelnomocnik, w1.typ_stopy_procentowej, p.nazwa as nazwa_pelnomocnika,, ws.KM, ws.id_wierzyciela, kz.id_kategorii_zaspokojenia, kz.numer as nazwa_kategorii_zaspokojenia';
		$this -> db  -> select($select)
			-> join('users u', 'u.id_users = s.id_dluznika')
			-> join('users_dane ud', 'ud.id_users = u.id_users')
			-> join('wierzyciele_sprawy ws', 'ws.id_sprawy = s.id_sprawy','left') 
			-> join('wierzyciel w1', 'ws.id_wierzyciela = w1.id_wierzyciela','left')
			-> join('kategorie_zaspokojenia kz', 'w1.id_kategorii_zaspokojenia = kz.id_kategorii_zaspokojenia','left')
			-> join('users u1', 'w1.id_users = u1.id_users','left')
			-> join('users p', 'w1.id_pelnomocnika = p.id_users','left')
			-> join('users_dane ud1', 'ud1.id_users = u1.id_users','left')
			-> where('s.id_sprawy', $id_sprawy);
		$sprawy = $this -> db -> get() -> result_array();
		$wynik = array();
		foreach ($sprawy as $sprawa) {
			if (!key_exists($sprawa['id_sprawy'], $wynik)) {
				$wynik[$sprawa['id_sprawy']] = array(
					'id_sprawy' => $sprawa['id_sprawy'],
					'sygn_akt' => $sprawa['sygn_akt'],
					'nr_sprawy' => $sprawa['nr_sprawy'],
					'id_dluznika' => $sprawa['id_dluznika'],
					'nazwa_dluznika' => $sprawa['nazwa_dluznika'],
					'NIP' => $sprawa['NIP'],
					'PESEL' => $sprawa['PESEL'],
					'ulica' => $sprawa['ulica'],
					'nr_dom' => $sprawa['nr_dom'],
					'nr_lokal' => $sprawa['nr_lokal'],
					'miasto' => $sprawa['miasto'],
					'kod' => $sprawa['kod'],
					'nr_telefonu' => $sprawa['nr_telefonu'],
					'data_postanowienia' => $sprawa['data_postanowienia'],
					'data_wplywu' => $sprawa['data_wplywu'],
					'data_wezwania' => $sprawa['data_wezwania'],
					'data_odbioru' => $sprawa['data_odbioru'],
					'data_zakonczenia' => $sprawa['data_zakonczenia'],
					'przyczyna_zakonczenia' => $sprawa['przyczyna_zakonczenia'],
					'data_postanowienia_org' => $sprawa['data_postanowienia_org'],
					'data_odbioru_postanowienia_org' => $sprawa['data_odbioru_postanowienia_org'],
					'data_nadania_akt' => $sprawa['data_nadania_akt'],
					'data_odbioru_akt' => $sprawa['data_odbioru_akt'],
					'nr_telefonu' => $sprawa['nr_telefonu'],
					'wierzyciele' => array()
				);
			}
			if ($sprawa['id_wierzyciela'] && !key_exists($sprawa['id_wierzyciela'], $wynik[$sprawa['id_sprawy']]['wierzyciele'])) {
				$wynik[$sprawa['id_sprawy']]['wierzyciele'][$sprawa['id_wierzyciela']] = array(
					'id_wierzyciela' => $sprawa['id_wierzyciela'],
					'id_users_w' => $sprawa['id_users_w'],
					'nazwa_w' => $sprawa['nazwa_w'],
					'kategoria_zaspokojenia' => $sprawa['id_kategorii_zaspokojenia'],
					'nazwa_kategorii_zaspokojenia' => $sprawa['nazwa_kategorii_zaspokojenia'],
					'typ_stopy_procentowej' => $sprawa['typ_stopy_procentowej'],
					'KM' => $sprawa['KM'],
					'ulica_w' => $sprawa['ulica_w'],
					'nr_dom_w' => $sprawa['nr_dom_w'],
					'nr_lokal_w' => $sprawa['nr_lokal_w'],
					'miasto_w' => $sprawa['miasto_w'],
					'kod_w' => $sprawa['kod_w'],
					'nr_telefonu_w' => $sprawa['nr_telefonu_w'],
					'nr_rachunku_w' => $sprawa['nr_rachunku_w'],
					'pelnomocnik' => $sprawa['pelnomocnik'],
					'nazwa_pelnomocnika' => $sprawa['nazwa_pelnomocnika'],
				);
			}
		}
		return $wynik[$id_sprawy];
	}

	function przygotujSprawy ($sprawy) {
		$wynik = array();
		foreach ($sprawy as $sprawa) {
			if (!key_exists($sprawa['id_sprawy'], $wynik)) {
				$wynik[$sprawa['id_sprawy']] = array(
					'id_sprawy' => $sprawa['id_sprawy'],
					'sygn_akt' => $sprawa['sygn_akt'],
					'nr_sprawy' => $sprawa['nr_sprawy'],
					'nazwa_dluznika' => $sprawa['nazwa_dluznika'],
					'identyfikator' => $sprawa['NIP'] ? $sprawa['NIP'] : $sprawa['PESEL'],
					'NIP' => $sprawa['NIP'],
					'PESEL' => $sprawa['PESEL'],
					'ostatnia_wplata' => $sprawa['ostatnia_wplata'],
					'wierzyciele' => array()
				);
			}
			if ($sprawa['id_wierzyciela'] && !key_exists($sprawa['id_wierzyciela'], $wynik[$sprawa['id_sprawy']]['wierzyciele'])) {
				$wynik[$sprawa['id_sprawy']]['wierzyciele'][$sprawa['id_wierzyciela']] = array(
					'id_wierzyciela' => $sprawa['id_wierzyciela'],
					'id_wierzyciela' => $sprawa['id_wierzyciela'],
					'nazwa_wierzyciela' => $sprawa['nazwa_wierzyciela']
				);
			}
		}
		return $wynik;
	}
	
	function getPrzyczynyZakonczenia () {
		$przyczyny = array(
			'egzekucja aktywna' => 'egzekucja aktywna',
			'nieskuteczna egzekucja' => 'nieskuteczna egzekucja',
			'przekazanie innemu organowi' => 'przekazanie innemu organowi',
			'zaspokojenie wierzycieli' => 'zaspokojenie wierzycieli',
			'umorzenie na żądania' => 'umorzenie na żądania'
		);
		return $przyczyny;
	}
	
	function lista($where = null){	
		$this -> db -> select('s.id_sprawy, s.sygn_akt, s.nr_sprawy,u.nazwa as nazwa_dluznika, ud.NIP, ud.PESEL, '.
		'u1.id_users as id_wierzyciela, u1.nazwa as nazwa_wierzyciela, w1.id_wierzyciela, MAX(w.data_wplaty) as ostatnia_wplata',false)
			-> from('sprawy s')
			-> join('users u', 'u.id_users = s.id_dluznika')
			-> join('users_dane ud', 'ud.id_users = u.id_users')
			-> join('wplaty w', 'w.id_dluznika = u.id_users', 'left')
			-> join('wierzyciele_sprawy ws', 'ws.id_sprawy = s.id_sprawy','left')
			-> join('wierzyciel w1', 'ws.id_wierzyciela = w1.id_wierzyciela','left')
			-> join('users u1', 'w1.id_users = u1.id_users','left')
			-> group_by('s.id_sprawy, w1.id_wierzyciela');
		$this->ustawKryteria($where);
		$sprawy = $this -> db -> get() -> result_array();
		return $this->przygotujSprawy($sprawy);
	}
	
	function listaSpraw($archiwalna = false){	
		$this -> db -> select('s.id_sprawy, s.sygn_akt, s.nr_sprawy,u.nazwa')
			-> from('sprawy s')
			-> join('users u', 'u.id_users = s.id_dluznika')
			-> where('s.archiwalna',$archiwalna);
		$dane = $this -> db -> get() -> result_array();
		$sprawy = array('' => '');
		foreach ($dane as $d) {
			$sprawy[$d['id_sprawy']] = $d['nazwa'];
		}
		return $sprawy;
		
	}
	
	function ustawKryteria ($where) {
		if (isset($where['all'])) {
			$this->db->like('u.nazwa', $where['all']);
			$this->db->or_like('u1.nazwa', $where['all']);
			$this->db->or_like('s.sygn_akt', $where['all'],'after');
			$this->db->or_like('s.nr_sprawy', $where['all'],'after');
			$this->db->or_like('ud.NIP', $where['all'],'after');
			$this->db->or_like('ud.PESEL', $where['all'],'after');
		}
		if (isset($where['nazwa'])) {
			$this->db->like('u.nazwa', $where['nazwa']);
			$this->db->or_like('u1.nazwa', $where['nazwa']);
		}
		if (isset($where['sygn_akt'])) {
			$this->db->like('s.sygn_akt', $where['sygn_akt'],'after');
		}
		if (isset($where['nr_sprawy'])) {
			$this->db->like('s.nr_sprawy', $where['nr_sprawy'],'after');
		}
		if (isset($where['identyfikator'])) {
			$this->db->like('ud.NIP', $where['identyfikator'],'after');
			$this->db->or_like('ud.PESEL', $where['identyfikator'],'after');
		}
		if (isset($where['ostatnia_wplata'])) {
			$this->db->having('ostatnia_wplata <= ', $where['ostatnia_wplata']);
		}
		if (!isset($where['archiwalna']))
			$where['archiwalna'] = false;
		$this->db->where('s.archiwalna', $where['archiwalna']);
	}
	
	function dodaj($sprawa){
		$typ=$this-> users-> getTyp('dłużnik');
		$dane = array(
		   'nazwa' => $sprawa['nazwa_dluznika'],
		   'id_users_typy' => $typ['id_users_typy']
		);
		$this->db->insert('users', $dane); 
		$id_user=$this->db->insert_id();
		
		$dane = array(
		   'NIP' => $sprawa['NIP'],
		   'PESEL' => $sprawa['PESEL'],
		   'ulica' => $sprawa['ulica'],
		   'nr_dom' => $sprawa['nr_dom'],
		   'nr_lokal' => $sprawa['nr_lokal'],
		   'miasto' => $sprawa['miasto'],
		   'kod' => $sprawa['kod'],
		   'nr_telefonu' => $sprawa['nr_telefonu'],
		   'id_users' => $id_user
		);
		$this->db->insert('users_dane', $dane); 
	
		$dane = array(
		   'nr_sprawy' => $sprawa['nr_sprawy'],
		   'sygn_akt' => $sprawa['sygn_akt'],
		   'data_wplywu' => $sprawa['data_wplywu'],
		   'data_postanowienia' => $sprawa['data_postanowienia'],
		   'data_wplywu' => $sprawa['data_wplywu'],
		   'data_wezwania' => $sprawa['data_wezwania'],
		   'data_odbioru' => $sprawa['data_odbioru'],
		   'data_zakonczenia' => $sprawa['data_zakonczenia'],
		   'przyczyna_zakonczenia' => $sprawa['przyczyna_zakonczenia'],
		   'data_postanowienia_org' => $sprawa['data_postanowienia_org'],
		   'data_odbioru_postanowienia_org' => $sprawa['data_odbioru_postanowienia_org'],
		   'data_nadania_akt' => $sprawa['data_nadania_akt'],
		   'data_odbioru_akt' => $sprawa['data_odbioru_akt'],
		   'id_dluznika' => $id_user
		);
		
		$this->db->insert('sprawy', $dane); 
		$this -> session -> set_flashdata('message', 'Dodano nową sprawę');			
	}
	
	function edytuj($sprawa){
		$this->db->trans_start();
		$dane = array(
		   'nazwa' => $sprawa['nazwa_dluznika']
		);
		$this->db->where('id_users',$sprawa['id_dluznika'])
			->update('users', $dane); 
		
		$dane = array(
		   'NIP' => $sprawa['NIP'],
		   'PESEL' => $sprawa['PESEL'],
		   'ulica' => $sprawa['ulica'],
		   'nr_dom' => $sprawa['nr_dom'],
		   'nr_lokal' => $sprawa['nr_lokal'],
		   'miasto' => $sprawa['miasto'],
		   'kod' => $sprawa['kod'],
		   'nr_telefonu' => $sprawa['nr_telefonu']
		);
		$this->db->where('id_users',$sprawa['id_dluznika'])
			->update('users_dane', $dane);
			
		
		$dane = array(
		   'nr_sprawy' => $sprawa['nr_sprawy'],
		   'sygn_akt' => $sprawa['sygn_akt'],
		   'data_postanowienia' => $sprawa['data_postanowienia'],
		   'data_wplywu' => $sprawa['data_wplywu'],
		   'data_wezwania' => $sprawa['data_wezwania'],
		   'data_odbioru' => $sprawa['data_odbioru'],
		   'data_zakonczenia' => $sprawa['data_zakonczenia'],
		   'przyczyna_zakonczenia' => $sprawa['przyczyna_zakonczenia'],
		   'data_postanowienia_org' => $sprawa['data_postanowienia_org'],
		   'data_odbioru_postanowienia_org' => $sprawa['data_odbioru_postanowienia_org'],
		   'data_nadania_akt' => $sprawa['data_nadania_akt'],
		   'data_odbioru_akt' => $sprawa['data_odbioru_akt']
		);
		
		$this->db->where('id_sprawy',$sprawa['id_sprawy'])
			->update('sprawy', $dane);
			
		foreach ($sprawa['wierzyciele'] as $wierzyciel) {
			$w = array(
			   'nazwa' => $wierzyciel['nazwa_w']
			);
			$dane_w = array(
			   'ulica' => $wierzyciel['ulica_w'],
			   'nr_dom' => $wierzyciel['nr_dom_w'],
			   'nr_lokal' => $wierzyciel['nr_lokal_w'],
			   'miasto' => $wierzyciel['miasto_w'],
			   'kod' => $wierzyciel['kod_w'],
			   'nr_telefonu' => $wierzyciel['nr_telefonu_w'],
			   'nr_rachunku' => $wierzyciel['nr_rachunku_w']
			);
			$wierzyciele_sprawy = array(
				'KM' => $wierzyciel['KM']
			);
			
			$w_typ = array(
				'id_kategorii_zaspokojenia' => $wierzyciel['kategoria_zaspokojenia'],
				'typ_stopy_procentowej' => $wierzyciel['typ_stopy_procentowej'],
				'id_pelnomocnika' => $wierzyciel['pelnomocnik'],
			);
			
				
			if (isset($wierzyciel['id_wierzyciela'])) {
				$this->db->where('id_users',$wierzyciel['id_users_w'])
					->update('users', $w); 
				
				$this->db->where('id_users',$wierzyciel['id_users_w'])
					->update('users_dane', $dane_w);
				
				$this->db->where('id_wierzyciela',$wierzyciel['id_wierzyciela'])
					->update('wierzyciel', $w_typ);
				
				$where = array(
					'id_wierzyciela' => $wierzyciel['id_wierzyciela'],
					'id_sprawy' => $sprawa['id_sprawy']
				);
				$this->db->where($where)
					->update('wierzyciele_sprawy', $wierzyciele_sprawy);
			} else {
				$typ=$this-> users-> getTyp('wierzyciel');
				$w['id_users_typy'] = $typ['id_users_typy'];
				$this->db->insert('users', $w); 
				
				$dane_w['id_users']	 = $this->db->insert_id();
				$this->db->insert('users_dane', $dane_w);
				
				$w_typ['id_users'] = $dane_w['id_users'];
				$this->db->insert('wierzyciel', $w_typ);
				
				$wierzyciele_sprawy['id_wierzyciela'] = $this->db->insert_id();
				$wierzyciele_sprawy['id_sprawy'] = $sprawa['id_sprawy'];
				$this->db->insert('wierzyciele_sprawy',$wierzyciele_sprawy);
			}
		}
		$this->db->trans_complete();
		$this -> session -> set_flashdata('message', 'Zmodyfikowano sprawę');			
	}
	
	function usun($id_sprawy){
		$sprawa = $this->getById($id_sprawy);
		if ($sprawa) {
			$dane = array(
			   'archiwalna' => 1
			); 
			$this->db->where('id_sprawy',  $id_sprawy)
				->update('sprawy', $dane);  
			$this -> session -> set_flashdata('message', 'Zarchiwizowano sprawę');
		} else
			$this -> session -> set_flashdata('error', 'Brak takiej sprawy');
		
	}
	function przywroc($id_sprawy){
		$sprawa = $this->getById($id_sprawy);
		if ($sprawa) {
			$dane = array(
			   'archiwalna' => 0
			); 
			$this->db->where('id_sprawy',  $id_sprawy)
				->update('sprawy', $dane);  
			$this -> session -> set_flashdata('message', 'Przywrócono sprawę');
		} else
			$this -> session -> set_flashdata('error', 'Brak takiej sprawy');
	}
}
?>