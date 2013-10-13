<h2>Zarządzanie wpłatami</h2>
<?=$this->load->view('wplata/szukaj')?>
<ul class="tabs">
	<li>
		<?=anchor(url('wplata/zarzadzanie'),'Wplaty')?>
	</li>
	<li>
		<?=anchor(url('wplata/dodaj'),'Nowa wplata')?>
	</li>
</ul>
<?=$this->load->view('wplata/lista',array('wplaty' => $wplaty))?>