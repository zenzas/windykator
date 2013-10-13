<?=form_open('user/login',array('class' => 'notLoggedForm'))?>
<p>
	<?=form_label('Nazwa użytkownika', 'username')?>
	<?=form_input('username')?>
</p>
<p>
	<?=form_label('Hasło', 'password')?>
	<?=form_password('password')?>
</p>
<p>
	<?=form_submit('submit', 'ZALOGUJ SIĘ')?>
	<?=form_reset('reset','WYCZYŚĆ')?>
</p>
<p>
	<?=anchor(url('user/reset_hasla'), 'Zapomniałeś hasła')?>
</p>
<?=form_close()?>

