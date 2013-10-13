<h2>Zarządzanie sprawami</h2>
<?=$this->load->view('sprawa/szukaj')?>
<ul class="tabs">
	<li>
		<?=anchor(url('sprawa/zarzadzanie'),'Aktualne sprawy')?>
	</li>
	<li>
		<?=anchor(url('sprawa/dodaj'),'Nowa sprawa')?>
	</li>
	<li>
		<?=anchor(url('sprawa/zarzadzanie/archiwalna'),'Zarchiwizowane sprawy')?>
	</li>
</ul>
<?=$this->load->view('sprawa/lista',array('spraw' => $sprawy))?>