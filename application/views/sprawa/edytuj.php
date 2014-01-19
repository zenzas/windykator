<?=form_open('sprawa/edytuj/' . $sprawa['id_sprawy'], array('id' => 'edytuj_sprawe')) ?>
<?=form_hidden('id_sprawy', $sprawa['id_sprawy']) ?>
<?=form_hidden('id_dluznika', $sprawa['id_dluznika']) ?>
<input type="hidden" id="id_next_wierzyciel" value="<?=$sprawa['id_next_wierzyciel'] ?>"/>
<div class="to_left">
	<p>
		<?=form_label('Sygn. akt', 'sygn_akt') ?>
		<?=form_input('sygn_akt', $sprawa['sygn_akt']) ?>
	</p>
	<span class="error"><?=form_error('nr_sprawy') ?></span>
	<p>
		<?=form_label('Nr sprawy', 'nr_sprawy') ?>
		<?=form_input('nr_sprawy', $sprawa['nr_sprawy']) ?>
	</p>
	<span class="error"><?=form_error('nr_sprawy') ?></span>
	<p>
		<?=form_label('NIP', 'NIP') ?>
		<?=form_input('NIP', $sprawa['NIP']) ?>
	</p>
	<span class="error"><?=form_error('NIP') ?></span>
	<p>
		<?=form_label('PESEL', 'PESEL') ?>
		<?=form_input('PESEL', $sprawa['PESEL']) ?>
	</p>
	<span class="error"><?=form_error('PESEL') ?></span>
	<p>	
		<?=form_label('Nazwa dłużnika', 'nazwa_dluznika', array('class' => 'zwin_link', 'id' => 'zwin_link' . $sprawa['id_dluznika'])) ?>
		<?=form_textarea('nazwa_dluznika', $sprawa['nazwa_dluznika']) ?>
	</p>
	<span class="error"><?=form_error('nazwa_dluznika') ?></span>
	<div id='zwin_link<?=$sprawa['id_dluznika'] ?>_div'>
	<p>
		<?=form_label('Ulica', 'ulica') ?>
		<?=form_input('ulica', $sprawa['ulica']) ?>
	</p>
	<span class="error"><?=form_error('ulica') ?></span>
	<p>
		<?=form_label('Nr domu', 'nr_dom') ?>
		<?=form_input('nr_dom', $sprawa['nr_dom']) ?>
	</p>
	<span class="error"><?=form_error('nr_dom') ?></span>
	<p>
	<p>
		<?=form_label('Nr lokalu', 'nr_lokal') ?>
		<?=form_input('nr_lokal', $sprawa['nr_lokal']) ?>
		
	</p>
	<span class="error"><?=form_error('nr_lokal') ?></span>
	<p>
		<?=form_label('Miasto', 'miasto') ?>
		<?=form_input('miasto', $sprawa['miasto']) ?>
	</p>
	<span class="error"><?=form_error('miasto') ?></span>
	<p>
		<?=form_label('Kod pocztowy', 'kod') ?>
		<?=form_input('kod', $sprawa['kod']) ?>
	</p>
	<span class="error"><?=form_error('kod') ?></span>
	<p>
		<?=form_label('Nr telefonu', 'nr_telefonu') ?>
		<?=form_input('nr_telefonu', $sprawa['nr_telefonu']) ?>
	</p>
	<span class="error"><?=form_error('nr_telefonu') ?></span>
	<p>
        <?=form_label('Zajęty składnik majątkowy', 'skladnik_majatkowy') ?>
        <?=form_dropdown('skladnik_majatkowy', $this -> sprawy -> getSkladnikiMajatkowe(), $sprawa['skladnik_majatkowy']) ?>
    
    </p>
    <span class="error"><?=form_error('skladnik_majatkowy') ?></span>    
	</div>	
	<p>
		<?=form_label('Data postanowienia', 'data_postanowienia') ?>
		<?=form_input(array('name' => 'data_postanowienia', 'value' => $sprawa['data_postanowienia'], 'class' => 'datepicker', 'autocomplete' => 'off')) ?>
		
	</p>
	<span class="error"><?=form_error('data_postanowienia') ?></span>
	<p>
		<?=form_label('Data wpływu postanowienia', 'data_wplywu') ?>
		<?=form_input(array('name' => 'data_wplywu', 'value' => $sprawa['data_wplywu'], 'class' => 'datepicker', 'autocomplete' => 'off')) ?>
		
	</p>
	<span class="error"><?=form_error('data_wplywu') ?></span>
	<p>
        <?=form_label('Data zajęcia przez poprzedni organ egzekucyjnych', 'data_zajecia') ?>
        <?=form_input(array('name' => 'data_zajecia', 'value' => $sprawa['data_zajecia'], 'class' => 'datepicker', 'autocomplete' => 'off')) ?>
    </p>
    <span class="error"><?=form_error('data_zajecia') ?></span>
	<p>
		<?=form_label('Data wysłania wezwania', 'data_wezwania') ?>
		<?=form_input(array('name' => 'data_wezwania', 'value' => $sprawa['data_wezwania'], 'class' => 'datepicker', 'autocomplete' => 'off')) ?>
		
	</p>
	<p>
		<?=form_label('Data odbioru wezwania', 'data_odbioru') ?>
		<?=form_input(array('name' => 'data_odbioru', 'value' => $sprawa['data_odbioru'], 'class' => 'datepicker', 'autocomplete' => 'off')) ?>
		
	</p>
	<p>
		<?=form_label('Data zakończenia postępowania', 'data_zakonczenia') ?>
		<?=form_input(array('name' => 'data_zakonczenia', 'value' => $sprawa['data_zakonczenia'], 'class' => 'datepicker', 'autocomplete' => 'off')) ?>
	</p>
	<p>
		<?=form_label('Przyczyna zakończenia postępowania', 'przyczyna_zakonczenia') ?>
		<?=form_dropdown('przyczyna_zakonczenia', $this -> sprawy -> getPrzyczynyZakonczenia(), $sprawa['przyczyna_zakonczenia']) ?>
	
	</p>
	<span class="error"><?=form_error('przyczyna_zakonczenia') ?></span>
	<p>
		<?=form_label('Data postanowienia organu egzekucyjnego', 'data_postanowienia_org') ?>
		<?=form_input(array('name' => 'data_postanowienia_org', 'value' => $sprawa['data_postanowienia_org'], 'class' => 'datepicker', 'autocomplete' => 'off')) ?>
	</p>
	<span class="error"><?=form_error('data_postanowienia_org') ?></span>
	<p>
	<?=form_label('Data odbioru postanowienia organu egzekucyjnego', 'data_odbioru_postanowienia_org') ?>
		<?=form_input(array('name' => 'data_odbioru_postanowienia_org', 'value' => $sprawa['data_odbioru_postanowienia_org'], 'class' => 'datepicker', 'autocomplete' => 'off')) ?>
	</p>
	<span class="error"><?=form_error('data_odbioru_postanowienia_org') ?></span>
	<p>		
		<?=form_label('Data nadania akt egzekucyjnych', 'data_nadania_akt') ?>
		<?=form_input(array('name' => 'data_nadania_akt', 'value' => $sprawa['data_nadania_akt'], 'class' => 'datepicker', 'autocomplete' => 'off')) ?>
	</p>
	<span class="error"><?=form_error('data_nadania_akt') ?></span>
	<p>
		<?=form_label('Data odbioru akt egzekucyjnych', 'data_odbioru_akt') ?>
		<?=form_input(array('name' => 'data_odbioru_akt', 'value' => $sprawa['data_odbioru_akt'], 'class' => 'datepicker', 'autocomplete' => 'off')) ?>
	</p>
	<span class="error"><?=form_error('data_odbioru_akt') ?></span>
