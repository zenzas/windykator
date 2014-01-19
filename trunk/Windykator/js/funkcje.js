function SynchronizedDropDown(parentId, childId, values, loadValues) {
	this.parentId = parentId;
	this.childId = childId;
	this.values = values;
	
	var this_ = this; 
	$('#'+parentId).change(function() {
		var parent = $('#'+this_.parentId);
		var id = parent.val();
        var child = $('#'+this_.childId);
		child.empty(); // remove old options
		for (var key in this_.values[id]) {
		  child.append($("<option></option>").attr("value", key).text(this_.values[id][key]));
		}
    });
    if (loadValues) {
    	$('#'+parentId).change();
    }
}

function zmianaTypuStopyProcentowej(dropdown, id) {
	var val = dropdown.value;
	var input = $('#'+id);
	if (val == 'stopa_z_wyroku') {
		input.show();
	} else {
		input.hide();
	}
}

function main() {
	$('.delete_user_link').click(function() {
		if (!confirm("Czy na pewno chcesz zablokować tego użytkownika?")) {
			return false;
		}
	});
	$('.restore_user_link').click(function() {
		if (!confirm("Czy na pewno chcesz odblokować tego użytkownika?")) {
			return false;
		}
	});
	$('.delete_sprawa_link').click(function() {
		if (!confirm("Czy na pewno chcesz zarchiwizować tę sprawę?")) {
			return false;
		}
	});
	$('.restore_sprawa_link').click(function() {
		if (!confirm("Czy chcesz przywrócić tę sprawę?")) {
			return false;
		}
	});
	$('.zwin_link').click(function() {
		$('#'+this.id+'_div').toggle();
	});
	$('#dodaj_wierzyciela').click(function() {
		var counter = $('#id_next_wierzyciel').val();
		
		var nowy = $('#wierzyciel_nowy').clone( true );
		nowy.attr('id','wierzyciel'+counter);
		
		var pola = nowy.find('input,textarea,select');
		
		$.each(pola, function(i, pole) {
			var name = pole.name;
			pole.name = 'wierzyciele['+counter+']['+name+']';
		});
		
		var zwin_link_id = 'zwin_link'+counter;
		nowy.find('.zwin_link').attr('id',zwin_link_id);
		nowy.find('.zwin_div').attr('id',zwin_link_id+'_div');
		$('.zwin_div').hide();
		nowy.find('.zwin_div').show();
		
		$('#wierzyciele').append(nowy);
		nowy.show();
		
		$('#id_next_wierzyciel').val(++counter);		
	});
	$('#dodaj_wierzyciela_link').click(function() {
		var id = $('#dluznik').val();
		var obj = $('#dodaj_wierzyciela_link');
		var link = obj.attr('href');
		obj.attr('href',link+'/'+id);
		//window.location.href='/'
	});
	$('#typ_user').ready(function() {
		if ($('#typ_user').val() == 3) {
			$('#kategoria_zaspokojenia').show();
		} else {
			$('#kategoria_zaspokojenia').hide();
		}
	});
	$('#typ_user').change(function() {
		if ($('#typ_user').val() == 3) {
			$('#kategoria_zaspokojenia').show();
		} else {
			$('#kategoria_zaspokojenia').hide();
		}
	});
	$('.datepicker').datepicker(
		{ 
		  dateFormat: 'yy-mm-dd',
		  minDate: '-80y',
          maxDate: new Date(),
          yearRange: "-80:-0",
		  changeMonth: true,
		  changeYear: true,
		  firstDay: 1,
		  monthNames: ["Styczeń","Luty","Marzec","Kwiecień","Maj","Czerwiec","Lipiec","Sierpień","Wrzesień","Październik","Listopad","Grudzień"],
		  monthNamesShort: ["Sty","Lut","Mar","Kwi","Maj","Cze","Lip","Sie","Wrz","Paź","Lis","Gru"],
		  dayNamesMin: ["Ni","Po","Wt","Sr","Cz","Pi","So"],
	    }

	);
}
$().ready(main);
