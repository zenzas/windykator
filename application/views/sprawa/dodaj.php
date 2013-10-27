<?=form_open('sprawa/dodaj',array('id' => 'dodaj_sprawe'))?>
<p>
	<?=form_label('Sygn. akt', 'sygn_akt')?>
	<?=form_input('sygn_akt',$sprawa['sygn_akt'])?>
	
</p>
<span class="error"><?=form_error('sygn_akt')?></span>
<p>
	<?=form_label('Nr sprawy', 'nr_sprawy')?>
	<?=form_input('nr_sprawy',$sprawa['nr_sprawy'])?>
	
</p>
<span class="error"><?=form_error('nr_sprawy')?></span>
<p>
	<?=form_label('NIP', 'NIP')?>
	<?=form_input('NIP',$sprawa['NIP'])?>
</p>
<span class="error"><?=form_error('NIP')?></span>
<p>
	<?=form_label('PESEL', 'PESEL')?>
	<?=form_input('PESEL',$sprawa['PESEL'])?>
</p>
<span class="error"><?=form_error('PESEL')?></span>
<p>	
	<?=form_label('Nazwa dłużnika', 'nazwa_dluznika')?>
	<?=form_textarea('nazwa_dluznika',$sprawa['nazwa_dluznika'])?>
</p>
<span class="error"><?=form_error('nazwa_dluznika')?></span>
<p>
	<?=form_label('Ulica', 'ulica')?>
	<?=form_input('ulica',$sprawa['ulica'])?>
</p>
<span class="error"><?=form_error('ulica')?></span>
<p>
	<?=form_label('Nr domu', 'nr_dom')?>
	<?=form_input('nr_dom',$sprawa['nr_dom'])?>
</p>
<span class="error"><?=form_error('nr_dom')?></span>
<p>
<p>
	<?=form_label('Nr lokalu', 'nr_lokal')?>
	<?=form_input('nr_lokal',$sprawa['nr_lokal'])?>
	
</p>
<span class="error"><?=form_error('nr_lokal')?></span>
<p>
	<?=form_label('Miasto', 'miasto')?>
	<?=form_input('miasto',$sprawa['miasto'])?>
</p>
<span class="error"><?=form_error('miasto')?></span>
<p>
	<?=form_label('Kod pocztowy', 'kod')?>
	<?=form_input('kod',$sprawa['kod'])?>
</p>
<span class="error"><?=form_error('kod')?></span>
<p>
	<?=form_label('Nr telefonu', 'nr_telefonu')?>
	<?=form_input('nr_telefonu',$sprawa['nr_telefonu'])?>
</p>
<span class="error"><?=form_error('nr_telefonu')?></span>
<p>
	<?=form_label('Data postanowienia', 'data_postanowienia')?>
	<?=form_input(array('name' => 'data_postanowienia', 'value' => $sprawa['data_postanowienia'], 'class' => 'datepicker', 'autocomplete' => 'off')) ?>
</p>
<span class="error"><?=form_error('data_postanowienia')?></span>
<p>
	<?=form_label('Data wpływu postanowienia', 'data_wplywu')?>
	<?=form_input(array('name' => 'data_wplywu', 'value' => $sprawa['data_wplywu'], 'class' => 'datepicker', 'autocomplete' => 'off')) ?>
	
</p>
<span class="error"><?=form_error('data_wplywu')?></span>
<p>
	<?=form_label('Data wysłania wezwania', 'data_wezwania')?>
	<?=form_input(array('name' => 'data_wezwania', 'value' => $sprawa['data_wezwania'], 'class' => 'datepicker', 'autocomplete' => 'off')) ?>
	
</p>
<span class="error"><?=form_error('data_wezwania')?></span>

<p>
	<?=form_label('Data odbioru wezwania', 'data_odbioru')?>
	<?=form_input(array('name' => 'data_odbioru', 'value' => $sprawa['data_odbioru'], 'class' => 'datepicker', 'autocomplete' => 'off')) ?>
	
</p>
<span class="error"><?=form_error('data_odbioru')?></span>

<p>
	<?=form_label('Data zakończenia postępowania', 'data_zakonczenia') ?>
	<?=form_input(array('name' => 'data_zakonczenia', 'value' => $sprawa['data_zakonczenia'], 'class' => 'datepicker', 'autocomplete' => 'off')) ?>
</p>
	<span class="error"><?=form_error('data_zakonczenie')?></span>
	
<p>
	<?=form_label('Przyczyna zakończenia postępowania', 'przyczyna_zakonczenia')?>
	<?=form_dropdown('przyczyna_zakonczenia',$this->sprawy->getPrzyczynyZakonczenia(),$sprawa['przyczyna_zakonczenia'])?>
</p>
	<span class="error"><?=form_error('przyczyna_zakonczenie')?></span>
<p>	
	<?=form_label('Data postanowienia organu egzekucyjnego', 'data_postanowienia_org') ?>
	<?=form_input(array('name' => 'data_postanowienia_org', 'value' => $sprawa['data_postanowienia_org'], 'class' => 'datepicker', 'autocomplete' => 'off')) ?>
</p>
	<span class="error"><?=form_error('data_postanowienia_org')?></span>
<p>
	<?=form_label('Data odbioru postanowienia organu egzekucyjnego', 'data__odbioru_postanowienia_org') ?>
	<?=form_input(array('name' => 'data_odbioru_postanowienia_org', 'value' => $sprawa['data_odbioru_postanowienia_org'], 'class' => 'datepicker', 'autocomplete' => 'off')) ?>
</p>
	<span class="error"><?=form_error('data_odbioru_postanowienia_org')?></span>
<p>
	<?=form_label('Data zwrotu akt egzekucyjnych', 'data_nadania_akt') ?>
	<?=form_input(array('name' => 'data_nadania_akt', 'value' => $sprawa['data_nadania_akt'], 'class' => 'datepicker', 'autocomplete' => 'off')) ?>
</p>
	<span class="error"><?=form_error('data_odbioru_postanowienia_org')?></span>
<p>
	<?=form_label('Data odbioru akt egzekucyjnych przez wierzyciela', 'data_odbioru_akt') ?>
	<?=form_input(array('name' => 'data_odbioru_akt', 'value' => $sprawa['data_odbioru_akt'], 'class' => 'datepicker', 'autocomplete' => 'off')) ?>
</p>
	<span class="error"><?=form_error('data_odbioru_postanowienia_org')?></span>
	<?=form_submit('submit', 'DODAJ SPRAWĘ')?>
	<?=form_reset('reset','WYCZYŚĆ')?>
</p>
<?=form_close()?>
