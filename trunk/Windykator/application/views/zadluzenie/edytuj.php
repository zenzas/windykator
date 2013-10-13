<?=form_open('zadluzenie/edytuj/'.$zadluzenie['id_zadluzenia'],array('id' => 'edytuj_zadluzenie'))?>
<p>
	<?=form_label('Dłużnik', 'dluznik')?>
	<?=form_dropdown('dluznik',$dluznicy,$zadluzenie['dluznik'],"id='dluznik'")?>
	<?=anchor(url('sprawa/dodaj'),'Dodaj sprawe')?>
</p>
	<?=form_label('Wierzyciel', 'wierzyciel')?>
	<?=form_dropdown('wierzyciel',$wierzyciele[$zadluzenie['dluznik']],$zadluzenie['wierzyciel'],"id='wierzyciel'")?>
	<?=anchor(url('sprawa/edytuj'),'Dodaj wierzyciela',"id='dodaj_wierzyciela_link'")?>
</p>
<span class="error"><?=form_error('wierzyciel')?></span>
<p>
	<?=form_label('Data', 'data') ?>
	<?=form_input(array('name' => 'data', 'value' => $zadluzenie['data'], 'class' => 'datepicker', 'autocomplete' => 'off')) ?>
</p>
<span class="error"><?=form_error('data') ?></span>
<p>
	<?=form_label('Kwota zadłużenia', 'kwota_zadluzenia') ?>
	<?=form_input('kwota_zadluzenia', $zadluzenie['kwota_zadluzenia']) ?>
</p>
<span class="error"><?=form_error('kwota_zadluzenia') ?></span>
<p>
	<?=form_label('Kwota odsetek', 'odsetki') ?>
	<?=form_input('odsetki', $zadluzenie['odsetki']) ?>
</p>
<span class="error"><?=form_error('kwota_odsetek') ?></span>
<p>	
	<?=form_label('Koszty egzekucyjne', 'koszty_egzekucyjne') ?>
	<?=form_input('koszty_egzekucyjne', $zadluzenie['koszty_egzekucyjne']) ?>
</p>
<span class="error"><?=form_error('koszty_egzekucyjne') ?></span>
<p>
	<?=form_submit('submit', 'POTWIERDŹ ZMIANY')?>
	<?=form_reset('reset','WYCZYŚĆ')?>
</p>
<?=form_close()?>
<script>
	var values = new Object();
	<?foreach ($wierzyciele as $id_sprawy => $sprawa):?>
		values['<?=$id_sprawy?>'] = new Object();
		<?foreach ($sprawa as $id_wierzyciela => $wierzyciel):?>
			values['<?=$id_sprawy?>']['<?=$id_wierzyciela?>'] = '<?=$wierzyciel?>';
		<?endforeach?>
	<?endforeach?>
	SynchronizedDropDown('dluznik', 'wierzyciel', values, false);
</script>
