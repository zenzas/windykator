<div id="szukaj_user">
<?=form_open('wniosek/zarzadzanie')?>
<p>
	<?=form_input('szukany')?>
	<?=form_dropdown('kryterium',array('all' => 'wszędzie','sygn_akt' => 'sygn_akt','nr_sprawy' => 'nr sprawy','wnioskodawca' => 'wnioskodawca','dluznik' => 'dłużnik'))?>
	<?=form_submit('szukaj', 'WYSZUKAJ')?>
</p>
<?=form_close()?>
</div>