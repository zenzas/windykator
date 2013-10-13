<?=form_open('wniosek/edytuj/'.$wniosek['id_wniosku'],array('id' => 'dodaj_wniosek'))?>
<p>
	<?=form_label('Wnioskodawca', 'wnioskodawca')?>
	<?=form_dropdown('wnioskodawca',$wnioskodawcy,$wniosek['wnioskodawca'])?>
	<?=anchor(url('user/dodaj'),'Dodaj wnioskodawcę')?>
</p>
<span class="error"><?=form_error('wnioskodawca')?></span>
<p>
	<?=form_label('Sprawa', 'sprawa')?>
	<?=form_dropdown('sprawa',$sprawy,$wniosek['sprawa'])?>
</p>
<span class="error"><?=form_error('sprawa')?></span>
<p>
	<?=form_label('Opis wniosku', 'opis_wniosku') ?>
	<?=form_textarea('opis_wniosku', $wniosek['opis_wniosku']) ?>
</p>
<span class="error"><?=form_error('opis_sprawy') ?></span>
<p>
	<?=form_label('Data wpływu', 'data_wplywu') ?>
	<?=form_input(array('name' => 'data_wplywu', 'value' => $wniosek['data_wplywu'], 'class' => 'datepicker', 'autocomplete' => 'off')) ?>
</p>
<span class="error"><?=form_error('data_wplywu') ?></span>
<p>
	<?=form_label('Data odpowiedzi', 'data_odpowiedzi') ?>
	<?=form_input(array('name' => 'data_odpowiedzi', 'value' => $wniosek['data_odpowiedzi'], 'class' => 'datepicker', 'autocomplete' => 'off')) ?>
</p>
<span class="error"><?=form_error('data_odpowiedzi') ?></span>
<p>
	<?=form_submit('submit', 'ZAPISZ')?>
	<?=form_reset('reset','WYCZYŚĆ')?>
</p>
<?=form_close()?>
