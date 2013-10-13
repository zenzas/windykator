<?=form_open('user/zaloz/'.$user['id_user'],array('id' => 'dodaj_user'))?>
<?=form_hidden('id_user', $user['id_user'])?>
<p>
	<?=form_label('Nazwa', 'nazwa')?>
	<?=$user['nazwa']?>
</p>
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
<p>
	<?=form_submit('submit', 'ZAŁÓŻ UŻYTKOWNIKA')?>
	<?=form_reset('reset','WYCZYŚĆ')?>
</p>
<?=form_close()?>
