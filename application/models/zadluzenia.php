<?php
class Zadluzenia extends CI_Model {
    function __construct() {
        // wywołanie constructor z Model
        parent::__construct();
    }

    function getById($id_zadluzenia) {
        $this -> db -> select('z.*, d.nazwa as dluznik, u.nazwa as wierzyciel, ws.id_sprawy, ws.id_wierzyciela') -> from('zadluzenie z') -> join('wierzyciele_sprawy ws', 'ws.id_wierzyciele_sprawy = z.id_wierzyciele_sprawy') -> join('wierzyciel w', 'ws.id_wierzyciela = w.id_wierzyciela') -> join('users u', 'w.id_users = u.id_users') -> join('sprawy s', 's.id_sprawy = ws.id_sprawy') -> join('users d', 's.id_dluznika = d.id_users') -> where('z.id_zadluzenia', $id_zadluzenia);
        $zadluzenie = $this -> db -> get() -> row_array();
        return $zadluzenie;
    }

    function lista($where = null) {
        $this -> db -> select('z.*, d.nazwa as dluznik, ws.id_wierzyciela, w.typ_stopy_procentowej, w.stopa_z_wyroku, u.nazwa as wierzyciel, kz.numer, kz.priorytet') -> from('zadluzenie z') -> join('wierzyciele_sprawy ws', 'ws.id_wierzyciele_sprawy = z.id_wierzyciele_sprawy') -> join('wierzyciel w', 'ws.id_wierzyciela = w.id_wierzyciela') -> join('kategorie_zaspokojenia kz', 'kz.id_kategorii_zaspokojenia = w.id_kategorii_zaspokojenia') -> join('users u', 'w.id_users = u.id_users') -> join('sprawy s', 's.id_sprawy = ws.id_sprawy') -> join('users d', 's.id_dluznika = d.id_users');
        $this -> ustawKryteria($where);
        $this -> db -> order_by("dluznik, wierzyciel");
        $zadluzenia = $this -> db -> get() -> result_array();
        return $zadluzenia;
    }

    function getWierzycieleSprawy($id_sprawy, $id_wierzyciela) {
        $this -> db -> from('wierzyciele_sprawy') -> where(array('id_sprawy' => $id_sprawy, 'id_wierzyciela' => $id_wierzyciela));
        $wierzycieleSprawy = $this -> db -> get() -> row_array();
        return $wierzycieleSprawy;
    }

    function ustawKryteria($where) {
        if ($where) {
            if (isset($where['dluznik'])) {
                $this -> db -> like('d.nazwa', $where['dluznik']);
            }
            if (isset($where['id_dluznika'])) {
                $this -> db -> where('s.id_dluznika', $where['id_dluznika']);
            }
            if (isset($where['wierzyciel'])) {
                $this -> db -> like('u.nazwa', $where['wierzyciel']);
            }
            if (isset($where['id_sprawy'])) {
                $this -> db -> where('ws.id_sprawy', $where['id_sprawy']);
            }
            if (isset($where['id_wierzyciela'])) {
                $this -> db -> where('ws.id_wierzyciela', $where['id_wierzyciela']);
            }
        }
    }

    function dodaj($zadluzenie) {
        $dane = array('id_wierzyciele_sprawy' => $zadluzenie['id_wierzyciele_sprawy'], 'data' => $zadluzenie['data'], 'kwota_zadluzenia' => przygotujKwote($zadluzenie['kwota_zadluzenia']), 'odsetki' => przygotujKwote($zadluzenie['odsetki']), 'koszty_egzekucyjne' => przygotujKwote($zadluzenie['koszty_egzekucyjne']), 'pozostala_kwota_zadluzenia' => przygotujKwote($zadluzenie['kwota_zadluzenia']), 'pozostale_odsetki' => przygotujKwote($zadluzenie['odsetki']), 'pozostale_koszty_egzekucyjne' => przygotujKwote($zadluzenie['koszty_egzekucyjne']));
        //var_dump($zadluzenie, $dane);
        $this -> db -> insert('zadluzenie', $dane);
        //var_dump($this -> db -> last_query());
        $this -> session -> set_flashdata('message', 'Dodano nowe zadłużenie');
    }

