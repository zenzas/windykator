<div id="szczegoly_sprawy">
	<div>
		<p>
			<?=form_label('data wpłaty', 'data_wplaty') ?>
			<?=$wplata['data_wplaty'] ?>
		</p>
		<p>
			<?=form_label('kwota wpłaty', 'kwota_wplaty') ?>
			<?=$wplata['kwota_wplaty']?>
		</p>
		<p>	
			<?=form_label('opłata komornicza', 'kwota_oplaty') ?>
			<?= $wplata['kwota_oplaty'] ?>
		</p>
		<p>
			<?=form_label('kwota do zwrotu dłużnikowi', 'kwota_zwrotu') ?>
			<?= $wplata['kwota_zwrotu'] ?>
		</p>
	</div>
</div>
<table border="1">
	<tr>
		<th>Nazwa wierzyciela</th>
		<th>Kwota zadłużenia</th>
		<th>Odsetki</th>
		<th>Koszty egzekucyjne</th>
	</tr>
	<?foreach ($wplata['wplaty_wierzycieli'] as $wplata_wierzyciela):?>
	<tr>
		<td>	
			<?= $wplata_wierzyciela['nazwa'] ?>
		</td>
		<td>
			<?=$wplata_wierzyciela['kwota_zadluzenia']?>
		</td>
		<td>	
			<?= $wplata_wierzyciela['odsetki'] ?>
		</td>
		<td>
			<?= $wplata_wierzyciela['koszty_egzekucyjne'] ?> 
		</td>
	</tr>
	<?endforeach?>	
</table>