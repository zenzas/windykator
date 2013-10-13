<h2>Zarządzanie zadłużeniem</h2>
<?=$this->load->view('zadluzenie/szukaj')?>
<ul class="tabs">
	<li>
		<?=anchor(url('zadluzenie/zarzadzanie'),'Zadłużenie')?>
	</li>
	<li>
		<?=anchor(url('zadluzenie/dodaj'),'Nowe zadłużenie')?>
	</li>
</ul>
<?=$this->load->view('zadluzenie/lista',array('zadluzenia' => $zadluzenia))?>