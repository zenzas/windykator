<?if ($wnioski):?>
	<table class="wplaty" border="1">
		<tr>
			<th>Sygn. akt</th>
			<th>Wnioskodawca</th>
			<th>Data wniosku</th>
			<th><?=$pilne ? 'Czas do przekroczenia terminu' : 'Data odpowiedzi'?></th>
			<th>Opis wniosku</th>
			<th>Nr sprawy</th>
			<th>Dłużnik</th>
			<th>Akcje</th>
		</tr>
		<?foreach ($wnioski as $wniosek):?>
		<tr>
						<td>
				<?=$wniosek['sygn_akt']?>				
			</td>
			<td>
				<?=$wniosek['wnioskodawca']?>				
			</td>
			<td>
				<?=$wniosek['data_wplywu']?>				
			</td>
			<td>
				<?if ($pilne):?>
					<span class="<?=$wniosek['pozostalo'] <= 0 ? 'red' : ''?>"><?=$wniosek['pozostalo'] <= 0 ? 'przekroczony o '.(-$wniosek['pozostalo']) : $wniosek['pozostalo']?> dni</span>	
				<?else:?>
					<?=$wniosek['data_odpowiedzi']?>			
				<?endif;?>
			</td>
			<td>
				<?=$wniosek['opis_wniosku']?>				
			</td>
			
			<td>
				<?=$wniosek['nr_sprawy']?>				
			</td>
			<td>
				<?=$wniosek['dluznik']?>				
			</td>
			
			<td>
				<?=anchor(url('wniosek/edytuj/'.$wniosek['id_wniosku']),'edytuj',array('class' => 'blue'))?>
			</td>
		<?endforeach?>
	</table>
<?else:?>
	<p>
		Brak wniosku w bazie
	</p>
<?endif?>
	
