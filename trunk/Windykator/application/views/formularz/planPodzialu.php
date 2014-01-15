<div id = "planPodzialu" >

<p class = "right">Załącznik nr 2 do Procedury - "Egzekwowanie należności przez Dyrektora Oddziału w ramach zbiegu egzekucji administracyjnej i sądowej"</p>
<p class = "right">Notatka w sprawie podziału środków pomiędzy wierzycieli</p>

<p> (pieczęć organu egzekucyjnego)</p>
<p class = "right"> Lublin, dnia ..................... roku</p>
<p class = "right"> (miejscowość)                        (data)</p>

<p class = "center"> Plan podziału*</p>
<p class = "center"> sumy uzyskanej w dniu <?=$wplata['data_wplaty']?> roku, z egzekucji prowadzonej ze składnika majątkowego stanowiącego <?=$wplata['skladnik_majatkowy']?>, w wysokości <?=$wplata['kwota_wplaty']?> zł</p>
<p><?space(30)?><?=$wplata['nazwa_dluznika']?><?space(30)?><?=przygotujAdres($wplata['ulica'], $wplata['nr_dom'], $wplata['nr_lokal'], $wplata['kod'], $wplata['miasto'])?></p>
<p><?space(30)?>nazwa / imię i nazwisko<?space(40)?>adres</p>

<table>
	<tr class="center">
		<th rowspan="2">L.p.</th>
		<th>Nazwa organu egzekucyjnego - właściwego Dyrektora Oddziału ZUS</th>
		<th>Oznaczenie konta (NIP, NKP, ZO)</th>
		<th> - </th><th rowspan="2">oznaczenie tytułu wykonawczego / tytułów wykonawczych</th>
		<th rowspan="2">Kategorie zaspokojenia występujące w sprawie danego wierzyciela1</th>
		<th>Aktualna kwota kosztów egzekucyjnych należna właściwemu organowi egzekucyjnemu (Dyrektorowi Oddziału ZUS) w sprawie danego wierzyciela</th>
		<th rowspan="2">Stosunek procentowy2 (iloraz aktualnej kwoty danej kategorii zaspokojenia w sprawie dango wierzyciela oraz sumy kwot tej kategorii w sprawach wszystkich wierzycieli wyrażony w procentach)</th>
		<th rowspan="2">Kwota uzyskana w związku z podziałem dla posczególnej kategorii wierzycieli w sprawie3</th>
		<th> - </th>
		<th> - </th>
		<th> Kwota podlegająca zaliczeniu na koszty egzekucyjne należne właściwemu organowi egzekucyjnemu w sprawie danego wierzyciela</th>
	</tr>
	<tr class="center">

		<td> Imię nazwisko/ nazwa wierzyciela</td>
		<td> Nr rachunku bankowego wierzyciela</td>
		<td> Adres wierzyciela</td>
		<td> Aktualna kwota zadłużenia danej kategorii zaspokojenia w sprawie danego wierzyciela</td>
		<td> suma kwot z kolumny "i" dla danego wierzyciela</td>
		<td> Kwota opłaty komorniczej</td>
		<td> Kwota do przekazania danemu wierzycielowi (różnica kwot z kolumn "j" oraz "k")</td>
	</tr>
	<tr class="center">
		<td> a </td>
		<td> b </td>
		<td> c </td>
		<td> d </td>
		<td> e </td>
		<td> f </td>
		<td> g </td>
		<td> h </td>
		<td> i </td>
		<td> j </td>
		<td> k </td>
		<td> l </td>
	</tr>
	<?$sumaKwota = $sumaOplaty = $sumaWierzyciel = 0?>
	
	<?foreach ($wplata['wplaty_wierzycieli'] as $nr => $wierzyciel):?>
	
	<?$suma = $wierzyciel['kwota_zadluzenia']+$wierzyciel['odsetki']+$wierzyciel['oplata_komornicza']?>
	<?$pozostalo = $wierzyciel['pozostala_kwota_zadluzenia']+$wierzyciel['pozostale_odsetki']+$wierzyciel['oplata_komornicza']?>
	<?$sumaKwota += $suma?>
	<?$sumaOplaty += $wierzyciel['oplata_komornicza']?>
	<?$sumaWierzyciel += $wierzyciel['kwota_zadluzenia']+$wierzyciel['odsetki']?>
	<tr class="center">
		<td rowspan="4"><?=$nr+1?>.</td>
		<td>Oddzial Lublin</td>
		<td><?=($wplata['NIP'] ? $wplata['NIP'] : $wplata['PESEL'])?></td>
		<td></td>
		<td rowspan="4"><?=$wierzyciel['tytul_wykonawczy']?></td>
		<td> I </td>
		<td><?=$wierzyciel['pozostale_koszty_egzekucyjne']+$wierzyciel['koszty_egzekucyjne']?></td>
		<td><?=procent($wierzyciel['procentKosztyEgzekucyjne'])?></td>
		<td><?=$wierzyciel['koszty_egzekucyjne']?></td>
		<td> - </td>
		<td> - </td>
		<td></td>
	</tr>
	<tr class="center">
		<td rowspan="3"><?=$wierzyciel['nazwa']?></td>
		<td rowspan="3"><?=$wierzyciel['nr_rachunku']?></td>
		<td rowspan="3"><?=przygotujAdres($wierzyciel['ulica'], $wierzyciel['nr_dom'], $wierzyciel['nr_lokal'], $wierzyciel['kod'], $wierzyciel['miasto'])?></td>
		<td><?=$wierzyciel['kategoria_zaspokojenia']?></td>
		<td><?=$suma+$pozostalo?></td>
		<td><?=procent($wierzyciel['procentKwotaOdsetki'])?></td>
		<td><?=$suma?></td>
		<td rowspan="3"><?=$suma?></td>
		<td rowspan="3"><?=$wierzyciel['oplata_komornicza']?></td>
		<td rowspan="3"><?=$wierzyciel['kwota_zadluzenia']+$wierzyciel['odsetki']?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td></td>
		<td></td>
		<td></td>

	</tr>
	<tr>
		<td>&nbsp;</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<?endforeach?>
	<?for ($i=count($wplata['wplaty_wierzycieli']);$i<4;++$i):?>
	<tr class="center">
		<td rowspan="4"><?=$i+1?></td>
		<td></td>
		<td></td>
		<td></td>
		<td rowspan="4"></td>
		<td> I </td>
		<td></td>
		<td></td>
		<td></td>
		<td> - </td>
		<td> - </td>
		<td></td>
	</tr>
	<tr class="center">
		<td rowspan="3"></td>
		<td rowspan="3"></td>
		<td rowspan="3"></td>
		<td>&nbsp;</td>
		<td></td>
		<td></td>
		<td></td>
		<td rowspan="3"></td>
		<td rowspan="3"></td>
		<td rowspan="3"></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td></td>
		<td></td>
		<td></td>

	</tr>
	<tr>
		<td>&nbsp;</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<?endfor?>
	<tr class="center">
		<td colspan="8" class="no_border"></td>
		<td> Suma </td>
		<td><?=$sumaKwota?></td>
		<td><?=$sumaOplaty?></td>
		<td><?=$sumaWierzyciel?></td>

	</tr>
