<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Windykator</title>
		<link rel="stylesheet" href="<?=url('css/jquery-ui.min.css') ?>" />
		<link rel="stylesheet" href="<?=url('css/jquery-ui.css') ?>" />
		<link rel="stylesheet" href="<?=url('css/jquery.ui.theme.css') ?>" />
		<script src="<?=url('js/jquery-1.9.1.js') ?>"></script>
		<script src="<?=url('js/jquery-ui.js') ?>"></script>
		<script type="text/javascript" src="<?=url('js/funkcje.js') ?>" ></script>	
		<link rel="stylesheet" type="text/css" href="<?=url('css/style.css') ?>" />
		
	</head>
	<body>
		<div id="container">
			<div id="header">
				<?if($this->session->userdata('id')) :?>
					<div id="user_info">
						<span>zalogowany: <?=$this->session->userdata('login')?></span>
						<?=anchor(url('user/logout'),'Wyloguj')?>
					</div>
				<?endif ?>
				<h1>Witaj w systemie Windykator!</h1>
			</div>
			<?if($this->session->userdata('id')) :?>
				<ul id="left_menu">
						<li>
							<?=anchor(url('user/aktualnosci'),'Start')?>
						</li>
					<?if($this->session->userdata('nazwa_typ')=='administrator') :?>
						<li>
							<?=anchor(url('user/zarzadzanie'),'Użytkownicy')?>
						</li>
						<li>
							<?=anchor(url('stopa/zarzadzanie'), 'Stopy procentowe')?>
						</li>
					<?elseif($this->session->userdata('nazwa_typ')=='operator') :?>
						<li>
							<?=anchor(url('sprawa/zarzadzanie'),'Sprawy')?>
						</li>
						<li>
							<?=anchor(url('user/zarzadzanie'), 'Dane uczestników postępowania')?>
						</li>
						<li>
							<?=anchor(url('wniosek/zarzadzanie/pilne'),'Wnioski')?>
						</li>
						<li>
							<?=anchor(url('wplata/zarzadzanie'),'Wpłaty')?>
						</li>
						<li>
							<?=anchor(url('zadluzenie/zarzadzanie'), 'Zadłużenie')?>
						</li>				
					<?elseif($this->session->userdata('nazwa_typ')=='wierzyciel') :?>
					<?elseif($this->session->userdata('nazwa_typ')=='dłużnik zajętej wierzytelności') :?>	
					<?elseif($this->session->userdata('nazwa_typ')=='dłużnik') :?>
					<?elseif($this->session->userdata('nazwa_typ')=='komornik') :?>	
					<?endif ?>
				</ul>
			<?endif ?>
			<div <?if($this->session->userdata('id')) :?>class="content"<?endif ?> >
				
				<?if($this->session->flashdata('error')) :?>
				<p class="error">
					<?=$this -> session -> flashdata('error') ?>
				</p>
				<?endif ?>
				<?if($this->session->flashdata('message')) :?>
				<p class="message">
					<?=$this -> session -> flashdata('message') ?>
				</p>
				<?endif ?>
				<?=$content ?>
			</div>
		</div>

	</body>
</html>