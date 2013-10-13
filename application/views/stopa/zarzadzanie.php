<h2>Zarządzanie stopami procentowymi</h2>
<ul class="tabs">
	<li>
		<?=anchor(url('stopa/zarzadzanie'),'Stopy')?>
	</li>
	<li>
		<?=anchor(url('stopa/dodaj'),'Nowa stopa')?>
	</li>
</ul>
<?=$this->load->view('stopa/lista',array('stopy' => $stopy))?>