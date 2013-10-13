<div id="szukaj_user">
<?=form_open('sprawa/zarzadzanie'.($archiwalna ? '/archiwalna' : ''))?>
<p>
	<?=form_input('szukany')?>
	<?=form_dropdown('kryterium',array('all' => 'wszędzie','sygn_akt' => 'sygn_akt', 'nr_sprawy' => 'nr sprawy','identyfikator' => 'identyfikator','nazwa' => 'nazwa'))?>
	<?=form_submit('szukaj', 'WYSZUKAJ')?>
</p>
<?=form_close()?>
</div>