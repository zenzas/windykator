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
