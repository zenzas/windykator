<?if ($wplaty):?>
	<table class="wplaty" border="1">
		<tr>
			<?if ($this->router->class == 'wplata'):?>
			<th>Dluznik</th>
			<?endif?>
			<th>Data wplaty</th>
			<th>Kwota wplaty</th>
			<th>Akcje</th>
		</tr>
		<?foreach ($wplaty as $wplata):?>
		<tr>
			<?if ($this->router->class == 'wplata'):?>
			<td>
				<?=$wplata['dluznik']?>				
			</td>
			<?endif?>
			<td>
				<?=$wplata['data_wplaty']?>				
			</td>
			<td>
				<?=$wplata['kwota_wplaty']?>				
			</td>
			<td>
				<?=anchor(url('wplata/szczegoly/'.$wplata['id_wplaty']),'szczegoly',array('class' => 'black'))?>
				<?if ($this->router->class == 'wplata'):?>
					<?=anchor(url('wplata/edytuj/'.$wplata['id_wplaty']),'edytuj',array('class' => 'blue'))?>
				<?endif?>
				<?=anchor(url('formularz/generuj/planPodzialu/pozioma/'.$wplata['id_wplaty']),'plan podziału',array('class' => 'green', 'target' => '_blank'))?>
			</td>
		</tr>
		<?endforeach?>
	</table>
<?else:?>
	<p>
		Brak wplat w bazie
	</p>
<?endif?>
	
