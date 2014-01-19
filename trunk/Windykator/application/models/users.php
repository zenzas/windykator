<?php
class Users extends CI_Model {
	function __construct() {
		// wywołanie constructor z Model
		parent::__construct();
	}

	function getById($id_user) {
		$select = 'u.*, ul.login, ul.email, ul.aktywny, ut.id_users_typy, ut.nazwa as nazwa_typ, w.id_wierzyciela, w.id_kategorii_zaspokojenia as kategoria_zaspokojenia, '.
			' ud.NIP, ud.PESEL,ud.ulica, ud.nr_dom, ud.nr_lokal, '.
			' ud.miasto, ud.kod, ud.nr_telefonu, ud.nr_rachunku, ud.logowanie';
		$this -> db -> select($select)
			-> from('users u') 
			-> join('users_typy ut', 'u.id_users_typy = ut.id_users_typy') 
			-> join('users_login ul', 'u.id_users = ul.id_users','left') 
			-> join('users_dane ud', 'u.id_users = ud.id_users','left')
			-> join('wierzyciel w', 'u.id_users = w.id_users','left')
			-> where('u.id_users', $id_user);
		return $this -> db -> get() -> row_array();
	}

	function getByLogin($login) {
		$this -> db -> select('u.*, ul.*, ut.id_users_typy, ut.nazwa as nazwa_typ')
			-> from('users u') 
			-> join('users_login ul', 'u.id_users = ul.id_users') 
			-> join('users_typy ut', 'u.id_users_typy = ut.id_users_typy') 
			-> where('login', $login);
		return $this -> db -> get() -> row_array();
	}
	function getByEmail($email) {
		$this -> db -> select('u.*, ul.*, ut.id_users_typy, ut.nazwa as nazwa_typ')
			-> from('users u') 
			-> join('users_login ul', 'u.id_users = ul.id_users') 
			-> join('users_typy ut', 'u.id_users_typy = ut.id_users_typy') 
			-> where('email', $email);
		return $this -> db -> get() -> row_array();
	}
	
	function listaKont($where = null){
		$select = 'u.*, ul.login, ul.email, ul.aktywny, ut.id_users_typy, ut.nazwa as nazwa_typ, '.
			'IFNULL(ud.NIP,ud.PESEL) as identyfikator, ud.NIP, ud.PESEL,ud.ulica, ud.nr_dom, ud.nr_lokal, '.
			' ud.miasto, ud.kod, ud.nr_telefonu, ud.nr_rachunku';
		$this -> db -> select($select,false)
			-> from('users u') 
			-> join('users_typy ut', 'u.id_users_typy = ut.id_users_typy') 
			-> join('users_login ul', 'u.id_users = ul.id_users','left') 
			-> join('users_dane ud', 'u.id_users = ud.id_users','left'); 
		
		if ($this->session->userdata('nazwa_typ') != 'administrator')
			$this->db->where_not_in('ut.nazwa',array('administrator','operator'));
		else
			$this->db->where('aktywny',1);
		$this->ustawKryteria($where);
		return $this -> db -> get() -> result_array();
	}

	function listaKontDoZalozenia($where = null){
		$select = 'u.*, ut.id_users_typy, ut.nazwa as nazwa_typ, '.
			'IFNULL(ud.NIP,ud.PESEL) as identyfikator, ud.ulica, ud.nr_dom, ud.nr_lokal, ud.kod, ud.miasto';
		$this -> db -> select($select,false)
			-> from('users u') 
			-> join('users_typy ut', 'u.id_users_typy = ut.id_users_typy') 
			-> join('users_dane ud', 'u.id_users = ud.id_users','left')
			->where('logowanie',1);
		$this->ustawKryteria($where);
		return $this -> db -> get() -> result_array();
	}

