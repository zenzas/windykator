<ul class="tabs">
	<li>
		<?=anchor(url('user/zarzadzanie'),'Konta użytkowników')?>
	</li>
	<li>
		<?=anchor(url('user/dodaj'),'Nowy użytkownik')?>
	</li>
	<?if ($this->session->userdata('nazwa_typ') == 'administrator'):?>
		<li>
			<?=anchor(url('user/do_zalozenia'),'Konta do założenia')?>
		</li>
		<li>
			<?=anchor(url('user/zablokowani'),'Konta zablokowane')?>
		</li>
	<?endif?>
</ul>