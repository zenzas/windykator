<div id="szukaj_user">
<?=form_open('zadluzenie/zarzadzanie')?>
<p>
	<?=form_input('szukany')?>
	<?=form_dropdown('kryterium',array('dluznik' => 'dłużnik', 'wierzyciel' => 'wierzyciel'))?>
	<?=form_submit('szukaj', 'WYSZUKAJ')?>
</p>
<?=form_close()?>
</div>