	function listaKontZablokowanych($where = null){
		$select = 'u.*, ul.login, ul.email, ul.aktywny, ut.id_users_typy, ut.nazwa as nazwa_typ, '.
			'IFNULL(ud.NIP,ud.PESEL) as identyfikator, ud.NIP, ud.PESEL,ud.ulica, ud.nr_dom, ud.nr_lokal, '.
			' ud.miasto, ud.kod, ud.nr_telefonu, ud.nr_rachunku';
		$this -> db -> select($select,false)
			-> from('users u') 
			-> join('users_typy ut', 'u.id_users_typy = ut.id_users_typy') 
			-> join('users_login ul', 'u.id_users = ul.id_users','left') 
			-> join('users_dane ud', 'u.id_users = ud.id_users','left'); 
		$this->db->where('aktywny',0);
		$this->ustawKryteria($where);
		return $this -> db -> get() -> result_array();
	}
	
	function ustawKryteria ($where) {
		if ($where) {
			if (isset($where['all'])) {
				$this->db->like('u.nazwa', $where['all'],'after');
				$this->db->or_like('ud.NIP', $where['all'],'after');
				$this->db->or_like('ud.PESEL', $where['all'],'after');
				$this->db->or_like('ul.login', $where['all'],'after');	
			} 
			if (isset($where['nazwa']))
				$this->db->like('u.nazwa', $where['nazwa'],'after');
			if (isset($where['NIP']))
				$this->db->like('ud.NIP', $where['NIP'],'after');
			if (isset($where['PESEL']))
				$this->db->like('ud.PESEL', $where['PESEL'],'after');
			if (isset($where['login']))
				$this->db->like('ul.login', $where['login'],'after');	
		}
	}

	function login($login, $password) {
		
		$user = $this -> getByLogin($login);
		$result = false;
		if ($user) {
			if ($user['password'] == md5($password)) {
				if ($user['aktywny']) {
					$user_data = array();
					$user_data['id'] = $user['id_users'];
					$user_data['login'] = $user['login'];
					$user_data['nazwa'] = $user['nazwa'];
					$user_data['email'] = $user['email'];
					$user_data['id_users_typy'] = $user['id_users_typy'];
					$user_data['nazwa_typ'] = $user['nazwa_typ'];	
					
					$this->session->set_userdata($user_data);
						
					$result = true;
				} else {
					$this -> session -> set_flashdata('error', 'Nie posiadasz uprawnień do logowania');
				}

			} else {
				$this -> session -> set_flashdata('error', 'Podałeś błędne hasło');
			}
		} else {
			$this -> session -> set_flashdata('error', 'Nie ma takiego użytkownika');
		}
		return $result;
	}

	function logout() {
		$this -> session -> sess_destroy();
		$this -> session -> sess_create();
		$this -> session -> set_flashdata('message', 'Do zobaczenia');
	}
	
	function reset_hasla($login, $email) {
		$user = $this -> getByLogin($login);
		$result = false;
		if ($user) {
			if ($user['email'] == $email) {
				if ($user['aktywny']) {
					$password = generujHaslo();
                    $dane = array(
                       'password' => md5($password)
                    );
                    $this->db->where('id_users_login',  $user['id_users_login'])
                        ->update('users_login', $dane);
                    $this -> load -> model('mailer');
                    $this->mailer->sendPasswordMail($user['login'], $user['email'], $password);
                    $this -> session -> set_flashdata('message', 'Nowe hasło wysłano na adres '.$user['email']);
					$result = true;
				} else {
					$this -> session -> set_flashdata('error', 'Nie posiadasz uprawnień do logowania!!!');
				}
			} else {
				$this -> session -> set_flashdata('error', 'Podałeś nieprawidłowy e-mail!!!');
			}
		} else {
			$this -> session -> set_flashdata('error', 'Nie ma takiego użytkownika!!!');
		}
		return $result;
	}
		
	function listaTypow(){
		$dane = $this -> db -> get('users_typy') -> result_array();
		$typy = array('' => '');
		foreach ($dane as $typ) {
			if ($this->session->userdata('nazwa_typ') == 'administrator' || ($this->session->userdata('nazwa_typ') == 'operator' && $typ['nazwa'] != 'administrator' && $typ['nazwa'] != 'operator')) {
				$typy[$typ['id_users_typy']] = $typ['nazwa'];
			}
		}
		return $typy;
	}
			
