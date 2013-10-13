<?=form_open('user/reset_hasla',array('class' => 'notLoggedForm'))?>
<p>
	<?=form_label('Nazwa użytkownika', 'username')?>
	<?=form_input('username')?>
</p>
<p>
	<?=form_label('E-mail', 'email')?>
	<?=form_input('email')?>
</p>
<p>
	<?=form_submit('submit', 'RESET HASŁA')?>
	<?=form_reset('reset','WYCZYŚĆ')?>
</p>
<?=form_close()?>