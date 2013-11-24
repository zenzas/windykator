<?
function today() {
	$date = new DateTime();
	return $date->format('Y-m-d');
}

function url($url) {
	return base_url().$url;
}

function generujHaslo () {
	return md5(random_string('alnum',8));
}

function przygotujKwote($kwota) {
	$kwota = str_replace(',', '.', $kwota);
	return $kwota;
}

function procent($liczba) {
	$liczba = round($liczba * 100,2);
	return $liczba;
}

function przygotujAdres($ulica, $nr_dom, $nr_lokal, $kod, $miasto) {
	$adres = '';
	if ($ulica) {
		$adres = "$ulica $nr_dom";
		if ($nr_lokal)
			$adres .= "/$nr_lokal";
		$adres .= ", $kod $miasto";
	}
	return $adres;
}
