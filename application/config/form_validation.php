<?php

$config = array(
	'login' => array(
		array(
			'field' => 'username',
			'label' => 'Nazwa użytkownika',
			'rules' => 'required'
		),
		array(
			'field' => 'password',
			'label' => 'Hasło',
			'rules' => 'required'
		)
	),
	'reset_hasla' => array(
		array(
			'field' => 'username',
			'label' => 'Nazwa użytkownika',
			'rules' => 'required'
		),
		array(
			'field' => 'email',
			'label' => 'E-mail',
			'rules' => 'required'
		)
	),
	'wyszukiwanie' => array(
		array(
			'field' => 'szukany',
			'label' => 'Fraza',
			'rules' => 'required'
		),
		array(
			'field' => 'kryterium',
			'label' => 'Kryterium',
			'rules' => 'required'
		)
	),
	'dodaj_user_administrator' => array(
		array(
			'field' => 'login',
			'label' => 'Login',
			'rules' => 'trim|required|min_length[6]|max_length[20]|callback__sprawdz_login'
		),
		array(
			'field' => 'typ',
			'label' => 'Typ użytkownika',
			'rules' => 'required'
		),
		array(
			'field' => 'nazwa',
			'label' => 'Nazwa',
			'rules' => 'trim|required|min_length[3]'
		),
		array(
			'field' => 'email',
			'label' => 'E-mail',
			'rules' => 'trim|required|valid_email|callback__sprawdz_email'
		)
	),
	'zaloz_user' => array(
		array(
			'field' => 'login',
			'label' => 'Login',
			'rules' => 'trim|required|min_length[6]|max_length[20]|callback__sprawdz_login'
		),
		array(
			'field' => 'email',
			'label' => 'E-mail',
			'rules' => 'trim|required|valid_email|callback__sprawdz_email'
		)
	),
	'dodaj_user_operator' => array(
		array(
			'field' => 'nazwa',
			'label' => 'Nazwa',
			'rules' => 'trim|required|min_length[3]'
		),
		array(
			'field' => 'typ',
			'label' => 'Typ użytkownika',
			'rules' => 'required'
		),
		array(
			'field' => 'NIP',
			'label' => 'NIP',
			'rules' => 'trim|min_length[10]|max_length[10]|callback__sprawdz_identyfikator'
		),
		array(
			'field' => 'PESEL',
			'label' => 'PESEL',
			'rules' => 'trim|min_length[11]|max_length[11]|callback__sprawdz_identyfikator'
		),
		array(
			'field' => 'ulica',
			'label' => 'Ulica',
			'rules' => 'trim|required|min_length[3]'
		),
		array(
			'field' => 'nr_dom',
			'label' => 'Nr domu',
			'rules' => 'trim|required'
		),
		array(
			'field' => 'nr_lokal',
			'label' => 'Nr lokalu',
			'rules' => 'trim'
		),
		array(
			'field' => 'miasto',
			'label' => 'Miasto',
			'rules' => 'trim|required|min_length[3]'
		),
		array(
			'field' => 'kod',
			'label' => 'Kod pocztowy',
			'rules' => 'trim|required|min_length[6]|max_length[6]'
		),
		array(
			'field' => 'nr_telefonu',
			'label' => 'Nr telefonu',
			'rules' => 'trim|min_length[9]|max_length[9]'
		),
		array(
			'field' => 'nr_rachunku',
			'label' => 'Nr rachunku',
			'rules' => 'trim|min_length[26]|max_length[26]'
		)
	),
	'dodaj_pelnomocnika' => array(
		array(
			'field' => 'nazwa',
			'label' => 'Nazwa',
			'rules' => 'trim|min_length[3]'
		),
		array(
			'field' => 'typ',
			'label' => 'Typ użytkownika',
			'rules' => 'required'
		),
		array(
			'field' => 'NIP',
			'label' => 'NIP',
			'rules' => 'trim'
		),
		array(
			'field' => 'PESEL',
			'label' => 'PESEL',
			'rules' => 'trim'
		),
		array(
			'field' => 'ulica',
			'label' => 'Ulica',
			'rules' => 'trim|min_length[3]'
		),
		array(
			'field' => 'nr_dom',
			'label' => 'Nr domu',
			'rules' => 'trim'
		),
		array(
			'field' => 'nr_lokal',
			'label' => 'Nr lokalu',
			'rules' => 'trim'
		),
		array(
			'field' => 'miasto',
			'label' => 'Miasto',
			'rules' => 'trim|min_length[3]'
		),
		array(
			'field' => 'kod',
			'label' => 'Kod pocztowy',
			'rules' => 'trim|min_length[6]|max_length[6]'
		),
		array(
			'field' => 'nr_telefonu',
			'label' => 'Nr telefonu',
			'rules' => 'trim|min_length[9]|max_length[9]'
		),
	),
	'dodaj_sprawe' => array(
		array(
			'field' => 'sygn_akt',
			'label' => 'Sygn. akt',
			'rules' => 'trim|min_length[7]|max_length[15]'
		),
		array(
			'field' => 'nr_sprawy',
			'label' => 'Nr sprawy',
			'rules' => 'trim|min_length[8]|max_length[10]'
		),
		array(
			'field' => 'NIP',
			'label' => 'NIP',
			'rules' => 'trim|min_length[10]|max_length[10]|callback__sprawdz_identyfikator'
		),
		array(
			'field' => 'PESEL',
			'label' => 'PESEL',
			'rules' => 'trim|min_length[11]|max_length[11]|callback__sprawdz_identyfikator'
		),
		array(
			'field' => 'nazwa_dluznika',
			'label' => 'Nazwa dłużnika',
			'rules' => 'trim|required|min_length[3]'
		),
		array(
			'field' => 'ulica',
			'label' => 'Ulica',
			'rules' => 'trim|required|min_length[3]'
		),
		array(
			'field' => 'nr_dom',
			'label' => 'Nr domu',
			'rules' => 'trim|required'
		),
		array(
			'field' => 'nr_lokal',
			'label' => 'Nr lokalu',
			'rules' => 'trim'
		),
		array(
			'field' => 'miasto',
			'label' => 'Miasto',
			'rules' => 'trim|required|min_length[3]'
		),
		array(
			'field' => 'kod',
			'label' => 'Kod pocztowy',
			'rules' => 'trim|required|min_length[6]|max_length[6]'
		),
		array(
			'field' => 'nr_telefonu',
			'label' => 'Nr telefonu',
			'rules' => 'trim|min_length[9]|max_length[9]'
		),
		array(
			'field' => 'data_postanowienia',
			'label' => 'Data postanowienia',
			'rules' => 'trim|required|min_length[8]'
		),
		array(
			'field' => 'data_wplywu',
			'label' => 'Data wpływu postanowienia',
			'rules' => 'trim|required|min_length[8]'
		)
	),
	'edytuj_sprawe' => array(
		array(
			'field' => 'sygn_akt',
			'label' => 'Sygn. akt',
			'rules' => 'trim|min_length[7]|max_length[15]'
		),
		array(
			'field' => 'nr_sprawy',
			'label' => 'Nr sprawy',
			'rules' => 'trim|min_length[8]|max_length[10]'
		),
		array(
			'field' => 'NIP',
			'label' => 'NIP',
			'rules' => 'trim|min_length[10]|max_length[10]|callback__sprawdz_identyfikator'
		),
		array(
			'field' => 'PESEL',
			'label' => 'PESEL',
			'rules' => 'trim|min_length[11]|max_length[11]|callback__sprawdz_identyfikator'
		),
		array(
			'field' => 'nazwa_dluznika',
			'label' => 'Nazwa dłużnika',
			'rules' => 'trim|required|min_length[3]'
		),
		array(
			'field' => 'ulica',
			'label' => 'Ulica',
			'rules' => 'trim|required|min_length[3]'
		),
		array(
			'field' => 'nr_dom',
			'label' => 'Nr domu',
			'rules' => 'trim|required'
		),
		array(
			'field' => 'nr_lokal',
			'label' => 'Nr lokalu',
			'rules' => 'trim'
		),
		array(
			'field' => 'miasto',
			'label' => 'Miasto',
			'rules' => 'trim|required|min_length[3]'
		),
		array(
			'field' => 'kod',
			'label' => 'Kod pocztowy',
			'rules' => 'trim|required|min_length[6]|max_length[6]'
		),
		array(
			'field' => 'nr_telefonu',
			'label' => 'Nr telefonu',
			'rules' => 'trim|min_length[9]|max_length[9]'
		),
		array(
			'field' => 'data_postanowienia',
			'label' => 'Data postanowienia',
			'rules' => 'trim|required|min_length[8]'
		),
		array(
			'field' => 'data_wplywu',
			'label' => 'Data wpływu postanowienia',
			'rules' => 'trim|required|min_length[8]'
		),
	),
	'dodaj_wniosek' => array(
		array(
			'field' => 'wnioskodawca',
			'label' => 'Wnioskodawca',
			'rules' => 'required'
		),
		array(
			'field' => 'sprawa',
			'label' => 'Sprawa',
			'rules' => 'required'
		),
		array(
			'field' => 'opis_wniosku',
			'label' => 'Opis wniosku',
			'rules' => 'trim|required'
		),
		array(
			'field' => 'data_wplywu',
			'label' => 'Data wplywu',
			'rules' => 'trim|required'
		),
	),
	'dodaj_wplata' => array(
		array(
			'field' => 'dluznik',
			'label' => 'Dłużnik',
			'rules' => 'required'
		),
		array(
			'field' => 'kwota_wplaty',
			'label' => 'Kwota wpłaty',
			'rules' => 'required'
		),
		array(
			'field' => 'data_wplaty',
			'label' => 'Data wplaty',
			'rules' => 'trim|required'
		),
	),
	'dodaj_stopa' => array(
		array(
			'field' => 'referencyjna',
			'label' => 'referencyjna',
			'rules' => 'trim'
		),
		array(
			'field' => 'lombardowa',
			'label' => 'lombardowa',
			'rules' => 'trim'
		),
		array(
			'field' => 'podatkowa',
			'label' => 'podatkowa',
			'rules' => 'trim|callback__sprawdz_stopy'
		),
		array(
			'field' => 'data_od',
			'label' => 'Data od',
			'rules' => 'trim|required'
		),
	),
	'dodaj_zadluzenie' => array(
		array(
			'field' => 'dluznik',
			'label' => 'Dłużnik',
			'rules' => 'required'
		),
		array(
			'field' => 'wierzyciel',
			'label' => 'Wierzyciel',
			'rules' => 'required'
		),
		array(
			'field' => 'data',
			'label' => 'Data',
			'rules' => 'required'
		),
		array(
			'field' => 'kwota_zadluzenia',
			'label' => 'Kwota zadłużenia',
			'rules' => 'trim'
		),
		array(
			'field' => 'odsetki',
			'label' => 'Kwota odsetek',
			'rules' => 'trim'
		),
		array(
			'field' => 'koszty_egzekucyjne',
			'label' => 'Koszty egzekucyjne',
			'rules' => 'trim'
		),
	),
);