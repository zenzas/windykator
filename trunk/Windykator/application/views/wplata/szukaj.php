<div id="szukaj_user">
<?=form_open('wplata/zarzadzanie')?>
<p>
	<?=form_input('szukany')?>
	<?=form_dropdown('kryterium',array('dluznik' => 'dłużnik'))?>
	<?=form_submit('szukaj', 'WYSZUKAJ')?>
</p>
<?=form_close()?>
</div>