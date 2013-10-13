<?=form_open('stopa/edytuj/'.$stopa['id_stopy_procentowej'],array('id' => 'dodaj_stopa'))?>
<p>
	<?=form_label('Wysokość stopy referencyjnej', 'referencyjna') ?>
	<?=form_input('referencyjna', $stopa['referencyjna']) ?>
</p>
<span class="error"><?=form_error('referencyjna') ?></span>
<p>
	<?=form_label('Wysokość stopy lombardowej', 'lombardowa') ?>
	<?=form_input('lombardowa', $stopa['lombardowa']) ?>
</p>
<span class="error"><?=form_error('lombardowa') ?></span>
<p>
	<?=form_label('Wysokość stopy podatkowej', 'podatkowa') ?>
	<?=form_input('podatkowa', $stopa['podatkowa']) ?>
</p>
<span class="error"><?=form_error('podatkowa') ?></span>
<p>
	<?=form_label('Data od', 'data_od') ?>
	<?=form_input(array('name' => 'data_od', 'value' => $stopa['data_od'], 'class' => 'datepicker', 'autocomplete' => 'off')) ?>
</p>
<span class="error"><?=form_error('data_od') ?></span>
<p>
	<?=form_submit('submit', 'MODYFIKUJ STOPĘ PROCENTOWĄ')?>
	<?=form_reset('reset','WYCZYŚĆ')?>
</p>
<?=form_close()?>
