<?if ($wplaty):?>
	<table class="wplaty" border="1">
		<tr>
			<th>Dluznik</th>
			<th>Data wplaty</th>
			<th>Kwota wplaty</th>
			<th>Akcje</th>
		</tr>
		<?foreach ($wplaty as $wplata):?>
		<tr>
			<td>
				<?=$wplata['dluznik']?>				
			</td>
			<td>
				<?=$wplata['data_wplaty']?>				
			</td>
			<td>
				<?=$wplata['kwota_wplaty']?>				
			<td>
				<?=anchor(url('wplata/edytuj/'.$wplata['id_wplaty']),'edytuj',array('class' => 'blue'))?>
			</td>
		<?endforeach?>
	</table>
<?else:?>
	<p>
		Brak wplaty w bazie
	</p>
<?endif?>
	
