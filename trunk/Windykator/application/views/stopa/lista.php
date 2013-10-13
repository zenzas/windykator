<?if ($stopy):?>
	<table class="stopy" border="1">
		<tr>
			<th>Referencyjna</th>
			<th>Lombardowa</th>
			<th>Podatkowa</th>
			<th>Data od</th>
			<th>Akcje</th>
		</tr>
		<?foreach ($stopy as $stopa):?>
		<tr>
			<td>
				<?=$stopa['referencyjna']?>				
			</td>
			<td>
				<?=$stopa['lombardowa']?>				
			</td>
			<td>
				<?=$stopa['podatkowa']?>				
			</td>
			<td>
				<?=$stopa['data_od']?>				
			</td>
			<td>
				<?=anchor(url('stopa/edytuj/'.$stopa['id_stopy_procentowej']),'edytuj',array('class' => 'blue'))?>
			</td>
		<?endforeach?>
	</table>
<?else:?>
	<p>
		Brak zdefiniowanej stopy procentowej w bazie
	</p>
<?endif?>
	
