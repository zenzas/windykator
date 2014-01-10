<div id="szczegoly_wierzyciela">
	<div class="to_left">
		<p>
			<?=form_label('Nazwa', 'nazwa') ?>
			<?=$wierzyciel['nazwa'] ?>
		</p>
		<p>	
			<?=form_label('Adres', 'adres') ?>
			<?=przygotujAdres($wierzyciel['ulica'], $wierzyciel['nr_dom'], $wierzyciel['nr_lokal'], $wierzyciel['kod'], $wierzyciel['miasto'])?>
		</p>
		<p>
			<?=form_label('Nr telefonu', 'nr_telefonu') ?>
			<?= $wierzyciel['nr_telefonu'] ?>
		</p>
		<p>
			<?=form_label('Nr rachunku', 'nr_rachunku') ?>
			<?= $wierzyciel['nr_rachunku'] ?>
		</p>
		<p>
            <?=form_label('Tytuł wykonawczy', 'tytul_wykonawczy') ?>
            <?= $wierzyciel['tytul_wykonawczy'] ?>
        </p>
        <p>
            <?=form_label('Data wystawienia tytułu', 'data_tytulu') ?>
            <?= $wierzyciel['data_tytulu'] ?>
        </p>
        <p>
            <?=form_label('Wystawiony przez', 'tytul_wydanyPrzez') ?>
            <?= $wierzyciel['tytul_wydanyPrzez'] ?>
        </p>
	</div>
	<div>
	    <p>
            <?=form_label('Dłużnik', 'nazwa_dluznika') ?>
            <?=$wierzyciel['nazwa_dluznika'] ?>
        </p>
		<p>
			<?=form_label('Nazwa pełnomocnika', 'nazwa_pelnomocnika') ?>
			<?=$wierzyciel['nazwa_pelnomocnika'] ?>
		</p>
		<p>	
			<?=form_label('Adres pełnomocnika', 'adres_pelnomocnika') ?>
			<?=przygotujAdres($wierzyciel['ulica_pelnomocnika'], $wierzyciel['nr_dom_pelnomocnika'], $wierzyciel['nr_lokal_pelnomocnika'], $wierzyciel['kod_pelnomocnika'], $wierzyciel['miasto_pelnomocnika'])?>
		</p>
		<p>
			<?=form_label('Nr telefonu pełnomocnika', 'nr_telefonu_pelnomocnika') ?>
			<?= $wierzyciel['nr_telefonu_pelnomocnika'] ?>
		</p>
	</div>	
</div>
<table border="1">
	<tr>
		<th>Data wpłaty</th>
		<th>Kwota zadłużenia</th>
		<th>Odsetki</th>
		<th>Koszty egzekucyjne</th>
		<th>Opłata komornicza</th>
	</tr>
	<tr>
	    <td>Stan początkowy</td>
	    <td>
            <?=$wierzyciel['kwota_zadluzenia']?><br/>
        </td>
        <td>    
            <?= $wierzyciel['odsetki'] ?><br/>
        </td>
        <td>
            <?= $wierzyciel['koszty_egzekucyjne'] ?><br/>
        </td>
        <td></td>
	</tr>
	<?foreach ($wplaty as $wplata):?>
	<tr>
		<td>	
			<?=$wplata['data_wplaty'] ?>
		</td>
		<td>
			<?=$wplata['kwota_zadluzenia']?><br/>
			<span class="blue to_right"><?=$wplata['pozostala_kwota_zadluzenia']?></span>
		</td>
		<td>	
			<?= $wplata['odsetki'] ?><br/>
			<span class="blue to_right"><?=$wplata['pozostale_odsetki']?></span>
		</td>
		<td>
			<?= $wplata['koszty_egzekucyjne'] ?><br/>
			<span class="blue to_right"><?=$wplata['pozostale_koszty_egzekucyjne']?></span> 
		</td>
		<td>
			<?= $wplata['oplata_komornicza'] ?><br/>
		</td>
	</tr>
	<?endforeach?>	
</table>