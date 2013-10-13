<?if ($users):?>
	<table class="users" border="1">
		<tr>
			<th>Identyfikator</th>
			<th>Nazwa</th>
			<th>Adres</th>
			<th>Akcje</th>
		</tr>
		<?foreach ($users as $user):?>
		<tr>
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
				<?=anchor(url('user/zaloz/'.$user['id_users']),'załóż konto',array('class' => 'black'))?>
			</td>
		</tr>
		<?endforeach?>
	</table>
<?else:?>
	<p>
		Brak użytkowników w bazie
	</p>
<?endif?>
	
