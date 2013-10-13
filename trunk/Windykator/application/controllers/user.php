<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class User extends MY_Controller {
	protected $fields = array('nazwa',/*'typ',*/'typ_wierzyciel','login','email','NIP',
	    'PESEL','ulica','nr_dom','nr_lokal','miasto','kod','nr_telefonu','nr_rachunku','logowanie','logowanie');

	function aktualnosci() {
		$this -> load -> model('wnioski');
		$this -> load -> model('sprawy');
		$data['pilne'] = true;
		$date = new DateTime();
		$date->sub(new DateInterval('P'.PILNY_WNIOSEK.'D'));
		$data['wnioski'] = $this -> wnioski -> lista(array('data_odpowiedzi' => null, 'data_wplywu' => $date->format('Y-m-d')));
		$date = new DateTime();
		$date->sub(new DateInterval('P'.ILE_DNI_BEZ_WPLATY.'D'));
		$data['sprawy'] = $this -> sprawy -> lista(array('ostatnia_wplata' => $date->format('Y-m-d')));
		$data['content'] = $this -> load -> view('user/aktualnosci', $data, true);
		$this -> load -> view('index', $data);
	}

	function zarzadzanie() {
		if ($this -> input -> post('szukaj')) {
			$fraza = $this -> input -> post('szukany');
			$kryterium = $this -> input -> post('kryterium');
			if (!$this -> form_validation -> run('wyszukiwanie')) {
				$this -> session -> set_flashdata('error', 'Musisz podać fraze i kryterium!!!');
				redirect('user/zarzadzanie');
			} else {
				$where = array($kryterium => $fraza);
			    $data['users'] = $this -> users -> listaKont($where);
			}
		} else {
			$data['users'] = $this -> users -> listaKont();
		}
		$data['content'] = $this -> load -> view('user/zarzadzanie', $data, true);
		$this -> load -> view('index', $data);
	}

	function do_zalozenia() {
		if ($this -> input -> post('szukaj')) {
			$fraza = $this -> input -> post('szukany');
			$kryterium = $this -> input -> post('kryterium');
			if (!$this -> form_validation -> run('wyszukiwanie')) {
				$this -> session -> set_flashdata('error', 'Musisz podać fraze i kryterium!!!');
				redirect('user/zarzadzanie');
			} else {
				$where = array($kryterium => $fraza);
			    $data['users'] = $this -> users -> listaKontDoZalozenia($where);
			}
		} else {
			$data['users'] = $this -> users -> listaKontDoZalozenia();
		}
		$data['content'] = $this -> load -> view('user/zarzadzanie', $data, true);
		$this -> load -> view('index', $data);
	}
	
	function zablokowani() {
		if ($this -> input -> post('szukaj')) {
			$fraza = $this -> input -> post('szukany');
			$kryterium = $this -> input -> post('kryterium');
			if (!$this -> form_validation -> run('wyszukiwanie')) {
				$this -> session -> set_flashdata('error', 'Musisz podać fraze i kryterium!!!');
				redirect('user/zarzadzanie');
			} else {
				$where = array($kryterium => $fraza);
			    $data['users'] = $this -> users -> listaKontZablokowanych($where);
			}
		} else {
			$data['users'] = $this -> users -> listaKontZablokowanych();
		}
		$data['content'] = $this -> load -> view('user/zarzadzanie', $data, true);
		$this -> load -> view('index', $data);
	}

	function login() {
		if ($this -> input -> post('submit')) {
			$login = $this -> input -> post('username');
			$password = $this -> input -> post('password');
			if (!$this -> form_validation -> run('login')) {
				$this -> session -> set_flashdata('error', 'Musisz podać swój login i hasło!!!');
				redirect('user/login');
			} else if ($this -> users -> login($login, $password)) {
				redirect('user/aktualnosci');
			} else {
			    redirect('user/login');
			}
		} else {
    		$data['content'] = $this -> load -> view('user/login', null, true);
    		$this -> load -> view('index', $data);
        }
	}

	function logout() {
		$this -> users -> logout();
		redirect('');
	}

	function reset_hasla() {
		if ($this -> input -> post('submit')) {
			$login = $this -> input -> post('username');
			$email = $this -> input -> post('email');
			if (!$this -> form_validation -> run('reset_hasla')) {
				$this -> session -> set_flashdata('error', 'Musisz podać swój login i e-mail!!!');
				redirect('user/reset_hasla');
			} else if ($this -> users -> reset_hasla($login, $email)) {
				redirect('user/login');
			} else {
			    redirect('user/reset_hasla');
			}
		}
		$data['content'] = $this -> load -> view('user/reset_hasla', null, true);
		$this -> load -> view('index', $data);
	}

	function podglad($id_user) {
		if ($id_user) {
			$user = $this -> users -> getById($id_user);
			if ($user) {
				$data['user'] = $user;
				$data['content'] = $this -> load -> view('user/podglad', $data, true);
				$this -> load -> view('index', $data);
			} else {
				$this -> session -> set_flashdata('error', 'W bazie nie ma takiego użytkownika!!!');
				redirect('user/zarzadzanie');
			}
		} else {
			$this -> session -> set_flashdata('error', 'Musisz wybrać użytkownika!!!');
			redirect('user/zarzadzanie');
		}

	}

	function dodaj() {
		$typ_usera = $this -> session -> userdata('nazwa_typ');
			$data['user']['typ'] = $this -> input -> post('typ') ? $this -> input -> post('typ') : '';
		/*
		
		
		$data['user']['nazwa'] = $this -> input -> post('nazwa') ? $this -> input -> post('nazwa') : '';
	
		$data['user']['typ_wierzyciel'] = $this -> input -> post('typ_wierzyciel') ? $this -> input -> post('typ_wierzyciel') : '';
		if ($typ_usera == 'administrator') {
			$data['user']['login'] = $this -> input -> post('login') ? $this -> input -> post('login') : '';
			$data['user']['email'] = $this -> input -> post('email') ? $this -> input -> post('email') : '';
		} else if ($typ_usera == 'operator') {
			$data['user']['NIP'] = $this -> input -> post('NIP') ? $this -> input -> post('NIP') : '';
			$data['user']['PESEL'] = $this -> input -> post('PESEL') ? $this -> input -> post('PESEL') : '';
			$data['user']['ulica'] = $this -> input -> post('ulica') ? $this -> input -> post('ulica') : '';
			$data['user']['nr_dom'] = $this -> input -> post('nr_dom') ? $this -> input -> post('nr_dom') : '';
			$data['user']['nr_lokal'] = $this -> input -> post('nr_lokal') ? $this -> input -> post('nr_lokal') : '';
			$data['user']['miasto'] = $this -> input -> post('miasto') ? $this -> input -> post('miasto') : '';
			$data['user']['kod'] = $this -> input -> post('kod') ? $this -> input -> post('kod') : '';
			$data['user']['nr_telefonu'] = $this -> input -> post('nr_telefonu') ? $this -> input -> post('nr_telefonu') : '';
			$data['user']['nr_rachunku'] = $this -> input -> post('nr_rachunku') ? $this -> input -> post('nr_rachunku') : '';
			$data['user']['logowanie'] = $this -> input -> post('logowanie') ? $this -> input -> post('logowanie') : 0;
			
		}*/
       

		$this->_prepareData($data['user']);
		
		
		if ($this -> input -> post('submit') && $this -> form_validation -> run('dodaj_user_' . $typ_usera)) {
			$this -> users -> dodaj($data['user']);
			redirect('user/zarzadzanie');
		}
		$data['typy'] = $this -> users -> listaTypow();
		$data['typyWierzycieli'] = $this -> users -> listaTypowWierzycieli();
		$data['content'] = $this -> load -> view('user/dodaj', $data, true);
		$this -> load -> view('index', $data);
	}

	function zaloz($id_user) {
		$typ_usera = $this -> session -> userdata('nazwa_typ');
		if ($typ_usera == 'administrator') {
			if ($id_user) {
				$user = $this -> users -> getById($id_user);
				if ($user) {
					$data['user']['id_user'] = $id_user;
					$data['user']['nazwa'] = $user['nazwa'];
					$data['user']['login'] = $this -> input -> post('login') ? $this -> input -> post('login') : $user['login'];
					$data['user']['email'] = $this -> input -> post('email') ? $this -> input -> post('email') : $user['email'];

					if ($this -> input -> post('submit') && $this -> form_validation -> run('zaloz_user')) {
						$this -> users -> zaloz($data['user']);
						redirect('user/zarzadzanie');
					}
					$data['content'] = $this -> load -> view('user/zaloz', $data, true);
					$this -> load -> view('index', $data);
				} else {
					$this -> session -> set_flashdata('error', 'W bazie nie ma takiego użytkownika!!!');
					redirect('user/zarzadzanie');
				}
			} else {
				$this -> session -> set_flashdata('error', 'Musisz wybrać użytkownika!!!');
				redirect('user/zarzadzanie');
			}
		} else {
			$this -> session -> set_flashdata('error', 'Aby założyć konto musisz posiadać uprawnienia administratora!!!');
			redirect('user/zarzadzanie');
		}
	}

	function edytuj($id_user) {
		$typ_usera = $this -> session -> userdata('nazwa_typ');
		if ($id_user) {
			$user = $this -> users -> getById($id_user);
			if ($user) {
				$data['user']['id_user'] = $id_user;
				$data['user']['typ'] = $this -> input -> post('typ') ? $this -> input -> post('typ') : $user['id_users_typy'];
				/*
				$data['user']['nazwa'] = $this -> input -> post('nazwa') ? $this -> input -> post('nazwa') : $user['nazwa'];
				$data['user']['typ_wierzyciel'] = $this -> input -> post('typ_wierzyciel') ? $this -> input -> post('typ_wierzyciel') : $user['typ_wierzyciel'];
				if ($typ_usera == 'administrator') {
					$data['user']['login'] = $this -> input -> post('login') ? $this -> input -> post('login') : $user['login'];
					$data['user']['email'] = $this -> input -> post('email') ? $this -> input -> post('email') : $user['email'];
				} else if ($typ_usera == 'operator') {
					$data['user']['NIP'] = $this -> input -> post('NIP') ? $this -> input -> post('NIP') : $user['NIP'];
					$data['user']['PESEL'] = $this -> input -> post('PESEL') ? $this -> input -> post('PESEL') : $user['PESEL'];
					$data['user']['ulica'] = $this -> input -> post('ulica') ? $this -> input -> post('ulica') : $user['ulica'];
					$data['user']['nr_dom'] = $this -> input -> post('nr_dom') ? $this -> input -> post('nr_dom') : $user['nr_dom'];
					$data['user']['nr_lokal'] = $this -> input -> post('nr_lokal') ? $this -> input -> post('nr_lokal') : $user['nr_lokal'];
					$data['user']['miasto'] = $this -> input -> post('miasto') ? $this -> input -> post('miasto') : $user['miasto'];
					$data['user']['kod'] = $this -> input -> post('kod') ? $this -> input -> post('kod') : $user['kod'];
					$data['user']['nr_telefonu'] = $this -> input -> post('nr_telefonu') ? $this -> input -> post('nr_telefonu') : $user['nr_telefonu'];
					$data['user']['nr_rachunku'] = $this -> input -> post('nr_rachunku') ? $this -> input -> post('nr_rachunku') : $user['nr_rachunku'];
					$data['user']['logowanie'] = $this -> input -> post('logowanie') ? $this -> input -> post('logowanie') : $user['logowanie'];
				}
				 */
				
				$this->_prepareData($data['user'],$user);
				
				if ($this -> input -> post('submit') && $this -> form_validation -> run('dodaj_user_' . $typ_usera)) {
					$this -> users -> edytuj($data['user']);
					redirect('user/zarzadzanie');
				}
				$data['typy'] = $this -> users -> listaTypow();
				$data['typyWierzycieli'] = $this -> users -> listaTypowWierzycieli();
				$data['content'] = $this -> load -> view('user/edytuj', $data, true);
				$this -> load -> view('index', $data);
			} else {
				$this -> session -> set_flashdata('error', 'W bazie nie ma takiego użytkownika!!!');
				redirect('user/zarzadzanie');
			}
		} else {
			$this -> session -> set_flashdata('error', 'Musisz wybrać użytkownika!!!');
			redirect('user/zarzadzanie');
		}

	}
	function usun($id_user) {
		if ($id_user) {
			if ($id_user != $this -> session -> userdata('id'))
				$this -> users -> usun($id_user);
			else {
				$this -> session -> set_flashdata('error', 'Nie możesz usunąć samego siebie!!!');
			}
		} else {
			$this -> session -> set_flashdata('error', 'Musisz wybrać użytkownika!!!');
		}
		redirect('user/zarzadzanie');
	}
	function przywroc($id_user) {
		if ($id_user) {
			$this -> users -> przywroc($id_user);
		} else {
			$this -> session -> set_flashdata('error', 'Musisz wybrać użytkownika!!!');
		}
		redirect('user/zarzadzanie');
	}



	function _sprawdz_login($login) {
		if (!$this -> input -> post('id_user') && $this -> users -> getByLogin($login)) {
			$this -> form_validation -> set_message('_sprawdz_login', 'Użytkownik o podanym loginie już istnieje!!');
			return false;
		} else {
			return true;
		}
	}

	function _sprawdz_email($email) {
		if (!$this -> input -> post('id_user') && $this -> users -> getByEmail($email)) {
			$this -> form_validation -> set_message('_sprawdz_email', 'Użytkownik o podanym e-mailu już istnieje!!');
			return false;
		} else {
			return true;
		}
	}
	
	function _sprawdz_identyfikator($identyfikator) {
		if (!$this -> input -> post('NIP') && !$this -> input -> post('PESEL')) {
			$this -> form_validation -> set_message('_sprawdz_identyfikator', 'Musisz podać NIP lub PESEL!!');
			return false;
		} else {
			return true;
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
