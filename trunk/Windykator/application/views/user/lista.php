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
				<?=przygotujAdres($user['ulica'], $user['nr_dom'], $user['nr_lokal'], $user['kod'], $user['miasto'])?>			
			</td>
			<td>
				<?=anchor(url('user/podglad/'.$user['id_users']),'podgląd',array('class' => 'black'))?>
				<?=anchor(url('user/edytuj/'.$user['id_users']),'edytuj',array('class' => 'blue'))?>
				<?if ($user['aktywny'] == 1 && $this -> session -> userdata('nazwa_typ') == 'administrator'):?>
					<?=anchor(url('user/usun/'.$user['id_users']),'zablokuj',array('class' => 'red delete_user_link'))?>	
				<?endif?>
			</td>
		</tr>
		<?endforeach?>
	</table>
<?else:?>
	<p>
		Brak użytkowników w bazie
	</p>
<?endif?>
	
