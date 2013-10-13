<div id="szczegoly_sprawy">
	<?=anchor(url('formularz/generuj/planPodzialu'),form_button('generuj','Generuj wezwanie'))?>
	<div class="to_left">
		<p>
			<?=form_label('NIP', 'NIP') ?>
			<?=$sprawa['NIP'] ?>
		</p>
		<p>
			<?=form_label('PESEL', 'PESEL') ?>
			<?=$sprawa['PESEL']?>
		</p>
		
		<p>	
			<?=form_label('Nazwa dłużnika', 'nazwa_dluznika',array('class' => 'zwin_link','id' => 'zwin_link'.$sprawa['id_dluznika'])) ?>
			<?= $sprawa['nazwa_dluznika'] ?>
		</p>
		<p>
			<?=form_label('Adres', 'adres') ?>
			<?= $sprawa['ulica'] ?> <?= $sprawa['nr_dom'] ?> <?if ($sprawa['nr_lokal']): ?>/ <?= $sprawa['nr_lokal'] ?><?endif?><br />
			<?=form_label('', 'adres') ?>
			<?= $sprawa['miasto']?> <?= $sprawa['kod'] ?>
		</p>
		<p>
			<?=form_label('Nr telefonu', 'nr_telefonu') ?>
			<?= $sprawa['nr_telefonu'] ?>
		</p>
	</div>
	<div>
		<p>
			<?=form_label('Sygn. akt', 'sygn_akt') ?>
			<?=$sprawa['sygn_akt']?>
		</p>
		<p>
			<?=form_label('Nr sprawy', 'nr_sprawy') ?>
			<?=$sprawa['nr_sprawy']?>
		</p>
		<p>
			<?=form_label('Data postanowienia', 'data_postanowienia') ?>
			<?= $sprawa['data_postanowienia']?>
			
		</p>
		
		<p>
			<?=form_label('Data wpływu postanowienia', 'data_wplywu') ?>
			<?= $sprawa['data_wplywu'] ?>
			
		</p>
	</div>
</div>
<table border="1">
	<tr>
		<th>Nazwa wierzyciela</th>
		<th>Typ wierzyciela</th>
		<th>KM</th>
		<th>Adres</th>
		<th>Telefon</th>
		<th>Rachunek bankowy</th>
	</tr>
	<?foreach ($sprawa['wierzyciele'] as $nr => $wierzyciel):?>
	<tr>
		<td>	
			<?= $wierzyciel['nazwa_w'] ?>
		</td>
		<td>
			<?=$wierzyciel['nazwa_typ_wierzyciel']?>
		</td>
		<td>	
			<?= $wierzyciel['KM'] ?>
		</td>
		<td>
			<?= $wierzyciel['ulica_w'] ?> <?= $wierzyciel['nr_dom_w'] ?> <?if ($wierzyciel['nr_lokal_w']): ?>/ <?= $wierzyciel['nr_lokal_w']?><?endif?><br />
			<?= $wierzyciel['miasto_w'] ?> <?= $wierzyciel['kod_w'] ?>
		</td>
		<td>
			<?= $wierzyciel['nr_telefonu_w']?>
		</td>
		<td>
			<?=$wierzyciel['nr_rachunku_w'] ?>
		</td>
	</tr>
	<?endforeach?>	
</table>