	function listaWnioskodawcow(){
		$this -> db -> select('u.*')
			-> from('users u') 
			-> join('users_typy ut', 'u.id_users_typy = ut.id_users_typy')
			-> where_not_in('ut.nazwa', array('administrator', 'operator'));
		$dane = $this -> db -> get() -> result_array();
		
		
		$wnioskodawcy = array('' => '');
		foreach ($dane as $d) {
			$wnioskodawcy[$d['id_users']] = $d['nazwa'];
		}
		return $wnioskodawcy;
	}
	
	
	function listaDluznikow(){
		$this -> db -> select('u.*')
			-> from('users u') 
			-> join('users_typy ut', 'u.id_users_typy = ut.id_users_typy')
			-> where('ut.nazwa', 'dłużnik');
		$dane = $this -> db -> get() -> result_array();
		
		
		$dluznicy = array('' => '');
		foreach ($dane as $d) {
			$dluznicy[$d['id_users']] = $d['nazwa'];
		}
		return $dluznicy;
	}
	function listaPelnomocnikow(){
		$this -> db -> select('u.*')
			-> from('users u') 
			-> join('users_typy ut', 'u.id_users_typy = ut.id_users_typy')
			-> where('ut.nazwa', 'pełnomocnik');
		$dane = $this -> db -> get() -> result_array();
		
		
		$pelnomocnicy = array('' => '');
		foreach ($dane as $d) {
			$pelnomocnicy[$d['id_users']] = $d['nazwa'];
		}
		return $pelnomocnicy;
	}
	
    function listaOrganowEgzekucyjnych(){
        $this -> db -> select('u.*')
            -> from('users u') 
            -> join('users_typy ut', 'u.id_users_typy = ut.id_users_typy')
            -> where('ut.nazwa', 'organ egzekucyjny');
        $dane = $this -> db -> get() -> result_array();
        
        
        $organyEgzekucyjne = array('' => '');
        foreach ($dane as $d) {
            $organyEgzekucyjne[$d['id_users']] = $d['nazwa'];
        }
        return $organyEgzekucyjne;
    }
    
    
    
    
	function listaDluznicySprawy($sprawy){
		$dluznicy = array();
		foreach ($sprawy as $sprawa) {
			$dluznicy[$sprawa['id_sprawy']] = $sprawa['nazwa_dluznika'];
		}
		return $dluznicy;
	}
	
	function listaWierzycieleSprawy($sprawy){
		$wierzyciele = array();
		foreach ($sprawy as $sprawa) {
			foreach ($sprawa['wierzyciele'] as $wierzyciel) {
				$wierzyciele[$sprawa['id_sprawy']][$wierzyciel['id_wierzyciela']] = $wierzyciel['nazwa_wierzyciela'];
			}
		}
		return $wierzyciele;
	}

	function getTyp($nazwa){
		$this -> db -> from('users_typy') 
			-> where('nazwa',$nazwa);
		return $this -> db -> get() -> row_array();
	}
	
	function dodaj($user){
		$dane = array(
		   'nazwa' => $user['nazwa'] ,
		   'id_users_typy' => $user['typ']
		);
		$this->db->insert('users', $dane); 
		$id_user=$this->db->insert_id();
		$typ = $this->getTyp('wierzyciel');
		if ($user['typ'] == $typ['id_users_typy']) {
			$dane = array(
			   'id_kategorii_zaspokojenia' => $user['kategoria_zaspokojenia'],
			   'id_users' =>$id_user
			);
			$this->db->insert('wierzyciel', $dane); 
		}
		
		if ($this->session->userdata('nazwa_typ') == 'administrator') {
			$this->zaloz($user);
		} else if ($this->session->userdata('nazwa_typ') == 'operator') {
			$dane = array(
			   'NIP' => $user['NIP'],
			   'PESEL' => $user['PESEL'],
			   'ulica' => $user['ulica'],
			   'nr_dom' => $user['nr_dom'],
			   'nr_lokal' => $user['nr_lokal'],
			   'miasto' => $user['miasto'],
			   'kod' => $user['kod'],
			   'nr_telefonu' => $user['nr_telefonu'],
			   'nr_rachunku' => $user['nr_rachunku'],
			   'logowanie' => $user['logowanie'],
			   'id_users' => $id_user
			);
			$this->db->insert('users_dane', $dane); 
		}
		
		$this -> session -> set_flashdata('message', 'Dodano nowego użytkownika');			
	}