</table>
<p class="right" style="margin-right: 100px;">
	................................................
</p>
<p class="right" style="margin-right: 50px;">	(pieczęć imienna oraz podpis osoby upoważnionej)</p>

<p style="margin-top: 100px;">*W dokumencie dokonuje się podziału jednej wpłaty egzekucyjnej z uwzględnieniem wszystkich występujących w sprawie wierzycieli</p>
<ol>
	<li>
		KATEGORIE ZASPOKAJANIA: na podstawie art. 115 ustawy z dnia 17 czerwca 1966r. o postępowaniu egzekucyjnym w administracji (Dz. U. z 2012r. poz. 1015 ze zm.)
	</li>
	<ol style="list-style-type: upper-roman">
		<li class = "right">
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
	</ol>
	<li>
		Obliczyć jeżeli kwota sumy uzyskanej z egzekucji nie zaspokoi wszystkich należności danej kategorii
	</li>
	<li>
		Jeżeli należności danej kategorii zaspokojone są w całości w sprawach wszystkich wierzycieli, to wpisz aktualną kwotę należności z kolumny g. Jeżeli należności danej kategorii nie zostaną zaspokojone w całości w sprawach wszystkich wierzycieli,
		wpisz iloczyn kwoty przeznaczonej do podziału dla danej kategorii zaspokajania oraz stosunku procentowego tej kategorii w sprawie danego wierzyciela.
	</li>
	<li>
		Ustalenie wysokości opłaty komorniczej następuje w oparciu o art. 1a pkt 6 z uwzględnieniem art. 66 ustawy z dnia 17 czerwca 1966r. o postępowaniu egzekucyjnym w administracji (Dz. U. z 2012r. poz. 1015 ze zm.)
	</li>
	<li>
		Suma kwot z kolumny "k" i "l" powinna być równa wysokości wpłaty egzekucyjnej, której plan podziału jest sporządzany.
	</li>
</ol>
<p>
	Do wiadomości:
</p>
<ol>
	<li>
		Komórka Roliczeń Kont Płatników Składek
	</li>
</ol>
</div>