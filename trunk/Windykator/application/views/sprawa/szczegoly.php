<div id="szczegoly_sprawy">
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
		<p>
            <?=form_label('Zajęty składnik majątkowy', 'skladnik_majatkowy') ?>
            <?= $sprawa['skladnik_majatkowy'] ?>
        </p>
		<p>
			<?=form_label('Sygn. akt', 'sygn_akt') ?>
			<?=$sprawa['sygn_akt']?>
		</p>
		<p>
			<?=form_label('Data postanowienia sądu', 'data_postanowienia') ?>
			<?= $sprawa['data_postanowienia']?>
		</p>
	
		<p>
			<?=form_label('Data wpływu postanowienia', 'data_wplywu') ?>
			<?= $sprawa['data_wplywu'] ?>
		</p>	
	
	</div>
	<div>
		<p>
			<?=form_label('Nr sprawy', 'nr_sprawy') ?>
			<?=$sprawa['nr_sprawy']?>
		</p>
		
		<p>
			<?=form_label('Data wysłania wezwania', 'data_wezwania') ?>
			<?= $sprawa['data_wezwania'] ?>
		</p>
		<p>
			<?=form_label('Data odbioru wezwania', 'data_odbioru') ?>
			<?= $sprawa['data_odbioru'] ?>
		</p>
		
		<p>
			<?=form_label('Data zakończenia postępowania', 'data_zakonczenia') ?>
			<?= $sprawa['data_zakonczenia'] ?>
		</p>
		<p>
			<?=form_label('Przyczyna zakończenia postępowania', 'przyczyna_zakonczenia') ?>
			<?= $sprawa['przyczyna_zakonczenia'] ?>
		</p>
		<p>
			<?=form_label('Data postanowienia organu egzekucyjnego', 'data_postanowienia_org') ?>
			<?= $sprawa['data_postanowienia_org'] ?>
		</p>
		<p>
			<?=form_label('Data odbioru postanowienia organu egzekucyjnego', 'data_odbioru_postanowienia_org') ?>
			<?= $sprawa['data_odbioru_postanowienia_org'] ?>
		</p>
		<p>
			<?=form_label('Data odbioru postanowienia organu egzekucyjnego', 'data_odbioru_postanowienia_org') ?>
			<?= $sprawa['data_odbioru_postanowienia_org'] ?>
		</p>
		
		
		
		<p>
			<?=form_label('Data odbioru akt egzekucyjnych', 'data_odbioru_akt') ?>
			<?= $sprawa['data_odbioru_akt'] ?>
		
	</div>
</div>
<table border="1">
	<tr>
		<th>Nazwa wierzyciela</th>
		<th>Nazwa pełnomocnika</th>
		<th>KM</th>
		<th>Adres</th>
		<th>Telefon</th>
		<th>Generuj</th>
	</tr>
	<?foreach ($sprawa['wierzyciele'] as $nr => $wierzyciel):?>
	<tr>
		<td>	
			<?=anchor(url('wierzyciel/szczegoly/'.$wierzyciel['id_wierzyciele_sprawy']),$wierzyciel['nazwa_w'],array('class' => 'black'))?>
		</td>
		<td>
			<?=$wierzyciel['nazwa_pelnomocnika']?>
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
		    <?=anchor(url('formularz/generuj/kartaWierzyciela/pozioma/'.$wierzyciel['id_wierzyciele_sprawy']),form_button('generuj','Karta wierzyciela'))?>
		</td>
	</tr>
	<?endforeach?>	
</table>
<?=$this->load->view('wplata/lista')?>