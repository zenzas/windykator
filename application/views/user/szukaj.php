<div id="szukaj_user">
<?=form_open('user/'.$this->router->method)?>
<p>
	<?=form_input('szukany')?>
	<?=form_dropdown('kryterium',array('all' => 'wszędzie','nazwa' => 'nazwa','PESEL' => 'PESEL','NIP' => 'NIP','login' => 'login'))?>
	<?=form_submit('szukaj', 'WYSZUKAJ')?>
</p>
<?=form_close()?>
</div>