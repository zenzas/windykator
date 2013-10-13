<?=form_open('wplata/dodaj',array('id' => 'dodaj_wplata'))?>
<p>
	<?=form_label('Dluznik', 'Dluznik')?>
	<?=form_dropdown('dluznik',$dluznicy,$wplata['dluznik'])?>
	<?=anchor(url('user/dodaj'),'Dodaj dlużnika')?>
</p>
<span class="error"><?=form_error('dluznik')?></span>
<p>
	<?=form_label('Data wpłaty', 'data_wplaty') ?>
	<?=form_input(array('name' => 'data_wplaty', 'value' => $wplata['data_wplaty'], 'class' => 'datepicker', 'autocomplete' => 'off')) ?>
</p>
<span class="error"><?=form_error('data_wplaty') ?></span>
<p>
	<?=form_label('Kwota wpłaty', 'kwota_wplaty') ?>
	<?=form_input('kwota_wplaty', $wplata['kwota_wplaty']) ?>
</p>
<span class="error"><?=form_error('kwota_wplaty') ?></span>
<p>
	<?=form_submit('submit', 'DODAJ WPŁATĘ')?>
	<?=form_reset('reset','WYCZYŚĆ')?>
</p>
<?=form_close()?>
