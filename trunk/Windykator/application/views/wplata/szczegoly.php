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
		<th>Opłata komornicza</th>
	</tr>
	<?foreach ($wplata['wplaty_wierzycieli'] as $wplata_wierzyciela):?>
	<tr>
		<td>	
			<?= $wplata_wierzyciela['nazwa'] ?>
		</td>
		<td>
			<?=$wplata_wierzyciela['kwota_zadluzenia']?></br/>
			<span class="blue to_right"><?=$wplata_wierzyciela['pozostala_kwota_zadluzenia']?></span> 
		</td>
		<td>	
			<?= $wplata_wierzyciela['odsetki'] ?><br/>
			<span class="blue to_right"><?=$wplata_wierzyciela['pozostale_odsetki']?></span> 
		</td>
		<td>
			<?= $wplata_wierzyciela['koszty_egzekucyjne'] ?><br/> 
			<span class="blue to_right"><?=$wplata_wierzyciela['pozostale_koszty_egzekucyjne']?></span> 
		</td>
		<td>
			<?= $wplata_wierzyciela['oplata_komornicza'] ?><br/> 
		</td>
	</tr>
	<?endforeach?>	
</table>