	function zaloz($user){
	    $password = generujHaslo();
        $dane = array(
           'login' => $user['login'] ,
           'password' => md5($password),
           'email' => $user['email'] ,
           'aktywny' => 1,
           'id_users' =>$id_user
        );
        $this->db->insert('users_login', $dane);
        $this -> load -> model('mailer');
        $this->mailer->createAccountPasswordMail($user['login'], $user['email'], $password);
        $this -> session -> set_flashdata('message', 'Założono konto użytkownika. Nowe hasło wysłano na adres '.$user['email']);			
	}
	
	function edytuj($user){
		$u = $this->getById($user['id_user']);
		//var_dump($u);exit;
		$dane = array(
		   'nazwa' => $user['nazwa'] ,
		   'id_users_typy' => $user['typ']
		);
		$this->db->where('id_users',  $user['id_user'])
			->update('users', $dane); 
		$typ = $this->getTyp('wierzyciel');
		if ($user['typ'] == $typ['id_users_typy']) {
			$dane = array(
			   'id_kategorii_zaspokojenia' => $user['kategoria_zaspokojenia'],
			   'id_users' =>$user['id_user']
			);
			if ($u['id_users_typy'] == $typ['id_users_typy']) {
				$this->db->where('id_users',  $user['id_user'])
					->update('wierzyciel', $dane); 
			} else {
				$this->db->insert('wierzyciel', $dane); 
			}
			
		} else if ($u['id_users_typy'] == $typ['id_users_typy']) {
			$this->db->where('id_users', $user['id_user'])
				->delete('wierzyciel');
		}
		if ($this->session->userdata('nazwa_typ') == 'administrator') {
			$dane = array(
			   'login' => $user['login'] ,
			   'email' => $user['email'] ,
			);
			$this->db->where('id_users',  $user['id_user'])
				->update('users_login', $dane); 
		} else if ($this->session->userdata('nazwa_typ') == 'operator') {
			$dane = array(
			   'NIP' => $user['NIP'],
			   'PESEL' => $user['PESEL'],
			   'ulica' => $user['ulica'],
			   'nr_dom' => $user['nr_dom'],
			   'nr_lokal' => $user['nr_lokal'],
			   'miasto' => $user['miasto'],
			   'kod' => $user['kod'],
			   'nr_telefonu' => $user['nr_telefonu'],
			   'nr_rachunku' => $user['nr_rachunku'],
			   'logowanie' => $user['logowanie']
			);
			$this->db->where('id_users',  $user['id_user'])
				->update('users_dane', $dane); 
		}
		$this -> session -> set_flashdata('message', 'Zmodyfikowano dane użytkownika');			
	}
	
	function usun($id_user){
		$user = $this->getById($id_user);
		if ($user) {
			$dane = array(
			   'aktywny' => 0
			); 
			$this->db->where('id_users',  $id_user)
				->update('users_login', $dane); 
			$this -> session -> set_flashdata('message', 'Usunięto użytkownika '.$user['login']);
		} else
			$this -> session -> set_flashdata('error', 'Brak takiego użytkownika');
		
	}
	function przywroc($id_user){
		$user = $this->getById($id_user);
		if ($user) {
			$dane = array(
			   'aktywny' => 1
			); 
			$this->db->where('id_users',  $id_user)
				->update('users_login', $dane); 
			$this -> session -> set_flashdata('message', 'Przywrócono użytkownika '.$user['login']);
		} else
			$this -> session -> set_flashdata('error', 'Brak takiego użytkownika');
		
	}
}
?>