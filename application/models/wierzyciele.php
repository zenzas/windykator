<?php
class Wierzyciele extends CI_Model {
	function __construct() {
		// wywołanie constructor z Model
		parent::__construct();
	}
	
	function getById($id_wierzyciela) {
		$select = 'u.*, w.*, ud.*, u1.nazwa as nazwa_pelnomocnika, ud1.ulica as ulica_pelnomocnika, '.
		'ud1.nr_dom as nr_dom_pelnomocnika, ud1.nr_lokal as nr_lokal_pelnomocnika, '.
		'ud1.kod as kod_pelnomocnika, ud1.miasto as miasto_pelnomocnika, ud1.nr_telefonu as nr_telefonu_pelnomocnika';
		$this -> db -> select($select)
			-> from('wierzyciel w') 
			-> join('users u', 'w.id_users = u.id_users')
			-> join('users_dane ud', 'u.id_users = ud.id_users')
			-> join('users u1', 'w.id_pelnomocnika = u1.id_users','left')
			-> join('users_dane ud1', 'u1.id_users = ud1.id_users','left')
			-> where('w.id_wierzyciela', $id_wierzyciela);
		return $this -> db -> get() -> row_array();
	}
    
    function getWierzycielWSprawie($id_wierzyciele_sprawy) {
        $select = 'u.*, z.*, z.data as data_zadluzenia, w.*, ws.tytul_wykonawczy, ud.*, '.
        'u1.nazwa as nazwa_pelnomocnika, ud1.ulica as ulica_pelnomocnika, '.
        'ud1.nr_dom as nr_dom_pelnomocnika, ud1.nr_lokal as nr_lokal_pelnomocnika, '.
        'ud1.kod as kod_pelnomocnika, ud1.miasto as miasto_pelnomocnika, ud1.nr_telefonu as nr_telefonu_pelnomocnika, '.
        's.data_wplywu, u2.nazwa as nazwa_dluznika, IFNULL(ud2.NIP, ud2.PESEL) as identyfikator_dluznika';
        $this -> db -> select($select,false)
            -> from('wierzyciele_sprawy ws') 
            -> join('zadluzenie z', 'ws.id_wierzyciele_sprawy = z.id_wierzyciele_sprawy')
            -> join('wierzyciel w', 'ws.id_wierzyciela = w.id_wierzyciela')
            -> join('users u', 'w.id_users = u.id_users')
            -> join('users_dane ud', 'u.id_users = ud.id_users')
            -> join('users u1', 'w.id_pelnomocnika = u1.id_users','left')
            -> join('users_dane ud1', 'u1.id_users = ud1.id_users','left')
            -> join('sprawy s', 'ws.id_sprawy = s.id_sprawy')
            -> join('users u2', 's.id_dluznika = u2.id_users')
            -> join('users_dane ud2', 'u2.id_users = ud2.id_users')
            -> where('ws.id_wierzyciele_sprawy', $id_wierzyciele_sprawy);
        return $this -> db -> get() -> row_array();
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
		   'sygn_akt' => $sprawa['sygn_akt'],
		   'data_wplywu' => $sprawa['data_wplywu'],
		   'data_postanowienia' => $sprawa['data_postanowienia'],
		   'id_dluznika' => $id_user
		);
		
		$this->db->insert('sprawy', $dane); 
		$this -> session -> set_flashdata('message', 'Dodano nową sprawę');			
	}
	
	function edytuj($sprawa){
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
			
		$w = array(
		   'nazwa' => $sprawa['nazwa_w']
		);
		$dane_w = array(
		   'ulica' => $sprawa['ulica_w'],
		   'nr_dom' => $sprawa['nr_dom_w'],
		   'nr_lokal' => $sprawa['nr_lokal_w'],
		   'miasto' => $sprawa['miasto_w'],
		   'kod' => $sprawa['kod_w'],
		   'nr_telefonu' => $sprawa['nr_telefonu_w'],
		   'nr_rachunku' => $sprawa['nr_rachunku_w']
		);
		$wierzyciele_sprawy = array(
			'KM' => $sprawa['KM']
		);
			
		if ($sprawa['id_wierzyciela']) {
			$this->db->where('id_users',$sprawa['id_wierzyciela'])
				->update('users', $w); 
			$this->db->where('id_users',$sprawa['id_wierzyciela'])
				->update('users_dane', $dane_w);
			$where = array(
				'id_wierzyciela' => $sprawa['id_wierzyciela'],
				'id_sprawy' => $sprawa['id_sprawy']
			);
			$this->db->where($where)
				->update('wierzyciele_sprawy', $wierzyciele_sprawy);
		} else {
			$typ=$this-> users-> getTyp('dłużnik');
			$w['id_users_typy'] = $typ['id_users_typy'];
			$this->db->insert('users', $w); 
			$dane_w['id_users']	 = $this->db->insert_id();
			$this->db->insert('users_dane', $dane_w);
			$wierzyciele_sprawy['id_sprawy'] = $sprawa['id_sprawy'];
			$wierzyciele_sprawy['id_wierzyciela'] = $dane_w['id_users'];
			$this->db->insert('wierzyciele_sprawy',$wierzyciele_sprawy);
		}
			
		$dane = array(
		   'sygn_akt' => $sprawa['sygn_akt'],
		   'nr_sprawy' => $sprawa['nr_sprawy']
		);
		
		$this->db->where('id_sprawy',$sprawa['id_sprawy'])
			->update('sprawy', $dane);
		$this -> session -> set_flashdata('message', 'Zmodyfikowano sprawę');			
	}

	function znajdzMaxId ($wierzyciele) {
		//var_dump($wierzyciele);
		$max = 0;
		foreach ($wierzyciele as $wierzyciel) {
			if (isset($wierzyciel['id_wierzyciela']) && $wierzyciel['id_wierzyciela'] > $max)
				$max = $wierzyciel['id_wierzyciela'];
		}
		return $max;
	}
	
	function listaKategoriiZaspokojenia(){
		$dane = $this -> db -> get('kategorie_zaspokojenia') -> result_array();
		$kategorie = array();
		foreach ($dane as $kategoria) {
			$kategorie[$kategoria['id_kategorii_zaspokojenia']] = $kategoria['numer'];
		}
		return $kategorie;
	}
}
?>