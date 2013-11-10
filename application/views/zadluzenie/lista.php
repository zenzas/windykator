<?if ($zadluzenia):?>
	<table class="zadluzenie" border="1">
		<tr>
			<th>Dluznik</th>
			<th>Wierzyciel</th>
			<th>Zadluzenie na dzien</th>
			<th>Kwota zadluzenia</th>
			<th>Kwota odsetek</th>
			<th>Koszty egzekucyjne</th>
			<th>Akcje</th>
		</tr>
		<?foreach ($zadluzenia as $zadluzenie):?>
		<tr>
			<td>
				<?=$zadluzenie['dluznik']?>				
			</td>
			<td>
				<?=$zadluzenie['wierzyciel']?>				
			</td>
			<td>
				<?=$zadluzenie['data']?>				
			</td>
			<td>
				<?=$zadluzenie['kwota_zadluzenia']?><br/>
				<span class="blue to_right"><?=$zadluzenie['pozostala_kwota_zadluzenia']?></span>				
			</td>
			<td>
				<?=$zadluzenie['odsetki']?><br/>
				<span class="blue to_right"><?=$zadluzenie['pozostale_odsetki']?></span>				
			</td>
			<td>
				<?=$zadluzenie['koszty_egzekucyjne']?><br/>
				<span class="blue to_right"><?=$zadluzenie['pozostale_koszty_egzekucyjne']?></span>				
			</td>	
			<td>
				<?=anchor(url('zadluzenie/edytuj/'.$zadluzenie['id_zadluzenia']),'edytuj',array('class' => 'blue'))?>
			</td>
		<?endforeach?>
	</table>
<?else:?>
	<p>
		Brak zadłużenia w bazie
	</p>
<?endif?>
	
