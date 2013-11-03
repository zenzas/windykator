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
	</div>
	<div>
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
		<th>Nazwa dłużnika</th>
		<th>Kwota zadłużenia</th>
		<th>Odsetki</th>
		<th>Koszty egzekucyjne</th>
	</tr>
	<?foreach ($wplaty as $wplata):?>
	<tr>
		<td>	
			<?= $wplata['dluznik'] ?>
		</td>
		<td>
			<?=$wplata['kwota_zadluzenia']?>
		</td>
		<td>	
			<?= $wplata['odsetki'] ?>
		</td>
		<td>
			<?= $wplata['koszty_egzekucyjne'] ?> 
		</td>
	</tr>
	<?endforeach?>	
</table>