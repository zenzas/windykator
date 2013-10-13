<h2>Najpilniejsze zadania</h2>
<?if ($wnioski):?>
	<h3>Pilne wnioski</h3>
	<?=$this->load->view('wniosek/lista',array('wnioski' => $wnioski))?>
<?endif?>
<?if ($sprawy):?>
	<h3>Sprawy nie wykazujące wpłat powyżej 60 dni</h3>
	<?=$this->load->view('sprawa/lista',array('sprawy' => $sprawy))?>
<?endif?>