</div>

<div class="to_left">
	<div id="wierzyciele">
		<?foreach ($sprawa['wierzyciele'] as $nr => $wierzyciel):?>
		<div id="wierzyciel<?=$nr ?>">
			<?if (isset($wierzyciel['id_wierzyciela'])):?>
			<?=form_hidden("wierzyciele[$nr][id_wierzyciela]", $wierzyciel['id_wierzyciela']) ?>
			<?endif ?>
			<p>	
				<?=form_label('Nazwa wierzyciela', "wierzyciele[$nr][nazwa_w]", array('class' => 'zwin_link', 'id' => 'zwin_link' . $nr)) ?>
				<?=form_textarea("wierzyciele[$nr][nazwa_w]", $wierzyciel['nazwa_w']) ?>
			</p>
			<span class="error"><?=form_error("wierzyciele[$nr][nazwa_w]") ?></span>
			<div class='zwin_div' id='zwin_link<?=$nr ?>_div'>
				<p>
					<?=form_label('Kategoria zaspokojenia', 'kategoria_zaspokojenia') ?>
					<?=form_dropdown("wierzyciele[$nr][kategoria_zaspokojenia]", $kategorieZaspokojenia, $wierzyciel['kategoria_zaspokojenia']) ?>
				</p>
				<p>	
					<?=form_label('Typ stopy procentowej', 'typ_stopy_procentowej') ?>
					<?=form_dropdown("wierzyciele[$nr][typ_stopy_procentowej]", $typyStopProcentowych, $wierzyciel['typ_stopy_procentowej'], 'onChange="zmianaTypuStopyProcentowej(this, \'stopa_z_wyroku_' . $nr . '\')"') ?>
				</p>
				<p id="stopa_z_wyroku_<?=$nr ?>" <?=($wierzyciel['typ_stopy_procentowej'] != 'stopa_z_wyroku' ? 'style="display:none"' : '') ?>>
					<?=form_label('Wysokość stopy z wyroku', 'stopa_z_wyroku') ?>
					<?=form_input("wierzyciele[$nr][stopa_z_wyroku]", $wierzyciel['stopa_z_wyroku']) ?>
				</p>
				<span class="error"><?=form_error("wierzyciele[$nr][stopa_z_wyroku]") ?></span>
				<p>
					<?=form_label('Pełnomocnik', 'pelnomocnik') ?>
					<?=form_dropdown("wierzyciele[$nr][pelnomocnik]", $pelnomocnicy, $wierzyciel['pelnomocnik']) ?>
				</p>
				<p>
                    <?=form_label('Poprzedni organ egzekucyjny', 'organ_egzekucyjny') ?>
                    <?=form_dropdown("wierzyciele[$nr][organ_egzekucyjny]", $organyEgzekucyjne, $wierzyciel['organ_egzekucyjny']) ?>
                </p>
				<p>	
					<?=form_label('KM', "wierzyciele[$nr][KM]") ?>
					<?=form_input("wierzyciele[$nr][KM]", $wierzyciel['KM']) ?>
				</p>
				<span class="error"><?=form_error("wierzyciele[$nr][KM]") ?></span>
				<p> 
                    <?=form_label('Tytuł wykonawczy', "wierzyciele[$nr][tytul_wykonawczy]") ?>
                    <?=form_input("wierzyciele[$nr][tytul_wykonawczy]", $wierzyciel['tytul_wykonawczy']) ?>
                </p>
				<span class="error"><?=form_error("wierzyciele[$nr][tytul_wykonawczy]") ?></span>
				 <p> 
                    <?=form_label('Data wystawienia tytułu wykonawczego', "wierzyciele[$nr][data_tytulu]") ?>
                    <?=form_input(array('name' => "wierzyciele[$nr][data_tytulu]", 'value' => $wierzyciel['data_tytulu'], 'class' => 'datepicker', 'autocomplete' => 'off')) ?>
        
                </p>
                <span class="error"><?=form_error("wierzyciele[$nr][data_tytulu]") ?></span>  
				<p> 
                    <?=form_label('Wystawiony przez', "wierzyciele[$nr][tytul_wydanyPrzez]") ?>
                    <?=form_input("wierzyciele[$nr][tytul_wydanyPrzez]", $wierzyciel['tytul_wydanyPrzez']) ?>
                </p>
                <span class="error"><?=form_error("wierzyciele[$nr][tytul_wydanyPrzez]") ?></span>
                <p>  
					<?=form_label('Ulica', "wierzyciele[$nr][ulica_w]") ?>
					<?=form_input("wierzyciele[$nr][ulica_w]", $wierzyciel['ulica_w']) ?>
				</p>
				<span class="error"><?=form_error("wierzyciele[$nr][ulica_w]") ?></span>
				<p>
					<?=form_label('Nr domu', "wierzyciele[$nr][nr_dom_w]") ?>
					<?=form_input("wierzyciele[$nr][nr_dom_w]", $wierzyciel['nr_dom_w']) ?>
				</p>
				<span class="error"><?=form_error("wierzyciele[$nr][nr_dom_w]") ?></span>
				<p>
					<?=form_label('Nr lokalu', "wierzyciele[$nr][nr_lokal_w]") ?>
					<?=form_input("wierzyciele[$nr][nr_lokal_w]", $wierzyciel['nr_lokal_w']) ?>
					
				</p>
				<span class="error"><?=form_error("wierzyciele[$nr][nr_lokal_w]") ?></span>
				<p>
					<?=form_label('Miasto', "wierzyciele[$nr][miasto_w]") ?>
					<?=form_input("wierzyciele[$nr][miasto_w]", $wierzyciel['miasto_w']) ?>
				</p>
				<span class="error"><?=form_error("wierzyciele[$nr][miasto_w]") ?></span>
				<p>
					<?=form_label('Kod pocztowy', "wierzyciele[$nr][kod_w]") ?>
					<?=form_input("wierzyciele[$nr][kod_w]", $wierzyciel['kod_w']) ?>
				</p>
				<span class="error"><?=form_error("wierzyciele[$nr][kod_w]") ?></span>
				<p>
					<?=form_label('Nr telefonu', "wierzyciele[$nr][nr_telefonu_w]") ?>
					<?=form_input("wierzyciele[$nr][nr_telefonu_w]", $wierzyciel['nr_telefonu_w']) ?>
				</p>
				<span class="error"><?=form_error("wierzyciele[$nr][nr_telefonu_w]") ?></span>	
				<p>
					<?=form_label('Nr rachunku bankowego', "wierzyciele[$nr][nr_rachunku_w]") ?>
					<?=form_input("wierzyciele[$nr][nr_rachunku_w]", $wierzyciel['nr_rachunku_w']) ?>
				</p>
				<span class="error"><?=form_error("wierzyciele[$nr][nr_rachunku_w]") ?></span>	
			</div>
		</div>
		<?endforeach ?>	
	</div>
	
