<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">

	

<p class ="right">Załącznik nr 1 do Procedury - "Egzekwowanie należności przez Dyrektora Oddziału w ramach zbiegu egzekucji administracyjnej i sądowej"</p>




<p> Nazwa / imię i nazwisko dłużnika (NIP / PESEL) <?=$wierzyciel['nazwa_dluznika']?> (<?=$wierzyciel['identyfikator_dluznika']?>)</p>
<p> Data wpływu sprawy <?=$wierzyciel['data_wplywu']?></p>


<p> Zakres prowadzonego postępowania egzekucyjnego: pełny / jeden środek egzekucyjny* <?=$wierzyciel['skladnik_majatkowy']?></p>
<p> podać prawo majątkowe</p>

<p> Poprzedni organ egzekucyjny: ..................................................................</p>
<p> Data dokonania zajęcia przez organ egzekucyjjny: ..............................................</p>

<p> Wierzyciel: <?=$wierzyciel['nazwa']?></p>
<p> nazwa / imię i nazwisko</p>
<p> <?=przygotujAdres($wierzyciel['ulica'],$wierzyciel['nr_dom'],$wierzyciel['nr_lokal'],$wierzyciel['kod'],$wierzyciel['miasto'],$wierzyciel['nr_telefonu'])?></p>
<p> adres</p>
<p> 
    Pełnomocnik: 
    <?if($wierzyciel['id_pelnomocnika']):?>
        <?=$wierzyciel['nazwa_pelnomocnika']?>
    <?else:?>
        ............................................
    <?endif?>
</p>
<p> nazwa / imię i nazwisko</p>
<p> 
    <?if($wierzyciel['id_pelnomocnika']):?>
        <?=przygotujAdres($wierzyciel['ulica_pelnomocnika'],$wierzyciel['nr_dom_pelnomocnika'],$wierzyciel['nr_lokal_pelnomocnika'],$wierzyciel['kod_pelnomocnika'],$wierzyciel['nr_telefonu_pelnomocnika'],$wierzyciel['miasto_pelnomocnika'])?>
    <?else:?>
        ............................................
    <?endif?>
</p>
<p> adres</p>
<p> Rachunek bankowy wierzyciela: <?=$wierzyciel['nr_rachunku']?></p>
<p> Tytuł wykonawczy: <?=$wierzyciel['data_tytulu']?>, <?=$wierzyciel['tytul_wykonawczy']?>, <?=$wierzyciel['tytul_wydanyPrzez']?>  </p>
<p> podać datę, sygnaturę sprawy, przez kogo wydany)</p>
<p> .......................................................</p>
<p> .......................................................</p>

<p> Należność wg stanu na dzień <?=$wierzyciel['data_zadluzenia']?>:</p>


<table align="center" border="3" cellpadding="8" cellspacing="8">
	<tr>
		<th>Kategoria I</th>
		<th>Kategoria II</th>
		<th>Kategoria III</th>
		<th>Kategoria IV</th>
		<th>Kategoria V</th>
		<th>Kategoria VI</th>
		<th>Kategoria VII</th>
		<th>Kategoria VIII</th>
	</tr>
	<tr>
		<td><?=$wierzyciel['koszty_egzekucyjne']?></td>
		<?for ($i=2;$i<=8;++$i):?>
		<td>
		    <?if ($wierzyciel['id_kategorii_zaspokojenia'] == $i):?>
		      <?=$wierzyciel['kwota_zadluzenia']?>
		    <?else:?>
		      0.00
		    <?endif?>
		</td>
		<?endfor?>
	</tr>
	
</table>





<p> ................................................</p>
<p> (podpis i pieczęć osoby sporządzającej dokument)</p>

<p> KATEGORIE ZASPOKAJANIA na podstawie art. 115 ustawy z dnia 17 czerwca 1966r. o postępowaniu egzekucyjnym w administracji (Dz. U. z 2012r. poz. 1015 ze zm.):</p>
	</li>
	<ol style="list-style-type: upper-roman">
		<li align = "right">
			Koszty egzekucyjne i koszty upomnienia;
		</li>
		<li>
			Należności alimnetacyjne;
		</li>
		<li>
			Należności za pracę za okres 3 miesięcy, do wysokości minimalnego wynagrodzenia za pracę oraz renty z tytułu odszkodowania za wywołanie choroby, niezdolności do pracy, kalectwa lub śmierci i koszty zwykłego pogrzebu zobowiązanego;
		</li>
		<li>
			Należności zabezpieczone hipoteką morską, przywilejem na statku morskim (UWAGA: Nie dotyczy egzekucji prowadzonej przez Dyrektora Oddziału);
		</li>
		<li>
			Należności zabeazpieczone hipoteką, zastawem, zastawem rejestrowym i zastawem skarbowym lub korzystającym z ustawowego pierwszeństwa oraz prawach, które ciążyły na nieruchomości przed dokonaniem w księdze wieczystej wpisu o wszczęciu egzekucji lub przed złożeniem
			do zbioru dokumentów wniosku o dokonanie takiego wpisu , wraz z roszczeniami o świadczenia uboczne objęte zabezpieczeniem na mocy odrębnych przepisów. (UWAGA: Nie dotyczy egzekucji prowadzonej przez Dyrektora Oddziału);
		</li>
		<li>
			Należności za pracę niezaspokojone w kolejności wcześniejszej;
		</li>
		<li>
			Należności, do których stosuje się przepisy działu III Ordynacji podatkowej oraz należności z tytułu składek na ubezpieczenie społeczne, o ile nie zostały zaspokojone w czwartej kategorii wraz z odsetkami za zwłokę;
		</li>
		<li>
			Inne należności i odsetki;
		</li>

<p>
	*niepotrzebne skreślić
</p>