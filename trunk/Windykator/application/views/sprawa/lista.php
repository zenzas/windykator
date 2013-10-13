<?if ($sprawy):?>
	<table class="sprawy" border="1">
		<tr>
			<th>Sygn. akt</th>
			<th>Nr sprawy</th>
			<th>Dłużnik</th>
			<th>Identyfikator</th>
			<th>Wierzyciele</th>
			<th>Data ostatniej wpłaty</th>
			<th>Akcje</th>
		</tr>
		<?foreach ($sprawy as $sprawa):?>
		<tr>
			<td>
				<?=$sprawa['sygn_akt']?>				
			</td>
			<td>
				<?=$sprawa['nr_sprawy']?>				
			</td>
			<td>
				<?=$sprawa['nazwa_dluznika']?>				
			</td>
			<td>
				<?=$sprawa['identyfikator']?>				
			</td>
			<td> 
				<?foreach ($sprawa['wierzyciele'] as $wierzyciel):?>
					<?=$wierzyciel['nazwa_wierzyciela']?><br/>
				<?endforeach?>				
			</td>
			<td>
				<?=$sprawa['ostatnia_wplata']?>				
			</td>
			
			<td>
				<?=anchor(url('sprawa/szczegoly/'.$sprawa['id_sprawy']),'szczegóły',array('class' => 'black'))?>
				<?if(!isset($archiwalna) || !$archiwalna):?>
					<?=anchor(url('sprawa/edytuj/'.$sprawa['id_sprawy']),'edytuj',array('class' => 'blue'))?>
					<?=anchor(url('sprawa/usun/'.$sprawa['id_sprawy']),'archiwizuj',array('class' => 'red delete_sprawa_link'))?>
				<?else:?>
					<?=anchor(url('sprawa/przywroc/'.$sprawa['id_sprawy']),'przywróć',array('class' => 'blue restore_sprawa_link'))?>	
				<?endif?>
			</td>
		</tr>
		<?endforeach?>
	</table>
<?else:?>
	<p>
		Brak sprawy w bazie
	</p>
<?endif?>
	
