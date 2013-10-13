<?if($this->session->userdata('nazwa_typ')=='administrator') :?>
<h2>Zarządzanie użytkownikami</h2>
<?elseif($this->session->userdata('nazwa_typ')=='operator') :?>
<h2>Zarządzanie uczestnikami postępowania egzekucyjnego</h2>
<?endif ?>
<?=$this->load->view('user/szukaj')?>
<?=$this->load->view('user/akcje')?>
<?if ($this->router->method == 'do_zalozenia'):?>
	<?=$this->load->view('user/listaDoZalozenia',array('users' => $users))?>
<?elseif ($this->router->method == 'zablokowani'):?>
	<?=$this->load->view('user/listaZablokowanych',array('users' => $users))?>
<?else:?>
	<?=$this->load->view('user/lista',array('users' => $users))?>
<?endif?>