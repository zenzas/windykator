<?if ($users):?>
	<table class="users" border="1">
		<tr>
			<th>Login</th>
			<th>Identyfikator</th>
			<th>Nazwa</th>
			<th>Adres</th>
			<th>Akcje</th>
		</tr>
		<?foreach ($users as $user):?>
		<tr>
			<td>
				<?=$user['login']?>				
			</td>
			<td>
				<?=$user['identyfikator']?>				
			</td>
			<td>
				<?=$user['nazwa']?>				
			</td>
			<td class="adres">
				<?if ($user['ulica']):?>
					<?=$user['ulica']?> <?=$user['nr_dom']?><?if ($user['nr_lokal']):?> / <?=$user['nr_lokal']?><?endif?>, <?=$user['kod']?> <?=$user['miasto']?>
				<?endif?>				
			</td>
			<td>
				<?=anchor(url('user/przywroc/'.$user['id_users']),'odblokuj',array('class' => 'green restore_user_link'))?>	
			</td>
		</tr>
		<?endforeach?>
	</table>
<?else:?>
	<p>
		Brak zablokowanych użytkowników w bazie
	</p>
<?endif?>
	