    function edytuj($zadluzenie) {
        $dane = array('id_wierzyciele_sprawy' => $zadluzenie['id_wierzyciele_sprawy'], 'data' => $zadluzenie['data'], 'kwota_zadluzenia' => przygotujKwote($zadluzenie['kwota_zadluzenia']), 'odsetki' => przygotujKwote($zadluzenie['odsetki']), 'koszty_egzekucyjne' => przygotujKwote($zadluzenie['koszty_egzekucyjne']));

        $this -> db -> where('id_zadluzenia', $zadluzenie['id_zadluzenia']) -> update('zadluzenie', $dane);

        $this -> session -> set_flashdata('message', 'Zmodyfikowano zadłużenie');
    }

    function czyStopaReferencyjna($typ_stopy_procentowej) {
        return $typ_stopy_procentowej != "cywilny";
    }

    function aktualizujZadluzenie($wplata) {
        $where = array('id_dluznika' => $wplata['id_dluznika']);
        $zadluzenia = $this -> lista($where);
        $stopy = $this -> stopy -> lista();
        // var_dump($wplata);
        $zadluzeniaWgPriorytetow = array();
        echo "<pre>";
        foreach ($zadluzenia as $zadluzenie) {
            //aktualizacja
            if ($zadluzenie['data'] < $wplata['data_wplaty']) {
                if ($zadluzenie['typ_stopy_procentowej'] == 'stopa_z_wyroku') {
                    $data_od = $zadluzenie['data'];
                    $data_do = $wplata['data_wplaty'];
                    $datetime1 = new DateTime($data_od);
                    $datetime2 = new DateTime($data_do);
                    $interval = $datetime1 -> diff($datetime2);
                    $dni = $interval -> format('%a');
                    $procent = $zadluzenie['stopa_z_wyroku'] / 100;
                    $zadluzenie['pozostale_odsetki'] += $zadluzenie['pozostala_kwota_zadluzenia'] * $procent * $dni / 365;
                } else {
                    $stopyDoOdsetek = $this -> stopy -> stopyWgDat($stopy, $zadluzenie['data'], $wplata['data_wplaty']);
                    foreach ($stopyDoOdsetek as $stopa) {
                        $data_od = max($zadluzenie['data'], $stopa['data_od']);
                        $data_do = min($wplata['data_wplaty'], $stopa['data_do']);
                        $datetime1 = new DateTime($data_od);
                        $datetime2 = new DateTime($data_do);
                        $interval = $datetime1 -> diff($datetime2);
                        $dni = $interval -> format('%a');
                        $procent = $stopa[$zadluzenie['typ_stopy_procentowej']] / 100;
                        $zadluzenie['pozostale_odsetki'] += $zadluzenie['pozostala_kwota_zadluzenia'] * $procent * $dni / 365;
                    }
                }

                $this -> db -> where('id_zadluzenia', $zadluzenie['id_zadluzenia']) -> update('zadluzenie', array('pozostale_odsetki' => $zadluzenie['pozostale_odsetki']));

            }
            //aktualizacja zadluzenia wg prorytetow
            $priorytet = $zadluzenie['priorytet'];
            $zadluzenie['suma'] = $zadluzenie['pozostala_kwota_zadluzenia'] + round($zadluzenie['pozostale_odsetki']) + $zadluzenie['pozostale_koszty_egzekucyjne'];
            if (isset($zadluzeniaWgPriorytetow[$priorytet])) {
                $zadluzeniaWgPriorytetow[$priorytet]['suma'] += $zadluzenie['suma'];
                $zadluzeniaWgPriorytetow[$priorytet]['zadluzenia'][] = $zadluzenie;
            } else {
                $zadluzeniaWgPriorytetow[$priorytet] = array('suma' => $zadluzenie['suma'], 'zadluzenia' => array($zadluzenie));
            }
        }
        return $zadluzeniaWgPriorytetow;
    }

    function stan($id_sprawy, $id_wierzyciela) {
        $sprawa = $this -> sprawy -> getById($id_sprawy);
        $stan['zadluzenie'] = $this -> lista(array('$id_sprawy' => $id_sprawy, 'id_wierzyciela' => $id_wierzyciela));
        $stan['wplaty'] = $this -> wplaty -> wplatyDlaWierzyciela($sprawa['id_dluznika'], $id_wierzyciela);
        var_dump($stan);
        exit ;
    }

}
?>