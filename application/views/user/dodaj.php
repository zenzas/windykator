<?=form_open('user/dodaj',array('id' => 'dodaj_user'))?>
<p>
	<?=form_label('Nazwa', 'nazwa')?>
	<?=form_input('nazwa',$user['nazwa'])?>
</p>
<span class="error"><?=form_error('nazwa')?></span>
<p>
	<?=form_label('Typ użytkownika', 'typ')?>
	<?=form_dropdown('typ',$typy,$user['typ'],'id="typ_user"')?>
	<?=form_dropdown('typ_wierzyciel',$typyWierzycieli,$user['typ_wierzyciel'],'id="typ_wierzyciel"')?>
</p>
<span class="error"><?=form_error('typ')?></span>
<?if ($this->session->userdata('nazwa_typ') == 'administrator'):?>
<p>
	<?=form_label('Login', 'login')?>
	<?=form_input('login',$user['login'])?>	
</p>
<span class="error"><?=form_error('login')?></span>

<p>
	<?=form_label('E-mail', 'email')?>
	<?=form_input('email',$user['email'])?>
</p>
<span class="error"><?=form_error('email')?></span>
<?elseif ($this->session->userdata('nazwa_typ') == 'operator'):?>
<p>
	<?=form_label('Uprawniony do logowania', 'logowanie') ?>
	<?=form_checkbox(array('name' => 'logowanie', 'value' => 1, 'checked' => $user['logowanie'] == 1 ? true : false)) ?>
</p>
<p>
	<?=form_label('NIP', 'NIP')?>
	<?=form_input('NIP',$user['NIP'])?>
</p>
<span class="error"><?=form_error('NIP')?></span>
<p>
	<?=form_label('PESEL', 'PESEL')?>
	<?=form_input('PESEL',$user['PESEL'])?>
</p>
<span class="error"><?=form_error('PESEL')?></span>
<p>
	<?=form_label('Ulica', 'ulica') ?>
	<?=form_input('ulica', $user['ulica']) ?>
</p>
<span class="error"><?=form_error('ulica') ?></span>
<p>
	<?=form_label('Nr domu', 'nr_dom') ?>
	<?=form_input('nr_dom', $user['nr_dom']) ?>
</p>
<span class="error"><?=form_error('nr_dom') ?></span>
<p>
<p>
	<?=form_label('Nr lokalu', 'nr_lokal') ?>
	<?=form_input('nr_lokal', $user['nr_lokal']) ?>
	
</p>
<span class="error"><?=form_error('nr_lokal') ?></span>
<p>
	<?=form_label('Miasto', 'miasto') ?>
	<?=form_input('miasto', $user['miasto']) ?>
</p>
<span class="error"><?=form_error('miasto') ?></span>
<p>
	<?=form_label('Kod pocztowy', 'kod') ?>
	<?=form_input('kod', $user['kod']) ?>
</p>
<span class="error"><?=form_error('kod') ?></span>
<p>
	<?=form_label('Nr telefonu', 'nr_telefonu') ?>
	<?=form_input('nr_telefonu', $user['nr_telefonu']) ?>
</p>
<span class="error"><?=form_error('nr_telefonu') ?></span>
<p>
	<?=form_label('Nr rachunku', 'nr_rachunku') ?>
	<?=form_input('nr_rachunku', $user['nr_rachunku']) ?>
</p>
<span class="error"><?=form_error('nr_rachunku') ?></span>
<?endif?>
<p>
	<?=form_submit('submit', 'DODAJ UŻYTKOWNIKA')?>
	<?=form_reset('reset','WYCZYŚĆ')?>
</p>
<?=form_close()?>
