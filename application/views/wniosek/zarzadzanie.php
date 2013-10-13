<h2>Zarządzanie wnioskami</h2>
<?=$this->load->view('wniosek/szukaj')?>
<ul class="tabs">
	<li>
		<?=anchor(url('wniosek/zarzadzanie'),'Aktualne wnioski')?>
	</li>
	<li>
		<?=anchor(url('wniosek/zarzadzanie/pilne'),'Pilne wnioski')?>
	</li>
	<li>
		<?=anchor(url('wniosek/dodaj'),'Nowy wniosek')?>
	</li>
</ul>
<?=$this->load->view('wniosek/lista',array('wnioski' => $wnioski))?>