</div>
<p class="clear">
	<?=form_submit('submit', 'ZAPISZ ZMIANY') ?>
	<?=form_reset('reset', 'WYCZYŚĆ') ?>
	<?=form_button(array('content' => 'NOWY WIERZYCIEL', 'id' => 'dodaj_wierzyciela')) ?>
</p>
<?=form_close() ?>
<div id="wierzyciel_nowy">
	<p>
		<?=form_label('Nazwa wierzyciela', 'nazwa_w', array('class' => 'zwin_link')) ?>
		<?=form_textarea('nazwa_w', '') ?>
	</p>
	<span class="error"><?=form_error('nazwa_w') ?></span>
	<div  class='zwin_div'>
	<p>	
		<?=form_label('Kategoria zaspokojenia', 'kategoria_zaspokojenia') ?>
		<?=form_dropdown('kategoria_zaspokojenia', $kategorieZaspokojenia) ?>
	</p>
	<p>	
		<?=form_label('Typ stopy procentowej', 'typ_stopy_procentowej') ?>
		<?=form_dropdown('typ_stopy_procentowej', $typyStopProcentowych, 'referencyjna', 'onChange="zmianaTypuStopyProcentowej(this, \'stopa_z_wyroku\')"') ?>
	</p>
	<p id='stopa_z_wyroku' style="display:none"'>
		<?=form_label('Wysokość stopy z wyroku', 'stopa_z_wyroku') ?>
		<?=form_input('stopa_z_wyroku', '') ?>
	</p>
	<span class="error"><?=form_error('stopa_z_wyroku') ?></span>
	<p>
		<?=form_label('Pełnomocnik', 'pelnomocnik') ?>
		<?=form_dropdown('pelnomocnik', $pelnomocnicy) ?>
	</p>
	<span class="error"><?=form_error('pelnomocnik') ?></span>
	<p>
        <?=form_label('Poprzedni organ egzekucyjny', 'organ_egzekucyjny') ?>
        <?=form_dropdown("organ_egzekucyjny", $organyEgzekucyjne) ?>
    </p>
    <span class="error"><?=form_error('organ_egzekucyjny') ?></span>
	<p>	
		<?=form_label('KM', 'KM') ?>
		<?=form_input('KM', '') ?>
	</p>
	<span class="error"><?=form_error('KM') ?></span>
	<p>    
        <?=form_label('Tytuł wykonawczy', 'tytul_wykonawczy') ?>
        <?=form_input('tytul_wykonawczy', '') ?>
    </p>
    <span class="error"><?=form_error('tytul_wykonawczy') ?></span>
    <p> 
        <?=form_label('Data wystawienia tytułu wykonawczego', "data_tytulu") ?>
        <?=form_input(array('name' => "data_tytulu", 'value' => '', 'class' => 'datepicker', 'autocomplete' => 'off')) ?>

    </p>
    <span class="error"><?=form_error("data_tytulu") ?></span>  
    <p> 
        <?=form_label('Wystawiony przez', "tytul_wydanyPrzez") ?>
        <?=form_input("tytul_wydanyPrzez", '') ?>
    </p>
    <span class="error"><?=form_error("tytul_wydanyPrzez") ?></span>
	<p>
		<?=form_label('Ulica', 'ulica_w') ?>
		<?=form_input('ulica_w', '') ?>
	</p>
	<span class="error"><?=form_error('ulica_w') ?></span>
	<p>
		<?=form_label('Nr domu', 'nr_dom_w') ?>
		<?=form_input('nr_dom_w', '') ?>
	</p>
	<span class="error"><?=form_error('nr_dom_w') ?></span>
	<p>
		<?=form_label('Nr lokalu', 'nr_lokal_w') ?>
		<?=form_input('nr_lokal_w', '') ?>
		
	</p>
	<span class="error"><?=form_error('nr_lokal_w') ?></span>
	<p>
		<?=form_label('Miasto', 'miasto_w') ?>
		<?=form_input('miasto_w', '') ?>
	</p>
	<span class="error"><?=form_error('miasto_w') ?></span>
	<p>
		<?=form_label('Kod pocztowy', 'kod_w') ?>
		<?=form_input('kod_w', '') ?>
	</p>
	<span class="error"><?=form_error('kod_w') ?></span>
	<p>
		<?=form_label('Nr telefonu', 'nr_telefonu_w') ?>
		<?=form_input('nr_telefonu_w', '') ?>
	</p>
	<span class="error"><?=form_error('nr_telefonu_w') ?></span>	
	<p>
		<?=form_label('Nr rachunku bankowego', 'nr_rachunku_w') ?>
		<?=form_input('nr_rachunku_w', '') ?>
	</p>
	<span class="error"><?=form_error('nr_rachunku_w') ?></span>	
</div>

